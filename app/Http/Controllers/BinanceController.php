<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BinanceController extends Controller
{
    public function index()
    {
        return response()->json(['Binance controller']);
    }
}
