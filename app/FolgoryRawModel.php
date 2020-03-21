<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FolgoryRawModel extends Model
{
    //
    protected $table = 'folgory_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('folgory_raw')->first();
    }
}
