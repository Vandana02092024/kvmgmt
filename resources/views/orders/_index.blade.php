@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<div class="page-heading">
					<h3 class="heading">View orders</h3>
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
				<div class="widget">
					{!! Form::open(array('route' => 'searchOrder')) !!}
            		{{ csrf_field() }}
					<div class="form-container">
					  	<div class="row">
							<form>
							<div class="col-md-6">
								  <div class="form-group col-md-6">
								    <label for="exampleInputName2">Category</label>
								    {{ Form::select('category', $category, null,['class' => 'form-control']) }}
								  </div>
								  <div class="form-group col-md-6">
								    <label for="exampleInputName2">Vendor</label>
								    {{ Form::select('seller', $seller, null,['class' => 'form-control']) }}
								  </div>
								  
								   <div class="form-group col-md-6">
								    <label for="exampleInputName2">Ordered From</label>
								    {!! Form::date('order_from', null, ['class' => 'form-control']) !!}
								</div>

								<div class="form-group col-md-6">
				                   <label for="exampleInputName2">To</label>
				                   {!! Form::date('order_to', null, ['class' => 'form-control']) !!}
								  </div>
							</div>
							<div class="col-md-6">
									<div class="form-group col-md-6">
								    <label for="exampleInputName2">Product Name</label>
								    {!! Form::text('product_name', null, ['class' => 'form-control']) !!}
								  </div>

								  <div class="form-group col-md-6">
								    <label for="exampleInputName2">Order By</label>
								    {{ Form::select('user', $user, null,['class' => 'form-control']) }}
								  </div>
								  
								
								

								  <div class="form-group col-md-6 hide">
								    <label for="exampleInputName2"><!-- Product Code --></label>
								    {!! Form::hidden('product_code', null, ['class' => 'form-control']) !!}
								  </div>
							</div>
							<div class="row col-md-10">
								<button class="v-btn v-btn-primary pull-right">Search</button>
							</div>
							<div class="row col-md-2">
								{{ link_to_route('order.index','Reset',null,['class' => 'v-btn v-btn-primary pull-right']) }} 
							</div>
				           </form>
		                </div>
                    </div>
                	</form>

					<div class="widget-content">
							<div class="widget-content">
								<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							                <th>Order ID</th>
							                <th>Order Date</th>
							                <th>Total Qty</th>
							                <!-- <th>Total Price</th> -->
							                <th>Order By</th>
							                <th>Vendor</th>
							                <th>Status</th>
							                <th>Action</th>
							            </tr>
							        </thead>
							        <tbody>
							            @foreach($orders as $order)
			                            <tr>
			                                <td>{{ $order->order_id }}</td>
			                                <td>{{ $order->order_date }}</td>
			                                <td>{{ $order->quantity }}</td>
			                                <!-- <td>{{ $order->price }}</td> -->
			                                <td>{{ $order->name }}</td>
			                                <td>{{ $order->vname }}</td>
			                                <td>{{ $order->status }}</td>
			                                <td>
			                                    {!! Form::open(array('route' => ['order.destroy', $order->id], 'method'=>'DELETE', 'class' => 'delete')) !!}
			                                        {{ link_to_route('order.show','',[$order->id],['class' => 'fa fa-sign-in','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"View order detail"]) }}
			                                        <!-- |
			                                        {{ link_to_route('order.edit','',[$order->id],['class' => 'fa fa-pencil','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"edit"]) }}
			                                        |
			                                        {{ Form::button('',['class'=>'fa fa-close','type'=>'submit','data-toggle'=>"tooltip", 'data-placement'=>"right", 'title'=>"delete"]) }} -->

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
	$(document).ready(function() {
	    $('#example').DataTable();
	} );

	$(".delete").on("submit", function(){
        return confirm("Do you want to delete this order?");
    });
</script>
@endsection