<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitmaxRawModel extends Model
{
    //
    protected $table = 'bitmax_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('bitmax_raw')->first();
    }
}
