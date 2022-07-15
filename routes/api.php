<?php

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


Route::get('products', [\App\Http\Controllers\ProductController::class, 'index']);


Route::get('me', [\App\Http\Controllers\CustomerController::class, 'me']);
Route::get('orders/{orderNumber}', [\App\Http\Controllers\OrderController::class, 'show']);
Route::get('orders', [\App\Http\Controllers\OrderController::class, 'index']);
Route::post('order', [\App\Http\Controllers\OrderController::class, 'store']);
