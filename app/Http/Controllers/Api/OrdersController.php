<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

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
        return Invoice::where('companyId', $companyId)->get();
    }


    // ======================deligery guy token=========================
    public function deliveryOrders()
    {
//         select `users`.*, `posts`.`descrption` from `users`
// inner join `posts` on `posts`.`user_id` = `users`.`id`
// inner join `comments` on `comments`.`post_id` = `posts`.`id`

// $users = User::join('posts', 'posts.user_id', '=', 'users.id')
//               ->join('comments', 'comments.post_id', '=', 'posts.id')
//               ->get(['users.*', 'posts.descrption']);


// $users = User::join('posts', 'users.id', '=', 'posts.user_id')
//                ->get(['users.*', 'posts.descrption']);

        $order = Invoice::join('delivery_guys', 'companyId', '=', 'companyId')
        ->join('companies', 'id', '=', 'companyId')
        ->get();
        return $order;



    }
    // ===============================================

    public function allOrders()
    {
       return Invoice::all();
    }

    // function return company orders
    public function index($companyId)
    {
        return Invoice::where('companyId', $companyId)->get();
    }


    // function store  a invoices in api services from restaurant
    public function storeInvoice(Request $request)
    {
        $invoice = $request->validate([
            'companyId' => 'required',
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
            'companyId' => $invoice['companyId'],
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

    // function to send orders api to delivery gay
    protected function postInvoiceToDelivery()
    {

        return Invoice::where('status', 'waiting')->get();
    }
}
