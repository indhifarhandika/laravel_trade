@extends('layouts.default')

@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper ">
  <!-- BEGIN: Subheader -->
  <!-- END: Subheader -->
  <div class="m-content" >
    <!-- Start Container class -->
    <div class="container">
    <!-- Start row -->
      <div class="row">
        <!-- start col -->
        <div class="col-md-4">
          <div class="form-group">
            Modal : <input type="number" min="0" name="modal" value="10000000" id="modal">
          </div>
          <div class="form-group">
            exchanger Awal : <select name="exc" id="exchangerAwal">
              <option value="indodax_idr"> Indodax IDR</option>
            </select>
          </div>
          <div class="form-group">
            Pilih Coin : <select name="coinname" id="coin" >
            <!-- Pilih COin : <select name="coinname" id="coin" onChange="getData()"> -->
              <option value="DOGE"> DOGE </option>
            </select>
          </div>
          <div class="form-group">
            exchanger tujuan : <select name="exce" id="exchanger">
              <option value="aex_usdt"> AEX USDT </option>
            </select>
          </div>
          <div class="form-group">
            Pilih COin : <select name="coinnameTujuan" id="coinTujuan" >
            <!-- Pilih COin : <select name="coinname" id="coin" onChange="getData()"> -->
              <option value="DOGE"> DOGE </option>
            </select>
          </div>
          <div class="form-group">
            <button onClick="getData()">Hitung !</button>
          </div>
        </div>
        <!-- end col -->
        <div class="col-md-8">
          <div class="hasile">
            <div id="Rute">
            
            </div>
            <div id="Hasilbeli">
            
            </div>
            <div id="Hasilproses"></div>
            <div id="Hasiljual">
            
            </div>
          </div>
        </div>
      </div>
    <!-- end row -->
    </div>
    <!-- End Container class -->
  </div>
</div>


<!--begin::Base Scripts -->
<!-- <script src="{{ URL::asset('assets/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script> -->
<!--<script src="{{ URL::asset('assets/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Base Scripts -->
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<!-- <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magicsuggest/2.1.4/magicsuggest.js"></script>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script>
localStorage.setItem("url_indodax", "https://indodax.com/api/webdata/...");
localStorage.setItem("url_binance", "https://www.binance.com/api/v3/depth?limit=500&symbol=...");
localStorage.setItem("url_huobi", "https://api.huobi.pro/market/depth?symbol=...&type=step1");
localStorage.setItem("url_aex", "https://api.aex.com/depth.php?mk_type=...&c=...");
localStorage.setItem("url_bittrex", "https://api.bittrex.com/api/v1.1/public/getorderbook?market=...&type=both");


// console.log(localStorage.getItem("url_huobi"))
</script>

<script>

function getData(){
    var modal = $('#modal').val()
    var exA = $('#exchangerAwal').val()
    var coin = $('#coin').val()
    var exT = $('#exchanger').val()
    var coin2 = $('#coinTujuan').val()
  var exA = exA.split("_");
  var exT = exT.split("_");
  var coinA      = coin.toLowerCase()+exA[1];
  var coinB      = coin2.toLowerCase()+exT[1];
  console.log(modal+"-"+exA+"_"+coin+"="+exT+"+"+coin2+"/"+coinA+"*"+coinB)
    var url = localStorage.getItem("url_"+exA[0])
    var urlSplit = url.split("...");
    var urlFix = urlSplit[0] + coinA + urlSplit[1];
    if(exA[0] == 'binance'){
      urlFix = urlSplit[0] + coinA.toUpperCase() + urlSplit[1];
    }
    $.ajax({
        type: 'GET',
        url: urlFix,
        async: false,
        dataType: 'json',
        success: function (data) {
          console.log(exA[0]+' = '+coin)
          setTimeout(parseData(exA[0],coin,data),5000);
            
        }, error: function () {
            console.log(data);
        }
    });
    var url1 = localStorage.getItem("url_"+exT[0])
    var urlSplit1 = url1.split("...");
    var urlFix1 = urlSplit1[0] + coinB + urlSplit1[1];
    if(exT[0] == 'binance'){
      urlFix1 = urlSplit1[0] + coinB.toUpperCase() + urlSplit1[1];
    }
    if(exT[0] == 'aex'){
      urlFix1 = urlSplit1[0] + exT[1] + urlSplit1[1]+ coin;
      console.log(urlSplit1[0])
    }
    $.ajax({
        type: 'GET',
        url: urlFix1,
        async: false,
        dataType: 'json',
        success: function (data) {
          console.log(exT[0]+' = '+coin2)
          setTimeout(parseData(exT[0],coin2, data),5000);
        }, error: function () {
            console.log(data);
        }
    });
    
    var finishCoin = exT[1]+exA[1];
    var url2 = localStorage.getItem("url_"+exA[0])
    var urlSplit2 = url2.split("...");
    var urlFix2 = urlSplit2[0] + finishCoin + urlSplit2[1];
    console.log(urlFix2)
    $.ajax({
        type: 'GET',
        url: urlFix2,
        async: false,
        dataType: 'json',
        success: function (data) {
          console.log(exA[0]+' = '+exT[1])
          setTimeout(parseData(exA[0],exT[1],data),5000);
        }, error: function () {
            console.log(data);
        }
    });
}

