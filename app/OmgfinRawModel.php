<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OmgfinRawModel extends Model
{
    //
    protected $table = 'omgfine_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('omgfine_raw')->first();
    }
}
