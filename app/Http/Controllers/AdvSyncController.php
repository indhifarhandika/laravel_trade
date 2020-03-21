<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CalculatorModel;
use App\ListExchangerModel;

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

// use App\WhitebitRawModel;
// use App\BigoneRawModel;
// use App\BikiRawModel;
// use App\BitassetRawModel;
// use App\BitmaxRawModel;
// use App\BittrueRawModel;
// use App\BybitRawModel;
// use App\CoinexRawModel;
// use App\CryptonexRawModel;
// use App\DcoinRawModel;
// use App\IndoexRawModel;
// use App\KryptonoRawModel;
// use App\LiquidRawModel;
// use App\OmgfinRawModel;
// use App\VindaxRawModel;
// use App\ZbRawModel;

class AdvSyncController extends Controller
{
    //

    public function getKurs(){
        //select to idr
        $btcidr  = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr  = $btcidr[0]['lastprice'];

        $ethidr  = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr  = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        $bnbidr  = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'bnbidr')->get();
        $bnbidr  = $bnbidr[0]['lastprice'];

        $cnc2idr = AexRawModel::select('lastprice')->where('coinname', '=', 'btc2cnc')->get();
        $cnc2idr = $cnc2idr[0]['lastprice'];
        $cnc2idr = $btcidr / $cnc2idr;

        $usdtbtc = BinanceRawModel::select('lastprice')->where('coinname', '=', 'BTCUSDT')->get();
        $usdtbtc = $usdtbtc[0]['lastprice'];

        $usdteth = BinanceRawModel::select('lastprice')->where('coinname', '=', 'ETHUSDT')->get();
        $usdteth = $usdteth[0]['lastprice'];
        
        //Get Data from Table
        $aex_query          =       AexRawModel::select()->get();
        $huobi_query        =       HuobiRawModel::select()->get();
        $binance_query      =       BinanceRawModel::select()->get();
        $bittrex_query      =       BittrexRawModel::select()->get();
        $okex_query         =       OkexRawModel::select()->get();
        $indodax_query      =       IndodaxRawModel::select()->get();
        $bilaxy_query       =       BilaxyRawModel::select()->get();
        $folgory_query      =       FolgoryRawModel::select()->get();
        $coinsbit_query     =       CoinsbitRawModel::select()->get();
        $bkex_query         =       BkexRawModel::select()->get();
        $bitz_query         =       BitzRawModel::select()->get();
        $probitkr_query     =       ProbitkrRawModel::select()->get();
        $latoken_query      =       LatokenRawModel::select()->get();
        $coinbene_query     =       CoinbeneRawModel::select()->get();
        $digifinex_query    =       DigifinexRawModel::select()->get();
        $bhex_query         =       BhexRawModel::select()->get();
        $hitbtc_query       =       HitbtcRawModel::select()->get();
        $cointiiger_query   =       CointigerRawModel::select()->get();
        $tokok_query        =       TokokRawModel::select()->get();
        $exx_query          =       ExxRawModel::select()->get();

        // $whitebit_query     =       WhitebitRawModel::select()->get();
        // $bigone_query       =       BigoneRawModel::select()->get();
        // $biki_query         =       BikiRawModel::select()->get();
        // $bitasset_query     =       BitassetRawModel::select()->get();
        // $bitmax_query       =       BitmaxRawModel::select()->get();
        // $bittrue_query      =       BittrueRawModel::select()->get();
        // // $bybit_query        =       BybitRawModel::select()->get();
        // // $coinex_query       =       CoinexRawModel::select()->get();
        // $cryptonex_query    =       CryptonexRawModel::select()->get();
        // $dcoin_query        =       DcoinRawModel::select()->get();
        // $indoex_query       =       IndoexRawModel::select()->get();
        // $kryptono_query     =       KryptonoRawModel::select()->get();
        // $liquid_query       =       LiquidRawModel::select()->get();
        // $omgfine_query      =       OmgfinRawModel::select()->get();
        // $vindax_query       =       VindaxRawModel::select()->get();
        // $zb_query           =       ZbRawModel::select()->get();
        
        
        
        //Get All Coin in Calculator
        $allCoin = CalculatorModel::select('coinname')->get();
        $coinname_list = array();
        foreach ($allCoin as $coin) {
            $data = $coin['coinname'];
            $coinname_list[] = $data;
        }

        //Get all exchanger 
        $allExchanger = ListExchangerModel::select('market_name')->orderBy('id', 'asc')->limit(33)->get('market_name');
        $market_list = array();
        foreach($allExchanger as $exchanger){
            $data = $exchanger['market_name'];
            $market_list[] = $data;
        }
        
        //Create Model
        $x = 0;
        $result = [];
        foreach($coinname_list as $coinname){
            foreach($market_list as $market){
                $result[$coinname][$market] = 0;
            }
        }

