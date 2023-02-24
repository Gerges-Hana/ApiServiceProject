<?php

namespace App\Http\Controllers;

use App\Models\DeliveryGuy;
use Illuminate\Http\Request;

/**
 * Delivery staff web controller 
 */
class DeliveryController extends Controller
{
    public function index()
    {
        $deliveryGuys = DeliveryGuy::all();

        return view('delivery-staff', ['delvieryGuys' => $deliveryGuys]);
    }
}
