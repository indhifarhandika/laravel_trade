<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiquidRawModel extends Model
{
    //
    protected $table = 'liquid_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('liquid_raw')->first();
    }
}
