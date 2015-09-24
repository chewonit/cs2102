<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo $page_title?></h1>
			</div>
		</div>
	</div>

	<div class="row">
	
		<div class="col-md-9">
		
			<script type="text/javascript">
				var jq = $.noConflict();
				jq('#register-tabs a').click(function (e) {
					e.preventDefault()
					jq(this).tab('show')
				})				
			</script>
			
			<div>
				<!-- Nav tabs -->
				<ul id="register-tabs" class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#jobseeker-tab" aria-controls="home" role="tab" data-toggle="tab">Jobseeker</a></li>
					<li role="presentation"><a href="#employer-tab" aria-controls="profile" role="tab" data-toggle="tab">Employer</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active" id="jobseeker-tab">
				
					<h3>Jobseeker Registration</h3>
					
					<?php echo form_open('Register/register_user/');?>
						<div id="registerForm" class="fluid-container">
						<div class="row">
							<div class="form-group col-md-6">
								<label for="inputFirstName">First Name</label>
								<input required type="text" class="form-control" id="inputFirstName" placeholder="First Name">
							</div>
							<div class="form-group col-md-6">
								<label for="inputLastName">Last Name</label>
								<input required type="text" class="form-control" id="inputLastName" placeholder="Last Name">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="inputEmail">Email address</label>
								<input required type="email" class="form-control" id="inputEmail" placeholder="Email">
							</div>
							<div class="form-group col-md-6">
								<label for="inputNirc">NIRC</label>
								<input required type="text" class="form-control" id="inputNirc" placeholder="NIRC">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="inputPassword">Password</label>
								<input required type="password" class="form-control" id="inputPassword" placeholder="Password">
							</div>
							<div class="form-group col-md-6">
								<label for="inputConfrimPassword">Confirm Password</label>
								<input required type="password" class="form-control" id="inputConfrimPassword" placeholder="Password">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<div class="form-group">
									<label for="inputGender">Gender:</label>
									<select class="form-control" id="inputGender">
										<option>Female</option>
										<option>Male</option>
									</select>
								</div>
							</div>
							<div class="form-group col-md-6"></div>
						</div>
						<button type="submit" class="btn btn-default btn-success">Sign Up</button>
						</div>
					<?php echo form_close();?>
				
				</div> <!-- End of Jobseeker Tab -->
				
				<div role="tabpanel" class="tab-pane fade" id="employer-tab">
				
					<h3>Employer Registration</h3>
				
					<?php echo form_open('Register/register_user/');?>
						<div id="registerForm" class="fluid-container">
						<div class="row">
							<div class="form-group col-md-6">
								<label for="inputFirstName">First Name</label>
								<input required type="text" class="form-control" id="inputFirstName" placeholder="First Name">
							</div>
							<div class="form-group col-md-6">
								<label for="inputLastName">Last Name</label>
								<input required type="text" class="form-control" id="inputLastName" placeholder="Last Name">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="inputEmail">Email address</label>
								<input required type="email" class="form-control" id="inputEmail" placeholder="Email">
							</div>
							<div class="form-group col-md-6">
								<label for="inputNirc">NIRC</label>
								<input required type="text" class="form-control" id="inputNirc" placeholder="NIRC">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="inputPassword">Password</label>
								<input required type="password" class="form-control" id="inputPassword" placeholder="Password">
							</div>
							<div class="form-group col-md-6">
								<label for="inputConfrimPassword">Confirm Password</label>
								<input required type="password" class="form-control" id="inputConfrimPassword" placeholder="Password">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<div class="form-group">
									<label for="inputGender">Gender:</label>
									<select class="form-control" id="inputGender">
										<option>Female</option>
										<option>Male</option>
									</select>
								</div>
							</div>
							<div class="form-group col-md-6"></div>
						</div>
						<hr />
						<div class="row">
							<div class="form-group col-md-6">
								<div class="form-group">
									<label for="inputCompanyNumber">Company Registration Number</label>
									<input required type="text" class="form-control" id="inputCompanyNumber" placeholder="Company Registration Number">
								</div>
							</div>
							<div class="form-group col-md-6">
								<label for="inputCompanyName">Company Name</label>
								<input required type="text" class="form-control" id="inputCompanyName" placeholder="Company Name">
							</div>
						</div>
						<button type="submit" class="btn btn-default btn-success">Sign Up</button>
						</div>
					<?php echo form_close();?>
				
				</div> <!-- End of Employer Tab -->
				</div>
			</div>
		
		</div>
		<div class="col-md-3">
			<p>
				Sed accumsan augue a lacus luctus condimentum. Aenean aliquam id sapien id molestie. 
				Maecenas eu pharetra turpis. Aenean nec facilisis odio. Mauris sodales sodales suscipit. 
				Morbi rhoncus elit et egestas interdum. Ut et magna ac nisi ultrices mattis in sit amet leo. 
				Nunc consectetur egestas ligula, id vulputate ligula congue id. Pellentesque nec hendrerit arcu, at accumsan massa. 
				Etiam eu varius purus. Vivamus et purus risus. Nam vulputate tempus nulla, id tempor quam pellentesque sed. 
				Etiam mi est, tempus in dapibus sit amet, ultrices et nibh.
			</p>
		</div>
	</div>
