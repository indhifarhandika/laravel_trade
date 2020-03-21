<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OkexRawModel extends Model
{
    //
    protected $table = 'okex_raw';
    public $timestamps = false;

    public static function getAllRates() {
    return DB::table('okex_raw')->first();
  }
}
