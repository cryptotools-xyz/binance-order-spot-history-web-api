<?php

namespace App\Http\Controllers;

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

    protected function signature($query_string, $secret) {
        return hash_hmac('sha256', $query_string, $secret);
    }

    protected function buildQuery(array $params)
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
}
