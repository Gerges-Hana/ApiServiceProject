<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller\OrderController;
class InvoiceStatusForDeliveryGuy extends Controller
{
   public function changeStatus(Request $request){
    $order=$request->all();
    
   }
}
