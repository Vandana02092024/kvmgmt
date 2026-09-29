@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading">SALE
					<a class="v-btn v-btn-primary pull-right bg-light" href="{{ url('/menu') }}">BACK</a>
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">DASHBOARD</a>
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/sale/create') }}">NEW SALE</a>
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
					<div class="widget-content">
							<div class="responsive-table">
								<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							                <th>NAME</th>
							                							                
							                <th>ACTION</th>
							            </tr>
							        </thead>
							        <tbody>
							            @foreach($sales as $sale)
			                            <tr>
			                                <td>{{ $sale->name }}</td>
			                                                               
			                                <td>
			                                    {!! Form::open(array('route' => ['sale.destroy', $sale->id], 'method'=>'DELETE', 'class' => 'delete')) !!}
			                                        
			                                        {{ link_to_route('sale.edit','',[$sale->id],['class' => 'fa fa-pencil','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"edit"]) }}
													
													|
													
													{{ link_to_route('sale.archive',$sale->status == 1 ?'Archive' :'Unarchive',['sale' => $sale->id, 'st' => $sale->status]) }}
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
	    $('#example').DataTable({
  "ordering": false
});
	} );

	$(".delete").on("submit", function(){
        return confirm("Do you want to delete this user?");
    });
</script>
@endsection