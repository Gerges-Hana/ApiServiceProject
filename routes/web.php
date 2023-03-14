<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\DashboardController;


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


// Route::get('/', function () {
//     return view('dashboard');
// });
// company routes


Route::get('/', [DashboardController::class, 'index'])->name('companies.dashboard');
Route::get('/companies', [CompaniesController::class, 'index'])->name('companies');

Route::get('/addCompany', [CompaniesController::class, 'create'])->name('addCompany');

Route::post('/storeCompany', [CompaniesController::class, 'store'])->name('company.store');
Route::delete('/company/{id}',[CompaniesController::class ,'delete'])->name('company.delete');

Route::get('/company-search', [CompaniesController::class,'search'])->name('companies-search');

//order routes

Route::get('/orders', [OrdersController::class, 'getAllOrders'] )->name('orders');
Route::get('/orders-waiting', [OrdersController::class, 'waitingOrders'] )->name('orders-waiting');
Route::get('/orders-delivered', [OrdersController::class, 'deliveredOrders'] )->name('orders-delivered');
Route::get('/orders-canceled', [OrdersController::class, 'canceledOrders'] )->name('orders-canceled');
Route::get('/orders-returned', [OrdersController::class, 'returnedOrders'] )->name('orders-returned');
Route::get('/orders-onDelivering', [OrdersController::class, 'onDeliveringOrders'] )->name('orders-onDelivering');
Route::get('/orders-search', [OrdersController::class, 'orderSearch'] )->name('orderSearch');




//Delivery routes 
Route::get('/delivery-staff', [DeliveryController::class, 'index'] )->name('d.deliveryStaff');
Route::get('/delivery-free', [DeliveryController::class, 'deliveryGuysFree'] )/*->name('d.deliveryStaff')*/;
Route::get('/delivery-busy', [DeliveryController::class, 'deliveryGuysBusy'] )/*->name('d.deliveryStaff')*/;
Route::get('/delivery-search', [DeliveryController::class, 'deliverySearchByCompanyName'] )->name('delivery-search');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
