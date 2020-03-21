<?php

namespace App\Http\Controllers;

use App\CalcSyncModel;
use App\CalcBinanceModel;

use App\BinanceRawModel;
use App\IndodaxRawModel;
use App\BittrexRawModel;
use App\OkexRawModel;
use App\AexRawModel;
use App\HuobiRawModel;
use App\CoinsbitRawModel;
use App\FolgoryRawModel;
use App\BilaxyRawModel;
use App\BkexRawModel;
use App\BitzRawModel;
use App\P2pb2pRawModel;
use App\ProbitkrRawModel;
use App\BiboxRawModel;
use App\LatokenRawModel;
use App\CoinbeneRawModel;
use App\DigifinexRawModel;
use App\BhexRawModel;
use App\HitbtcRawModel;
use App\CointigerRawModel;
use App\ExxRawModel;
use App\TokokRawModel;

use Illuminate\Http\Request;

class CalcSyncController extends Controller
{
    //
    public function BinanceData() {
        

        $querry = BinanceRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $bnbidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'bnbidr')->get();
        $bnbidr = $bnbidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        $usdtbtc = BinanceRawModel::select('lastprice')->where('coinname', '=', 'BTCUSDT')->get();
        $usdtbtc = $usdtbtc[0]['lastprice'];

        $usdteth = BinanceRawModel::select('lastprice')->where('coinname', '=', 'ETHUSDT')->get();
        $usdteth = $usdteth[0]['lastprice'];

       
        
