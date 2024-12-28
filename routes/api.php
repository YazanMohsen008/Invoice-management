<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/invoice/add',[InvoiceController::class,'add']);
Route::post('/invoice/update',[InvoiceController::class,'update']);
Route::get('/invoice/search',[InvoiceController::class,'search']);
Route::get('/invoice/all',[InvoiceController::class,'all']);
Route::get('/invoice/delete/{id}',[InvoiceController::class,'delete']);
Route::get('/invoice/{id}',[InvoiceController::class,'byId']);

Route::get('/customers/all',[CustomerController::class,'getAll']);
Route::get('/products/all',[ProductController::class,'getAll']);
