<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HuobiRawModel extends Model
{
    //
    protected $table = 'huobi_raw';
    public $timestamps = false;

    public static function getAllRates() {
    return DB::table('huobi_raw')->first();
  }
}
