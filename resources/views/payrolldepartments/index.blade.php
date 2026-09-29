@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading">PAYROLL DEPARTMENT
					<a class="v-btn v-btn-primary pull-right bg-light" href="{{ url('/menu') }}">BACK</a>
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">DASHBOARD</a>
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/payrolldepartment/create') }}">NEW PAYROLL DEPARTMENT</a>
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
			<div class="col-sm-12 col-xs-12">
				<div class="widget">
					<div class="widget-content">
							<div class="responsive-table">
								<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							                <th>PAYROLL DEPARTMENT</th>
							                							                
							                <th>ACTION</th>
							            </tr>
							        </thead>
							        <tbody>
							            @foreach($payrolldepartments as $payrolldep)
										
			                            <tr>
			                                <td>{{ $payrolldep->name }}</td>
			                                                               
			                                <td>
			                                    {!! Form::open(array('route' => ['payrolldepartment.destroy', $payrolldep->id], 'method'=>'DELETE', 'class' => 'delete')) !!}
			                                        
			                                        {{ link_to_route('payrolldepartment.edit','',[$payrolldep->id],['class' => 'fa fa-pencil','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"edit"]) }}
													
													|
													
													{{ link_to_route('payrolldepartment.archive',$payrolldep->status == 1 ?'Archive' :'Unarchive',['payrolldep' => $payrolldep->id, 'st' => $payrolldep->status]) }}

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
			"ordering": false
		});
	} );

	$(".delete").on("submit", function(){
        return confirm("Do you want to delete this user?");
    });
</script>
@endsection