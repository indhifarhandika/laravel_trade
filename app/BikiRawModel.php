<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BikiRawModel extends Model
{
    //
    protected $table = 'biki_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('biki_raw')->first();
    }
}
