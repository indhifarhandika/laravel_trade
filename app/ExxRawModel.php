<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExxRawModel extends Model
{
    //
    protected $table = 'exx_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('exx_raw')->first();
    }
}
