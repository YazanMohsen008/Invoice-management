<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::post('/login', [UserController::class, 'login'])->name("login");
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'invoice'], function () {
        Route::post('/add', [InvoiceController::class, 'add']);
        Route::post('/update', [InvoiceController::class, 'update']);
        Route::get('/search', [InvoiceController::class, 'search']);
        Route::get('/all', [InvoiceController::class, 'all']);
        Route::get('/delete/{id}', [InvoiceController::class, 'delete']);
        Route::get('/{id}', [InvoiceController::class, 'byId']);
    });
    Route::get('/customers/all', [CustomerController::class, 'getAll']);
    Route::get('/products/all', [ProductController::class, 'getAll']);
});
