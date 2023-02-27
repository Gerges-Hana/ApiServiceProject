<?php

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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// test postmain
Route::get('test',function(){
    return "test";
});
// ==========


// Route for return all orders
Route::get('orders',[OrdersController::class,'show']);
Route::get('orders/{companyId}',[OrdersController::class,'index']);
Route::post('orders/add',[OrdersController::class,'storeInvoice']);


