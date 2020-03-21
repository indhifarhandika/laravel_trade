<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BkexRawModel extends Model
{
    //
    protected $table = 'bkex_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('bkex_raw')->first();
    }
}