                    //Aex
                    foreach($aex_query as $filter){
                        $nama_coinne = explode("2",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $aex_coin = strtoupper($nama_coinne[0]);
                        if($nama_paire == 'cnc'){
                            $lastprice = $filter['lastprice'] * $cnc2idr;
                            $result[$aex_coin]['aex_cnc'] = $lastprice;
                        }
                        if($nama_paire == 'btc'){
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$aex_coin]['aex_btc'] = $lastprice;
                        }
                        if($nama_paire == 'usdt'){
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$aex_coin]['aex_usdt'] = $lastprice;
                        }
                    }

                    
                    //huobi
                    foreach ($huobi_query as $filter) {
                        $nama_paire1 = substr($filter['coinname'], -3);
                        $coinname1 = substr($filter['coinname'], 0, -3);
                        $nama_paire2 = substr($filter['coinname'], -4);
                        $coinname2 = substr($filter['coinname'], 0, -4);
                        if ($nama_paire1 == 'btc') {
                            $coinname = strtoupper($coinname1);
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['huobi_btc'] = $lastprice;
                        }
                        if ($nama_paire1 == 'eth') {
                            $coinname = strtoupper($coinname1);
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['huobi_eth'] = $lastprice;
                        }
                        if ($nama_paire2 == 'usdt') {
                            $coinname = strtoupper($coinname2);
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['huobi_usdt'] = $lastprice;
                        }
                    }
                    //Binance
                    foreach ($binance_query as $filter) {
                        $nama_paire1 = substr($filter['coinname'], -3);
                        $coinname1 = substr($filter['coinname'], 0, -3);
                        $nama_paire2 = substr($filter['coinname'], -4);
                        $coinname2 = substr($filter['coinname'], 0, -4);
                        if ($nama_paire1 == 'BTC') {
                            $coinname = strtoupper($coinname1);
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['binance_btc'] = $lastprice;
                        }
                        if ($nama_paire1 == 'ETH') {
                            $coinname = strtoupper($coinname1);
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['binance_eth'] = $lastprice;
                        }
                        if ($nama_paire1 == 'BNB') {
                            $coinname = strtoupper($coinname1);
                            $lastprice = $filter['lastprice'] * $bnbidr;
                            $result[$coinname]['binance_bnb'] = $lastprice;
                        }
                        if ($nama_paire2 == 'TUSD') {
                            $coinname = strtoupper($coinname2);
                            $lastprice = $filter['lastprice'];
                            $result[$coinname]['binance_tusd'] = $lastprice;
                        }
                        if ($nama_paire2 == 'USDT') {
                            $coinname = strtoupper($coinname2);
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['binance_usdt'] = $lastprice;
                        }
                    }

                //bittrex
                    foreach ($bittrex_query as $filter) {
                        $nama_coinne = explode("-",$filter['coinname']);
                        $nama_paire = $nama_coinne[0];
                        $coinname = strtoupper($nama_coinne[1]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['bittrex_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['bittrex_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['bittrex_usdt'] = $lastprice;
                        }
                    }
                //okex
                    foreach ($okex_query as $filter) {
                        $nama_coinne = explode("_",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'btc') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['okex_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'eth') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['okex_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'usdt') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['okex_usdt'] = $lastprice;
                        }
                    }
                //Indodax
                    foreach($indodax_query as $filter){
                        $nama_coinne = substr($filter['coinname'],0, -3);
                        $nama_paire = substr($filter['coinname'], -3);
                        $coinname = strtoupper($nama_coinne);
                        if($nama_paire == 'idr'){
                            $lastprice = $filter['lastprice'];
                            $result[$coinname]['indodax_idr'] = $lastprice;
                        }
                        if($nama_paire == 'btc'){
                            $lastprice = $filter['lastprice'];
                            $result[$coinname]['indodax_btc'] = $lastprice;
                        }
                    }
//Bilaxy
                    foreach ($bilaxy_query as $filter) {
                        $nama_coinne = explode("_",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['bilaxy_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['bilaxy_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['bilaxy_usdt'] = $lastprice;
                        }
                    }
// Folgory
                    foreach ($folgory_query as $filter) {
                        $nama_coinne = explode("/",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['folgory_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['folgory_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['folgory_usdt'] = $lastprice;
                        }
                    }
//Coinsbit
                    foreach ($coinsbit_query as $filter) {
                        $nama_coinne = explode("_",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['coinsbit_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['coinsbit_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['coinsbit_usdt'] = $lastprice;
                        }
                    }
//Bkex
                    foreach ($bkex_query as $filter) {
                        $nama_coinne = explode("_",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['bkex_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['bkex_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['bkex_usdt'] = $lastprice;
                        }
                    }
//Bitz
                    foreach ($bitz_query as $filter) {
                        $nama_coinne = explode("_",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'btc') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['bitz_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'eth') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['bitz_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'usdt') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['bitz_usdt'] = $lastprice;
                        }
                    }
//Probitkr
                    foreach ($probitkr_query as $filter) {
                        $nama_coinne = explode("-",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['probitkr_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['probitkr_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['probitkr_usdt'] = $lastprice;
                        }
                        if ($nama_paire == 'KRW') {
                            $namacoinkrw  = strtolower($coinname).'idr';
                            $krwtoidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', $namacoinkrw)->first();              
                            $krwtoidr = $krwtoidr['lastprice'];
                            $lastprice = 11.99 * $filter['lastprice'];
                            $result[$coinname]['probitkr_krw'] = $lastprice;
                            // echo $namacoinkrw.'<br>';
                            // echo $krwtoidr.'<br>';
                            // echo $lastprice.'<br>';
                            // echo $coinname.'<hr>';
                        }
                    }
//Latoken
                    foreach ($latoken_query as $filter) {
                        $nama_coinne = explode("/",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['latoken_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['latoken_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['latoken_usdt'] = $lastprice;
                        }
                    }
//Coinbene
                    foreach ($coinbene_query as $filter) {
                        $nama_coinne = explode("/",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['coinbene_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['coinbene_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['coinbene_usdt'] = $lastprice;
                        }
                    }
// digifinex
                    foreach ($digifinex_query as $filter) {
                        $nama_coinne = explode("_",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'btc') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['digifinex_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'eth') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['digifinex_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'usdt') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['digifinex_usdt'] = $lastprice;
                        }
                    }
// Bhex
                    foreach ($bhex_query as $filter) {
                        $nama_paire1 = substr($filter['coinname'], -3);
                        $coinname1 = substr($filter['coinname'], 0, -3);
                        $nama_paire2 = substr($filter['coinname'], -4);
                        $coinname2 = substr($filter['coinname'], 0, -4);
                        if ($nama_paire1 == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname1]['bhex_btc'] = $lastprice;
                        }
                        if ($nama_paire1 == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname1]['bhex_eth'] = $lastprice;
                        }
                        if ($nama_paire2 == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname2]['bhex_usdt'] = $lastprice;
                        }
                    }
// Hitbtc
                    foreach ($hitbtc_query as $filter) {
                        $nama_paire1 = substr($filter['coinname'], -3);
                        $coinname1 = substr($filter['coinname'], 0, -3);
                        $nama_paire2 = substr($filter['coinname'], -4);
                        $coinname2 = substr($filter['coinname'], 0, -4);
                        if ($nama_paire1 == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname1]['hitbtc_btc'] = $lastprice;
                        }
                        if ($nama_paire1 == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname1]['hitbtc_eth'] = $lastprice;
                        }
                        if ($nama_paire2 == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname2]['hitbtc_usdt'] = $lastprice;
                        }
                    }
