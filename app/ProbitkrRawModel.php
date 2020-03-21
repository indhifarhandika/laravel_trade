<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProbitkrRawModel extends Model
{
    //
    protected $table = 'probitkr_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('probitkr_raw')->first();
    }
}
