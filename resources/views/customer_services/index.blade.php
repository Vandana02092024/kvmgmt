@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading"> <a class="v-btn v-btn-primary " style="margin-right:8px" href="{{ url('/dashboard') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a> CUSTOMER COMMUNICATIONS
					
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">MENU</a>
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/service/create') }}">NEW CUSTOMER COMMUNICATIONS</a>
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

					

                	</form>
					<div class="widget-content">
							<div class="widget-content">
								
								<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							                <th>CSR#</th>
							                <!--<th>REPORT</th>-->
							                <th>CLAIM FORM ID</th>
											<th>NAME</th>
											<th>ISSUED DATE</th>
											<th>ISSUED BY</th>
											
											<th>FOLLOW UP BY</th>
							               <!-- <th>NOTES</th>
							                <th>FOLLOWUP DATE/TIME</th>-->
							                <th>MODE OF <br /> CONTACT</th>
											<th>STATUS</th>
							                <th>ACTION</th>
							            </tr>
							        </thead>
							        <tbody>
							        	@foreach($services as $service)
										<?
										/* echo "<pre>";
										print_r($service);
										exit; */
										?>
										@php
											$val = $locationCode[0]."-".str_pad($service->id, 4, '0', STR_PAD_LEFT);
											$claimId = $locationCode[0]."-".str_pad($service->report_id, 4, '0', STR_PAD_LEFT);
										@endphp
										 <tr>
			                            	<!--<td>CSR-{{ $locationCode[0].'-'.$service->id != 0 }}</td>-->
											<td>CSR-{{ $val }}</td>
			                                <!--<td>{{ ($service->report_id != 0)?'RPT_'.$service->report_id:'N/A' }}</td>-->
			                                <!--<td>{{ ($service->claim_id != 0)?'#_'.$service->report_id:'N/A' }}</td>-->
			                                <td>{{ ($service->report_id != '')?'CF-'.$claimId:'N/A' }}</td>
			                              <!--  <td>{{ $service->notes }}</td>
			                                <td>{{ date('m/d/Y h:i A', strtotime($service->followup_date.' '.$service->followup_time)) }}</td>-->
											<td>{{ $service->customer_name }}</td>
											<td>{{ date('m/d/Y',strtotime($service->created_at)) }}</td>
											<td>{{ $service->created_byname }}</td>
											
											<td>{{ $service->followup_byname }}</td>
											
											
											<td>{{ ($service->mode_of_contact == 1)?'Email':'Text' }}</td>
											<td><?php if($service->status == 1){
													echo "Forwarded";
														}else if ($service->status == 2){
															echo "Closed";
														} else {
												
															}?></td>
			                                
			                                
			                                <td>
			                                    {!! Form::open(array('route' => ['service.destroy', $service->customer_service_id], 'method'=>'DELETE', 'class' => 'delete')) !!}
			                                        
			                                        {{ link_to_route('service.edit','',[$service->customer_service_id],['class' => 'fa fa-pencil','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"edit"]) }}
													@if(Auth::user()->role == 'Owner')
			                                        |
			                                        {{ Form::button('',['class'=>'fa fa-close','type'=>'submit','data-toggle'=>"tooltip", 'data-placement'=>"right", 'title'=>"delete"]) }}
													@endif
			                                    {!! Form::close() !!}
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
	// column.header()

	$(".delete").on("submit", function(){
        return confirm("Do you want to delete this user?");
    });
</script>
@endsection