<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndodaxRawModel extends Model
{
    //
    protected $table = 'indodax_raw';
    public $timestamps = false;

    public static function getAllRates() {
      return DB::table('indodax_raw')->first();
    }
}
