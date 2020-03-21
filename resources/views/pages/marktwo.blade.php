@extends('layouts.default')

@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
  <!-- BEGIN: Subheader -->
  <!-- END: Subheader -->
  <div class="m-content">
    <div class="form-group">
      <label>Mode</label>
      <input id="mode" class="form-control" name="" required />
      <input type="hidden" id="sv_mode" class="form-control" name="sv_mode"/>
    </div>

    <div class="form-group">
      <label>Exchanger</label>
      <input id="exchange" class="form-control" name="" required/>
      <input type="hidden" id="sv_exchange" class="form-control" name="sv_exchange"/>
    </div>

    <div class="form-group">
      <label>Filter</label>
      <input id="filter" class="form-control" name=""/>
      <input type="hidden" id="sv_filter" class="form-control" name="sv_filter"/>
    </div>

    <button class="btn btn-success" id="btn_generate" onclick="tes()">Generate</button>

    <br/>
      <h1 class="text-center" id="labels" style="display: none;">CRYPTO BALANCER</h1>
    <br/>
    <div id="tableDiv" style="display: none;">
    </div>
  </div>
  <table class="table table-bordered" id="users-table">
      <thead>
          <tr>
              <th id="">Go</th>
          </tr>
      </thead>
  </table>
</div>


<!--begin::Base Scripts -->
<script src="{{ URL::asset('assets/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<!--<script src="{{ URL::asset('assets/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Base Scripts -->
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magicsuggest/2.1.4/magicsuggest.js"></script>
<script>

$(function() {
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

  $.get('api/get_exchanger', function(res){

    var exchange = $('#exchange').magicSuggest({
        method: 'get',
        value: ['indodax_data_idr','aex_data_cnc','okex_data_btc'],
        maxSelection: 30,
        maxSelectionRenderer: function () {
            return "You cannot choose more than 20 Exchange";
        },
        data: res.market,
    });
    $("#sv_exchange").val(['indodax_data_idr','aex_data_cnc','okex_data_btc']);
    $(exchange).on('selectionchange', function(e,m){
      $("#sv_exchange").val(this.getValue());
    });

    var filter = $('#filter').magicSuggest({
      method: 'get',
      maxSelection: 20,
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

function tes()
{
  $("#btn_generate").text('Generating....');
  $("#btn_generate").attr('disabled', true);

  $.get('http://cryotoarbitrage.xyz/laravel/public/api/show_exchanger/idr/indodax_data_idr,aex_data_cnc,okex_data_btc/none', function(res){

    $("#btn_generate").text('Generate');
    $("#btn_generate").attr('disabled', false);

    $("#tableDiv").show();
    $("#labels").show();

    var table = $('#users-table').DataTable(
      {
          serverSide: true,
          ajax: {"coin":"John", "coin":"Doe"},
          pageLength: 100,
          columns: [
            { ajax: 'coin'},
          ]
      }

      );
      console.log(ajax);
  });
}


</script>

@stop
