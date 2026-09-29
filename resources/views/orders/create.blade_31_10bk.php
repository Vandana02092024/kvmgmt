@extends('layouts.layout')

@section('content')
<style type="text/css">
.dataTables_filter {
   /*float: left;
   text-align: right;*/

   display: none;
}
</style>


@if((session()->has('vendor_id')) and (session()->get('vendor_id') > 0))
	@php 
		$vendorid = session()->get('vendor_id');
		$readonly = ''; 
		$disabled = '';
	@endphp
@else
	@php 
	$readonly = 'readonly';
	$disabled = 'disabled';
	$vendorid = 0;
	@endphp
@endif


<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading inline">NEW SUPPLY ORDER</h3>
                	<form class="pull-right inline" method="POST" action="{{ url('/showOrder') }}">
                	{{ csrf_field() }}
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/order') }}">BACK</a>
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">DASHBOARD</a>
                	<button class="v-btn v-btn-primary pull-right" data-toggle="tooltip" data-placement="left" title="Show Cart">
                		<i class="fa fa-fw fa-shopping-cart"></i>
                		CART : 
                		<span id="itemCount">

                		<!-- @if(session()->has('cart.'.$vendorid))
                			@php echo count(session()->get('cart.'.$vendorid)); @endphp
                		@else
                			0
                		@endif -->

                		@php
                		// print_r($cart);
                		@endphp

                		{{ $cart['cart_count'] or '' }}
                		ITEM(S)
                		</span>
                	</button>
                	</form>
	                    
				</div>
			</div>
		</div>
		
		<br />
		
		@if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif

        @if(Session::has('warning'))
            <div class="alert alert-warning">
                {{ Session::get('warning') }}
            </div>
        @endif

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

		<form class="widget ng-pristine ng-valid" id="vendorSelForm" method="POST" action="{{ url('/changeVendor') }}">
		{{ csrf_field() }}
		
		<div class="row">

			<div class="col-sm-6">
				<div class="widget-content">
					<div class="row form-group">
						<label class="col-sm-6">VENDOR</label>
						<div class="col-sm-6">
							{{ Form::select('vendor', $seller, $vendorSel,['class' => 'form-control', 'id' => 'sellerid']) }}
						</div>
					</div>
					<!-- <div id="divshow">
						
					</div> -->
					<!-- <div class="row form-group"> -->
						<!-- <label class="col-sm-6">CATEGORY</label> -->
						<!-- <div class="col-sm-6" id="searchCategory"> -->
							<!-- {{ Form::text('category', null,['class' => 'form-control', 'id' => 'categoryid']) }} -->
						<!-- </div> -->
					<!-- </div> -->
					
					
					<div class="row form-group"> 
						<label class="col-sm-6">CATEGORY</label>
						
						<div class="col-sm-6" id="searchCategory"> 
							
							{{ Form::select('category', $categories, $catgorySel,['class' => 'form-control', 'id' => 'categoryid']) }}
						</div> 
					 </div> 
					
				</div>
			</div>

			<div class="col-sm-6">
				<div class="widget">
					<div class="widget-content">
						<div class="row">
							<label class="col-sm-6">ORDER DATE</label>
							<div class="col-sm-6">{{ date('m/d/Y', time()) }}</div>
						</div>
						
						<div class="row hide">
							<label class="col-sm-6">ORDER ID</label>
							<div class="col-sm-6">MMSD-232</div>
						</div>
						<br />
						<div class="row">
							<label class="col-sm-6">ORDER BY</label>
							<div class="col-sm-6">
								{{ Auth::user()->name }}
								{!! Form::hidden('order_by', Auth::user()->id, ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>

		</form>


		<div class="row">
			<div class="col-sm-12">
				<div class="widget">
					<div class="widget-content">
						
						<div class="widget-content">
							
							<table id="example21" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
								@php $i = 1; @endphp
								@foreach($products as $product)
									<tr>
										<td>{{ $product->code }}</td>
										<td>{{ $product->name }}</td>
										<td>{{ $product->category }}</td>
										<td>{{ $product->unit }}</td>
										<td><input type="text" name="qty{{ $i }}" id="qty{{ $i }}" onchange="order_change({{ $i }});" value="0" @php echo $readonly @endphp class="form-control"></td>
										<td id="prc{{ $i }}">${{ ($product->price != '')?number_format($product->price, 2):'$0.00' }}</td>
										<td>
											<button class="v-btn v-btn-primary pull-right" id="add_to_cart-{{ $i }}" onclick="add_to_cart({{ $i }});" @php echo $disabled @endphp>Add to Cart</button>
										</td>
										{!! Form::hidden('actPrc'.$i, $product->price, ['class' => 'form-control', 'id' => 'actPrc'.$i]) !!}
										{!! Form::hidden('prdId'.$i, $product->id, ['class' => 'form-control', 'id' => 'prdId'.$i]) !!}
										{!! Form::hidden('prdNm'.$i, $product->name, ['class' => 'form-control', 'id' => 'prdNm'.$i]) !!}
										{!! Form::hidden('prdCd'.$i, $product->code, ['class' => 'form-control', 'id' => 'prdCd'.$i]) !!}
										{!! Form::hidden('prdCt'.$i, $product->category, ['class' => 'form-control', 'id' => 'prdCt'.$i]) !!}
										{!! Form::hidden('prdUt'.$i, $product->unit, ['class' => 'form-control', 'id' => 'prdUt'.$i]) !!}
									</tr>
								@php $i++; @endphp
								@endforeach
								</tbody>
							</table>
						</div>
						<div class="widget-footer"></div>
						<div class="row form-group">
							<div class="col-sm-12">
								<!-- {!! Form::hidden('rows_count', $i, ['class' => 'form-control']) !!}
								<button class="v-btn v-btn-primary pull-right">Create Order</button> -->
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
	</div>
</section>

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


// $(document).ready(function() {
// 	dt = $('#example21').DataTable( {
// 		"scrollY": 400,
// 		"language": {
// 		    "search": "Search Category:"
// 		  },
// 		"iDisplayLength": 50,
//     	"aLengthMenu": [[50, 100, 250, 500, -1], [50, 100, 250, 500, "All"]]
// 	} );
// 	$("#categoryid").on("keyup search input paste cut", function() {
// 	   dt.search(this.value).draw();
// 	});  


// 	// var seller_id = $('#sellerid option:first-child').val();
// 	// seller_info(seller_id);

// 	$('#sellerid').on('change', function(event){
// 		// seller_info($(this).find(":selected").val());
// 		$("#vendorSelForm").submit();
// 	});

// });

$(document).ready(function() {
   var dt = $('#example21').DataTable({
    	"scrollY": 400,
		"language": {
		    "search": "Search Category:"
		  },
		
		"aaSorting": [1, 'asc'],
		"iDisplayLength": 50,
    	"aLengthMenu": [[50, 100, 250, 500, -1], [50, 100, 250, 500, "All"]],
        initComplete: function () { 
			/*	this.api().columns([2]).every( function () {
                var column = this;
				var select = $('<select class="form-control"><option value="">- All -</option></select>')
                    .appendTo( $('#searchCategory').empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
						column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    });
		
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
        			// if(column.search() === '^CHEMICALS$'){
				    //     select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
				    // } else {
				    //     select.append( '<option value="'+d+'">'+d+'</option>' )
				    // }
                });
				
            }); */
			
        }
    });

	$('#searchCategory').change(function(){
         dt
        .columns(2)
        .search($("#searchCategory :selected").val())
        .draw();
    });
	
	$('#sellerid').on('change', function(event){
		// seller_info($(this).find(":selected").val());
		var vendorID = $('#sellerid').val();
		$.ajax({
			type:       "POST",
			dataType:	 "json",
			url:        "{{ url('/') }}/showCategory",
			data: {vendorID: vendorID},
			success: function(data)
			{	
				$("#searchCategory").html(data['categories']);
				$("#itemCount").html(data['cart_count']+' Item(s)');
			}
		});
		//$("#vendorSelForm").submit();
	});
	$('#searchCategory').on('change', function(event){
		$("#vendorSelForm").submit();
	});
		
});





function seller_info(id)
{
    $.ajax({
        type:       "POST",
        dataType:   "html",
        url:        "{{ url('/') }}/showSeller",
        data: {sellerId: id},
        success: function(data)
        {
            $("#divshow").html(data);
        }
    });
}


function add_to_cart(i)
{
	
	var qty   = $("#qty"+i).val();
	
	if(qty == 0){
		alert("Please Select Quantity");
		return false;
	}
	
	var id 	  = $("#prdId"+i).val();
	var name  = $("#prdNm"+i).val();
	var price = $("#actPrc"+i).val();
	var prdCd = $("#prdCd"+i).val();
	var prdCt = $("#prdCt"+i).val();
	var prdUt = $("#prdUt"+i).val();

	$.ajax({
        type:       "POST",
        dataType:   "html",
        url:        "{{ url('/') }}/addToCart",
        data: {id: id, qty: qty, name: name, price: price, prdCd: prdCd, prdCt: prdCt, prdUt: prdUt },
		beforeSend: function() {
			// setting a timeout
			$("#add_to_cart-"+i).css('display','none');
			//$("#add_to_cart-"+i).attr("disabled", true);
			$("button#add_to_cart-"+i).css('background-color','#e4dbdb');
		},
        success:    function(data)
        {
        	$("#add_to_cart-"+i).css('display','block');
			//$("#add_to_cart-"+i).attr("disabled", false);
			//$("button#add_to_cart-"+i).css('background-color','#272727');
            $("#itemCount").html(data+' Item(s)');
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

    $('#prc'+i).html('$'+product_price);

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

   		price = price * quantity;
		sumqty += quantity;
		sumprc += price;
	};

    

    sumprc = sumprc.toFixed(2);
    $("#ttlQty").html(sumqty);
    $("#ttlPrc").html('$'+sumprc);


}
</script>
@endsection