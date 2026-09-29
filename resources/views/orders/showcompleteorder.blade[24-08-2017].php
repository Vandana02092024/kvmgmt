@extends('layouts.layout')

@section('content')

@php
/*
$vendor 	= session()->get('vendor_id');
$products 	= session()->get('cart.'.$vendor);
*/
@endphp

@php
/*
@if(count($products) <= 0)
	@php $disabled = 'disabled'; @endphp
@else
	@php $disabled = ''; @endphp
@endif


*/
@endphp

@php // echo $disabled @endphp

<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<div class="page-heading">
					<h3 class="heading inline">SUPPLY ORDER</h3>
                	<form class="widget ng-pristine ng-valid" method="POST" action="{{ url('/resendOrder') }}">
                	{{ csrf_field() }}
                	{!! Form::hidden('cart_id', $orderDt[0]->cart_id, ['class' => 'form-control']) !!}
                	{!! Form::hidden('order_id', $order_id, ['class' => 'form-control']) !!}
				</div>
			</div>

			<div class="col-sm-6">
        		{{ link_to_route('order.create','Back','',['class' => 'v-btn v-btn-primary pull-right', 'style' => "margin-left:5px"]) }}

        		<button class="v-btn v-btn-primary pull-right" data-toggle="tooltip" style="margin-left:5px"  data-placement="left" title="Resend Modified order">
            		<span>
            		RESEND ORDER
            		</span>
            	</button>
            	
            	
            	{{ link_to_route('emptyCart','DELETE CART','',['class' => 'v-btn v-btn-primary pull-right', 'style' => "margin-left:5px"]) }}

			</div>

		</form>
		</div>
		@if($message != '')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @endif

		<form class="widget ng-pristine ng-valid" method="POST" action="{{ url('/saveFinalOrder') }}">
		{{ csrf_field() }}

		
		<div class="row">

			<div class="col-sm-6">
				<div class="widget-content">
					<div class="row form-group">
						<label class="col-sm-6">Vendor</label>
						<div class="col-sm-6">
							{{ $orderDt[0]->name }}
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-6">Email</label>
						<div class="col-sm-6">
							{{ $orderDt[0]->email }}
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-6">Phone</label>
						<div class="col-sm-6">
							{{ $orderDt[0]->phone }}
						</div>
					</div>
					<div class="row form-group">
						<label class="col-sm-6">Address</label>
						<div class="col-sm-6">
							{{ $orderDt[0]->address }}
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
							<div class="col-sm-6">{{ $order_id }}</div>
						</div>
						<div class="row">
							<label class="col-sm-6">Delivery Day</label>
							<div class="col-sm-6">{{ $days[$orderDt[0]->delivery_day] }}</div>
						</div>
						<div class="row">
							<label class="col-sm-6">Order By</label>
							<div class="col-sm-6">
								{{ Auth::user()->name }}
								
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="row">
			<div class="col-sm-12 center">
				<div class="widget">
					<div class="widget-content">
						
						<div class="widget-content">
							<table class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
								<tr>
									<th>CODE</th>
									<th>NAME</th>
									<th>CATEGORY</th>
									<th>UNIT</th>
									<th>QUANTITY</th>
									<th>PRICE</th>
									<th>ACTION</th>
								</tr>
								</thead>
								<tbody>
								@php 
									
									$i = 1; 
									$total_qty = 0;
									$total_price = 0;
																		
								@endphp
								@foreach($orderDt as $key => $product)
									<tr id="row{{ $product->id }}">
										<td>{{ $product->code }}</td>
										<td>{{ $product->product_name }}</td>
										<td>{{ $product->category }}</td>
										<td>{{ $product->unit }}</td>
										<td>
											<input type="text" name="qty{{ $product->id }}" id="qty{{ $product->id }}" onchange="order_change({{ $product->id }});" value="{{ $product->quantity }}" class="form-control">
										</td>
										<td id="prc{{ $product->id }}">${{ number_format($product->price, 2) }}</td>
										<td>
											<span class="v-btn v-btn-primary pull-right" data-toggle="tooltip" onclick="order_change({{ $product->id }}, true);" data-placement="left" title="Remove itme from Cart">
					                    		<i class="fa fa-fw fa-trash"></i>
					                    		Delete
					                    		</span>
					                    	</span>
										</td>
									</tr>
									@php 
										$i++; 
										$total_qty += $product->quantity;
										$total_price += $product->price;
									@endphp
								@endforeach
									<tr>
										<td colspan="4" align="right">Total</td>
										<td id="ttlQty">{{ $total_qty }}</td>
										<td id="ttlPrc">${{ number_format($total_price, 2) }}</td>
										<td>&nbsp;</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12 center">
				<div class="widget">
					<div class="widget-content">
						
						<div class="widget-content">
							<table class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
								<tr>
									<td colspan="6" align="center"><h2>Original Order</h2></td>
								</tr>
								<tr>
									<th>CODE</th>
									<th>NAME</th>
									<th>CATEGORY</th>
									<th>UNIT</th>
									<th>QUANTITY</th>
									<th>PRICE</th>
									<th>ACTION</th>
								</tr>
								</thead>
								<tbody>
								@foreach($original_order_detail as $key => $product)
									<tr id="row{{ $product->id }}">
										<td>{{ $product->code }}</td>
										<td>{{ $product->product_name }}</td>
										<td>{{ $product->category }}</td>
										<td>{{ $product->unit }}</td>
										<td>{{ $product->quantity }}</td>
										<td>${{ number_format($product->price, 2) }}</td>
									</tr>
								@endforeach
									<tr>
										<td colspan="4" align="right">Total</td>
										<td>{{ $original_order_detail[0]->ttl_qty }}</td>
										<td>${{ number_format($original_order_detail[0]->ttl_prc, 2) }}</td>
									</tr>
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
<!-- <section class="fixed-cbm">
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			Total Qty : <b id="ttlQty">{{ $total_qty }}</b> &nbsp;&nbsp;&nbsp;
			Total Price : <b id="ttlPrc">${{ number_format($total_price, 2) }}</b>
		</div>
	</div>
