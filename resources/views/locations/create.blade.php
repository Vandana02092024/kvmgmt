@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading"> <a class="v-btn v-btn-primary pull-right" style="margin-right:8px" href="{{ url('/location') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a>ADD LOCATION
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
						<form class="widget ng-pristine ng-valid" method="POST" action="{{ url('/location') }}">
        				{{ csrf_field() }}
							<div class="widget-content">
								<div class="row form-group{{ $errors->has('location_code') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label>LOCATION CODE</label>
										<input type="text" id="location_code" type="text" value="{{ old('location_code') }}" class="form-control" name="location_code">

	                                    @if ($errors->has('location_code'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('location_code') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>

								<div class="row form-group{{ $errors->has('location') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label>LOCATION</label>
										<textarea id="location" type="text" class="form-control" name="location">{{ old('location') }}</textarea>

	                                    @if ($errors->has('location'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('location') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
								
								<div class="row form-group{{ $errors->has('startdate') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label>START DATE</label>
										<input type="text" class="form-control" id='weeklyDatePicker' name="startdate" autocomplete="off" "placeholder="Select Week" />

	                                    @if ($errors->has('startdate'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('startdate') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
								
								<div class="row form-group">
									<div class="col-sm-12">
										<label>RANK</label>
										<input type="text" id="rank" type="text" value="{{ old('rank') }}" class="form-control" name="rank">
									</div>
								</div>

								<div class="row form-group">
									<div class="col-sm-12">
										<label>RATE</label>
										<input type="text" id="rate" type="text" value="{{ old('rate') }}" class="form-control" name="rate">
									</div>
								</div>


								<div class="row form-group">
									<div class="col-sm-12">
										<label>ENTITY</label>
										<input id="entity_name" type="text" class="form-control" name="entity_name" value= "{{ old('entity_name') }}" />
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
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
 $("#weeklyDatePicker").datetimepicker({		
      format: 'YYYY-MM-DD',
	  maxDate: 'now'
   });
</script>
@endsection