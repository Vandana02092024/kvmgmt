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
  overflow: hidden;
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

table.dataTable thead .sorting:after

{
	opacity: 0;
}
.cur_data th{
	font-size:12px;
}
.cur_td {
    font-size: 12px;
}
/*.sw-20{
	width: 20%;
}*/
  
  </style>

<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<div class="page-heading">
					<h3 class="heading">SALES REPORTING</h3>
					
				</div>
			</div>

			<div class="col-sm-8">
				<div class="row">
		
					<div class="col-md-12 text-right">
						<ul class="inline">
							<!-- <li><label>Start Date:</label></li>
							<li><input type="text" name="" class="form-control" value="<?php echo date('m-d-Y');?>" autocomplete="off" id="weeklyDatePicker2" name="datepick" placeholder=" To "></li>
							<li><label>End Date:</label></li>
							<li><input type="text" name="" class="form-control" value="<?php echo date('m-d-Y',strtotime('-30 days'));?>" autocomplete="off" id="weeklyDatePicker3" name="datepick" placeholder=" From "></li> -->
							<li><a class="v-btn v-btn-primary" id="print_data" href="{{'#'}}">PDF REPORT</a></li>
							<li><a class="v-btn v-btn-primary" href="{{ url('/dashboard') }}">DASHBOARD</a></li>
							<li><a class="v-btn v-btn-primary" href="{{ url('/dashboard') }}">BACK</a></li>
						</ul>
					</div>
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 top-filter">
				<div class="widget">
					<div class="widget-content">
						<div class="form-group row">
							<div class="col-md-4">
								{{ csrf_field() }}
								<label>Start Date</label>
								<input type="text" name="" class="form-control" value="<?php echo date('m-d-Y',strtotime('-30 days'));?>" autocomplete="off" id="weeklyDatePicker" name="datepick" placeholder=" From ">
								</div>
							<div class="col-md-4">
								<label>End Date</label>
								<input type="text" name="" class="form-control"   value="<?php echo date('m-d-Y');?>" autocomplete="off" id="weeklyDatePicker1" name="datepick" placeholder=" To ">
							</div>
							<div class="col-md-4">
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
							<div class="col-md-4">
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
							<!-- <div class="col-md-4">
								<label>Group By</label>
								<select class="form-control" id="location-group-by">
									<option value="0">Sum</option>
									<option value="1" selected>Individual</option>
									
								</select>
							</div> -->
							<div class="col-md-4">
								<label>Sales</label>
								<select class="form-control multi-dropdown" id="sales" multiple="multiple">
									<!-- <option value=''>Select Sales</option> -->
									<?php foreach($sales as $k=>$v){ ?>
									<option value="<?php echo $k; ?>" selected><?php echo $v; ?></option>
									
									<?php } ?>
								</select>
							</div>
							<div class="col-md-4">
								<label>Discounts</label>
								<select class="form-control multi-dropdown" id="discount" multiple="multiple">
								<!-- 	<option value=''>Select Discounts</option> -->
									<?php foreach($discount as $k=>$v){ ?>
									<option value="<?php echo $k; ?>" selected ><?php echo $v; ?></option>
									
									<?php } ?>
								</select>
							</div>
							<div class="col-md-4">
								<label>Adjustments</label>
								<select class="form-control multi-dropdown" id="adjustment" multiple="multiple">
									<!-- <option value=''>Select Adjustment</option> -->
									<?php foreach($adjustment as $k=>$v){ ?>
									<option value="<?php echo $k; ?>" selected ><?php echo $v; ?></option>
									
									<?php } ?>
								</select>
							</div>
							<div class="col-md-4">
								<label>Receipts</label>
								<select class="form-control multi-dropdown" id="receipt" multiple="multiple">
									<!-- <option value=''>Select Receipt</option> -->
									<?php foreach($receipt as $k=>$v){ ?>
									<option value="<?php echo $k; ?>" selected ><?php echo $v; ?></option>
									
									<?php } ?>
								</select>
							</div>

							<div class="col-md-12">
								<div class="form-group" style="margin-top: 10px;">
								<input class="v-btn v-btn-primary " type="submit" name="submit" id="submit_alert" value="Submit">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="widget">
					<div class="widget-header" style="padding-bottom: 10px;">
						<h4 class="">Current Reporting Data - <span style="font-size: 14px;">{{ session()->get('locationName') }}</span></h4>
					</div>
					<div class="widget-content"  style=" padding: 0;">
						<div style="height:170px;width: 100%;">
							<table id="current_date" class="table display nowrap" style="width:100%; border: 1px solid #fff;">
								@foreach($currentData as $key=>$val)
								@foreach($currentMonth as $key1=>$val1)
								@foreach($currentYear as $key2=>$val2)
								<tr style="background: #ddd" class="cur_data">
									<th></th>
									<th>Today</th>
									<th>Current Month</th>
									<th>Current Year</th>
								</tr>
								<tr>
									<td class="cur_td"><b>Sale</b></td>
									<td>${{$val->sale_sales}}</td>
									<td>${{$val1->sale_sales}}</td>
									<td>${{$val2->sale_sales}}</td>
								</tr>
								<tr>
									<td class="cur_td"><b>Adjustment</b></td>
									<td>${{$val->adj_sales}}</td>
									<td>${{$val1->adj_sales}}</td>
									<td>${{$val2->adj_sales}}</td>
								</tr>
								<tr>
									<td class="cur_td"><b>Discount</b></td>
									<td>${{$val->dis_sales}}</td>
									<td>${{$val1->dis_sales}}</td>
									<td>${{$val2->dis_sales}}</td>
								</tr>
								<tr>
									<td class="cur_td"><b>Recipts</b></td>
									<td>${{$val->rec_sales}}</td>
									<td>${{$val1->rec_sales}}</td>
									<td>${{$val2->rec_sales}}</td>
								</tr>
								@endforeach
								@endforeach
								@endforeach
							</table>
						</div>
					</div>
					<div class="widget-footer">
					</div>
				</div>
			</div>
		</div>
