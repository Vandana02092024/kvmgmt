@extends('layouts.layout')

@section('content')
<?php


function getDatesFromRange($start, $end, $format = 'Y-m-d') {
    $array = array();
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach($period as $date) {
        $array[] = $date->format($format);
    }

    return $array;
}

$dataList = array();
if (is_array($weekData) || is_object($weekData)){
foreach($weekData as $k){
	$k = (array) $k;
	$dataList[$k['name'].'-'.$k['dataDate'].'-'.$k['nameDep']] = $k;
}}

$dataListDiscount = array();
if (is_array($disData) || is_object($disData)){
foreach($disData as $k){
	$k = (array) $k;
	$dataListDiscount[$k['name'].'-'.$k['dataDate'].'-'.$k['nameDep']] = $k;
}
}

$dataListAdjust = array();
if (is_array($adjustData) || is_object($adjustData)){
foreach($adjustData as $k){

	$k = (array) $k;
	$dataListAdjust[$k['name'].'-'.$k['dataDate'].'-'.$k['nameDep']] = $k;
}
}



$dataListRec = array();
if (is_array($recData) || is_object($recData)){
foreach($recData as $k){
	$k = (array) $k;
	$dataListRec[$k['name'].'-'.$k['dataDate'].'-'.$k['nameDep']] = $k;

}
}
$dates = getDatesFromRange($sDate, $eDate);
?>
<link rel="stylesheet" type="text/css" href="http://actiknowdemo.com/timesheet-view/plugins/datepicker/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

