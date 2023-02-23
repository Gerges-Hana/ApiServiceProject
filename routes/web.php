<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;


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


Route::get('/companies', [CompaniesController::class, 'index'])->name('companies');

Route::get('/addCompany', [CompaniesController::class, 'create'])->name('addCompany');

Route::post('/storeCompany', [CompaniesController::class, 'store'])->name('company.store');

Route::get('/orders', function () { return view('orders'); })->name('orders');

Route::get('/delivery-staff', function () { return view('delivery-staff'); })->name('deliveryStaff');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
