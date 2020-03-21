<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoinexRawModel extends Model
{
    //
    protected $table = 'coinex_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('coinex_raw')->first();
    }
}
