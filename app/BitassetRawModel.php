<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitassetRawModel extends Model
{
    //
    protected $table = 'bitasset_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('bitasset_raw')->first();
    }
}
