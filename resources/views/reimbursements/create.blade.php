@extends('layouts.layout')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  
  <script>
  $( function() {
    $( ".datepicker" ).datepicker();
  } );
  </script>
<script type="text/javascript">

$(function() {
    $("input[name='zip_type']").click(function() {
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
<style type="text/css">
  .office-use-section
  {
  	padding: 10px 20px;
    background: #eee;
    margin: 10px;
  }
  #describe-garment-table>thead>tr>th
  {
  	font-size: 12px;

  }
  textarea.form-control.animated {
			height: 30px;
		}
		.autoSize {
			 display:inline-block;
			width: 600px;
			min-height: 34px;
			border: solid 1px #ccc;
		}
		.bigger_radio
		{
			width: 1.9em!important;
			height: 1.9em!important;
			margin-top: -2px!important;
			margin-left: -26px!important;
		}
		.bigger_radio_label
		{
			padding-left: 22px!important;
            padding-top: 10px!important;
		}
		

</style>


<section id="dashboard-page" class="wrap kv-claim-form-page">

	<div class="container-fluid">
		
		<div class="row">

			<div class="col-sm-12">

				<div class="page-heading kv-page-hero kv-claims-hero">
					<h3 class="heading">
						<span class="kv-hero-title"><i class="fa fa-file-text-o"></i><span>New Claim Form</span></span>
						<a class="v-btn v-btn-primary" href="{{ url('/reimbursement') }}"><i class="fa fa-arrow-left " style="margin-right: 5px"> </i>BACK</a>
					</h3>
				</div>

			</div>

		</div>
		


		<div class="row">

			<div class="col-sm-12">

				<div class="widget form-layout kv-claim-form">

					<div class="widget-content no-padding">

						<form class="widget ng-pristine ng-valid" method="POST" action="{{ url('/reimbursement') }}">
						{{ csrf_field() }}
						{!! Form::hidden('userRole', $userRole, ['class' => 'form-control ownerCheck']) !!}
                            <div class="main-detail loass_container ">
								<div class="form-group row{{ $errors->has('zip_type') ? ' has-error' : '' }}">
							   	  <div class="">
							   	  	<div class="col-md-3">
										<label class="radio-inline">
										  <input type="radio" id="new" name="zip_type" checked value="0">NEW CLAIM FORM
										</label>
										
										@if ($errors->has('zip_type'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('zip_type') }}</strong>
	                                        </span>
	                                    @endif
									</div>
									<div class="col-md-3">
										<label class="radio-inline">
										  <input type="radio" id="pri" name="zip_type" @php if(old('zip_type') == 1){ echo "checked"; } @endphp value="1">USE EXISTING PROBLEM REPORT
										</label>
								    </div>
									
									
									<div id="dvPRI" class="col-md-6{{ $errors->has('report_id') ? ' has-error' : '' }}" style="display: none">
									    {{ Form::select('report_id', $reportIds, null, ['class' => 'selectlist form-control col-md-5','id' => 'custID']) }}
									    @if ($errors->has('report_id'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('report_id') }}</strong>
	                                        </span>
	                                    @endif
									</div>
								</div>
							   </div>
								<div class="kv-claim-section-heading"><span>Claim and customer details</span><small>Start with the claim reference, then enter the customer’s contact information.</small></div>
							
							
							
							
							<div class="row kv-claim-grid-row">
								
                            		<div class="col-md-3 {{ $errors->has('today_date') ? ' has-error' : '' }}" >
                            			<label>Today’s Date</label>
                                    <div><input type="text" readonly value="<?php echo date('m/d/Y');?>" name="today_date" class="form-control ">
										
										
										@if ($errors->has('today_date'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('today_date') }}</strong>
			                                        </span>
			                                    @endif
										
										</div>
	                                </div>
									
									
	                                <div class="col-md-3 {{ $errors->has('claim_check') ? ' has-error' : '' }}">
	                                    <label>Claim Check #</label>
	                                    <div><input type="text" name="claim_check" class="form-control">
										@if ($errors->has('claim_check'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('claim_check') }}</strong>
			                                        </span>
			                                    @endif
										</div>
	                                </div>
	                                <div class="col-md-3 {{ $errors->has('original_claim_check') ? ' has-error' : '' }}">
	                                    <label>Do you have your original Claim check? </label>
	                                    <div>
	                                    	<label class="radio-inline">
										      <input type="radio" id="cc1"  value="1" name="original_claim_check">Yes
										    </label>
										    <label class="radio-inline">
										      <input type="radio" id="cc2" value="0" name="original_claim_check">No
										    </label>
	                                    </div>	
										@if ($errors->has('original_claim_check'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('original_claim_check') }}</strong>
			                                        </span>
			                                    @endif
	                                </div>
									<div id="claimDetail" class="col-md-3 {{ $errors->has('claim_detail') ? ' has-error' : '' }}">
		                                    <label>Check Number</label>
		                                    <div><input type="text" name="claim_detail" class="form-control numbersOnly">
											&nbsp;<span id="errmsg"></span>
											@if ($errors->has('claim_detail'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('claim_detail') }}</strong>
			                                        </span>
			                                    @endif
											</div>
		                                </div>
                                </div>
                                <div class="row kv-claim-fields-wide kv-claim-grid-row">
                            		<div class="col-md-3 {{ $errors->has('claim_check_date') ? ' has-error' : '' }}">
                            			<label>Claim Check Date</label>
	                                     <div><input type="text"  name="claim_check_date"  class="form-control datepicker">
										 @if ($errors->has('claim_check_date'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('claim_check_date') }}</strong>
			                                        </span>
			                                    @endif
												</div>
	                                </div>
	                                <div class="col-md-3 {{ $errors->has('special_claim_check') ? ' has-error' : '' }}">
	                                    <label>Special Claim Check # (if any)</label>
	                                    <div><input type="text" name="special_claim_check"  class="form-control">
										@if ($errors->has('special_claim_check'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('special_claim_check') }}</strong>
			                                        </span>
			                                    @endif
												</div>
	                                </div>
	                                <div class="col-md-4 {{ $errors->has('compensation') ? ' has-error' : '' }}">
	                                    <label>Compensation</label>
	                                    <div class="kv-claim-choice-grid">
	                                    	<label class="radio-inline">
										      <input type="radio" id="csp" value="1" name="compensation" class="">Store Credit
										    </label>
										    <label class="radio-inline">
										      <input type="radio" id="csp" value="0" name="compensation" class="">Check
										    </label>
											<label class="radio-inline">
										      <input type="radio" id="csp" value="2" name="compensation" class="">Split
										    </label>
											<label class="radio-inline">
										      <input type="radio" id="csp" value="3" name="compensation" class="">Cash
										    </label>
	                                    </div>	
										@if ($errors->has('compensation'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('compensation') }}</strong>
			                                        </span>
			                                    @endif
	                                </div>
                                </div>
                                <div class="row kv-claim-fields-wide kv-claim-grid-row">
                                	<div class="col-md-3 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                		<label>First Name</label>
	                                    <div><input type="text" name="first_name"  id="customer_name" class="form-control fetch_results">
										@if ($errors->has('first_name'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('first_name') }}</strong>
			                                        </span>
			                                    @endif
										</div>
	                                </div>
	                                <div class="col-md-3 {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                		<label>Last Name</label>
	                                    <div><input type="text" name="last_name"  id="customer_last_name" class="form-control fetch_results">
										@if ($errors->has('last_name'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('last_name') }}</strong>
			                                        </span>
			                                    @endif
										</div>
	                                </div>
	                                <div class="col-md-4 kv-claim-item-field {{ $errors->has('item') ? ' has-error' : '' }}">
	                                	<label>Item was?</label>
	                                    <div class="kv-claim-item-options">
	                                    	<label class="radio-inline">
										      <input type="radio" id="csp" value="1" name="item" class="">Dry Cleaned
										    </label>
										    <label class="radio-inline">
										      <input type="radio" id="csp" value="0" name="item" class="">Laundered
										    </label>
											<label class="radio-inline">
										      <input type="radio" id="csp" value="2" name="item" class="">Alterations
										    </label>
										    <label class="radio-inline">
										      <input type="radio" id="csp" value="3" name="item" class="">Household
										    </label>
	                                    </div>
											@if ($errors->has('item'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('item') }}</strong>
			                                        </span>
			                                    @endif
	                                </div>
	                            </div>
	                            <div class="row kv-claim-fields-wide kv-claim-grid-row">
                            		<div class="col-md-3 {{ $errors->has('address') ? ' has-error' : '' }}">
                            			<label>Address</label>
	                                    <div><textarea class="form-control fetch_results" name="address" id="address" rows="1" style="min-height:48px" ></textarea>
										@if ($errors->has('address'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('address') }}</strong>
			                                        </span>
			                                    @endif
										</div>
	                                </div>
	                                <div class="col-md-3 {{ $errors->has('city') ? ' has-error' : '' }}">
                            			<label>City</label>
	                                    <div><input type="text" name="city" id="city" class="form-control fetch_results" >
										@if ($errors->has('city'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('city') }}</strong>
			                                        </span>
			                                    @endif
										</div>
	                                </div>
	                 
	                                <div class="col-md-4 {{ $errors->has('email_address') ? ' has-error' : '' }}">
	                                    <label>Email Address</label>
	                                    <div>
	                                    	<div><input type="text" name="email_address" class="form-control fetch_results">
											@if ($errors->has('email_address'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('email_address') }}</strong>
			                                        </span>
			                                    @endif
											</div>
	                                    </div>	
	                                </div>
                                </div>
                            <div class="row kv-claim-fields-wide kv-claim-grid-row">
                   
	                                <div class="col-md-3 {{ $errors->has('state') ? ' has-error' : '' }}">
	                                    <label>State</label>
	                                    <div>
											<select name="state" class="form-control fetch_results"  id="state">
												<option value="">Select State</option>
												<option value="Alabama" @if( old('state') == 'Alabama') selected="selected"; @endif>Alabama</option>

												<option value="Alaska" @if( old('state') == 'Alaska') selected="selected"; @endif>Alaska</option>

												<option value="Arizona" @if( old('state') == 'Arizona') selected="selected"; @endif>Arizona</option>

												<option value="Arkansas" @if( old('state') == 'Arkansas') selected="selected"; @endif>Arkansas</option>

												<option value="California" @if( old('state') == 'California') selected="selected"; @endif>California</option>

												<option value="Colorado" @if( old('state') == 'Colorado') selected="selected"; @endif>Colorado</option>

												<option value="Connecticut" @if( old('state') == 'Connecticut') selected="selected"; @endif>Connecticut</option>

												<option value="Delaware" @if( old('state') == 'Delaware') selected="selected"; @endif>Delaware</option>

												<option value="District of Columbia" @if( old('state') == 'District of Columbia') selected="selected"; @endif>District of Columbia</option>

												<option value="Florida" @if( old('state') == 'Florida') selected="selected"; @endif>Florida</option>

												<option value="Georgia" @if( old('state') == 'Georgia') selected="selected"; @endif>Georgia</option>

												<option value="Hawaii" @if( old('state') == 'Hawaii') selected="selected"; @endif>Hawaii</option>

												<option value="Idaho" @if( old('state') == 'Idaho') selected="selected"; @endif>Idaho</option>

												<option value="Illinois" @if( old('state') == 'Illinois') selected="selected"; @endif>Illinois</option>

												<option value="Indiana" @if( old('state') == 'Indiana') selected="selected"; @endif>Indiana</option>

												<option value="Iowa" @if( old('state') == 'Iowa') selected="selected"; @endif>Iowa</option>

												<option value="Kansas" @if( old('state') == 'Kansas') selected="selected"; @endif>Kansas</option>

												<option value="Kentucky" @if( old('state') == 'Kentucky') selected="selected"; @endif>Kentucky</option>

												<option value="Louisiana" @if( old('state') == 'Louisiana') selected="selected"; @endif>Louisiana</option>

												<option value="Maine" @if( old('state') == 'Maine') selected="selected"; @endif>Maine</option>

												<option value="Maryland" @if( old('state') == 'Maryland') selected="selected"; @endif>Maryland</option>

												<option value="Massachusetts" @if( old('state') == 'Massachusetts') selected="selected"; @endif>Massachusetts</option>

												<option value="Michigan" @if( old('state') == 'Michigan') selected="selected"; @endif>Michigan</option>

												<option value="Minnesota" @if( old('state') == 'Minnesota') selected="selected"; @endif>Minnesota</option>

												<option value="Mississippi" @if( old('state') == 'Mississippi') selected="selected"; @endif>Mississippi</option>

												<option value="Missouri" @if( old('state') == 'Missouri') selected="selected"; @endif>Missouri</option>

												<option value="Montana" @if( old('state') == 'Montana') selected="selected"; @endif>Montana</option>

												<option value="Nebraska" @if( old('state') == 'Nebraska') selected="selected"; @endif>Nebraska</option>

												<option value="Nevada" @if( old('state') == 'Nevada') selected="selected"; @endif>Nevada</option>

												<option value="New Hampshire" @if( old('state') == 'New Hampshire') selected="selected"; @endif>New Hampshire</option>

												<option value="New Jersey" @if( old('state') == 'New Jersey') selected="selected"; @endif>New Jersey</option>

												<option value="New Mexico" @if( old('state') == 'New Mexico') selected="selected"; @endif>New Mexico</option>

												<option value="New York" @if( old('state') == 'New York') selected="selected"; @endif>New York</option>

												<option value="North Carolina" @if( old('state') == 'North Carolina') selected="selected"; @endif>North Carolina</option>

												<option value="North Dakota" @if( old('state') == 'North Dakota') selected="selected"; @endif>North Dakota</option>

												<option value="Ohio" @if( old('state') == 'Ohio') selected="selected"; @endif>Ohio</option>

												<option value="Oklahoma" @if( old('state') == 'Oklahoma') selected="selected"; @endif>Oklahoma</option>

												<option value="Oregon" @if( old('state') == 'Oregon') selected="selected"; @endif>Oregon</option>

												<option value="Pennsylvania" @if( old('state') == 'Pennsylvania') selected="selected"; @endif>Pennsylvania</option>

												<option value="Rhode Island" @if( old('state') == 'Rhode Island') selected="selected"; @endif>Rhode Island</option>

												<option value="South Carolina" @if( old('state') == 'South Carolina') selected="selected"; @endif>South Carolina</option>

												<option value="South Dakota" @if( old('state') == 'South Dakota') selected="selected"; @endif>South Dakota</option>

												<option value="Tennessee" @if( old('state') == 'Tennessee') selected="selected"; @endif>Tennessee</option>

												<option value="Texas" @if( old('state') == 'Texas') selected="selected"; @endif>Texas</option>

												<option value="Utah" @if( old('state') == 'Utah') selected="selected"; @endif>Utah</option>

												<option value="Vermont" @if( old('state') == 'Vermont') selected="selected"; @endif>Vermont</option>

												<option value="Virginia" @if( old('state') == 'Virginia') selected="selected"; @endif>Virginia</option>

												<option value="Washington" @if( old('state') == 'Washington') selected="selected"; @endif>Washington</option>

												<option value="West Virginia" @if( old('state') == 'West Virginia') selected="selected"; @endif>West Virginia</option>

												<option value="Wisconsin" @if( old('state') == 'Wisconsin') selected="selected"; @endif>Wisconsin</option>

												<option value="Wyoming" @if( old('state') == 'Wyoming') selected="selected"; @endif>Wyoming</option>

											</select>
										</div>
										@if ($errors->has('state'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('state') }}</strong>
			                                        </span>
			                                    @endif
	                                </div>
	                                <div class="col-md-3 {{ $errors->has('zip_code') ? ' has-error' : '' }}">
	                                    <label>Zip Code</label>
	                                    <div>
	                                    	<div><input type="text" id="zip"  onKeyPress = "if(this.value.length==5) return false;" name="zip_code"  class="form-control numbersOnly fetch_results">
											@if ($errors->has('zip_code'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('zip_code') }}</strong>
			                                        </span>
			                                    @endif
											</div>
	                                    </div>	
	                                </div>
	                                <div class="col-md-4 {{ $errors->has('telephone_number') ? ' has-error' : '' }}">
	                                    <label>Telephone Number</label>
	                                    <div><input type="text" name="telephone_number" id="telephone_number" class="form-control fetch_results">
										@if ($errors->has('telephone_number'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('telephone_number') }}</strong>
			                                        </span>
			                                    @endif
										</div>
	                                </div>
                                </div>
                                <div class="row_blank" style="height:10px;"></div>
                                <div class="describe-garments">
								<div class="row">
									<div class="col-md-9">	
										<h4>DESCRIBE ITEM(S):</h4>
									</div>
									<div class="col-md-3">
										<a class="btn btn-danger btn-sm pull-right garmentdis_add add-btn add_decription">+ Add More</a>

									</div>	
								</div>	

								<table class="table table-striped kv-claim-items-table" id="search_table">

									<thead>

										<tr>

											<th>ITEM DESCRIPTION</th>
                                		 	<th>MATERIAL </th>
                                		 	<th>COLOR</th>
                                		 	<th>DATE PURCHASED</th>
                                		 	
                                		 	<th>PURCHASE LOCATION</th>
											<th>AMOUNT PAID</th>
                                		 	<!--<th>TOTAL</th>-->

											<th>ACTION</th>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td><input type="text" name="item_desc[]" class="form-control"></td>

											<td><input type="text" name="material[]" class="form-control"></td>

											<td><input type="text" name="color[]" class="form-control"></td>
											<td><input type="text"  name ="date_purchase[]" class="form-control datepicker"></td>

											

											<td><input type="text" name="purchase_location[]" class="form-control"></td>
											<td><div style="position:relative;"><span class="dolor">$</span>
											<input type="text" name="amount_paid[]" class="form-control amount_paid currency"onkeypress="return validateFloatKeyPress(this,event);" ></div></td>
											<!--<td><input type="text" name="total[]" class="form-control"></td>-->
											<td>
												<ul class="inline">
													<li><a class="v-btn v-btn-primary btn-xs" onclick="remove_this(this)"><i class="fa fa-trash"></i></a></li>
												</ul>
											</td>
										</tr>


									</tbody>

								</table>

							</div>
							
								<div class="row kv-claim-total-row"><div class="col-md-4 {{ $errors->has('total_desc') ? ' has-error' : '' }}">
	                                    <label>Total</label>
	                                    <div style="position:relative;">
										<span class="dolor">$</span>
										<input type="text" readonly name="total_desc" id="total_desc" class="form-control currency">
										@if ($errors->has('total_desc'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('total_desc') }}</strong>
			                                        </span>
			                                    @endif
										</div>
	                                </div></div>
							
                            <div class="kv-claim-section-heading"><span>Claim total and proof of purchase</span><small>Enter the total item value and the customer’s settlement offer.</small></div>
                            <div class="row_blank" style="height:5px;"></div>
                                 <div class="row kv-claim-terms">
                                	<div class="col-md-12">
                                       <p style="font-size:13px"><b>PROOF OF PURCHASE (one of the following):</b> 1) Original or duplicate receipt from store, 2) Itemized credit card receipt, or 3) Monthly statement from store where purchased</p>
                                	 </div>
                                 </div>
                                 <div class="row_blank" style="height:5px;"></div>
                                 <div class="row kv-claim-terms"><div class="col-md-12"><p style="font-size:13px">After allowing for depreciation from age and wear, I would be willing to accept $
								 <input type="text" name="proof_purchase" class="currency kv-claim-proof-amount">@if ($errors->has('proof_purchase'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('proof_purchase') }}</strong>
			                                        </span>
			                                    @endif
								 as full settlement of this claim. I acknowledge that this listed amount is an offer made
by me to be considered by ZIPS. Please note that once the claim is resolved, the item(s), for which you received compensation will remain in our possession.</p></div></div>
                                <div class="row_blank" style="height:5px;"></div>
                                 <div class="row kv-claim-terms"><div class="col-md-12"><p style="font-size:13px">Customer is responsible to ensure this form is filled out completely and legibly. Store Credit will be added to Customer account or check is mailed to the home address listed above
within ten (10) business days of final resolution. Copies of this document are not provided.</p></div></div>
<div class="row_blank" style="height:5px;"></div>
                                 <div class="row"><div class="col-md-12"><p style="font-size:13px">The statements I made above are true and correct.</p></div></div>
                                 

                                <div class="office-use-section">
								<h5><i class="fa fa-lock" aria-hidden="true"></i><b>FOR OFFICE USE ONLY:</b></h5>
                                	<div class="row">
	                            		<div class="col-md-4 {{ $errors->has('store') ? ' has-error' : '' }}">
	                            			<label>Store #</label>
		                                    <div>
											
											
											<input type="text" name="store" readonly value="{{ $locVal }}" class="form-control">
											</div>
											@if ($errors->has('store'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('store') }}</strong>
			                                        </span>
			                                    @endif
		                                </div>
		                                <div class="col-md-4 {{ $errors->has('store_owner_manager') ? ' has-error' : '' }}">
		                                    <label>Store Owner/Manager:</label>
		                                    <div><input type="text" name="store_owner_manager"  class="form-control">
											@if ($errors->has('store_owner_manager'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('store_owner_manager') }}</strong>
			                                        </span>
			                                    @endif
											</div>
		                                </div>
		                                <div class="col-md-4 {{ $errors->has('receipts_attached') ? ' has-error' : '' }}">
		                                    <label>Receipts Attached: </label>
		                                    <div>
		                                    	<label class="radio-inline">
											      <input type="radio" id="csp" value="1" name="receipts_attached" class="">Yes
											    </label>
											    <label class="radio-inline">
											      <input type="radio" id="csp" value="0" name="receipts_attached" class="">No
											    </label>
		                                    </div>
												@if ($errors->has('receipts_attached'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('receipts_attached') }}</strong>
			                                        </span>
			                                    @endif
		                                </div>
                                    </div>
                                    <div  class="row">
                                    	<div class="col-md-4 {{ $errors->has('claim_type') ? ' has-error' : '' }}">
		                                    <label>Claim Type:</label>
		                                    <div>
											    <label class="radio-inline">
											      <input type="radio" id="ct1" name="claim_type" value="1" class="">Missing Item
											    </label>
											    <label class="radio-inline">
											      <input type="radio" id="ct2" name="claim_type" value="2" class="">Missing Order
											    </label>
											    <label class="radio-inline">
											      <input type="radio" id="ct3" name="claim_type" value="3" class="">Damaged Item
											    </label>
											    
		                                    </div>
												@if ($errors->has('claim_type'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('claim_type') }}</strong>
			                                        </span>
			                                    @endif
		                                </div>
										<div  id="dam_desc" class="col-md-4 {{ $errors->has('damaged_desc') ? ' has-error' : '' }}">
		                                    <label>Comments/Damage Description:</label>
		                                    <div><textarea name="damaged_desc" style="height:40px!important;"  class="form-control animated"></textarea>
											@if ($errors->has('damaged_desc'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('damaged_desc') }}</strong>
			                                        </span>
			                                    @endif
											</div>
		                                </div>
										
										<div class="col-md-4 {{ $errors->has('item_return') ? ' has-error' : '' }}">
		                                    <label>Item Returned to Customer </label>
		                                    <div>
		                                    	<label class="radio-inline">
											      <input type="radio"  value="1" name="item_return" class="">Yes
											    </label>
											    <label class="radio-inline">
											      <input type="radio"  value="0" name="item_return" class="">No
											    </label>
		                                    </div>
												@if ($errors->has('item_return'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('item_return') }}</strong>
			                                        </span>
			                                    @endif
		                                </div>
                                    </div>
                                    <div class="row">
	                            		<div class="col-md-3 {{ $errors->has('resolution') ? ' has-error' : '' }}">
	                            			<label>Resolution:</label>
		                                    <div>
		                                    	<select class="form-control" id="resolution_id" name="resolution" >
												<option value="" >Select</option>
		                                    	 <option value="check" @if( old('resolution') == 'check') selected="selected"; @endif>Check</option>
												 <option value="storeCredit" @if( old('resolution') == 'storeCredit') selected="selected"; @endif>Store Credit</option>
												<option value="checkstorecredit" @if( old('resolution') == 'checkstorecredit') selected="selected"; @endif>Check and Store Credit</option>
												<option value="cash" @if( old('statresolutione') == 'cash') selected="selected"; @endif>Cash</option>

		                                    	</select>
		                                    </div>
											@if ($errors->has('resolution'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution') }}</strong>
			                                        </span>
			                                    @endif
		                                </div>
										
									
                                    </div>
                                    <div id="div_check" style="display:none;">
                                     <div class="row">	
                                    	<div class="col-md-3 {{ $errors->has('resolution_check_pickup_mail') ? ' has-error' : '' }}">
		                                    <div>
		                                    	<label class="radio-inline bigger_radio_label">
											      <input type="radio" id="csp" value="1" name="resolution_check_pickup_mail" class="bigger_radio">Pick Up
											    </label>
											    <label class="radio-inline bigger_radio_label">
											      <input type="radio" id="csp" value="0" name="resolution_check_pickup_mail" class="bigger_radio">Mail
											    </label>
		                                    </div>	
											@if ($errors->has('resolution_check_pickup_mail'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution_check_pickup_mail') }}</strong>
			                                        </span>
			                                    @endif
		                                </div>
										<div class="col-md-3 {{ $errors->has('check_amount') ? ' has-error' : '' }}">
		                                    <label>Check Amount:</label>
		                                    <div><input type="text" name="check_amount"  class="form-control currency" onkeypress="return validateFloatKeyPress(this,event);">
											@if ($errors->has('check_amount'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('check_amount') }}</strong>
			                                        </span>
			                                    @endif
											</div>
		                                </div>
		                                <div class="col-md-3 {{ $errors->has('credit_amount') ? ' has-error' : '' }}">
		                                    <label>Check Date:</label>
		                                    <div><input type="text" name="credit_amount"  class="form-control datepicker ownerCheckValue">
											@if ($errors->has('credit_amount'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('credit_amount') }}</strong>
			                                        </span>
			                                    @endif
											</div>
		                                </div>
		                                <div class="col-md-3 {{ $errors->has('resolution_check') ? ' has-error' : '' }}">
		                                    <label> Check#:  </label>
		                                    <div><input type="text" name="resolution_check"  class="form-control ownerCheckValue">
											@if ($errors->has('resolution_check'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution_check') }}</strong>
			                                        </span>
			                                    @endif
											</div>
		                                </div>

                                    </div>
                                    </div>
                                    <div id="div_storeCredit" style="display:none;margin-top:10px;">
                                     <div class="form-group row">
										<div class="col-md-3 {{ $errors->has('resolution_store_credit_amount') ? ' has-error' : '' }}">
		                                    <label> Credit Amount  </label>
		                                    <div><input type="text" name="resolution_store_credit_amount" class="form-control currency" onkeypress="return validateFloatKeyPress(this,event);">
											@if ($errors->has('resolution_store_credit_amount'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution_store_credit_amount') }}</strong>
			                                        </span>
			                                    @endif
											</div>
		                                </div>
                                    	<div class="col-md-3 {{ $errors->has('resolution_store_credit_added') ? ' has-error' : '' }}">
		                                    <div>
		                                    	 <label>Store Credit Added Date:</label>
		                                         <div><input type="text" name="resolution_store_credit_added"  class="form-control datepicker"></div>

		                                    </div>	
											@if ($errors->has('resolution_store_credit_added'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution_store_credit_added') }}</strong>
			                                        </span>
			                                    @endif
		                                </div>
		                                <div class="col-md-3 {{ $errors->has('resolution_store_credit_check_date') ? ' has-error' : '' }}">
		                                    <label>Store Credit Number  </label>
		                                    <div><input type="text" name="resolution_store_credit_check_date" class="form-control">
											@if ($errors->has('resolution_store_credit_check_date'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution_store_credit_check_date') }}</strong>
			                                        </span>
			                                    @endif
											</div>
		                                </div>
										
		                                

                                    </div>
                                    </div>
                                    <div id="div_checkstoreCredit" style="display:none;margin-top:10px;">
                                     <div class="form-group row">
                                        <div class="col-md-3 {{ $errors->has('resolution_check_store_credit_pickup_mail') ? ' has-error' : '' }}">
		                                    <div>
		                                    	<label class="radio-inline bigger_radio_label">
											      <input type="radio" id="csp" name="resolution_check_store_credit_pickup_mail" value="1" class="bigger_radio">Pick Up
											    </label>
											    <label class="radio-inline bigger_radio_label">
											      <input type="radio" id="csp" name="resolution_check_store_credit_pickup_mail" value="0" class="bigger_radio">Mail
											    </label>
		                                    </div>	
											@if ($errors->has('resolution_check_store_credit_pickup_mail'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution_check_store_credit_pickup_mail') }}</strong>
			                                        </span>
			                                    @endif
		                                </div>
										<div class="col-md-3 {{ $errors->has('resolution_check_store_credit_added_amount') ? ' has-error' : '' }}">
		                                    <div>
		                                    	 <label>Check Amount</label>
		                                         <div><input type="text" name="resolution_check_store_credit_added_amount" class="form-control currency" onkeypress="return validateFloatKeyPress(this,event);">
												 @if ($errors->has('resolution_check_store_credit_added_amount'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution_check_store_credit_added_amount') }}</strong>
			                                        </span>
			                                    @endif
												 </div>

		                                    </div>	
		                                </div>	
                                    	<div class="col-md-3 {{ $errors->has('resolution_check_store_credit_added') ? ' has-error' : '' }}">
		                                    <div>
		                                    	 <label>Check Date</label>
		                                         <div><input type="text" name="resolution_check_store_credit_added" class="form-control datepicker ownerCheckValue">
												 @if ($errors->has('resolution_check_store_credit_added'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution_check_store_credit_added') }}</strong>
			                                        </span>
			                                    @endif
												 </div>

		                                    </div>	
		                                </div>
										
		                                <div class="col-md-3 {{ $errors->has('resolution_check_store_credit_check') ? ' has-error' : '' }}">
		                                    <label> Check#:  </label>
		                                    <div><input type="text" name="resolution_check_store_credit_check"  class="form-control ownerCheckValue">
											@if ($errors->has('resolution_check_store_credit_check'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution_check_store_credit_check') }}</strong>
			                                        </span>
			                                    @endif
											</div>
		                                </div>
                                    </div>
									 <div class="form-group row">
									 <div class="col-md-3 col-md-offset-3 {{ $errors->has('resolution_check_store_credit_check_credit_amount') ? ' has-error' : '' }}">
		                                    <label> Credit Amount:  </label>
		                                    <div><input type="text" name="resolution_check_store_credit_check_credit_amount"  class="form-control currency" onkeypress="return validateFloatKeyPress(this,event);">
											@if ($errors->has('resolution_check_store_credit_check_credit_amount'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution_check_store_credit_check_credit_amount') }}</strong>
			                                        </span>
			                                    @endif
											</div>
		                                </div>
											<div class="col-md-3 {{ $errors->has('resolution_check_store_credit_check_date') ? ' has-error' : '' }}">
		                                    <label> Store Credit Added Date:  </label>
		                                    <div><input type="text" name="resolution_check_store_credit_check_date"  class="form-control datepicker">
											@if ($errors->has('resolution_check_store_credit_check_date'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution_check_store_credit_check_date') }}</strong>
			                                        </span>
			                                    @endif
											</div>
		                                </div>
										<div class="col-md-3 {{ $errors->has('resolution_check_store_credit_check_credit_number') ? ' has-error' : '' }}">
		                                    <label>Store Credit Number:  </label>
		                                    <div><input type="text" name="resolution_check_store_credit_check_credit_number"  class="form-control ">
											@if ($errors->has('resolution_check_store_credit_check_credit_number'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution_check_store_credit_check_credit_number') }}</strong>
			                                        </span>
			                                    @endif
											</div>
		                                </div>
										
									 </div>
									
                                    </div>
                                     <div id="div_cash" style="display:none;margin-top:10px;">
                                     <div class="form-group row">
									 <div class="col-md-3 {{ $errors->has('resolution_cash_paid_amount') ? ' has-error' : '' }}">
		                                    <div>
		                                    	 <label>Cash Amount:</label>
		                                         <div><input type="text" name="resolution_cash_paid_amount"  class="form-control currency" onkeypress="return validateFloatKeyPress(this,event);">
												 @if ($errors->has('resolution_cash_paid_amount'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution_cash_paid_amount') }}</strong>
			                                        </span>
			                                    @endif
												 </div>

		                                    </div>	
		                                </div>
                                        <div class="col-md-3 {{ $errors->has('resolution_cash_paid') ? ' has-error' : '' }}">
		                                    <div>
		                                    	 <label>Paid By:</label>
		                                         <div><input type="text" name="resolution_cash_paid" class="form-control">
												 @if ($errors->has('resolution_cash_paid'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution_cash_paid') }}</strong>
			                                        </span>
			                                    @endif
												 </div>
		                                    </div>	
		                                </div>	
                                    	<div class="col-md-3 {{ $errors->has('resolution_cash_paid_date') ? ' has-error' : '' }}">
		                                    <div>
		                                    	 <label>Paid Date:</label>
		                                         <div><input type="text" name="resolution_cash_paid_date"  class="form-control datepicker">
												 @if ($errors->has('resolution_cash_paid_date'))
			                                        <span class="help-block">
			                                            <strong>{{ $errors->first('resolution_cash_paid_date') }}</strong>
			                                        </span>
			                                    @endif
												 </div>

		                                    </div>	
		                                </div>
										
		                                


                                    </div>
                                    </div>

                                </div>
                                <div class="row">
                                	<div class="col-md-12 text-center">
                                		<button class="v-btn v-btn-primary add-btn" onClick = "upBtn()" id="upBtn">ADD</button>
                                	</div>
                                </div>
                                <div class="row_blank" style="height:10px;"></div>	
                                





									

						</form>

					</div>

						

				</div>

			</div>

		</div>

	</div>
</section>

<script type="text/javascript">
function upBtn(){
	$('#upBtn').css('display','none');
}

$(document).ready(function() {
	  // initialize table
	$('.add_decription').click(function() {
		var appendTxt = '<tr><td><input type="text" name="item_desc[]" class="form-control"></td><td><input type="text" name="material[]" class="form-control"></td><td><input type="text" name="color[]" class="form-control"></td><td><input type="text" name="date_purchase[]" class="form-control dp"></td><td><input type="text" name="purchase_location[]" class="form-control"></td><td><div style="position:relative;"><span class="dolor">$</span><input type="text" name="amount_paid[]" class="form-control amount_paid currency" onkeypress="return validateFloatKeyPress(this,event);"></div></td><td><ul class="inline"><li><a class="v-btn v-btn-primary btn-xs" onclick="remove_this(this)"><i class="fa fa-trash"></i></a></li></ul></td></tr>';
		
		$('#search_table tbody').append(appendTxt);
		$('.currency').currencyFormat();
		
		$(".dp").datepicker({

	        format: 'mm/dd/yyyy',

	    });
	});
  
});

</script>

<script type="text/javascript">
$(function() {
$('#div_check').hide();

$('#resolution_id').change(function(){
        if($('#resolution_id').val() == 'check') {
            $('#div_check').show();
			
			
        } else {
            $('#div_check').hide(); 
			
        } 
    });
});
</script>
<script type="text/javascript">
$(function() {
$('#div_storeCredit').hide();
$('#resolution_id').change(function(){
        if($('#resolution_id').val() == 'storeCredit') {
            $('#div_storeCredit').show(); 
        } else {
            $('#div_storeCredit').hide(); 
        } 
    });
});
</script>
<script type="text/javascript">
$(function() {
$('#div_checkstoreCredit').hide();
$('#resolution_id').change(function(){
        if($('#resolution_id').val() == 'checkstorecredit') {
            $('#div_checkstoreCredit').show(); 
        } else {
            $('#div_checkstoreCredit').hide(); 
        } 
    });
});
</script>

<script src="{{ asset('/js/auto-resize.js') }}"></script>
<script type="text/javascript">
$(function() {
$('#div_cash').hide();
$('#resolution_id').change(function(){
        if($('#resolution_id').val() == 'cash') {
            $('#div_cash').show(); 
        } else {
            $('#div_cash').hide(); 
        } 
    });
});

 function remove_this(x)

  {
	
  	$(x).parents("tr").remove();
	sumValue();
  	return false;

  } 
$("#telephone_number").inputmask({"mask": "(999) 999-9999"});
$(function(){
		$('.animated').autosize({});
	});
	
	
$(document).on("change", ".amount_paid", function() {
    sumValue();
	});	


function sumValue()
{
	var sumtotal = 0;
    $(".amount_paid").each(function(){
        sumtotal += +$(this).val();
		sum = parseFloat(sumtotal).toFixed(2);
    });
    $("#total_desc").val(sum);
}	
(function($) {
        $.fn.currencyFormat = function() {
            this.each( function( i ) {
                $(this).change( function( e ){
                    if( isNaN( parseFloat( this.value ) ) ) return;
                    this.value = parseFloat(this.value).toFixed(2);
                });
            });
            return this; 
        }
    })( jQuery );

   
    $( function() {
        $('.currency').currencyFormat();
    });
	
function switchVar() {
    if($("#ct3").prop("checked"))
        $("#dam_desc").show();
     else
        $("#dam_desc").hide();
}

function switchClaim() {
    if($("#cc1").prop("checked"))
        $("#claimDetail").show();
     else
        $("#claimDetail").hide();
}

$(document).ready(function() {
    switchVar();
	switchClaim();
    $("input[name=claim_type]").change(switchVar);
	$("input[name=original_claim_check]").change(switchClaim);
	
	$(".numbersOnly").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        //$("#errmsg").html("Only Numeric digits").show().fadeOut("slow");
               return false;
    }
   });

	
	  var valuecheck = $(".ownerCheck" ).val();
	  if(!(valuecheck == 'Owner')){
		  $(".ownerCheckValue").attr("disabled", "disabled");
	  }
	
   
	
	
	
});	
$('#custID').on('change', function(event){
		
		var cID = $('#custID').val();
		
		$.ajax({
        type:       "POST",
        dataType:   "html",
        url:        "{{ url('/') }}/reportData",
        data: {cID: cID},
        success: function(data)
        {
		var data_value = data.split("|");
		  $('#customer_name').val(data_value[0].trim());
		  $('#customer_last_name').val(data_value[1].trim());
		  $('#address').val(data_value[2].trim());
		  $('#city').val(data_value[3].trim());
		  $('#state').val(data_value[4].trim());
		  $('#zip').val(data_value[5].trim());
		  $('#telephone_number').val(data_value[6].trim());
		}
    });
	});



function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if(number.length>1 && charCode == 46){
         return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
        return false;
    }
    return true;
}

//thanks: http://javascript.nwbox.com/cursor_position/
function getSelectionStart(o) {
	if (o.createTextRange) {
		var r = document.selection.createRange().duplicate()
		r.moveEnd('character', o.value.length)
		if (r.text == '') return o.value.length
		return o.value.lastIndexOf(r.text)
	} else return o.selectionStart
}
	
</script>
<style type="text/css">
 .dolor
 {
 	position: absolute;
    left: -12px;
    top: 5px;
 }
 
 
 .loass_container .radio-inline input[type=radio] {
   width: 1.3em;
   height: 1.3em;
   margin-top: 1px;
  
}
 
</style>
@endsection
