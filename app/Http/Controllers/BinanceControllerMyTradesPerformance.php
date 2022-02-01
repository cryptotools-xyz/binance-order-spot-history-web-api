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

        $cumulative_qty = 0;

        foreach($tradesWithOrderDataArray as $item) {
            $trade = new Trade();
            $trade->fill($item);

            $order = new Order();
            $order->fill($item['order']);
            
            $trade->setRelation('order', $order);

            $performance = new Performance();
            $cost = $trade->price * $trade->qty;
            $worth = $tickerPrice['price'] * $trade->qty;
            $percentage_change = (($worth - $cost) / $worth) * 100;
            $performance->fill([
                'cost' => $cost,
                'worth' => $worth,
                'profit' => $worth - $cost,
                'percentage_change' => $percentage_change,
                'cumulative_qty' => $cumulative_qty + $trade->qty
            ]);

            $trade->setRelation('performance', $performance);

            array_push($trades, $trade);
        }
        
        return response()->json($trades);
    }
}
