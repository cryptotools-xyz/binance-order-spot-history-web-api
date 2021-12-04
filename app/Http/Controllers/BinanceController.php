<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;
use Exception;

class BinanceController extends Controller
{
    protected $binance_api_key;
    protected $binance_secret_key;

    public function __construct()
    {
        $this->binance_api_key = env('BINANCE_API_KEY');
        $this->binance_secret_key = env('BINANCE_SECRET_KEY');

        if(empty($this->binance_api_key) || empty($this->binance_secret_key)) {
            throw new Exception("BINANCE_API_KEY and BINANCE_SECRET_KEY are required");
        }
    }

    private function signature($query_string, $secret) {
        return hash_hmac('sha256', $query_string, $secret);
    }

    private function buildQuery(array $params)
    {
        $query_array = array();
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $query_array = array_merge($query_array, array_map(function ($v) use ($key) {
                    return urlencode($key) . '=' . urlencode($v);
                }, $value));
            } else {
                $query_array[] = urlencode($key) . '=' . urlencode($value);
            }
        }
        return implode('&', $query_array);
    }

    public function myTrades($symbol)
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

        return $data = $response->json();
    }

    public function allOrders($symbol)
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
        ])->get("https://api.binance.com/api/v3/allOrders?symbol=$symbol&timestamp=$timestamp&signature=$signature");

        return $data = $response->json();
    }

    public function order($symbol, $orderId)
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

        return $data = $response->json();
    }
}
