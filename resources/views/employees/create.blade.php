@extends('layouts.layout')
@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading">ADD EMPLOYEE
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/employee') }}">BACK</a>
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
	
			<div class="col-sm-8">
				<div class="widget">
					<div class="widget-content">
						<form class="widget ng-pristine ng-valid" method="POST" action="{{ url('/employee') }}">
        				{{ csrf_field() }}
							<div class="widget-content">
								<div class="row form-group{{ $errors->has('empname') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label for="empname">NAME</label>
										<input id="empname" type="text" class="form-control" name="empname" value="{{ old('empname') }}">

	                                    @if ($errors->has('empname'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('empname') }}</strong>
	                                        </span>
	                                    @endif
									</div>							
								</div>
								<div class="row form-group{{ $errors->has('empemail') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label>EMAIL</label>
										<input id="empemail" type="email" class="form-control" name="empemail" value="{{ old('empemail') }}">

	                                    @if ($errors->has('empemail'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('empemail') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
								<div class="row form-group{{ $errors->has('	empaddress') ? ' has-error' : '' }}">							
									<div class="col-sm-12">
										<label>ADDRESS</label>
										<input id="empaddress" type="text" class="form-control" name="empaddress" value="{{ old('empaddress') }}">

	                                    @if ($errors->has('empaddress'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('	empaddress') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
								<div class="row form-group{{ $errors->has('paymentrate') ? ' has-error' : '' }}">							
									<div class="col-sm-12">
										<label>PAYMENT RATE PER HOUR</label>
										<input id="paymentrate" type="text" class="form-control" name="paymentrate" value="{{ old('paymentrate') }}">

	                                    @if ($errors->has('paymentrate'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('	paymentrate') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
								<div class="row form-group{{ $errors->has('location') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label>SELECT LOCATION</label>
										@foreach($locations as $id => $location)
										<div class="checkbox">
											<label><input type="checkbox" class="check" name="emplocation" value="{{ $id }}" >{{ $location }}</label>
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
<script>
 $('.check').click(function() {
        $('.check').not(this).prop('checked', false);
    });
</script>
@endsection