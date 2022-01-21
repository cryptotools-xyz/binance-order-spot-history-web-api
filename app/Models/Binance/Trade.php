<?php

namespace App\Models\Binance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = ['symbol', 'id', 'orderId', 'orderListId', 'price', 'qty', 'quoteQty', 'commission', 'commissionAsset', 'time', 'isBuyer', 'isMaker', 'isBestMatch'];

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function performance()
    {
        return $this->hasOne(Performance::class);
    }
}