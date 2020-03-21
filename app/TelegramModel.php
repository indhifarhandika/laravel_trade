<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelegramModel extends Model
{
    //
    protected $table = 'telegram';
    public $timestamps = false;

    public static function getAllRates() {
    return DB::table('telegram')->first();
  }
}
