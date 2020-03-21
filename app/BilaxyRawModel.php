<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BilaxyRawModel extends Model
{
    //
    protected $table = 'bilaxy_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('bilaxy_raw')->first();
    }
}
