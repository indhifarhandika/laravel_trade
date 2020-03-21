<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BittrueRawModel extends Model
{
    //
    protected $table = 'bittrue_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('bittrue_raw')->first();
    }
}
