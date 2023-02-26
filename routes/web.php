<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\OrdersController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();

Route::get('/', function () {
    return view('dashboard');
});


Route::get('/companies', [CompaniesController::class, 'getAllCompanies'] )->name('companies');

Route::get('/orders', [OrdersController::class, 'getAllOrders'] )->name('orders');

Route::get('/delivery-staff', function () { return view('delivery-staff'); })->name('deliveryStaff');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
