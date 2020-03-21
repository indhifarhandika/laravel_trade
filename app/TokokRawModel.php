<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokokRawModel extends Model
{
    //
    protected $table = 'tokok_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('tokok_raw')->first();
    }
}
