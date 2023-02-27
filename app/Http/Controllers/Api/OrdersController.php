<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    public function index(){
        return Invoice::all();
    }
}
