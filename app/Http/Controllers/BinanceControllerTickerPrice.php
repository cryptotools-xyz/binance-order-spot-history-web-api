<?php

namespace App\Http\Controllers;

use Http;

class BinanceControllerTickerPrice extends BinanceController
{
    public function show($symbol)
    {
        $response = Http::get("https://api.binance.com/api/v3/ticker/price?symbol=$symbol");

        return $response->json();
    }
}
