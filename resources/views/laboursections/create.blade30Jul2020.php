@extends('layouts.layout')

@section('content')
<style type="text/css">
    .main-content
	{
		padding-bottom:0!important;
	}
	.widget{
		margin-bottom:0!important;
	}
	.widget-content
	{
		padding:.5em!important;
	}
   .basic-table>tbody>tr>td
   {
      padding: 1px 4px;
      font-size:12px;
      font-family: calibri;
   }
   .basic-table>tbody>tr>th
   {
      padding: 1px 4px;
      font-size:12px;
      font-family: calibri;
   }
   .background-pink
   {
      background: #ffcc99;
   }
   .background-blue
   {
      background: #c0c0c0;
   }
   .background-yellow
   {
      background: #ffff00;
   }
   table.table-style>tbody>tr>td>input[type="text"] {
    background: none!important;
    box-shadow: none!important;
    border: none!important;
    width: 60px!important;
    height: 100%!important;
    padding: 5px!important;
}
table.table-style>tbody>tr>td {
    padding: 0!important;
	
}

   .highlight-field {
   background: #f6c622;
   color: #382f2f;
   padding: 5px 10px;
   font-size: 13px;
   }
   .highlight-field  textarea
   {
   height: 70px;
   }
   .highlight-field span
   {
   font-weight: bold;
   color: #382f2f;
   }
   .widget
   {
   background: #fff;
   color: #000;
   }
   .lighted-div
   {
   background: #382f2f;
   padding: 10px 10px;
   color: #fff;
   }
   .lighted-div input
   {
   height: 21px!important;
   }
   .highlight-field input
   {
   height: 21px!important;
   }
   .highlight-field .form-group
   {
   margin-bottom:5px!important;
   }
   .blank_row
   {
   height: 10px;
   }
   .filter-container
   {
   background: #382f2f;
   padding: 6px;
   color: #fff;
   }
   .day-filter {
   background: #000;
   padding: 3px;
   margin-left: 5px;
   }
   .table-scroll
   {
	   overflow-x:scroll;
	   
   }

</style>

<?php
$dataList = array();
if (is_array($currentdata) || is_object($currentdata)){
foreach($currentdata as $k){

	$k = (array) $k;	
	$dataList[$k['weekNO'].'-'.$k['empName'].'-'.$k['catName'].'-'.$k['depName']] = $k;
	
}}
/* echo "<pre>";print_R( $dataList);
								exit; */

?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

<!--<script type="text/javascript" src="http://actiknowdemo.com/timesheet-view/js/jquery-3.2.1.min.js"></script>-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<section id="dashboard-page" class="wrap">
   <div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
			    <h3 class="heading">WEEKLY LABOUR REPORT
				<form class="pull-right inline"  method="POST" action="{{ url('/laboursection') }}">
					{{ csrf_field() }}	
					<ul class="pull-right inline quick-info">
						<li>
							<div class="input-group" id="DateDemo">
								<input type="text" class="form-control" autocomplete="off" id='weeklyDatePicker' name="datepick"  placeholder="Select Week" value="<?php echo $lastSat.' - '.$nextFri;  ?>"/>
							</div>
						</li>
						<li>
						<div class="input-group" >
							<input class="v-btn v-btn-primary" type="submit" name="submit" id="weekDatapick" value="FILTER" onClick= "dateData()">
						</div>
						</li>
						<li>
						<div class="input-group" >
						<a class="v-btn v-btn-primary pull-right" href="{{ url('/laboursection') }}">BACK</a>
						</div>
						</li>
					</ul>
					</form>
				
				</h3>
						
				
			</div>
		</div>
