<!DOCTYPE HTML>
<html>
<head>  
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

 
<body>
  <div class="pilihan col col-md-2">
    <div class="form-group">
        <select class="form-control" name="coinname" id="coin" >
          <option value="bitcoin">Bitcoin</option>
        </select>
    </div>
    <div class="form-group">
      <input class="form-control" type="date" id="tanggal">
    </div>
    <div class="form-group">
      <button class="btn-sm btn-primary mt-2" onClick="create()">Lihat Grafik</button>
    </div>
  </div>
  <div id="chartContainer" style="height: 300px; width: 100%;">
  </div>
  <div class="datae">
      
  </div>
  <script type="text/javascript">
$.ajax({
      type: 'GET',
      url: 'api/grCoin',
      dataType: 'json',
        success: function (data) {
          $("#coin").select2({
            theme: "classic",
            width: '100%',
              data: data
            })
          },error:function(){
      console.log(data);
  }
});
function create(){
  var coine = $('#coin').val();
  var tgl = $('#tanggal').val();
  if(tgl == ""){
    tgl = 'none';
  }
  var date;
var dps = [];
var dataSeries = [];
var chart = new CanvasJS.Chart("chartContainer", {
  title: {
    text: "Chart "+coine.toUpperCase()+" "
  },
  exportFileName: "Chart "+coine.toUpperCase()+" ",  //Give any name accordingly
		exportEnabled: true,
  toolTip: {
		shared: true
	},
    zoomEnabled: true, 
  data: dataSeries
});

$.when(
  $.getJSON("/api/gr/"+coine+"/"+tgl, function(data) {
    $.each(data, function(i) {
      dps = [];
      $.each(data[i], function(key, val) {
        date = key;
        var t = date.split(/[- :]/);
        var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
        dps.push({
          x: d,
          y: val,
          label: i
        });
      });
      dataSeries.push({
        name: i,
        type: "spline",
        xValueType: "dateTime",
        showInLegend: true,
        dataPoints: dps
      });
    });
  })
).then(function() {
  chart.render();
});
}
function toggleDataSeries(e) {
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  } else {
    e.dataSeries.visible = true;
  }
  chart.render();
}

  </script>
</body>
</html>