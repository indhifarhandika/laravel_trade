<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HitbtcRawModel extends Model
{
    //
    protected $table = 'hitbtc_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('hitbtc_raw')->first();
    }
}
