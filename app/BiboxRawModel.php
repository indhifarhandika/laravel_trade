<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiboxRawModel extends Model
{
    //
    protected $table = 'bibox_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('bibox_raw')->first();
    }
}