<input type="hidden" id="startDate" value="{{ $startDatestore }}">	
   <div class="row">
      <div class="col-sm-12">
         <div class="widget form-layout">
            <div class="widget-content padding">
               <div class="row">
                  <div class="col-md-12">
				    <div class="table-scroll">
                     <table class="table table-bordered basic-table table-style">
                        <tr>
                           <th></th>
                           <th></th>
                           <th colspan="<?php echo count($payrollCategory) + 1?>" style="background: #ffcc99;text-align: center;" ><span id="weekStoreOne"><?php echo "WEEK#".$weeksStoreOne." ".$lastSat." - ".$nextFri; ?></span></th>
                           <th colspan="<?php echo count($payrollCategory) + 1?>" style="background: #ffcc99;text-align: center;"><span id="weekStoreTwo"><?php echo "WEEK#".$weeksStoreTwo; ?></span></th>
                           <th  colspan="<?php echo count($payrollCategory)?>" style="background: #ffcc99;text-align: center;">TOTALS</th>
                           <th></th>
                        </tr>
                        <tr>
                           <th style="white-space:nowrap;text-align:center;">EMPLOYEE NAME</th>
                           <th style="white-space:nowrap;text-align:center;">PAY RATE</th>
						   <?php foreach($payrollCategory as $pC){ ?>
                           <th style="white-space:nowrap;text-align:center;" class="background-pink"><?php echo strtoupper($pC->name);?></th>
						   <?php } ?>
                           <th style="white-space:nowrap;text-align:center;" class="background-pink">TOTAL</th>
                           <?php foreach($payrollCategory as $pC){ ?>
                           <th style="white-space:nowrap;text-align:center;" class="background-blue"><?php echo strtoupper($pC->name);?></th>
						   <?php } ?>
                           <th style="white-space:nowrap;text-align:center;" class="background-blue">TOTAL</th>
                           <?php foreach($payrollCategory as $pC){ ?>
                           <th style="white-space:nowrap;text-align:center;" class="background-yellow"><?php echo "TOTAL / ".strtoupper($pC->name);?></th>
						   <?php } ?>
                           <th style="white-space:nowrap;text-align:center;">GRAND TOTALS</th>
                        </tr>
						<?php 
						$i = 0;						
						foreach($dataEmp as $pkey => $pD) {	
						$i++;							
						?>						
                        <tr>
							<td colspan="23" style="background-color:#dddddd82; font-weight:600; font-size:12px;" align="center"><?php echo $pkey; ?>
							<button class="v-btn v-btn-primary pull-left btn-xs" title="Add Employee For <?php echo $pkey;?>" style="font-size: 10px;	height: 17px;line-height: 13px;margin-left:-1px;"	onClick="addNewEmployee('<?php echo $pkey;?>','<?php echo $weeksStoreOne; ?>','<?php echo $weeksStoreTwo; ?>')"><i class="fa fa-plus"></i></button>
							<?php 
							$original_pKey = $pkey;
							$pkey = str_replace(' ','',str_replace('/','_',trim($pkey)));?>
							</td>
						</tr>
							<?php foreach ($pD as $empD){ ?>
						<tr>
                     <!-- onClick="removeEmployeeChange('<?php echo $empD[4]; ?>','<?php echo $original_pKey; ?>')" -->
							<td class="text-center" style="vertical-align:middle;"><button class="v-btn pull-left btn-sm" title="Add Employee For <?php echo $pkey;?>" style="font-size: 10px;	height: 17px;line-height: 13px;margin-left:-1px;color:red;    background-color: transparent;padding: 0;"  onclick="removeSelectedDepartment(<?php echo $empD[5]; ?>)"><i class="fa fa-remove"></i></button>	<?php echo "<b>".$empD[0]."</b>" ;?></td>
							<td class="text-center" style="vertical-align:middle;">$<?php echo $empD[1] ;?> </td>
							<?php 
							$x = 0;
							foreach($payrollCategory as $pC){ 
							$x++;
							$match = $weeksStoreOne.'-'.$empD[0].'-'.$pC->name.'-'.$original_pKey;
							$value = (empty($dataList[$match]['rate'])?'':$dataList[$match]['rate']);								
							?>
								<td class="background-pink">
								<?php if($pC->name == 'Salary') {?>
								<input type="text" readonly class="currency  <?php echo $pkey.'-'.$empD[2].'-'.'weekOne'.'-'.$x;?>  <?php echo $pkey.'-'.$empD[2].'-'.'weekOne'.'-'.$pC->name; ?>  <?php echo 'weekOne'.'-'.$pC->name; ?>  <?php echo 'weekOne'.$i.'_user'.$empD[4].'_'.$pkey; ?>" payRatemultiplier="<?php echo $pC->pay_rate_multiplier;?>" empName="<?php echo $empD[2] ;?>" catName="<?php echo $pC->name ;?>" depName="<?php echo $pkey;?>" depName_original="<?php echo $original_pKey;?>" weekNo="" payrate="<?php echo $empD[1] ;?>" value="<?php echo '$ '.((!empty($empD[2])) ? $empD[2] : '0'); ?>" keyupValue="one" 	onchange="sumData('<?php echo $pkey.'-'.$empD[4].'-'.'weekOne';?>','<?php echo $i; ?>','<?php echo $empD[4] ;?>','<?php echo $pC->pay_rate_multiplier;?>','<?php echo $empD[1] ;?>','<?php echo $pkey; ?>' )" onkeypress="return validateFloatKeyPress(this,event);">
								<?php } /*else if($pC->name == 'Regular'){ ?>	
								<input type="text" readonly class="currency dataSave <?php echo $pkey.'-'.$empD[3].'-'.'weekOne'.'-'.$x;?>  <?php echo $pkey.'-'.$empD[3].'-'.'weekOne'.'-'.$pC->name; ?>  <?php echo 'weekOne'.'-'.$pC->name; ?> <?php echo 'weekOne'.$i.'_user'.$empD[4].'_'.$pkey; ?>" payRatemultiplier="<?php echo $pC->pay_rate_multiplier;?>" empName="<?php echo $empD[3] ;?>" catName="<?php echo $pC->name ;?>" depName="<?php echo $pkey;?>" depName_original="<?php echo $original_pKey;?>" weekNo="" payrate="<?php echo $empD[1] ;?>" value="<?php echo $empD[3]; ?>" keyupValue="one" 	onchange="sumData('<?php echo $pkey.'-'.$empD[4].'-'.'weekOne';?>','<?php echo $i; ?>','<?php echo $empD[4] ;?>','<?php echo $pC->pay_rate_multiplier;?>','<?php echo $empD[1] ;?>','<?php echo $pkey; ?>' )" onkeypress="return validateFloatKeyPress(this,event);">	
								<?php } */else{ ?>
								<input type="text" class="currency dataSave <?php echo $pkey.'-'.$empD[0].'-'.'weekOne'.'-'.$x;?>  <?php echo $pkey.'-'.$empD[0].'-'.'weekOne'.'-'.$pC->name; ?>  <?php echo 'weekOne'.'-'.$pC->name; ?> <?php echo 'weekOne'.$i.'_user'.$empD[4].'_'.$pkey; ?>" payRatemultiplier="<?php echo $pC->pay_rate_multiplier;?>" empName="<?php echo $empD[0] ;?>" catName="<?php echo $pC->name ;?>" depName="<?php echo $pkey;?>" depName_original="<?php echo $original_pKey;?>" weekNo="" payrate="<?php echo $empD[1] ;?>" value="<?php echo $value; ?>" keyupValue="one" 	onchange="sumData('<?php echo $pkey.'-'.$empD[4].'-'.'weekOne';?>','<?php echo $i; ?>','<?php echo $empD[4] ;?>','<?php echo $pC->pay_rate_multiplier;?>','<?php echo $empD[1] ;?>','<?php echo $pkey; ?>' )" onkeypress="return validateFloatKeyPress(this,event);"
								></td> 
								<?php } ?>
							<?php } ?>								
							   <td class="background-pink"> <input type="text" class="<?php echo $pkey.'-'.$empD[0].'-'.'weekOne'.'-main'.$i; ?> <?php echo $pkey.'-'.$empD[0].'-'.'weekOne'.'-total'; ?>  <?php echo 'weekOne'.'-total'; ?> <?php echo 'weekOne'.$i.'_user'.$empD[4].'_'.$pkey.'_main'; ?>"  readonly empName="<?php echo $empD[0] ;?>" catName="<?php echo $pC->name ;?>" depName="<?php echo $pkey;?>" weekNo="weekOne" depName_original="<?php echo $original_pKey;?>" value=""></td>							   
							<?php 
							$y = 0;
							foreach($payrollCategory as $pC){ 
							$y++;
							 $match = $weeksStoreTwo.'-'.$empD[0].'-'.$pC->name.'-'.$original_pKey;
							
							$value = (empty($dataList[$match]['rate'])?'':$dataList[$match]['rate']);
							
							
							?>
								<td class="background-blue">
									<?php if($pC->name == 'Salary') {?>
									<input type="text" readonly class="currency  <?php echo $pkey.'-'.$empD[2].'-'.'weekTwo'.'-'.$y;?> <?php echo $pkey.'-'.$empD[2].'-'.'weekTwo'.'-'.$pC->name; ?>   <?php echo 'weekTwo'.'-'.$pC->name; ?> <?php echo 'weekTwo'.$i.'_user'.$empD[4].'_'.$pkey; ?>" payRatemultiplier="<?php echo $pC->pay_rate_multiplier;?>" empName="<?php echo $empD[2] ;?>" catName="<?php echo $pC->name ;?>" depName="<?php echo $pkey;?>" depName_original="<?php echo $original_pKey;?>" weekNoTwo="" payrate="<?php echo $empD[1] ;?>" value="<?php echo '$ '.((!empty($empD[2])) ? $empD[2] : '0') ?>" keyupValue="two" onchange="sumDataTwo('<?php echo $pkey.'-'.$empD[4].'-'.'weekTwo';?>','<?php echo $i; ?>','<?php echo $empD[4] ;?>','<?php echo $pC->pay_rate_multiplier;?>','<?php echo $empD[1] ;?>','<?php echo $pkey; ?>' )" onkeypress="return validateFloatKeyPress(this,event);"> 
									<?php } /*else if($pC->name == 'Regular'){ ?>	
									<input type="text" readonly class="currency dataSave <?php echo $pkey.'-'.$empD[3].'-'.'weekTwo'.'-'.$y;?>  <?php echo $pkey.'-'.$empD[3].'-'.'weekTwo'.'-'.$pC->name; ?>  <?php echo 'weekTwo'.'-'.$pC->name; ?> <?php echo 'weekTwo'.$i.'_user'.$empD[4].'_'.$pkey; ?>" payRatemultiplier="<?php echo $pC->pay_rate_multiplier;?>" empName="<?php echo $empD[3] ;?>" catName="<?php echo $pC->name ;?>" depName="<?php echo $pkey;?>" depName_original="<?php echo $original_pKey;?>" weekNoTwo="" payrate="<?php echo $empD[1] ;?>" value="<?php echo $empD[3]; ?>" keyupValue="two" 	onchange="sumDataTwo('<?php echo $pkey.'-'.$empD[4].'-'.'weekTwo';?>','<?php echo $i; ?>','<?php echo $empD[4] ;?>','<?php echo $pC->pay_rate_multiplier;?>','<?php echo $empD[1] ;?>','<?php echo $pkey; ?>' )" onkeypress="return validateFloatKeyPress(this,event);">	
									<?php }*/ else{ ?>
									<input type="text" class="currency dataSave <?php echo $pkey.'-'.$empD[0].'-'.'weekTwo'.'-'.$y;?> <?php echo $pkey.'-'.$empD[0].'-'.'weekTwo'.'-'.$pC->name; ?>   <?php echo 'weekTwo'.'-'.$pC->name; ?> <?php echo 'weekTwo'.$i.'_user'.$empD[4].'_'.$pkey; ?>" payRatemultiplier="<?php echo $pC->pay_rate_multiplier;?>" empName="<?php echo $empD[0] ;?>" catName="<?php echo $pC->name ;?>" depName="<?php echo $pkey;?>" depName_original="<?php echo $original_pKey;?>" weekNoTwo="" payrate="<?php echo $empD[1] ;?>" value="<?php echo $value; ?>" keyupValue="two" onchange="sumDataTwo('<?php echo $pkey.'-'.$empD[4].'-'.'weekTwo';?>','<?php echo $i; ?>','<?php echo $empD[4] ;?>','<?php echo $pC->pay_rate_multiplier;?>','<?php echo $empD[1] ;?>','<?php echo $pkey; ?>' )"
									onkeypress="return validateFloatKeyPress(this,event);" ></td>  
									<?php } ?>
							<?php } ?>
							   <td class="background-blue"><input type="text" class="<?php echo $pkey.'-'.$empD[0].'-'.'weekTwo'.'-mainTwo'.$i; ?> <?php echo $pkey.'-'.$empD[0].'-'.'weekTwo'.'-total'; ?>  <?php echo 'weekTwo'.'-total'; ?> <?php echo 'weekTwo'.$i.'_user'.$empD[4].'_'.$pkey.'_mainTwo'; ?>" readonly empName="<?php echo $empD[0] ;?>" catName="<?php echo $pC->name ;?>" depName_original="<?php echo $original_pKey;?>" depName="<?php echo $pkey;?>" weekNo="weekTwo"  value=""></td>
							   <?php foreach($payrollCategory as $pC){ ?>
								<td class="background-yellow <?php echo $pC->name.'_'.$i.'_user'.$empD[4].'_'.$pkey.'_total'; ?> <?php echo $pC->name.'_total';?>"></td>
							   <?php } ?>
							   <td class="<?php echo 'user'.$empD[4].'_'.$pkey.'_grandtotal_'.$i;?> grandtotalall"></td>
							</tr>                        
							<?php 
								}
						}
						?>
                        <tr style="font-weight: bold;">
                           <td rowspan="2" style="text-align: center;">
                              TOTAL ALL 
                           </td>
                           <td></td>
						    <?php foreach($payrollCategory as $pC){ ?>
                           <td id="<?php echo "weekOne".$pC->name; ?>"></td>                          
						   <?php } ?> 
						    <td id="weekOneTotal"> </td>
						   <?php foreach($payrollCategory as $pC){ ?>
                           <td id="<?php echo "weekTwo".$pC->name;?>"></td>                          
						   <?php } ?>
                           <td id="weekTwoTotal"> </td>						   
						   <?php foreach($payrollCategory as $pC){ ?>
                           <td id="<?php echo "Final".$pC->name;?>"></td>                          
						   <?php } ?>
                           <td id="FinalOverallTotal"></td>
                        </tr>
                        <tr style="font-weight: bold;">
                           <td> </td>
						   <?php foreach($payrollCategory as $pC){ ?>
                           <td><?php echo strtoupper($pC->name);?></td>                          
						   <?php } ?>                           
                           <td>W/K TOTAL</td>
                           <?php foreach($payrollCategory as $pC){ ?>
                           <td><?php echo strtoupper($pC->name);?></td>                          
						   <?php } ?>
                           <td>W/K TOTAL </td>
						    <?php foreach($payrollCategory as $pC){ ?>
                           <td ><?php echo strtoupper($pC->name)." TOTAL";?></td>                          
						   <?php } ?>
                           <td>TOTAL </td>
                        </tr>
                     </table>
					 </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
						
