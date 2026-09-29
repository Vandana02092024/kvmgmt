@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading"> <a class="v-btn v-btn-primary " style="margin-right:8px" href="{{ url('/category') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a>ADD CATEGORY</h3>
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
						<form class=" ng-pristine ng-valid" method="POST" action="{{ url('/category') }}">
        				{{ csrf_field() }}
							<div class="widget-content">
								<div class="row form-group{{ $errors->has('category') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label>CATEGORY</label>
										<textarea id="category" type="text" class="form-control" name="category">{{ old('category') }}</textarea>

	                                    @if ($errors->has('category'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('category') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
								
								
								<div class="row form-group">
									<div class="col-sm-12">
										<label>RANK</label>
										{!! Form::text('rank', null, ['class' => 'form-control']) !!}
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