<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DcoinRawModel extends Model
{
    //
    protected $table = 'dcoin_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('dcoin_raw')->first();
    }
}
