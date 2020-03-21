<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indodaxCoin extends Model
{
    //
    protected $table = 'indodax_coinlist';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('indodax_coinlist')->first();
    }
}
