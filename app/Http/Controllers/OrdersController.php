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
        //  dd($orders);
        return view('orders', ['orders' => $orders]);
    }
    public function waitingOrders()
    {
        $order=Invoice::where('status', 'waiting')->get();
        return view('orders', ['orders' => $order]);
    }
    public function deliveredOrders()
    {
        $order=Invoice::where('status', 'delivered')->get();
        return view('orders', ['orders' => $order]);
    }
    public function canceledOrders()
    {
        $order=Invoice::where('status', 'cancelled')->get();
        return view('orders', ['orders' => $order]);
    }
    public function onDeliveringOrders()
    {
        $order=Invoice::where('status', 'onDelivering')->get();
        return view('orders', ['orders' => $order]);
    }

    public function returnedOrders()
    {
        {
            $order=Invoice::where('status', 'returned')->get();
            return view('orders', ['orders' => $order]);
        }
    }
}
