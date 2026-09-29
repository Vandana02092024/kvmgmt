@extends('layouts.layout')



@section('content')

<section id="dashboard-page" class="wrap">



	<div class="container-fluid">

		<div class="row">

			<div class="col-sm-12">

				<div class="page-heading">

					<h3 class="heading">CUSTOMER PROBLEM REPORT</h3>

					<a class="v-btn v-btn-primary pull-right" href="{{ url('/report') }}">BACK</a>

					<a class="v-btn v-btn-primary pull-right" href="{{ url('/dashboard') }}">DASHBOARD</a>

	                <br /> 

				</div>

			</div>

		</div>



		<div class="row">

			<div class="col-sm-12">

				<div class="widget form-layout">

					<div class="widget-content no-padding">



						<form class="widget ng-pristine ng-valid" method="POST" action="{{ url('/report') }}">

						{{ csrf_field() }}



						{!! Form::hidden('assigned_to', Auth::user()->id, ['class' => 'form-control']) !!}

						{!! Form::hidden('created_by', Auth::user()->id, ['class' => 'form-control']) !!}

						<div class="main-detail">

							<div class="form-group row">

								<div class="col-md-6">

									<div class="form-group row{{ $errors->has('filled_date') ? ' has-error' : '' }}">

										<label class="col-sm-4">Date</label>

										<div class="col-sm-8">

											<input type="text" name="filled_date" value="{{ old('filled_date') }}" class="form-control">

											@if ($errors->has('filled_date'))

		                                        <span class="help-block">

		                                            <strong>{{ $errors->first('filled_date') }}</strong>

		                                        </span>

		                                    @endif

										</div>



									</div>

									<div class="form-group row{{ ($errors->has('customer_name') or ($errors->has('customer_last_name'))) ? ' has-error' : '' }}">

										<label class="col-sm-4">Customer Name</label>

										<div class="col-sm-8">

											<table>

												<tr>

													<td>

														<input type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="First Name" class="form-control">

													</td>

													<td width="11%"></td>

													<td>

														<input type="text" name="customer_last_name" value="{{ old('customer_last_name') }}" placeholder="Last Name" class="form-control">

													</td>

												</tr>

											</table>

											@if (($errors->has('customer_name')) or ($errors->has('customer_last_name')))

		                                        <span class="help-block">

		                                            <strong>{{ $errors->first('customer_name') }}</strong>

		                                        </span>

		                                    @endif

										</div>

									</div>

									<div class="form-group row{{ $errors->has('address') ? ' has-error' : '' }}">

										<label class="col-sm-4">Address</label>

										<div class="col-sm-8">

											<input type="text" class="form-control" name="address" value="{{ old('address') }}">



											@if ($errors->has('address'))

		                                        <span class="help-block">

		                                            <strong>{{ $errors->first('address') }}</strong>

		                                        </span>

		                                    @endif

										</div>

									</div>



									<div class="form-group row{{ $errors->has('city') ? ' has-error' : '' }}">

										<label class="col-sm-4">City</label>

										<div class="col-sm-8">

											<input type="text" name="city" value="{{ old('city') }}" class="form-control">

											@if ($errors->has('city'))

		                                        <span class="help-block">

		                                            <strong>{{ $errors->first('city') }}</strong>

		                                        </span>

		                                    @endif

										</div>



									</div>





									<div class="form-group row{{ $errors->has('state') ? ' has-error' : '' }}">

										<label class="col-sm-4">State</label>

										<div class="col-sm-8">

											<select name="state" class="form-control">

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

											@if ($errors->has('status'))

		                                        <span class="help-block">

		                                            <strong>{{ $errors->first('status') }}</strong>

		                                        </span>

		                                    @endif

										</div>





										

									</div>



									<div class="form-group row{{ $errors->has('zip') ? ' has-error' : '' }}">



										<label class="col-sm-4">Zip Code</label>

										<div class="col-sm-8">

											<input type="text" name="zip" id="zip" value="{{ old('zip') }}" class="form-control">

											@if ($errors->has('zip'))

		                                        <span class="help-block">

		                                            <strong>{{ $errors->first('zip') }}</strong>

		                                        </span>

		                                    @endif

										</div>



									</div>



								</div>









								<div class="col-md-6">

									<div class="form-group row{{ $errors->has('clerk') ? ' has-error' : '' }}">



										<label class="col-sm-4">Clerk</label>

										<div class="col-sm-8">

											<input type="text" name="clerk" value="{{ old('clerk') }}" class="form-control">

											@if ($errors->has('clerk'))

		                                        <span class="help-block">

		                                            <strong>{{ $errors->first('clerk') }}</strong>

		                                        </span>

		                                    @endif

										</div>



									</div>

									<div class="form-group row">

										<label class="col-sm-4">Home Phone</label>

										<div class="col-sm-8">

											<!-- onFocus="setcursorposition('home_phone');"    -->

											<input type="text" name="home_phone" id="home_phone" data-mask="(999) 999-9999" value="{{ old('home_phone') }}" class="form-control">

										</div>



									</div>

									<div class="form-group row">



										<label class="col-sm-4">Work Phone</label>

										<div class="col-sm-8">

											<input type="text" name="work_phone" data-mask="(999) 999-9999" value="{{ old('work_phone') }}" class="form-control">

										</div>



									</div>

									<div class="form-group row{{ $errors->has('cell_phone') ? ' has-error' : '' }}">



										<label class="col-sm-4">Cell Phone</label>

										<div class="col-sm-8">

											<input type="text" name="cell_phone" data-mask="(999) 999-9999" value="{{ old('cell_phone') }}" class="form-control">

											@if ($errors->has('cell_phone'))

		                                        <span class="help-block">

		                                            <strong>{{ $errors->first('cell_phone') }}</strong>

		                                        </span>

		                                    @endif

										</div>



									</div>

									



								</div>

							</div>

						</div>

						<div class="divider"></div>

							<div class="specific-problem">

								<div class="row">

									<div class="col-sm-6">

										<div class="form-group row{{ $errors->has('problem') ? ' has-error' : '' }}">

											<div class="col-sm-12">

												<h4>SPECIFIC PROBLEM (PLEASE CHECK ONE)</span></h4>

												<label class="radio col-sm-6"><input type="radio" name="problem" @if('Missing Garment' == old('problem')) @php echo 'checked="checked"' @endphp @endif value="Missing Garment">Missing Garment</label>

												<label class="radio col-sm-6"><input type="radio" name="problem" @if('Damaged Garment' == old('problem')) @php echo 'checked="checked"' @endphp @endif value="Damaged Garment">Damaged Garment</label>

												<label class="radio col-sm-6"><input type="radio" name="problem" @if('Missing Order' == old('problem')) @php echo 'checked="checked"' @endphp @endif value="Missing Order">Missing Order</label>

												<label class="radio col-sm-6"><input type="radio" name="problem" @if('Other' == old('problem')) @php echo 'checked="checked"' @endphp @endif value="Other" id="other">Other</label>

												<div class="text">

													<input type="text" name="other_problem" style="width:400px" id="text1" value="{{ old('other_problem') }}" maxlength="30">

												</div>

												@if ($errors->has('problem'))

			                                        <span class="help-block">

			                                            <strong>{{ $errors->first('problem') }}</strong>

			                                        </span>

			                                    @endif

											</div>

										</div>

									</div>



									<div class="col-sm-3">

										<div class="form-group row{{ $errors->has('claim_check') ? ' has-error' : '' }}">

											<div class="col-sm-12">

												<h4>Claim Check Present?</h4>

												<label class="radio col-md-12"><input type="radio" name="claim_check" @if(old('claim_check') == '0') checked="checked" @else checked @endif value="0" >No</label>

												<label class="radio col-md-12"><input type="radio" name="claim_check" @if(old('claim_check') == '1') checked="checked" @endif value="1" id="claimcheck">Yes</label>

												

												

												@if ($errors->has('claim_check'))

			                                        <span class="help-block">

			                                            <strong>{{ $errors->first('claim_check') }}</strong>

			                                        </span>

			                                    @endif

											</div>

										</div>	

									</div>



									<div class="col-sm-3">

										<div class="form-group row">

											<div class="col-sm-12 claimchk">

												<label class="radio col-md-8">Claim Check</label>

												<input type="text" name="claim_check_val" id="claimcheckval" value="{{ old('claim_check_val') }}" maxlength="30">

											</div>

										</div>	

									</div>



									

								</div>



								<div class="row">

									<div class="col-sm-12">

										<div class="form-group row{{ $errors->has('missing_date') ? ' has-error' : '' }}">

											<div class="col-sm-5">

												<h4>What date do you think the garment/order was missing/damaged?</h4>

											</div>

											<div class="col-sm-3">

												<input type="text" name="missing_date" value="{{ old('missing_date') }}" class="form-control">

												@if ($errors->has('missing_date'))

			                                        <span class="help-block">

			                                            <strong>{{ $errors->first('missing_date') }}</strong>

			                                        </span>

			                                    @endif

											</div>

										</div>

									</div>

								</div>



								<div class="row">

									<div class="col-sm-12">

										<div class="form-group row">

											<div class="col-sm-5">

												<h4>Please Provide Lot # if available</h4>

											</div>

											<div class="col-sm-3">

												<input type="text" name="invoice_tag" value="{{ old('invoice_tag') }}" class="form-control">

											</div>

										</div>

									</div>

								</div>

								<div class="row">

									<div class="col-sm-12">

										<div class="form-group row">

											<div class="col-sm-5">

												<h4>Please provide Tag #’s If available</h4>

											</div>

											<div class="col-sm-3">

												<input type="text" name="tag_no" value="{{ old('tag_no') }}" class="form-control">

											</div>

										</div>

									</div>

								</div>



							</div>



							



							<div class="describe-garments">

								<div class="row">

									<div class="col-md-9">	

										<h4><b>DESCRIBE GARMENT(S)</b></h4>

									</div>

									<div class="col-md-3">

										<a class="btn btn-danger btn-sm pull-right garmentdis_add add-btn" onclick="add_more();">+ Add More</a>

									</div>	

								</div>

	                           <div class="responsive-table">

	

								<table class="table" id="describe-table">

									<thead>

										<tr>
											<th>Type <span style="cursor:pointer;float:right;font-size:20px;" data-toggle="modal" id="confirmUp1" >+</sapn></th>
											<th>Size <span style="cursor:pointer;float:right;font-size:20px;" data-toggle="modal" id="confirmUp2" >+</sapn></th>
											<th>Brand <span style="cursor:pointer;float:right;font-size:20px;" data-toggle="modal" id="confirmUp3" >+</sapn></th>
											<th>Color <span style="cursor:pointer;float:right;font-size:20px;" data-toggle="modal" id="confirmUp4" >+</sapn></th>
											<th>Material <span style="cursor:pointer;float:right;font-size:20px;" data-toggle="modal" id="confirmUp5" >+</sapn></th>
											<th></th>
										</tr>

									</thead>

									

									<tbody>



										<!-- <tr>
											<td><input type="text" name="type[]" onchange="search_garment(this)" value="" class="form-control"></td>
											<td><input type="text" name="size[]" onchange="search_garment(this)" value="" class="form-control"></td>
											<td><input type="text" name="brand_name[]" onchange="search_garment(this)" value="" class="form-control"></td>
											<td><input type="text" name="color[]" onchange="search_garment(this)" value="" class="form-control"></td>
											<td><input type="text" name="material[]" onchange="search_garment(this)" value="" class="form-control"></td>
											<td>
												<ul class="inline">
													<li><a class="v-btn v-btn-primary btn-xs" onclick="remove_this(this)"><i class="fa fa-trash"></i></a></li>
												</ul>
											</td>
										</tr> -->
										<tr>
											<td>{!! Form::select('type[]', $type, null,['class' => 'form-control']) !!}</td>
											<td>{!! Form::select('size[]', $size, null,['class' => 'form-control']) !!}</td>
											<td>{!! Form::select('brand_name[]', $brand, null,['class' => 'form-control']) !!}</td>
											<td>{!! Form::select('color[]', $color, null,['class' => 'form-control']) !!}</td>
											<td>{!! Form::select('material[]', $material, null,['class' => 'form-control']) !!}</td>
											<td>
												<ul class="inline">
													<li><a class="v-btn v-btn-primary btn-xs" onclick="remove_this(this)"><i class="fa fa-trash"></i></a></li>
												</ul>
											</td>
										</tr>
									</tbody>
								</table>
								</div>
								<div id="divshow"></div>
							</div>







							

							<div class="Search-result">

								<div class="row">

									<div class="col-md-9">	

										<h4>SEARCH RESULTS</h4>

									</div>

									<div class="col-md-3">

										<a class="btn btn-danger btn-sm pull-right search_add add-btn">+ Add More</a>

									</div>	

								</div>

	                                                    <div class="responsive-table">

								<table class="table" id="search_table">

									<thead>

										<tr>

											<th>Date</th>

											<th>By Who</th>

											<th>Action</th>

											<th>Resolved</th>

											<th></th>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td><input type="text" name="search_date[]" value="" class="form-control dp"></td>

											<td><input type="text" name="search_by_who[]" value="" class="form-control"></td>

											<td><input type="text" name="action[]" value="" class="form-control"></td>

											<td><input type="text" name="resolved[]" value="" class="form-control"></td>

											<td>

												<ul class="inline">

													<li><a class="v-btn v-btn-primary btn-xs" onclick="remove_this(this)"><i class="fa fa-trash"></i></a></li>

													<!-- <li><a href="#" class="v-btn v-btn-primary btn-xs"><i class="fa fa-pencil"></i></a></li> -->

												</ul>

											</td>

										</tr>

									</tbody>

								</table></div>



							</div>







							<div class="customer-notification">

								<div class="row">

									<div class="col-md-9">	

										<h4>CUSTOMER NOTIFICATIONS</h4>

									</div>

									<div class="col-md-3">

										<a class="btn btn-danger btn-sm pull-right custnotify_add add-btn">+ Add More</a>

									</div>	

								</div>	



                                                              <div class="responsive-table">

								<table class="table" id="custnotify_table">

									<thead>

										<tr>

											<th>Date</th>

											<th>By Who</th>

											<th>Comment</th>

											<th>Manager Action</th>

											<th></th>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td><input type="text" name="customer_notified_date[]" value="" class="form-control dp"></td>

											<td><input type="text" name="by_who[]" value="" class="form-control"></td>

											<td><textarea name="comments[]" class="form-control"></textarea></td>

											<td><textarea name="manager_action[]" class="form-control"></textarea></td>

											<td>

												<ul class="inline">

													<li><a class="v-btn v-btn-primary btn-xs" onclick="remove_this(this)"><i class="fa fa-trash"></i></a></li>

													<!-- <li><a href="#" class="v-btn v-btn-primary btn-xs"><i class="fa fa-pencil"></i></a></li> -->

												</ul>

											</td>

										</tr>



									</tbody>

								</table></div>

							</div>

							





							<div class="resolution">

								<h4>RESOLUTION ( STORE USE ONLY)</h4>

                                                                <div class="responsive-table">

								<table width="100%" class="table-border">

									<tr>

										<th colspan="4">

											<label class="radio-inline">

												<input type="radio" name="resolution" value="1">Resolved

											</label>

										</th>

									</tr>

									<tr>

										<td width="10%">&nbsp;</td>

										<td width="10%">

											<label class="radio-inline">

												<input type="radio" name="resolved_as" value="Found">Found

											</label>

										</td>

										<td>

											<label class="col-sm-3">Date</label>

											<div class="col-sm-9">

												<input type="text" name="found_date" value="{{ old('found_date') }}" class="form-control">

											</div>

										</td>

										<td>

											<label class="col-sm-5">New Rack #</label>

											<div class="col-sm-7">

												<input type="" name="new_location" value="{{ old('new_location') }}" class="form-control">

											</div>

										</td>

									</tr>

									<tr style="height:5px"><td colspan="4"></td></tr>

									<tr>

										<td></td>

										<td>

											<label class="radio-inline">

												<input type="radio" name="resolved_as" value="Fixed">Fixed</label>

											</td>

										<td><label class="col-md-3">Date</label>

											<div class="col-sm-9">

												<input type="text" name="fixed_date" value="{{ old('fixed_date') }}" class="form-control">

											</div>

										</td>

										<td></td>

									</tr>

									<tr style="height:5px"><td colspan="4"></td></tr>

									<tr>

										<td></td>

										<td>

											<label class="radio-inline">

												<input type="radio" name="resolved_as" value="Claim">Claim</label>

											</td>

										<td>

											<label class="col-sm-7">Date claim given to customer</label>

											<div class="col-sm-5">

												<input type="text" name="clim_date" value="{{ old('clim_date') }}"  class="form-control">

											</div>

										</td>

										<td>

											<label class="col-sm-5">Date claim Submitted</label>

											<div class="col-sm-7">

												<input type="text" name="claim_submitted_date" value="{{ old('claim_submitted_date') }}" class="form-control" >

											</div>

										</td>

									</tr>

									<tr style="height:5px"><td colspan="4"></td></tr>

									<tr>

										<th colspan="4">

											<label class="radio-inline">

												<input type="radio" name="resolution" value="0">Not Resolved

											</label>

										</th>

									</tr>

									<tr style="height:5px"><td colspan="4"></td></tr>

									<tr>

										<td></td>

										<td><label>Date closed</label></td>

										<td colspan="2">

											<div class="col-md-4">

												<input type="text" name="closed_date" value="{{ old('closed_date') }}" class="form-control">

											</div>

										</td>

									</tr>

								</table>

                                </div>

							</div>



							<!-- <div class="description">

								<p>We will take every effort to locate your missing garment or order(s). If you have a claim check for the items

								listed, we will contact you as soon as we have any additional information. If you do not have a claim check, we

								will ONLY contact you if we locate your garment or orders that match the description listed above. It can take

								2-4 weeks to have your problem report researched. We do not provide copies of this form and cannot provide

								you with updates unless you have a valid claim check. It is our policy for our customers to verify that their

								orders are complete before leaving the premises.</p>

								<p>I have read and understood the above statement</p>

								<h4 class="text-right">Signature: <br /> </h4>

								<p class="text-right">{{ Auth::user()->name }} &nbsp;</p>

							</div> -->									

						

					</div>

					<div class="widget-footer">

						<button class="v-btn v-btn-primary add-btn">SUBMIT</button>

					</div>

					</form>

				</div>

			</div>



		</div>



	</div>



