<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\fee2;

class ruteHuobi extends Controller
{
    public function ruteHuobi(){

        $modal       = 10000000;
        $jualan      = array();

        $Fee         = fee2::get();
        $FeeArray    = array();

        foreach ($Fee as $feePecah) {
            $FeeArray[$feePecah['shop_name']][$feePecah['commodity']] = $feePecah['amount'];
            
        }

        $getcoinname = DB::connection('mysql3')->table('pairlist_indodax')->select()->get();

        foreach ($getcoinname as $percoin) {
            $code                           = $percoin->pair;
            $pecahcode                      = explode('_', $code);
            $coinname                       = $pecahcode[0];
            $marketname                     = 'indodax_' . $code;

            //Buy Indodax
            $buycalculate                   = $this->Buy($marketname,$modal);
            $totalAmount                    = $buycalculate['TotalAmount'];
            $listcoin[$coinname]['buy']     = $totalAmount - $FeeArray['indodax'][$coinname];
            $jualan[$coinname]['buy']       = $totalAmount - $FeeArray['indodax'][$coinname];

        }
        
        $gethuobimarket = DB::connection('mysql3')->table('pairlist_huobi')->select()->get();
        foreach ($gethuobimarket as $huobimarket) {
            $pecahcode                      = explode('_', $huobimarket->pair);
            $huobicoinname                  = $pecahcode[0];
            $marketnamehuobi                = 'huobi_' . $huobimarket->pair;
            $modalsell                      = $listcoin[$huobicoinname]['buy'];

            //Sell to Huobi
            $sell                           = $this->Sell($marketnamehuobi,$modalsell); 
            $totalsell                      = $sell['TotalAmount'];
            $columnname                     = 'huobi_' .$pecahcode[1];    
            $listcoin[$coinname]['sell']    = $totalsell - $FeeArray['huobi'][$pecahcode[1]];
            $jualan[$huobicoinname]['sell'] = $totalsell - $FeeArray['huobi'][$pecahcode[1]];

            $jual                           = $this->Sell('indodax_'.$pecahcode[1].'_idr',$jualan[$huobicoinname]['sell']);
            $totalJual                      = $jual['TotalAmount'];
            $jualan[$huobicoinname]['jual'] = $totalJual;
            // echo $pesan;
            if($jualan[$huobicoinname]['jual'] > 10100000){
                $pesan                          = 'Update Terbaru !! %0A%0A<b> '.$huobicoinname.' </b>%0A Beli = '.$jualan[$huobicoinname]['buy'].'%0A Dapat USDT = '.$jualan[$huobicoinname]['sell'].'%0A Jual USDT = '.$jualan[$huobicoinname]['jual'].'%0A';
                // $this->Telegram($pesan);
            }
        }
        // $pesan                  = 'Update Terbaru !! %0A%0A<b> ETH </b>%0A Beli = '.$jualan['eth']['buy'].'%0A Dapat USDT = '.$jualan['eth']['sell'].'%0A Jual USDT = '.$jualan['eth']['jual'].'%0A<b> Vidy </b>%0A Beli = '.$jualan['vidy']['buy'].'%0A Dapat USDT = '.$jualan['vidy']['sell'].'%0A Jual USDT = '.$jualan['vidy']['jual'].'%0A<b> Vsys </b>%0A Beli = '.$jualan['vsys']['buy'].'%0A Dapat USDT = '.$jualan['vsys']['sell'].'%0A Jual USDT = '.$jualan['vsys']['jual'].'%0A<b> CRO </b>%0A Beli = '.$jualan['cro']['buy'].'%0A Dapat USDT = '.$jualan['cro']['sell'].'%0A Jual USDT = '.$jualan['cro']['jual'].'%0A';
        // print_r($jualan);
        return $jualan;
    }

