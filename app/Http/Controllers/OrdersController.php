<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    public function getAllOrders()
    {
        $orders = Invoice::all();
        // $compName=$orders->company->name;
        // $company = Company::select('name')->where('id'," $orders=>companyId")->get();
        // dd($company);
        // dd($orders);
        $count = 0;
        return view('orders', ['orders' => $orders, 'count' => $count]);
    }
    public function waitingOrders()
    {
        $order = Invoice::where('status', 'waiting')->get();
        $count = 0;
        return view('orders', ['orders' => $order, 'count' => $count]);
    }
    public function deliveredOrders()
    {
        $order = Invoice::where('status', 'delivered')->get();
        $count = 0;
        return view('orders', ['orders' => $order, 'count' => $count]);
    }
    public function canceledOrders()
    {
        $order = Invoice::where('status', 'cancelled')->get();
        $count = 0;
        return view('orders', ['orders' => $order, 'count' => $count]);
    }
    public function onDeliveringOrders()
    {
        $order = Invoice::where('status', 'onDelivering')->get();
        $count = 0;
        return view('orders', ['orders' => $order, 'count' => $count]);
    }

    public function returnedOrders()
    { {
            $order = Invoice::where('status', 'returned')->get();
            $count = 0;
            return view('orders', ['orders' => $order, 'count' => $count]);
        }
    }
    public function orderSearch(Request $request)
    {
        $inv = new Invoice();
        return view('orders', ['orders' => SearchController::searchWithCompanyName($request, $inv)]);
    }
}
