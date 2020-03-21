<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CointigerRawModel extends Model
{
    //
    protected $table = 'cointiger_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('cointiger_raw')->first();
    }
}
