@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading"> <a class="v-btn v-btn-primary " style="margin-right:8px" href="{{ url('/user') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a>ADD USER
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">MENU</a>
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
						<form class="widget ng-pristine ng-valid" method="POST" action="{{ url('/user') }}">
        				{{ csrf_field() }}
							<div class="widget-content">
								<div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label for="name">NAME</label>
										<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

	                                    @if ($errors->has('name'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('name') }}</strong>
	                                        </span>
	                                    @endif
									</div>							
								</div>
								<div class="row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label>EMAIL</label>
										<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

	                                    @if ($errors->has('email'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('email') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
								<div class="row form-group{{ $errors->has('phone') ? ' has-error' : '' }}">							
									<div class="col-sm-12">
										<label>PHONE</label>
										<input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}">

	                                    @if ($errors->has('phone'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('phone') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
								<div class="row form-group{{ $errors->has('role') ? ' has-error' : '' }}">							
									<div class="col-sm-12">
										<label>ROLE</label>
										{{ Form::select('role', $roles, null,['class' => 'form-control', 'onChange' => 'getVal()', 'id' => 'roleId']) }}
										@if ($errors->has('role'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('role') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
								<div class="row form-group{{ $errors->has('moduleList') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label>MODULE ACCESS</label>										
										<div class="checkbox">
											<label><input type="checkbox" name="moduleList[]" value="1" >Sales</label>
											</br>
											<label><input type="checkbox" name="moduleList[]" value="2" >Labour</label>
										</div>
										@if ($errors->has('moduleList'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('moduleList') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
								
								
								
								
								<div class="row form-group{{ $errors->has('email_location') ? ' has-error' : '' }}" id="emLoc">
									<div class="col-sm-12">
										<label>EMAIL LOCATION</label>
										@foreach($locations as $id => $location)
										<div class="checkbox">
											<label><input type="checkbox" name="email_location[]" value="{{ $id }}" @if(is_array(old('email_location')) && in_array($id, old('email_location'))) checked @endif>{{ $location }}</label>
										</div>
										@endforeach

										@if ($errors->has('email_location'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('email_location') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
								
								<div class="row form-group{{ $errors->has('claim') ? ' has-error' : '' }}">							
									<div class="col-sm-12">
										<label>CLAIM</label>
										<input id="claim" type="claim" class="form-control" name="claim" value="{{ old('claim') }}">

	                                    @if ($errors->has('claim'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('claim') }}</strong>
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

								<div class="row form-group{{ $errors->has('password') ? ' has-error' : '' }}">							
									<div class="col-sm-12">
										<label>PASSWORD</label>
										<input id="password" type="password" class="form-control" name="password">

	                                    @if ($errors->has('password'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('password') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>

								<div class="row form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	                                <div class="col-sm-12">
										<label>CONFIRM PASSWORD</label>
	                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

	                                    @if ($errors->has('password_confirmation'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
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
$(document).ready(function() {
	  var userRole = $('#roleId').val();
	  if(userRole == 'Owner') {
		 $('#emLoc').show(); 
	  } else {
		 $('#emLoc').hide(); 
	  }
});

function getVal() {
    var userRole = $('#roleId').val();
    if(userRole == 'Owner') {
	   $('#emLoc').show(); 
    } else {
	  $('#emLoc').hide(); 
	}
}

</script>
@endsection