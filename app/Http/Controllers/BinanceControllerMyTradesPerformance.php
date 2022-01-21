<?php

namespace App\Http\Controllers;

use App\Models\Binance\Trade;
use App\Models\Binance\Order;
use App\Models\Binance\Performance;
use Http;

class BinanceControllerMyTradesPerformance extends BinanceController
{
    public function index($symbol)
    {
        $tradesWithOrderData = (new BinanceControllerMyTradesWithOrder)->index($symbol);

        $tradesWithOrderDataArray = json_decode($tradesWithOrderData->content(), true);

        $tickerPrice = (new BinanceControllerTickerPrice)->show($symbol);

        $trades = [];

        foreach($tradesWithOrderDataArray as $item) {
            $trade = new Trade();
            $trade->fill($item);

            $order = new Order();
            $order->fill($item['order']);
            
            $trade->setRelation('order', $order);

            $performance = new Performance();
            $buy_price = $trade->price * $trade->qty;
            $current_price = $tickerPrice['price'] * $trade->qty;
            $percentage_change = (($current_price - $buy_price) / $current_price) * 100;
            $performance->fill([
                'buy_price' => $buy_price,
                'current_price' => $current_price,
                'percentage_change' => $percentage_change
            ]);

            $trade->setRelation('performance', $performance);

            array_push($trades, $trade);
        }
        
        return response()->json($trades);
    }
}
