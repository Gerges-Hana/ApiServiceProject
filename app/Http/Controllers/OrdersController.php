<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    public function getAllOrders()
    {
        $orders = Invoice::all();
        // $compName=$orders->company->name;
        //  dd($orders);
        return view('orders',['orders' => $orders] );
    }


}
