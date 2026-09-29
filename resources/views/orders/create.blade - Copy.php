@extends('layouts.layout')

@section('content')

<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading inline">New Supply Order</h3>
					
				</div>
			</div>
		</div>
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

		<form class="widget ng-pristine ng-valid" method="POST" action="{{ url('/order') }}">
		{{ csrf_field() }}
		
		<div class="row">

			<div class="col-sm-6">
				<div class="widget-content">
					<div class="row form-group">
						<label class="col-sm-6">Vendor</label>
						<div class="col-sm-6">
							{{ Form::select('vendor', $seller, null,['class' => 'form-control', 'id' => 'sellerid']) }}
						</div>
					</div>
					<div id="divshow">
						
					</div>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="widget">
					<div class="widget-content">
						<div class="row">
							<label class="col-sm-6">Order Date</label>
							<div class="col-sm-6">{{ date('Y-m-d', time()) }}</div>
						</div>
						<div class="row hide">
							<label class="col-sm-6">Order ID</label>
							<div class="col-sm-6">MMSD-232</div>
						</div>
						<div class="row">
							<label class="col-sm-6">Order By</label>
							<div class="col-sm-6">
								{{ Auth::user()->name }}
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
							<table id="example21" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
										<td><input type="text" name="qty{{ $i }}" id="qty{{ $i }}" onblur="order_change({{ $i }});" class="form-control"></td>
										<td id="prc{{ $i }}">{{ ($product->price != '')?$product->price:'0.00' }}</td>
										{!! Form::hidden('actPrc'.$i, $product->price, ['class' => 'form-control', 'id' => 'actPrc'.$i]) !!}
										{!! Form::hidden('prdId'.$i, $product->id, ['class' => 'form-control']) !!}
									</tr>
								@php $i++; @endphp
								@endforeach
								</tbody>
							</table>
						</div>
						<div class="widget-footer"></div>
						<div class="row form-group">
							<div class="col-sm-12">
								{!! Form::hidden('rows_count', $i, ['class' => 'form-control']) !!}
								<button class="v-btn v-btn-primary pull-right">Create Order</button>
							</div>
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
			Total Qty - <b id="ttlQty">0</b> &nbsp;&nbsp;&nbsp;
			Total Price - <b id="ttlPrc">0.00</b>
		</div>
	</div>
</div>
</section>

<style type="text/css">
.fixed-cbm{position: fixed; bottom: 0; right: 0; left: 0; width: 100%; height: 50px; text-align: right; background-color: #fff; box-shadow: 0 0 10px #ccc; padding: 15px 30px 0 0; z-index: 10}
</style>

<script type="text/javascript">


$(document).ready(function() {
	$('#example21').DataTable( {
		"scrollY": 400,
	} );

	// $( function() {
	//     $( ".datepicker" ).datepicker();
	// } );

	var seller_id = $('#sellerid option:first-child').val();
	seller_info(seller_id);

	$('#sellerid').on('change', function(event){
		seller_info($(this).find(":selected").val());
	});

});

function seller_info(id)
{
    $.ajax({
        type:       "POST",
        dataType:   "html",
        url:        "{{ url('/') }}/showSeller",
        data: {sellerId: id},
        success:    function(data)
        {
            // alert(data);
            $("#divshow").html(data);
        }
    });
}



function order_change(i)
{
	var sumqty = 0;
	var sumprc = 0;
    var price 	 = $("#actPrc"+i).val();
    var quantity = $("#qty"+i).val();

	var ttlrow = {{ count($products) }};

    price   	= ((price == '') || (isNaN(price)))?0:parseFloat(price);
    quantity    = ((quantity == '') || (isNaN(quantity)))?0:parseInt(quantity);

    product_price = parseFloat(quantity * price);
    product_price = product_price.toFixed(2);

    // alert(quantity);
    // alert(price);
    // alert(product_price);

    $('#prc'+i).html(product_price);

    // $('input[type=text]').each(function() {
    // 	quantity = $(this).val();
    // 	sumqty += ((quantity == '') || (isNaN(quantity)))?0:parseInt(quantity);
    // });

	for (var x = 1; x <= ttlrow; x++)
	{
		price 	 = $("#actPrc"+x).val();
   		quantity = $("#qty"+x).val();

   		price 	 = ((price == '') || (isNaN(price)))?0:parseFloat(price);
   		quantity = ((quantity == '') || (isNaN(quantity)))?0:parseInt(quantity);

		sumqty += quantity;
		sumprc += (quantity * price);
	};

    

    // fttlcbm = fttlcbm.toFixed(2);
    $("#ttlQty").html(sumqty);
    $("#ttlPrc").html(sumprc);


}

</script>
@endsection