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

    // http://127.0.0.1:8000/api/posts/{--id--}
    Route::get('orders/{companyId}', [OrdersController::class, 'index']);

    // http://127.0.0.1:8000/api/orders/add
    Route::post('orders/add', [OrdersController::class, 'storeInvoice']);

    // routing to send wating order to delivery guy
    // http://127.0.0.1:8000/api/invoiceApi
    Route::get('invoiceApi',[OrdersController::class, 'postInvoiceToDelivery']);
});


// public routes
Route::post('deliverystaff/login', [DeliveryStaffController::class, 'login']);

// test postman
Route::get('test', function () {
    return "test";
});
// ==========
