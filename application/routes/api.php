<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->group(function () {
    Route::controller(ProductsController::class)->group(function () {
        Route::get('/list-all', 'listAll');
    });
});

Route::prefix('sales')->group(function () {
    Route::controller(SalesController::class)->group(function () {
        Route::post('/process-sale', 'processSale');
        Route::patch('/canceled-sale/{id}', 'canceledSale');

    });
});