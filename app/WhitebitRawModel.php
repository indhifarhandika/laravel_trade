<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WhitebitRawModel extends Model
{
    //
    protected $table = 'whitebit_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('whitebit_raw')->first();
    }
}
