@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap kv-vendor-form-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading"> <a class="v-btn v-btn-primary pull-right " style="margin-right:8px" href="{{ url('/seller') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a>ADD VENDOR
					<a class="v-btn v-btn-primary pull-right " href="{{ url('/dashboard') }}">MENU</a>
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

	        <form class="ng-pristine ng-valid kv-vendor-form" method="POST" action="{{ url('/seller') }}">
			{{ csrf_field() }}

			<div class="col-sm-5">
				<div class="widget kv-vendor-details">
					<div class="widget-content kv-vendor-fields">
						<div class="kv-vendor-section-title"><strong>Vendor details</strong><span>Contact information and delivery schedule</span></div>
						
							<div class="">
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

								<div class="row form-group{{ $errors->has('address') ? ' has-error' : '' }}">							
									<div class="col-sm-12">
										<label>ADDRESS</label>
										<textarea id="address" type="address" class="form-control" name="address" >{{ old('address') }}</textarea>

	                                    @if ($errors->has('address'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('address') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>

								<!-- <div class="row form-group{{ $errors->has('delivery_day') ? ' has-error' : '' }}">							
									<div class="col-sm-12">
										<label>DELIVERY DAY</label>
										{{ Form::select('delivery_day', $days, old('delivery_day'),['class' => 'form-control']) }}

	                                    @if ($errors->has('delivery_day'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('delivery_day') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div> -->


								
								
								
							</div>
							<div class="widget-footer">
								<button class="v-btn v-btn-primary">ADD</button>
							</div>
						
					</div>
				</div>
			</div>

			<div class="col-sm-7">
				<div class="widget kv-vendor-delivery">
					<div class="widget-content">
						<div class="kv-vendor-section-title"><strong>Delivery days</strong><span>Choose a delivery day for each location</span></div>
						
							<div class="widget-content">
								@foreach($locations as $key => $val)
								<div class="row form-group">
									<div class="col-sm-12">
										<label for="name">DELIVERY DAY For {{ $val->location }}</label>
										<input type="hidden" name="delivery_day[{{$key}}][location_id]" value= {{$val->id}} >
										<select class="form-control" name="delivery_day[{{$key}}][day]">
										  @foreach ( $days as $key => $val )
											 <option value="{{$key}}">{{$val}}</option>
										  @endforeach
										</select>
									</div>							
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>

			</form>

		</div>
	</div>
</section>
@endsection
