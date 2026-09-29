@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading">VIEW CSR</h3>
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/menu') }}">BACK</a>
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">DASHBOARD</a>
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/service/create') }}">CREATE NEW CSR</a>
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
							                <th>#</th>
							                <th>REPORT</th>
							                <th>CLAIM</th>
							                <th>NOTES</th>
							                <th>FOLLOWUP DATE/TIME</th>
							                <th>MODE OF <br /> CONTACT</th>
							                <th>ACTION</th>
							            </tr>
							        </thead>
							        <tbody>
							        	@foreach($services as $service)
			                            <tr>
			                            	<td>CSR_{{ $service->id != 0 }}</td>
			                                <td>{{ ($service->report_id != 0)?'RPT_'.$service->report_id:'N/A' }}</td>
			                                <td>{{ ($service->claim_id != 0)?'#_'.$service->report_id:'N/A' }}</td>
			                                <td>{{ $service->notes }}</td>
			                                <td>{{ date('m/d/Y h:i A', strtotime($service->followup_date.' '.$service->followup_time)) }}</td>
			                                <td>{{ ($service->mode_of_contact == 1)?'Email':'Text' }}</td>
			                                <td>
			                                    {!! Form::open(array('route' => ['service.destroy', $service->id], 'method'=>'DELETE', 'class' => 'delete')) !!}
			                                        
			                                        {{ link_to_route('service.edit','',[$service->id],['class' => 'fa fa-pencil','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"edit"]) }}
			                                        |
			                                        {{ Form::button('',['class'=>'fa fa-close','type'=>'submit','data-toggle'=>"tooltip", 'data-placement'=>"right", 'title'=>"delete"]) }}

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
	    $('#example').DataTable();
	} );
	// column.header()

	$(".delete").on("submit", function(){
        return confirm("Do you want to delete this user?");
    });
</script>
@endsection