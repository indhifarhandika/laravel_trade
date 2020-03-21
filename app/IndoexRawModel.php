<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndoexRawModel extends Model
{
    //
    protected $table = 'indoex_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('indoex_raw')->first();
    }
}
