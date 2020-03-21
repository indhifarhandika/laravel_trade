<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BinanceRawModel extends Model
{
    //
    protected $table = 'binance_raw';
    public $timestamps = false;

    public static function getAllRates() {
    return DB::table('binance_raw')->first();
  }
}