function parseData(exchanger,coin,data){
    console.log(coin)
  // console.log(data)
  var priceb = [];
  var amountb = [];
  var totalb = [];
  var prices = [];
  var amounts = [];
  var totals = [];
  var pembagian = 100000000;
  if(exchanger == 'indodax'){
    var a = 0;
    var x = 0;
    var koinkecil = coin.toLowerCase();
    console.log(koinkecil);
    dataApiSell = data['sell_orders'];
    dataApiSell.forEach(function (dataSell) {
        prices[a] = dataSell['price'];
        amounts[a] = dataSell['sum_' + koinkecil] / pembagian;
        totals[a] = amounts[a] * prices[a];
        a++;
    });
    
    dataApiBuy = data['buy_orders'];
    dataApiBuy.forEach(function (dataBuy) {
        priceb[x] = dataBuy['price'];
        totalb[x] = dataBuy['sum_rp'];
        amountb[x] = totalb[x] / priceb[x];
        x++;
    });
    
  }
  if(exchanger == 'bittrex'){

  }
  if(exchanger == 'binance'){
    var data_binance = data;
    var a = 0;
    var x = 0;
    dataApiBuy = data_binance['bids'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli[0]);
        amountb[a] = parseFloat(dataBeli[1]);
        totalb[a] = priceb[a] + amountb[a];
        a++;
    });

    dataApiSell = data_binance['asks'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell[0]);
        amounts[x] = parseFloat(dataSell[1]);
        totals[x] = prices[x] + amounts[x];
        a++;
    });
  }
  if(exchanger == 'huobi'){
    var a = 0;
    var x = 0;

    dataApiBuy = data['tick']['bids'];
    dataApiBuy.forEach(function (dataBeli) {
        priceb[a] = parseFloat(dataBeli[0]);
        amountb[a] = parseFloat(dataBeli[1]);
        totalb[a] = amountb[a] + priceb[a];
        a++;
    });
    

    dataApiSell = data['tick']['asks'];
    dataApiSell.forEach(function (dataSell) {
        prices[x] = dataSell[0];
        amounts[x] = dataSell[1];
        totals[x] = amounts[x] + prices[x];
        x++;
    });

  }
  if(exchanger == 'aex'){
    var data_aex = data;
    var a = 0;
    var x = 0;
    dataApiBuy = data_aex['bids'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli[0]);
        amountb[a] = parseFloat(dataBeli[1]);
        totalb[a] = priceb[a] + amountb[a];
        console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_aex['asks'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell[0]);
        amounts[x] = parseFloat(dataSell[1]);
        totals[x] = prices[x] + amounts[x];
        console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        a++;
    });
  }
  // console.log(totals)
    localStorage.setItem("priceSell"+exchanger+'_'+coin, prices);            //console.log(prices)
    localStorage.setItem("amountSell"+exchanger+'_'+coin, amounts);          //console.log(amounts)
    localStorage.setItem("totalSell"+exchanger+'_'+coin, totals);            //console.log(totals)
    localStorage.setItem("priceBuy"+exchanger+'_'+coin, priceb);             //console.log(priceb)
    localStorage.setItem("amountBuy"+exchanger+'_'+coin, amountb);           //console.log(amountb)
    localStorage.setItem("totalBuy"+exchanger+'_'+coin, totalb);             //console.log(totalb)
}

