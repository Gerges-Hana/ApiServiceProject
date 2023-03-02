<?php

use App\Http\Controllers\Api\DeliveryStaffController;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrdersController;

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

Route::group(['middleware' => ['auth:sanctum']], function () {
    // DELIVERY STAFF ROUTES FOR COMPANY //
    Route::get('/deliverystaff/{companyId}', [DeliveryStaffController::class, 'index']);
    Route::post('deliverystaff/add', [DeliveryStaffController::class, 'store']);

    // ORDERS ROUTES //
    // Route for return all orders
    Route::get('orders', [OrdersController::class, 'show']);
    Route::get('orders/{companyId}', [OrdersController::class, 'index']);
    Route::post('orders/add', [OrdersController::class, 'storeInvoice']);
});



// public routes
Route::post('deliverystaff/login', [DeliveryStaffController::class, 'login']);

Route::get('order/update/{invoiceId}/{status}', [OrdersController::class, 'updateStatus']);

// test postman
Route::get('test', function () {
    return "test";
});
// ==========