</section>



<div class="modal fade" id="modalDepData" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->	 
	<form method="post" id="depData">	  
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Add New Employee</h4>
			</div>
			<div class="modal-body">	
				<div class="container-fluid">
				<input type="hidden" name="depName" id="depName">		
				<input type="hidden" name="weekOneData" id="weekOneData">
				<input type="hidden" name="weekTwoData" id="weekTwoData">
					<div class="row form-group">
						<label class="col-md-4">Employee Name: </label>
						<div class="col-md-8">
							<input type="text" autocomplete = "off" name="fieldValue" id="name" class="form-control">
						</div>
					</div>
					<div class="row form-group">
						<label class="col-md-4">Employee Rate: </label>
						<div class="col-md-8">
							<input type="text" autocomplete = "off" name="fieldValuerate" id="rate" class="form-control" onkeypress="return validateFloatKeyPress(this,event);">
						</div>
					</div>
					<div class="row form-group">
						<label class="col-md-4">Employee Salary: </label>
						<div class="col-md-8">
							<input type="text" autocomplete = "off" name="fieldValuesalary" id="salary" class="form-control" onkeypress="return validateFloatKeyPress(this,event);">
						</div>
					</div>
					<div class="row form-group">
						<label class="col-md-4">Employee Working Hour: </label>
						<div class="col-md-8">
							<input type="text" autocomplete = "off" name="fieldValueworkinghour" id="workinghour" class="form-control" onkeypress="return validateFloatKeyPress(this,event);">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-primary submitBtn"  id="submitDep">SUBMIT</button>
				
			 </div>
		</div>
	</form>	
    </div>
