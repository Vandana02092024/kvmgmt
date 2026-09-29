@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading"> <a class="v-btn v-btn-primary " style="margin-right:8px" href="{{ url('/seller') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a>EDIT VENDOR
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">MENU</a>
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/seller/create') }}">NEW VENDOR</a>
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

			{!! Form::model($seller, array('route' => ['seller.update', $seller->id], 'method' => 'PUT')) !!}
        	{{ csrf_field() }}
			<div class="col-sm-8 col-sm-offset-2">
				<div class="widget">
					<div class="widget-content">
						
							<div class="">
								<div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label for="name">NAME</label>
										{!! Form::text('name', null, ['class' => 'form-control']) !!}

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
										{!! Form::text('email', null, ['class' => 'form-control']) !!}

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
										{!! Form::text('phone', null, ['class' => 'form-control']) !!}

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
										{!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => 2]) !!}

	                                    @if ($errors->has('address'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('address') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>

								<!--<div class="row form-group{{ $errors->has('delivery_day') ? ' has-error' : '' }}">							
									<div class="col-sm-12">
										<label>DELIVERY DAY</label>
										{{ Form::select('delivery_day', $days, null,['class' => 'form-control']) }}

	                                    @if ($errors->has('delivery_day'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('delivery_day') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>-->
								
								
							</div>
							<div class="widget-footer">
								<button class="v-btn v-btn-primary">UPDATE</button>
							</div>
						
					</div>
				</div>
			</div>
			
			<div class="col-sm-4">
				<div class="widget">
					<div class="widget-content">
						 <div class="widget-content">
								@foreach($locations as $key => $val)
								<div class="row form-group">
									<div class="col-sm-12">
										<label for="name">DELIVERY DAY For {{ $val->location }} </label>
										<input type="hidden" name="delivery_day[{{$key}}][location_id]" value={{$val->id}} >
											<select class="form-control" name="delivery_day[{{$key}}][day]">
											  @foreach ( $days as $kp => $vp )
												  
												  @if(isset($getDeliveryDay[$val->id]['delivery_day'])  && $getDeliveryDay[$val->id]['delivery_day'] == $kp)
													<option value="{{$kp}}" selected>{{$vp}}</option>
												  @else
													  <option value="{{$kp}}" >{{$vp}}</option>
												  @endif
												  
											  @endforeach
											</select>
									</div>							
								</div>
								@endforeach
							</div>
						</div>
				</div>
			</div>
			
		</div>
	</div>
</section>
@endsection