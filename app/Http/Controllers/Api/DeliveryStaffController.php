<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliveryGuy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Delivery staff api controller
 */
class DeliveryStaffController extends Controller
{
    public function index($companyId)
    {
        return DeliveryGuy::where('companyId', $companyId)->get();
    }

    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'user-name' => 'required|unique:delivery_guys,userName',
            'national-id' => 'required',
            'phone' => 'required',
            'password' => 'required',
            // 'email' => 'required|unique:delivery_guys,email',
        ]);

        $guy = $req->all();

        DeliveryGuy::create([
            'companyId' => $guy['company-id'],
            'name' => $guy['name'],
            'userName' => $guy['user-name'],
            'nationalId' => $guy['national-id'],
            'phone' => $guy['phone'],
            'salary' => $guy['salary'],
            'password' => bcrypt($guy['password']),
            'motorCycleNumber' => $guy['motor-num'],
            'email' => $guy['email'],
        ]);

        return response()->json(['message' => 'Delivery guy has been added successfully'], 200);
    }

    public function login(Request $req)
    {
        $field = $req->all();
        // $field = $req->validate([
        //     'user-name' => 'requierd|string',
        //     'password' => 'required|string'
        // ]);

        // check if deliver user name exist
        $deliver = DeliveryGuy::where('userName', $field['user-name'])->first();

        // check if deliver or password is not exist
        if (!$deliver || !Hash::check($field['password'], $deliver->password)) {
            return response([
                'message' => 'sorry you dont have account, please contact your supervisor!'
            ], 401);
        }

        // generate token if deliver is exist
        $token = $deliver->createToken('deliveryGuyToken')->plainTextToken;

        return response([
            'deliveryGuy' => $deliver,
            'token' => $token
        ], 201);
    }

    public function logout()
    {

    }
}
