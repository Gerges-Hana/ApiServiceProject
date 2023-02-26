<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    public function getAllOrders()
    {

        $orders = Order::all();

 dd($orders);


        return view('index', compact('posts'));
        // return view('index', ['posts' => $posts] ,compact('paginatPost'));
        // return 'my name is gergee';
    }
}