// Cointiger
                    foreach ($cointiiger_query as $filter) {
                        $nama_paire1 = substr($filter['coinname'], -3);
                        $coinname1 = substr($filter['coinname'], 0, -3);
                        $nama_paire2 = substr($filter['coinname'], -4);
                        $coinname2 = substr($filter['coinname'], 0, -4);
                        if ($nama_paire1 == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname1]['cointiger_btc'] = $lastprice;
                        }
                        if ($nama_paire1 == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname1]['cointiger_eth'] = $lastprice;;
                        }
                        if ($nama_paire2 == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname2]['cointiger_usdt'] = $lastprice;;
                        }
                    }
        //tokok
        foreach ($tokok_query as $filter) {
            $nama_coinne = explode("_",$filter['coinname']);
            $nama_paire = $nama_coinne[1];
            $coinname = strtoupper($nama_coinne[0]);
            if ($nama_paire == 'BTC') {
                $lastprice = $filter['lastprice'] * $btcidr;
                $result[$coinname]['tokok_btc'] = $lastprice;
            }
            if ($nama_paire == 'ETH') {
                $lastprice = $filter['lastprice'] * $ethidr;
                $result[$coinname]['tokok_eth'] = $lastprice;
            }
            if ($nama_paire == 'USDT') {
                $lastprice = $filter['lastprice'] * $usdtidr;
                $result[$coinname]['tokok_usdt'] = $lastprice;
            }
        }

// Exx
foreach ($exx_query as $filter) {
    $nama_coinne = explode("_",$filter['coinname']);
    $nama_paire = $nama_coinne[1];
    $coinname = strtoupper($nama_coinne[0]);
    if ($nama_paire == 'btc') {
        $lastprice = $filter['lastprice'] * $btcidr;
        $result[$coinname]['exx_btc'] = $lastprice;
    }
    if ($nama_paire == 'eth') {
        $lastprice = $filter['lastprice'] * $ethidr;
        $result[$coinname]['exx_eth'] = $lastprice;
    }
    if ($nama_paire == 'usdt') {
        $lastprice = $filter['lastprice'] * $usdtidr;
        $result[$coinname]['exx_usdt'] = $lastprice;
    }
}

// // whitebit
// foreach ($whitebit_query as $filter) {
//     $nama_coinne = explode("_",$filter['coinname']);
//     $nama_paire = $nama_coinne[1];
//     $coinname = strtoupper($nama_coinne[0]);
//     if ($nama_paire == 'BTC') {
//         $lastprice = $filter['lastprice'] * $btcidr;
//         $result[$coinname]['whitebit_btc'] = $lastprice;
//     }
//     if ($nama_paire == 'ETH') {
//         $lastprice = $filter['lastprice'] * $ethidr;
//         $result[$coinname]['whitebit_eth'] = $lastprice;
//     }
//     if ($nama_paire == 'USDT') {
//         $lastprice = $filter['lastprice'] * $usdtidr;
//         $result[$coinname]['whitebit_usdt'] = $lastprice;
//     }
// }

// //bigone
// foreach ($bigone_query as $filter) {
//     $nama_coinne = explode("-",$filter['coinname']);
//     $nama_paire = $nama_coinne[1];
//     $coinname = strtoupper($nama_coinne[0]);
//     if ($nama_paire == 'BTC') {
//         $lastprice = $filter['lastprice'] * $btcidr;
//         $result[$coinname]['bigone_btc'] = $lastprice;
//     }
//     if ($nama_paire == 'ETH') {
//         $lastprice = $filter['lastprice'] * $ethidr;
//         $result[$coinname]['bigone_eth'] = $lastprice;
//     }
//     if ($nama_paire == 'USDT') {
//         $lastprice = $filter['lastprice'] * $usdtidr;
//         $result[$coinname]['bigone_usdt'] = $lastprice;
//     }
// }

// //biki
// foreach ($biki_query as $filter) {
//     $nama_paire1 = substr($filter['coinname'], -3);
//     $coinname1 = substr($filter['coinname'], 0, -3);
//     $nama_paire2 = substr($filter['coinname'], -4);
//     $coinname2 = substr($filter['coinname'], 0, -4);
//     if ($nama_paire1 == 'btc') {
//         $lastprice = $filter['lastprice'] * $btcidr;
//         $result[$coinname1]['biki_btc'] = $lastprice;
//     }
//     if ($nama_paire1 == 'eth') {
//         $lastprice = $filter['lastprice'] * $ethidr;
//         $result[$coinname1]['biki_eth'] = $lastprice;;
//     }
//     if ($nama_paire2 == 'usdt') {
//         $lastprice = $filter['lastprice'] * $usdtidr;
//         $result[$coinname2]['biki_usdt'] = $lastprice;;
//     }
// }

