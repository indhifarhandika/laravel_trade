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
              <!-- <option>- Pilih Exchanger -</option> -->
              <option value="indodax_idr">- Indodax -</option>
            </select>
          </div>
          <div class="form-group">
            Pilih Coin : <select name="coinname" id="coin" >
            <!-- Pilih COin : <select name="coinname" id="coin" onChange="getData()"> -->
              <option value="VIDY">- Vidy -</option>
            </select>
          </div>
          <div class="form-group">
            exchanger tujuan : <select name="exce" id="exchanger">
              <!-- <option>- Pilih Exchanger -</option> -->
              <option value="huobi_usdt">- Huobi USDT -</option>
            </select>
          </div>
          <div class="form-group">
            Pilih COin : <select name="coinnameTujuan" id="coinTujuan" >
            <!-- Pilih COin : <select name="coinname" id="coin" onChange="getData()"> -->
              <option value="VIDY">- Vidy -</option>
              <option value="vidyusdt">- vidyusdt -</option>
              <option value="ethusdt">- ethusdt -</option>
              <option value="vsysusdt">- vsysusdt -</option>
              <option value="crousdt">- crousdt -</option>
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
<script>
localStorage.setItem("url_indodax", "https://indodax.com/api/webdata/...");
localStorage.setItem("url_binance", "https://www.binance.com/api/v3/depth?limit=500&symbol=...");
localStorage.setItem("url_huobi", "https://api.huobi.pro/market/depth?symbol=...&type=step1");
localStorage.setItem("url_aex", "https://api.aex.com/depth.php?mk_type=...&c=...");
localStorage.setItem("url_bittrex", "https://api.bittrex.com/api/v1.1/public/getorderbook?market=...&type=both");


// console.log(localStorage.getItem("url_huobi"))
</script>

<script>
// $.ajax({
//     type: 'GET',
//     url: 'api/getCoin',
//     dataType: 'json',
//     success: function (data) {
//         $.each(data, function (index, item) {
//             $('#coin').append("<option value=" + item.coinname + "idr>" + item.coinname + "idr</option>")
//         });
//     }, error: function () {
//         console.log(data);
//     }
// });
$.ajax({
      type: 'GET',
      url: 'api/getAllExc',
      dataType: 'json',
        success: function (data) {
          $.each(data, function(index, item) {
            $('#exchangerAwal').append("<option value="+item+">"+item+"</option>")
            $('#exchanger').append("<option value="+item+">"+item+"</option>")
          });
        },error:function(){
      console.log(data);
  }
});
$.ajax({
      type: 'GET',
      url: 'api/getAllCoin',
      dataType: 'json',
        success: function (data) {
          $.each(data, function(index, item) {
            $('#coin').append("<option value="+item+">"+item+"</option>")
            $('#coinTujuan').append("<option value="+item+">"+item+"</option>")
          });
        },error:function(){
      console.log(data);
  }
});


