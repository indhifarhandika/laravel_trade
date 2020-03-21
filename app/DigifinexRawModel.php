<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DigifinexRawModel extends Model
{
    //
    protected $table = 'digifinex_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('digifinex_raw')->first();
    }
}
