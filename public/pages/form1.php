<section id="sitemap" class="sitemap">

	<div class="container-fluid">

		<div class="row">

			<div class="col-sm-12">

				<ul class="breadcrumb">

				    <li><a href="dashboard.php">Dashboard</a></li>

				    <li class="active captilize">Add users</li>

				</ul>

			</div>

		</div>

	</div>

</section>

<section id="dashboard-page" class="wrap">

	<div class="container-fluid">

		<div class="row">

			<div class="col-sm-6">

				<div class="page-heading">

					<h3 class="heading">CUSTOMER PROBLEM REPORT</h3>

				</div>

			</div>

		</div>

		<div class="row">

			<div class="col-sm-12">

				<div class="widget form-layout">

					<div class="widget-content no-padding">

						<form>

							<div class="main-detail">

								<div class="form-group row">

									<div class="col-sm-3">

										<label>Date</label>

										<input type="text" name="" class="form-control">

									</div>

									<div class="col-sm-3">

										<label>Clerk</label>

										<input type="text" name="" class="form-control">

									</div>

									<div class="col-sm-3">

										<label>Clerk</label>

										<input type="text" name="" class="form-control">

									</div>

									<div class="col-sm-3">

										<label>Customer Name</label>

										<input type="text" name="" class="form-control">

									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-3">

										<label>Home Phone</label>

										<input type="text" name="" class="form-control">

									</div>

									<div class="col-sm-3">

										<label>Address</label>

										<input type="text" name="" class="form-control">

									</div>

									<div class="col-sm-3">

										<label>Work Phone</label>

										<input type="text" name="" class="form-control">

									</div>

									<div class="col-sm-3">

										<label>Cell Phone</label>

										<input type="text" name="" class="form-control">

									</div>

								</div>

							</div>

							<div class="specific-problem">

								<div class="row">

									<div class="col-sm-6">

										<h4>Specific Problem <span>(Please check appropriate box)</span></h4>

										<div class="form-group row">

											<div class="col-sm-12">

												<label class="radio-inline"><input type="radio" name="optradio">Option 1</label>

												<label class="radio-inline"><input type="radio" name="optradio">Option 2</label>

												<label class="radio-inline"><input type="radio" name="optradio">Option 3</label>
												<label class="radio-inline"><input type="radio" name="optradio" id="other">Other</label>
												<div class="text">
												    
												        <input type="text" name="text1" id="text1" maxlength="30">
												   
												</div>

											</div>

										</div>

									</div>

									<div class="col-sm-6">

										<h4>Do you have claim check?</h4>

										<div class="form-group row">

											<div class="col-sm-12">

												<label class="radio-inline"><input type="radio" name="optradio">Yes</label>

												<label class="radio-inline"><input type="radio" name="optradio">No</label>

											</div>

										</div>	

									</div>

								</div>

								<div class="row">

									<div class="col-sm-6">

										<h4>WHAT DATE DO YOU THINK THE GARMENT/ORDER WAS MISSING/DAMAGED?:</h4>

										<div class="form-group row">

											<div class="col-sm-12">

												<input type="text" name="" class="form-control">

											</div>

										</div>

									</div>

									<div class="col-sm-6">

										<h4>PLEASE PROVIDE INVOICE #’s AND/OR TAG #’S IF AVAILABLE:</h4>

										<div class="form-group row">

											<div class="col-sm-12">

												<input type="text" name="" class="form-control">

											</div>

										</div>

									</div>

								</div>

							</div>

							<div class="describe-garments">
								<div class="row">
									<div class="col-md-9">	
										<h4>DESCRIBE GARMENT(S):</h4>
									</div>
									<div class="col-md-3">
										<a class="btn btn-danger btn-sm pull-right garmentdis_add">+ Add More</a>

									</div>	
								</div>	

								<table class="table table-striped" id="describe-table">

									<thead>

										<tr>

											<th>Type</th>

											<th>Size</th>

											<th>Brand</th>

											<th>Color</th>

											<th>Material</th>

											<th class="hide">Action</th>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td><input type="text" name="" class="form-control"></td>

											<td><input type="text" name="" class="form-control"></td>

											<td><input type="text" name="" class="form-control"></td>

											<td><input type="text" name="" class="form-control"></td>

											<td><input type="text" name="" class="form-control"></td>

											<td class="hide">

												<ul class="inline">

													<li><a href="#" class="v-btn v-btn-primary btn-xs"><i class="fa fa-trash"></i></a></li>

													<li><a href="#" class="v-btn v-btn-primary btn-xs"><i class="fa fa-pencil"></i></a></li>

												</ul>

											</td>

										</tr>


									</tbody>

								</table>

							</div>

							<div class="Search-result">
								<div class="row">
									<div class="col-md-9">	
										<h4>Search Result</h4>
									</div>
									<div class="col-md-3">
										<a class="btn btn-danger btn-sm pull-right search_add">+ Add More</a>

									</div>	
								</div>	

								<table class="table" id="search_table">

									<thead>

										<tr>

											<th>Date</th>

											<th>By Who</th>

											<th>Action</th>

											<th>Resolved</th>

											<th class="hide">Action</th>

										</tr>
										

									</thead>

									<tbody>

										<tr>

											<td><input type="text" name="" class="form-control"></td>

											<td><input type="text" name="" class="form-control"></td>

											<td><input type="text" name="" class="form-control"></td>

											<td><input type="text" name="" class="form-control"></td>

											<td class="hide">

												<ul class="inline">

													<li><a href="#" class="v-btn v-btn-primary btn-xs"><i class="fa fa-trash"></i></a></li>

													<li><a href="#" class="v-btn v-btn-primary btn-xs"><i class="fa fa-pencil"></i></a></li>

												</ul>

											</td>

										</tr>
									</tbody>

								</table>
								

							</div>
						    <div class="customer-notification">
						    	<div class="row">
									<div class="col-md-9">	
										<h4>Customer Notified</h4>
									</div>
									<div class="col-md-3">
										<a class="btn btn-danger btn-sm pull-right custnotify_add">+ Add More</a>

									</div>	
								</div>	


								<table class="table" id="custnotify_table">

									<thead>

										<tr>

											<th>Date</th>

											<th>By Who</th>

											<th>Comment</th>
											<th class="hide">Action</th>

										</tr>

									</thead>

									<tbody>

										<tr>

											<td><input type="text" name="" class="form-control"></td>

											<td><input type="text" name="" class="form-control"></td>

											<td><textarea class="form-control"></textarea></td>

											<td class="hide">

												<ul class="inline">

													<li><a href="#" class="v-btn v-btn-primary btn-xs"><i class="fa fa-trash"></i></a></li>

													<li><a href="#" class="v-btn v-btn-primary btn-xs"><i class="fa fa-pencil"></i></a></li>

												</ul>

											</td>

										</tr>

										
									</tbody>

								</table>
						    </div>
						    <div class="manager-action">
						    	<h4>Manager Action</h4>

								<div class="form-group">

									<textarea class="form-control" placeholder="Action" cols="10" rows="3"></textarea>

								</div>
						    </div>

							<div class="resolution">

								<h4>Resolution</h4>

								<table class="table table-border">

									<tr style="background-color: #ccc">

										<th colspan="4"><label class="radio-inline"><input type="radio" name="optradio">Resolved</label></th>

									</tr>

									<tr>

										<td><label class="radio-inline"><input type="radio" name="optradio">Found</label></td>

										<td><label>Date:</label> <input type="date" name="" class="form-control"> </td>

										<td><label>New Location: </label><input type="" name="" class="form-control"></td>

									</tr>

									<tr>

										<td><label class="radio-inline"><input type="radio" name="optradio">Fixed</label></td>

										<td colspan="2"><label>Date:</label> <input type="date" name="" class="form-control"> </td>

									</tr>

									<tr>

										<td><label class="radio-inline"><input type="radio" name="optradio">Claim</label></td>

										<td><label>Date claim giveer to customer:</label> <input type="date" name="" class="form-control"> </td>

										<td><label>Date claim Submitted:</label> <input type="date" name="" class="form-control"> </td>

									</tr>

									<tr style="background-color: #ccc">

										<th colspan="4"><label class="radio-inline"><input type="radio" name="optradio">Not Resolved</label></th>

									</tr>

									<tr>

										<td><label>Date closed:</label> <input type="date" name="" class="form-control"></td>

									</tr>

								</table>

							</div>

							<div class="description">

								<p>We will take every effort to locate your missing garment or order(s). If you have a claim check for the items

								listed, we will contact you as soon as we have any additional information. If you do not have a claim check, we

								will ONLY contact you if we locate your garment or orders that match the description listed above. It can take

								2-4 weeks to have your problem report researched. We do not provide copies of this form and cannot provide

								you with updates unless you have a valid claim check. It is our policy for our customers to verify that their

								orders are complete before leaving the premises.</p>

								<p>I have read and understood the above statement</p>

								<h4 class="text-right">Signature:</h4>

							</div>									

						</form>

					</div>

					<div class="widget-footer">

						<button class="v-btn v-btn-primary">Add</button>

					</div>

				</div>

			</div>

		</div>

	</div>

</section>


<script type="text/javascript">

  $(document).ready(function() {
	  // initialize table
   $('.garmentdis_add').click(function(){

   $('#describe-table tbody').append($("#describe-table tbody tr:last").clone());

   });
   $('.search_add').click(function(){

   $('#search_table tbody').append($("#search_table tbody tr:last").clone());

   });
   $('.custnotify_add').click(function(){

   $('#custnotify_table tbody').append($("#custnotify_table tbody tr:last").clone());

   });


   
});
</script>
<script type="text/javascript">

$(document).ready(function () {
    $(".text").hide();
    $("#other").click(function () {
        $(".text").show();
    });
});
</script>