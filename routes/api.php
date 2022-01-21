<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BinanceControllerMyTrades;
use App\Http\Controllers\BinanceControllerAllOrders;
use App\Http\Controllers\BinanceControllerOrder;
use App\Http\Controllers\BinanceControllerMyTradesWithOrder;
use App\Http\Controllers\BinanceControllerTickerPrice;
use App\Http\Controllers\BinanceControllerMyTradesPerformance;

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

Route::get('/my-trades/{symbol}', [BinanceControllerMyTrades::class, 'index']);

Route::get('/all-orders/{symbol}', [BinanceControllerAllOrders::class, 'index']);

Route::get('/order/{symbol}/{orderId}', [BinanceControllerOrder::class, 'show']);

Route::get('/my-trades/{symbol}/with-order', [BinanceControllerMyTradesWithOrder::class, 'index']);

Route::get('/ticker/price/{symbol}', [BinanceControllerTickerPrice::class, 'show']);

Route::get('/my-trades-performance/{symbol}', [BinanceControllerMyTradesPerformance::class, 'index']);