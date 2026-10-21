@extends('layouts.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}" type="text/css">
<section id="dashboard-page" class="wrap kv-user-form-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class= "page-heading kv-page-hero">
					<h3 class="heading">
						<a class="v-btn v-btn-primary pull-right" style="margin-right:8px" href="{{ url('/user') }}">
							<i class="fa fa-arrow-left " style="margin-right: 5px"> </i>
							BACK
						</a>
						ADD USER
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">MENU</a>
					</h3>
				</div>
				<br />
			</div>
		</div>
		<div class="row">
			@if(Session::has('message'))
				<div class="col-sm-12 alert alert-success">{{ Session::get('message') }}</div>
			@endif
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget kv-user-create-card">
					<div class="widget-content">
						<form method="POST" action="{{ url('/user') }}">
							{{ csrf_field() }}
							<div class="kv-user-fields">
								<div class="kv-user-field{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="name">NAME</label>
									<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
									@if ($errors->has('name'))<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>@endif
								</div>
								<div class="kv-user-field{{ $errors->has('email') ? ' has-error' : '' }}">
									<label for="email">EMAIL</label>
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
									@if ($errors->has('email'))<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>@endif
								</div>
								<div class="kv-user-field{{ $errors->has('phone') ? ' has-error' : '' }}">
									<label for="phone">PHONE</label>
									<input id="phone" type="tel" class="form-control" name="phone" value="{{ old('phone') }}">
									@if ($errors->has('phone'))<span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>@endif
								</div>
								<div class="kv-user-field{{ $errors->has('role') ? ' has-error' : '' }}">
									<label for="roleId">ROLE</label>
									{{ Form::select('role', $roles, null,['class' => 'form-control', 'onChange' => 'getVal()', 'id' => 'roleId']) }}
									@if ($errors->has('role'))<span class="help-block"><strong>{{ $errors->first('role') }}</strong></span>@endif
								</div>
								<div class="kv-user-field kv-user-access-field{{ $errors->has('moduleList') ? ' has-error' : '' }}">
									<label>MODULE ACCESS</label>
									<div class="kv-user-checkbox-grid kv-user-module-grid">
										<label><input type="checkbox" name="moduleList[]" value="1" @if(is_array(old('moduleList')) && in_array('1', old('moduleList'))) checked @endif> Sales</label>
										<label><input type="checkbox" name="moduleList[]" value="2" @if(is_array(old('moduleList')) && in_array('2', old('moduleList'))) checked @endif> Labour</label>
									</div>
									@if ($errors->has('moduleList'))<span class="help-block"><strong>{{ $errors->first('moduleList') }}</strong></span>@endif
								</div>
								<div class="kv-user-field kv-user-claim-field{{ $errors->has('claim') ? ' has-error' : '' }}">
									<label for="claim">CLAIM</label>
									<input id="claim" type="text" class="form-control" name="claim" value="{{ old('claim') }}">
									@if ($errors->has('claim'))<span class="help-block"><strong>{{ $errors->first('claim') }}</strong></span>@endif
								</div>
								<div class="kv-user-field kv-user-location-field{{ $errors->has('email_location') ? ' has-error' : '' }}" id="emLoc">
									<label>EMAIL LOCATION</label>
					<select class="form-control kv-user-multiselect" name="email_location[]" multiple="multiple" data-placeholder="Select email locations">
						@foreach($locations as $id => $location)
							<option value="{{ $id }}" @if(is_array(old('email_location')) && in_array($id, old('email_location'))) selected @endif>{{ $location }}</option>
						@endforeach
					</select>
									@if ($errors->has('email_location'))<span class="help-block"><strong>{{ $errors->first('email_location') }}</strong></span>@endif
								</div>
								<div class="kv-user-field kv-user-location-field{{ $errors->has('location') ? ' has-error' : '' }}">
									<label>SELECT LOCATION</label>
					<select class="form-control kv-user-multiselect" name="location[]" multiple="multiple" data-placeholder="Select locations">
						@foreach($locations as $id => $location)
							<option value="{{ $id }}" @if(is_array(old('location')) && in_array($id, old('location'))) selected @endif>{{ $location }}</option>
						@endforeach
					</select>
									@if ($errors->has('location'))<span class="help-block"><strong>{{ $errors->first('location') }}</strong></span>@endif
								</div>
								<div class="kv-user-field{{ $errors->has('password') ? ' has-error' : '' }}">
									<label for="password">PASSWORD</label>
									<input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
									@if ($errors->has('password'))<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>@endif
								</div>
								<div class="kv-user-field{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
									<label for="password-confirm">CONFIRM PASSWORD</label>
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
									@if ($errors->has('password_confirmation'))<span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>@endif
								</div>
							</div>
							<div class="widget-footer kv-user-form-actions">
								<button type="submit" class="v-btn v-btn-primary">ADD USER</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript" src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
<script>
$(document).ready(function() {
	$('.kv-user-multiselect').multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		buttonWidth: '100%',
		maxHeight: 240,
		numberDisplayed: 1,
		buttonText: function(options, select) {
			if (options.length === 0) {
				return $(select).data('placeholder') || 'Select locations';
			}
			return options.length === 1 ? options.text() : options.length + ' locations selected';
		},
		selectAllText: 'Select all locations'
	});
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
