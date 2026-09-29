@extends('layouts.layout')

@section('content')

<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading">SALES
					
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">DASHBOARD</a>
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/account/create') }}">NEW WEEK ENTRY</a>
					</h3>
	                <br /> 
				</div>
			</div>
		</div>

		@if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif

        
		<div class="row">

			<div class="col-sm-12">

				<div class="widget form-layout">

					<div class="widget-content">

						<table class="table basic-table table-striped">
							<thead>
								<tr>
									<th>Week No.</th>
									<th>Month</th>
									<th>Total</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Jan</td>
									<td>122</td>
									<td>
										<ul class="inline icon-list">
											<li><a href="#" class="edit-icon"><i class="fa fa-edit"></i></a></li>
											<li><a href="#" class="delete-icon"><i class="fa fa-trash"></i></a></li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>1</td>
									<td>Jan</td>
									<td>122</td>
									<td>
										<ul class="inline icon-list">
											<li><a href="#" class="edit-icon"><i class="fa fa-edit"></i></a></li>
											<li><a href="#" class="delete-icon"><i class="fa fa-trash"></i></a></li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>1</td>
									<td>Jan</td>
									<td>122</td>
									<td>
										<ul class="inline icon-list">
											<li><a href="#" class="edit-icon"><i class="fa fa-edit"></i></a></li>
											<li><a href="#" class="delete-icon"><i class="fa fa-trash"></i></a></li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>1</td>
									<td>Jan</td>
									<td>122</td>
									<td>
										<ul class="inline icon-list">
											<li><a href="#" class="edit-icon"><i class="fa fa-edit"></i></a></li>
											<li><a href="#" class="delete-icon"><i class="fa fa-trash"></i></a></li>
										</ul>
									</td>
								</tr>
							</tbody>
							
						</table>

					</div>

				</div>

			</div>

		</div>
	</div>
</section>


@endsection