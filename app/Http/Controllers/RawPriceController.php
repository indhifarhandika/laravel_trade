<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Response;
use Illuminate\Support\Facades\DB;
use App\BinanceRawModel;
use App\IndodaxRawModel;
use App\BittrexRawModel;
use App\OkexRawModel;
use App\AexRawModel;
use App\HuobiRawModel;
use App\CoinsbitRawModel;
use App\BilaxyRawModel;
use App\FolgoryRawModel;
use App\BkexRawModel;
use App\BitzRawModel;
use App\P2pb2pRawModel;
use App\ProbitkrRawModel;
use App\BiboxRawModel;
use App\indodaxCoin;
use App\LatokenRawModel;
use App\CoinbeneRawModel;
use App\DigifinexRawModel;
use App\BhexRawModel;
use App\HitbtcRawModel;
use App\CointigerRawModel;
use App\ExxRawModel;
use App\TokokRawModel;

use App\WhitebitRawModel;
use App\BigoneRawModel;
use App\BikiRawModel;
use App\BitassetRawModel;
use App\BitmaxRawModel;
use App\BittrueRawModel;
use App\BybitRawModel;
use App\CoinexRawModel;
use App\CryptonexRawModel;
use App\DcoinRawModel;
use App\IndoexRawModel;
use App\KryptonoRawModel;
use App\LiquidRawModel;
use App\OmgfinRawModel;
use App\VindaxRawModel;
use App\ZbRawModel;

class RawPriceController extends Controller
{
    //
    public function GetCoinIndodax(){
        $data = indodaxCoin::get();
        
        return Response::json($data);
    }

    public function GetAllExc(){
        $data = DB::table('list_exchanger_market')->pluck('market_name');
        
        return Response::json($data);
    }

    public function GetAllCoin(){
        $data = DB::table('calculator')->pluck('coinname');
        
        return Response::json($data);
    }
    
    public function BinanceDataInput() {

        $url = "https://api.binance.com/api/v1/ticker/24hr";
        $data = json_decode(file_get_contents($url), TRUE);

        foreach ($data as $pecahdata) {
            $symbol     = $pecahdata['symbol'];
            $lastprice  = $pecahdata['lastPrice'];
           // $askprice   = $pecahdata['askPrice'];
           // $askqty     = $pecahdata['askQty'];
           // $bidprice   = $pecahdata['bidPrice'];
           // $bidqty     = $pecahdata['bidQty'];

            
            
            if ($pecahdata['count'] >= '1' ) {

                
                if (BinanceRawModel::where('coinname' , '=', $symbol)->exists())
                {   
                    
                    BinanceRawModel::where('coinname', '=', $symbol)
                    ->update(
                        ['coinname'     => $symbol,
                         'lastprice'    => $lastprice
                       //  'askprice'     => $askprice,
                       //  'askqty'       => $askqty,
                       //  'bidprice'     => $bidprice,
                         //'bidqty'       => $bidqty          
                        ]);

                } else {
                    $insert = new BinanceRawModel();
                    $insert->coinname   = $symbol;
                    $insert->lastprice  = $lastprice;
                 //   $insert->askprice   = $askprice;
                 //   $insert->askqty     = $askqty;
                //    $insert->bidprice   = $bidprice;
                //    $insert->bidqty     = $bidqty;
                    $insert->save();
                }
            }
        }
        echo 'Success Run Binance Raw';
    }