// //bitasset
// foreach ($bitasset_query as $filter) {
//     $nama_coinne = explode("_",$filter['coinname']);
//     $nama_paire = $nama_coinne[1];
//     $coinname = strtoupper($nama_coinne[0]);
//     if ($nama_paire == 'btc') {
//         $lastprice = $filter['lastprice'] * $btcidr;
//         $result[$coinname]['bitasset_btc'] = $lastprice;
//     }
//     // if ($nama_paire == 'eth') {
//     //     $lastprice = $filter['lastprice'] * $ethidr;
//     //     $result[$coinname]['bitasset_eth'] = $lastprice;
//     // }
//     if ($nama_paire == 'usdt') {
//         $lastprice = $filter['lastprice'] * $usdtidr;
//         $result[$coinname]['bitasset_usdt'] = $lastprice;
//     }
// }

// //bitmax
// foreach ($bitmax_query as $filter) {
//     $nama_coinne = explode("/",$filter['coinname']);
//     $nama_paire = $nama_coinne[1];
//     $coinname = strtoupper($nama_coinne[0]);
//     if ($nama_paire == 'BTC') {
//         $lastprice = $filter['lastprice'] * $btcidr;
//         $result[$coinname]['bitmax_btc'] = $lastprice;
//     }
//     if ($nama_paire == 'ETH') {
//         $lastprice = $filter['lastprice'] * $ethidr;
//         $result[$coinname]['bitmax_eth'] = $lastprice;
//     }
//     if ($nama_paire == 'USDT') {
//         $lastprice = $filter['lastprice'] * $usdtidr;
//         $result[$coinname]['bitmax_usdt'] = $lastprice;
//     }
// }

// //bittrue
// foreach ($bittrue_query as $filter) {
//     $nama_coinne = explode("_",$filter['coinname']);
//     $nama_paire = $nama_coinne[1];
//     $coinname = strtoupper($nama_coinne[0]);
//     if ($nama_paire == 'BTC') {
//         $lastprice = $filter['lastprice'] * $btcidr;
//         $result[$coinname]['bittrue_btc'] = $lastprice;
//     }
//     if ($nama_paire == 'ETH') {
//         $lastprice = $filter['lastprice'] * $ethidr;
//         $result[$coinname]['bittrue_eth'] = $lastprice;
//     }
//     if ($nama_paire == 'USDT') {
//         $lastprice = $filter['lastprice'] * $usdtidr;
//         $result[$coinname]['bittrue_usdt'] = $lastprice;
//     }
// }

// //cryptonex
// foreach ($cryptonex_query as $filter) {
//     $nama_coinne = explode("/",$filter['coinname']);
//     $nama_paire = $nama_coinne[1];
//     $coinname = strtoupper($nama_coinne[0]);
//     if ($nama_paire == 'BTC') {
//         $lastprice = $filter['lastprice'] * $btcidr;
//         $result[$coinname]['cryptonex_btc'] = $lastprice;
//     }
//     if ($nama_paire == 'ETH') {
//         $lastprice = $filter['lastprice'] * $ethidr;
//         $result[$coinname]['cryptonex_eth'] = $lastprice;
//     }
//     if ($nama_paire == 'USDT') {
//         $lastprice = $filter['lastprice'] * $usdtidr;
//         $result[$coinname]['cryptonex_usdt'] = $lastprice;
//     }
// }

// //dcoin
// foreach ($dcoin_query as $filter) {
//     $nama_paire1 = substr($filter['coinname'], -3);
//     $coinname1 = substr($filter['coinname'], 0, -3);
//     $nama_paire2 = substr($filter['coinname'], -4);
//     $coinname2 = substr($filter['coinname'], 0, -4);
//     if ($nama_paire1 == 'btc') {
//         $lastprice = $filter['lastprice'] * $btcidr;
//         $result[$coinname1]['dcoin_btc'] = $lastprice;
//     }
//     if ($nama_paire1 == 'eth') {
//         $lastprice = $filter['lastprice'] * $ethidr;
//         $result[$coinname1]['dcoin_eth'] = $lastprice;;
//     }
//     if ($nama_paire2 == 'usdt') {
//         $lastprice = $filter['lastprice'] * $usdtidr;
//         $result[$coinname2]['dcoin_usdt'] = $lastprice;
//     }
// }

// //indoex
// foreach ($indoex_query as $filter) {
//     $nama_coinne = explode("_",$filter['coinname']);
//     $nama_paire = $nama_coinne[1];
//     $coinname = strtoupper($nama_coinne[0]);
//     if ($nama_paire == 'BTC') {
//         $lastprice = $filter['lastprice'] * $btcidr;
//         $result[$coinname]['indoex_btc'] = $lastprice;
//     }
//     if ($nama_paire == 'ETH') {
//         $lastprice = $filter['lastprice'] * $ethidr;
//         $result[$coinname]['indoex_eth'] = $lastprice;
//     }
//     if ($nama_paire == 'USDT') {
//         $lastprice = $filter['lastprice'] * $usdtidr;
//         $result[$coinname]['indoex_usdt'] = $lastprice;
//     }
// }

// //kryptono
// foreach ($kryptono_query as $filter) {
//     $nama_coinne = explode("-",$filter['coinname']);
//     $nama_paire = $nama_coinne[1];
//     $coinname = strtoupper($nama_coinne[0]);
//     if ($nama_paire == 'BTC') {
//         $lastprice = $filter['lastprice'] * $btcidr;
//         $result[$coinname]['kryptono_btc'] = $lastprice;
//     }
//     if ($nama_paire == 'ETH') {
//         $lastprice = $filter['lastprice'] * $ethidr;
//         $result[$coinname]['kryptono_eth'] = $lastprice;
//     }
//     if ($nama_paire == 'USDT') {
//         $lastprice = $filter['lastprice'] * $usdtidr;
//         $result[$coinname]['kryptono_usdt'] = $lastprice;
//     }
// }