<!-- modal -->

<!-- modal -->
		<div class="row">
			<div class="col-md-4">
				<div class="widget">
					<div class="widget-header" style="padding-bottom: 0">
						<h4 class="">Reporting Data Chart</h4>
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
						        <thead  id="table_thead">
						           
						        </thead>
						    </table>
						</div>
					</div>
				</div>
				
			</div>
			
			
		</div>

		<!-- <div class="col-md-12">
			

			<button type="button" class="btn btn-info btn-lg" id="print_data" data-toggle="modal" data-target="#myModal">PDF</button>


		</div> -->

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
   selectAllText: ' Select All'

});
	
// function fetch_data(fetchLink){

// }
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

		var url =  "{{ url('/') }}/reportingsections/printReportData/"+strDate+"/"+endDate+"/"+sortBy+"/"+location+"/"+sale+"/"+discount+"/"+adjustment+"/"+receipt;
		// var val =  "{{ url('/') }}/viewReportingData/"+strDate+"/"+endDate+"/"+sortBy+"/"+location+"/"+sale+"/"+discount+"/"+adjustment+"/"+receipt;
		// fetch_data(val);
    // Add event listener for opening and closing details
    
    	// $.fn.DataTable.ext.pager.numbers_length = 5;

    	// $('button.multiselect').addClass('form-control');
		
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
    	var _token = $('input[name="_token"]').val();
    	$.ajax({   
			type:       "post",
			dataType:   "html",
			url:        "{{ url('/') }}/viewReportingData",
       		data: { strDate : strDate, endDate : endDate, sortBy : sortBy, location : location, sale : sale, dis : discount, adj : adjustment, rec : receipt, _token : _token },        
        success: function (response) {
        	$("#report_data").html(response);
        	console.log(response);
        },
        error: function (response) {
        }
    });	
});

//print

	$("#print_data").click(function () {
// function genratePdf() {
		var strDate = $('#weeklyDatePicker').val();
		var endDate = $('#weeklyDatePicker1').val();
		var sortBy = $('#sort-by').val();
		// var locationGroupBy = $('#location-group-by').val();
		var location = ($('#loc').val()).toString()?($('#loc').val()).toString():0;
		var sale = ($('#sales').val()).toString()?($('#sales').val()).toString():0;
		var discount = ($('#discount').val()).toString()?($('#discount').val()).toString():0;
		var adjustment = ($('#adjustment').val()).toString()?($('#adjustment').val()).toString():0;
		var receipt = ($('#receipt').val()).toString()?($('#receipt').val()).toString():0;

    	 var url =  "{{ url('/') }}/reportingsections/printReportData/"+strDate+"/"+endDate+"/"+sortBy+"/"+location+"/"+sale+"/"+discount+"/"+adjustment+"/"+receipt;

			$("#print_data").attr("href",url);
    	 // console.log(url);
		 // fetch_data(val);

});
	//print


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

    	 // var val =  "{{ url('/') }}/viewReportingData/"+strDate+"/"+endDate+"/"+sortBy+"/"+location+"/"+sale+"/"+discount+"/"+adjustment+"/"+receipt;
		 // fetch_data(val);


    	var _token = $('input[name="_token"]').val();
    	$.ajax({   
			type:       "POST",
			dataType:   "json",
			url:        "{{ url('/') }}/chartData",
			context: document.body, 
			global: false, 
			async: true,
       		data: { strDate : strDate, endDate : endDate, sortBy : sortBy, location : location, sale : sale, dis : discount, adj : adjustment, rec : receipt, _token : _token },        
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


    		var _token = $('input[name="_token"]').val();
  			$.ajax({   
			type:       "post",
			dataType:   "html",
			url:        "{{ url('/') }}/viewReportingData",
       		data: { strDate : strDate, endDate : endDate, sortBy : sortBy, location : location, sale : sale, dis : discount, adj : adjustment, rec : receipt, _token : _token },        
        success: function (response) {

        	
        	$("#report_data").html(response);
        	
        	console.log(response);
        	
       		
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
</script>	

@endsection