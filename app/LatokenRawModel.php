<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LatokenRawModel extends Model
{
    //
    protected $table = 'latoken_raw';
    public $timestamps = false;

    public static function getAllRates() {
    return DB::table('latoken_raw')->first();
  }
}
