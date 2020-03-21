@extends('layouts.default')

@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper ">
  <!-- BEGIN: Subheader -->
  <!-- END: Subheader -->
  <div class="m-content" >
    <div id="accordion" style="display:none;">
    <h5>Mode</h5>
      <div class="form-group">
        <!-- <label>Mode</label> -->
        <input id="mode" class="form-control" name="" required />
        <input type="hidden" id="sv_mode" class="form-control" name="sv_mode"/>
      </div>
      <h5>Exchanger</h5>
      <div class="form-group">
        <!-- <label>Exchanger</label> -->
        <input id="exchange" class="form-control" name="" required/>
        <input type="hidden" id="sv_exchange" class="form-control" name="sv_exchange"/>
      </div>
      <div class="form-group">
        <button class="btn btn-md btn-success m-1 active" id="btn_market_binance" onclick="changeExc('binance')"><b>BINANCE</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_aex" onclick="changeExc('aex')"><b>AEX</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_bittrex" onclick="changeExc('bittrex')"><b>BITTREX</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_bilaxy" onclick="changeExc('bilaxy')"><b>BILAXY</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_folgory" onclick="changeExc('folgory')"><b>FOLGORY</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_okex" onclick="changeExc('okex')"><b>OKEX</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_huobi" onclick="changeExc('huobi')"><b>HUOBI</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_coinsbit" onclick="changeExc('coinsbit')"><b>COINSBIT</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_bkex" onclick="changeExc('bkex')"><b>BKEX</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_bitz" onclick="changeExc('bitz')"><b>BITZ</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_probitkr" onclick="changeExc('probitkr')"><b>PROBIT.KR</b></button>
        <!-- <button class="btn btn-md btn-success m-1" id="btn_market_p2pb2b" onclick="changeExc('p2pb2b')"><b>P2PB2B</b></button> -->
        <button class="btn btn-md btn-success m-1" id="btn_market_indodax" onclick="changeExc('indodax')"><b>INDODAX</b></button>
        <!-- <button class="btn btn-md btn-success m-1" id="btn_market_bibox" onclick="changeExc('bibox')"><b>BIBOX</b></button> -->
        <button class="btn btn-md btn-success m-1" id="btn_market_latoken" onclick="changeExc('latoken')"><b>LATOKEN</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_coinbene" onclick="changeExc('coinbene')"><b>COINBENE</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_digifinex" onclick="changeExc('digifinex')"><b>DIGIFINEX</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_bhex" onclick="changeExc('bhex')"><b>BHEX</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_hitbtc" onclick="changeExc('hitbtc')"><b>HITBTC</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_cointiger" onclick="changeExc('cointiger')"><b>COINTIGER</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_exx" onclick="changeExc('exx')"><b>EXX</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_tokok" onclick="changeExc('tokok')"><b>TOKOK</b></button>

        <button class="btn btn-md btn-success m-1" id="btn_market_whitebit" onclick="changeExc('whitebit')"><b>WHITEBIT</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_bigone" onclick="changeExc('bigone')"><b>BIGONE</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_biki" onclick="changeExc('biki')"><b>BIKI</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_bitasset" onclick="changeExc('bitasset')"><b>BITASSET</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_bitmax" onclick="changeExc('bitmax')"><b>BITMAX</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_bittrue" onclick="changeExc('bittrue')"><b>BITTRUE</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_cryptonex" onclick="changeExc('cryptonex')"><b>CRYPTONEX</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_dcoin" onclick="changeExc('dcoin')"><b>DCOIN</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_kryptono" onclick="changeExc('kryptono')"><b>KRYPTONO</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_liquid" onclick="changeExc('liquid')"><b>LIQUID</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_omgfine" onclick="changeExc('omgfine')"><b>OMGFINE</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_vindax" onclick="changeExc('vindax')"><b>VINDAX</b></button>
        <button class="btn btn-md btn-success m-1" id="btn_market_zb" onclick="changeExc('zb')"><b>ZB</b></button>

        <button class="btn btn-md btn-success m-1" id="btn_market_clear" onclick="changeExc('clear')"><b>Hapus Filter</b></button>
      </div>
      <h5>Filter</h5>
      <div class="form-group" style="margin-left:20px;">
        Pilih Coin <input type="radio" name="myRadios" value="pilih" checked class="ml-2 mr-4"/>
        Tidak Pilih Coin <input type="radio" name="myRadios" value="kecuali" class="ml-2"/>
      </div>
      <div class="form-group">
        <!-- <label>Filter</label> -->
        <input id="filter" class="form-control" name=""/>
        <input type="hidden" id="sv_filter" class="form-control" name="sv_filter"/>
      </div>
      <div class="form-group">
        <button class="btn btn-sm btn-success" onclick="fillCoin('ambil')">Fillter Coin Indodax</button>
        <button class="btn btn-sm btn-success" onclick="fillCoin('kosong')">Clear</button>
      </div>
    </div>
    <br>
      <button class="btn btn-success" id="btn_generate" onclick="tes()">Generate</button>
      <button class="btn btn-success" id="fillter" >Show</button>
    
    <div id="tableDiv" style="display: none; margin-top:20px;">
    </div>
  </div>
