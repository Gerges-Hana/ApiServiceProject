<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    // function return all arders in api services
    public function show()
    {
        return Invoice::all();
    }

    // function return company orders
    public function index($companyId)
    {
        // notice company is writing rong in DB >> campanyId
        return Invoice::where('campanyId', $companyId)->get();
    }


    // function store  a invoices in api services from restaurant
    public function storeInvoice(Request $request)
    {
        $invoice = $request->all();
        // $id = $invoice['id'];
        $campanyId = $invoice['campanyId'];
        $deliveryGuyId = $invoice['deliveryGuyId'];
        $isPaid = $invoice['isPaid'];
        $delivaryFees = $invoice['delivaryFees'];
        $status = $invoice['status'];
        $city = $invoice['city'];
        $street = $invoice['street'];
        $buildingNumber = $invoice['buildingNumber'];
        $floorNumber = $invoice['floorNumber'];
        $apartmentNumber = $invoice['apartmentNumber'];
        $totalPrice = $invoice['totalPrice'];
        $orderDate = $invoice['orderDate'];
        $clientName = $invoice['clientName'];
        $clienPhone = $invoice['clienPhone'];
        $invoiceCode = $invoice['invoiceCode'].md5($campanyId);

        $order = Invoice::create([

            // 'id'=>$id  ,
            'campanyId'=>$campanyId  ,
            'deliveryGuyId'=>$deliveryGuyId  ,
            'isPaid'=>$isPaid  ,
            'delivaryFees'=>$delivaryFees  ,
            'status'=>$status  ,
            'city'=>$city  ,
            'street'=>$street  ,
            'buildingNumber'=>$buildingNumber  ,
            'floorNumber'=>$floorNumber  ,
            'apartmentNumber'=>$apartmentNumber  ,
            'totalPrice'=>$totalPrice  ,
            'orderDate'=>$orderDate  ,
            'clientName'=>$clientName  ,
            'clienPhone'=>$clienPhone  ,
            'invoiceCode'=>$invoiceCode  ,
        ]);

        return response()->json([
            'message' => 'Invoice has been added successfully',
            'data' =>$order
        ], 200);

    }
}
