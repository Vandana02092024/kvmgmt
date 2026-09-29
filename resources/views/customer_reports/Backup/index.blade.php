@extends('layouts.layout')

@section('content')
<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading">VIEW PROBLEM REPORTS</h3>
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">BACK</a>
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">DASHBOARD</a>
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/report/create') }}">CREATE NEW REPORT</a>
	                <br /> 
				</div>
			</div>
		</div>



		@if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif

        <!-- <div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="widget">
					<div class="widget-content">
						<div class="responsive-table" id="showFilter">
							<table class="table table-striped table-bordered" cellspacing="0" width="100%">
						        <thead>
						        	<tr>	
										<td colspan="7">Filter</td>
						            </tr>
						        	<tr>	
										<td>#</td>
						                <td>Customer</td>
						                <td>Problem</td>
						                <td>Missing / Damaged <br /> Date</td>
						                <td>Claim Check</td>
						                <td>Status</td>
						                <td>Action</td>
						            </tr>
						            <tr>	
										<th id="showFil1">#</th>
						                <th id="showFil2">Customer</th>
						                <th id="showFil3">Problem</th>
						                <th id="showFil4">Missing / Damaged <br /> Date</th>
						                <th id="showFil5">Claim Check</th>
						                <th id="showFil6">Status</th>
						                <th id="showFil7">Action</th>
						            </tr>
						        </thead>
						    </table>
						</div>
					</div>
				</div>
			</div>
		</div> -->
        
		<div class="row">
			<div class="col-sm-12">
				<div class="widget">

					{!! Form::open(array('route' => 'searchReport')) !!}
            		{{ csrf_field() }}
					<div class="form-container" style="padding-top:13px;">
					  	<div class="row">

							        	
							<div class="col-md-12">
								  <div class="form-group col-md-3">
								    <label for="exampleInputName2">Problem</label>
								    {{ Form::select('problem', $problem, null,['class' => 'form-control']) }}
								  </div>

								  

								<div class="form-group col-md-3">
								    <label for="exampleInputName2">Date From</label>
								    {!! Form::text('filled_from', null, ['class' => 'form-control dp']) !!}
								</div>

								<div class="form-group col-md-3">
				                   <label for="exampleInputName2">To</label>
				                   {!! Form::text('filled_to', null, ['class' => 'form-control dp']) !!}
								</div>

								<div class="form-group col-md-3">
								    <label for="exampleInputName2">Status</label>
								    {{ Form::select('status', $status, null,['class' => 'form-control']) }}
								</div>
							</div>
							
							<div class="row col-md-12 col-xs-12">
								{{ link_to_route('report.index','Reset',null,['class' => 'v-btn v-btn-primary pull-right', 'style' => 'margin-left:5px']) }} 
								<button class="v-btn v-btn-primary pull-right">Search</button>
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
							                <th>Report ID#</th>
							                <th>Customer</th>
							                <th>Problem Type</th>
							                <th>Submitted Date</th>
							                <th>Status</th>
							                <th>Action</th>
							            </tr>
							        </thead>
							        <tbody>

							            @foreach($reports as $report)
			                            <tr>
			                                <td>
			                                	{{ link_to_route('report.edit','RPT_'.$report->id,[$report->id],['data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"edit"]) }}
			                                </td>
			                                <td>{{ $report->customer_name.' '.$report->customer_last_name }}</td>
			                                <td>{{ $report->problem }}</td>
			                                <td>{{ date('m/d/Y', strtotime($report->filled_date)) }}</td>
			                                <td>{{ ($report->resolution == 1)?'Closed':(($report->resolution == '')?'Open':'Closed') }}</td>
			                                <td>
			                                    {!! Form::open(array('route' => ['report.destroy', $report->id], 'method'=>'DELETE', 'class' => 'delete')) !!}
			                                        
			                                        {{ link_to_route('report.edit','',[$report->id],['class' => 'fa fa-pencil','data-toggle'=>"tooltip", 'data-placement'=>"left", 'title'=>"edit"]) }}
			                                        
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
	    $('#example').DataTable();
	} );
	// column.header()
// $(document).ready(function() {
//     $('#example').DataTable( {
//         initComplete: function () {
//         	var i=1;
//             this.api().columns().every( function () {
//                 var column = this;
//                 var select = $('<select><option value=""></option></select>')
//                     .appendTo( $('#showFil'+i).empty() )
//                     .on( 'change', function () {
//                         var val = $.fn.dataTable.util.escapeRegex(
//                             $(this).val()
//                         );
 
//                         column
//                             .search( val ? '^'+val+'$' : '', true, false )
//                             .draw();
//                     } );
 
//                 column.data().unique().sort().each( function ( d, j ) {
//                     select.append( '<option value="'+d+'">'+d+'</option>' )
//                 } );
//                 i++;
//             } );
//         }
//     } );
// } );

	$(".delete").on("submit", function(){
        return confirm("Do you want to delete this user?");
    });
</script>
@endsection