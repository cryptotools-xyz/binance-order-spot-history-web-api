<?php

namespace App\Http\Controllers;

use Http;

class BinanceControllerMyTrades extends BinanceController
{
    public function index($symbol)
    {
        $publicKey = $this->binance_api_key;
        $secretKey = $this->binance_secret_key;

        $timestamp = round(microtime(true) * 1000);

        $parameters['symbol'] = $symbol;
        $parameters['timestamp'] = $timestamp;
        $query = $this->buildQuery($parameters);
        $signature = $this->signature($query, $secretKey);

        $response = Http::withHeaders([
            'X-MBX-APIKEY' => $publicKey
        ])->get("https://api.binance.com/api/v3/myTrades?symbol=$symbol&timestamp=$timestamp&signature=$signature");

        return $response->json();
    }
}
