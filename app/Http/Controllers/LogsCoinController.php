<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\ListExchangerModel;
use App\CalcSyncModel;


class LogsCoinController extends Controller
{
    public function createTableLogsCoin(){
        $arr_Coin = array('btc','eth','xrp','usdt','bch','ltc','bsv','eos','bnb','xtz','leo','link','xlm','ada','trx','xmr','ht','cro','etc','dash','hedg','usdc','neo','miota','atom','xem','mkr','zec','ont','doge','ftt','bat','pax','okb','vet','qtum','tusd','dcr','algo','dai','btg','zrx','busd','icx','lsk','zb','hbar','knc','waves','kcs','rvn','rep','snx','bcd','mona','omg','dx','nexo','nano','hot','ckb','steem','theta','btm','dgd','mco','bcn','zen','sc','dgb','abbc','btt','luna','enj','seele','hc','vsys','zil','kmd','ren','bts','xvg','iost','eurs','mof','matic','ardr','yap','snt','ae','lend','xzc','lrc','gnt','chz','nrg','elf','waxp','maid','rif');
        foreach($arr_Coin as $table){
            $checktable         = Schema::connection('mysql2')->hasTable('logs_'.$table);
            $nama_table = 'logs_'.$table;
            if ($checktable == 1) 
            {
                echo 'table exist';
            } else {
                // echo $nama_table;
                DB::connection('mysql2')->statement( 'create table '.$nama_table.' like logs_bitcoin');
                echo 'Sukses';
            }
        }
    }

    public function LogsCoin(){
        $allExchanger = ListExchangerModel::select('market_name')->get('market_name');
        $market_list = array();
        foreach($allExchanger as $exchanger){
            $data = $exchanger['market_name'];
            $market_list[] = $data;
        }
        $arr_last = array();
        $arr_Coin = array('BTC','ETH','XRP','USDT','BCH','LTC','BSV','EOS','BNB','XTZ','LEO','LINK','XLM','ADA','TRX','XMR','HT','CRO','ETC','DASH','HEDG','USDC','NEO','MIOTA','ATOM','XEM','MKR','ZEC','ONT','DOGE','FTT','BAT','PAX','OKB','VET','QTUM','TUSD','DCR','ALGO','DAI','BTG','ZRX','BUSD','ICX','LSK','ZB','HBAR','KNC','WAVES','KCS','RVN','REP','SNX','BCD','MONA','OMG','DX','NEXO','NANO','HOT','CKB','STEEM','THETA','BTM','DGD','MCO','BCN','ZEN','SC','DGB','ABBC','BTT','LUNA','ENJ','SEELE','HC','VSYS','ZIL','KMD','REN','BTS','XVG','IOST','EURS','MOF','MATIC','ARDR','YAP','SNT','AE','LEND','XZC','LRC','GNT','CHZ','NRG','ELF','WAXP','MAID','RIF');
        $query_calculator       =       DB::table('calculator')->get();
        foreach($query_calculator as $key => $value){
            $coine          =       $value->coinname;
            if(in_array($coine,$arr_Coin)){
                $logs  = 'logs_'.strtolower($coine);
                $arr_last['coinname'] = $coine;
                    foreach($market_list as $market){
                        $arr_last[$market] = $value->$market;
                    }
                DB::connection('mysql2')->table($logs)->insert($arr_last);
            }
        }
        echo 'Sukses';
    }

    public function seeGraph(){
        
        $allExchanger = ListExchangerModel::select('market_name')->get('market_name');
        $market_list = array();
        foreach($allExchanger as $exchanger){
            $data = $exchanger['market_name'];
            $market_list[] = $data;
        }

        $dataBTC = DB::connection('mysql2')->table('logs_bitcoin')->get();
        // $dataBTC = $dataBTC->toArray();
        $arr_btc = array();
        $arr_market = array();
        $arr_tanggal = array();
        // $datae = json_decode($dataBTC);
        $i=0;
        foreach($dataBTC as $data => $value){
            foreach($market_list as $market){
                $arr_btc[$i][$market] = $value->$market;
                // $arr_market[$i][] = $market;
            }
            $arr_tanggal[$i][] = strtotime($value->date)*1000;
            $i++;
        }

        // return response()->json($arr_btc);
        return view('pages/forGraph',['market' => $market_list,'data' => $arr_btc,'tanggal' => $arr_tanggal]);
    }

    public function grpahe($coin,$tgl){
        $logs_table = 'logs_'.$coin;

        $allExchanger = ListExchangerModel::select('market_name')->get('market_name');
        $market_list = array();
        foreach($allExchanger as $exchanger){
            $data = $exchanger['market_name'];
            $market_list[] = $data;
        }
        $kemarin = $tgl;
        if($kemarin == 'none'){
            $kemarin = date('Y-m-d',strtotime("-1 days"));
        }
        $dataBTC = DB::connection('mysql2')->table($logs_table)->where('date','like', '%' .$kemarin. '%')->get();
        // dd($dataBTC);
        $arr_btc = array();
        $i=0;
        foreach($dataBTC as $data => $value){
            foreach($market_list as $market){
                $arr_btc[$market][$value->date] = (float)$value->$market;
                // $arr_btc[$market][strtotime($value->date)*1000] = (float)$value->$market;
            }
            // $arr_tanggal[$i][] = strtotime($value->date)*1000;
            $i++;
        }
        return response()->json($arr_btc);
    }
    public function coin(){
        $arr_Coin = array('btc','eth','xrp','usdt','bch','ltc','bsv','eos','bnb','xtz','leo','link','xlm','ada','trx','xmr','ht','cro','etc','dash','hedg','usdc','neo','miota','atom','xem','mkr','zec','ont','doge','ftt','bat','pax','okb','vet','qtum','tusd','dcr','algo','dai','btg','zrx','busd','icx','lsk','zb','hbar','knc','waves','kcs','rvn','rep','snx','bcd','mona','omg','dx','nexo','nano','hot','ckb','steem','theta','btm','dgd','mco','bcn','zen','sc','dgb','abbc','btt','luna','enj','seele','hc','vsys','zil','kmd','ren','bts','xvg','iost','eurs','mof','matic','ardr','yap','snt','ae','lend','xzc','lrc','gnt','chz','nrg','elf','waxp','maid','rif');
        return response()->json($arr_Coin);
    }

    public function reportBalancer(Request $request){
        DB::connection('mysql2')->table('report_balancer')->insert([
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
        ]);
        echo "Sukses";
    }

    public function getKurs(){
        $kurs = DB::connection('mysql4')->table('getKurs')->select('jumlah')->where('Kurs', '=', 'USDT')->get();
        return response()->json($kurs);
    }
}