</div>
					

<script>


/* useful functions start*/
function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if(number.length>1 && charCode == 46){
         return false;
    }
  
    return true;
}
(function($) {
        $.fn.currencyFormat = function() {
            this.each( function( i ) {
                $(this).change( function( e ){
                    if( isNaN( parseFloat( this.value ) ) ) return;
                    this.value = parseFloat(this.value).toFixed(2);
                });
            });
            return this; 
        }
    })( jQuery );   
    $( function() {
        $('.currency').currencyFormat();
    });
/* useful function ends */ 	
/* date calculations */
var stDate = "<?php echo $lastSat; ?>";
var enDate = "<?php echo $nextFri; ?>";
	$("#weeklyDatePicker").datetimepicker({		
		format: 'MM-DD-YYYY',
		maxDate: 'now',
   });
   $("#weeklyDatePicker").val(stDate+' - '+enDate);   
	var value = $("#weeklyDatePicker").val();	
	var datesData = value.split(" - ");
	var firstDate = datesData[0];
	$.ajax({
		type:       "POST",
		dataType:   "text",
		url:        "{{ url('/') }}/weekNumber",
		data: {firstDate: firstDate},
		success: function(data)
		{			
			var value = data.split("|");			
			$('#weekStoreOne').text("WEEK #"+value[0]);
			$('#weekStoreTwo').text("WEEK #"+value[1]);
			$('.dataSave').attr( 'weekNo',value[0]);
			$('.dataSave').attr( 'weekNoTwo',value[1]);			
		}
	});		
    
	var storeLastaturdayDate = "<?= date("m-d-Y", strtotime($lastSatFormat)); ?>";
	var stt = "<?= $sDateStore; ?>";
	
	var date_diff_indays = function(date1, date2) {
			dt1 = new Date(date1);
			dt2 = new Date(date2);
			var daysStore = ((dt2- dt1) / (1000 * 60 * 60 * 24));
			
			console.log((dt2- dt1)+"differ");
			return parseInt((daysStore)/7) + 1;
		
			//return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24));
    }
	
	$( "#weeklyDatePicker" ).click(function() {
		var test =  $("#weeklyDatePicker").val();	
		if(test == ''){
			$("#weeklyDatePicker").datepicker({defaultDate: ''});
			return true;
		}
		
		focusFunction();
		//$('#weeklyDatePicker').val('03-16-2019 - 03-29-2019');
	});

	
	function focusFunction() {
	    var value = $("#weeklyDatePicker").val().split(" - ");
	    value = value[0];
		var checkDateDay = new Date(value).getDay();
		var nValue =  new Date(value).getTime();
		
		var dt1 = new Date(storeLastaturdayDate);
		var	dt2 = new Date(value);
		var daysStore = ((dt2- dt1) / (1000 * 60 * 60 * 24));
	    var totalDays = Math.round(daysStore);
		var WeekNo =  parseInt((daysStore)/7) + 1;
		var newDate = "<?= date("m-d-Y", strtotime($lastSatFormat)) ?>";
		if(WeekNo%2 == 0) {
			var weeksdays = totalDays;
			if(checkDateDay != 6) { 
				console.log(weeksdays+"===+7"+checkDateDay+"==+1");
				weeksdays = weeksdays - (checkDateDay + 8);
			} else if(checkDateDay == 6){
				weeksdays = weeksdays - 7;
			}
			//weeksdays = weeksdays - 1;
			var weekTwo = weeksdays + 13;
		} else {
			console.log("odd");
			//var week1 = WeekNo;
			var weeksdays = totalDays;
			
			if(checkDateDay != 6) { 
				console.log(weeksdays+"=="+checkDateDay+"==+1");
				weeksdays = weeksdays - (checkDateDay + 1);
			}
			console.log(weeksdays+"weeksdays__bf");
			
			var weekTwo = weeksdays + 13;
		}
		
		var firstDates = new Date(newDate);
		firstDates.setDate(firstDates.getDate() + weeksdays);
		var fm =  firstDates.getMonth() +1;
		var fd =  firstDates.getDate();
		var firstDate = fm + "-" + fd + "-" + firstDates.getFullYear();
		var lastDates = new Date(newDate);
		lastDates.setDate(lastDates.getDate() + weekTwo);
		var lm =  lastDates.getMonth() +1;
		var ld =  lastDates.getDate();
		var lastDate=lm + "-" + ld + "-" + lastDates.getFullYear();
		$("#weeklyDatePicker").val(firstDate + " - " + lastDate);
		//$('#weeklyDatePicker').datetimepicker('setDate', firstDate + " - " + lastDate);
	}


    $('#weeklyDatePicker').on('dp.change', function (e) {
		
		var value = $("#weeklyDatePicker").val();	
		if(value == ''){
			// $("#weeklyDatePicker").val('5-23-2020 - 6-5-2020');
			$("#weeklyDatePicker").datepicker({defaultDate: ''});
			return true;

		}
		var checkDateDay = new Date(value).getDay();
		var nValue =  new Date(value).getTime();
		// console.log(nValue);
		/*if(checkDateDay != 6){ 
			  nValue = getLastWeekday(value, checkDateDay);
			  nValue =  nValue.getTime();
		} */
		// console.log(nValue);
		
		var dt1 = new Date(storeLastaturdayDate);
		var	dt2 = new Date(value);
		var daysStore = ((dt2- dt1) / (1000 * 60 * 60 * 24));
	    var totalDays = Math.round(daysStore);
		var WeekNo =  parseInt((daysStore)/7) + 1;
		
		console.log(daysStore+"=="+WeekNo+"weekno");
		//var WeekNo = date_diff_indays(storeLastaturdayDate,value);
		//console.log(totalDays);
		var newDate = "<?= date("m-d-Y", strtotime($lastSatFormat)) ?>";
		
		// if(checkDateDay == 6){ 
			// WeekNo = WeekNo +1;
		// }
		console.log(totalDays+"totalDays");
		if(WeekNo%2 == 0) {
			console.log("even");
			//var week1 = WeekNo - 1;
			var weeksdays = totalDays;
			if(checkDateDay != 6) { 
				console.log(weeksdays+"===+7"+checkDateDay+"==+1");
				weeksdays = weeksdays - (checkDateDay + 8);
			} else if(checkDateDay == 6){
				weeksdays = weeksdays - 7;
			}
			//weeksdays = weeksdays - 1;
			var weekTwo = weeksdays + 13;
		} else {
			console.log("odd");
			//var week1 = WeekNo;
			var weeksdays = totalDays;
			
			if(checkDateDay != 6) { 
				console.log(weeksdays+"=="+checkDateDay+"==+1");
				weeksdays = weeksdays - (checkDateDay + 1);
			}
			console.log(weeksdays+"weeksdays__bf");
			// if(checkDateDay != 6)
				// weeksdays = weeksdays - 1;
			var weekTwo = weeksdays + 13;
		}
		
		
		/*if(WeekNo%2 == 0) {
			var week1 = WeekNo - 1;
			var weeksdays = week1*7;
			//weeksdays = weeksdays - 1;
			var weekTwo = weeksdays + 13;
		} else {
			var week1 = WeekNo;
			var weeksdays = week1*7;
			console.log(weeksdays+"weeksdays__bf");
			// if(checkDateDay != 6)
				// weeksdays = weeksdays - 1;
			
			 var weekTwo = weeksdays + 13;
		} */

		console.log(weeksdays+"weeksdays_en");
		console.log(weekTwo+"weekTwo");
		console.log(newDate);
		/* if(weeksdays >0)
			var firstDate = moment(newDate, "MM-DD-YYYY").day(weeksdays).format("MM-DD-YYYY");	
		else 
			var firstDate = newDate; */
		
		var firstDates = new Date(newDate);
		
		console.log(firstDates);
		
		firstDates.setDate(firstDates.getDate() + weeksdays);
		console.log(firstDates);
		var fm =  firstDates.getMonth() +1;
		var fd =  firstDates.getDate();
		var firstDate = fm + "-" + fd + "-" + firstDates.getFullYear();
		
		
		var lastDates = new Date(newDate);
		lastDates.setDate(lastDates.getDate() + weekTwo);
		var lm =  lastDates.getMonth() +1;
		var ld =  lastDates.getDate();
		
		var lastDate=lm + "-" + ld + "-" + lastDates.getFullYear();

		//var lastDate =  moment(newDate, "MM-DD-YYYY").day(weekTwo).format("MM-DD-YYYY");	
		
		console.log(firstDate+"firstDate");
		console.log(lastDate+"lastDate");
		/*firstDate = moment(firstDate, "MM-DD-YYYY").day(-1).format("MM-DD-YYYY");	
		var fullDate = new Date(firstDate);		
		fullDate.setDate(fullDate.getDate()+14); 
		var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
		 var currentDate = twoDigitMonth + "-" + fullDate.getDate() + "-" + fullDate.getFullYear();
		
		console.log(currentDate+"currdate");
		var lastDate =  moment(firstDate, "MM-DD-YYYY").day(+13).format("MM-DD-YYYY");	
		console.log(lastDate+"lastdate"); */
		
		/*var fullDate = new Date();		  
		var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
		var currentDate = twoDigitMonth + "-" + fullDate.getDate() + "-" + fullDate.getFullYear();
		if(value == ''){
			var value = currentDate;
		}	 	  
		var firstDate = moment(value, "MM-DD-YYYY").day(-1).format("MM-DD-YYYY");	
		var lastDate =  moment(value, "MM-DD-YYYY").day(12).format("MM-DD-YYYY");*/
		$("#weeklyDatePicker").val(firstDate + " - " + lastDate);
   });
   
   
   function getLastWeekday( date , weekday ) { // 0 = sunday, 1 = monday, ... , 6 = saturday
   
        var fullDate = new Date(date);
		//	d.setDate( d.getDate() + weekday - d.getDay() ); // move to last of given weekday
		fullDate.setDate( fullDate.getDate() - weekday -1); 
		
		console.log(fullDate);
	//	var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
//var currentDate = twoDigitMonth + "-" + fullDate.getDate() + "-" + fullDate.getFullYear();
		return fullDate;

}
   
   function dateData(){
	   var value = $("#weeklyDatePicker").val();	
		var datesData = value.split(" - ");
		var firstDate = datesData[0];
		$.ajax({
			type:       "POST",
			dataType:   "text",
			url:        "{{ url('/') }}/weekNumber",
			data: {firstDate: firstDate},
			success: function(data)
			{
				
				var value = data.split("|");			
				$('#weekStoreOne').text("WEEK #"+value[0]);
				$('#weekStoreTwo').text("WEEK #"+value[1]);
				$('.dataSave').attr( 'weekNo',value[0]);
				$('.dataSave').attr( 'weekNoTwo',value[1]);
			}
		});
   }
