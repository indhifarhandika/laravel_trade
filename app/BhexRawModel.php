<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BhexRawModel extends Model
{
    //
    protected $table = 'bhex_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('bhex_raw')->first();
    }
}
