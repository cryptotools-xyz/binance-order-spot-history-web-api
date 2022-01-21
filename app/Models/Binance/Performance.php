<?php

namespace App\Models\Binance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;

    protected $fillable = ['buy_price', 'current_price', 'percentage_change'];
}