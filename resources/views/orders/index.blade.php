@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading"> <a class="v-btn v-btn-primary " style="margin-right:8px" href="{{ url('/menu/create')  }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a> SUPPLY ORDERS
					
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">MENU</a>
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/order/create') }}">NEW ORDER</a>
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

			<div class="col-sm-12 col-xs-12">
				<div class="widget">
					{!! Form::open(array('route' => 'searchOrder')) !!}
            		{{ csrf_field() }}
					<div class="form-container" style="padding-top:13px;">
					  	<div class="row">
							<form>
							<div class="col-md-6">
								  <div class="form-group col-md-6">
								    <label for="exampleInputName2">CATEGORY</label>
								    {{ Form::select('category', $category, null,['class' => 'form-control']) }}
								  </div>
								  <div class="form-group col-md-6">
								    <label for="exampleInputName2">VENDOR</label>
								    {{ Form::select('seller', $seller, null,['class' => 'form-control']) }}
								  </div>
								  
								   <div class="form-group col-md-6">
								    <label for="exampleInputName2">ORDERED FROM</label>
								    {!! Form::text('order_from', null, ['class' => 'form-control dp']) !!}
								</div>

								<div class="form-group col-md-6">
				                   <label for="exampleInputName2">TO</label>
				                   {!! Form::text('order_to', null, ['class' => 'form-control dp']) !!}
								  </div>
							</div>
							<div class="col-md-6">
									<div class="form-group col-md-6">
								    <label for="exampleInputName2">PRODUCT NAME</label>
								    {!! Form::text('product_name', null, ['class' => 'form-control']) !!}
								  </div>

								  <div class="form-group col-md-6">
								    <label for="exampleInputName2">ORDER BY</label>
								    {{ Form::select('user', $user, null,['class' => 'form-control']) }}
								  </div>
								  
								
								

								  <div class="form-group col-md-6 hide">
								    <label for="exampleInputName2"><!-- Product Code --></label>
								    {!! Form::hidden('product_code', null, ['class' => 'form-control']) !!}
								  </div>
							</div>
							<div class="row col-md-12 col-xs-12">
								{{ link_to_route('order.index','RESET',null,['class' => 'v-btn v-btn-primary pull-right', 'style' => 'margin-left:5px']) }} 
								<button class="v-btn v-btn-primary pull-right">SEARCH</button>
							</div>
							
				           </form>
		                </div>
                    </div>
                	</form>

					<div class="widget-content">
							<div class="responsive-table">
								<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							                <th>ORDER ID</th>
							                <th>ORDER DATE</th>
							                <th>TOTAL QTY</th>
							                <!-- <th>Total Price</th> -->
							                <th>ORDER BY</th>
							                <th>VENDOR</th>
							                <th>STATUS</th>
							                <th>ACTION</th>
							            </tr>
							        </thead>
							        <tbody>
							            @foreach($orders as $order)
			                            <tr>
			                                <td>{{ $order->order_id }}</td>
			                                <td>{{ date('m/d/Y',strtotime($order->order_date)) }}</td>
			                                <td>{{ $order->quantity }}</td>
			                                <!-- <td>{{ $order->price }}</td> -->
			                                <td>{{ $order->name }}</td>
			                                <td>{{ $order->vname }}</td>
			                                <td>{{ $order->status }}</td>
			                                <td>
			                                    {!! Form::open(array('route' => ['order.destroy', $order->id], 'method'=>'DELETE', 'class' => 'delete')) !!}
			                                        {{ link_to_route('order.show','',[$order->id],['class' => 'fa fa-sign-in','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"View order detail"]) }}
			                                        <!-- |
			                                        {{ link_to_route('order.edit','',[$order->id],['class' => 'fa fa-pencil','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"edit"]) }}-->
													@if(Auth::user()->role == 'Owner')
			                                        |
			                                        {{ Form::button('',['class'=>'fa fa-close','type'=>'submit','data-toggle'=>"tooltip", 'data-placement'=>"right", 'title'=>"delete"]) }} 
													@endif
			                                    {!! Form::close() !!}
			                                     
			                                </td>
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

<script type="text/javascript">
	$(".dp").datepicker({
	    format: 'mm/dd/yyyy',
	}).attr('readonly', 'readonly');

	$(document).ready(function() {
	    $('#example').DataTable({"aaSorting": []});
	} );

	$(".delete").on("submit", function(){
        return confirm("Do you want to delete this order?");
    });
</script>
@endsection