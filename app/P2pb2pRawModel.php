<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P2pb2pRawModel extends Model
{
    //
    protected $table = 'p2pb2b_raw';
    public $timestamps = false;

    public static function getAllRates() {
        return DB::table('p2pb2b_raw')->first();
    }
}
