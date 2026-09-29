@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading">VIEW REIMBURSEMENT
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">BACK</a>
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">DASHBOARD</a>
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/reimbursement/create') }}">CREATE NEW REIMBURSEMENT</a>
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
							                
							                <th>First Name</th>
							                <th>Last Name</th>
							                <th>Address</th>
							                <th>City</th>
							                <th>State</th>
											<th>Status</th>
							                <th>ACTION</th>
							            </tr>
							        </thead>
							        <tbody>
										
							        	@foreach($reimburses as $reimburse)
										
			                            <tr>
			                            	
			                                <td>{{ $reimburse->first_name  }}</td>
			                                <td>{{ $reimburse->last_name }}</td>
			                                <td>{{ $reimburse->address }}</td>
			                                <td>{{ $reimburse->city }}</td>
			                                <td>{{ $reimburse->state }}</td>
											<td>{{ $status }}</td>
											
			                                <td>
			                                    {!! Form::open(array('route' => ['reimbursement.destroy', $reimburse->id], 'method'=>'DELETE', 'class' => 'delete')) !!}
			                                        
			                                        {{ link_to_route('reimbursement.edit','',[$reimburse->id],['class' => 'fa fa-pencil','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"edit"]) }}
													
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
	    $('#example').DataTable();
	} );
	// column.header()

	$(".delete").on("submit", function(){
        return confirm("Do you want to delete this user?");
    });
</script>
@endsection