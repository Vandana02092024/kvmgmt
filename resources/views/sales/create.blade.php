@extends('layouts.layout')
@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading">ADD SALES
					<a class="v-btn v-btn-primary pull-right bg-light" href="{{ url('/sale') }}">BACK</a>
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
						<form class="ng-pristine ng-valid" method="POST" action="{{ url('/sale') }}">
        				{{ csrf_field() }}
							<div class="widget-content">
								<div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label for="name">SALE</label>
										<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

	                                    @if ($errors->has('name'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('name') }}</strong>
	                                        </span>
	                                    @endif
									</div>							
								</div>
								<div class="row form-group{{ $errors->has('sorting_order') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label for="sorting_order">SORTING NO.</label>
										<input id="sorting_order" type="text" class="form-control" name="sorting_order" value="{{ old('sorting_order') }}">

	                                    @if ($errors->has('sorting_order'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('sorting_order') }}</strong>
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