<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BinanceController;

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

Route::get('/my-trades/{symbol}', [BinanceController::class, 'index']);
Route::get('/all-orders/{symbol}', [BinanceController::class, 'index2']);
Route::get('/order/{symbol}/{orderId}', [BinanceController::class, 'show']);