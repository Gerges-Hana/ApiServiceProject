<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\DeliveryGuy;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $allCompany=count( Company::all());
        $allOrders=count( Invoice::all());
        $allDeliveries=count( DeliveryGuy::all());

        $revenue=$allOrders*1.5;
        // dd($allCompany,$allOrders,$allDeliveries,$revenue);
        return view('dashboard', [
            'allCompany'=>$allCompany,
            'allOrders'=>$allOrders,
            'allDeliveries'=>$allDeliveries,
            'revenue'=>$revenue

        ]);
        // return "mnoer ya ghaly";

    }
}
