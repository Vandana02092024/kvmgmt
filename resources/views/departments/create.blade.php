@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading">ADD DEPARTMENT</h3>
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/department') }}">BACK</a>
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
						<form class="widget ng-pristine ng-valid" method="POST" action="{{ url('/department') }}">
        				{{ csrf_field() }}
							<div class="widget-content">
								<div class="row form-group{{ $errors->has('department') ? ' has-error' : '' }}">
									<div class="col-sm-12">
										<label>DEPARTMENT</label>
										<textarea id="department" type="text" class="form-control" name="department">{{ old('department') }}</textarea>

	                                    @if ($errors->has('department'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('department') }}</strong>
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