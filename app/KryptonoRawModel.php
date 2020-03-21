<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KryptonoRawModel extends Model
{
    //
    protected $table = 'kryptono_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('kryptono_raw')->first();
    }
}
