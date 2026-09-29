@extends('layouts.layout')

@section('content')
<style type="text/css">
	.loading-buffering{
        background: url("{{asset('img/loading.gif')}}") no-repeat center center;
        background-size: 20px 20px;
    }
</style>
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading"> <a class="v-btn v-btn-primary " style="margin-right:8px" href="{{ url('/menu') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a>PRODUCT
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">MENU</a>
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/product/create') }}">NEW PRODUCT</a>
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
				<div class="widget">
					<div class="widget-content">
						<div class="responsive-table">
							<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						        <thead>
						            <tr>
										<th>RANK</th>
						                <th>CODE</th>
						                <th>PRODUCT NAME</th>
						                <th>CATEGORY</th>
						                <th>VENDOR</th>
						                <th>UNIT</th>
						                <th>PRICE</th>
						                <th>ACTION</th>
						            </tr>
						        </thead>
						        <tbody>
						            @foreach($products as $product)
		                            <tr>
										<td>{{ $product->rank }}</td>
		                                <td>{{ $product->code }}</td>
		                                <td>{{ $product->name }}</td>
		                                <td>{{ $product->category }}</td>
		                                <td>{{ $product->vname }}</td>

		                                <td>{{ $product->unit }}</td>
		                                <td> <input type="text" name="price" idval="{{ $product->id }}" value="{{ $product->price }}" size="4" onchange="getPmtMethod(this)"></td>
		                                <td>
		                                    {!! Form::open(array('route' => ['product.destroy', $product->id], 'method'=>'DELETE', 'class' => 'delete')) !!}

		                                        {{ link_to_route('product.edit','',[$product->id],['class' => 'fa fa-pencil','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"edit"]) }}

		                                        |

												{{ link_to_route('product.proArchive',$product->status == 1 ?'Archive' :'Unarchive',['product'=>$product->id, 'st' => $product->status]) }}

		                                        <!-- |
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
	var tbl=$('#example').DataTable({
				 stateSave: true,
			"aaSorting": []
			});

	});

	$(".delete").on("submit", function(){
        return confirm("Do you want to delete this product?");
    });


    function getPmtMethod(e)
    {
        var price 	= $(e).val();
        var id 		= $(e).attr('idVal');
        $(e).attr('class', 'loading-buffering');
        $.ajax({
            url : "{{ route( 'update-product-price' ) }}",
            data: {
                "_token" : "{{ csrf_token() }}",
                "price" : price,
                "id" : id,
            },
            type    : 'post',
            dataType: 'json',
            success: function( result )
            {
                if(result['result'] == 1)
                	$(e).attr('class', '');
                else
                {
                	$(e).attr('class', '');
                	alert("There is some issue while changing record. Please reload the page and try again later.");
                }
            },
            error: function()
            {
                //handle errors
                alert('error...');
            }
        });
    }
</script>
@endsection
