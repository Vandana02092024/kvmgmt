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
					<h3 class="heading">Add User <span class="block text-xs text-light hide">You can add content here</span></h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8">
				<div class="widget">
					<div class="widget-content">
						<form class="widget ng-pristine ng-valid">
							<div class="widget-content">
								<div class="row form-group">
									<div class="col-sm-12">
										<label>Your Name</label>
										<input type="text" name="" class="form-control" placeholder="" required="">
									</div>							
								</div>
								<div class="row form-group">
									<div class="col-sm-12">
										<label>Email</label>
										<input type="email" name="" class="form-control" placeholder="" required="">
									</div>
								</div>
								<div class="row form-group">							
									<div class="col-sm-12">
										<label>Contact</label>
										<input type="number" name="" class="form-control" placeholder="" required="">
									</div>
								</div>
								<div class="row form-group">							
									<div class="col-sm-12">
										<label>Business Type</label>
										<select class="form-control">
											<option value="Individual">Individual</option>
											<option value="Commercial">Commercial</option>
											<option value="Organisation">Organisation</option>
										</select>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-sm-12">
										<label>Select Location</label>
										<div class="checkbox">
											<label><input type="checkbox" value="">Delhi</label>
										</div>
										<div class="checkbox">
											<label><input type="checkbox" value="">Mumbai</label>
										</div>
										<div class="checkbox disabled">
											<label><input type="checkbox" value="" disabled="">Tamilnaidu</label>
										</div>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-sm-12">
										<label>Message</label>
										<textarea class="form-control" placeholder="Message" rows="4"></textarea>
									</div>
								</div>
							</div>
							<div class="widget-footer">
								<button class="v-btn v-btn-primary">Add</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>