</div>


<!--begin::Base Scripts -->
<script src="{{ URL::asset('assets/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<!--<script src="{{ URL::asset('assets/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Base Scripts -->
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magicsuggest/2.1.4/magicsuggest.js"></script>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script>

$(function() {
  // $( "#accordion" ).accordion({
  //     collapsible: true
  //   });
  $("#fillter").click(function(){
    var x = document.getElementById("fillter");
      if (x.innerHTML === "Show") {
        x.innerHTML = "Hiden";
      } else {
        x.innerHTML = "Show";
      }
    $("#accordion").toggle();
  });
  var mode = $('#mode').magicSuggest({
    value : ['idr'],
    method: 'get',
    maxSelection: 1,
    maxSelectionRenderer: function () {
        return "You cannot choose more than 1 Mode";
    },
    data: ['ori', 'btc', 'eth', 'usdt', 'idr'],

  });
  $("#sv_mode").val('idr');
  $(mode).on('selectionchange', function(e,m){
    $("#sv_mode").val(this.getValue());
  });

  $.get('get_exchanger', function(res){

    var exchange = $('#exchange').magicSuggest({
        method: 'get',
        value: ['indodax_idr', 'indodax_btc','binance_btc', 'binance_eth', 'binance_usdt', 'binance_bnb'],
        maxSelection: 30,
        maxSelectionRenderer: function () {
            return "You cannot choose more than 20 Exchange";
        },
        data: res.market,
    });
    $("#sv_exchange").val(['indodax_idr', 'binance_btc', 'binance_eth', 'binance_usdt', 'binance_bnb']);
    $(exchange).on('selectionchange', function(e,m){
      $("#sv_exchange").val(this.getValue());
    });

    var filter = $('#filter').magicSuggest({
      method: 'get',
      maxSelection: 100,
      maxSelectionRenderer: function () {
          return "You cannot choose more than 20 Filter";
      },
      data: res.filter,
    });

    $(filter).on('selectionchange', function(e,m){
      $("#sv_filter").val(this.getValue());
    });

  });
});

function tes(){
  var mode = $("#sv_mode").val();
  var exchange = $("#sv_exchange").val();
  var filter = $("#sv_filter").val();
  var pilihan = $("input[name='myRadios']:checked").val();

  if(mode == "" || exchange == "")
  {
    //alert("Mode / Exchange tidak boleh ada yang kosong !");
    return false;
  }

  if(filter == "")
  {
    filter = "none";
  }

  $("#btn_generate").text('Generating....');
  $("#btn_generate").attr('disabled', true);

  $.get('api/count/'+mode+'/'+exchange+'/'+filter+'/'+pilihan, function(res){
  // $.get('api/count/'+mode+'/'+exchange+'/'+filter, function(res){
    console.log(res.pilih);
    $("#btn_generate").text('Generate');
    $("#btn_generate").attr('disabled', false);

    $("#tableDiv").show();
    $("#labels").show();
    var tableHeaders = "";
    var ModifKeyEvo = '';
    var FinalHeader = '';
    $.each(res.colomn, function(i, val){
        FinalHeader = val;
        if (val == 'coinname' || val == 'go_price') {
            FinalHeader = val.toUpperCase();
        } else {
          var ModifKey = val.split('_');
          ModifKeyEvo  = ModifKey[0] + ' ' + ModifKey[1];
          FinalHeader = ModifKeyEvo.toUpperCase();
        }

        tableHeaders += "<th class=table-dark>" + FinalHeader + "</th>";

    });

    var tableIsi = "";
    var arr_exchange = exchange.split(',');

    $.each(res.isi, function(i, val){

      tableIsi += "<tr class= bg-dark>";
      tableIsi += "<td>" + val['coinname'] + "</td>";
      for (var x = 0; x < arr_exchange.length; x++) {
        if (val[arr_exchange[x]] == val['min_price']) {
          tableIsi += "<td span class=\"m--font-bold m--font-success\">" + parseFloat(val[arr_exchange[x]]).toFixed(2) + "</td>";

        }
        else if (val[arr_exchange[x]] == val['max_price']) {
          tableIsi += "<td span class=\"m--font-bold m--font-danger\">" + parseFloat(val[arr_exchange[x]]).toFixed(2) + "</td>";
        }
        else {
          tableIsi += "<td>" + parseFloat(val[arr_exchange[x]]).toFixed(2) + "</td>";
        }

      }
      //  tableIsi += "<td>" + val['low'] + "</td>";
      //  tableIsi += "<td>" + val['max'] + "</td>";
        if(val['go_price'] >= 2.00 ){
          tableIsi += "<td style='color:#03DAC6; font-size:20px;'>" + val['go_price'] + "</td>";
        }else{
          tableIsi += "<td>" + val['go_price'] + "</td>";
        }
        
        tableIsi += "</tr>";
    });
    var jml = parseInt(arr_exchange.length + 1);
    $("#tableDiv").empty();
    $("#tableDiv").append('<table id="displayTable" class="m-datatable__table "><thead class="m-datatable__head">' + tableHeaders + '</thead><tbody>'+tableIsi+'</tbody></table>');


    var tbl = $('#displayTable').DataTable({
      responsive: true,
      paging: true,
      scrollX:true,
      iDisplayLength:30,
      "order":[[jml, 'desc']]
    });
      new $.fn.dataTable.FixedHeader( tbl );
  });
}
function changeExc(exc){
  var exchange = $('#exchange').magicSuggest({});
  if(exc=='binance'){
    $('#btn_market_binance').toggleClass("active");
    if($('#btn_market_binance').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','binance_bnb', 'binance_btc', 'binance_eth', 'binance_usdt']);
    }else{
      // exchange.clear();
      exchange.setValue(['indodax_idr','indodax_btc']);
      // exchange.removeFromSelection(['id: "indodax_btc"'], true);
      // console.log(exchange.removeFromSelection(exchange.getSelection()))
    }
  }else if(exc=='aex'){
    $('#btn_market_aex').toggleClass("active");
    if($('#btn_market_aex').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','aex_cnc','aex_eth','aex_usdt']);
    }else{
    }
  }else if(exc=='bittrex'){
    $('#btn_market_bittrex').toggleClass("active");
    if($('#btn_market_bittrex').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','bittrex_btc','bittrex_eth','bittrex_usdt']);
    }else{
    }
  }else if(exc=='huobi'){
    $('#btn_market_huobi').toggleClass("active");
    if($('#btn_market_huobi').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','huobi_btc','huobi_eth','huobi_usdt']);
    }else{
    }
  }else if(exc=='indodax'){
    $('#btn_market_indodax').toggleClass("active");
    if($('#btn_market_indodax').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc']);
    }else{
    }
  }else if(exc=='folgory'){
    $('#btn_market_folgory').toggleClass("active");
    if($('#btn_market_folgory').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','folgory_btc','folgory_eth','folgory_usdt']);
    }else{
    }
  }else if(exc=='bitz'){
    $('#btn_market_bitz').toggleClass("active");
    if($('#btn_market_bitz').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','bitz_btc','bitz_eth','bitz_usdt']);
    }else{
    }
  }else if(exc=='bilaxy'){
    $('#btn_market_bilaxy').toggleClass("active");
    if($('#btn_market_bilaxy').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','bilaxy_btc','bilaxy_eth','bilaxy_usdt']);
    }else{
    }
  }else if(exc=='okex'){
    $('#btn_market_okex').toggleClass("active");
    if($('#btn_market_okex').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','okex_btc','okex_eth','okex_usdt']);
    }else{
    }
  }else if(exc=='coinsbit'){
    $('#btn_market_coinsbit').toggleClass("active");
    if($('#btn_market_coinsbit').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','coinsbit_btc','coinsbit_eth','coinsbit_usdt']);
    }else{
    }
  }else if(exc=='bkex'){
    $('#btn_market_bkex').toggleClass("active");
    if($('#btn_market_bkex').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','bkex_btc','bkex_eth','bkex_usdt']);
    }else{
    }
  }else if(exc=='p2pb2b'){
    $('#btn_market_p2pb2b').toggleClass("active");
    if($('#btn_market_p2pb2b').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','p2pb2b_btc','p2pb2b_eth','p2pb2b_usdt']);
    }else{
    }
  }else if(exc=='probitkr'){
    $('#btn_market_probitkr').toggleClass("active");
    if($('#btn_market_probitkr').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','probitkr_krw','probitkr_btc','probitkr_eth','probitkr_usdt']);
    }else{
    }
  }else if(exc=='bibox'){
    $('#btn_market_bibox').toggleClass("active");
    if($('#btn_market_bibox').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','bibox_btc','bibox_eth','bibox_usdt']);
    }else{
    }
  }else if(exc=='latoken'){
    $('#btn_market_latoken').toggleClass("active");
    if($('#btn_market_latoken').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','latoken_btc','latoken_eth','latoken_usdt']);
    }else{
    }
  }else if(exc=='coinbene'){
    $('#btn_market_coinbene').toggleClass("active");
    if($('#btn_market_coinbene').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','coinbene_btc','coinbene_eth','coinbene_usdt']);
    }else{
    }
  }else if(exc=='digifinex'){
    $('#btn_market_digifinex').toggleClass("active");
    if($('#btn_market_digifinex').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','digifinex_btc','digifinex_eth','digifinex_usdt']);
    }else{
    }
  }else if(exc=='bhex'){
    $('#btn_market_bhex').toggleClass("active");
    if($('#btn_market_bhex').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','bhex_btc','bhex_eth','bhex_usdt']);
    }else{
    }
  }else if(exc=='hitbtc'){
    $('#btn_market_hitbtc').toggleClass("active");
    if($('#btn_market_hitbtc').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','hitbtc_btc','hitbtc_eth','hitbtc_usdt']);
    }else{
    }
  }else if(exc=='cointiger'){
    $('#btn_market_cointiger').toggleClass("active");
    if($('#btn_market_cointiger').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','cointiger_btc','cointiger_eth','cointiger_usdt']);
    }else{
    }
  }else if(exc=='exx'){
    $('#btn_market_exx').toggleClass("active");
    if($('#btn_market_exx').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','exx_eth','exx_usdt']);
    }else{
    }
  }else if(exc=='tokok'){
    $('#btn_market_tokok').toggleClass("active");
    if($('#btn_market_tokok').hasClass('active')) {
      exchange.setValue(['indodax_idr','indodax_btc','tokok_btc','tokok_eth','tokok_usdt']);
    }else{
    }
  }else if(exc=='whitebit'){
    $('#btn_market_whitebit').toggleClass("active");
    if($('#btn_market_whitebit').hasClass('active')) {
      exchange.setValue(['whitebit_btc','whitebit_eth','whitebit_usdt']);
    }else{
    }
  }else if(exc=='bigone'){
    $('#btn_market_bigone').toggleClass("active");
    if($('#btn_market_bigone').hasClass('active')) {
      exchange.setValue(['bigone_btc','bigone_eth','bigone_usdt']);
    }else{
    }
  }else if(exc=='biki'){
    $('#btn_market_biki').toggleClass("active");
    if($('#btn_market_biki').hasClass('active')) {
      exchange.setValue(['biki_btc','biki_eth','biki_usdt']);
    }else{
    }
  }else if(exc=='bitasset'){
    $('#btn_market_bitasset').toggleClass("active");
    if($('#btn_market_bitasset').hasClass('active')) {
      exchange.setValue(['bitasset_btc','bitasset_usdt']);
    }else{
    }
  }else if(exc=='bitmax'){
    $('#btn_market_bitmax').toggleClass("active");
    if($('#btn_market_bitmax').hasClass('active')) {
      exchange.setValue(['bitmax_btc','bitmax_eth','bitmax_usdt']);
    }else{
    }
  }else if(exc=='bittrue'){
    $('#btn_market_bittrue').toggleClass("active");
    if($('#btn_market_bittrue').hasClass('active')) {
      exchange.setValue(['bittrue_btc','bittrue_eth','bittrue_usdt']);
    }else{
    }
  }else if(exc=='cryptonex'){
    $('#btn_market_cryptonex').toggleClass("active");
    if($('#btn_market_cryptonex').hasClass('active')) {
      exchange.setValue(['cryptonex_btc','cryptonex_eth','cryptonex_usdt']);
    }else{
    }
  }else if(exc=='dcoin'){
    $('#btn_market_dcoin').toggleClass("active");
    if($('#btn_market_dcoin').hasClass('active')) {
      exchange.setValue(['dcoin_btc','dcoin_eth','dcoin_usdt']);
    }else{
    }
  }else if(exc=='kryptono'){
    $('#btn_market_kryptono').toggleClass("active");
    if($('#btn_market_kryptono').hasClass('active')) {
      exchange.setValue(['kryptono_btc','kryptono_eth','kryptono_usdt']);
    }else{
    }
  }else if(exc=='liquid'){
    $('#btn_market_liquid').toggleClass("active");
    if($('#btn_market_liquid').hasClass('active')) {
      exchange.setValue(['liquid_btc','liquid_eth','liquid_usdt']);
    }else{
    }
  }else if(exc=='omgfine'){
    $('#btn_market_omgfine').toggleClass("active");
    if($('#btn_market_omgfine').hasClass('active')) {
      exchange.setValue(['omgfine_btc','omgfine_eth','omgfine_usdt']);
    }else{
    }
  }else if(exc=='vindax'){
    $('#btn_market_vindax').toggleClass("active");
    if($('#btn_market_vindax').hasClass('active')) {
      exchange.setValue(['vindax_btc','vindax_eth','vindax_usdt']);
    }else{
    }
  }else if(exc=='zb'){
    $('#btn_market_zb').toggleClass("active");
    if($('#btn_market_zb').hasClass('active')) {
      exchange.setValue(['zb_btc','zb_eth','zb_usdt']);
    }else{
    }
  }else if(exc == 'clear'){
    $('#btn_market_binance').removeClass("active");
    $('#btn_market_aex').removeClass("active");
    $('#btn_market_bittrex').removeClass("active");
    $('#btn_market_huobi').removeClass("active");
    $('#btn_market_indodax').removeClass("active");
    $('#btn_market_folgory').removeClass("active");
    $('#btn_market_bitz').removeClass("active");
    $('#btn_market_billaxy').removeClass("active");
    $('#btn_market_okex').removeClass("active");
    $('#btn_market_coinsbit').removeClass("active");
    $('#btn_market_bkex').removeClass("active");
    $('#btn_market_p2pb2b').removeClass("active");
    $('#btn_market_probitkr').removeClass("active");
    $('#btn_market_bibox').removeClass("active");
    $('#btn_market_latoken').removeClass("active");
    $('#btn_market_coinbene').removeClass("active");
    $('#btn_market_digifinex').removeClass("active");
    $('#btn_market_bhex').removeClass("active");
    $('#btn_market_hitbtc').removeClass("active");
    $('#btn_market_cointiger').removeClass("active");
    $('#btn_market_exx').removeClass("active");
    $('#btn_market_tokok').removeClass("active");
    $('#btn_market_whitebit').removeClass("active");
    $('#btn_market_bigone').removeClass("active");
    $('#btn_market_biki').removeClass("active");
    $('#btn_market_bitasset').removeClass("active");
    $('#btn_market_bitmax').removeClass("active");
    $('#btn_market_bittrue').removeClass("active");
    $('#btn_market_cryptonex').removeClass("active");
    $('#btn_market_dcoin').removeClass("active");
    $('#btn_market_kryptono').removeClass("active");
    $('#btn_market_liquid').removeClass("active");
    $('#btn_market_omgfine').removeClass("active");
    $('#btn_market_vindax').removeClass("active");
    $('#btn_market_zb').removeClass("active");
      exchange.clear();
      exchange.setValue(['indodax_idr','indodax_btc']);
  }
}
function fillCoin(data){
  var filter = $('#filter').magicSuggest({});
  if(data == 'ambil'){
    $.ajax({
          type: 'GET',
          url: 'api/getCoin',
          dataType: 'json',
          success: function (data) {
              $.each(data, function(index, item) {
                filter.setValue([item.coinname]);
              });
          },error:function(){ 
            console.log(data);
          }
      });
  }else if(data == 'kosong'){
    filter.clear();
  }
}
setInterval(function(){
  tes();
}, 5000);
</script>

@stop
