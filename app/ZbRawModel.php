<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZbRawModel extends Model
{
    //
    protected $table = 'zb_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('zb_raw')->first();
    }
}
