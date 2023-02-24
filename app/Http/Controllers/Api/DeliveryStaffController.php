<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delivery_Staff;
use Illuminate\Http\Request;

class DeliveryStaffController extends Controller
{
    public function index()
    {
        dd(Delivery_Staff::all());
        return Delivery_Staff::all();
    }
}
