<?php

use App\Http\Controllers\Api\DeliveryStaffController;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\EmailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// protected routes
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['iscompany']], function () {
    //////////////////////////////////////////////////////////////////////////
    ///////////////////////////- COMPANY API -////////////////////////////////
    //////////////////////////////////////////////////////////////////////////
    // COMPANY ROUTES //
    Route::post('company/logout', [CompanyController::class, 'logout']);
    Route::put('company/update/{id}', [CompanyController::class, 'update']);
    Route::delete('/company/{id}', [CompanyController::class, 'delete']);

    // DELIVERY STAFF ROUTES //
    // Kyrillos => has updated this api and deleted companyid please  ====> please update Documentation 
    Route::get('/deliverystaff', [DeliveryStaffController::class, 'index']);
    Route::post('deliverystaff/add', [DeliveryStaffController::class, 'store']);
    // to delete delivery guy by his id
    Route::delete('/delivery/{id}', [DeliveryStaffController::class, 'delete']);

    // ORDERS ROUTES //
    // http://127.0.0.1:8000/api/orders
    // Route for return all orders of specific company by token
    Route::get('orders', [OrdersController::class, 'companyOrders']);
    // http://127.0.0.1:8000/api/orders/add
    // to store invoices in api services from restaurant by its token
    Route::post('orders/add', [OrdersController::class, 'storeInvoice']);
    // update invoice status and delivery status
    Route::get('comp/order/update/{invoiceId}/{status}', [OrdersController::class, 'updateStatusByComp']);

    //////////////////////////////////////////////////////////////////////////
});

Route::group(['middleware' => ['isdelivery']], function () {
    //////////////////////////////////////////////////////////////////////////
    ///////////////////////////- DELIVERY API -///////////////////////////////
    //////////////////////////////////////////////////////////////////////////

    // COMPANY ROUTES //

    // DELIVERY STAFF ROUTES //
    Route::post('delivery/logout', [DeliveryStaffController::class, 'logout']);
    // update delivery info by token -isa- buy now by id :)
    Route::put('delivery/update/{id}', [DeliveryStaffController::class, 'update']);
    // get delivery guy information by his token ====> please update Documentation 
    Route::get('delivery/info', [DeliveryStaffController::class, 'show']);

    // ORDERS ROUTES FOR COMPANY //
    // route for return all orders from resturant to his delivery by delivery token

    Route::get('orders/waiting', [OrdersController::class, 'getWaitingOrders']);
    // function update invoice status and delivery status.
    Route::get('order/update/{invoiceId}/{status}', [OrdersController::class, 'updateStatus']);
    // api to get order or orders where order status{dynamic} = ( current delivering -> onDelivering الاوردر اللي هو بيوصله حاليا) | returned | deliverd | all
    // if status is (all) return delivery orders old history of a specific delivery guy by his token
    Route::get('orders/{status}', [OrdersController::class, 'getOrdersByStatusForDeliveryGuy']);

    //////////////////////////////////////////////////////////////////////////
});

Route::group(['middleware' => ['auth:sanctum']], function () {

    // ORDERS ROUTES والله انا ماتعبتك انتو الي تعبني معاكم || دي حاجات مش تبعك يا أشرف متجربهاش عشان متتعبنيش //
    // http://127.0.0.1:8000/api/orders/{--id--}
    Route::get('orders/{companyId}', [OrdersController::class, 'index']);
    // Route for return all orders of all companies
    Route::get('allorders', [OrdersController::class, 'allOrders']);
    // routing to send wating order to delivery guy
    // http://127.0.0.1:8000/api/invoiceApi
    Route::get('allorders/waiting', [OrdersController::class, 'postInvoiceToDelivery']);
});


// public routes
// for delivery to login
Route::post('deliverystaff/login', [DeliveryStaffController::class, 'login']);


// ========================email==================================
// Route::get('send-email',[EmailController::class,'send']);
// ========================email==================================


// test postman
Route::get('test', function () {
    return "test";
});

Route::get('updateDeliveryStatus/{orderStatus}/{id}', [DeliveryStaffController::class, 'updateDeliveryStatus']);
// ==========

// ++++++++++++++++++++++company ++++++++++++++++++++++++++++++++
Route::post('company/add', [CompanyController::class, 'store']);
Route::post('company/login', [CompanyController::class, 'login']);
Route::get('company/all', [CompanyController::class, 'getCompanies']);


// ++++++++++++++++++++++end company++++++++++++++++++++++++++++++++



Route::get('send-email', [EmailController::class, 'send'])->middleware(['auth:sanctum']);



// ===================== api_token ================


// Route::middleware('auth:api')->get('gerges', function(Request $request) {
//     return $request->user();
// });
// $response = $client->request('POST', '/hana', [

//     'headers' => [
//         'Authorization' => 'Bearer '.$token,
//         'Accept' => 'application/json',
//     ],
// ]);
// ===================== api_token ================
