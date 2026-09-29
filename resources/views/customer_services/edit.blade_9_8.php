@extends('layouts.layout')

@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script type="text/javascript">
$(function() {
   $("input[name='csr_type']").click(function() {
     if ($("#pri").is(":checked")) {
       $("#dvPRI").show();
     } else {
       $("#dvPRI").hide();
     }
   });
 });




</script>
<script type="text/javascript">
$(function() {
$('#divarea1').hide();
$('#type').change(function(){
        if($('#type').val() == 'DIV Area 2') {
            $('#divarea1').show(); 
        } else {
            $('#divarea1').hide(); 
        } 
    });
});
</script>
<script type="text/javascript">
 $(document).ready(function(){
    $('input.timepicker').timepicker({});

	if($("#pri").is(":checked")) {
		$("#dvPRI").show();
	}
});
</script>
<div class="container-fluid">

		<div class="row">

			<div class="col-sm-12">

				<div class="page-heading">

					<h3 class="heading">CUSTOMER SERVICE REPORT(CSR)</h3>
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/service') }}">BACK</a>
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">DASHBOARD</a>
                	<a class="v-btn v-btn-primary pull-right" href="{{ url('/service/create') }}">CREATE NEW CSR</a>
	                <br /> 
				</div>

			</div>

		</div>


		<div class="row">

			<div class="col-sm-12">

				<div class="widget form-layout">

					<div class="widget-content no-padding">

						{!! Form::model($service, array('route' => ['service.update', $service->id], 'method' => 'PUT')) !!}
						{{ csrf_field() }}

							<div class="main-detail csr_container">
							   <div class="form-group row{{ $errors->has('csr_type') ? ' has-error' : '' }}">
							   	  <div class="">
							   	  	<div class="col-md-2">
										<label class="radio-inline">
										  <input type="radio" id="csp" name="csr_type" checked value="0" {{ $service->csr_type == 0 ? 'checked' : '' }}>New CSP
										</label>

										@if ($errors->has('csr_type'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('csr_type') }}</strong>
	                                        </span>
	                                    @endif

									</div>
									<div class="col-md-2">
										<label class="radio-inline">
										  <input type="radio" id="pri" name="csr_type" {{ $service->csr_type == 1 ? 'checked' : '' }} value="1">Problem Report Id
										</label>
								    </div>
									<div id="dvPRI" class="col-md-8{{ $errors->has('report_id') ? ' has-error' : '' }}" style="display: none">
									    {{ Form::select('report_id', $reportIds, null, ['class' => 'selectlist form-control col-md-5']) }}

									    @if ($errors->has('report_id'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('report_id') }}</strong>
	                                        </span>
	                                    @endif

									    <div id="divarea1" class="col-md-7" style="display: none;">
									    	  <label class="col-md-5">Claim Id</label>
	                                          <input type="text" name="claim_id" class="col-md-7">
									    </div>
					

									</div>

							   	  </div>
							   </div>	
                               <div class="divider"></div>     
								<div class="form-group row">
									<div class="col-md-6">
										<div class="form-group row">
	                                          <label class="col-sm-4">CREATED BY</label>
	                                          <div class="col-sm-8">
	                                          	{{ $created_by->name }}
	                                          </div>
                             
										</div>
										<div class="form-group row">
											
	                                          <label class="col-sm-4">CREATED ON</label>
	                                          <div class="col-sm-8">
											  
	                                          	 {{ date('m/d/Y H:i A', time()) }}
	                                          </div>
                                        </div>
	                                       
                                      
                                        <div class="form-group row{{ $errors->has('csr_type') ? ' has-error' : '' }}">
	                                        
	                                          <label class="col-sm-4">NOTES</label>
	                                          <div class="col-sm-8">
	                                          	{!! Form::textarea('notes', $viewData['notes'], ['class' => 'form-control', 'rows' => 3]) !!}
	                                          	@if ($errors->has('notes'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('notes') }}</strong>
			                                        </span>
			                                    @endif
	                                          </div>
	                                        
	                                    </div>
										
										<div class="form-group row{{ $errors->has('status') ? ' has-error' : '' }}">
	                                          <label class="col-sm-4">Status</label>
	                                          <div class="col-sm-8">
	                                          	<select name="status" class="form-control"  id="status_id">
	                                          		<option value="">- Status -</option>
	                                          		<option value="1" {{ $viewData['status'] == '1' ? 'selected' : '' }}>Forwarded</option>
	                                          		<option value="2" {{ $viewData['status'] == '2' ? 'selected' : '' }}>Closed</option>
	                                          		
	                                          	</select>
	                                          	@if ($errors->has('status'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('status') }}</strong>
			                                        </span>
			                                    @endif
	                                          </div>
                             
										</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row{{ $errors->has('followup_by') ? ' has-error' : '' }}">
	                                          <label class="col-sm-4">FOLLOW-UP BY</label>
	                                          <div class="col-sm-8">
	                                          	{{ Form::select('followup_by', $users, $viewData['followup_by'], ['class' => 'form-control followup']) }}
	                                          	@if ($errors->has('followup_by'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('followup_by') }}</strong>
			                                        </span>
			                                    @endif
	                                          </div>
                             
										</div>
										<div class="form-group row{{ ($errors->has('followup_date') or $errors->first('followup_time')) ? ' has-error' : '' }}">
											
	                                          <label class="col-sm-4">FOLLOW-UP ON</label>
	                                          <div class="col-sm-4">
	                                          	{!! Form::text('followup_date', $viewData['followup_date'], ['class' => 'form-control dp followup']) !!}
												
	                                          	@if ($errors->has('followup_date'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('followup_date') }}</strong>
			                                        </span>
			                                    @endif
	                                          </div>
	                                          <div class="col-sm-4">
	                                          	{!! Form::text('followup_time',date("h:i A", strtotime($viewData['followup_time'])), ['class' => 'timepicker form-control followup']) !!}
	                                          	 @if ($errors->has('followup_time'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('followup_time') }}</strong>
			                                        </span>
			                                    @endif
	                                          </div>
	                                          
                                        </div>
	                                       
                                      
                                        <div class="form-group row">
	                                        
	                                          <label class="col-sm-4 ">FOLLOW-UP NOTES</label>
	                                          <div class="col-sm-8  ">
	                                          	{!! Form::textarea('followup_notes', $viewData['followup_notes'], ['class' => 'form-control followup', 'rows' => 3]) !!}
	                                          </div>
	                                        
	                                    </div>
										
										<div class="form-group row{{ $errors->has('mode_of_contact') ? ' has-error' : '' }}">
	                                          <label class="col-sm-4">MODE OF CONTACT</label>
	                                          <div class="col-sm-8">
	                                          	<select name="mode_of_contact" class="form-control followup">
	                                          		<option value="">- Select Mode Of Contact -</option>
													
	                                          		<option value="1" @if( $viewData['mode_of_contact'] == '1' ) selected="selected"; @endif>Email</option>
													<option value="2" @if( $viewData['mode_of_contact'] == '2' ) selected="selected"; @endif>Text</option>
													<option value="3" @if( $viewData['mode_of_contact'] == '3' ) selected="selected"; @endif>Call</option>
													
	                                          	</select>
	                                          	@if ($errors->has('mode_of_contact'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('mode_of_contact') }}</strong>
			                                        </span>
			                                    @endif
	                                          </div>
                             
										</div>
	                                    
										<div class="form-group row">
											<div class="col-md-12">
												<button class="v-btn v-btn-primary add-btn pull-right">UPDATE</button>
											</div>
										</div>

                                    </div>
                                </div>

							</div>
							
									

						</form>

					</div>

						

				</div>

			</div>

		</div>

	</div>
	<script type="text/javascript">
	$(".dp").datepicker({

        format: 'mm/dd/yyyy',
        minDate: 0

    }).attr('required','required');
	
	$( document ).ready(function() {
		
		if($('#status_id').val() == '2') {
			
			$(".followup").attr("disabled", "disabled"); 
		}else if($('#status_id').val() == '1'){
			$(".followup").attr("required",true);
		   $(".followup").removeAttr("disabled");
		}
		
	$( "#status_id" ).change(function() {
	  var value = $("#status_id" ).val();
	
	  if(value==2){
		   $(".followup").attr("disabled", "disabled"); 
	  }else if(value==1){
		   $(".followup").attr("required",true);
		   $(".followup").removeAttr("disabled");
	  }
	  else{
		   $(".followup").removeAttr("disabled");
	  }
	});
	
	
	 
	}); 
	</script>
@endsection