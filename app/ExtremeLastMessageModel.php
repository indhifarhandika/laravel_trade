<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtremeLastMessageModel extends Model
{
    //
    protected $table = 'extremelastmessage';
    public $timestamps = false;

    public static function getAllRates() {
    return DB::table('extremelastmessage')->first();
  }
}
