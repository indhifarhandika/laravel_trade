<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\CalcSyncModel;
use App\CalcBinanceModel;
use App\BinanceRawModel;
use App\TelegramModel;
use App\LastMessageModel;
use App\ExtremeLastMessageModel;

use Illuminate\Http\Request;

class ProcessController extends Controller
{
    //
    public function MarkOne ($mode,$exchange,$filter,$pilih) {
        $besar = strtoupper($filter);
        $qselect = array();
        $arr_exchange = explode(",", $exchange);
        $coinfilter = explode(",", $besar);
        
        
        $qselect[0] = 'coinname';
        $z = 1;
        foreach ($arr_exchange as $exsc) {
          $qselect[$z] = $exsc;
          $z++;
        }

        $datae = array();

        if($filter=='none' && $pilih == "pilih"){

            $calculations = CalcSyncModel::select($qselect)->get();

        }else if(!empty($coinfilter) && $pilih == "pilih"){
            $j = 0;
            $calculations = CalcSyncModel::select($qselect)->get();
            foreach($calculations as $arraye){
                $value = $arraye['coinname'];
                if(!in_array($value,$coinfilter)){
                    unset($calculations[$j]);
                }
                $j++;
            }
            
        }else if(!empty($coinfilter) && $pilih == "kecuali"){            
            $calculations = CalcSyncModel::select($qselect)->get();
            $i = 0;
            foreach($calculations as $arraye){
                $value = $arraye['coinname'];
                if(in_array($value,$coinfilter)){
                    unset($calculations[$i]);
                }
                $i++;
            }

        }


        $arr_mode = 'idr';
        
        $colomn = array();
        $colomn[0] = 'coinname';
        $i = 1;
        foreach ($arr_exchange as $ex) {
          $colomn[$i] = $ex;
          $i++;
        }

        $colomn[$i + 2] = 'go_price';

        $data = array();
        $data['mode'] = $arr_mode;
        $data['exchange'] = $arr_exchange;
        $data['filter'] = $coinfilter;
        $data['colomn'] = $colomn;
        $data['isi'] = $calculations;
        $data['pilih'] = $pilih;

        return $data;

    }



    public function CircleBalancer() {

        $calculations = CalcBinanceModel::select()->get();

        $usdtbtc = BinanceRawModel::select('lastprice')->where('coinname', '=', 'BTCUSDT')->get();
        $usdtbtc = $usdtbtc[0]['lastprice'];

        $usdteth = BinanceRawModel::select('lastprice')->where('coinname', '=', 'ETHUSDT')->get();
        $usdteth = $usdteth[0]['lastprice'];

        $usdtbnb = BinanceRawModel::select('lastprice')->where('coinname', '=', 'BNBUSDT')->get();
        $usdtbnb = $usdtbnb[0]['lastprice'];

        //return $calculations[0];
        $modal = 1000;

        foreach ($calculations as $value) {
            $goprice        = $value['go_price'];
            $coinname       = $value['coinname'];
            $binancebtc     = $value['binance_btc'];
            $binanceeth     = $value['binance_eth'];
            $binanceusdt    = $value['binance_usdt'];
            $binancebnb     = $value['binance_bnb'];
            $maxprice       = $value['max_price'];
            $minprice       = $value['min_price'];


            if ($maxprice == $binancebtc ) {
                $maxprice = 'btc';
                $exchanger = 'BINANCEBTC';
            }
            if ($maxprice == $binanceeth ) {
                $maxprice = 'eth';
                $exchanger = 'BINANCEETH';
            }
            if ($maxprice == $binanceusdt ) {
                $maxprice = 'usdt';
                $exchanger = 'BINANCEUSDT';
            }
            if ($maxprice == $binancebnb ) {
                $maxprice = 'bnb';
                $exchanger = 'BINANCEBNB';
            }

            if ($minprice == $binancebtc ) {
                $minprice = 'btc';
                $minexchanger = 'BINANCEBTC';
            }
            if ($minprice == $binanceeth ) {
                $minprice = 'eth';
                $minexchanger = 'BINANCEETH';
            }
            if ($minprice == $binanceusdt ) {
                $minprice = 'usdt';
                $minexchanger = 'BINANCEUSDT';
            }
            if ($minprice == $binancebnb ) {
                $minprice = 'bnb';
                $minexchanger = 'BINANCEBNB';
            }

            if ($value['go_price'] > 1) {

                $getdata  = BinanceRawModel::select()->where('coinname', '=', $coinname . $maxprice)->get();
                $askprice = $getdata[0]['askprice'];
                $askqty   = $getdata[0]['askqty'];
                $bidprice = $getdata[0]['bidprice'];
                $bidqty   = $getdata[0]['bidqty'];

                if ($askprice == 0 ) {
                    $askprice = 0.00000001;
                }
    
                $getdataeth  = BinanceRawModel::select()->where('coinname', '=', $coinname . $minprice)->get();
                $askpriceeth = $getdataeth[0]['askprice'];
                $askqtyeth   = $getdataeth[0]['askqty'];
                $bidpriceeth = $getdataeth[0]['bidprice'];
                $bidqtyeth   = $getdataeth[0]['bidqty'];

                if ($askpriceeth == 0) {
                    $askpriceeth = 0.00000001;
                }
    
                $hitung1    = (($modal/$usdtbtc)/$askprice);
                $hitung1    = $hitung1 * $bidpriceeth;
                $hitung1    = $hitung1 * $usdteth;
                $hitung1    = $hitung1 - $modal;

                $hitung2    = (($modal/$usdteth)/$askpriceeth);
                $hitung2    = $hitung2 * $bidprice;
                $hitung2    = $hitung2 * $usdtbtc;
                $hitung2    = $hitung2 - $modal;

                $apiToken = "523095031:AAGlD4FgnsV1UmZSCPoiKPiqiXMkIwyYhr8";
                $tujuan = 'chat_id=@circlebalancer&text=';
                $pesan  = $exchanger . '%20%20' .$minexchanger . '%20%20' .$goprice . '%20%20' . $coinname . '%20%20%0A' . $hitung1 . '%20%20%0A'. $hitung2;

                if ($hitung1 > 0 OR $hitung2 > 0) {
                    //$response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . $tujuan . $pesan );
                }

                
        
                echo  $pesan  . '</br>';
            }
        }



    }



