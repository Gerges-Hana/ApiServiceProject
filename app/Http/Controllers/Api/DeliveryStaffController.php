<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliveryGuy;
use Illuminate\Http\Request;

/**
 * Delivery staff api controller
 */
class DeliveryStaffController extends Controller
{
    public function index()
    {
        return DeliveryGuy::all();
    }
}