    public function Buy($table, $modal){
        $getDBBuy = DB::connection('mysql3')->table($table)->select('price','amount','total')
                                    ->where('type', '=', 'jual')
                                    // ->OrderBy('price', 'ASC')
                                    ->get();
        $capital    =   $modal;
        $fee_trade  =   0.997;
        $x          =   0;
        $result     = array();
        while($capital >= 0){
            echo 'Modal Awal '.$table.' = '.$capital.' Total Buy = '.$getDBBuy[$x]->total.' X = '.$x.'<br>';
            $capital            =   $capital - $getDBBuy[$x]->total;
            $rest               =   $capital + $getDBBuy[$x]->total;  
            echo 'Rest Awal '.$table.' = '.$rest.' Total Buy = '.$getDBBuy[$x]->total.' X = '.$x.'<hr>';
            if($capital <= 0){
                $result[$x]['price']      =   $getDBBuy[$x]->price;
                $result[$x]['total']      =   $rest;
                $result[$x]['amount']     =   $rest / $getDBBuy[$x]->price;
            }else{
                $result[$x]['price']      =    $getDBBuy[$x]->price;
                $result[$x]['total']      =    $getDBBuy[$x]->total;
                $result[$x]['amount']     =    $getDBBuy[$x]->amount;
            }
            $x++;
        }
        // print_r($result);
        $hitung     = collect($result);
        $totalAmount = $hitung->sum('amount');
        $totalTotal = $hitung->sum('total');
        $result['TotalAmount']  = $totalAmount * $fee_trade;
        $result['TotalTotal']   = $totalTotal;
        
        return $result;
    }
    public function Sell($table, $modal){
        echo '<hr>'.$table.' oh '.$modal.'<hr>';
        $getDBSell = DB::connection('mysql3')->table($table)->select('price','amount','total')
                                    ->where('type', '=', 'beli')
                                    // ->OrderBy('price', 'ASC')
                                    ->get();
        $capital    =   $modal;
        $fee_trade  =   0.997;
        $x          =   0;
        $cekTable   =   explode('_',$table);
        $cekMarket  =   $cekTable[0];
        $result     =   array();
        while($capital >= 0){
            echo 'Modal Awal = '.$capital.'<br>';
            echo 'Total Awal = '.$getDBSell[$x]->total.'<br>';
            $capital            =   $capital - $getDBSell[$x]->total;
            $rest               =   $capital + $getDBSell[$x]->total;  
            // echo 'Capitale = '.$capital. ' - '.$getDBSell[$x]->total.' <==> Rest = '.$rest.'<br>';
            if($capital <= 0){
                $result[$x]['price']      =   $getDBSell[$x]->price;
                $result[$x]['total']      =   $rest;
                $result[$x]['amount']     =   $rest * $getDBSell[$x]->price;
            }else{
                $result[$x]['price']      =    $getDBSell[$x]->price;
                $result[$x]['total']      =    $getDBSell[$x]->total;
                if($cekMarket == 'huobi'){
                    $result[$x]['amount']     =    $getDBSell[$x]->price*$getDBSell[$x]->amount;
                }else{
                    $result[$x]['amount']     =    $getDBSell[$x]->amount;
                }
            }
            echo $table.' Price => '.$result[$x]['price'].' Amount => '.$result[$x]['amount'].' Total => '.$result[$x]['total'].'<br>';
            $x++;
        }
        $hitung     = collect($result);
        $totalAmount = $hitung->sum('amount');
        $totalTotal = $hitung->sum('total');
        if($table == 'indodax_usdt_idr' ){
            $result['TotalAmount']  = $totalAmount;
        }else{
            $result['TotalAmount']  = $totalAmount*$fee_trade;
        }
        $result['TotalTotal']   = $totalTotal;
        // echo 'TotalAmount ==> '.$totalAmount.' TotalAmount ==> '.$totalAmount* $fee_trade.' ';
        // echo 'TotalTotal ==> '.$totalTotal.'<hr>';
        return $result;
    }
}