</section>


@php
$LabelAry = array('NA', 'Type', 'Size', 'Brand', 'Color', 'Material');
@endphp

@for($i = 1; $i<= 5; $i++)
<div id="confirmpopup{{ $i }}" class="modal fade import-csv" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add {{ $LabelAry[$i] }}</h4>
      </div>
          <div class="modal-body" id="getData">
          	{{ $LabelAry[$i] }} : 
            <input type="text" name="add_new{{ $i }}" id="add_new{{ $i }}" style="width: 450px; height: 30px;" value="">
          </div>
      <div class="modal-footer">
        <ul class="inline-list-view action-btn">
            <button class="y-btn y-btn-primary outline" id="add_more" onclick="add_new({{ $i }});">Add</button>
        </ul>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$("#confirmUp"+{{ $i }}).click(function(){
    $('#confirmpopup'+{{ $i }}).modal('show');
});
</script>
@endfor




<script type="text/javascript">



function add_new(a)
{
    var add_new = $('#add_new'+a).val();

    $.ajax({
        type:       "POST",
        dataType:   "html",
        url:        "{{ url('/') }}/addNew",
        data: {add_new: add_new, add : a},
        success:    function(data)
        {
        	$('#confirmpopup'+a).modal('hide');
        	add_more();
        }
    });
}





	// $( "#home_phone" ).focus(function() {

	// 	var searchInput = $('#home_phone');



	// 	// Multiply by 2 to ensure the cursor always ends up at the end;

	// 	// Opera sometimes sees a carriage return as 2 characters.

	// 	var strLength = searchInput.val().length * 2;

		

	// 	searchInput.focus();

	// 	searchInput[0].setSelectionRange(strLength, strLength);

	// });





	$('input[name="filled_date"]').datepicker({

        format: 'mm/dd/yyyy',

    }).attr('readonly', 'readonly');



    $('input[name="missing_date"]').datepicker({

        format: 'mm/dd/yyyy',

    }).attr('readonly', 'readonly'); 



    $('input[name="found_date"]').datepicker({

        format: 'mm/dd/yyyy',

    }).attr('readonly', 'readonly');

    $('input[name="fixed_date"]').datepicker({

        format: 'mm/dd/yyyy',

    }).attr('readonly', 'readonly');

    $('input[name="claim_submitted_date"]').datepicker({

        format: 'mm/dd/yyyy',

    }).attr('readonly', 'readonly');

    $('input[name="clim_date"]').datepicker({

        format: 'mm/dd/yyyy',

    }).attr('readonly', 'readonly');

    $('input[name="closed_date"]').datepicker({

        format: 'mm/dd/yyyy',

    }).attr('readonly', 'readonly');

    $(".dp").datepicker({

        format: 'mm/dd/yyyy',

    }).attr('readonly', 'readonly');

   



   





  $(document).ready(function() {

	  // initialize table

   // $('.garmentdis_add').click(function(){

   // 	$('#describe-table tbody').append($("#describe-table tbody tr:last").clone());

   // });



 //   $('.garmentdis_add').click(function() {

	//     var appendTxt = '<tr><td><input type="text" name="type[]" onchange="search_garment(this)" value="" class="form-control"></td><td><input type="text" name="size[]" onchange="search_garment(this)" value="" class="form-control"></td><td><input type="text" name="brand_name[]" onchange="search_garment(this)" value="" class="form-control"></td><td><input type="text" name="color[]" onchange="search_garment(this)" value="" class="form-control"></td><td><input type="text" name="material[]" onchange="search_garment(this)" value="" class="form-control"></td><td><ul class="inline"><li><a class="v-btn v-btn-primary btn-xs" onclick="remove_this(this)"><i class="fa fa-trash"></i></a></li></ul></td></tr>';

	//     $('#describe-table tbody').append(appendTxt);

	// }); 





   // $(this).parents("tr").remove();

   // $('.search_add').click(function(){

   // $('#search_table tbody').append($("#search_table tbody tr:last").clone());

   // });



  	$('.search_add').click(function() {

	    var appendTxt = '<tr><td><input type="text" name="search_date[]" value="" class="form-control dp"></td><td><input type="text" name="search_by_who[]" class="form-control"></td><td><input type="text" name="action[]" value="" class="form-control"></td><td><input type="text" name="resolved[]" value="" class="form-control"></td><td><ul class="inline"><li><a class="v-btn v-btn-primary btn-xs" onclick="remove_this(this)"><i class="fa fa-trash"></i></a></li></ul></td></tr>';



	    $('#search_table tbody').append(appendTxt);

	    $(".dp").datepicker({

	        format: 'mm/dd/yyyy',

	    }).attr('readonly', 'readonly');

	}); 



   // $('.custnotify_add').click(function(){

   // $('#custnotify_table tbody').append($("#custnotify_table tbody tr:last").clone());

   // });



	$('.custnotify_add').click(function() {

	    var appendTxt = '<tr><td><input type="text" name="customer_notified_date[]" value="" class="form-control dp"></td><td><input type="text" name="by_who[]" class="form-control"></td><td><textarea name="comments[]" class="form-control"></textarea></td><td><textarea name="manager_action[]" class="form-control"></textarea></td><td><ul class="inline"><li><a class="v-btn v-btn-primary btn-xs" onclick="remove_this(this)"><i class="fa fa-trash"></i></a></li></ul></td></tr>';

	    $('#custnotify_table tbody').append(appendTxt);

	    $(".dp").datepicker({

	        format: 'mm/dd/yyyy',

	    }).attr('readonly', 'readonly');

	}); 





   

});





  function remove_this(x)

  {

  	$(x).parents("tr").remove();

  	return false;

  }

