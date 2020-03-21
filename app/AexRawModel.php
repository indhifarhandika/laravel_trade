<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AexRawModel extends Model
{
    //
    protected $table = 'aex_raw';
    public $timestamps = false;

    public static function getAllRates() {
    return DB::table('aex_raw')->first();
  }
}