function Buy(modal){
  var fee = 0.997;
  var x = 0;
  



var priceBuy = [16, 15, 14, 13, 12, 11, 10, 9, 8, 4, 3, 2, 1]
var priceSell = [17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 40, 42, 43, 45, 46, 49, 50, 53, 55, 57, 60, 61, 63, 65, 66, 67, 73, 75, 80, 86, 89, 90, 95, 98, 99, 100, 101, 150, 200, 230, 260, 300, 480, 500, 750, 1000, 1500, 2020, 2345, 2999, 4000, 4500, 4567, 5000, 5678, 7000, 7890, 9925, 9950, 9975, 9999, 10000, 12000, 12500, 12600, 12700, 12750, 13000, 13250, 13500, 13750, 13800, 13999, 14000, 15000, 17000, 20000, 26000, 50000, 99999, 100000, 120000, 150000, 200000, 270000, 1000000, 1234567, 2000000]

var amountBuy = [43815599.25, 10592310.466666667, 6281913.285714285, 3722095.076923077, 1423734.9166666667, 200255.36363636365, 519768, 535676.1111111111, 62500, 541176, 33607, 827744, 10396773]
var amountSell = [7265533.33813971, 17051728.96376821, 11259528.55065908, 13869781.18324597, 10235690.81287687, 9770522.4910031, 11457488.46493069, 7412454.14207135, 10508307.60680286, 7616659.11937753, 17904799.76699172, 10115724.77629405, 10089377.67466811, 7406220.09737525, 1419264.0179262, 812557.86644434, 923736.40216642, 108005.07142856, 985266.89035976, 68343.27841764, 830098.99852482, 6732.99999999, 45828.85735979, 6243.58592131, 4651.46153846, 120199.17017379, 225859.92307692, 435862.76842101, 3762766.44089962, 2600.91304347, 74212, 906806.88553842, 429735.26018099, 247710.57098986, 2727.27272727, 2300.8076923, 2215.59259259, 8125, 980060.93382352, 25111.515, 224272.55533596, 40000, 54210.17647058, 46875, 73123.26315788, 256911.7038679, 1086956.52173912, 1005194.2811094, 30039.22222222, 11109.64473684, 5359400.58934083, 5034, 5002.03846153, 4884.95238095, 17036.19047619, 131845.32848672, 100000, 274364.10049018, 60379.51726298, 251135.47058823, 12500, 9000, 27760.83543771, 77695.65224759, 12500, 239186.03809523, 25000, 7142.85714285, 90754.2941177, 3250, 4500, 3500, 3750, 132087.3, 6000, 5986, 3500, 5986, 3500, 5986, 3000, 3000, 3500, 3000, 4450, 7085.8125, 15505.73333333, 24602.52352941, 52555.55555555, 3123.55769231, 31250, 63216, 56180.88, 3000, 3000, 17951.76284584, 2343, 22347.92032966, 35238.09523809, 5670.5]

var totalBuy = [701049588, 158884657, 87946786, 48387236, 17084819, 2202809, 5197680, 4821085, 500000, 2164704, 100821, 1655488, 10396773]
var totalSell = [123514066.74837507, 306931121.3478278, 213931042.4625225, 277395623.6649194, 214949507.07041427, 214951494.8020682, 263522234.6934059, 177898899.40971237, 262707690.1700715, 198033137.1038158, 483429593.7087764, 283240293.7362334, 292591952.5653752, 222186602.92125753, 43997184.5557122, 26001851.72621888, 30483301.27149186, 3672172.42857104, 34484341.1625916, 2460358.02303504, 30713662.94541834, 255853.99999962, 1833154.2943916002, 262230.60869502, 200012.84615378, 5408962.65782055, 10389556.46153832, 21357275.65262949, 188138322.044981, 137848.39130391, 4081660, 51687992.47568994, 25784115.610859398, 15110344.830381459, 171818.18181801, 149552.4999995, 146229.11111094, 544375, 71544448.16911696, 1883363.625, 17941804.4268768, 3440000, 4824705.70588162, 4218750, 6946709.9999986, 25177346.9790542, 107608695.65217286, 100519428.11094, 3033961.44444422, 1666446.710526, 1071880117.8681661, 1157820, 1300529.9999978, 1465485.714285, 8177371.4285712, 65922664.243360005, 75000000, 274364100.49018, 90569275.89447, 507293650.5882246, 29312500, 26991000, 111043341.75084001, 349630435.114155, 57087500, 1195930190.47615, 141950000, 49999999.99995, 716051380.588653, 32256250, 44775000, 34912500, 37496250, 1320873000, 72000000, 74825000, 44100000, 76022200, 44625000, 77818000, 39750000, 40500000, 48125000, 41400000, 62295550, 99201375, 232585999.99995, 418242899.99996996, 1051111111.1110001, 81212500.00006, 1562500000, 6321536784, 5618088000, 360000000, 450000000, 3590352569.1679997, 632610000, 22347920329.66, 43503789523.803055, 11341000000]
  

  var pricesBuy = [];
  var amountsBuy = [];
  var totalsBuy = [];
  var capital = parseFloat(modal);
    while (capital >= 0) {
        capital = capital - parseFloat(totalBuy[x]);
        rest = capital + parseFloat(totalBuy[x]);

        if (capital <= 0) {
            pricesBuy[x] = priceBuy[x];
            totalsBuy[x] = rest;
            amountsBuy[x] = rest / priceBuy[x];
            
        } else {
            pricesBuy[x] = priceBuy[x];
            totalsBuy[x] = totalBuy[x];
            amountsBuy[x] = amountBuy[x];
            
        }
        // console.log('Detail => '+x+' ==> Price ==> '+pricesBuy[x]+' ==> Amount ==> '+amountsBuy[x]+' ==> Total ==> '+totalsBuy[x]+'')
        x++;
    }
    total_am = amountsBuy.reduce((a, b) => a + b, 0);
    total_tot = totalsBuy.reduce((a, b) => a + b, 0);
    modalNext = total_am * fee;
    localStorage.setItem("modalNext", modalNext);
    console.log('Hasile Buy = '+localStorage.getItem("modalNext"));
}