</script>

<script type="text/javascript">



$(document).ready(function () {

    $(".text").hide();

    $(".claimchk").hide();



    if($("input[type=radio][id='other']").is(':checked')) {

    	$(".text").show();

    }

    if($("input[type=radio][id='claimcheck']").is(':checked')) {

    	$(".claimchk").show();

    }

    



    $("#other").click(function () {

        $(".text").show();

    });

});



$("input[name='problem']").on("click", function() {

	if($("input[type=radio][name='problem']:checked").val() != 'Other'){

		$(".text").hide();

	}

});



$("input[type=radio][name='claim_check']").on("click", function() {

	if($("input[type=radio][name='claim_check']:checked").val() != 1){

		$(".claimchk").hide();

	}else{

		$(".claimchk").show();

	}

});



// Found Check line //

$("input[name='resolved_as']").on("click", function() {

	$("input[name=resolution][value='1']").prop("checked",true);

});

$("input[name='found_date']").on("change", function() {

	$("input[name=resolved_as][value='Found']").prop("checked",true);

	$("input[name=resolution][value='1']").prop("checked",true);

});

$("input[name='new_location']").on("change", function() {

	$("input[name=resolved_as][value='Found']").prop("checked",true);

	$("input[name=resolution][value='1']").prop("checked",true);

});