// //liquid
// foreach ($liquid_query as $filter) {
//     $nama_paire1 = substr($filter['coinname'], -3);
//     $coinname1 = substr($filter['coinname'], 0, -3);
//     $nama_paire2 = substr($filter['coinname'], -4);
//     $coinname2 = substr($filter['coinname'], 0, -4);
//     if ($nama_paire1 == 'BTC') {
//         $lastprice = $filter['lastprice'] * $btcidr;
//         $result[$coinname1]['liquid_btc'] = $lastprice;
//     }
//     if ($nama_paire1 == 'ETH') {
//         $lastprice = $filter['lastprice'] * $ethidr;
//         $result[$coinname1]['liquid_eth'] = $lastprice;;
//     }
//     if ($nama_paire2 == 'USDT') {
//         $lastprice = $filter['lastprice'] * $usdtidr;
//         $result[$coinname2]['liquid_usdt'] = $lastprice;;
//     }
// }

// //omgfine
// foreach ($omgfine_query as $filter) {
//     $nama_coinne = explode("_",$filter['coinname']);
//     $nama_paire = $nama_coinne[1];
//     $coinname = strtoupper($nama_coinne[0]);
//     if ($nama_paire == 'BTC') {
//         $lastprice = $filter['lastprice'] * $btcidr;
//         $result[$coinname]['omgfine_btc'] = $lastprice;
//     }
//     if ($nama_paire == 'ETH') {
//         $lastprice = $filter['lastprice'] * $ethidr;
//         $result[$coinname]['omgfine_eth'] = $lastprice;
//     }
//     if ($nama_paire == 'USDT') {
//         $lastprice = $filter['lastprice'] * $usdtidr;
//         $result[$coinname]['omgfine_usdt'] = $lastprice;
//     }
// }

// //vindax
// foreach ($vindax_query as $filter) {
//     $nama_paire1 = substr($filter['coinname'], -3);
//     $coinname1 = substr($filter['coinname'], 0, -3);
//     $nama_paire2 = substr($filter['coinname'], -4);
//     $coinname2 = substr($filter['coinname'], 0, -4);
//     if ($nama_paire1 == 'BTC') {
//         $lastprice = $filter['lastprice'] * $btcidr;
//         $result[$coinname1]['vindax_btc'] = $lastprice;
//     }
//     if ($nama_paire1 == 'ETH') {
//         $lastprice = $filter['lastprice'] * $ethidr;
//         $result[$coinname1]['vindax_eth'] = $lastprice;;
//     }
//     if ($nama_paire2 == 'USDT') {
//         $lastprice = $filter['lastprice'] * $usdtidr;
//         $result[$coinname2]['vindax_usdt'] = $lastprice;;
//     }
// }

// //zb
// foreach ($zb_query as $filter) {
//     $nama_paire1 = substr($filter['coinname'], -3);
//     $coinname1 = substr($filter['coinname'], 0, -3);
//     $nama_paire2 = substr($filter['coinname'], -4);
//     $coinname2 = substr($filter['coinname'], 0, -4);
//     if ($nama_paire1 == 'btc') {
//         $lastprice = $filter['lastprice'] * $btcidr;
//         $result[$coinname1]['zb_btc'] = $lastprice;
//     }
//     if ($nama_paire1 == 'eth') {
//         $lastprice = $filter['lastprice'] * $ethidr;
//         $result[$coinname1]['zb_eth'] = $lastprice;;
//     }
//     if ($nama_paire2 == 'usdt') {
//         $lastprice = $filter['lastprice'] * $usdtidr;
//         $result[$coinname2]['zb_usdt'] = $lastprice;;
//     }
// }
    

