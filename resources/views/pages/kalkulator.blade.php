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
              <!-- <option value="indodax_idr"> Indodax IDR</option> -->
            </select>
          </div>
          <div class="form-group">
            Pilih Coin : <select name="coinname" id="coin" >
            <!-- Pilih COin : <select name="coinname" id="coin" onChange="getData()"> -->
              <!-- <option value="IGNIS"> IGNIS </option> -->
            </select>
          </div>
          <div class="form-group">
            exchanger tujuan : <select name="exce" id="exchanger">
              <!-- <option value="tokok_eth"> tokok USDT </option> -->
            </select>
          </div>
          <div class="form-group">
            Pilih COin : <select name="coinnameTujuan" id="coinTujuan" >
            <!-- Pilih COin : <select name="coinname" id="coin" onChange="getData()"> -->
              <!-- <option value="IGNIS"> IGNIS </option> -->
            </select>
          </div>
          <div class="form-group">
            <button onClick="hitung()">Hitung !</button>
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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/magicsuggest/2.1.4/magicsuggest.js"></script> -->
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
$.ajax({
      type: 'GET',
      url: 'api/getAllExc',
      dataType: 'json',
        success: function (data) {
          $("#exchangerAwal").select2({
            theme: "classic",
            width: '100%',
              data: data
            })
            $("#exchanger").select2({
            theme: "classic",
            width: '100%',
              data: data
            })
          // $.each(data, function(index, item) {
          //   $('#exchangerAwal').append("<option value="+item+">"+item+"</option>")
          //   $('#exchanger').append("<option value="+item+">"+item+"</option>")
          // });
          console.log(data)         
        },error:function(){
      console.log(data);
  }
});

$.ajax({
      type: 'GET',
      url: 'api/getAllCoin',
      dataType: 'json',
        success: function (data) {
          $("#coin").select2({
            theme: "classic",
            width: '100%',
              data: data
            })
            $("#coinTujuan").select2({
            theme: "classic",
            width: '100%',
              data: data
            })
          // $.each(data, function(index, item) {
          //   $('#coin').append("<option value="+item+">"+item+"</option>")
          //   $('#coinTujuan').append("<option value="+item+">"+item+"</option>")
          // });
},error:function(){
      console.log(data);
  }
});

</script>

<script>

