<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BybitRawModel extends Model
{
    //
    protected $table = 'Bybit_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('Bybit_raw')->first();
    }
}
