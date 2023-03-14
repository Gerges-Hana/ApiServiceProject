<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliveryGuy;
use App\Models\Invoice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

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
        return DB::table('invoices as in')
            ->select(
                'in.id as invoiceId', 'in.invoiceCode', 'in.companyId', 'in.isPaid', 'in.delivaryFees', 'in.status',
                'in.city', 'in.street', 'in.buildingNumber', 'in.floorNumber', 'in.apartmentNumber', 'in.totalPrice',
                'in.orderDate', 'in.clientName', 'in.clientPhone', 'in.created_at', 'dg.id as deliveryGuyId', 'dg.name'
            )->where('in.companyId', $companyId)
            ->leftJoin('delivery_guys as dg', 'in.deliveryGuyId', '=', 'dg.id')
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
            'data' => $allOrders,
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
            'data' => $allOrders,
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
            'data' => $order,
        ], 200);
    }

    private function updateInvoiceStatus($deliveryId, $invoiceId, string $invoicStatus)
    {
        Invoice::where('id', $invoiceId)->update(['status' => $invoicStatus, 'deliveryGuyId' => $deliveryId]);
        // update delivery guy status depending on invoice status
        DeliveryStaffController::updateDeliveryStatus($invoicStatus, $deliveryId);
        return response()->json(['message' => 'status updated'], 201);
    }

    /**
     * function update invoice status and delivery status by delivery guy
     */
    public function updateStatus($invoiceId, $status, Request $req)
    {
        try {
            // get delivery guy id
            $deliveryId = DeliveryStaffController::getDeliveryGuyId($req);
            // update invoice status
            // if incoming status is ondilvering && invoice status is waiting  => update
            // get order status
            $orderStatus = Invoice::select('status')->where('id', $invoiceId)->first()['status'];
            // return "$orderStatus, $status";
            if (($orderStatus == 'waiting' && $status == 'onDelivering')
                || ($orderStatus == 'onDelivering' && ($status == 'delivered' || $status == 'returned'))
            ) {
                return $this->updateInvoiceStatus($deliveryId, $invoiceId, $status);
            } else {
                return response()->json(['message' => "order is not available"], 403);
            }
        } catch (Exception $e) {
            return response()->json(['message' => "Failed, Status {$status} Not Accepted"], 403);
        }
    }

    public function updateStatusByComp($invoiceId, $status, Request $req)
    {
        $orderStatus = Invoice::select('status')->where('id', $invoiceId)->first()['status'];
        if ($status == 'cancelled' && $orderStatus != 'delivered') {
            try {
                $deliveryId = DeliveryStaffController::getDeliveryGuyId($req);
                return $this->updateInvoiceStatus($deliveryId, $invoiceId, $status);
            } catch (\Throwable$th) {
                return response()->json(['message' => "Failed, Status {$status} Not Accepted"], 403);
            }
        } else {
            return response()->json(['message' => "Failed, Status {$status} Not Accepted. Order has been delivered"], 403);
        }
    }

    // function to send orders api to delivery guy
    public function postInvoiceToDelivery()
    {

        return Invoice::where('status', 'waiting')->get();
    }
}