$tes_res['TNB']['aex_btc'] = 10;
$tes_res['PAY']['aex_btc'] = 10;
$tes_res['GNT']['aex_btc'] = 10;
$tes_res['SMT']['aex_btc'] = 10;
$tes_res['MTL']['aex_eth'] = 10;
$tes_res['YEE']['aex_eth'] = 10;
$tes_res['APPC']['aex_eth'] = 10;
$tes_res['IDT']['aex_eth'] = 10;
$tes_res['ATOM']['aex_eth'] = 10;
$tes_res['AAC']['aex_eth'] = 10;
$tes_res['AIDOC']['aex_eth'] = 10;
$tes_res['BSV']['aex_eth'] = 10;
$tes_res['HT']['aex_btc'] = 10;
$tes_res['OGO']['aex_btc'] = 10;
$tes_res['RCN']['aex_btc'] = 10;
$tes_res['DATX']['aex_btc'] = 10;
$tes_res['ELF']['aex_btc'] = 10;
$tes_res['SOC']['aex_btc'] = 10;
$tes_res['MANA']['aex_btc'] = 10;
$tes_res['ZIL']['aex_eth'] = 10;
$tes_res['ATP']['aex_eth'] = 10;
$tes_res['GXC']['aex_eth'] = 10;
$tes_res['IOST']['aex_eth'] = 10;
$tes_res['MUSK']['aex_eth'] = 10;
$tes_res['CRO']['aex_btc'] = 10;
$tes_res['XMX']['aex_btc'] = 10;
$tes_res['NAS']['aex_btc'] = 10;
$tes_res['WAN']['aex_btc'] = 10;
$tes_res['PAI']['aex_btc'] = 10;
$tes_res['DAC']['aex_btc'] = 10;
$tes_res['YCC']['aex_eth'] = 10;
$tes_res['MEX']['aex_eth'] = 10;
$tes_res['SC']['aex_eth'] = 10;
$tes_res['DGB']['aex_eth'] = 10;
$tes_res['DASH']['aex_eth'] = 10;
$tes_res['DOGE']['aex_eth'] = 10;
$tes_res['THETA']['aex_eth'] = 10;
$tes_res['MEET']['aex_eth'] = 10;
$tes_res['WAXP']['aex_eth'] = 10;
$tes_res['LXT']['aex_eth'] = 10;
$tes_res['AST']['aex_eth'] = 10;
$tes_res['MDS']['aex_eth'] = 10;
$tes_res['MT']['aex_eth'] = 10;
$tes_res['XVG']['aex_eth'] = 10;
$tes_res['ONT']['aex_eth'] = 10;
$tes_res['DCR']['aex_eth'] = 10;
$tes_res['PROPY']['aex_eth'] = 10;
$tes_res['SNT']['aex_eth'] = 10;
$tes_res['ZRX']['aex_eth'] = 10;
$tes_res['REQ']['aex_eth'] = 10;
$tes_res['BTM']['aex_eth'] = 10;
$tes_res['ELA']['aex_eth'] = 10;
$tes_res['EDU']['aex_eth'] = 10;
$tes_res['FAIR']['aex_eth'] = 10;
$tes_res['MTX']['aex_eth'] = 10;
$tes_res['STEEM']['aex_eth'] = 10;
$tes_res['NPXS']['aex_eth'] = 10;
$tes_res['KAN']['aex_eth'] = 10;
$tes_res['ETH']['aex_eth'] = 10;
$tes_res['VSYS']['aex_eth'] = 10;
$tes_res['BAT']['aex_eth'] = 10;
$tes_res['BKBT']['aex_eth'] = 10;
$tes_res['SALT']['aex_eth'] = 10;
$tes_res['XMR']['aex_eth'] = 10;
$tes_res['PC']['aex_eth'] = 10;
$tes_res['OMG']['aex_eth'] = 10;
$tes_res['ETC']['aex_eth'] = 10;
$tes_res['IOTA']['aex_eth'] = 10;
$tes_res['BCV']['aex_eth'] = 10;
$tes_res['CTXC']['aex_eth'] = 10;
$tes_res['EKT']['aex_eth'] = 10;
$tes_res['CVCOIN']['aex_eth'] = 10;
$tes_res['CNN']['aex_eth'] = 10;
$tes_res['EVX']['aex_eth'] = 10;
$tes_res['AKRO']['aex_eth'] = 10;
$tes_res['SNC']['aex_eth'] = 10;
$tes_res['TT']['aex_eth'] = 10;
$tes_res['RTE']['aex_eth'] = 10;
$tes_res['HPT']['aex_eth'] = 10;
$tes_res['ENG']['aex_eth'] = 10;
$tes_res['BTT']['aex_eth'] = 10;
$tes_res['GNX']['aex_eth'] = 10;
$tes_res['ZLA']['aex_eth'] = 10;
$tes_res['ACT']['aex_eth'] = 10;
$tes_res['SHE']['aex_eth'] = 10;
$tes_res['LSK']['aex_eth'] = 10;
$tes_res['GRS']['aex_eth'] = 10;
$tes_res['BHD']['aex_eth'] = 10;
$tes_res['LINK']['aex_eth'] = 10;
$tes_res['GAS']['aex_eth'] = 10;
$tes_res['NANO']['aex_eth'] = 10;
$tes_res['SBTC']['aex_eth'] = 10;
$tes_res['PVT']['aex_eth'] = 10;
$tes_res['XEM']['aex_eth'] = 10;
$tes_res['TOS']['aex_eth'] = 10;
$tes_res['MCO']['aex_eth'] = 10;
$tes_res['PHX']['aex_eth'] = 10;
        //Save into table
        foreach($result as $result_list => $value){
            // print_r($value);
            // echo $result_list.'<br>';
            CalcSyncModel::where('coinname', '=', ''.$result_list)->update($value);
        }
        

        // return $oke;
    }

    public function getKurs2(){
        //select to idr
        $btcidr  = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'btcidr')->get();
        $btcidr  = $btcidr[0]['lastprice'];

        $ethidr  = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'ethidr')->get();
        $ethidr  = $ethidr[0]['lastprice'];

        $usdtidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'usdtidr')->get();
        $usdtidr = $usdtidr[0]['lastprice'];

        $bnbidr  = IndodaxRawModel::select('lastprice')->where('coinname', '=', 'bnbidr')->get();
        $bnbidr  = $bnbidr[0]['lastprice'];

        $cnc2idr = AexRawModel::select('lastprice')->where('coinname', '=', 'btc2cnc')->get();
        $cnc2idr = $cnc2idr[0]['lastprice'];
        $cnc2idr = $btcidr / $cnc2idr;

        $usdtbtc = BinanceRawModel::select('lastprice')->where('coinname', '=', 'BTCUSDT')->get();
        $usdtbtc = $usdtbtc[0]['lastprice'];

        $usdteth = BinanceRawModel::select('lastprice')->where('coinname', '=', 'ETHUSDT')->get();
        $usdteth = $usdteth[0]['lastprice'];
        
        //Get Data from Table
        $aex_query          =       AexRawModel::select()->get();
        $huobi_query        =       HuobiRawModel::select()->get();
        $binance_query      =       BinanceRawModel::select()->get();
        $bittrex_query      =       BittrexRawModel::select()->get();
        $okex_query         =       OkexRawModel::select()->get();
        $indodax_query      =       IndodaxRawModel::select()->get();
        $bilaxy_query       =       BilaxyRawModel::select()->get();
        $folgory_query      =       FolgoryRawModel::select()->get();
        $coinsbit_query     =       CoinsbitRawModel::select()->get();
        $bkex_query         =       BkexRawModel::select()->get();
        $bitz_query         =       BitzRawModel::select()->get();
        $probitkr_query     =       ProbitkrRawModel::select()->get();
        $latoken_query      =       LatokenRawModel::select()->get();
        $coinbene_query     =       CoinbeneRawModel::select()->get();
        $digifinex_query    =       DigifinexRawModel::select()->get();
        $bhex_query         =       BhexRawModel::select()->get();
        $hitbtc_query       =       HitbtcRawModel::select()->get();
        $cointiiger_query   =       CointigerRawModel::select()->get();
        $tokok_query        =       TokokRawModel::select()->get();
        $exx_query          =       ExxRawModel::select()->get();
        
        //Get All Coin in Calculator
        $allCoin = CalculatorModel::select('coinname')->get();
        $coinname_list = array();
        foreach ($allCoin as $coin) {
            $data = $coin['coinname'];
            $coinname_list[] = $data;
        }

        //Get all exchanger 
        $allExchanger = ListExchangerModel::select('market_name')->orderBy('id', 'desc')->limit(33)->get('market_name');
        $market_list = array();
        foreach($allExchanger as $exchanger){
            $data = $exchanger['market_name'];
            $market_list[] = $data;
        }
        
        // return $allExchanger;
        //Create Model
        $x = 0;
        $result = [];
        foreach($coinname_list as $coinname){
            foreach($market_list as $market){
                $result[$coinname][$market] = 0;
            }
        }

                    //Aex
                    foreach($aex_query as $filter){
                        $nama_coinne = explode("2",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $aex_coin = strtoupper($nama_coinne[0]);
                        if($nama_paire == 'cnc'){
                            $lastprice = $filter['lastprice'] * $cnc2idr;
                            $result[$aex_coin]['aex_cnc'] = $lastprice;
                        }
                        if($nama_paire == 'btc'){
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$aex_coin]['aex_btc'] = $lastprice;
                        }
                        if($nama_paire == 'usdt'){
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$aex_coin]['aex_usdt'] = $lastprice;
                        }
                    }

                    
                    //huobi
                    foreach ($huobi_query as $filter) {
                        $nama_paire1 = substr($filter['coinname'], -3);
                        $coinname1 = substr($filter['coinname'], 0, -3);
                        $nama_paire2 = substr($filter['coinname'], -4);
                        $coinname2 = substr($filter['coinname'], 0, -4);
                        if ($nama_paire1 == 'btc') {
                            $coinname = strtoupper($coinname1);
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['huobi_btc'] = $lastprice;
                        }
                        if ($nama_paire1 == 'eth') {
                            $coinname = strtoupper($coinname1);
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['huobi_eth'] = $lastprice;
                        }
                        if ($nama_paire2 == 'usdt') {
                            $coinname = strtoupper($coinname2);
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['huobi_usdt'] = $lastprice;
                        }
                    }
                    //Binance
                    foreach ($binance_query as $filter) {
                        $nama_paire1 = substr($filter['coinname'], -3);
                        $coinname1 = substr($filter['coinname'], 0, -3);
                        $nama_paire2 = substr($filter['coinname'], -4);
                        $coinname2 = substr($filter['coinname'], 0, -4);
                        if ($nama_paire1 == 'BTC') {
                            $coinname = strtoupper($coinname1);
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['binance_btc'] = $lastprice;
                        }
                        if ($nama_paire1 == 'ETH') {
                            $coinname = strtoupper($coinname1);
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['binance_eth'] = $lastprice;
                        }
                        if ($nama_paire1 == 'BNB') {
                            $coinname = strtoupper($coinname1);
                            $lastprice = $filter['lastprice'] * $bnbidr;
                            $result[$coinname]['binance_bnb'] = $lastprice;
                        }
                        if ($nama_paire2 == 'TUSD') {
                            $coinname = strtoupper($coinname2);
                            $lastprice = $filter['lastprice'];
                            $result[$coinname]['binance_tusd'] = $lastprice;
                        }
                        if ($nama_paire2 == 'USDT') {
                            $coinname = strtoupper($coinname2);
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['binance_usdt'] = $lastprice;
                        }
                    }

                //bittrex
                    foreach ($bittrex_query as $filter) {
                        $nama_coinne = explode("-",$filter['coinname']);
                        $nama_paire = $nama_coinne[0];
                        $coinname = strtoupper($nama_coinne[1]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['bittrex_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['bittrex_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['bittrex_usdt'] = $lastprice;
                        }
                    }
                //okex
                    foreach ($okex_query as $filter) {
                        $nama_coinne = explode("_",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'btc') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['okex_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'eth') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['okex_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'usdt') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['okex_usdt'] = $lastprice;
                        }
                    }
                //Indodax
                    foreach($indodax_query as $filter){
                        $nama_coinne = substr($filter['coinname'],0, -3);
                        $nama_paire = substr($filter['coinname'], -3);
                        $coinname = strtoupper($nama_coinne);
                        if($nama_paire == 'idr'){
                            $lastprice = $filter['lastprice'];
                            $result[$coinname]['indodax_idr'] = $lastprice;
                        }
                        if($nama_paire == 'btc'){
                            $lastprice = $filter['lastprice'];
                            $result[$coinname]['indodax_btc'] = $lastprice;
                        }
                    }
