<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliveryGuy;
use App\Models\Invoice;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Controllers\Api\CompanyController;
use App\Events\AddDelivery;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

/**
 * Delivery staff api controller
 */
class DeliveryStaffController extends Controller
{
    public function index(Request $req)
    {
        $companyId = CompanyController::getCompanyId($req);
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
            'email' => 'required|unique:delivery_guys,email',
        ]);

        $guy = $req->all();
        $companyId = CompanyController::getCompanyId($req);
        $delivery = DeliveryGuy::create([
            'companyId' => $companyId,
            'name' => $guy['name'],
            'userName' => $guy['user-name'],
            'nationalId' => $guy['national-id'],
            'phone' => $guy['phone'],
            'salary' => $guy['salary'],
            'password' => bcrypt($guy['password']),
            'motorCycleNumber' => $guy['motor-num'],
            'email' => $guy['email'],
        ]);

        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );

        // dd(env('PUSHER_APP_KEY'));
        // string $auth_key, 
        // string $secret, 
        // string $app_id, 
        //array $options = []
        $pusher = new Pusher(
            "928555a600410d91f730",
            "130a5b7e2b5b9171772e",
            "1567366",
            $options = [
                'cluster' => 'eu'
            ]
        );

        $delivery['company'] = Company::select('name')->where('id', $companyId)->first()['name'];
        $data = $delivery;
        $pusher->trigger('channel-name', 'App\\Events\\ayNela', $data);



        return response()->json(['message' => 'Delivery guy has been added successfully'], 200);
    }

    /**
     * for delivery to login
     * @return if success => status 201, token
     * @return if faild => status 401 , message
     */
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

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Successfully logged out',
            'df' => $request->bearerToken(),
        ], 201);
    }


    /**
     * update delivery guy status to free or busy according to the status of the invoice
     */
    public static function updateDeliveryStatus(string $orderStatus, $id)
    {
        if ($orderStatus == 'onDelivering') {
            DeliveryGuy::where('id', $id)
                ->update(['status' => 'busy']);
        } elseif ($orderStatus == 'delivered' || $orderStatus == 'cancelled' || $orderStatus == 'returned') {
            DeliveryGuy::where('id', $id)
                ->update(['status' => 'free']);
        }

        return DeliveryGuy::find($id);
    }

    /**
     * get company id by delivery id from delivery table
     */
    public static function getCompanyId($deliveryId)
    {
        return DeliveryGuy::select('companyId')
            ->where('id', $deliveryId)
            ->first()['companyId'];
    }

    public static function getDeliveryGuyId(Request $req)
    {
        // return token code
        $hashedToken = $req->bearerToken();
        // return company of this token
        $token = PersonalAccessToken::findToken($hashedToken);
        // return company id of this token
        return $token->tokenable_id;
    }

    /**
     * update delivery info by token not by id :)
     */
    public function update(Request $request, $id)
    {

        // $request->validate([
        //     'name' => 'required',
        //     'userName' => 'required|unique:companies,userName',
        //     'city' => 'required',
        //     'password' => 'required',
        //     'email' => 'required|unique:companies,email',
        // ]);




        $guy = $request->all();

        $deliveryGuy = DeliveryGuy::find($id);
        $deliveryGuy->update($request->all());
        // return $deliveryGuy;
        // return $guy;


        // ==================== v2 ===========================

        $deliveryGuy->update([
            'password' => bcrypt($guy['password']),
        ]);

        // ==================== v2 ===========================

        return response()->json([
            'message' => 'deliveryGuy has been update successfully',
            'data' => $deliveryGuy
        ], 200);
    }

    /**
     * to delete delivery guy by his id
     */
    public function
    delete($id)
    {
        // return 'delete function ';
        DeliveryGuy::destroy($id);
        // DeliveryGuy::find($id)->delete();
        // -> delete all delivery tokens
        PersonalAccessToken::where(['tokenable_id' => $id, 'name' => 'deliveryGuyToken'])->delete();

        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );

        // dd(env('PUSHER_APP_KEY'));
        // string $auth_key, 
        // string $secret, 
        // string $app_id, 
        //array $options = []
        $pusher = new Pusher(
            "372ce9a6ac87e137328d",
            "9ec51c7ad325e3e9bd64",
            "1567891",
            $options = [
                'cluster' => 'eu'
            ]
        );

        $data = 'updated';
        $pusher->trigger('channel-delete-delivery', 'App\\Events\\ayNela', $data);


        return response()->json([
            'message' => 'delivery Guy deleted',
        ], 200);
    }

    /**
     * get delivery guy information by his token
     */
    public function show(Request $req)
    {
        $data = DeliveryGuy::select()->where('id', DeliveryStaffController::getDeliveryGuyId($req))->first();
        return response()->json([
            'message' => 'delivery Guy Info',
            'data' => $data
        ], 200);
    }
}