</div>
</section> -->

<style type="text/css">
.fixed-cbm{position: fixed; bottom: 0; right: 0; left: 0; width: 100%; height: 50px; text-align: right; background-color: #fff; box-shadow: 0 0 10px #ccc; padding: 15px 30px 0 0; z-index: 10}
</style>

<script type="text/javascript">


$(document).ready(function() {
	// $('#example21').DataTable( {
	// 	"scrollY": 400,
	// } );

dt = $('#example21').DataTable( {
		"scrollY": 400,
		"language": {
		    "search": "Search Category:"
		  },
		"iDisplayLength": 50,
    	"aLengthMenu": [[50, 100, 250, 500, -1], [50, 100, 250, 500, "All"]]
	} );

});


function order_change(i, del = false)
{
	var qty   = $("#qty"+i).val();

	if(del){
		qty = 0;
	}

	$.ajax({
        type:       "POST",
        dataType:   "html",
        url:        "{{ url('/') }}/changeCart",
        data: {id: i, qty: qty },
        success: function(data)
        {
            if(data == 'removed')
            {
            	$('#row'+i).hide();
            	alert("Item removed successfully!");
            }else{
            	var result 		= data.split('|');
	            var product_price = parseFloat(result[2]);
	            var ttlQty = parseInt(result[0]);
	            var ttlPrc = parseFloat(result[1]);

	            product_price 	= product_price.toFixed(2);


				$('#prc'+i).html('$'+addCommas(product_price));
				$("#ttlQty").html(ttlQty);
				$("#ttlPrc").html('$'+addCommas(ttlPrc.toFixed(2)));
            }

            
        }
    });
}


</script>
@endsection