    public function TelegramCount ($mode,$exchange,$filter) {

        $qselect = array();
        $arr_exchange = explode(",", $exchange);
        $coinfilter = explode(",", $filter);

        
        $qselect[0] = 'coinname';
        $z = 1;
        foreach ($arr_exchange as $exsc) {
          $qselect[$z] = $exsc;
          $z++;
        }


        

        if ($filter != 'none') {
            $calculations = CalcSyncModel::select($qselect)->whereIn('coinname', $coinfilter)->get();
        } else {
            $calculations = CalcSyncModel::select($qselect)->get();
        }

        
        $arr_mode = 'idr';
        

        $colomn = array();
        $colomn[0] = 'coinname';
        $i = 1;
        foreach ($arr_exchange as $ex) {
          $colomn[$i] = $ex;
          $i++;
        }

        $colomn[$i + 2] = 'go_price';

        $data = array();
        $data['mode'] = $arr_mode;
        $data['exchange'] = $arr_exchange;
        $data['filter'] = $coinfilter;
        $data['colomn'] = $colomn;
        $data['isi'] = $calculations;

        return $data;

    }

    public function TelegramSent() {

        $querry = TelegramModel::select('coinname','rule')->get();
        $time = date("Y-m-d H:i:s", time());
        $now = strtotime($time);

        foreach ($querry as $perquerry) {
            $coinname = $perquerry['coinname'];
            $rule = $perquerry['rule'];

            $checkkirim = LastMessageModel::select('tanggal')->where('coinname', '=', $coinname)->orderBy('id', 'desc')->limit(3)->get();

            $time1 = strtotime($checkkirim[0]['tanggal']);
            $time2 = strtotime($checkkirim[1]['tanggal']);
            $time3 = strtotime($checkkirim[2]['tanggal']);

            $conditions = $now - $time1;
            $conditions2 = $now - $time2;
            $conditions3 = $now - $time3;

            echo $conditions .' ' . $conditions2 . ' ' . $conditions3 . '</br>';


            if ($conditions >= 300 AND $conditions2 >= 600 AND $conditions3 >= 900 ) {

                $url = "http://oway.online/count/idr/" . $rule;
                $data = json_decode(file_get_contents($url), TRUE);
    
                $peluang = 3 ; 
                $checkpotential = $data['isi'][0]['go_price'];  
                $pesan = $data['isi'][0]['coinname'] . ' - GO = ' . $checkpotential;

                echo $pesan . '</br>';

                if ($checkpotential > $peluang) {
    
                    $apiToken = "523095031:AAGlD4FgnsV1UmZSCPoiKPiqiXMkIwyYhr8";
        
                    $datakirim = [
                             'chat_id' => '@signalnotificator',
                             'text' => $pesan
                            ];
        
                    $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($datakirim) );

                    echo 'terkirim' . '</br>';

                    $insert = new LastMessageModel();
                    $insert->coinname = $coinname;
                    $insert->save();
        
                }
            }
        }
    }


    public function ExtremeSent () {

        $url = "http://oway.online/api/count/idr/indodax_idr,binance_btc,bittrex_btc/none";
        $data = json_decode(file_get_contents($url), TRUE);
        $time = date("Y-m-d H:i:s", time());
        $now = strtotime($time);

        


        foreach ($data['isi'] as $value) {

            $coinname = $value['coinname'];
            $goprice  = $value['go_price'];
            $bittrexbtc = $value['bittrex_btc'];
            $binancebtc = $value['binance_btc'];
            $indodaxidr = $value['indodax_idr'];

            $checklastmessage = ExtremeLastMessageModel::select()->where('coinname', '=', $coinname)->orderBy('id', 'desc')->limit(3)->get();
            $countarray = count($checklastmessage);
          
            if ($countarray < 3 AND $goprice > 8) {
                    $insert = new ExtremeLastMessageModel();
                    $insert->coinname = $coinname;
                    $insert->goprice  = $goprice;
                    $insert->save();

                    //$pesan = 'EXTREME SIGNAL : '. $coinname . '  --  '. $goprice . '\n' . 'Exchanger : ' . '\n' . '- Indodax ' . '\n' . '- Binance ' . '\n' . '- Bittrex';
                    $tujuan = 'chat_id=@signalnotificator&text=';
                    $pesan = 'EXTREME%20%3A%20' . $coinname . '%20-%20GO%20' . $goprice . '%0AExchanger%20%3A%0AIndodax%20IDR%20%3A%20' . $indodaxidr . '%0ABittrex%20BTC%20%3A%20' . $bittrexbtc . '%0ABinance%20BTC%20%3A%20' . $binancebtc . '%0A%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D';
                    $apiToken = "523095031:AAGlD4FgnsV1UmZSCPoiKPiqiXMkIwyYhr8";
    
                    $datakirim = [
                            'chat_id' => '@signalnotificator',
                            'text' => $pesan
                        ];
                    
                    $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . $tujuan . $pesan );
                    //echo $response . "</br>";

            }

            if ($countarray >= 3 AND $goprice > 8) {

                $time1 = strtotime($checklastmessage[0]['tanggal']);
                $time2 = strtotime($checklastmessage[1]['tanggal']);
                $time3 = strtotime($checklastmessage[2]['tanggal']);
    
                $conditions = $now - $time1;
                $conditions2 = $now - $time2;
                $conditions3 = $now - $time3;

                if ($conditions >= 300 AND $conditions2 >= 600 AND $conditions3 >= 900 ) {

                    $insert = new ExtremeLastMessageModel();
                    $insert->coinname = $coinname;
                    $insert->goprice  = $goprice;
                    $insert->save();

                    //$pesan = 'EXTREME SIGNAL : '. $coinname . '  --  '. $goprice . '\n' . 'Exchanger : ' . '\n' . '- Indodax ' . '\n' . '- Binance ' . '\n' . '- Bittrex';
                    $tujuan = 'chat_id=@signalnotificator&text=';
                    $pesan = 'EXTREME%20%3A%20' . $coinname . '%20-%20GO%20' . $goprice . '%0AExchanger%20%3A%0AIndodax%20IDR%20%3A%20' . $indodaxidr . '%0ABittrex%20BTC%20%3A%20' . $bittrexbtc . '%0ABinance%20BTC%20%3A%20' . $binancebtc . '%0A%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D';
                    $apiToken = "523095031:AAGlD4FgnsV1UmZSCPoiKPiqiXMkIwyYhr8";
    
                    $datakirim = [
                            'chat_id' => '@signalnotificator',
                            'text' => $pesan
                        ];
                    
                    $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . $tujuan . $pesan );
                    //echo $response . "</br>";

                }
            }   
        }
    }


    public function get_exchanger()
    {
        try {

        
        $market = DB::table('list_exchanger_market')->pluck('market_name');

        $data = array();
        
        $data['market'] = $market;

        return $data;

        } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
        }
    }

    
}