// ###################### //



// Fixed check line //

$("input[name='fixed_date']").on("change", function() {

	$("input[name=resolved_as][value='Fixed']").prop("checked",true);

	$("input[name=resolution][value='1']").prop("checked",true);

});

// ###################### //



// Cliam check line //

$("input[name='clim_date']").on("change", function() {

	$("input[name=resolved_as][value='Claim']").prop("checked",true);

	$("input[name=resolution][value='1']").prop("checked",true);

});

$("input[name='claim_submitted_date']").on("change", function() {

	$("input[name=resolved_as][value='Claim']").prop("checked",true);

	$("input[name=resolution][value='1']").prop("checked",true);

});

// ###################### //





$("input[name='closed_date']").on("change", function() {

	$("input[name=resolution][value='0']").prop("checked",true);

});





function search_garment(x)
{
	var keys = [];
	$(x).parents("tr").find("input").each(function() {
        keys.push(this.value);
    });

    $.ajax({
        type:       "POST",
        dataType:   "html",
        url:        "{{ url('/') }}/searchGarments",
        data: {id: keys},
        success:    function(data)
        {
            $("#divshow").html(data);
        }
    });
}


function add_more()
{
    $.ajax({
        type:       "POST",
        dataType:   "html",
        url:        "{{ url('/') }}/add_more",
        data: {id: 1},
        success:    function(data)
        {
            $('#describe-table tbody').append(data);
        }
    });
}
</script>

@endsection