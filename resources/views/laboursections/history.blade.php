@extends('layouts.layout')

@section('content')
<style type="text/css">
	
</style>

                                       <section id="dashboard-page" class="wrap">
<div class="container-fluid">
	<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading">HISTORY OF CHANGES
					<a class="v-btn v-btn-primary pull-right bg-light" href="http://44.230.62.131/kvmgmt/dashboard">BACK</a>
					
					</h3>
	                <br> 
				</div>
			</div>
		</div>
	<div class="row">
		<div class="col-md-12">
			<div class="widget">
				<div class="widget-content">
			
			<table width="100%" id="example" class="table table-bordered">
				<thead>
					<tr>
					<th>#</th>
					<th>Action Type</th>
				</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					@foreach($track_emp as $emp)
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $emp->employee_detail }} on "{{ date("m-d-Y H:i A", strtotime($emp->created_at)) }}" by {{ $emp->created_by }}</td>
					</tr>
					@endforeach
					<!-- <tr>
						<td>b</td>
						<td>
							Employee A Employee Rate is $10.00
						</td>
						<td>
							10/28/2021
						</td>
					</tr>
					<tr>
						<td>c</td>
						<td>
							Employee A Employee Rate was changed to $12.00 
						</td>
						<td>
							12/10/2021
						</td>
					</tr> -->
					
				</tbody>
				
			</table>
		</div>
		</div>
	</div>
</div>
</div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable({
			order: [],
			columnDefs: [ { orderable: false, targets: [0]}]
		});
	} );
	
</script>

@endsection