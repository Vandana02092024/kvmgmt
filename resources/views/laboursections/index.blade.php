@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading kv-page-hero kv-labor-hero">
					<h3 class="heading">
						<span class="kv-hero-title"><i class="fa fa-users"></i><span>Labor Reports</span></span>

						<a class="v-btn v-btn-primary pull-right" href="{{ url('/laboursection/create') }}"><i class="fa fa-plus"></i> New Labor Report</a>
					</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="widget">
					<div class="widget-content">
						<div class="responsive-table">
							<table id="example" class="table table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>STORE WEEK RANGE</th>
										<th>DATE RANGE</th>
										<th>AMOUNT</th>
										<th>ACTION</th>
									</tr>
								</thead>
								<tbody>
									@foreach($records as $record)
									<tr>
										<td>{{ $record->start_week }}-{{ $record->end_week }}</td>
										<td>{{ date("m-d-Y", strtotime($record->start_date)) }} - {{ date("m-d-Y", strtotime($record->end_date)) }}</td>
										<td>${{ number_format($record->total_amount, 2) }} </td>
										<td>
											{{ link_to_route('laboursection.edit','',[$record->id],['class' => 'fa fa-pencil','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"edit"]) }}
										</td>
										</form>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