function hitung() {
    var modal = $('#modal').val()
    var exA = $('#exchangerAwal').val()
    var coin = $('#coin').val()
    var exT = $('#exchanger').val()
    var coin2 = $('#coinTujuan').val()
    document.getElementById("Rute").innerHTML = "Modal = "+modal+'<br> Exchanger Awal = '+exA+'<br>Coin = '+coin+'<br> Exchanger Tujuan = '+exT+'<br>Coin Tujuan= '+coin2;
    getData(exA,exT,coin,coin2,modal);
}
function getData(exA,exT,coin,coin2,modal){
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
        dataType: 'json',
        done: function (data) {
          console.log(exA[0]+' = '+coin)
            parseData(exA[0],coin,data)
        }, error: function () {
            console.log(data);
        }
    });
    var url1 = localStorage.getItem("url_"+exT[0])
    var urlSplit1 = url1.split("...");
    var urlFix1 = urlSplit1[0] + coinB + urlSplit1[1];
    if(exT[0] == 'binance'){
      urlFix1 = urlSplit1[0] + coinB.toUpperCase() + urlSplit1[1];
    console.log(urlFix1)
    }
    $.ajax({
        type: 'GET',
        url: urlFix1,
        dataType: 'json',
        done: function (data) {
          console.log(exT[0]+' = '+coin2)
            parseData(exT[0],coin2,data)
        }, error: function () {
            console.log(data);
        }
    });
    
    var finishCoin = exT[1]+exA[1];
    var url2 = localStorage.getItem("url_"+exA[0])
    var urlSplit2 = url2.split("...");
    var urlFix2 = urlSplit2[0] + finishCoin + urlSplit2[1];
    if(exT[0] == 'binance'){
      urlFix2 = urlSplit2[0] + finishCoin.toUpperCase() + urlSplit1[1];
    }
    $.ajax({
        type: 'GET',
        url: urlFix2,
        dataType: 'json',
        done: function (data) {
          console.log(exA[0]+' = '+exA[1])
            parseData(exA[0],exA[1],data)
        }, error: function () {
            console.log(data);
        }
    });
    Buy(exA[0],coin,modal)
    document.getElementById("Hasilbeli").innerHTML = 'Buy '+exA[0]+' '+coin+' Dapat '+localStorage.getItem("modalNext", modalNext)+' '+coin+'<br>';
    var nextModal = localStorage.getItem("modalNext", modalNext)-1000;
    Sell(exT[0],coin2,nextModal)
    document.getElementById("Hasilproses").innerHTML = 'Sell '+exT[0]+' '+coin2+' Dapat '+localStorage.getItem("modalNext", modalNext)+' '+exT[1]+'<br>';
    Sell(exA[0],exA[1],nextModal)
    document.getElementById("Hasiljual").innerHTML = 'Sell '+exA[0]+' '+exT[1]+' Dapat '+localStorage.getItem("modalNext", modalNext)+' '+exA[1]+'<br>';
    // localStorage.clear();
}
function parseData(exchanger,coin,data){
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
    
  }
  if(exchanger == 'huobi'){
    var a = 0;
    var x = 0;
    dataApiBuy = data['tick']['bids'];
    dataApiBuy.forEach(function (dataBeli) {
        priceb[a] = dataBeli[0];
        amountb[a] = dataBeli[1];
        totalb[a] = amountb[a] + priceb[a];
        a++;
    });
    

    dataApiSell = data['tick']['asks'];
    dataApiSell.forEach(function (dataSell) {
        prices[x] = dataSell[0];
        amounts[x] = dataSell[1];
        totals[x] = totals[x] * amounts[x];
        x++;
    });

  }
  if(exchanger == 'aex'){
    
  }
  console.log(coin)
    localStorage.setItem("priceSell"+exchanger+'-'+coin, prices);
    localStorage.setItem("amountSell"+exchanger+'-'+coin, amounts);
    localStorage.setItem("totalSell"+exchanger+'-'+coin, totals);
    localStorage.setItem("priceBuy"+exchanger+'-'+coin, priceb);
    localStorage.setItem("amountBuy"+exchanger+'-'+coin, amountb);
    localStorage.setItem("totalBuy"+exchanger+'-'+coin, totalb);
}

function Buy(exchanger,coin,modal){
  var fee = 0.997;
  var x = 0;
  var priceBuy = localStorage.getItem("priceSell"+exchanger+'-'+coin).split(",");
  var amountBuy = localStorage.getItem("amountSell"+exchanger+'-'+coin).split(","); 
  var totalBuy = localStorage.getItem("totalSell"+exchanger+'-'+coin).split(",");
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
        x++;
    }
    total_am = amountsBuy.reduce((a, b) => a + b, 0);
    total_tot = totalsBuy.reduce((a, b) => a + b, 0);

    modalNext = total_am * fee;
    localStorage.setItem("modalNext", modalNext);
    console.log('Hasile Buy = '+localStorage.getItem("modalNext", modalNext));
}
function Sell(exchanger,coin,modal){
  var fee = 0.997;
  var x = 0;
  var priceSell = localStorage.getItem("priceSell"+exchanger+'-'+coin).split(",");
  var amountSell = localStorage.getItem("amountSell"+exchanger+'-'+coin).split(",");
  var totalSell = localStorage.getItem("totalSell"+exchanger+'-'+coin).split(",");
  var pricesSell = [];
  var amountsSell = [];
  var totalsSell = [];
  var capital = parseFloat(modal);
    while (capital >= 0) {
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
        x++;
    }
    total_am = amountsSell.reduce((a, b) => a + b, 0);
    total_tot = pricesSell.reduce((a, b) => a + b, 0);
    // console.log(total_tot)

    modalNext = total_am * fee;
    localStorage.setItem("modalNext", modalNext);
    console.log('Hasile Sell = '+localStorage.getItem("modalNext", modalNext));
}
</script>
@stop
