@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading"> <a class="v-btn v-btn-primary " style="margin-right:8px" href="{{ url('/menu') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a> LOCATIONS
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">MENU</a>
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/location/create') }}">NEW LOCATION</a>
									<a href="{{url('/asign_loaction')}}"class="v-btn v-btn-primary pull-right" > Menu Asign</a>
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
							                <th>RANK</th>
							                <th>LOCATION CODE</th>
							                <th>LOCATION</th>
							                <th>ACTION</th>
							            </tr>
							        </thead>
							        <tbody>
							            @foreach($locations as $location)
			                            <tr>
			                                <td>{{ $location->rank }}</td>
			                                <td>{{ $location->location_code }}</td>
			                                <td>{{ $location->location }}</td>
											<td>
			                                    {!! Form::open(array('route' => ['location.destroy', $location->id], 'method'=>'DELETE', 'class' => 'delete')) !!}

			                                        {{ link_to_route('location.edit','',[$location->id],['class' => 'fa fa-pencil','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"edit"]) }}

													|

													{{ link_to_route('location.archive',$location->status == 1 ?'Archive' :'Unarchive',['location' => $location->id, 'st' => $location->status]) }}
													|
													<a href="{{url('/asign_loaction/'.$location->id)}}"> Menu Asign</a>

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
			"aaSorting": []
		});
	} );
	$(".delete").on("submit", function(){
        return confirm("Do you want to delete this location?");
    });
</script>
@endsection
