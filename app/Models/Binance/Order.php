<?php

namespace App\Models\Binance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['symbol', 'orderId', 'orderListId', 'clientOrderId', 'price', 'origQty', 'executedQty', 'cummulativeQuoteQty', 'status', 'timeInForce', 'type', 'side', 'stopPrice', 'icebergQty', 'time', 'updateTime', 'isWorking', 'origQuoteOrderQty'];
}