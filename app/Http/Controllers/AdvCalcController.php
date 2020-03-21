<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvCalcController extends Controller
{
    
    public function saveCoin($table,$buy,$sell){
        // $area = json_decode(Input::get('data'), true);

        // $table = Input::get('nama_table');
        // $buy = Input::get('buy');
        // $sell = Input::get('sell');

        // return $table;
        // $table      = 'huobi_act_usdt';
        // $buy        = '51x276911.490y12836756z50x391332.48y19566624z49x558437.89y27363457z48x1710238.45y82091446z47x206382.97y9700000';
        // $sell       = '52x277062.90y14407271z53x60531.149y19282667z54x18710.662y10548728z55x259067y14248728z56x202732.664y11353029';
        $arrBuy     = array();
        $arrSell    = array();
        $x          = 0;
        $y          = 0;

        //Parse Data Buy
        $pecah_buy  = explode('z',$buy);
        foreach($pecah_buy as $pecah){
            $pecah_price            = explode('x',$pecah);
            $pecah_amount           = explode('y',$pecah_price[1]);
            $arrBuy[$x]['price']    = $pecah_price[0];
            $arrBuy[$x]['amount']   = $pecah_amount[0];
            $arrBuy[$x]['total']    = $pecah_amount[1];
            $arrBuy[$x]['type']     = 'beli';
            $x++;
        }
        //Parse Data Sell
        $pecah_sell = explode('z',$sell);
        foreach($pecah_sell as $pecah){
            $pecah_price    = explode('x',$pecah);
            $pecah_amount   = explode('y',$pecah_price[1]);
            $arrSell[$y]['price']    = $pecah_price[0];
            $arrSell[$y]['amount']   = $pecah_amount[0];
            $arrSell[$y]['total']    = $pecah_amount[1];
            $arrSell[$y]['type']     = 'jual';
            $y++;
        }

        //Save to Database
        // return count($pecah_buy);
        $checktable         = Schema::connection('mysql3')->hasTable($table);
        if ($checktable == 1) 
        {
            DB::connection('mysql3')->table($table)->truncate();
            DB::connection('mysql3')->table($table)->insert($arrBuy);
            DB::connection('mysql3')->table($table)->insert($arrSell);
        }else{
            DB::connection('mysql3')->statement( 'create table '.$table.' like indodax_act_idr');
            DB::connection('mysql3')->table($table)->truncate();
            DB::connection('mysql3')->table($table)->insert($arrBuy);
            DB::connection('mysql3')->table($table)->insert($arrSell);
        }

    }
}
