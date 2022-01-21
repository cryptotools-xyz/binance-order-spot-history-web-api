<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Binance\Trade;
use App\Models\Binance\Order;
use Http;

class BinanceControllerMyTradesWithOrder extends BinanceController
{
    public function index($symbol)
    {
        $tradesData = (new BinanceControllerMyTrades)->index($symbol);
        
        $trades = [];

        foreach($tradesData as $item) {
            $trade = new Trade();
            $trade->fill($item);

            $orderData = (new BinanceControllerOrder)->show($trade->symbol, $trade->orderId);
            
            Log::info($orderData, ['symbol' => $trade->symbol, 'orderId' => $trade->orderId]);

            $order = new Order();
            $order->fill($orderData);
            
            $trade->setRelation('order', $order);

            array_push($trades, $trade);
        }
        
        return response()->json($trades);
    }
}
