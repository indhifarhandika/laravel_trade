<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VindaxRawModel extends Model
{
    //
    protected $table = 'vindax_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('vindax_raw')->first();
    }
}