        foreach ($querry as $filter) {
            $str = substr($filter['coinname'], -3);
            $str4 = substr($filter['coinname'], -4);

            if ($str == 'BTC') {
                $coinlist = $filter['coinname'];
                $coinname = substr($coinlist, 0, -3);

                $lastprice = $filter['lastprice'] * $btcidr;

                $binance_price = $filter['lastprice'] * $usdtbtc;
                
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['binance_btc' => $lastprice]);


                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->binance_btc = $lastprice;
                    $insert->save();
                } 
                
            }
        

            if ($str == 'BNB') {
                $coinlist = $filter['coinname'];
                $coinname = substr($coinlist, 0, -3);
                $lastprice = $filter['lastprice'] * $bnbidr;

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['binance_bnb' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->binance_bnb = $lastprice;
                    $insert->save();
                }                         
            }

            if ($str == 'ETH') {
                $coinlist = $filter['coinname'];
                $coinname = substr($coinlist, 0, -3);
                $lastprice = $filter['lastprice'] * $ethidr;

                $binance_price = $filter['lastprice'] * $usdteth;
                

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['binance_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->binance_eth = $lastprice;
                    $insert->save();
                }       

            }

            if ($str4 == 'USDT') {
                $coinlist = $filter['coinname'];
                $coinname = substr($coinlist, 0, -4);
                $lastprice = $filter['lastprice'] * $usdtidr;
                

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['binance_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->binance_usdt = $lastprice;
                    $insert->save();
                }                         
            }

            if ($str4 == 'TUSD') {
                $coinlist = $filter['coinname'];
                $coinname = substr($coinlist, 0, -4);
                $lastprice = $filter['lastprice'];
                

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['binance_tusd' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->binance_tusd = $lastprice;
                    $insert->save();
                }                         
            }
        }
        echo 'Success Sync Binance Data';
    }

    public function HuobiData() {

        $querry = HuobiRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $str = substr($filter['coinname'], -3);
            $str4 = substr($filter['coinname'], -4);

            if ($str == 'btc') {
                $coinlist = $filter['coinname'];
                $coinname = substr($coinlist, 0, -3);
                $coinname = strtoupper($coinname);

                $lastprice = $filter['lastprice'];
                $lastprice = $lastprice * $btcidr;
                
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['huobi_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->huobi_btc = $lastprice;
                    $insert->save();
                }                         
            }

            if ($str == 'eth') {
                $coinlist = $filter['coinname'];
                $coinname = substr($coinlist, 0, -3);
                $coinname = strtoupper($coinname);

                $lastprice = $filter['lastprice'];
                $lastprice = $lastprice * $ethidr;
                
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['huobi_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->huobi_eth = $lastprice;
                    $insert->save();
                }                         
            }

            if ($str4 == 'usdt') {
                $coinlist = $filter['coinname'];
                $coinname = substr($coinlist, 0, -4);
                $coinname = strtoupper($coinname);

                $lastprice = $filter['lastprice'];
                $lastprice = $lastprice * $usdtidr;
                
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['huobi_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->huobi_usdt = $lastprice;
                    $insert->save();
                }                         
            }
        }



    }


    public function OkexData() {

        $querry = OkexRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $str = explode('_', $filter['coinname']);
            $coinname = $str[0];
            $coinname = strtoupper($coinname);
            $lastprice = $filter['lastprice'];
           
            if ($str[1] == 'btc') {

                $lastprice = $lastprice * $btcidr;
                
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['okex_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->okex_btc = $lastprice;
                    $insert->save();
                }                         
            }     

            if ($str[1] == 'eth') {

                $lastprice = $lastprice * $ethidr;
                
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['okex_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->okex_eth = $lastprice;
                    $insert->save();
                }                         
            }     

            if ($str[1] == 'usdt') {

                $lastprice = $lastprice * $usdtidr;
                
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['okex_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->okex_usdt = $lastprice;
                    $insert->save();
                }                         
            }     
        }





    }

    public function IndodaxData() {
        $querry = IndodaxRawModel::select()->get();

        foreach ($querry as $filter) {
            $str = substr($filter['coinname'], -3);
            $str4 = substr($filter['coinname'], -4);
            echo $filter.' ==> '.$str.' ==> '.$str4.' Sebelum IF <br><br>';

            if ($str == 'idr') {
                $coinlist = $filter['coinname'];
                $coinname = substr($coinlist, 0, -3);
                $coinname = strtoupper($coinname);
                $lastprice = $filter['lastprice'];
                echo $coinlist.' ==> '.$coinname.' ==> '.$lastprice.' Dalam IF idr<hr>';
                
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['indodax_idr' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->indodax_idr = $lastprice;
                    $insert->save();
                }                         
            }

            if ($str == 'btc') {
                $coinlist = $filter['coinname'];
                $coinname = substr($coinlist, 0, -3);
                $coinname = strtoupper($coinname);
                $lastprice = $filter['lastprice'];
                echo $coinlist.' ==> '.$coinname.' ==> '.$lastprice.' Dalam IF btc<hr>';
                
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['indodax_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->indodax_btc = $lastprice;
                    $insert->save();
                }                         
            }
        }
    }

    public function AexData() {

        $querry = AexRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        $cnc2idr = AexRawModel::select('lastprice')->where('coinname', '=', 'btc2cnc')->get();
        $cnc2idr = $cnc2idr[0]['lastprice'];
        $cnc2idr = $btcidr / $cnc2idr;


        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];
            $coinname = explode('2', $coinlist);
            $str = $coinname[1];
            $coinname = $coinname[0];
            $coinname = strtoupper($coinname);
            $lastprice = $filter['lastprice'];
            // echo $str.'<br>';

            if ($str == 'btc') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $lastprice * $btcidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['aex_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->aex_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'eth') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $lastprice * $ethidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['aex_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->aex_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'usdt') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $lastprice * $usdtidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['aex_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->aex_usdt = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'cnc') {

                $lastprice = $lastprice * $cnc2idr;

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['aex_cnc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->aex_cnc = $lastprice;
                    $insert->save();
                }        
            }


        }

    }


    public function BittrexData() {

        $querry = BittrexRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];
        
        foreach ($querry as $filter) {
            $str = substr($filter['coinname'], 0, 3);
            $str4 = substr($filter['coinname'], 0, 4);
           

            if ($str == 'BTC') {
                $coinlist = $filter['coinname'];
                $coinname = explode('-', $coinlist);
                $coinname = $coinname[1];

                $lastprice = $filter['lastprice'] * $btcidr;
                
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bittrex_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bittrex_btc = $lastprice;
                    $insert->save();
                }                         
            }

            if ($str == 'ETH') {
                $coinlist = $filter['coinname'];
                $coinname = explode('-', $coinlist);
                $coinname = $coinname[1];

                $lastprice = $filter['lastprice'] * $ethidr;
                

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bittrex_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bittrex_eth = $lastprice;
                    $insert->save();
                }                         
            }

            if ($str4 == 'USDT') {
                $coinlist = $filter['coinname'];
                $coinname = explode('-', $coinlist);
                $coinname = $coinname[1];

                $lastprice = $filter['lastprice'] * $usdtidr;
                

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bittrex_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bittrex_usdt = $lastprice;
                    $insert->save();
                }                         
            }

        }
    }

    public function BilaxyData() {

        $querry = BilaxyRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];
            $coinname = explode('_',$coinlist);

            $str = $coinname[1];
            $coinname = $coinname[0];
            $coinname = strtoupper($coinname);
            $lastprice = $filter['lastprice'];

            if ($str == 'BTC') {
                
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $filter['lastprice'] * $btcidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bilaxy_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bilaxy_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'ETH') {
                
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bilaxy_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bilaxy_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'USDT') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bilaxy_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bilaxy_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }

    public function FolgoryData() {

        $querry = FolgoryRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];
            $coinname = explode('/',$coinlist);

            $str = $coinname[1];
            $coinname = $coinname[0];
            $coinname = strtoupper($coinname);
            $lastprice = $filter['lastprice'];

            if ($str == 'BTC') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $filter['lastprice'] * $btcidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['folgory_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->folgory_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'ETH') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['folgory_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->folgory_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'USDT') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {
                    echo $coinname.'<br>';

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['folgory_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->folgory_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }

    public function CoinsbitData() {

        $querry = CoinsbitRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];
            $coinname = explode('_',$coinlist);

            $str = $coinname[1];
            $coinname = $coinname[0];
            $coinname = strtoupper($coinname);
            $lastprice = $filter['lastprice'];
            echo $coinname.'<br>';
            if ($str == 'BTC') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $filter['lastprice'] * $btcidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['coinsbit_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->coinsbit_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'ETH') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                echo '==>'.$str.'==>'.$coinname.'==>'.$lastprice.'<br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['coinsbit_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->coinsbit_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'USDT') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {
                    echo $coinname.'<br>';

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['coinsbit_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->coinsbit_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }

    public function BkexData() {

        $querry = BkexRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];
            $coinname = explode('_',$coinlist);

            $str = $coinname[1];
            $coinname = $coinname[0];
            $coinname = strtoupper($coinname);
            $lastprice = $filter['lastprice'];

            if ($str == 'BTC') {
                
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $filter['lastprice'] * $btcidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bkex_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bkex_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'ETH') {
                
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bkex_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bkex_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'USDT') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bkex_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bkex_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }
    
    public function BitzData() {

        $querry = BitzRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];
            $coinname = explode('_',$coinlist);

            $str = $coinname[1];
            $coinname = $coinname[0];
            $coinname = strtoupper($coinname);
            $lastprice = $filter['lastprice'];
            // echo $coinlist.'<br>';
            if ($str == 'btc') {
                
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $filter['lastprice'] * $btcidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bitz_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bitz_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'eth') {
                
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bitz_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bitz_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'usdt') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';

                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bitz_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bitz_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }

    public function P2pb2pData() {

        $querry = P2pb2pRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];
            $coinname = explode('_',$coinlist);

            $str = $coinname[1];
            $coinname = $coinname[0];
            $coinname = strtoupper($coinname);
            $lastprice = $filter['lastprice'];
            // echo $coinname.'<br>';
            if ($str == 'BTC') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $filter['lastprice'] * $btcidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['p2pb2b_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->p2pb2b_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'ETH') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                echo '==>'.$str.'==>'.$coinname.'==>'.$lastprice.'<br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['p2pb2b_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->p2pb2b_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'USDT') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['p2pb2b_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->p2pb2b_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }

    public function ProbitkrData() {

        $querry = ProbitkrRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];
        

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];
            $coinname = explode('-',$coinlist);

            $str = $coinname[1];
            $coinname = $coinname[0];
            $coinname = strtoupper($coinname);
            $lastprice = $filter['lastprice'];
            // echo $str.'<br>';
            if ($str == 'BTC') {
                // echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $filter['lastprice'] * $btcidr;
                // echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['probitkr_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->probitkr_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'KRW') {
                $namacoinkrw  = strtolower($coinname).'idr';
                $krwtoidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', $namacoinkrw)->first();              
                $krwtoidr = $krwtoidr['lastprice'];
                // echo $krwtoidr.'<br>';

                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$krwtoidr.' ';
                $lastprice = 1 / $filter['lastprice'];
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';


                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['probitkr_krw' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->probitkr_krw = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'ETH') {
                // echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                // echo '==>'.$str.'==>'.$coinname.'==>'.$lastprice.'<br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['probitkr_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->probitkr_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'USDT') {
                // echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                // echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['probitkr_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->probitkr_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }

    public function BiboxData() {

        $querry = BiboxRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];
            $coinname = explode('_',$coinlist);

            $str = $coinname[1];
            $coinname = $coinname[0];
            $coinname = strtoupper($coinname);
            $lastprice = $filter['lastprice'];
            // echo $coinname.'<br>';
            if ($str == 'BTC') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $filter['lastprice'] * $btcidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bibox_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bibox_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'ETH') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                echo '==>'.$str.'==>'.$coinname.'==>'.$lastprice.'<br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bibox_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bibox_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'USDT') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bibox_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bibox_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }

    public function LatokenData() {

        $querry = LatokenRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];
            $coinname = explode('/',$coinlist);

            $str = $coinname[1];
            $coinname = $coinname[0];
            $coinname = strtoupper($coinname);
            $lastprice = $filter['lastprice'];
            echo $lastprice.'<br>';
            if ($str == 'BTC') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $filter['lastprice'] * $btcidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['latoken_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->latoken_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'ETH') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                echo '==>'.$str.'==>'.$coinname.'==>'.$lastprice.'<br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['latoken_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->latoken_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'USDT') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['latoken_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->latoken_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }

    public function CoinbeneData() {

        $querry = CoinbeneRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];
            $coinname = explode('/',$coinlist);

            $str = $coinname[1];
            $coinname = $coinname[0];
            $coinname = strtoupper($coinname);
            $lastprice = $filter['lastprice'];

            if ($str == 'BTC') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $filter['lastprice'] * $btcidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['coinbene_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->coinbene_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'ETH') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                echo '==>'.$str.'==>'.$coinname.'==>'.$lastprice.'<br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['coinbene_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->coinbene_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'USDT') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['coinbene_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->coinbene_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }

    public function DigifinexData() {

        $querry = DigifinexRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];
            $coinname = explode('_',$coinlist);

            $str = $coinname[1];
            $coinname = $coinname[0];
            $coinname = strtoupper($coinname);
            $lastprice = $filter['lastprice'];

            if ($str == 'btc') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $filter['lastprice'] * $btcidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['digifinex_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->digifinex_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'eth') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                echo '==>'.$str.'==>'.$coinname.'==>'.$lastprice.'<br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['digifinex_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->digifinex_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'usdt') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['digifinex_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->digifinex_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }

    public function BhexData() {

        $querry = BhexRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];

            $str = substr($coinlist, -3);
            $str1 = substr($coinlist, -4);

            $lastprice = $filter['lastprice'];

            if ($str == 'BTC') {
                $coinname = substr($coinlist, 0, -3);
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $filter['lastprice'] * $btcidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bhex_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bhex_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'ETH') {
                $coinname = substr($coinlist, 0, -3);
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                echo '==>'.$str.'==>'.$coinname.'==>'.$lastprice.'<br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bhex_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bhex_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str1 == 'USDT') {
                $coinname = substr($coinlist, 0, -4);
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                echo ' ==> '.$str1.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['bhex_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->bhex_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }

    public function HitbtcData() {

        $querry = HitbtcRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];

            $str = substr($coinlist, -3);
            $str1 = substr($coinlist, -4);

            $lastprice = $filter['lastprice'];

            if ($str == 'BTC') {
                $coinname = substr($coinlist, 0, -3);
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $filter['lastprice'] * $btcidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['hitbtc_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->hitbtc_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'ETH') {
                $coinname = substr($coinlist, 0, -3);
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                echo '==>'.$str.'==>'.$coinname.'==>'.$lastprice.'<br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['hitbtc_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->hitbtc_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str1 == 'USDT') {
                $coinname = substr($coinlist, 0, -4);
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                echo ' ==> '.$str1.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['hitbtc_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->hitbtc_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }

    public function CointigerData() {

        $querry = CointigerRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];

            $str = substr($coinlist, -3);
            $str1 = substr($coinlist, -4);

            $lastprice = $filter['lastprice'];

            if ($str == 'BTC') {
                $coinname = substr($coinlist, 0, -3);
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $filter['lastprice'] * $btcidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['cointiger_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->cointiger_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'ETH') {
                $coinname = substr($coinlist, 0, -3);
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                echo '==>'.$str.'==>'.$coinname.'==>'.$lastprice.'<br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['cointiger_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->cointiger_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str1 == 'USDT') {
                $coinname = substr($coinlist, 0, -4);
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                echo ' ==> '.$str1.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['cointiger_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->cointiger_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }

    public function ExxData() {

        $querry = ExxRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];
            $coinname = explode('_',$coinlist);

            $str = $coinname[1];
            $coinname = $coinname[0];
            $coinname = strtoupper($coinname);
            $lastprice = $filter['lastprice'];
            // echo $coinname.'<br>';
            // if ($str == 'krwt') {
            //     echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
            //     $lastprice = $filter['lastprice'] * $btcidr;
            //     echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
            //     if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

            //         CalcSyncModel::where('coinname', '=', $coinname)->update(['exx_krwt' => $lastprice]);
            //     } else {
            //         $insert = new CalcSyncModel();
            //         $insert->coinname = $coinname;
            //         $insert->exx_krwt = $lastprice;
            //         $insert->save();
            //     }        
            // }

            // if ($str == 'cnyt') {
            //     echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
            //     $lastprice = $filter['lastprice'] * $btcidr;
            //     echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
            //     if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

            //         CalcSyncModel::where('coinname', '=', $coinname)->update(['exx_cnyt' => $lastprice]);
            //     } else {
            //         $insert = new CalcSyncModel();
            //         $insert->coinname = $coinname;
            //         $insert->exx_cnyt = $lastprice;
            //         $insert->save();
            //     }        
            // }

            if ($str == 'eth') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                echo '==>'.$str.'==>'.$coinname.'==>'.$lastprice.'<br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['exx_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->exx_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'usdt') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['exx_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->exx_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }

    public function TokokData() {

        $querry = TokokRawModel::select()->get();

        $btcidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr = $btcidr[0]['lastprice'];

        $ethidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        foreach ($querry as $filter) {
            $coinlist = $filter['coinname'];
            $coinname = explode('_',$coinlist);

            $str = $coinname[1];
            $coinname = $coinname[0];
            $coinname = strtoupper($coinname);
            $lastprice = $filter['lastprice'];
            // echo $coinname.'<br>';
            if ($str == 'BTC') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$btcidr.' ';
                $lastprice = $filter['lastprice'] * $btcidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['tokok_btc' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->tokok_btc = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'ETH') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$ethidr.' ';
                $lastprice = $filter['lastprice'] * $ethidr;
                echo '==>'.$str.'==>'.$coinname.'==>'.$lastprice.'<br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['tokok_eth' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->tokok_eth = $lastprice;
                    $insert->save();
                }        
            }

            if ($str == 'USDT') {
                echo 'lastprice ==> '.$lastprice.' ==> IDR '.$usdtidr.' ';
                $lastprice = $filter['lastprice'] * $usdtidr;
                echo ' ==> '.$str.' ==> '.$coinname.' ==> '.$lastprice.' <br>';
                if (CalcSyncModel::where('coinname' , '=', $coinname)->exists()) {

                    CalcSyncModel::where('coinname', '=', $coinname)->update(['tokok_usdt' => $lastprice]);
                } else {
                    $insert = new CalcSyncModel();
                    $insert->coinname = $coinname;
                    $insert->tokok_usdt = $lastprice;
                    $insert->save();
                }        
            }

        }

    }

}
