<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function index()
    {
        return response()->json(['Binance controller']);
    }
}