/* date calculations ends */   
   
/* dataSave starts */
$('.dataSave').blur(function() {
		var weekNumber = '';		
		var empname = ($(this).attr('empname'));
		var catname = ($(this).attr('catname')); // regular
		var depname = ($(this).attr('depName_original')); // tagging
		var weekNumberOne = ($(this).attr('weekNo'));
		var weekNumberTwo = ($(this).attr('weekNoTwo'));		
		var keyValue = ($(this).attr('keyupValue'));
		var payratemultiplier = ($(this).attr('payratemultiplier'));
		var payrate = ($(this).attr('payrate'));
		var val = $(this).val();		
		if(catname == "Regular")
			payratemultiplier = 1;
		
		/* if(val == ''){
			val = '0.00';
		} else {
		    val =  parseFloat(payratemultiplier) * parseFloat(payrate) * parseFloat(val);
		} */
		
		if(keyValue == 'one'){
			weekNumber = weekNumberOne;
		}
		if(keyValue == 'two'){
			weekNumber = weekNumberTwo;
		}
		//$(this).val(val);
		$.ajax({
				type:       "POST",
				dataType:   "text",
				url:        "{{ url('/') }}/dataSave",
				data: {empname: empname,catname:catname,depname:depname,weekNumber:weekNumber,val:val,weekNumberOne:weekNumberOne,weekNumberTwo:weekNumberTwo},
				success: function(data)
				{	
				}
			});	
});		
/* data save ends */  
/* onchange row wise sum */ 
function sumData(name,i,userid,pay_rate_multiplier,payrate,dep){
	var sumweek = 0;
	var className = 'weekOne'+i+'_user'+userid+'_'+dep;
	$('.'+className).each(function() {	
		var catname = ($(this).attr('catname'));
		var payratemultiplier = $(this).attr("payratemultiplier");
		var payrate = $(this).attr("payrate");
		if($(this).val() != ''){
		var catval = $(this).val().replace('$ ','');
		var catval = catval.replace(',','');
		}else{
			var catval = 0;
		}
		if(catname == "Regular"){
			payratemultiplier = 1;
		}
		if(catname == "Salary"){
			payratemultiplier = 1;
			payrate = 1;
		}
		var weekValueTotalrow =  parseFloat(payratemultiplier) * parseFloat(payrate) * parseFloat(catval);
		//console.log(weekValueTotalrow);
		//var weekValueTotalrow =  parseFloat(catval);
		sumweek += +weekValueTotalrow;
	});	
	$("."+className+'_main').val('$'+addCommas(sumweek.toFixed(2)));
	sumRowTotal(i,userid,dep,payrate,pay_rate_multiplier);
	sumRowGrandTotal(i,userid,dep);
	sumColumnTotal();
	sumColumnGrandTotal();
	calTotalSum();
	calTotalSumWeekTotal();
}
function sumDataTwo(name,i,userid,pay_rate_multiplier,payrate,dep){
	var sumweek2 = 0;
	var className = 'weekTwo'+i+'_user'+userid+'_'+dep;
	$('.'+className).each(function() {		
		var catname = ($(this).attr('catname'));
		var payratemultiplier = $(this).attr("payratemultiplier");
		var payrate = $(this).attr("payrate");
		if($(this).val() != ''){
		var catval = $(this).val().replace('$ ','');
		var catval = catval.replace(',','');
		}else{
			var catval = 0;
		}
		if(catname == "Regular"){
			payratemultiplier = 1;
		}
		if(catname == "Salary"){
			payratemultiplier = 1;
			payrate = 1;
		}
		var weekValueTotalrowSecond =  parseFloat(payratemultiplier) * parseFloat(payrate) * parseFloat(catval);
		//var weekValueTotalrowSecond =  parseFloat(catval);
		sumweek2 += +weekValueTotalrowSecond;
	});	
	$("."+className+'_mainTwo').val('$'+addCommas(sumweek2.toFixed(2)));
	sumRowTotal(i,userid,dep,payrate,pay_rate_multiplier);
	sumRowGrandTotal(i,userid,dep);
	sumColumnTotal();
	sumColumnGrandTotal();
	calTotalSum();
	calTotalSumWeekTotal();
}
/* onchange row wise sum ends */ 
/* onchange row wise total sum*/ 
function sumRowTotal(i,userid,dep,payrate,payratemultiplier){
	var arr = ['One', 'Two'];		
	<?php foreach($payrollCategory as $pC){ ?>
	var totalSum = 0;
	$.each(arr, function( index, value ) {
		var cl = 'week'+value+'-<?php echo $pC->name; ?>.week'+value+i+'_user'+userid+'_'+dep;
		var fval = $('.'+cl).val().replace('$ ','');
		var fval = fval.replace(',','');
		//console.log(cl);
		if(fval != ''){ fval = fval} else { fval == 0}
		<?php if($pC->name == 'Regular'){?>
			var fval = fval*payrate;
		<?php } elseif($pC->name == 'Salary'){?>
			var fval = fval;
		<?php } else { ?>
			var fval = fval*payrate*payratemultiplier;
		<?php } ?>
		totalSum += +fval;			
	});
	var putClass = '<?php echo $pC->name; ?>_'+i+'_user'+userid+'_'+dep+'_total';
	
	$('.'+putClass).text("$"+addCommas(totalSum.toFixed(2)));
	<?php } ?>
}
/* onchange row wise total sum ends */
/* onchange row wise grand total sum*/ 
function sumRowGrandTotal(i,userid,dep){
	var totalSumRowGrand = 0;	
	<?php foreach($payrollCategory as $pC){ ?>
	var putClass = '<?php echo $pC->name; ?>_'+i+'_user'+userid+'_'+dep+'_total';
	var grandrowtotal = $('.'+putClass).text().replace('$','');
	var grandrowtotal = grandrowtotal.replace(',','');
	if(grandrowtotal != ''){ grandrowtotal = grandrowtotal} else { grandrowtotal == 0}
	totalSumRowGrand += +grandrowtotal;
	<?php } ?>
	var setClass = 'user'+userid+'_'+dep+'_grandtotal_'+i;
	$('.'+setClass).text("$"+addCommas(totalSumRowGrand.toFixed(2)));
}
/* onchange row wise grand total ends */
/* onchange column wise total sum*/ 
function sumColumnTotal(){
	<?php foreach($payrollCategory as $pC){ ?>
	var totalColumnSum = 0;
	var columcls = '<?php echo $pC->name; ?>_total';	
	$('.'+columcls).each(function( index, value ) {
		var cls = $(this).text().replace('$','');
		var cls = cls.replace(',','');
		if(cls != ''){ cls = cls} else { cls == 0}
		totalColumnSum += +cls;			
	});
	var colId = 'Final<?php echo $pC->name; ?>';
	$('#'+colId).text("$"+addCommas(totalColumnSum.toFixed(2)));
	<?php } ?>
}
/* onchange column wise total ends */
/* onchange column wise grand total sum*/ 
function sumColumnGrandTotal(){
	var totalColumnGrandSum = 0;
	$('.grandtotalall').each(function( index, value ) {		
		var clsgrand = $(this).text().replace('$','');
		var clsgrand = clsgrand.replace(',','');
		if(clsgrand != ''){ clsgrand = clsgrand} else { clsgrand == 0}
		totalColumnGrandSum += +clsgrand;			
	});
	$('#FinalOverallTotal').text("$"+addCommas(totalColumnGrandSum.toFixed(2)));
}
/* onchange column wise grand total ends */
/* category wise total */
calTotalSum();
function calTotalSum() {
<?php foreach($payrollCategory as $pC){ ?>
	var sum = 0;
	var sum2 = 0;	
	$(".weekOne-<?php echo $pC->name; ?>").each(function() {  
	
		var payratemultiplier = $(this).attr("payratemultiplier");
		var payrate = $(this).attr("payrate");
		var wOnevalue = this.value.replace('$','');
		<?php if($pC->name == 'Regular'){?>
			var wOnevalue = wOnevalue*payrate;
		<?php } elseif($pC->name == 'Salary'){?>
			var wOnevalue = wOnevalue;
		<?php } else { ?>
			var wOnevalue = wOnevalue*payrate*payratemultiplier;
		<?php } ?>
	
		sum += +wOnevalue;		
	});				
	
	<?php if($pC->name == 'Salary'){?>	
	$('#weekOne<?php echo $pC->name; ?>').html("$"+addCommas(sum.toFixed(2)));
	<?php } else {?>
	$('#weekOne<?php echo $pC->name; ?>').html(addCommas(sum.toFixed(2)));
	<?php } ?>
	
	

	$(".weekTwo-<?php echo $pC->name; ?>").each(function() {      
		var wTwovalue = this.value.replace('$','');
		var payratemultiplier = $(this).attr("payratemultiplier");
		var payrate = $(this).attr("payrate");
		
		<?php if($pC->name == 'Regular'){?>
			var wTwovalue = wTwovalue*payrate;
		<?php } elseif($pC->name == 'Salary'){?>
			var wTwovalue = wTwovalue;
		<?php } else { ?>
			var wTwovalue = wTwovalue*payrate*payratemultiplier;
		<?php } ?>
		
		sum2 += +wTwovalue;
	});				
	<?php if($pC->name == 'Salary'){?>
	$('#weekTwo<?php echo $pC->name; ?>').html("$"+addCommas(sum2.toFixed(2)));
	<?php } else {?>
	$('#weekTwo<?php echo $pC->name; ?>').html(addCommas(sum2.toFixed(2)));
	<?php } ?>
	
<?php } ?>	

}
/* category wise total ends */
/* week totals */
calTotalSumWeekTotal();
function calTotalSumWeekTotal() {
	var sum = sum2 = 0;	
	$(".weekOne-total").each(function() {
		var value = this.value;		
		var valueSum = value.replace("$", "");
		var valueSum = valueSum.replace(",", "");
		sum += +valueSum;
	});		
	$('#weekOneTotal').html("$"+addCommas(sum.toFixed(2)));
	
	$(".weekTwo-total").each(function() { 
		var value2 = this.value;	
		var valueSum2 = value2.replace("$", "");
		var valueSum2 = valueSum2.replace(",", "");		
		sum2 += +valueSum2;
	});
	$('#weekTwoTotal').html("$"+addCommas(sum2.toFixed(2)));
}	
/* week totals ends */

