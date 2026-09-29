@extends('layouts.layout')

@section('content')
<!-- <link media="all" type="text/css" rel="stylesheet" href="https://kvmgmt.com/plugins/datatable/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs jqueryui/1.12.1/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link rel="stylesheet" href="https://kvmgmt.com/css/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="https://kvmgmt.com/js/bootstrap-multiselect.js"></script>
<link type="text/css" rel="stylesheet" href="https://kvmgmt.com/css/custom.css">


<section id="dashboard-page" class="wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-heading">
					<h3 class="heading"> <a class="v-btn v-btn-primary " style="margin-right:8px" href="{{ url('/service') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a>SALES REPORTING
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">MENU</a>
                	
					</h3>
	                <br /> 
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="widget">
					<div class="widget-content">
						<form class="widget ng-pristine ng-valid" method="POST" action="{{ url('/reportingsection') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
						<div class="form-group row">
							<div class="col-md-12 text-center">
								<input class="v-btn v-btn-primary mt-20" type="submit" name="submit" id="submit_alert" value="Submit">
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	
				
			</div>

</section>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script type="text/javascript">
	


@endsection