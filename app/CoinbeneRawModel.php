<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoinbeneRawModel extends Model
{
    //
    protected $table = 'coinbene_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('coinbene_raw')->first();
    }
}