    public function OkexDataInput() {

        $url = "https://www.okex.com/v2/spot/markets/tickers";
        $data = json_decode(file_get_contents($url), TRUE);

        foreach ($data['data'] as $pecahdata) {
            $symbol = $pecahdata['symbol'];
            $lastprice = $pecahdata['last'];

            if (OkexRawModel::where('coinname' , '=', $symbol)->exists())
                {   
                    OkexRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);

            } else {
                    $insert = new OkexRawModel();
                    $insert->coinname = $symbol;
                    $insert->lastprice = $lastprice;
                    $insert->save();
            }
        }
    }

    public function AexDataInput() {

        $url = "https://www.aex.com/httpAPIv2.php";
        $data = json_decode(file_get_contents($url), TRUE);

        foreach ($data as $key => $value) {
            $keycheck = explode("_", $key);
            if (count($keycheck) > 1 || $key == "updatetime" || is_array($value)) { continue; }

            $symbol = $key;
            $lastprice = $value;

            if (AexRawModel::where('coinname' , '=', $symbol)->exists())
            {   
                AexRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);

            } else {
                $insert = new AexRawModel();
                $insert->coinname = $symbol;
                $insert->lastprice = $lastprice;
                $insert->save();
            }
        }
    }


    public function HuobiDataInput() {
        $url = "https://api.huobi.pro/market/tickers";
        $data = json_decode(file_get_contents($url), TRUE);

        foreach ($data['data'] as $pecahdata) {
            $symbol = $pecahdata['symbol'];
            $lastprice = $pecahdata['close'];

            if (HuobiRawModel::where('coinname' , '=', $symbol)->exists())
                {   
                    HuobiRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);

            } else {
                    $insert = new HuobiRawModel();
                    $insert->coinname = $symbol;
                    $insert->lastprice = $lastprice;
                    $insert->save();
            }
        }




    }


    public function IndodaxDataInput() {
        $url = "https://indodax.com/api/btc_idr/webdata";
        $data = json_decode(file_get_contents($url), TRUE);
        $rawdata = $data['prices'];

        foreach ($rawdata as $key => $value ) {
            $coinname = $key;
            $lastprice = $value;
            // print_r($rawdata);
            if ($coinname == 'stridr') {
                $coinname = 'xlmidr';
            }

            if ($coinname == 'strbtc') {
                $coinname = 'xlmbtc';
            }

            if ($coinname == 'drkidr') {
                $coinname = 'dashidr';
            }

            if ($coinname == 'drkbtc') {
                $coinname = 'dashbtc';
            }
            
            $listcoin = substr($coinname, 0, -3);
            echo $listcoin.' ==> ';
            if (indodaxCoin::where('coinname' , '=', $listcoin)->exists()) {

                indodaxCoin::where('coinname', '=', $listcoin)->update(['coinname' => $listcoin]);

            } else {
                $insert = new indodaxCoin();
                $insert->coinname = $listcoin;
                $insert->save();
            }

                if (IndodaxRawModel::where('coinname' , '=', $coinname)->exists()) {
                    IndodaxRawModel::where('coinname', '=', $coinname)->update(['coinname' => $coinname, 'lastprice' => $lastprice]);
                    echo $coinname.' ==> '.$lastprice.' Update<br>';
                } else {
                    $insert = new IndodaxRawModel();
                    $insert->coinname = $coinname;
                    $insert->lastprice = $lastprice;
                    $insert->save();
                    echo $coinname.' ==> '.$lastprice.' Baru <br>';
                }
        }
    }

    public function BittrexDataInput() {
        $url = "https://international.bittrex.com/api/v1.1/public/getmarketsummaries";
        $data = json_decode(file_get_contents($url), TRUE);
        $rawdata = $data['result'];

        foreach ($rawdata as $pecahdata) {
            $symbol = $pecahdata['MarketName'];
            $lastprice = $pecahdata['Last'];
                
                if (BittrexRawModel::where('coinname' , '=', $symbol)->exists())
                {   

                    BittrexRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);

                } else {
                    $insert = new BittrexRawModel();
                    $insert->coinname = $symbol;
                    $insert->lastprice = $lastprice;
                    $insert->save();
                }

        }
    }

    public function BilaxyDataInput() {
        $url = "https://newapi.bilaxy.com/v1/ticker/24hr";
        $data = json_decode(file_get_contents($url), TRUE);

        foreach ($data as $key => $value) {
            $keycheck = explode("_", $key);

            $symbol = $key;
            $lastprice = $value['close'];
            
            if (BilaxyRawModel::where('coinname' , '=', $symbol)->exists())
                {   
                    BilaxyRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    echo $symbol.' ==> '.$lastprice.' Update<br>';
            } else {
                    $insert = new BilaxyRawModel();
                    $insert->coinname = $symbol;
                    $insert->lastprice = $lastprice;
                    $insert->save();
                    echo $symbol.' ==> '.$lastprice.' Baru <br>';
            }
        }
    }

    public function FolgoryDataInput() {
        $url = "https://folgory.com/api/v1";
        $data = json_decode(file_get_contents($url), TRUE);
        foreach ($data as $key) {

            $symbol = $key['symbol'];
            $lastprice = $key['last'];
            // echo $lastprice.'<br>';
            
            if (FolgoryRawModel::where('coinname' , '=', $symbol)->exists())
                {   
                    FolgoryRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    echo $symbol.' ==> '.$lastprice.' Update<br>';
            } else {
                    $insert = new FolgoryRawModel();
                    $insert->coinname = $symbol;
                    $insert->lastprice = $lastprice;
                    $insert->save();
                    echo $symbol.' ==> '.$lastprice.' Baru <br>';
            }
        }
    }
    
    public function CoinsbitDataInput() {
        $url = "https://coinsbit.io/api/v1/public/tickers";
        $data = json_decode(file_get_contents($url), TRUE);
        foreach ($data['result'] as $key => $value) {
            $symbol = $key;
            $lastprice = $value['ticker']['last'];
            echo $symbol.'<br>';
            
            if (CoinsbitRawModel::where('coinname' , '=', $symbol)->exists())
                {   
                    CoinsbitRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    echo $symbol.' ==> '.$lastprice.' Update<br>';

            } else {
                    $insert = new CoinsbitRawModel();
                    $insert->coinname = $symbol;
                    $insert->lastprice = $lastprice;
                    $insert->save();
                    echo $symbol.' ==> '.$lastprice.' Baru <br>';
            }
        }
    }

    public function BkexDataInput() {
        $url = "https://api.bkex.com/v1/q/tickers";
        $data = json_decode(file_get_contents($url), TRUE);
        foreach ($data['data'] as $key) {
            $symbol = $key['pair'];
            $lastprice = $key['c'];
            echo $symbol.' ==> '.$lastprice.' <br>';
            if (BkexRawModel::where('coinname' , '=', $symbol)->exists())
                {   
                    BkexRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    echo $symbol.' ==> '.$lastprice.' Update<br>';

            } else {
                    $insert = new BkexRawModel();
                    $insert->coinname = $symbol;
                    $insert->lastprice = $lastprice;
                    $insert->save();
                    echo $symbol.' ==> '.$lastprice.' Baru <br>';
            }
        }
    }

    public function BitzDataInput() {
        $url = "https://apiv2.bitz.com/Market/tickerall";
        $data = json_decode(file_get_contents($url), TRUE);
        foreach ($data['data'] as $key => $value) {
            $symbol = $value['symbol'];
            $lastprice = $value['now'];
            // echo $value['now'];
            // echo $symbol.' ==> '.$lastprice.' <br>';
            if (BitzRawModel::where('coinname' , '=', $symbol)->exists())
                {   
                    BitzRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    echo $symbol.' ==> '.$lastprice.' Update<br>';

            } else {
                    $insert = new BitzRawModel();
                    $insert->coinname = $symbol;
                    $insert->lastprice = $lastprice;
                    $insert->save();
                    echo $symbol.' ==> '.$lastprice.' Baru <br>';
            }
        }
    }

    public function P2pb2pDataInput() {
        $url = "http://api.p2pb2b.io/api/v2/public/tickers";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data['result'] as $key => $value) {
                $symbol = $key;
                $lastprice = $value['ticker']['last'];
                if (P2pb2pRawModel::where('coinname' , '=', $symbol)->exists()){
                        P2pb2pRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                } else {
                        $insert = new P2pb2pRawModel();
                        $insert->coinname = $symbol;
                        $insert->lastprice = $lastprice;
                        $insert->save();
                }
            }
        }
    }

    public function ProbitkrDataInput() {
        $url = "https://api.probit.com/api/exchange/v1/ticker";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data['data'] as $key => $value) {
                $symbol = $value['market_id'];
                $lastprice = $value['last'];
                if (ProbitkrRawModel::where('coinname' , '=', $symbol)->exists()){
                        ProbitkrRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                } else {
                        $insert = new ProbitkrRawModel();
                        $insert->coinname = $symbol;
                        $insert->lastprice = $lastprice;
                        $insert->save();
                }
            }
        }
    }

    public function BiboxDataInput() {
        $url = "https://api.bibox.com/v1/mdata?cmd=marketAll";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data['result'] as $key => $value) {
                $arr = array($value['coin_symbol'],$value['currency_symbol']);
                $symbol = implode('_',$arr);
                $lastprice = $value['last'];
                if (BiboxRawModel::where('coinname' , '=', $symbol)->exists()){
                        BiboxRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                } else {
                        $insert = new BiboxRawModel();
                        $insert->coinname = $symbol;
                        $insert->lastprice = $lastprice;
                        $insert->save();
                }
            }
        }
    }

    public function LatokenDataInput() {
        $url = "https://api.latoken.com/v2/ticker";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data as $key ) {
                $symbol = $key['symbol'];
                $lastprice = $key['lastPrice'];
                if (LatokenRawModel::where('coinname' , '=', $symbol)->exists()){
                        LatokenRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                } else {
                        $insert = new LatokenRawModel();
                        $insert->coinname = $symbol;
                        $insert->lastprice = $lastprice;
                        $insert->save();
                }
            }
        }
    }

    public function CoinbeneDataInput() {
        $url = "http://openapi-exchange.coinbene.com/api/exchange/v2/market/ticker/list";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            $data = $data['data'];
            foreach ($data as $key) {
                $symbol = $key['symbol'];
                $lastprice = $key['latestPrice'];
                if (CoinbeneRawModel::where('coinname' , '=', $symbol)->exists()) {   
                        CoinbeneRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                } else {
                        $insert = new CoinbeneRawModel();
                        $insert->coinname = $symbol;
                        $insert->lastprice = $lastprice;
                        $insert->save();
                }
            }
        }
    }

    public function DigifinexDataInput() {
        $url = "https://openapi.digifinex.com/v3/ticker";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data['ticker'] as $key => $value) {
                $symbol = $value['symbol'];
                $lastprice = $value['last'];
                if (DigifinexRawModel::where('coinname' , '=', $symbol)->exists()){
                        DigifinexRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                } else {
                        $insert = new DigifinexRawModel();
                        $insert->coinname = $symbol;
                        $insert->lastprice = $lastprice;
                        $insert->save();
                }
            }
        }
    }

    public function BhexDataInput() {
        $url = "https://api.bhex.com/openapi/quote/v1/ticker/24hr";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data as  $value) {
                $symbol = $value['symbol'];
                $lastprice = $value['lastPrice'];
                if (BhexRawModel::where('coinname' , '=', $symbol)->exists()){   
                        BhexRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                } else {
                        $insert = new BhexRawModel();
                        $insert->coinname = $symbol;
                        $insert->lastprice = $lastprice;
                        $insert->save();
                }
            }
        }
    }

    public function HitbtcDataInput() {
        $url = "https://api.hitbtc.com/api/2/public/ticker";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data as  $value) {
                $symbol = $value['symbol'];
                $lastprice = $value['last'];
                if (HitbtcRawModel::where('coinname' , '=', $symbol)->exists()){
                        HitbtcRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                } else {
                        $insert = new HitbtcRawModel();
                        $insert->coinname = $symbol;
                        $insert->lastprice = $lastprice;
                        $insert->save();
                }
            }
        }
    }

    public function CointigerDataInput() {
        $url = "https://www.cointiger.com/exchange/api/public/market/detail";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data as $key => $value) {
                $symbol = $key;
                $lastprice = $value['last'];
                if (CointigerRawModel::where('coinname' , '=', $symbol)->exists()) {   
                        CointigerRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                } else {
                        $insert = new CointigerRawModel();
                        $insert->coinname = $symbol;
                        $insert->lastprice = $lastprice;
                        $insert->save();
                }
            }
        }
    }

    public function ExxDataInput() {
        $url = "https://api.exx.com/data/v1/tickers";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data as $key => $value) {
                $symbol = $key;
                $lastprice = $value['last'];
                if (ExxRawModel::where('coinname' , '=', $symbol)->exists()) {   
                        ExxRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                } else {
                        $insert = new ExxRawModel();
                        $insert->coinname = $symbol;
                        $insert->lastprice = $lastprice;
                        $insert->save();
                }
            }
        }
    }

    public function TokokDataInput() {
        $url = "https://www.tokok.com/api/v1/tickers";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            $data = $data['ticker'];
            foreach ($data as $key ) {
                $symbol = $key['symbol'];
                $lastprice = $key['last'];
                if (TokokRawModel::where('coinname' , '=', $symbol)->exists()){   
                        TokokRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                } else {
                        $insert = new TokokRawModel();
                        $insert->coinname = $symbol;
                        $insert->lastprice = $lastprice;
                        $insert->save();
                }
            }
        }
    }

    public function BikiDataInput(){
        $url = "https://openapi.biki.com/open/api/get_allticker";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data['data']['ticker'] as $value) {
                $symbol = $value['symbol'];
                $lastprice = $value['last'];

                if($lastprice != 0){
                    if (BikiRawModel::where('coinname' , '=', $symbol)->exists()){   
                        BikiRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new BikiRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
    }

    public function DcoinDataInput(){
        $url = "https://openapi.dcoin.com/open/api/market";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data['data'] as $key => $value) {
                $symbol = $key;
                $lastprice = $value;
                if($lastprice != 0){
                    if (DcoinRawModel::where('coinname' , '=', $symbol)->exists()){   
                        DcoinRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new DcoinRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
    }

    public function ZbDataInput(){
        $url = "http://api.zb.live/data/v1/allTicker";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data as $key => $value) {
                $symbol = $key;
                $lastprice = $value['last'];
                if($lastprice != 0){
                    if (ZbRawModel::where('coinname' , '=', $symbol)->exists()){   
                        ZbRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new ZbRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
    }

    public function BybitDataInput(){
        $url = "https://api-testnet.bybit.com/v2/public/tickers";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data['result'] as $value) {
                $symbol = $value['symbol'];
                $lastprice = $value['last_price'];
                if($lastprice != 0){
                    if (BybitRawModel::where('coinname' , '=', $symbol)->exists()){   
                        BybitRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new BybitRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
    }

    public function WhitebitDataInput(){
        $url = "https://whitebit.com/api/v1/public/tickers";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            $data = $data['result'];
            foreach ($data as $key => $value) {
                $symbol = $key;
                $lastprice = $value['ticker']['last'];
                if($lastprice != 0){
                    if (WhitebitRawModel::where('coinname' , '=', $symbol)->exists()){   
                        WhitebitRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new WhitebitRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
        echo "Success";
    }

    public function CryptonexDataInput(){
        $url = "https://stats.cryptonex.org/get_rate_list";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            $data = $data['rates'];
            foreach ($data as $value) {
                $symbol = $value['alias'];
                $lastprice = $value['last_price'];
                if($lastprice != 0){
                    if (CryptonexRawModel::where('coinname' , '=', $symbol)->exists()){   
                        CryptonexRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new CryptonexRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
    }

    public function OmgfinDataInput(){
        $url = "https://omgfin.com/api/v1/ticker/summary";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data as $key => $value) {
                $symbol = $key;
                $lastprice = $value['last'];
                if($lastprice != 0){
                    if (OmgfinRawModel::where('coinname' , '=', $symbol)->exists()){   
                        OmgfinRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new OmgfinRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
    }

    public function BitassetDataInput(){
        $url = "https://api.bitasset.com/spot/api/v1/tickers";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            $data = $data['ticker'];
            foreach ($data as $value) {
                $symbol = $value['symbol'];
                $lastprice = $value['last'];
                if($lastprice != 0){
                    if (BitassetRawModel::where('coinname' , '=', $symbol)->exists()){   
                        BitassetRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new BitassetRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
    }

    public function BigoneDataInput(){
        $url = "https://bigone.com/api/v3/asset_pairs/tickers";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            $data = $data['data'];
            foreach ($data as $key => $value) {
                $symbol = $value['asset_pair_name'];
                $lastprice = $value['close'];
                if($lastprice != 0){
                    if (BigoneRawModel::where('coinname' , '=', $symbol)->exists()){   
                        BigoneRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new BigoneRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
    }

    public function CoinexDataInput(){
        $url = "https://api.coinex.com/v1/market/ticker/all";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null && json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            $data = $data['data']['ticker'];
            foreach ($data as $key => $value) {
                $symbol = $key;
                $lastprice = $value['last'];
                if($lastprice != 0){
                    if (CoinexRawModel::where('coinname' , '=', $symbol)->exists()){   
                        CoinexRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new CoinexRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
    }

    public function VindaxDataInput(){
        $url = "https://api.vindax.com/api/v1/ticker/24hr";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null || json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data as $value) {
                $symbol = $value['symbol'];
                $lastprice = $value['lastPrice'];
                if($lastprice != 0){
                    if (VindaxRawModel::where('coinname' , '=', $symbol)->exists()){   
                        VindaxRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new VindaxRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
    }

    public function LiquidDataInput(){
        $url = "https://api.liquid.com/products";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null || json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data as $value) {
                $symbol = $value['currency_pair_code'];
                $lastprice = $value['last_price_24h'];
                if($lastprice != 0){
                    if (LiquidRawModel::where('coinname' , '=', $symbol)->exists()){   
                        LiquidRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new LiquidRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
    }

    public function BitmaxDataInput(){
        $url = "https://bitmax.io/api/pro/v1/ticker";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null || json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data['data'] as $value) {
                $symbol = $value['symbol'];
                $lastprice = $value['close'];
                if($lastprice != 0){
                    if($symbol == 'BTC-PERP'){
                        $symbol = 'BTC/PERP';
                    }
                    if (BitmaxRawModel::where('coinname' , '=', $symbol)->exists()){   
                        BitmaxRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new BitmaxRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
    }

    public function BittrueDataInput(){
        $url = "https://www.bitrue.com/kline-api/public.json?command=returnTicker";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null || json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data['data'] as $key => $value) {
                $symbol = $key;
                $lastprice = $value['last'];
                if($lastprice != 0){
                    if (BittrueRawModel::where('coinname' , '=', $symbol)->exists()){   
                        BittrueRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new BittrueRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
    }

    public function KryptonoDataInput(){
        $url = "https://api.kryptono.exchange/v1/getmarketsummaries";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null || json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data['result'] as $key => $value) {
                $symbol = $value['MarketName'];
                $lastprice = $value['Last'];
                if($lastprice != 0){
                    if (KryptonoRawModel::where('coinname' , '=', $symbol)->exists()){   
                        KryptonoRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new KryptonoRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
    }

    public function IndoexDataInput(){
        $url = "https://api.indoex.io/getCompleteMarkets/";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null || json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data['marketdetails'] as $key => $value) {
                $symbol = $value['pair'];
                $lastprice = $value['last'];
                if($lastprice != 0){
                    if (IndoexRawModel::where('coinname' , '=', $symbol)->exists()){   
                        IndoexRawModel::where('coinname', '=', $symbol)->update(['coinname' => $symbol, 'lastprice' => $lastprice]);
                    } else {
                            $insert = new IndoexRawModel();
                            $insert->coinname = $symbol;
                            $insert->lastprice = $lastprice;
                            $insert->save();
                    }
                }
            }
        }
    }
    public function tesURL(){
        
        $url = "https://api.indoex.io/getCompleteMarkets/";
        $data = json_decode(file_get_contents($url), TRUE);
        if($data === null || json_last_error() !== JSON_ERROR_NONE){
            echo "Error";
        }else{
            echo "Success";
            foreach ($data['marketdetails'] as $key => $value) {
                $symbol = $value['pair'];
                $lastprice = $value['last'];
                // print_r($value['last']);
                if($lastprice != 0){
                    echo $symbol.' ==> '.$lastprice.' New<br>';
                }
            }
        }
        
    }

    // // list API exchanger baru
    // bkex
    // https://api.bkex.com/v1/q/ticker?pair=ETH_USDT
    // fatbtc
    // https://www.fatbtc.com/m/allticker/1/
    // bitforex
    // https://api.bitforex.com/api/v1/market/ticker?symbol=coin-usdt-btc
    // coinsbit
    // https://coinsbit.io/api/v1/public/tickers
    // bilaxy
    // https://newapi.bilaxy.com/v1/ticker/24hr
    // folgory
    // https://folgory.com/api/v1
    // lbank
    // https://api.lbkex.com/v2/ticker.do?symbol=eth_btc
    // openapi
    // https://openapi.dcoin.com/open/api/get_ticker?symbol=btcusdt
    // LATOKEN
    // https://api.latoken.com/v2/ticker

    //https://www.bitmex.com/api/v1/position?filter=XBTUSD&columns=lastPrice&count=20
    // https://openapi.biki.com/open/api/get_allticker
    // https://api.bitforex.com/api/v1/market/ticker?symbol=coin-usdt-btc
    // https://api.exrates.me/v1/public/ticker?pair=BTCUSD
    // https://www.catex.io/api/order?market=ETH/BTC&limit=50
    // https://api.rightbtc.com/v1/pub/ticker
    // https://trade.tagz.com/marketdata/market/ticker
    // https://api-public.sandbox.pro.coinbase.com/products/BTC-USD/ticker
    // https://api.kraken.com/0/public/Ticker?pair=btc/eur
    // https://api.bithumb.com/public/ticker/all/USDT
    // https://www.jex.com/api/v1/contract/ticker/24hr
    // https://api-pub.bitfinex.com/v2/tickers?symbols=ALL
    // https://id-api.upbit.com/v1/ticker?markets=BTC-XRP

}