<script type="text/javascript" src="http://actiknowdemo.com/timesheet-view/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="http://actiknowdemo.com/timesheet-view/plugins/datepicker/moment.min.js"></script>
<script type="text/javascript" src="http://actiknowdemo.com/timesheet-view/plugins/datepicker/bootstrap-datetimepicker.min.js"></script>
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">



		@if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
	<section id="dashboard-page" class="wrap">
		<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading inline" style="margin-bottom:0">
					<h3 class="heading">COAM ENTERPRISES LLC - Weekly Sales Report</h3>
				</div>
				<form class="pull-right inline"  method="POST" action="{{ url('/salesection	') }}">
                	{{ csrf_field() }}
				<ul class="pull-right inline quick-info">

					<li>Calendar week</li>
					<li><span id="weekNoData"></span></li>
					<li>Store week</li>
					<li><span id="storeNoData"></span></li>
					<li>
						<div class="input-group" id="DateDemo">
							<input type="text" class="form-control" id='weeklyDatePicker' name="datepick" placeholder="Select Week" />
						</div>
					</li>
					<input class="v-btn v-btn-warning" type="submit" name="submit" id="weekDatapick" value="Filter">
				</form>
				<a class="v-btn v-btn-primary pull-right" href="{{ url('/salesection') }}">BACK</a>
				</ul>

			</div>
		</div>
		<input type="hidden" id="startDate" value="{{ $startDatestore }}">

   <!-- <div class="filter-container">
      <div class="row">
         <div class="col-md-2">
            <label>Calendar Week</label>
            <span style="color: #f6c622;margin-left: 5px;font-weight: bold;">1234</span>
         </div>
         <div class="col-md-2">
            <label>Store Week</label>
            <span style="color: #f6c622;margin-left: 5px;font-weight: bold;">1234</span>
         </div>
         <div class="col-md-8 text-right">
            <label >Day/Date</label>
            <select class="day-filter">
               <option>Sat &nbsp; &nbsp;23-05-2015</option>
               <option>Sun &nbsp; &nbsp;23-05-2015</option>
               <option>Mon&nbsp; &nbsp;23-05-2015</option>
            </select>
         </div>
      </div>
   </div> -->

   <div class="row">
      <div class="col-sm-12">
         <div class="widget form-layout  summary-bx">
            <div class="widget-content padding" style="padding:0;">
               <div class="row">
                  <div class=	"col-md-3">
                     <table class="table  custom-table">
                        <thead>
                           <tr>
                              <th>SALES</th>
                              <th>UNIT</th>
                              <th>AMOUNT</th>
                           </tr>
                        </thead>
                        <tbody>
				         		<?php foreach($saleSum as $key=>$val){
						             	?>
                           <tr>
                              <td><?php echo $val->name; ?></td>
                              <td><?php echo $val->unit; ?></td>
                              <td >
                                <input type="hidden" class="saleSum" value="<?php echo $val->amount; ?>">
                                <?php echo "$".$val->amount; ?>
                              </td>
                           </tr>
					               	<?php } ?>

                        </tbody>
                        <tfoot>
                           <tr>
                              <th>Total</th>
                              <th></th>
                              <th id="saletotal"></th>
                           </tr>
                        </tfoot>
                     </table>
                  </div>
                  <div class="col-md-3">
                     <table class="table custom-table">
                        <thead>
                           <tr>
                              <th>Discount & Credit</th>
                              <td></td>
                           </tr>
                        </thead>
                        <tbody>
						   <?php foreach($disSum as $key=>$val){
							?>
                           <tr>
                              <td><?php echo $val->name; ?></td>
                              <td ><input type="hidden" class="disSum" value="<?php echo $val->amount; ?>"><?php echo "$".$val->amount; ?></td>
                           </tr>
							<?php } ?>
                           <tr>
                              <th>Total</th>
                              <th class="text-red" id="distotal"></th>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="col-md-3">
                     <table class="table custom-table">
                        <thead>
                           <tr>
                              <th>ADJUSTMENTS</th>
                              <td></td>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach($adjSum as $key=>$val){
							?>
                           <tr>
                              <td><?php echo $val->name; ?></td>
                              <td ><input type="hidden" class="adjSum" value="<?php echo $val->amount; ?>"><?php echo "$".$val->amount; ?></td>
                           </tr>
							<?php } ?>
                           <tr>
                              <th>Total</th>
                              <th id="adjtotal"></th>
                           </tr>
                           <tr>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                           </tr>
                           <tr>
                              <th>Over/(Short) </th>
                              <th id="finalovertotal"></th>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="col-md-3">
                     <table class="table custom-table">
                        <thead>
                           <tr>
                              <th>RECEIPTS</th>
                              <td></td>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach($recSum as $key=>$val){	?>
                           <tr>
                              <td><?php echo $val->name; ?></td>
                              <td ><input type="hidden" class="recSum" value="<?php echo $val->amount; ?>"><?php echo "$".$val->amount; ?></td>
                           </tr>
							                  <?php } ?>
                           <tr>
                              <th>Total</th>
                              <th id="rectotal"></th>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
  <!--  <div class="filter-container">
      <div class="row">
         <div class="col-md-2">
            <label>Sales</label>
         </div>
      </div>
   </div> -->

   <div class="row">
      <div class="col-md-12">
         <div class="widget form-layout" style="margin-bottom:10px;">
            <div class="widget-content" style="padding: 0;">
               <div class="row">
                  <div class="col-md-12">
                     <table class="table custom-table" nowrap>
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
                              <th>Date</th>
                              <th colspan="2" id="day1" class="text-center"><?php echo  date('l m-d-y',strtotime($dates[0])); ?></th>
							  <th colspan="2" id="day2" class="text-center"><?php echo date('l m-d-y',strtotime($dates[1])); ?></th>
							  <th colspan="2" id="day3" class="text-center"><?php echo date('l m-d-y',strtotime($dates[2]));; ?></th>
							  <th colspan="2" id="day4" class="text-center"><?php echo date('l m-d-y',strtotime($dates[3]));; ?></th>
							  <th colspan="2" id="day5" class="text-center"><?php echo date('l m-d-y',strtotime($dates[4]));; ?></th>
							  <th colspan="2" id="day6" class="text-center"><?php echo date('l m-d-y',strtotime($dates[5]));; ?></th>
							  <th colspan="2" id="day7" class="text-center"><?php echo date('l m-d-y',strtotime($dates[6]));; ?></th>


                           </tr>
                           <tr>
                              <th>SALES</th>
                              <th class="text-center">Units</th>
                              <th class="text-center">Amount</th>
                              <th class="text-center">Units</th>
                              <th class="text-center">Amount</th>
                              <th class="text-center">Units</th>
                              <th class="text-center">Amount</th>
                              <th class="text-center">Units</th>
                              <th class="text-center">Amount</th>
                              <th class="text-center">Units</th>
                              <th class="text-center">Amount</th>
                              <th class="text-center">Units</th>
                              <th class="text-center">Amount</th>
							  <th class="text-center">Units</th>
                              <th class="text-center">Amount</th>
                           </tr>
                        </thead>
                        <tbody>

							@foreach($saleData as $saleD => $sd)
                           <tr>
							<th>{{ $sd->name }}</th>
								<?php
                        $match = $sd->name.'-'.$dates[0].'-'.'sale';$unit = (empty($dataList[$match]['unit'])?'':$dataList[$match]['unit']);$amount = (empty($dataList[$match]['amount'])?'':$dataList[$match]['amount']);?>
							   <td><input type="text" class="sale saturdaydate sumunit sumunitmon form-control " nameId= "sale_{{ $sd->id }}" unit="units" dateat = "" dayno ="day1" name="{{ $sd->name }}"  value="<?php  echo $unit ?>"></td>
							   <td><input type="text" class="sale saturdaydate sumamt sumamtmon form-control" nameId= "sale_{{ $sd->id }}" unit="amt" dayno ="day1" dateat = "" name="{{ $sd->name }}" value="<?php  echo $amount ?>"></td>

							   <?php $match = $sd->name.'-'.$dates[1].'-'.'sale';$unitsun = (empty($dataList[$match]['unit'])?'':$dataList[$match]['unit']);$amountsun = (empty($dataList[$match]['amount'])?'':$dataList[$match]['amount']);?>
							   <td><input type="text" class="sale sundaydate sumunit sumunittue form-control" nameId= "sale_{{ $sd->id }}" unit="units" dayno ="day2" dateat = "" name="{{ $sd->name }}"  value="<?php  echo $unitsun ?>"></td>
							   <td><input type="text" class="sale sundaydate sumamt sumamttue form-control" nameId= "sale_{{ $sd->id }}" unit="amt" dayno ="day2" dateat = "" name="{{ $sd->name }}" value="<?php  echo $amountsun ?>"></td>

							   <?php $match = $sd->name.'-'.$dates[2].'-'.'sale';$unitmon = (empty($dataList[$match]['unit'])?'':$dataList[$match]['unit']);$amountmon = (empty($dataList[$match]['amount'])?'':$dataList[$match]['amount']);?>
							   <td><input type="text" class="sale mondaydate sumunit sumunitwed form-control" nameId= "sale_{{ $sd->id }}" unit="units" dayno ="day3" dateat = "" name="{{ $sd->name }}"  value="<?php  echo $unitmon ?>"></td>
							   <td><input type="text" class="sale mondaydate sumamt sumamtwed form-control" nameId= "sale_{{ $sd->id }}" unit="amt" dayno ="day3" dateat = "" name="{{ $sd->name }}" value="<?php  echo $amountmon ?>"></td>

							   <?php $match = $sd->name.'-'.$dates[3].'-'.'sale';$unittue = (empty($dataList[$match]['unit'])?'':$dataList[$match]['unit']);$amounttue = (empty($dataList[$match]['amount'])?'':$dataList[$match]['amount']);?>
							   <td><input type="text" class="sale tuesdaydate sumunit sumunitthr form-control" nameId= "sale_{{ $sd->id }}" unit="units" dayno ="day4" dateat = "" name="{{ $sd->name }}"  value="<?php  echo $unittue ?>"></td>
							   <td><input type="text" class="sale tuesdaydate sumamt sumamtthr form-control" nameId= "sale_{{ $sd->id }}" unit="amt" dayno ="day4" dateat = "" name="{{ $sd->name }}" value="<?php  echo $amounttue ?>"></td>

							   <?php $match = $sd->name.'-'.$dates[4].'-'.'sale';$unitwed = (empty($dataList[$match]['unit'])?'':$dataList[$match]['unit']);$amountwed = (empty($dataList[$match]['amount'])?'':$dataList[$match]['amount']);?>
							   <td><input type="text" class="sale wednesdaydate sumunit sumunitfri form-control" nameId= "sale_{{ $sd->id }}" unit="units" dayno ="day5" dateat = "" name="{{ $sd->name }}"  value="<?php echo $unitwed; ?>"></td>
							   <td><input type="text" class="sale wednesdaydate sumamt sumamtfri form-control" nameId= "sale_{{ $sd->id }}" unit="amt" dayno ="day5" dateat = "" name="{{ $sd->name }}" value="<?php echo $amountwed; ?>"></td>

							   <?php $match = $sd->name.'-'.$dates[5].'-'.'sale';$unitthr = (empty($dataList[$match]['unit'])?'':$dataList[$match]['unit']);$amountthr = (empty($dataList[$match]['amount'])?'':$dataList[$match]['amount']);?>
							   <td><input type="text" class="sale thrusdaydate sumunit sumunitsat form-control" nameId= "sale_{{ $sd->id }}" unit="units" dayno ="day6" dateat = "" name="{{ $sd->name }}"  value="<?php echo $unitthr ;?>"></td>
							   <td><input type="text" class="sale thrusdaydate sumamt sumamtsat form-control" nameId= "sale_{{ $sd->id }}" unit="amt" dayno ="day6" dateat = "" name="{{ $sd->name }}" value="<?php echo $amountthr; ?>"></td>

							   <?php $match = $sd->name.'-'.$dates[6].'-'.'sale';$unitsun = (empty($dataList[$match]['unit'])?'':$dataList[$match]['unit']);$amountsun = (empty($dataList[$match]['amount'])?'':$dataList[$match]['amount']);?>
							   <td><input type="text" class="sale fridaydate sumunit sumunitsun form-control" nameId= "sale_{{ $sd->id }}" unit="units" dayno ="day7" dateat = "" name="{{ $sd->name }}"  value="<?php echo $unitsun; ?>"></td>
							   <td><input type="text" class="sale fridaydate sumamt sumamtsun form-control" nameId= "sale_{{ $sd->id }}" unit="amt" dayno ="day7" dateat = "" name="{{ $sd->name }}" value="<?php echo $amountsun; ?>"></td>

                           </tr>
						   @endforeach

                           <tr>
                              <th>TOTAL</th>
                              <td><input type="text" readonly name="" id="sumunitmonday" class="sale form-control" placeholder="" ></td>
                              <td><input type="text" readonly name="" id="sumamtmonday" class="sale form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="sumunittuesday" class="sale form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="sumamttuesday" class="sale form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="sumunitwednesday" class="sale form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="sumamtwednesday" class="sale form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="sumunitthrusday" class="sale form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="sumamtthrusday" class="sale form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="sumunitfriday" class="sale form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="sumamtfriday" class="sale form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="sumunitsaturday" class="sale form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="sumamtsaturday" class="sale form-control" placeholder=""></td>
							  <td><input type="text" readonly name="" id="sumunitsunday" class="sale form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="sumamtsunday" class="sale form-control" placeholder=""></td>
                           </tr>
                           <tr class="thead-Light">
                              <th colspan="15">DISCOUNTS & CREDITS</th>
                           </tr>
                           @foreach($discountData as $dD => $dd)
                           <tr>
                              <th>{{ $dd->name }}</th>
							  <?php $match = $dd->name.'-'.$dates[0].'-'.'dis';$amount = (empty($dataListDiscount[$match]['amount'])?'':$dataListDiscount[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder="$45"></td>
                              <td><input type="text" class="sale saturdaydate disamt disamtmon form-control" unit="amt" nameId= "dis_{{ $dd->id }}"  dayno ="day1" dateat = "" name="{{ $dd->name }}" value="<?php echo $amount; ?>"></td>

							  <?php $match = $dd->name.'-'.$dates[1].'-'.'dis';$amountsun = (empty($dataListDiscount[$match]['amount'])?'':$dataListDiscount[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="sale sundaydate disamt disamttue form-control" unit="amt" nameId= "dis_{{ $dd->id }}"  dayno ="day2" dateat = "" name="{{ $dd->name }}" value="<?php echo $amountsun; ?>"></td>

							  <?php $match = $dd->name.'-'.$dates[2].'-'.'dis';$amountmon = (empty($dataListDiscount[$match]['amount'])?'':$dataListDiscount[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="sale mondaydate disamt disamtwed form-control" unit="amt" nameId= "dis_{{ $dd->id }}"  dayno ="day3" dateat = "" name="{{ $dd->name }}" value="<?php echo $amountmon; ?>"></td>

							  <?php $match = $dd->name.'-'.$dates[3].'-'.'dis';$amounttue = (empty($dataListDiscount[$match]['amount'])?'':$dataListDiscount[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="sale tuesdaydate disamt disamtthr form-control" unit="amt" nameId= "dis_{{ $dd->id }}"  dayno ="day4" dateat = "" name="{{ $dd->name }}" value="<?php echo $amounttue; ?>"></td>

							  <?php $match = $dd->name.'-'.$dates[4].'-'.'dis';$amountwed = (empty($dataListDiscount[$match]['amount'])?'':$dataListDiscount[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="sale wednesdaydate disamt disamtfri form-control" unit="amt" nameId= "dis_{{ $dd->id }}"  dayno ="day5" dateat = "" name="{{ $dd->name }}" value="<?php echo $amountwed; ?>"></td>

							  <?php $match = $dd->name.'-'.$dates[5].'-'.'dis';$amountthr = (empty($dataListDiscount[$match]['amount'])?'':$dataListDiscount[$match]['amount']);?>
							   <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                             <td><input type="text" class="sale thrusdaydate disamt disamtsat form-control" unit="amt" nameId= "dis_{{ $dd->id }}"  dayno ="day6" dateat = "" name="{{ $dd->name }}" value="<?php echo $amountthr; ?>"></td>

							 <?php $match = $dd->name.'-'.$dates[6].'-'.'dis';$amountfri = (empty($dataListDiscount[$match]['amount'])?'':$dataListDiscount[$match]['amount']);?>
							  <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="sale fridaydate disamt disamtsun form-control" unit="amt" nameId= "dis_{{ $dd->id }}"  dayno ="day7" dateat = "" name="{{ $dd->name }}" value="<?php echo $amountfri; ?>"></td>
                           </tr>
                          @endforeach
                           <tr>
                              <th >Total</th>
                              <td><input type="hidden" name="" class="form-control" placeholder="$45"></td>
                              <td><input type="text" readonly name="" id="disamtmonday" class="sale form-control" placeholder=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="disamttuesday" class="sale form-control" placeholder=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="disamtwednesday" class="sale form-control" placeholder=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="disamtthrusday" class="sale form-control" placeholder=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="disamtfriday" class="sale form-control" placeholder=""></td>
							  <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="disamtsaturday" class="sale form-control" placeholder=""></td>
							  <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="disamtsunday" class="sale form-control" placeholder=""></td>
                           </tr>
                           <tr class="thead-Light">
                              <th colspan="15">ADJUSTMENTS</th>
                           </tr>
                           @foreach($adjustmentData as $adjD => $adj)
                           <tr>
                              <th>{{ $adj->name }}</th>

							  <?php $match = $adj->name.'-'.$dates[0].'-'.'adj';$amountsat1 = (empty($dataListAdjust[$match]['amount'])?'':$dataListAdjust[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder="$45"></td>
                              <td><input type="text" class="sale saturdaydate adjamt adjamtmon form-control" unit="amt" nameId= "adj_{{ $adj->id }}" dayno ="day1" dateat = "" name="{{ $adj->name }}" value="<?php echo $amountsat1; ?>"></td>

							  <?php $match = $adj->name.'-'.$dates[1].'-'.'adj';$amountsun1 = (empty($dataListAdjust[$match]['amount'])?'':$dataListAdjust[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="sale sundaydate adjamt adjamttue form-control" unit="amt" nameId= "adj_{{ $adj->id }}" dayno ="day2" dateat = "" name="{{ $adj->name }}" value="<?php echo $amountsun1; ?>"></td>

							  <?php $match = $adj->name.'-'.$dates[2].'-'.'adj';$amountmon1 = (empty($dataListAdjust[$match]['amount'])?'':$dataListAdjust[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="sale mondaydate adjamt adjamtwed form-control" unit="amt" nameId= "adj_{{ $adj->id }}" dayno ="day3" dateat = "" name="{{ $adj->name }}" value="<?php echo $amountmon1; ?>"></td>

							  <?php $match = $adj->name.'-'.$dates[3].'-'.'adj';$amounttue1 = (empty($dataListAdjust[$match]['amount'])?'':$dataListAdjust[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="sale tuesdaydate adjamt adjamtthr form-control" unit="amt" nameId= "adj_{{ $adj->id }}" dayno ="day4" dateat = "" name="{{ $adj->name }}" value="<?php echo $amounttue1; ?>"></td>

							  <?php $match = $adj->name.'-'.$dates[4].'-'.'adj';$amountwed1 = (empty($dataListAdjust[$match]['amount'])?'':$dataListAdjust[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="sale wednesdaydate adjamt adjamtfri form-control" unit="amt" nameId= "adj_{{ $adj->id }}" dayno ="day5" dateat = "" name="{{ $adj->name }}" value="<?php echo $amountwed1; ?>"></td>

							  <?php $match = $adj->name.'-'.$dates[5].'-'.'adj';$amountthr1 = (empty($dataListAdjust[$match]['amount'])?'':$dataListAdjust[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
							  <td><input type="text" class="sale thrusdaydate adjamt adjamtsat form-control" unit="amt" nameId= "adj_{{ $adj->id }}" dayno ="day6" dateat = "" name="{{ $adj->name }}" value="<?php echo $amountthr1; ?>"></td>

							  <?php $match = $adj->name.'-'.$dates[6].'-'.'adj';$amountfri1 = (empty($dataListAdjust[$match]['amount'])?'':$dataListAdjust[$match]['amount']);?>
							  <td><input type="hidden" name="" class="form-control" placeholder=""></td>
							  <td><input type="text" class="sale fridaydate adjamt adjamtsun form-control" unit="amt" nameId= "adj_{{ $adj->id }}" dayno ="day7" dateat = "" name="{{ $adj->name }}" value="<?php echo $amountfri1; ?>"></td>
                           </tr>
						    @endforeach
                           <tr>
                              <th>Total</th>
                              <td><input type="hidden" name="" class="form-control" placeholder="$45"></td>
                              <td><input type="text" readonly name="" id="adjamtmonday" class="sale form-control" placeholder=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="adjamttuesday" class="sale form-control" placeholder=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="adjamtwednesday" class="sale form-control" placeholder=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="adjamtthrusday" class="sale form-control" placeholder=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="adjamtfriday" class="sale form-control" placeholder=""></td>
							  <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="adjamtsaturday" class="sale form-control" placeholder=""></td>
							  <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="adjamtsunday" class="sale form-control" placeholder=""></td>
                           </tr>
                           <tr class="thead-Light">
                              <th colspan="15">RECEIPTS</th>
                           </tr>
                           @foreach($receiptData as $recD => $rD)
                           <tr>
                              <th>{{ $rD->name }}</th>
							  <?php $match = $rD->name.'-'.$dates[0].'-'.'rec';$amount1 = (empty($dataListRec[$match]['amount'])?'':$dataListRec[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder="$45"></td>
                              <td><input type="text" class="sale saturdaydate recamt recamtmon form-control" unit="amt" nameId= "rec_{{ $rD->id }}" dayno ="day1" dateat = "" name="{{ $rD->name }}" value="<?php echo $amount1; ?>"></td>

							  <?php $match = $rD->name.'-'.$dates[1].'-'.'rec';$amount2 = (empty($dataListRec[$match]['amount'])?'':$dataListRec[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="sale sundaydate recamt recamttue form-control" unit="amt" nameId= "rec_{{ $rD->id }}" dayno ="day2" dateat = "" name="{{ $rD->name }}" value="<?php echo $amount2; ?>"></td>

							  <?php $match = $rD->name.'-'.$dates[2].'-'.'rec';$amount3 = (empty($dataListRec[$match]['amount'])?'':$dataListRec[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="sale mondaydate recamt recamtwed form-control" unit="amt" nameId= "rec_{{ $rD->id }}" dayno ="day3" dateat = "" name="{{ $rD->name }}" value="<?php echo $amount3; ?>"></td>

							  <?php $match = $rD->name.'-'.$dates[3].'-'.'rec';$amount4 = (empty($dataListRec[$match]['amount'])?'':$dataListRec[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="sale tuesdaydate recamt recamtthr form-control" unit="amt" nameId= "rec_{{ $rD->id }}" dayno ="day4" dateat = "" name="{{ $rD->name }}" value="<?php echo $amount4; ?>"></td>

							  <?php $match = $rD->name.'-'.$dates[4].'-'.'rec';$amount5 = (empty($dataListRec[$match]['amount'])?'':$dataListRec[$match]['amount']);?>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="sale wednesdaydate recamt recamtfri form-control" unit="amt" nameId= "rec_{{ $rD->id }}" dayno ="day5" dateat = "" name="{{ $rD->name }}" value="<?php echo $amount5; ?>"></td>

							  <?php $match = $rD->name.'-'.$dates[5].'-'.'rec';$amount6 = (empty($dataListRec[$match]['amount'])?'':$dataListRec[$match]['amount']);?>
							   <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="sale thrusdaydate recamt recamtsat form-control" unit="amt" nameId= "rec_{{ $rD->id }}" dayno ="day6" dateat = "" name="{{ $rD->name }}" value="<?php echo $amount6; ?>"></td>

							  <?php $match = $rD->name.'-'.$dates[6].'-'.'rec';$amount7 = (empty($dataListRec[$match]['amount'])?'':$dataListRec[$match]['amount']);?>
							  <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="sale fridaydate recamt recamtsun form-control" unit="amt" nameId= "rec_{{ $rD->id }}" dayno ="day7" dateat = "" name="{{ $rD->name }}" value="<?php echo $amount7; ?>"></td>
                           </tr>
						   @endforeach
                           <tr>
                              <th>Total</th>
                              <td><input type="hidden" name="" class="form-control" placeholder="$45"></td>
                              <td><input type="text" readonly name="" id="recamtmonday" class="sale form-control" placeholder=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="recamttuesday" class="sale form-control" placeholder=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="recamtwednesday" class="sale form-control" placeholder=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="recamtthrusday" class="sale form-control" placeholder=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="recamtfriday" class="sale form-control" placeholder=""></td>
							  <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="recamtsaturday" class="sale form-control" placeholder=""></td>
							  <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" readonly name="" id="recamtsunday" class="sale form-control" placeholder=""></td>
                           </tr>
                            <tr class="thead-Light">
                              <th colspan="15">OVER/(SHORT)</th>
                           </tr>
                           <tr>
                              <th>OVER/(SHORT)</th>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="form-control" name="saleD" id="oversaturday" value=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="form-control" name="saleD" id="oversunday" value=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="form-control" name="saleD" id="overmonday" value=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="form-control" name="saleD" id="overtuesday" value=""></td>
                              <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="form-control" name="saleD" id="overwednesday" value=""></td>
							  <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="form-control" name="saleD" id="overthrusday" value=""></td>
							  <td><input type="hidden" name="" class="form-control" placeholder=""></td>
                              <td><input type="text" class="form-control" name="saleD" id="overfriday" value=""></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
				<!--<div class="row">
			      <div class="col-md-12 text-center">
				    <button class="v-btn v-btn-primary" style="margin-bottom:20px;">ADD</button>
				  </div>

				</div>-->


	</div>
</section>

<style type="text/css">
   .quick-info>li{vertical-align: middle;}
   .quick-info>li>span{font-size: 20px; margin-right: 20px; font-weight:800}
   .custom-table .form-control{height: 20px; font-weight: normal; border-color: #eee; text-align: center; margin-bottom:0;}
   .custom-table{margin-bottom:0;}
   .custom-table>thead{    background-color: #382f2f;
    color: #ffffffc7;}
   .custom-table>thead>tr{border-bottom: 0;}

   .custom-table>tbody>tr>th,
   .custom-table>tbody>tr>td,
   .custom-table>thead>tr>th{    padding: 4px 10px!important; font-size: 10px; font-weight: bold; border-bottom:0; border-top: 0; }
   .custom-table>tbody>tr:nth-child(odd){}


    .custom-table>thead>tr>th{border-left:1px solid #ababab}

   .thead-Dark{background-color: #909090; color: #fff;}
   .thead-Light{background-color: #382f2f; color: #fff; }

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

    .summary-bx{margin-bottom:10px; border: 1px solid #ddd;
    padding: 10px;
    background-color: #d8d8d8;}

	.text-red{color:red}

	 .nowrap {
        white-space:nowrap;
    }

	.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
     background-color: #fff !important;
    opacity: 1;
}
</style>
<script type="text/javascript">
	$.ajaxSetup({
        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	});
</script>
<script type="text/javascript">
	$(window).on("load", function (e) {

		var stDate = "<?php echo $sDate; ?>";
		var calDate1 = "<?php echo date('m-d-Y',strtotime($sDate)); ?>";
		var calDate2 = "<?php echo date('m-d-Y',strtotime($eDate)); ?>";
		var calDate = calDate1 + ' - ' + calDate2;
		$("#weeklyDatePicker").val(calDate);
		$.ajax({
			type:       "POST",
			dataType:   "text",
			url:        "{{ url('/') }}/weekData",
			data: {stDate: stDate},
			success: function(data)
			{
				var value = data.split("|");
				$('#weekNoData').text(value[0]);
				$('#storeNoData').text(value[1]);
			}
		});

		var sumSale = 0;
		$(".saleSum").each(function(){
		sumSale += +$(this).val(); });
		$("#saletotal").text("$"+sumSale);

		var sumdis = 0;
		$(".disSum").each(function(){
		sumdis += +$(this).val(); });
		$("#distotal").text("$"+sumdis);

		var sumadj = 0;
		$(".adjSum").each(function(){
		sumadj += +$(this).val(); });
		$("#adjtotal").text("$"+sumadj);

		var sumrec = 0;
		$(".recSum").each(function(){
		sumrec += +$(this).val(); });
		$("#rectotal").text("$"+sumrec);

		$('.sumunit').trigger('keyup');
		$('.sumamt').trigger('keyup');
		$('.disamt').trigger('keyup');
		$('.adjamt').trigger('keyup');
		$('.recamt').trigger('keyup');


		/* sat over value start*/
		var sat = tax = 0;
		$(".saturdaydate").each(function(){
			if($(this).attr('name') == 'Sales Tax'){
			  var saletax = $(this).val();
			  tax += +$(this).val();
			}
			if($(this).attr('name') == 'Refund'){
				var refund = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Coupons'){
				var coupon = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Final Discounts'){
				var fdiscount = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Employee Advancee'){
				var empadv = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Employee Loan'){
				var emploan = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Paid Out'){
				var paidout = $(this).val();
				sat += +$(this).val();
			}
		});
		var recmt = $('#recamtmonday').val();
		var salemt = $('#sumamtmonday').val();
		var stax = tax;
		var otherpart = sat;
		var oversaturday = (parseInt(recmt) - (parseInt(salemt) +  parseInt(stax))) + parseInt(otherpart);
		//$('#oversaturday').val(oversaturday);
		if(oversaturday.toFixed(2) >= 0){
			$('#oversaturday').val(oversaturday.toFixed(2));
			}else{
			$('#oversaturday').val('('+(oversaturday*(-1)).toFixed(2)+')').css("color", "red");
		}
		/* sat over value end*/

		/* sun over value start*/
		var sat = tax = 0;
		$(".sundaydate").each(function(){
			if($(this).attr('name') == 'Sales Tax'){
			  var saletax = $(this).val();
			  tax += +$(this).val();
			}
			if($(this).attr('name') == 'Refund'){
				var refund = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Coupons'){
				var coupon = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Final Discounts'){
				var fdiscount = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Employee Advancee'){
				var empadv = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Employee Loan'){
				var emploan = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Paid Out'){
				var paidout = $(this).val();
				sat += +$(this).val();
			}
		});
		var recmt = $('#recamttuesday').val();

		var salemt = $('#sumamttuesday').val();
		var stax = tax;
		var otherpart = sat;
		var oversunday = (parseInt(recmt) - (parseInt(salemt) +  parseInt(stax))) + parseInt(otherpart);
		//$('#oversunday').val(oversunday);
		if(oversunday.toFixed(2) >= 0){
			$('#oversunday').val(oversunday.toFixed(2));
			}else{
			$('#oversunday').val('('+(oversunday*(-1)).toFixed(2)+')').css("color", "red");
		}
		/* sun over value end*/
		/* mon over value start*/
		var sat = tax = 0;
		$(".mondaydate").each(function(){
			if($(this).attr('name') == 'Sales Tax'){
			  var saletax = $(this).val();
			  tax += +$(this).val();
			}
			if($(this).attr('name') == 'Refund'){
				var refund = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Coupons'){
				var coupon = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Final Discounts'){
				var fdiscount = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Employee Advancee'){
				var empadv = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Employee Loan'){
				var emploan = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Paid Out'){
				var paidout = $(this).val();
				sat += +$(this).val();
			}
		});
		var recmt = $('#recamtwednesday').val();
		var salemt = $('#sumamtwednesday').val();
		var stax = tax;
		var otherpart = sat;
		var overmonday = (parseInt(recmt) - (parseInt(salemt) +  parseInt(stax))) + parseInt(otherpart);
		//$('#overmonday').val(overmonday);
		if(overmonday.toFixed(2) >= 0){
			$('#overmonday').val(overmonday.toFixed(2));
			}else{
			$('#overmonday').val('('+(overmonday*(-1)).toFixed(2)+')').css("color", "red");
		}

		/* mon over value end*/
		/* tue over value start*/
		var sat = tax = 0;
		$(".tuesdaydate").each(function(){
			if($(this).attr('name') == 'Sales Tax'){
			  var saletax = $(this).val();
			  tax += +$(this).val();
			}
			if($(this).attr('name') == 'Refund'){
				var refund = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Coupons'){
				var coupon = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Final Discounts'){
				var fdiscount = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Employee Advancee'){
				var empadv = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Employee Loan'){
				var emploan = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Paid Out'){
				var paidout = $(this).val();
				sat += +$(this).val();
			}
		});
		var recmt = $('#recamtthrusday').val();
		var salemt = $('#sumamtthrusday').val();
		var stax = tax;
		var otherpart = sat;
		var overtuesday = (parseInt(recmt) - (parseInt(salemt) +  parseInt(stax))) + parseInt(otherpart);
		//$('#overtuesday').val(overtuesday);
		if(overtuesday.toFixed(2) >= 0){
			$('#overtuesday').val(overtuesday.toFixed(2));
			}else{
			$('#overtuesday').val('('+(overtuesday*(-1)).toFixed(2)+')').css("color", "red");
		}
		/* tue over value end*/
		/* wed over value start*/
		var sat = tax = 0;
		$(".wednesdaydate").each(function(){
			if($(this).attr('name') == 'Sales Tax'){
			  var saletax = $(this).val();
			  tax += +$(this).val();
			}
			if($(this).attr('name') == 'Refund'){
				var refund = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Coupons'){
				var coupon = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Final Discounts'){
				var fdiscount = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Employee Advancee'){
				var empadv = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Employee Loan'){
				var emploan = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Paid Out'){
				var paidout = $(this).val();
				sat += +$(this).val();
			}
		});
		var recmt = $('#recamtfriday').val();
		var salemt = $('#sumamtfriday').val();
		var stax = tax;
		var otherpart = sat;
		var overwednesday = (parseInt(recmt) - (parseInt(salemt) +  parseInt(stax))) + parseInt(otherpart);
		//$('#overwednesday').val(overwednesday);
		if(overwednesday.toFixed(2) >= 0){
			$('#overwednesday').val(overwednesday.toFixed(2));
			}else{
			$('#overwednesday').val('('+(overwednesday*(-1)).toFixed(2)+')').css("color", "red");
		}
		/* wed over value end*/
		/* thr over value start*/
		var sat = tax = 0;
		$(".thrusdaydate").each(function(){
			if($(this).attr('name') == 'Sales Tax'){
			  var saletax = $(this).val();
			  tax += +$(this).val();
			}
			if($(this).attr('name') == 'Refund'){
				var refund = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Coupons'){
				var coupon = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Final Discounts'){
				var fdiscount = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Employee Advancee'){
				var empadv = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Employee Loan'){
				var emploan = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Paid Out'){
				var paidout = $(this).val();
				sat += +$(this).val();
			}
		});
		var recmt = $('#recamtsaturday').val();
		var salemt = $('#sumamtsaturday').val();
		var stax = tax;
		var otherpart = sat;
		var overthrusday = (parseInt(recmt) - (parseInt(salemt) +  parseInt(stax))) + parseInt(otherpart);
		//$('#overthrusday').val(overthrusday);
		if(overthrusday.toFixed(2) >= 0){
			$('#overthrusday').val(overthrusday.toFixed(2));
			}else{
			$('#overthrusday').val('('+(overthrusday*(-1)).toFixed(2)+')').css("color", "red");
		}
		/* thr over value end*/
		/* fri over value start*/
		var sat = tax = 0;
		$(".fridaydate").each(function(){
			if($(this).attr('name') == 'Sales Tax'){
			  var saletax = $(this).val();
			  tax += +$(this).val();
			}
			if($(this).attr('name') == 'Refund'){
				var refund = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Coupons'){
				var coupon = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Final Discounts'){
				var fdiscount = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Employee Advancee'){
				var empadv = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Employee Loan'){
				var emploan = $(this).val();
				sat += +$(this).val();
			}
			if($(this).attr('name') == 'Paid Out'){
				var paidout = $(this).val();
				sat += +$(this).val();
			}
		});
		var recmt = $('#recamtsunday').val();
		var salemt = $('#sumamtsunday').val();
		var stax = tax;
		var otherpart = sat;
		var overfriday = (parseInt(recmt) - (parseInt(salemt) +  parseInt(stax))) + parseInt(otherpart);
		//$('#overfriday').val(overfriday);
		if(overfriday.toFixed(2) >= 0){
			$('#overfriday').val(overfriday.toFixed(2));
			}else{
			$('#overfriday').val('('+(overfriday*(-1)).toFixed(2)+')').css("color", "red");
		}
		/* fri over value end*/

		var finalover = parseInt(oversaturday) + parseInt(oversunday) + parseInt(overmonday) + parseInt(overtuesday) + parseInt(overwednesday) + parseInt(overthrusday) + parseInt(overfriday);
		var FinalT = numberWithCommas((finalover*(-1)).toFixed(2));
		//$('#finalovertotal').text('$'+finalover);
		if(FinalT >= 0){
			$('#finalovertotal').text("$"+FinalT);
			}else{
			$('#finalovertotal').text("$("+FinalT+')').css("color", "red");
		}

	});


   //Initialize the datePicker(I have taken format as mm-dd-yyyy, you can     //have your owh)
   $("#weeklyDatePicker").datetimepicker({
      format: 'MM-DD-YYYY',
	  maxDate: 'now',
     // minDate: $("#startDate").val()
	  minDate: moment($("#startDate").val(),'MM-DD-YYYY')

	  // moment(date, 'MM-DD-YYYY hh:mm A');
   });
	$(document).ready(function(){
	moment.locale('en', {
	week: { dow: -1 }
	});
   //Get the value of Start and End of Week
   $('#weeklyDatePicker').on('dp.change', function (e) {
		var value = $("#weeklyDatePicker").val();
		var fullDate = new Date();
		var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
		var currentDate = twoDigitMonth + "-" + fullDate.getDate() + "-" + fullDate.getFullYear();
		if(value == ''){
			var value = currentDate;
		}
		var firstDate = moment(value, "MM-DD-YYYY").day(-1).format("MM-DD-YYYY");
		var lastDate =  moment(value, "MM-DD-YYYY").day(5).format("MM-DD-YYYY");
		$("#weeklyDatePicker").val(firstDate + " - " + lastDate);
			/* if((firstDate != '') && (lastDate != '') ) {
				$('#weekDatapick').trigger('click');
			} */

   });
		$('.sale').keyup(function() {
			if($(this).val()!="") {
				var name = ($(this).attr('name'));
				var unit = ($(this).attr('unit'));
				var dayno = ($(this).attr('dayno'));
				var val = ($(this).val());
				var dayname = $('#'+dayno).text();
				var nameID = ($(this).attr('nameId'));
				var weekNo = $('#weekNoData').text();
				var storeNo = $('#storeNoData').text();
				$.ajax({
					type:       "POST",
					dataType:   "text",
					url:        "{{ url('/') }}/dataSave",
					data: {name: name,unit:unit,dayno:dayno,val:val,dayname:dayname,nameID:nameID,weekNo:weekNo,storeNo:storeNo},
					success: function(data)	{
					}
				});
			}
		});

		$('.sumunit').keyup(function() {
			var sum = 0;
			if($(this).hasClass("sumunitmon")== true){
				$(".sumunitmon").each(function() {
					sum += +this.value;
				});
			$('#sumunitmonday').val(sum);
			}
			if($(this).hasClass("sumunittue")== true){
				$(".sumunittue").each(function() {
					sum += +this.value;
				});
			$('#sumunittuesday').val(sum);
			}
			if($(this).hasClass("sumunitwed")== true){
				$(".sumunitwed").each(function() {
					sum += +this.value;
				});
			$('#sumunitwednesday').val(sum);
			}
			if($(this).hasClass("sumunitthr")== true){
				$(".sumunitthr").each(function() {
					sum += +this.value;
				});
			$('#sumunitthrusday').val(sum);
			}
			if($(this).hasClass("sumunitfri")== true){
				$(".sumunitfri").each(function() {
					sum += +this.value;
				});
			$('#sumunitfriday').val(sum);
			}
			if($(this).hasClass("sumunitsat")== true){
				$(".sumunitsat").each(function() {
					sum += +this.value;
				});
			$('#sumunitsaturday').val(sum);
			}
			if($(this).hasClass("sumunitsun")== true){
				$(".sumunitsun").each(function() {
					sum += +this.value;
				});
			$('#sumunitsunday').val(sum);
			}
		});

		$('.sumamt').keyup(function() {
			var sum = 0;
			if($(this).hasClass("sumamtmon")== true){
				$(".sumamtmon").each(function() {
					sum += +this.value;
				});
			$('#sumamtmonday').val(sum);
			}
			if($(this).hasClass("sumamttue")== true){
				$(".sumamttue").each(function() {
					sum += +this.value;
				});
			$('#sumamttuesday').val(sum);
			}
			if($(this).hasClass("sumamtwed")== true){
				$(".sumamtwed").each(function() {
					sum += +this.value;
				});
			$('#sumamtwednesday').val(sum);
			}
			if($(this).hasClass("sumamtthr")== true){
				$(".sumamtthr").each(function() {
					sum += +this.value;
				});
			$('#sumamtthrusday').val(sum);
			}
			if($(this).hasClass("sumamtfri")== true){
				$(".sumamtfri").each(function() {
					sum += +this.value;
				});
			$('#sumamtfriday').val(sum);
			}
			if($(this).hasClass("sumamtsat")== true){
				$(".sumamtsat").each(function() {
					sum += +this.value;
				});
			$('#sumamtsaturday').val(sum);
			}
			if($(this).hasClass("sumamtsun")== true){
				$(".sumamtsun").each(function() {
					sum += +this.value;
				});
			$('#sumamtsunday').val(sum);
			}
		});

		$('.disamt').keyup(function() {
			var sum = 0;
			if($(this).hasClass("disamtmon")== true){
				$(".disamtmon").each(function() {
					sum += +this.value;
				});
			$('#disamtmonday').val(sum);
			}
			if($(this).hasClass("disamttue")== true){
				$(".disamttue").each(function() {
					sum += +this.value;
				});
			$('#disamttuesday').val(sum);
			}
			if($(this).hasClass("disamtwed")== true){
				$(".disamtwed").each(function() {
					sum += +this.value;
				});
			$('#disamtwednesday').val(sum);
			}
			if($(this).hasClass("disamtthr")== true){
				$(".disamtthr").each(function() {
					sum += +this.value;
				});
			$('#disamtthrusday').val(sum);
			}
			if($(this).hasClass("disamtfri")== true){
				$(".disamtfri").each(function() {
					sum += +this.value;
				});
			$('#disamtfriday').val(sum);
			}
			if($(this).hasClass("disamtsat")== true){
				$(".disamtsat").each(function() {
					sum += +this.value;
				});
			$('#disamtsaturday').val(sum);
			}
			if($(this).hasClass("disamtsun")== true){
				$(".disamtsun").each(function() {
					sum += +this.value;
				});
			$('#disamtsunday').val(sum);
			}
		});

		$('.adjamt').keyup(function() {
			var sum = 0;
			if($(this).hasClass("adjamtmon")== true){
				$(".adjamtmon").each(function() {
					sum += +this.value;
				});
			$('#adjamtmonday').val(sum);
			}
			if($(this).hasClass("adjamttue")== true){
				$(".adjamttue").each(function() {
					sum += +this.value;
				});
			$('#adjamttuesday').val(sum);
			}
			if($(this).hasClass("adjamtwed")== true){
				$(".adjamtwed").each(function() {
					sum += +this.value;
				});
			$('#adjamtwednesday').val(sum);
			}
			if($(this).hasClass("adjamtthr")== true){
				$(".adjamtthr").each(function() {
					sum += +this.value;
				});
			$('#adjamtthrusday').val(sum);
			}
			if($(this).hasClass("adjamtfri")== true){
				$(".adjamtfri").each(function() {
					sum += +this.value;
				});
			$('#adjamtfriday').val(sum);
			}
			if($(this).hasClass("adjamtsat")== true){
				$(".adjamtsat").each(function() {
					sum += +this.value;
				});
			$('#adjamtsaturday').val(sum);
			}
			if($(this).hasClass("adjamtsun")== true){
				$(".adjamtsun").each(function() {
					sum += +this.value;
				});
			$('#adjamtsunday').val(sum);
			}
		});

		$('.recamt').keyup(function() {
			var sum = 0;
			if($(this).hasClass("recamtmon")== true){
				$(".recamtmon").each(function() {
					sum += +this.value;
				});
			$('#recamtmonday').val(sum);
			}
			if($(this).hasClass("recamttue")== true){
				$(".recamttue").each(function() {
					sum += +this.value;
				});
			$('#recamttuesday').val(sum);
			}
			if($(this).hasClass("recamtwed")== true){
				$(".recamtwed").each(function() {
					sum += +this.value;
				});
			$('#recamtwednesday').val(sum);
			}
			if($(this).hasClass("recamtthr")== true){
				$(".recamtthr").each(function() {
					sum += +this.value;
				});
			$('#recamtthrusday').val(sum);
			}
			if($(this).hasClass("recamtfri")== true){
				$(".recamtfri").each(function() {
					sum += +this.value;
				});
			$('#recamtfriday').val(sum);
			}
			if($(this).hasClass("recamtsat")== true){
				$(".recamtsat").each(function() {
					sum += +this.value;
				});
			$('#recamtsaturday').val(sum);
			}
			if($(this).hasClass("recamtsun")== true){
				$(".recamtsun").each(function() {
					sum += +this.value;
				});
			$('#recamtsunday').val(sum);
			}
		});
	});




</script>

@endsection
