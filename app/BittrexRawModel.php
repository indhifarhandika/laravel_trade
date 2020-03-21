<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BittrexRawModel extends Model
{
    //
    protected $table = 'bittrex_raw';
    public $timestamps = false;

    public static function getAllRates() {
    return DB::table('bittrex_raw')->first();
  }
}
