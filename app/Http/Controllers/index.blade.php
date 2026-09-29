@extends('layouts.layout')

@section('content')
<!-- <link media="all" type="text/css" rel="stylesheet" href="https://kvmgmt.com/plugins/datatable/dataTables.bootstrap.min.css">-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> 
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs jqueryui/1.12.1/jquery-ui.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
<link rel="stylesheet" href="https://kvmgmt.com/css/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="https://kvmgmt.com/js/bootstrap-multiselect.js"></script>
<link type="text/css" rel="stylesheet" href="https://kvmgmt.com/css/custom.css">
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">


<style>
  html, body {
  width: 100%;
  height: 100%;
  margin: 0px;
}
.amcharts-chart-div a {
    display: none!important;
}
#chartdiv {
    width: 100%;
    height: 100%;
}
span.multiselect-native-select {
    position: relative;
    width: 100%;
    display: block;
    text-align: left;
}button.multiselect.dropdown-toggle.btn.btn-default{
  width: 100%;
  text-align: left;
}
.btn-group {
    width: 100%;
    position: relative;
}
 td.details-control {
    background: url('img/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('img/details_close.png') no-repeat center center;
}
/*.sw-20{
	width: 20%;
}*/
  
  </style>

<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading">SALES REPORTING
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">BACK</a>
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">DASHBOARD</a>
                	
					</h3>
	                <br /> 
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="widget">
					<div class="widget-content">
						<div class="form-group row">
							<div class="col-md-2">
								<label>Start Date</label>
								<input type="text" name="" class="form-control" value="<?php echo date('m-d-Y',strtotime('-30 days'));?>" autocomplete="off" id="weeklyDatePicker" name="datepick" placeholder=" From ">
								</div>
							<div class="col-md-2">
								<label>End Date</label>
								<input type="text" name="" class="form-control"   value="<?php echo date('m-d-Y');?>" autocomplete="off" id="weeklyDatePicker1" name="datepick" placeholder=" To ">
							</div>
							<div class="col-md-2">
								<label>Sort By</label>
								<select class="form-control" id="sort-by">
									<option value="">Select</option>
									<?php 
									$selected = '';
									foreach($sorting as $k=>$v){ 						
									?>
									<option value="<?php echo $k; ?>" <?php if($k == 2) echo 'selected';?> ><?php echo $v; ?></option>
									
									<?php } ?>
								</select>
							</div>
							<div class="col-md-2">
								<label>Location</label>
								<select class="form-control multi-dropdown" id="loc" multiple="multiple">
									<!-- <option value=''>Select Location</option> -->
									<?php 
									// $selected = '';
									foreach($location as $k=>$v){ ?>
									<option value="<?php echo $k; ?>" 
										<?php if($k == $locationId)echo 'selected'; ?> >
										<?php echo $v; ?></option>
									
									<?php } ?>
								</select>
							</div>
							<!-- <div class="col-md-2">
								<label>Group By</label>
								<select class="form-control" id="location-group-by">
									<option value="0">Sum</option>
									<option value="1" selected>Individual</option>
									
								</select>
							</div> -->
							<div class="col-md-2">
								<label>Sales</label>
								<select class="form-control multi-dropdown" id="sales" multiple="multiple">
									<!-- <option value=''>Select Sales</option> -->
									<?php foreach($sales as $k=>$v){ ?>
									<option value="<?php echo $k; ?>" selected><?php echo $v; ?></option>
									
									<?php } ?>
								</select>
							</div>
							<div class="col-md-2">
								<label>Discounts</label>
								<select class="form-control multi-dropdown" id="discount" multiple="multiple">
								<!-- 	<option value=''>Select Discounts</option> -->
									<?php foreach($discount as $k=>$v){ ?>
									<option value="<?php echo $k; ?>" selected ><?php echo $v; ?></option>
									
									<?php } ?>
								</select>
							</div>
							<div class="col-md-2">
								<label>Adjustments</label>
								<select class="form-control multi-dropdown" id="adjustment" multiple="multiple">
									<!-- <option value=''>Select Adjustment</option> -->
									<?php foreach($adjustment as $k=>$v){ ?>
									<option value="<?php echo $k; ?>" selected ><?php echo $v; ?></option>
									
									<?php } ?>
								</select>
							</div>
							<div class="col-md-2">
								<label>Receipts</label>
								<select class="form-control multi-dropdown" id="receipt" multiple="multiple">
									<!-- <option value=''>Select Receipt</option> -->
									<?php foreach($receipt as $k=>$v){ ?>
									<option value="<?php echo $k; ?>" selected ><?php echo $v; ?></option>
									
									<?php } ?>
								</select>
							</div>
							<div class="col-md-2">
								<label>&nbsp;</label>
								<input class="v-btn v-btn-primary btn-block" style="margin-left: 0;" type="submit" name="submit" id="submit_alert" value="Submit">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="widget">
					<div class="widget-header" style="padding-bottom: 0">
						<h4 class="">Sales Reporting</h4>
					</div>
					<div class="widget-content"  style=" padding: 0;">
						<div id="chartdiv" style="height:300px;width: 100%;"></div>
					</div>
					<div class="widget-footer">
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="widget">
					<div class="widget-content" style="min-height: 300px;">
						<div class="responsive-table" id="report_data">
							<table id="example" class="display nowrap" style="width:100%">
						        <thead>
						            <tr>
						                <th style="width:10px"></th>
						                <th style="max-width:50px !important;">Date</th>
						                <th>Location</th>
						                <th>Departments</th>
						                <th>Total Amount</th>
						              
						            </tr>
						        </thead>
						    </table>
						</div>
					</div>
				</div>
				
			</div>
			
			
		</div>
	</div>
</section>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>




<script type="text/javascript">
	
$("#weeklyDatePicker").datetimepicker({ format: 'MM-DD-YYYY'});		
$("#weeklyDatePicker1").datetimepicker({format: 'MM-DD-YYYY'});
$('.multi-dropdown').multiselect({
   includeSelectAllOption: true,
   selectAllText: ' Deselect all'

});
	function format ( d ) {
    // `d` is the original data object for the row
    var ele = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
        for(var i=0 ; i< (d.dept).length; i++)
        {
        	ele += '<tr>'+
            '<td>'+d.dept[i]['name']+'</td>'+
            '<td>'+d.dept[i]['amount']+'</td>'+
        	'</tr>' ;
        }
        ele += '</table>';
    return ele;
}
function fetch_data(fetchLink){
var table = $('#example').DataTable( {
        "ajax": fetchLink,
        "scrollY":        "200px",
        "scrollCollapse": true,
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
             { "data": "sortBy" },
					{ "data": "location" },
		            { "data": "nameDep" },
		            { "data": "total_amount" }
		 ],
        "aaSorting": [],
        "buttons": [
            {
                "extend": 'pdfHtml5',
                //"pageSize": 'LEGAL',
                "customize": function (doc) {
				    doc.content[1].table.widths = 
				        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
				  }
            }
        ],
        "dom": 'Bfrtip',
        "pageLength": 10,
        "destroy":true
    } );
		$('#example tbody').off('click');
    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
}
	$(document).ready(function() {
		var strDate = $('#weeklyDatePicker').val();
		var endDate = $('#weeklyDatePicker1').val();
		var sortBy = $('#sort-by').val();
		// var locationGroupBy = $('#location-group-by').val();
		var location = ($('#loc').val()).toString()?($('#loc').val()).toString():0;
		var sale = ($('#sales').val()).toString()?($('#sales').val()).toString():0;
		var discount = ($('#discount').val()).toString()?($('#discount').val()).toString():0;
		var adjustment = ($('#adjustment').val()).toString()?($('#adjustment').val()).toString():0;
		var receipt = ($('#receipt').val()).toString()?($('#receipt').val()).toString():0;
		var val =  "{{ url('/') }}/viewReportingData/"+strDate+"/"+endDate+"/"+sortBy+"/"+location+"/"+sale+"/"+discount+"/"+adjustment+"/"+receipt;
		fetch_data(val);
    // Add event listener for opening and closing details
    
    	$.fn.DataTable.ext.pager.numbers_length = 5;

    	$('button.multiselect').addClass('form-control');
		
    	$.ajax({   
			type:       "POST",
			dataType:   "json",
			url:        "{{ url('/') }}/chartData",
			context: document.body, 
			global: false, 
			async: true,
       		data: { strDate : strDate, endDate : endDate, sortBy : sortBy, location : location, sale : sale, dis : discount, adj : adjustment, rec : receipt },        
        success: function (response) {
        	var graphdata= response['graph_data'];
        	var graphs= response['graphs'];
        	// $("#report_data").html(response['table_data']);
        	
        	console.log(response);
        	chart(graphdata,graphs);
        },
        error: function (response) {
            
        }

        	
        	
});
});
	function chart(graphdata,graphs) {
		var chart = AmCharts.makeChart("chartdiv", {
			"legend": {
    "useGraphSettings": true,
    "position": "top"
    

  },
  "type": "serial",
     "theme": "none",
  "categoryField": "department",
  "rotate": false,
  "startDuration": 1,
  "categoryAxis": {
    "gridPosition": "start",
    "position": "left"
  },
  "trendLines": [],
  "graphs":graphs,
  "guides": [],
  "valueAxes": [
    {
      "id": "ValueAxis-1",
      "position": "top",
      "axisAlpha": 0
    }
  ],
  "allLabels": [],
  "balloon": {},
  "titles": [],
  "dataProvider": graphdata,
    "export": {
      "enabled": true
     }

});
	}
	$("#submit_alert").click(function () {

		var strDate = $('#weeklyDatePicker').val();
		var endDate = $('#weeklyDatePicker1').val();
		var sortBy = $('#sort-by').val();
		// var locationGroupBy = $('#location-group-by').val();
		var location = ($('#loc').val()).toString()?($('#loc').val()).toString():0;
		var sale = ($('#sales').val()).toString()?($('#sales').val()).toString():0;
		var discount = ($('#discount').val()).toString()?($('#discount').val()).toString():0;
		var adjustment = ($('#adjustment').val()).toString()?($('#adjustment').val()).toString():0;
		var receipt = ($('#receipt').val()).toString()?($('#receipt').val()).toString():0;
		// var strDate = $('#weeklyDatePicker').val();
		// var endDate = $('#weeklyDatePicker1').val();
		// var sortBy = $('#sort-by').val();
		// var location = $('#loc').val();
		// var sale = $('#sales').val();
		// var discount = $('#discount').val();
		// var adjustment = $('#adjustment').val();
		// var receipt = $('#receipt').val();
    	
    	 var val =  "{{ url('/') }}/viewReportingData/"+strDate+"/"+endDate+"/"+sortBy+"/"+location+"/"+sale+"/"+discount+"/"+adjustment+"/"+receipt;
		 fetch_data(val);


    	
    	$.ajax({   
			type:       "POST",
			dataType:   "json",
			url:        "{{ url('/') }}/chartData",
			context: document.body, 
			global: false, 
			async: true,
       		data: { strDate : strDate, endDate : endDate, sortBy : sortBy, location : location, sale : sale, dis : discount, adj : adjustment, rec : receipt },        
        success: function (response) {

        	var graphdata= response['graph_data'];
        	var graphs= response['graphs'];
        	// $("#report_data").html(response['table_data']);
        	
        	console.log(response);
        	chart(graphdata,graphs);
       		// chart.dataProvider = response;
     		// chart.validateNow();
        },
        error: function (response) {
            
        }
    });		
    });
	


	function chart(graphdata,graphs) {
		var chart = AmCharts.makeChart("chartdiv", {
			"legend": {
    "useGraphSettings": true,
    "position": "top"
    

  },
  "type": "serial",
     "theme": "none",
  "categoryField": "department",
  "rotate": false,
  "startDuration": 1,
  "categoryAxis": {
    "gridPosition": "start",
    "position": "left"
  },
  "trendLines": [],
  "graphs":graphs,
  "guides": [],
  "valueAxes": [
    {
      "id": "ValueAxis-1",
      "position": "top",
      "axisAlpha": 0
    }
  ],
  "allLabels": [],
  "balloon": {},
  "titles": [],
  "dataProvider": graphdata,
    "export": {
      "enabled": true
     }

});
	






// 		var chart = AmCharts.makeChart("chartdiv", {
//             "legend": {
//     "useGraphSettings": true,
//     "position": "top"
    

//   },
//   "theme": "light",
//   "type": "serial",
//   "dataProvider": graphdata,
//   "valueAxes": [{
//     "stackType": "regular",
//     "position": "left",
//     "title": "Amount"
//   }],
//   "startDuration": 1,
//   "graphs": [
//     // 1200 stack
//     {
// 	  "newStack": true,
//       "fillAlphas": 0.9,
//       "lineAlpha": 0.2,
//       "title": "Sales",
//       "type": "column",
//       "valueField": "Sales",
//       "showAllValueLabels": true
//     },{
//       "newStack": true,
//       "fillAlphas": 0.9,
//       "lineAlpha": 0.2,
//       "title": "Discounts",
//       "type": "column",
//       "valueField": "Discounts",
//       "showAllValueLabels": true
//     },{
//       "newStack": true,
//       "fillAlphas": 0.9,
//       "lineAlpha": 0.2,
//       "title": "Adjustments",
//       "type": "column",
//       "valueField": "Adjustments",
//       "showAllValueLabels": true
//     },{
//       "newStack": true,
//       "fillAlphas": 0.9,
//       "lineAlpha": 0.2,
//       "title": "Receipts",
//       "type": "column",
//       "valueField": "Receipts",
//       "showAllValueLabels": true
//     }
//   ],
//   "plotAreaFillAlphas": 0.1,
//   "depth3D": 30,
//   "angle": 30,
//   "categoryField": "location",
//   "categoryAxis": {
//     "labelOffset": 15,
//     "gridPosition": "start",
//     "tickPosition": "start"
//   }
// });
	}
</script>

@endsection