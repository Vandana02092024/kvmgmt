@extends('layouts.layout')

@section('content')

<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading inline">Supply Order</h3>
					
					<form class="pull-right inline" method="POST" action="{{ url('/sendOrderAgain') }}">
                	{{ csrf_field() }}
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/order') }}">Back</a>
                	<a href="{{ URL::to('public/order_pdf/'.$order->order_id.'.pdf') }}" class='v-btn v-btn-primary pull-right' target="blank">PDF</a>
                	{!! Form::hidden('order_id', $order->order_id, ['class' => 'form-control']) !!}
                	<button class="v-btn v-btn-primary pull-right" data-toggle="tooltip" data-placement="left" title="Show Cart">
                		<span>
                		Email Order
                		</span>
                	</button>
                	</form>
				</div>
			</div>
		</div>
		
		<form class="widget ng-pristine ng-valid" method="POST" action="{{ url('/order') }}">
		{{ csrf_field() }}
		<div class="row hide">
			<div class="col-sm-12">
				<div class="widget">
					<div class="widget-content">
					<ul class="inline pull-right">
						<li>
							<label>Title</label>
							<input type="" name="" class="form-control">
						</li>
						<li>
							<label>Dropdown</label>
							<select class="form-control">
								<option>option1</option>
								<option>option1</option>
								<option>option1</option>
							</select>
						</li>
						<li>
							<label>From Date</label>
							<input type="text" name=""  class="form-control datepicker" placeholder="from date">
						</li>
						<li>
							<label>To Date</label>
							<input type="text" name="" class="form-control datepicker"  placeholder="to date">
						</li>
					</ul>
					</div>
				</div>
			</div>
		</div>


		
		<div class="row">

			<div class="col-sm-6">
				<div class="widget-content">
					<div class="row form-group">
						<label class="col-sm-6">Vendor</label>
						<div class="col-sm-6">
							{{ $seller->name }}
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-6">Email</label>
						<div class="col-sm-6">
							{{ $seller->email }}
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-6">Phone</label>
						<div class="col-sm-6">
							{{ $seller->phone }}
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-6">Address</label>
						<div class="col-sm-6">
							{{ $seller->address }}
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="widget">
					<div class="widget-content">
						<div class="row">
							<label class="col-sm-6">Order Date</label>
							<div class="col-sm-6">{{ date('m/d/Y', time()) }}</div>
						</div>
						<div class="row">
							<label class="col-sm-6">Order ID</label>
							<div class="col-sm-6">{{ $order->order_id }}</div>
						</div>
						<div class="row">
							<label class="col-sm-6">Order By</label>
							<div class="col-sm-6">
								{{ $userName->name }}
								{!! Form::hidden('order_by', Auth::user()->id, ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="widget">
					<div class="widget-content">
						
						<div class="widget-content">
							<table id="example21" class="table table-bordered" cellspacing="0" width="100%">
								<thead>
								<tr>
									<th>Code</th>
									<th>Category</th>
									<th>Name</th>
									<th>Quantity</th>
									<th>Price</th>
								</tr>
								</thead>
								<tbody>
								@php $i = 1; @endphp
								@foreach($products as $product)
									<tr>
										<td>{{ $product->code }}</td>
										<td>{{ $product->category }}</td>
										<td>{{ $product->name }}</td>
										<td>{{ $product->quantity }}</td>
										<td>${{ ($product->price != '')?number_format($product->price, 2):'0.00' }}</td>
									</tr>
								@php $i++; @endphp
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
</form>
<section class="fixed-cbm">
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			Total Qty : <b id="ttlQty">{{ $order->quantity }}</b> &nbsp;&nbsp;&nbsp;
			Total Price : <b id="ttlPrc">${{ number_format($order->price, 2) }}</b>
		</div>
	</div>
</div>
</section>

<style type="text/css">
.fixed-cbm{position: fixed; bottom: 0; right: 0; left: 0; width: 100%; height: 50px; text-align: right; background-color: #363d46; box-shadow: 0 0 10px #ccc; padding: 15px 30px 0 0; z-index: 10}
</style>

<script type="text/javascript">


$(document).ready(function() {
	$('#example21').DataTable( {
		"scrollY": 400,
	} );

});

</script>
@endsection