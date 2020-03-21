<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LastMessageModel extends Model
{
    //
    protected $table = 'lastmessage';
    public $timestamps = false;

    public static function getAllRates() {
    return DB::table('lastmessage')->first();
  }
}
