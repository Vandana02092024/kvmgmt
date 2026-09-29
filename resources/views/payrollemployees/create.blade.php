@extends('layouts.layout')
@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading">ADD PAYROLL EMPLOYEE 
					<a class="v-btn v-btn-primary pull-right bg-light" href="{{ url('/payrollemployee') }}">BACK</a>
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">DASHBOARD</a>
					</h3>
					 <br /> 
				</div>
			</div>
		</div>
		<div class="row">
			@if(Session::has('message'))
	            <div class="alert alert-success">
	                {{ Session::get('message') }}
	            </div>
	        @endif
	
			<div class="col-sm-8 col-sm-offset-2">
				<div class="widget">
					<div class="widget-content">
						<form class="ng-pristine ng-valid" method="POST" action="{{ url('/payrollemployee') }}">
        				{{ csrf_field() }}
							<div class="widget-content">
								<div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<div class="col-sm-4">
										<label for="name">PAYROLL EMPLOYEE NAME</label>
										<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

	                                    @if ($errors->has('name'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('name') }}</strong>
	                                        </span>
	                                    @endif
									</div>							
								</div>	
								
								<div class="row form-group{{ $errors->has('salary') ? ' has-error' : '' }}">
									<div class="col-sm-4">
										<label for="salary">SALARY</label>
										<input id="salary" type="text" class="form-control" name="salary" value="{{ old('salary') }}">

	                                    @if ($errors->has('salary'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('salary') }}</strong>
	                                        </span>
	                                    @endif
									</div>							
								</div>	
								
								<!--<div class="row form-group{{ $errors->has('working_hour') ? ' has-error' : '' }}">
									<div class="col-sm-4">
										<label for="working_hour">WORKING HOURS</label>
										<input id="working_hour" type="text" class="form-control" name="working_hour" value="{{ old('working_hour') }}">

	                                    @if ($errors->has('working_hour'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('working_hour') }}</strong>
	                                        </span>
	                                    @endif
									</div>							
								</div>	-->
								<div class="row form-group{{ $errors->has('rateperhour') ? ' has-error' : '' }}">
									<div class="col-sm-4">
										<label for="rateperhour">PAYROLL EMPLOYEE HOURLY RATE</label>
										<input id="rateperhour" type="text" class="form-control" name="rateperhour" value="{{ ((old('rateperhour'))?old('rateperhour'):$rate) }}">

	                                    @if ($errors->has('rateperhour'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('rateperhour') }}</strong>
	                                        </span>
	                                    @endif
									</div>							
								</div>
								<div class="row form-group{{ $errors->has('sorting_order') ? ' has-error' : '' }}">
									<div class="col-sm-4">
										<label for="sorting_order">PAYROLL DEPARTMENT SORTING NO.</label>
										<input id="sorting_order" type="text" class="form-control" name="sorting_order" value="{{ old('sorting_order') }}">

	                                    @if ($errors->has('sorting_order'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('sorting_order') }}</strong>
	                                        </span>
	                                    @endif
									</div>							
								</div>	
								<div class="row form-group{{ $errors->has('department') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label>SELECT DEPARTMENT</label>
										@foreach($departments as $id => $department)
										<div class="checkbox">
											<label><input type="checkbox" name="department[]" value="{{ $id }}" @if(is_array(old('department')) && in_array($id, old('department'))) checked @endif>{{ $department }}</label>
										</div>
										@endforeach
										@if ($errors->has('department'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('department') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>

								<div class="row form-group{{ $errors->has('location') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label>SELECT LOCATION</label>
										@foreach($locations as $id => $location)
										<div class="checkbox">
											<label><input type="checkbox" name="location[]" value="{{ $id }}" @if(is_array(old('location')) && in_array($id, old('location'))) checked @endif>{{ $location }}</label>
										</div>
										@endforeach
										@if ($errors->has('location'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('location') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>	
																
							</div>
							<div class="widget-footer">
								<button class="v-btn v-btn-primary">ADD</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection