@extends('layouts.layout')

@section('content')

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

<!--<script type="text/javascript" src="http://actiknowdemo.com/timesheet-view/js/jquery-3.2.1.min.js"></script>-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<section id="dashboard-page" class="wrap">
	<div class="container-fluid">

		@if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
     <div id="printablediv" style="page-break-before: always; page-break-after: always;">

        	<section id="dashboard-page" class="wrap">
        		<div class="container-fluid">
<h3 class="heading">Weekly Sales Report</h3>
<?php foreach ($allLocations as $key1 => $val1){ ?>
  <div class="row">
    <div class="col-sm-12">
      <div class="page-heading inline" style="margin-bottom:0">
        <!-- <h3 class="heading">Weekly Sales Report</h3> -->
             <h4 class="heading"> {{ $val1->location_code }} - {{ $val1->location }}</h4>
      </div>
    </div>
<style>
 .custom-table-print>tbody>tr>td>table>thead>tr>th,.custom-table-print>tbody>tr>td>table>tfoot>tr>th
{
 text-align:left;
}
</style>
<div class="row">
<div class="col-md-12">
<div class="widget form-layout" style="margin-bottom:10px;margin-top:10px;">
    <div class="widget-content" style="padding: 0;">
    	<div class="row">
          <div class="col-md-12">
          	<table class="table custom-table" border="1" cellspacing="0" style="width:100%;font-size:9px;font-family:calibri;">
          		<colgroup>
		<col span="1" style="background-color:#fff">
		<col span="2" style="background-color:#eee">
		<col span="2" style="background-color:#fff">
		<col span="2" style="background-color:#eee">
		<col span="2" style="background-color:#fff">
		<col span="2" style="background-color:#eee">
	  </colgroup>
	    <thead>
			<tr class="thead-Dark">
          <th style="font-weight:normal;font-size:10px; border: 0px; width: 10%;">Date</th>
          <?php $i=0;  foreach ($result as $key => $val){?>
             <?php if($sortBy1 == 0){?>
         	<th colspan = '2' id="day1" class="text-center" style="font-weight:normal;font-size:9px;"><?php echo ($val['sortBy']); ?></th>
          <?php }else{?>
            <th id="day1" class="text-center" style="font-weight:normal;font-size:9px;"><?php echo ($val['sortBy']); ?></th>
             <?php }?>
         	<?php  $i++;}?>
       </tr>
       <tr>
          <th></th>
          <?php if($sortBy1 == 0){
          for($j=1; $j<=$i; $j++) { ?>

              <th class="text-center" style="font-weight:normal;font-size:10px;">Units</th>
              <th class="text-center" style="font-weight:normal;font-size:10px;">Amount</th>
               <?php } } ?>
              <?php if($sortBy1 == 1){
              for($j=1; $j<=$i; $j++) { ?>
              <th class="text-center" style="font-weight:normal;font-size:10px;">Amount</th>
               <?php } }?>
                <?php if($sortBy1 == 2){
                for($j=1; $j<=$i; $j++) { ?>
              <th class="text-center" style="width:59px;font-weight:normal;font-size:10px;">Units</th>
               <?php } }?>
       </tr>
	    </thead>
	     <tbody>
	     	<?php
           foreach($departmentArr as $dep){ ?>
	     	           <tr class="thead-Dark">
                      <th style="font-weight:bold;font-size:12px;"><?php echo $dep; ?></th>
                   </tr>
                   <?php if(isset($$dep)) { foreach($$dep as $k=> $sd){ ?>
                   	<tr>
                   		<td style="font-weight:normal;font-size:10px;"><?php echo $sd; ?></td>
                   		<?php $locVar = "location_".$val1->id."_".$dep; ?>

                        <?php if($sortBy1 == 0){
                          foreach ($result as $key => $rv){  ?>

                   	        	  <td style="font-size:9px;"><?= isset($resDataun[$locVar."_".$rv['dt']][$k])?($resDataun[$locVar."_".$rv['dt']][$k]):0; ?></td>
			                        	<td style="font-size:9px;position:relative">$<?= isset($resData[$locVar."_".$rv['dt']][$k])?($resData[$locVar."_".$rv['dt']][$k]):0; ?></td>
                            <?php } }?>

                            <?php if($sortBy1 == 1){
                              foreach ($result as $key => $rv){  ?>
                                <td style="font-size:9px;position:relative">$<?= isset($resData[$locVar."_".$rv['dt']][$k])?($resData[$locVar."_".$rv['dt']][$k]):0; ?></td>
                            <?php } }?>

                            <?php if($sortBy1 == 2){
                              foreach ($result as $key => $rv){  ?>
                                <td style="font-size:9px;"><?= isset($resDataun[$locVar."_".$rv['dt']][$k])?($resDataun[$locVar."_".$rv['dt']][$k]):0; ?></td>
                            <?php } }?>
                 <?php   } ?>
                   	</tr>
                <?php } } ?>
                   </tr>
	     </tbody>
          	</table>
          </div>
      </div>
    </div>
</div>
</div>
</div>
		</div>
     <?php } ?>
</div>
    	</section>
    </div>
</div>
</section>
<style type="text/css" media="print">
header nav, footer {
display: none;
}
table.dataTable thead .sorting_desc:after {
    opacity:0!important;
    content: "\e155";
}
table.dataTable thead .sorting_asc:after {

    opacity: 0!important;
    content: "\e156";
}

</style>
<script language="Javascript">
  $(window).on("load", function (e) {
    $("#test_default").trigger("onclick");
});

function printDiv(divID) {
//Get the HTML of div
var divElements = document.getElementById(divID).innerHTML;
var contents = divElements;
var frame1 = $('<iframe />');
frame1[0].name = "frame1";
frame1.css({"position": "absolute", "top": "-1000000px",  });
$("body").append(frame1);
var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
frameDoc.document.open();
frameDoc.document.write('<html><head><style type="text/css" media="print"> @page {  margin: 10mm;} body {  margin: 10mm;  }  </style><title></title>');
frameDoc.document.write('</head><body>');
frameDoc.document.write(contents);
frameDoc.document.write('</body></html>');
frameDoc.document.close();
setTimeout(function () {
window.frames["frame1"].focus();
window.frames["frame1"].print();
frame1.remove();
window.history.go(-1);
}, 500);

}
</script>
<input name="print" TYPE="button" id="test_default" class="button" VALUE="Print Order" onclick="javascript:printDiv('printablediv')">

@endsection