/* Add new Employee */
function addNewEmployee(dep,weekOne,weekTwo){
		$('#modalDepData').modal('show');
		$('#depName').val(dep);
		$('#weekOneData').val(weekOne);
		$('#weekTwoData').val(weekTwo);		
	}
	$("#submitDep").click(function()
	{		
		var inputname = $("#name").val();
		if(inputname == ''){
               alert("Please insert name.")
        }
		var inputrate = $("#rate").val();
		if(inputrate == ''){
               alert("Please insert rate.")
        }
		var inputsalary = $("#salary").val();
		if(inputsalary == ''){
               alert("Please insert salary.")
        }
		var inputworkinghour = $("#workinghour").val();
		if(inputworkinghour == ''){
               alert("Please insert working hour.")
        }
		var department = $('#depName').val();
		var weekOneNo = $('#weekOneData').val();
		var weekTwoNo = $('#weekTwoData').val();
		
						$.ajax({
							type:       "POST",
							dataType:   "text",
							url:        "{{ url('/') }}/newFieldSave",
							data: {inputname: inputname,inputrate:inputrate,inputsalary:inputsalary,inputworkinghour:inputworkinghour,department:department,weekOneNo:weekOneNo,weekTwoNo:weekTwoNo},
							success: function(data)
							{	
									 var value = data;
									if(value == 'complete'){
										setTimeout(function(){
											location.reload(); 
											});
									} 
							}
						});
	});
