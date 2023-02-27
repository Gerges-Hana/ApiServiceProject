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
    public function storeInvoice(){
        return 'test';
    }



}
