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

    public function store(Request $req)
    {
        $guy = $req->all();

        DeliveryGuy::create([
            'companyId' => 1,
            'name' => $guy['name'],
            'userName' => $guy['user-name'],
            'nationalId' => $guy['national-id'],
            'phone' => $guy['phone'],
            'salary' => $guy['salary'],
            'password' => $guy['password'],
            'motorCycleNumber' => $guy['motor-num'],
            'email' => $guy['email'],
        ]);
        
        return \response()->json(['message' => 'Delivery guy has been added successfully'], 200);
    }
}
