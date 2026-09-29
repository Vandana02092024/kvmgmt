@extends('layouts.layout')

@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script type="text/javascript">

$(function() {
    $("input[name='csr_type']").click(function() {
		
	  if ($("#new").is(":checked")) {
		  $('.fetch_results').val('');
		  $("#dvPRI").hide();	
	  }
     else if ($("#pri").is(":checked")) {
       $("#dvPRI").show();
     } else {
       $("#dvPRI").hide();
     }
   });
 });

</script>


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
<style>
textarea.form-control.animated {
			height: 30px;
		}

</style>
<div class="container-fluid">

		<div class="row">

			<div class="col-sm-12">

				<div class="page-heading">

					<h3 class="heading">
						 <a class="v-btn v-btn-primary " style="margin-right:8px" href="{{ url('/service') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a>
						CUSTOMER COMMUNICATIONS
					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">MENU</a>
					</h3>
	                <br /> 
				</div>

			</div>

		</div>


		<div class="row">

			<div class="col-sm-12">

				<div class="widget form-layout">

					<div class="widget-content no-padding">

						<form class="widget ng-pristine ng-valid" method="POST" action="{{ url('/service') }}">
						{{ csrf_field() }}

							<div class="main-detail csr_container">
							   <div class="form-group row{{ $errors->has('csr_type') ? ' has-error' : '' }}">
							   	  <div class="">
							   	  	<div class="col-md-2">
										<label class="radio-inline">
										  <input type="radio" id="new"  name="csr_type" checked value="0">New CSR
										</label>

										@if ($errors->has('csr_type'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('csr_type') }}</strong>
	                                        </span>
	                                    @endif

									</div>
									<div class="col-md-2">
										<label class="radio-inline">
										  <input type="radio" id="pri" name="csr_type" @php if(old('csr_type') == 1){ echo "checked"; } @endphp value="1">Problem Report Id
										</label>
								    </div>
									<div id="dvPRI" class="col-md-8{{ $errors->has('report_id') ? ' has-error' : '' }}" style="display: none">
									    {{ Form::select('report_id', $reportIds, null, ['class' => 'selectlist form-control col-md-5','id' => 'custID']) }}

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


							<div class="cust-info">
	                               <div class="form-group row">
	                               	 
									  <div class="col-md-3 {{ $errors->has('customer_name') ? ' has-error' : '' }}">
	                                    <label>Customer First Name</label>
	                                    <div><input type="text" name="customer_name" id="customer_name" class="form-control fetch_results">
										@if ($errors->has('customer_name'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('customer_name') }}</strong>
			                                        </span>
			                                    @endif
										</div>
	                                 </div>
									  
									  <div class="col-md-3 {{ $errors->has('customer_lastname') ? ' has-error' : '' }}">
	                                    <label>Customer Last Name</label>
	                                    <div><input type="text" name="customer_lastname" id="customer_lastname" class="form-control fetch_results">
										@if ($errors->has('customer_lastname'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('customer_lastname') }}</strong>
			                                        </span>
			                                    @endif
										</div>
	                                 </div>
									  
									  <div class="col-md-3 {{ $errors->has('customer_phone') ? ' has-error' : '' }}">
	                                    <label>Phone Number</label>
	                                    <div><input type="text" name="customer_phone" id="telephone_number" class="form-control fetch_results">
										@if ($errors->has('customer_phone'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('customer_phone') }}</strong>
			                                        </span>
			                                    @endif
										</div>
	                                 </div>
									  
									  <div class="col-md-3 {{ $errors->has('customer_add') ? ' has-error' : '' }}">
	                                    <label>Address</label>
	                                    <div><textarea name="customer_add" class="form-control fetch_results"  id="customer_add" style="min-height:48px"></textarea>
										@if ($errors->has('customer_add'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('customer_add') }}</strong>
			                                        </span>
			                                    @endif
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
	                                          	{{ Auth::user()->name }}
	                                          </div>
                             
										</div>
										<div class="form-group row">
											
	                                          <label class="col-sm-4">CREATED ON</label>
	                                          <div class="col-sm-8">
	                                          	 {{ date('m/d/Y g:i A', time()) }}
	                                          </div>
                                        </div>
	                                       
                                      
                                        <div class="form-group row{{ $errors->has('csr_type') ? ' has-error' : '' }}">
	                                        
	                                          <label class="col-sm-4">NOTES</label>
	                                          <div class="col-sm-8">
	                                          	<textarea class="form-control" name="notes" rows="3"></textarea>
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
	                                          	<select name="status" class="form-control" id="status_id">
	                                          		<option value="">- Select Status -</option>
	                                          		<option value="1" @php if(old('status') == '1'){ echo "selected"; } @endphp>Forwarded</option>
	                                          		<option value="2" @php if(old('status') == '2'){ echo "selected"; } @endphp>Closed</option>
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
	                                          	{{ Form::select('followup_by', $users, null, ['class' => 'form-control followup']) }}
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
	                                          	 <input type="text" name="followup_date" readonly value="{{ old('followup_date') }}" class="form-control dp followup">
	                                          	@if ($errors->has('followup_date'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('followup_date') }}</strong>
			                                        </span>
			                                    @endif
	                                          </div>
	                                          <div class="col-sm-4">
	                                          	 <input type="text" name="followup_time" readonly value="{{ old('followup_time') }}" class="timepicker form-control followup">
	                                          	 @if ($errors->has('followup_time'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('followup_time') }}</strong>
			                                        </span>
			                                    @endif
	                                          </div>
	                                          
                                        </div>
	                                       
                                      
                                        <div class="form-group row">
	                                        
	                                          <label class="col-sm-4">FOLLOW-UP NOTES</label>
	                                          <div class="col-sm-8">
	                                          	<textarea name="followup_notes" class="form-control followup" rows="3">{{ old('followup_notes') }}</textarea>
	                                          </div>
	                                        
	                                    </div>
	                                    <div class="form-group row{{ $errors->has('mode_of_contact') ? ' has-error' : '' }}">
	                                          <label class="col-sm-4">MODE OF CONTACT</label>
	                                          <div class="col-sm-8">
	                                          	<select name="mode_of_contact" class="form-control followup">
	                                          		<option value="">- Select Mode Of Contact -</option>
	                                          		<option value="1" @php if(old('mode_of_contact') == '1'){ echo "selected"; } @endphp>Email</option>
	                                          		<option value="2" @php if(old('mode_of_contact') == '2'){ echo "selected"; } @endphp>Text</option>
	                                          		<option value="3" @php if(old('mode_of_contact') == '3'){ echo "selected"; } @endphp>Call</option>
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
												<button class="v-btn v-btn-primary add-btn pull-right">ADD</button>
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
	$("#telephone_number").inputmask({"mask": "(999) 999-9999"});
$(function(){
		$('.animated').autosize({});
	});
	
	$('#custID').on('change', function(event){
		
		var cID = $('#custID').val();
		
		$.ajax({
        type:       "POST",
        dataType:   "html",
        url:        "{{ url('/') }}/reportDetails",
        data: {cID: cID},
        success: function(data)
        {
		var data_value = data.split("|");
		  $('#customer_name').val(data_value[0].trim());
		  $('#customer_lastname').val(data_value[1].trim());
		  $('#customer_add').val(data_value[2].trim());
		  $('#telephone_number').val(data_value[3].trim());
		}
    });
	});  
	</script>
@endsection