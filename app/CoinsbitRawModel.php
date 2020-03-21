<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoinsbitRawModel extends Model
{
    //
    protected $table = 'coinsbit_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('coinsbit_raw')->first();
    }
}