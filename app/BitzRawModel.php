<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitzRawModel extends Model
{
    //
    protected $table = 'bitz_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('bitz_raw')->first();
    }
}
