<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigoneRawModel extends Model
{
    //
    protected $table = 'bigone_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('bigone_raw')->first();
    }
}