function hitung() {
localStorage.clear();
localStorage.setItem("url_indodax", "https://indodax.com/api/webdata/...");
localStorage.setItem("url_binance", "https://www.binance.com/api/v3/depth?limit=500&symbol=...");
localStorage.setItem("url_huobi", "https://api.huobi.pro/market/depth?symbol=...&type=step0");
localStorage.setItem("url_aex", "https://api.aex.com/depth.php?mk_type=...&c=...");
localStorage.setItem("url_bittrex", "https://api.bittrex.com/api/v1.1/public/getorderbook?market=...&type=both");
localStorage.setItem("url_okex", "https://www.okex.com/api/spot/v3/instruments/.../book");

localStorage.setItem("url_bilaxy", "https://newapi.bilaxy.com/v1/orderbook?pair=...");
localStorage.setItem("url_folgory", "https://folgory.com/market/order_book?symbol=...");
localStorage.setItem("url_coinsbit", "https://coinsbit.io/api/v1/public/book?market=...&side=buy");
localStorage.setItem("url_bkex", "https://api.bkex.com/v1/q/depth?pair=...");
localStorage.setItem("url_bitz", "https://apiv2.bitz.com/Market/depth?symbol=...");
localStorage.setItem("url_probitkr", "https://api.probit.com/api/exchange/v1//order_book?market_id=...");
localStorage.setItem("url_latoken", "https://api.latoken.com/v2/marketOverview/orderbook/...");
localStorage.setItem("url_coinbene", "https://openapi-exchange.coinbene.com/api/exchange/v2/market/orderBook?symbol=...&depth=50");
localStorage.setItem("url_digifinex", "https://openapi.digifinex.com/v3/order_book?symbol=...&limit=50");
localStorage.setItem("url_bhex", "https://api.bhex.com/openapi/quote/v1/depth?symbol=...");
localStorage.setItem("url_hitbtc", "https://api.hitbtc.com/api/2/public/orderbook/...");
localStorage.setItem("url_cointiger", "https://api.cointiger.com/exchange/trading/api/market/depth?api_key=100310001&symbol=...&type=step0");
localStorage.setItem("url_exx", "https://api.exx.com/data/v1/depth?symbols=...");
localStorage.setItem("url_tokok", "https://www.tokok.com/api/v1/depth?symbol=...");
    var modal = $('#modal').val()
    var exA = $('#exchangerAwal').val()
    var coin = $('#coin').val()
    var exT = $('#exchanger').val()
    var coin2 = $('#coinTujuan').val()
    if(coin == 'DASH' ){
      coin = 'DRK';
      // coin2 = 'DRK';
    }
    document.getElementById("Rute").innerHTML = "Modal = "+formatRupiah(modal, "Rp. ")+'<br> Exchanger Awal = '+exA+'<br>Coin = '+coin+'<br> Exchanger Tujuan = '+exT+'<br>Coin Tujuan= '+coin2;
    getData(exA,exT,coin,coin2,modal);
}
function getData(exA,exT,coin,coin2,modal){
  console.log(exA,exT,coin,coin2,modal);

  var exA = exA.split("_");
  var exT = exT.split("_");
  var coinA      = coin.toLowerCase()+exA[1];
  var coinB      = coin2.toLowerCase()+exT[1];
  
    var url = localStorage.getItem("url_"+exA[0])
    var urlSplit = url.split("...");
    var urlFix = urlSplit[0] + coinA + urlSplit[1];
    if(exA[0] == 'binance'){
      urlFix = urlSplit[0] + coinA.toUpperCase() + urlSplit[1];
    console.log(urlFix)
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
    //EOSBNB
    if(exT[0] == 'binance'){
      urlFix1 = urlSplit1[0] + coinB.toUpperCase() + urlSplit1[1];
      console.log(urlFix1)
    }
    //=cnc&c=EOS
    if(exT[0] == 'aex'){
      urlFix1 = urlSplit1[0] + exT[1] + urlSplit1[1]+ coin2;
      console.log(urlFix1)
    }
    // USDT-EOS
    if(exT[0] == 'bittrex'){
      urlFix1 = urlSplit1[0] + exT[1].toUpperCase()+'-'+coin2 + urlSplit1[1];
      console.log(urlSplit1[0])
    }
    //EOS-ETH
    if(exT[0] == 'okex'){
      urlFix1 = urlSplit1[0] + coin2.toUpperCase()+'-'+exT[1].toUpperCase() + urlSplit1[1];
      console.log(urlSplit1[0])
    }
    //XRP_BTC&side=buy
    if(exT[0] == 'coinsbit'){
      urlFix1 = urlSplit1[0] + coin2.toUpperCase()+'_'+exT[1].toUpperCase() + urlSplit1[1];
      console.log(urlSplit1[0])
    }
    //xrpeth
    if(exT[0] == 'bitz' || exT[0] == 'cointiger' ){
      urlFix1 = urlSplit1[0] + coin2.toLowerCase()+''+exT[1] + urlSplit1[1];
      console.log(urlSplit1[0])
    }
    //XRP-BTC
    if(exT[0] == 'probitkr'){
      urlFix1 = urlSplit1[0] + coin2.toUpperCase()+'-'+exT[1].toUpperCase() + urlSplit1[1];
      console.log(urlSplit1[0])
    }
    //EOS/BTC&depth=50
    if(exT[0] == 'coinbene'){
      urlFix1 = urlSplit1[0] + coin2.toUpperCase()+'/'+exT[1].toUpperCase() + urlSplit1[1];
    }
    //format EOS_USDT&limit=50
    if(exT[0] == 'digifinex' || exT[0] == 'bilaxy' || exT[0] == 'latoken' || exT[0] == 'bkex' || exT[0] == 'folgory'){
      urlFix1 = urlSplit1[0] + coin2.toUpperCase()+'_'+exT[1].toUpperCase() + urlSplit1[1];
    }
    //format EOSBTC
    if(exT[0] == 'bhex' || exT[0] == 'hitbtc'){
      urlFix1 = urlSplit1[0] + coinB.toUpperCase() + urlSplit1[1];
    }
    //format eth_btc
    if(exT[0] == 'exx' || exT[0] == 'tokok' ){
      urlFix1 = urlSplit1[0] + coin2.toLowerCase()+'_'+exT[1].toLowerCase() + urlSplit1[1];
    }
    $.ajax({
        type: 'GET',
        url: urlFix1,
        async: false,
        dataType: 'json',
        success: function (data) {
          // console.log(exT[0]+' = '+coin2)
          setTimeout(parseData(exT[0],coin2, data),5000);
        }, error: function () {
            console.log(data);
        }
    });
    
    var finishCoin = exT[1]+exA[1];
    var url2 = localStorage.getItem("url_"+exA[0])
    var urlSplit2 = url2.split("...");
    var urlFix2 = urlSplit2[0] + finishCoin.toLowerCase() + urlSplit2[1];
    // console.log(urlFix2)
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

    setTimeout(Buy(exA[0],coin,modal),5000);
    document.getElementById("Hasilbeli").innerHTML = 'Buy '+exA[0]+' '+coin+' Dapat '+localStorage.getItem("modalNext", modalNext)+' '+coin+'<br>';
    var nextModal = localStorage.getItem("modalNext");
    setTimeout(Sell(exT[0],coin2,nextModal),1000);
    document.getElementById("Hasilproses").innerHTML = 'Sell '+exT[0]+' '+coin2+' Dapat '+localStorage.getItem("Modale"+exT[0])+' '+exT[1].toUpperCase()+'<br>';
    var nextModalSell = localStorage.getItem("Modale"+exT[0]);
    setTimeout(Sell(exA[0],exT[1],nextModalSell),1000);
    var rp = Math.round(localStorage.getItem("Modale"+exA[0]));
    document.getElementById("Hasiljual").innerHTML = 'Sell '+exA[0]+' '+exT[1]+' Dapat <b>'+ formatRupiah(rp, "Rp. ") +'</b> '+exA[1].toUpperCase()+'<br>';
}
function parseData(exchanger,coin,data){
    // console.log(coin)
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
    var data_bittrex = data;
    var a = 0;
    var x = 0;
    console.log(data_bittrex['result']['buy'][0])
    dataApiBuy = data_bittrex['result']['buy'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli['Rate']);
        amountb[a] = parseFloat(dataBeli['Quantity']);
        totalb[a] = priceb[a] * amountb[a];
        // console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_bittrex['result']['buy'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell['Rate']);
        amounts[x] = parseFloat(dataSell['Quantity']);
        totals[x] = prices[x] * amounts[x];
        console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
    });
  }
  if(exchanger == 'binance'){
    var data_binance = data;
    var a = 0;
    var x = 0;
    dataApiBuy = data_binance['bids'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli[0]);
        amountb[a] = parseFloat(dataBeli[1]);
        totalb[a] = priceb[a] * amountb[a];
        // console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_binance['asks'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell[0]);
        amounts[x] = parseFloat(dataSell[1]);
        totals[x] = prices[x] * amounts[x];
        // console.log("Detail Get Api Buy = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
    });
  }
  if(exchanger == 'huobi'){
    var a = 0;
    var x = 0;
    var r = [];
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
        totalb[a] = priceb[a] * amountb[a];
        console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_aex['asks'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell[0]);
        amounts[x] = parseFloat(dataSell[1]);
        totals[x] = prices[x] * amounts[x];
        console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
    });
  }
  if(exchanger == 'okex'){
    var data_okex = data;
    var a = 0;
    var x = 0;
    console.log(data_okex['bids'])
    dataApiBuy = data_okex['bids'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli[0]);
        amountb[a] = parseFloat(dataBeli[1]);
        totalb[a] = priceb[a] * amountb[a];
        console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_okex['asks'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell[0]);
        amounts[x] = parseFloat(dataSell[1]);
        totals[x] = prices[x] * amounts[x];
        console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
    });
  }
  if(exchanger == 'bilaxy'){
    var data_bilaxy = data;
    var a = 0;
    var x = 0;
    console.log(data_bilaxy)
    dataApiBuy = data_bilaxy['bids'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli[0]);
        amountb[a] = parseFloat(dataBeli[1]);
        totalb[a] = priceb[a] * amountb[a];
        console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_bilaxy['asks'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell[0]);
        amounts[x] = parseFloat(dataSell[1]);
        totals[x] = prices[x] * amounts[x];
        console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
    });
  }
  if(exchanger == 'folgory'){
    var data_folgory = data;
    var a = 0;
    var x = 0;
    console.log(data_folgory['data']['asks'])
    dataApiBuy = data_folgory['data']['bids'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli[1]);
        amountb[a] = parseFloat(dataBeli[0]);
        totalb[a] = priceb[a] * amountb[a];
        console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_folgory['data']['asks'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell[1]);
        amounts[x] = parseFloat(dataSell[0]);
        totals[x] = prices[x] * amounts[x];
        console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
    });
  }
  if(exchanger == 'coinsbit'){
    var data_coinsbit = data;
    var a = 0;
    var x = 0;
    console.log(data_coinsbit['result']['orders'])
    dataApiBuy = data_coinsbit['result']['orders'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli['price']);
        amountb[a] = parseFloat(dataBeli['amount']);
        totalb[a] = priceb[a] * amountb[a];
        console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_coinsbit['result']['orders'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell['price']);
        amounts[x] = parseFloat(dataSell['amount']);
        totals[x] = prices[x] * amounts[x];
        console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
    });
  }
  if(exchanger == 'bkex'){
    var data_bkex = data;
    var a = 0;
    var x = 0;
    console.log(data_bkex['data'])
    dataApiBuy = data_bkex['data']['bids'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli['price']);
        amountb[a] = parseFloat(dataBeli['amt']);
        totalb[a] = priceb[a] * amountb[a];
        console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_bkex['data']['asks'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell['price']);
        amounts[x] = parseFloat(dataSell['amt']);
        totals[x] = prices[x] * amounts[x];
        console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
    });
  }
  if(exchanger == 'bitz'){
    var data_bitz = data;
    var a = 0;
    var x = 0;
    console.log(data_bitz['data'])
    dataApiBuy = data_bitz['data']['bids'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli[0]);
        amountb[a] = parseFloat(dataBeli[1]);
        totalb[a] = priceb[a] * amountb[a];
        console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_bitz['data']['asks'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell[0]);
        amounts[x] = parseFloat(dataSell[1]);
        totals[x] = prices[x] * amounts[x];
        console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
    });
  }
  if(exchanger == 'probitkr'){
    var data_probitkr = data;
    var a = 0;
    var x = 0;
    
    console.log(data_probitkr['data'])
    dataApiBuy = data_probitkr['data'];
    dataApiBuy.forEach(function(dataBeli){
      if(dataBeli['side'] == 'buy'){
        console.log(dataBeli['side']);
        priceb[a] = parseFloat(dataBeli['price']);
        amountb[a] = parseFloat(dataBeli['quantity']);
        totalb[a] = amountb[a] + priceb[a];
        console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
      }
    });

    dataApiSell = data_probitkr['data'];
    dataApiSell.forEach(function(dataSell){
      if(dataSell['side'] == 'sell'){
        console.log(dataSell['side']);
        prices[x] = parseFloat(dataSell['price']);
        amounts[x] = parseFloat(dataSell['quantity']);
        totals[x] = amounts[x] + prices[x];
        console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
      }
    });
    console.log(" Price = "+prices.sort())
  }
  if(exchanger == 'latoken'){
    var data_latoken = data;
    var a = 0;
    var x = 0;
    console.log(data_latoken['bids'])
    dataApiBuy = data_latoken['bids'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli[0]);
        amountb[a] = parseFloat(dataBeli[1]);
        totalb[a] = priceb[a] * amountb[a];
        // console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_latoken['asks'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell[0]);
        amounts[x] = parseFloat(dataSell[1]);
        totals[x] = prices[x] * amounts[x];
        // console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
    });
  }
  if(exchanger == 'coinbene'){
    var data_coinbene = data;
    var a = 0;
    var x = 0;
    console.log(data_coinbene['data']['bids'])
    dataApiBuy = data_coinbene['data']['bids'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli[0]);
        amountb[a] = parseFloat(dataBeli[1]);
        totalb[a] = priceb[a] * amountb[a];
        // console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_coinbene['data']['asks'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell[0]);
        amounts[x] = parseFloat(dataSell[1]);
        totals[x] = prices[x] * amounts[x];
        // console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
    });
  }
  if(exchanger == 'digifinex'){
    var data_digifinex = data;
    var a = 0;
    var x = 0;
    console.log(data_digifinex['bids'])
    dataApiBuy = data_digifinex['bids'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli[0]);
        amountb[a] = parseFloat(dataBeli[1]);
        totalb[a] = priceb[a] * amountb[a];
        // console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_digifinex['asks'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell[0]);
        amounts[x] = parseFloat(dataSell[1]);
        totals[x] = prices[x] * amounts[x];
        // console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
    });
  }
  if(exchanger == 'bhex'){
    var data_bhex = data;
    var a = 0;
    var x = 0;
    console.log(data_bhex['bids'])
    dataApiBuy = data_bhex['bids'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli[0]);
        amountb[a] = parseFloat(dataBeli[1]);
        totalb[a] = priceb[a] * amountb[a];
        // console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_bhex['asks'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell[0]);
        amounts[x] = parseFloat(dataSell[1]);
        totals[x] = prices[x] * amounts[x];
        // console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
    });
  }
  if(exchanger == 'hitbtc'){
    var data_hitbtc = data;
    var a = 0;
    var x = 0;
    console.log(data_hitbtc['bid'])
    dataApiBuy = data_hitbtc['bid'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli['price']);
        amountb[a] = parseFloat(dataBeli['size']);
        totalb[a] = amountb[a] + priceb[a];
        // console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_hitbtc['ask'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell['price']);
        amounts[x] = parseFloat(dataSell['size']);
        totals[x] = amounts[x] + prices[x];
        // console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
    });
  }
  if(exchanger == 'cointiger'){
    var data_cointiger = data;
    var a = 0;
    var x = 0;
    console.log(data_cointiger['data']['depth_data']['tick']['buys'])
    dataApiBuy = data_cointiger['data']['depth_data']['tick']['buys'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli[0]);
        amountb[a] = parseFloat(dataBeli[1]);
        totalb[a] = amountb[a] * priceb[a];
        // console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_cointiger['data']['depth_data']['tick']['asks'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell[0]);
        amounts[x] = parseFloat(dataSell[1]);
        totals[x] = amounts[x] * prices[x];
        // console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
    });
  }
  if(exchanger == 'exx'){}
  if(exchanger == 'tokok'){
    var data_tokok = data;
    var a = 0;
    var x = 0;
    console.log(data_tokok['bids'])
    dataApiBuy = data_tokok['bids'];
    dataApiBuy.forEach(function(dataBeli){
        priceb[a] = parseFloat(dataBeli[0]);
        amountb[a] = parseFloat(dataBeli[1]);
        totalb[a] = priceb[a] * amountb[a];
        // console.log("Detail Get Api Buy = "+a+" Price = "+priceb[a]+" Amount = "+amountb[a]+" Total = "+totalb[a])
        a++;
    });

    dataApiSell = data_tokok['asks'];
    dataApiSell.forEach(function(dataSell){
        prices[x] = parseFloat(dataSell[0]);
        amounts[x] = parseFloat(dataSell[1]);
        totals[x] = prices[x] * amounts[x];
        // console.log("Detail Get Api Sell = "+x+" Price = "+prices[x]+" Amount = "+amounts[x]+" Total = "+totals[x])
        x++;
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
function sum(input){
  if (toString.call(input) !== "[object Array]")
    return false;
    var total =  0;
    for(var i=0;i<input.length; i++){                  
      if(isNaN(input[i])){
        continue;
      }
      total += Number(input[i]);
    }
    return total;
}
function Buy(exchanger,coin,modal){
  var fee = 0.997;
  var x = 0;
  var priceBuy = localStorage.getItem("priceSell"+exchanger+'_'+coin).split(",");
  var amountBuy = localStorage.getItem("amountSell"+exchanger+'_'+coin).split(","); 
  var totalBuy = localStorage.getItem("totalSell"+exchanger+'_'+coin).split(",");
  localStorage.removeItem("priceSell"+exchanger+'_'+coin);
  localStorage.removeItem("amountSell"+exchanger+'_'+coin);
  localStorage.removeItem("totalSell"+exchanger+'_'+coin);
  // console.log(priceBuy)
  // console.log(amountBuy)
  // console.log(totalBuy)
  var pricesBuy = [];
  var amountsBuy = [];
  var totalsBuy = [];
  var capital = parseFloat(modal);
    while (capital >= 0) {
      console.log(parseFloat(totalBuy[x]))
        capital = capital - parseFloat(totalBuy[x]);
        rest = capital + parseFloat(totalBuy[x]);
      console.log(capital)
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
    total_am = sum(amountsBuy);
    total_tot = sum(totalsBuy);

    // total_am = amountsBuy.reduce((a, b) => a + b, 0);
    // total_tot = totalsBuy.reduce((a, b) => a + b, 0);
    modalNext = total_am;
    // console.log(total_am)
    // console.log(total_tot)
    localStorage.setItem("modalNext", modalNext);
    console.log('Hasile Buy = '+localStorage.getItem("modalNext"));
}
function Sell(exchanger,coin,modal){
  console.log('Masuk '+exchanger+' Sell '+modal+' '+coin )
  var fee = 0.997;
  var x = 0;
  var priceSell = localStorage.getItem("priceBuy"+exchanger+'_'+coin).split(",");
  var amountSell = localStorage.getItem("amountBuy"+exchanger+'_'+coin).split(",");
  var totalSell = localStorage.getItem("totalBuy"+exchanger+'_'+coin).split(",");
  localStorage.removeItem("priceBuy"+exchanger+'_'+coin);
  localStorage.removeItem("amountBuy"+exchanger+'_'+coin);
  localStorage.removeItem("totalBuy"+exchanger+'_'+coin);
  // console.log(priceSell)
  // console.log(amountSell)
  // console.log(totalSell)
  var pricesSell = [];
  var amountsSell = [];
  var totalsSell = [];
  var capital = parseFloat(modal);
    while (capital >= 0) {
      
      // console.log(parseFloat(amountSell[x]))
        if(exchanger == 'indodax' ){
          capital = capital - parseFloat(totalSell[x]);
          rest = capital + parseFloat(totalSell[x]);
          console.log(exchanger)
        }else{
          console.log(exchanger)
          capital = capital - parseFloat(amountSell[x]);
          rest = capital + parseFloat(amountSell[x]);
          console.log(parseFloat(capital +' ======= '+rest))
          console.log(parseFloat(amountSell[x]))
        }
        if (capital <= 0) {
            pricesSell[x] = priceSell[x];
            totalsSell[x] = rest;
            amountsSell[x] = rest * priceSell[x];
        } else {
            pricesSell[x] = priceSell[x];
            totalsSell[x] = totalSell[x];
            // if(exchanger=='huobi' || exchanger == 'binance' || exchanger ==  'bittrex' || exchanger ==  'bilaxy' || exchanger ==  'folgory' || exchanger ==  'okex'){
            //   amountsSell[x] = priceSell[x] * amountSell[x];
            //   console.log('Masuk if price * amount '+exchanger)
            // }else{
              amountsSell[x] = priceSell[x] * amountSell[x];
              // console.log(exchanger)
            // }
        }
        console.log('Detail => '+x+' ==> Price ==> '+pricesSell[x]+' ==> Amount ==> '+amountsSell[x]+' ==> Total ==> '+totalsSell[x]+'')
        x++;
    }
    total_am = sum(amountsSell);
    total_tot = sum(pricesSell);
    // console.log(total_am +'  ==  '+ total_tot)

    modalNext = total_am;
    localStorage.setItem("Modale"+exchanger, modalNext);
    console.log("Jumlah modal = "+total_am)
    console.log("Total modal = "+total_tot)
    console.log('Hasile Sell = '+localStorage.getItem("Modale"+exchanger));
}
// function Sell(exchanger,coin,modal){
//   console.log('Masuk '+exchanger+' Sell '+modal+' '+coin )
//   var fee = 0.997;
//   var x = 0;
//   var priceSell = localStorage.getItem("priceBuy"+exchanger+'_'+coin).split(",");
//   var amountSell = localStorage.getItem("amountBuy"+exchanger+'_'+coin).split(",");
//   var totalSell = localStorage.getItem("totalBuy"+exchanger+'_'+coin).split(",");
//   localStorage.removeItem("priceBuy"+exchanger+'_'+coin);
//   localStorage.removeItem("amountBuy"+exchanger+'_'+coin);
//   localStorage.removeItem("totalBuy"+exchanger+'_'+coin);
//   console.log(priceSell)
//   console.log(amountSell)
//   console.log(totalSell)
//   var pricesSell = [];
//   var amountsSell = [];
//   var totalsSell = [];
//   var capital = parseFloat(modal);
//     while (capital >= 0) {
//       // console.log(capital)
//       // console.log("Total heee = "+parseFloat(totalSell[x]))
//         capital = capital - parseFloat(totalSell[x]);
//         rest = capital + parseFloat(totalSell[x]);
//         if (capital <= 0) {
//             pricesSell[x] = priceSell[x];
//             totalsSell[x] = rest;
//             amountsSell[x] = rest * priceSell[x];
//         } else {
//             pricesSell[x] = priceSell[x];
//             totalsSell[x] = totalSell[x];
//             if(exchanger=='huobi' || exchanger == 'binance'){
//               amountsSell[x] = priceSell[x] * amountSell[x];
//               console.log(exchanger)
//             }else{
//               amountsSell[x] = amountSell[x];
//               // console.log(exchanger)
//             }
//         }
//         console.log('Detail => '+x+' ==> Price ==> '+pricesSell[x]+' ==> Amount ==> '+amountsSell[x]+' ==> Total ==> '+totalsSell[x]+'')
//         x++;
//     }
//     total_am = sum(amountsSell);
//     total_tot = sum(pricesSell);
//     // console.log(total_am +'  ==  '+ total_tot)

//     modalNext = total_am;
//     localStorage.setItem("Modale"+exchanger, modalNext);
//     console.log("Jumlah modal = "+total_am)
//     console.log('Hasile Sell = '+localStorage.getItem("Modale"+exchanger));
// }
/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.toString(),
  // var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

</script>
@stop