//Bilaxy
                    foreach ($bilaxy_query as $filter) {
                        $nama_coinne = explode("_",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['bilaxy_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['bilaxy_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['bilaxy_usdt'] = $lastprice;
                        }
                    }
// Folgory
                    foreach ($folgory_query as $filter) {
                        $nama_coinne = explode("/",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['folgory_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['folgory_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['folgory_usdt'] = $lastprice;
                        }
                    }
//Coinsbit
                    foreach ($coinsbit_query as $filter) {
                        $nama_coinne = explode("_",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['coinsbit_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['coinsbit_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['coinsbit_usdt'] = $lastprice;
                        }
                    }
//Bkex
                    foreach ($bkex_query as $filter) {
                        $nama_coinne = explode("_",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['bkex_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['bkex_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['bkex_usdt'] = $lastprice;
                        }
                    }
//Bitz
                    foreach ($bitz_query as $filter) {
                        $nama_coinne = explode("_",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'btc') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['bitz_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'eth') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['bitz_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'usdt') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['bitz_usdt'] = $lastprice;
                        }
                    }
//Probitkr
                    foreach ($probitkr_query as $filter) {
                        $nama_coinne = explode("-",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['probitkr_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['probitkr_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['probitkr_usdt'] = $lastprice;
                        }
                        if ($nama_paire == 'KRW') {
                            $namacoinkrw  = strtolower($coinname).'idr';
                            $krwtoidr = IndodaxRawModel::select('lastprice')->where('coinname', '=', $namacoinkrw)->first();              
                            $krwtoidr = $krwtoidr['lastprice'];
                            $lastprice = 11.99 * $filter['lastprice'];
                            $result[$coinname]['probitkr_krw'] = $lastprice;
                            // echo $namacoinkrw.'<br>';
                            // echo $krwtoidr.'<br>';
                            // echo $lastprice.'<br>';
                            // echo $coinname.'<hr>';
                        }
                    }
//Latoken
                    foreach ($latoken_query as $filter) {
                        $nama_coinne = explode("/",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['latoken_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['latoken_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['latoken_usdt'] = $lastprice;
                        }
                    }
//Coinbene
                    foreach ($coinbene_query as $filter) {
                        $nama_coinne = explode("/",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['coinbene_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['coinbene_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['coinbene_usdt'] = $lastprice;
                        }
                    }
// digifinex
                    foreach ($digifinex_query as $filter) {
                        $nama_coinne = explode("_",$filter['coinname']);
                        $nama_paire = $nama_coinne[1];
                        $coinname = strtoupper($nama_coinne[0]);
                        if ($nama_paire == 'btc') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname]['digifinex_btc'] = $lastprice;
                        }
                        if ($nama_paire == 'eth') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname]['digifinex_eth'] = $lastprice;
                        }
                        if ($nama_paire == 'usdt') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname]['digifinex_usdt'] = $lastprice;
                        }
                    }
