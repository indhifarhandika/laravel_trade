<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CryptonexRawModel extends Model
{
    //
    protected $table = 'cryptonex_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('cryptonex_raw')->first();
    }
}
