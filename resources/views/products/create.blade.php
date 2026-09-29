@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading"> <a class="v-btn v-btn-primary " style="margin-right:8px" href="{{ url('/product') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a>ADD PRODUCT
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
						<form class="ng-pristine ng-valid" method="POST" action="{{ url('/product') }}">
        				{{ csrf_field() }}
							<div class="widget-content">
								<div class="row form-group{{ $errors->has('code') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label>CODE</label>
										<input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}">

	                                    @if ($errors->has('code'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('code') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>

								<div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label for="name">PRODUCT NAME</label>
										<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

	                                    @if ($errors->has('name'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('name') }}</strong>
	                                        </span>
	                                    @endif
									</div>							
								</div>

								<div class="row form-group{{ $errors->has('category') ? ' has-error' : '' }}">							
									<div class="col-sm-12">
										<label>CATEGORY</label>
										{{ Form::select('category', $category, null,['class' => 'form-control']) }}

	                                    @if ($errors->has('category'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('category') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>

								<div class="row form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label>UNIT</label>
										<input id="unit" type="text" class="form-control" name="unit" value="{{ old('unit') }}">

	                                    @if ($errors->has('unit'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('unit') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
								<div class="row form-group{{ $errors->has('price') ? ' has-error' : '' }}">							
									<div class="col-sm-12">
										<label>PRICE</label>
										<input id="price" type="price" class="form-control" name="price" value="{{ old('price') }}">

	                                    @if ($errors->has('price'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('price') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>

								<div class="row form-group{{ $errors->has('vendor') ? ' has-error' : '' }}">							
									<div class="col-sm-12">
										<label>VENDOR</label>
										{{ Form::select('vendor', $seller, null,['class' => 'form-control']) }}

	                                    @if ($errors->has('vendor'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('vendor') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
								
							    <div class="row form-group">							
									<div class="col-sm-12">
										<label>Rank</label>
										<input id="rank" type="text" class="form-control" name="rank" value="{{ old('ranking') }}">

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