// Bhex
                    foreach ($bhex_query as $filter) {
                        $nama_paire1 = substr($filter['coinname'], -3);
                        $coinname1 = substr($filter['coinname'], 0, -3);
                        $nama_paire2 = substr($filter['coinname'], -4);
                        $coinname2 = substr($filter['coinname'], 0, -4);
                        if ($nama_paire1 == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname1]['bhex_btc'] = $lastprice;
                        }
                        if ($nama_paire1 == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname1]['bhex_eth'] = $lastprice;
                        }
                        if ($nama_paire2 == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname2]['bhex_usdt'] = $lastprice;
                        }
                    }
// Hitbtc
                    foreach ($hitbtc_query as $filter) {
                        $nama_paire1 = substr($filter['coinname'], -3);
                        $coinname1 = substr($filter['coinname'], 0, -3);
                        $nama_paire2 = substr($filter['coinname'], -4);
                        $coinname2 = substr($filter['coinname'], 0, -4);
                        if ($nama_paire1 == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname1]['hitbtc_btc'] = $lastprice;
                        }
                        if ($nama_paire1 == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname1]['hitbtc_eth'] = $lastprice;
                        }
                        if ($nama_paire2 == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname2]['hitbtc_usdt'] = $lastprice;
                        }
                    }
// Cointiger
                    foreach ($cointiiger_query as $filter) {
                        $nama_paire1 = substr($filter['coinname'], -3);
                        $coinname1 = substr($filter['coinname'], 0, -3);
                        $nama_paire2 = substr($filter['coinname'], -4);
                        $coinname2 = substr($filter['coinname'], 0, -4);
                        if ($nama_paire1 == 'BTC') {
                            $lastprice = $filter['lastprice'] * $btcidr;
                            $result[$coinname1]['cointiger_btc'] = $lastprice;
                        }
                        if ($nama_paire1 == 'ETH') {
                            $lastprice = $filter['lastprice'] * $ethidr;
                            $result[$coinname1]['cointiger_eth'] = $lastprice;;
                        }
                        if ($nama_paire2 == 'USDT') {
                            $lastprice = $filter['lastprice'] * $usdtidr;
                            $result[$coinname2]['cointiger_usdt'] = $lastprice;;
                        }
                    }
        //tokok
        foreach ($tokok_query as $filter) {
            $nama_coinne = explode("_",$filter['coinname']);
            $nama_paire = $nama_coinne[1];
            $coinname = strtoupper($nama_coinne[0]);
            if ($nama_paire == 'BTC') {
                $lastprice = $filter['lastprice'] * $btcidr;
                $result[$coinname]['tokok_btc'] = $lastprice;
            }
            if ($nama_paire == 'ETH') {
                $lastprice = $filter['lastprice'] * $ethidr;
                $result[$coinname]['tokok_eth'] = $lastprice;
            }
            if ($nama_paire == 'USDT') {
                $lastprice = $filter['lastprice'] * $usdtidr;
                $result[$coinname]['tokok_usdt'] = $lastprice;
            }
        }

// Exx
foreach ($exx_query as $filter) {
    $nama_coinne = explode("_",$filter['coinname']);
    $nama_paire = $nama_coinne[1];
    $coinname = strtoupper($nama_coinne[0]);
    if ($nama_paire == 'btc') {
        $lastprice = $filter['lastprice'] * $btcidr;
        $result[$coinname]['exx_btc'] = $lastprice;
    }
    if ($nama_paire == 'eth') {
        $lastprice = $filter['lastprice'] * $ethidr;
        $result[$coinname]['exx_eth'] = $lastprice;
    }
    if ($nama_paire == 'usdt') {
        $lastprice = $filter['lastprice'] * $usdtidr;
        $result[$coinname]['exx_usdt'] = $lastprice;
    }
}
        //Save into table
        foreach($result as $result_list => $value){

            CalcSyncModel::where('coinname', '=', ''.$result_list)->update($value);
        }
        

        // return $oke;
    }

}
