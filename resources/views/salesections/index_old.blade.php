@extends('layouts.layout')

@section('content')

<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading">
						<a class="v-btn v-btn-primary " style="margin-right:8px" href="{{ url('/dashboard') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a>
						WEEKLY SALES REPORT

					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">MENU</a>
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/salesection/create') }}">NEW WEEK REPORT</a>
					</h3>
	                <br />
				</div>
			</div>
		</div>

		@if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
		<div class="row">
			<div class="col-sm-12">
				<div class="widget">
					<div class="widget-content">
						<div class="responsive-table">
							<table id="example" class="table table-bordered" cellspacing="0" width="100%">
						        <thead>
						            <tr>
						                <th>CALENDAR WEEK</th>
														<th>WEEK #</th>
														<th>START DATE</th>
														<th>END DATE</th>
														<th>Gross Sales</th>
														<th>Net Sales</th>
														<th>Labor %</th>
														<th>ACTION</th>
						            </tr>
						        </thead>
						        <tbody>
								<?php 	//dd($data);?>

						            @foreach($data as $dat)

												@php
												$week=getWeekByDate($dat->dataDate);
												$weekdate=getStartAndEndDatebyweek($week,date('Y-m-d', strtotime($dat->dataDate)));
												@endphp
												<?php // $range = (($dat->storeNo % 2) == 0)?($dat->storeNo-1):$dat->storeNo; ?>
												<?php
												$tot_sale = getLaberRate($dat->location_id,$dat->storeNo);
												$range = $dat->storeNo;  $gsale = number_format($dat->amount,2);
												$sale_tax = getSaleTax($dat->location_id,$weekdate['start_date'],$weekdate['end_date']);
												$netsale= getNetSale($dat->location_id,$weekdate['start_date'],$weekdate['end_date'])-$sale_tax

												?>

												<!-- Add by kajal -->
												<?php
													// $update_week = correctWeekUpdate($weekdate['end_date'],$week,$weekdate['start_date'],$dat->storeNo,$dat->location_id);
												?>
												<!-- End -->

												<tr>
														<td>{{ $week }}</td>
														<td>{{ $dat->storeNo }}</td>
														<td><?php echo date("m-d-Y", strtotime($weekdate['start_date']));  ?></td>
														<td><?php echo date("m-d-Y", strtotime($weekdate['end_date'])); ?></td>
														<td>{{ $gsale }}</td>
														<td>{{  number_format($netsale,2) }}</td>
														<td> @if(($netsale >0) && ($tot_sale) > 0)  {{ number_format(($tot_sale/$netsale)*100,2)}} @else 0.00 @endif </td>
														<td>
														{{ link_to_route('salesection.edit','',[$range ],['class' => 'fa fa-pencil','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"edit"]) }}
														&nbsp;
														{{ link_to_route('salesection.printData','',[$dat->storeNo],['class' => 'fa fa-print','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"Print"]) }}
														&nbsp;
														{{ link_to_route('labor_report','',[$range],['class' => 'fa fa-file','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"Labor Report"]) }}
														</td>

		                     				</tr>
		                   @endforeach
						        </tbody>
						    </table>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>
</section>


<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable({
			order: [],
			columnDefs: [ { orderable: false, targets: [0]}]
		});
	} );
</script>

@endsection