<!-- Add new Employee Ends >
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
<!-- Remove Employee Starts >	
function removeEmployeeChange(emp_id,catName){	
	$.ajax({
		type:       "POST",
		dataType:   "text",
		url:        "{{ url('/') }}/hideEmployee",
		data: {emp_id: emp_id,catName:catName},
		success: function(data)
		{	
			var val = $.trim(data);
			if(val == 1){
				setTimeout(function(){
					window.location = window.location
					});
			} 				
		}		
	});
}


function removeSelectedDepartment(id){  
   $.ajax({
      type:       "POST",
      dataType:   "text",
      url:        "{{ url('/') }}/removeSelectedDepartment", // hideEmployee
      data: {id: id},
      success: function(data)
      {  
         var val = $.trim(data); 
         if(val == 1){
            setTimeout(function(){
               window.location = window.location
               });
         }           
      }     
   });
}
<!-- Remove Employee Ends >
</script>
<script>
<?php 
$i = 0;						
	foreach($dataEmp as $pkey => $pD) {	
		$i++;							
			foreach ($pD as $empD){
				foreach($payrollCategory as $pC){ 
?> 
				sumData('<?= $pkey.'-'.$empD[4].'-'.'weekOne'; ?>','<?= $i; ?>','<?= $empD[4];?>','<?= $pC->pay_rate_multiplier; ?>','<?= $empD[1]; ?>','<?= str_replace(' ','',str_replace('/','_',trim($pkey)));?>');
				sumDataTwo('<?= $pkey.'-'.$empD[4].'-'.'weekTwo'; ?>','<?= $i; ?>','<?= $empD[4];?>','<?= $pC->pay_rate_multiplier; ?>','<?= $empD[1]; ?>','<?= str_replace(' ','',str_replace('/','_',trim($pkey)));?>');
<?php 
				} 
			}
	}
?>
</script>	
@endsection