<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliveryGuy;
use App\Models\Invoice;
use Exception;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\Api\DeliveryStaffController;

class OrdersController extends Controller
{
    //
    // function return all arders in api services
    public function companyOrders(Request $req)
    {
        // return token code
        $hashedToken = $req->bearerToken();
        // return company of this token
        $token = PersonalAccessToken::findToken($hashedToken);
        // return company id of this token
        $companyId = $token->tokenable_id;
        return DB::table('invoices')
            ->where('invoices.companyId', $companyId)
            ->leftJoin('delivery_guys', 'invoices.deliveryGuyId', '=', 'delivery_guys.id')
            ->get();
    }


    // ================= getWaitingOrders ==================
    /**
     * route for return all orders from resturant to his delivery by delivery token
     * @return if success => status 200 , all waiting orders
     * @return if delivery is busy => status 406 , 'message' => 'you are busy'
     */
    public function getWaitingOrders(Request $req)
    {
        // get delivery guy id
        $deliveryId = DeliveryStaffController::getDeliveryGuyId($req);
        $companyId = DeliveryStaffController::getCompanyId($deliveryId);
        $allOrders = Invoice::where('companyId', $companyId)
            ->where('status', 'waiting')->get();

        $delivery = DeliveryGuy::find($deliveryId);
        if ($delivery->status == "busy") {
            return response()->json([
                'message' => 'you are busy',
            ], 406);
        }
        return response()->json([
            'message' => 'your orders',
            'data' => $allOrders
        ], 200);
    }
    // ================= end function getWaitingOrders ===============

    /**
     * @return case 'onDelivering': current delivering order one order
     * @return case delivered | returned | all : old orders as given status many orders
     */
    public function getOrdersByStatusForDeliveryGuy(Request $req, string $status)
    {
        // get delivery guy id
        $deliveryId = DeliveryStaffController::getDeliveryGuyId($req);
        $companyId = DeliveryStaffController::getCompanyId($deliveryId);

        $allOrders = "";

        switch ($status) {
            case 'onDelivering':
                $allOrders = Invoice::where('companyId', $companyId)
                    ->where('status', $status)
                    ->where('deliveryGuyId', $deliveryId)
                    ->first();
                break;

            case 'delivered':
            case 'returned':
                $allOrders = Invoice::where('companyId', $companyId)
                    ->where('status', $status)
                    ->where('deliveryGuyId', $deliveryId)
                    ->get();
                break;

            case 'all':
                $allOrders = Invoice::where('companyId', $companyId)
                    ->where('deliveryGuyId', $deliveryId)
                    ->get();
                break;

            default:
                return response()->json(['message' => "Failed, Status {$status} Not Accepted"], 501);
        }

        return response()->json([
            'message' => 'your orders',
            'data' => $allOrders
        ], 200);
    }

    public function allOrders()
    {
        return Invoice::all();
    }

    // function return company orders
    public function index($companyId)
    {
        return Invoice::where('companyId', $companyId)->get();
    }


    /**
     * function store  a invoices in api services from restaurant by its token
     * @return if success => status 200 , 'message' => 'Invoice has been added successfully',
     */
    public function storeInvoice(Request $request)
    {
        $invoice = $request->validate([
            'isPaid' => 'required',
            'delivaryFees' => 'required',
            'city' => 'required',
            'street' => 'required',
            'buildingNumber' => 'required',
            'floorNumber' => 'required',
            'apartmentNumber' => 'required',
            'totalPrice' => 'required',
            'orderDate' => 'required',
            'clientName' => 'required',
            'clientPhone' => 'required',
            'invoiceCode' => 'required',
        ]);

        // $invoiceCode = $invoice['invoiceCode'] . md5($campanyId);

        $order = Invoice::create([
            'companyId' => CompanyController::getCompanyId($request),
            'isPaid' => $invoice['isPaid'],
            'delivaryFees' => $invoice['delivaryFees'],
            'city' => $invoice['city'],
            'street' => $invoice['street'],
            'buildingNumber' => $invoice['buildingNumber'],
            'floorNumber' => $invoice['floorNumber'],
            'apartmentNumber' => $invoice['apartmentNumber'],
            'totalPrice' => $invoice['totalPrice'],
            'orderDate' => $invoice['orderDate'],
            'clientName' => $invoice['clientName'],
            'clientPhone' => $invoice['clientPhone'],
            'invoiceCode' => $invoice['invoiceCode'],
        ]);

        return response()->json([
            'message' => 'Invoice has been added successfully',
            'data' => $order
        ], 200);
    }


    /**
     * function update invoice status and delivery status
     */
    public function updateStatus($invoiceId, $status, Request $req)
    {
        try {
            // get delivery guy id
            $deliveryId = DeliveryStaffController::getDeliveryGuyId($req);
            // update invoice status
            // if incoming status is ondilvering && invoice status is waiting  => update
            if ($status == 'waiting') {
            }
            Invoice::where('id', $invoiceId)->update(['status' => $status, 'deliveryGuyId' => $deliveryId]);
            // update delivery guy status depending on invoice status
            DeliveryStaffController::updateDeliveryStatus($status, $deliveryId);
            return response()->json(['message' => 'status updated'], 201);
        } catch (Exception $e) {
            return response()->json(['message' => "Failed, Status {$status} Not Accepted"], 501);
        }
    }


    // function to send orders api to delivery guy
    public function postInvoiceToDelivery()
    {

        return Invoice::where('status', 'waiting')->get();
    }
}
