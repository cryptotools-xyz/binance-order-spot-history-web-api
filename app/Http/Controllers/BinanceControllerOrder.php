<?php

namespace App\Http\Controllers;

use Http;

class BinanceControllerOrder extends BinanceController
{
    public function show($symbol, $orderId)
    {
        $publicKey = $this->binance_api_key;
        $secretKey = $this->binance_secret_key;

        $timestamp = round(microtime(true) * 1000);

        $parameters['symbol'] = $symbol;
        $parameters['timestamp'] = $timestamp;
        $parameters['orderId'] = $orderId;
        $query = $this->buildQuery($parameters);
        $signature = $this->signature($query, $secretKey);

        $response = Http::withHeaders([
            'X-MBX-APIKEY' => $publicKey
        ])->get("https://api.binance.com/api/v3/order?symbol=$symbol&timestamp=$timestamp&signature=$signature&orderId=$orderId");

        return $response->json();
    }
}
