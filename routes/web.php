<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Get From API Exchanber
Route::get('/api/rawbinance', 'RawPriceController@BinanceDataInput');
Route::get('/api/rawindodax', 'RawPriceController@IndodaxDataInput');
Route::get('/api/rawbittrex', 'RawPriceController@BittrexDataInput');
Route::get('/api/rawaex', 'RawPriceController@AexDataInput');
Route::get('/api/rawokex', 'RawPriceController@OkexDataInput');
Route::get('/api/rawhuobi', 'RawPriceController@HuobiDataInput');

Route::get('/api/rawcoinsbit', 'RawPriceController@CoinsbitDataInput');
Route::get('/api/rawbilaxy', 'RawPriceController@BilaxyDataInput');
Route::get('/api/rawfolgory', 'RawPriceController@FolgoryDataInput');
Route::get('/api/rawbkex', 'RawPriceController@BkexDataInput');
Route::get('/api/rawbitz', 'RawPriceController@BitzDataInput');
// Route::get('/api/rawp2pb2b', 'RawPriceController@P2pb2pDataInput');
Route::get('/api/rawprobitkr', 'RawPriceController@ProbitkrDataInput');
// Route::get('/api/rawbibox', 'RawPriceController@BiboxDataInput');
Route::get('/api/rawlatoken', 'RawPriceController@LatokenDataInput');
Route::get('/api/rawcoinbene', 'RawPriceController@CoinbeneDataInput');
Route::get('/api/rawdigifinex', 'RawPriceController@DigifinexDataInput');
Route::get('/api/rawbhex', 'RawPriceController@BhexDataInput');
Route::get('/api/rawhitbtc', 'RawPriceController@HitbtcDataInput');
Route::get('/api/rawcointiger', 'RawPriceController@CointigerDataInput');
Route::get('/api/rawexx', 'RawPriceController@ExxDataInput');
Route::get('/api/rawtokok', 'RawPriceController@TokokDataInput');

Route::get('/api/rawwhitebit', 'RawPriceController@WhitebitDataInput');
Route::get('/api/rawbigone', 'RawPriceController@BigoneDataInput');
Route::get('/api/rawbiki', 'RawPriceController@BikiDataInput');
Route::get('/api/rawbitasset', 'RawPriceController@BitassetDataInput');
Route::get('/api/rawbitmax', 'RawPriceController@BitmaxDataInput');
Route::get('/api/rawbittrue', 'RawPriceController@BittrueDataInput');
Route::get('/api/rawbybit', 'RawPriceController@BybitDataInput');
Route::get('/api/rawcoinex', 'RawPriceController@CoinexDataInput');
Route::get('/api/rawcryptonex', 'RawPriceController@CryptonexDataInput');
Route::get('/api/rawdcoin', 'RawPriceController@DcoinDataInput');
Route::get('/api/rawindoex', 'RawPriceController@IndoexDataInput');
Route::get('/api/rawkryptono', 'RawPriceController@KryptonoDataInput');
Route::get('/api/rawliquid', 'RawPriceController@LiquidDataInput');
Route::get('/api/rawomgfin', 'RawPriceController@OmgfinDataInput');
Route::get('/api/rawvindax', 'RawPriceController@VindaxDataInput');
Route::get('/api/rawzb', 'RawPriceController@ZbDataInput');



//Input to Calculator Table
Route::get('/api/syncbinance', 'CalcSyncController@BinanceData');
Route::get('/api/syncindodax', 'CalcSyncController@IndodaxData');
Route::get('/api/syncbittrex', 'CalcSyncController@BittrexData');
Route::get('/api/syncokex', 'CalcSyncController@OkexData');
Route::get('/api/syncaex', 'CalcSyncController@AexData');
Route::get('/api/synchuobi', 'CalcSyncController@HuobiData');

Route::get('/api/syncbilaxy', 'CalcSyncController@BilaxyData');
Route::get('/api/syncfolgory', 'CalcSyncController@FolgoryData');
Route::get('/api/synccoinsbit', 'CalcSyncController@CoinsbitData');
Route::get('/api/syncbkex', 'CalcSyncController@BkexData');
Route::get('/api/syncbitz', 'CalcSyncController@BitzData');
// Route::get('/api/syncp2pb2b', 'CalcSyncController@P2pb2pData');
Route::get('/api/syncprobitkr', 'CalcSyncController@ProbitkrData');
// Route::get('/api/syncbibox', 'CalcSyncController@BiboxData');
Route::get('/api/synclatoken', 'CalcSyncController@LatokenData');
Route::get('/api/synccoinbene', 'CalcSyncController@CoinbeneData');
Route::get('/api/syncdigifinex', 'CalcSyncController@DigifinexData');
Route::get('/api/syncbhex', 'CalcSyncController@BhexData');
Route::get('/api/synchitbtc', 'CalcSyncController@HitbtcData');
Route::get('/api/synccointiger', 'CalcSyncController@CointigerData');
Route::get('/api/syncexx', 'CalcSyncController@ExxData');
Route::get('/api/synctokok', 'CalcSyncController@TokokData');



Route::get('/api/tes','RawPriceController@tesURL');

//Process Potential
Route::get('/api/count/{mode}/{exchange}/{filter}/{pilih}', 'ProcessController@MarkOne');

//Process Count Telegram
Route::get('/count/{mode}/{exchange}/{filter}', 'ProcessController@TelegramCount');

//Process Count Telegram
Route::get('/telegramsent', 'ProcessController@TelegramSent');
Route::get('/extremesent', 'ProcessController@ExtremeSent');

//Process Circle Balancer
Route::get('/circlebalancer', 'ProcessController@CircleBalancer');


Route::get('get_exchanger', 'ProcessController@get_exchanger');

//Manual Calc
Route::get('/api/getCoin','RawPriceController@GetCoinIndodax');
Route::get('/api/getAllExc','RawPriceController@GetAllExc');
Route::get('/api/getAllCoin','RawPriceController@GetAllCoin');


//AdvCalc
Route::get('/api/saveCoin/{table}/{buy}/{sell}','AdvCalcController@saveCoin');

//AdvSync
Route::get('/api/getKurs','AdvSyncController@getKurs');
Route::get('/api/getKurs2','AdvSyncController@getKurs2');
Route::get('/api/createLogs','LogsCoinController@createTableLogsCoin');
Route::get('/api/getLogs','LogsCoinController@logsCoin');

Route::get('/api/gr/{coin}/{tgl}','LogsCoinController@grpahe');
Route::get('/api/grCoin','LogsCoinController@coin');
Route::post('/report/balancer','LogsCoinController@reportBalancer');

//Test Layout
Route::get('/', function()
{
   return View::make('pages.home');

});

Route::get('/kalkulator', function()
{
   return View::make('pages.kalkulator');

});

Route::get('/seeGraph', function()
{
   return View::make('pages.graphe');
});

Route::get('/reportBalancer', function()
{
   return View::make('pages.hmm');
});

Route::get('/api/kurs','LogsCoinController@getKurs');