function Sell(modal){
  console.log('Masuk Sell '+modal)
  var fee = 0.997;
  var x = 0;
  var priceSell = [0.00119, 0.00118, 0.00117, 0.00116, 0.00115, 0.00114, 0.00113, 0.00112, 0.00111, 0.0011, 0.00109, 0.00108, 0.00105, 0.00104, 0.00103, 0.00101, 0.001, 0.00097, 0.0009, 0.00083]
  var amountSell = [2321378.47, 2318044.04, 6851416.95, 1971416.29, 4796029, 16444268.59, 2264386.8, 3812047.72, 685180.83, 1310727.09, 1022830.31, 4356553.01, 1743243.47, 113798.2, 1393875.85, 105291.43, 603658.61, 13875.85, 129572.91, 302233]
  var totalSell = [2321378.4711900004, 2318044.04118, 6851416.95117, 1971416.29116, 4796029.00115, 16444268.59114, 2264386.80113, 3812047.7211200004, 685180.8311099999, 1310727.0911, 1022830.3110900001, 4356553.01108, 1743243.47105, 113798.20104, 1393875.85103, 105291.43101, 603658.611, 13875.85097, 129572.9109, 302233.00083]
  var priceBuy = [0.0012, 0.00121, 0.00122, 0.00123, 0.00124, 0.00125, 0.00126, 0.00127, 0.00128, 0.00129, 0.0013, 0.00131, 0.00132, 0.00133, 0.00134, 0.00135, 0.00136, 0.00137, 0.00138, 0.00139]
  var amountBuy = [350560.09, 5474674.71, 11817483.78, 10229383.87, 6670930.48, 4941191.1, 2937766.27, 4800747.41, 3930973.94, 6776297.11, 10757590.58, 1003064.9, 4363549.21, 1259057.45, 7986293.7, 9122376.689666666, 1765714.15, 2818826.02, 2675258.13, 5293188.66]
  var totalBuy = [420.672108, 6624.356399099999, 14417.330211599998, 12582.142160099998, 8271.953795200001, 6176.488875, 3701.5855002000003, 6096.949210700001, 5031.646643200001, 8741.4232719, 13984.867753999999, 1314.015019, 5759.8849572, 1674.5464084999999, 10701.633558000001, 12315.20853105, 2401.371244, 3861.7916474, 3691.8562193999996, 7357.5322374]
  
  var pricesSell = [];
  var amountsSell = [];
  var totalsSell = [];
  var capital = parseFloat(modal);
  console.log(capital)
    while (capital >= 0) {
    //   console.log(capital)s
      console.log(parseFloat(totalSell[x]))
        capital = capital - parseFloat(totalSell[x]);
        rest = capital + parseFloat(totalSell[x]);
        if (capital <= 0) {
            pricesSell[x] = priceSell[x];
            totalsSell[x] = rest;
            amountsSell[x] = rest * priceSell[x];
        } else {
            pricesSell[x] = priceSell[x];
            totalsSell[x] = totalSell[x];
            amountsSell[x] = priceSell[x] * amountSell[x];
        }
        // console.log('Detail => '+x+' ==> Price ==> '+pricesSell[x]+' ==> Amount ==> '+amountsSell[x]+' ==> Total ==> '+totalsSell[x]+'')
        x++;
    }
    total_am = amountsSell.reduce((a, b) => a + b, 0);
    total_tot = pricesSell.reduce((a, b) => a + b, 0);
    // console.log(total_am +'  ==  '+ total_tot)

    modalNext = total_am * fee;
    localStorage.setItem("modalNext", modalNext);
    console.log('Hasile Sell = '+localStorage.getItem("modalNext"));
}
</script>
@stop
