<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo $page_title?></h1>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var jq = jQuery.noConflict();
		jq('#register-tabs a').click(function (e) {
			e.preventDefault()
			jq(this).tab('show')
		});

		jQuery.validator.addMethod("alphanumeric", function(value, element) {
			return this.optional(element) || /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9$&+,:;=?@#|'<>.-^*()%!]+)$/.test(value);
		}, "The input must contain Alphabets and Numbers."); 

		jq( document ).ready(function() {

			jq("#updateDetailsForm").validate({
				rules: {
					inputContact: {
						required: true,
						number: true
					}
				},
				messages: {
					inputContact: {
						required: "Please enter your contact number.",
						number: "Please enter a valid phone number."
					}
				}
			});
			
			jq("#chagePasswordForm").validate({
				rules: {
					inputPassword: {
						required: true,
						minlength: 8,
						alphanumeric: true
					},
					inputPassword2: {
						required: true,
						minlength: 8,
						alphanumeric: true,
						equalTo: "#inputPassword"
					}
				},
				messages: {
					inputPassword: {
						required: "Please enter your password.",
						minlength: "A minimum of length of 8 is required..",
						alphanumeric: "The password must contain Alphabets and Numbers."
					},
					inputPassword2: {
						required: "Please enter your password.",
						minlength: "A minimum of length of 8 is required..",
						alphanumeric: "The password must contain Alphabets and Numbers.",
						equalTo: "The passwords entered do not match."
					}
				}
			});
		});			
	</script>
	
	<div class="row">
	
		<div class="col-md-6 dashboard-content">
			
			<section>
				<?php $attributes = array('class' => 'form-horizontal'); ?>
				<?php echo form_open('dashboard/', $attributes); ?>
				<div class="form-group">
					<label for="inputLoginEmail" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="inputLoginEmail" name="inputLoginEmail" placeholder="Email" value="<?php echo $user_info['email'] ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="First Name" value="<?php echo $user_info['first_name'] ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="Last Name" value="<?php echo $user_info['last_name'] ?>" readonly>
					</div>
				</div>
				<?php echo form_close(); ?>
			</section>
		
		</div>
		<div class="col-md-6 dashboard-content">
			<section>
				<?php $attributes = array('class' => 'form-horizontal'); ?>
				<?php echo form_open('dashboard/', $attributes); ?>
					<div class="form-group">
					<label for="inputGender" class="col-sm-2 control-label">Gender</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputGender" name="inputGender" placeholder="Gender" value="<?php echo $user_info['gender'] ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="inputNationality" class="col-sm-2 control-label">Nationality</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputNationality" name="inputNationality" placeholder="Nationality" value="<?php echo $user_info['nationality'] ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="inputDob" class="col-sm-2 control-label">Date of Birth</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputDob" name="inputDob" placeholder="Nationality" value="<?php echo $user_info['dob'] ?>" readonly>
					</div>
				</div>
				<?php echo form_close(); ?>
			</section>
		</div>		
	</div>
	
	<div class="row">
		
		<div class="col-md-6 dashboard-content">
			<section>
				<h4>Change Password</h4>
				
				<?php if($submitted && $form_validation && $form_target == "password") : ?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4>Updated successfully.</h4>
					</div>
				<?php elseif( $submitted && !$form_validation &&  $form_target == "password") : ?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4>Please check your form input entries.</h4>
						<?php echo validation_errors(); ?>
					</div>
				<?php elseif( $submitted && $form_validation && $form_target == "password_error" ) : ?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4>An error encountered when creating your account.</h4>
						<br />Please contact the administrator for assistance. 
					</div>
				<?php endif ?>
				
				<?php $attributes = array('class' => 'form-horizontal', 'id' => 'chagePasswordForm'); ?>
				<?php echo form_open('dashboard/change_password', $attributes); ?>
				<div class="form-group">
					<label for="inputPassword" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword2" class="col-sm-2 control-label">Confirm Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="inputPassword2" name="inputPassword2" placeholder="Password" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Change Password</button>
					</div>
				</div>
				<?php echo form_close(); ?>
			</section>
			
		</div>
		
		<div class="col-md-6 dashboard-content">
			
			<section>
				<h4>Other Details</h4>
				
				<?php if($submitted && $form_validation && $form_target == "update") : ?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4>Updated successfully.</h4>
					</div>
				<?php elseif( $submitted && !$form_validation &&  $form_target == "update") : ?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4>Please check your form input entries.</h4>
						<?php echo validation_errors(); ?>
					</div>
				<?php elseif( $submitted && $form_validation && $form_target == "update_error" ) : ?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4>An error encountered when creating your account.</h4>
						<br />Please contact the administrator for assistance. 
					</div>
				<?php endif ?>
				
				<?php $attributes = array('class' => 'form-horizontal', 'id' => 'updateDetailsForm'); ?>
				<?php echo form_open('dashboard/update/', $attributes); ?>
				<div class="form-group">
					<label for="inputContact" class="col-sm-2 control-label">Contact</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" id="inputContact" name="inputContact" placeholder="Contact Number" value="<?php echo $user_info['contact'] ?>" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Update Details</button>
					</div>
				</div>
				<?php echo form_close(); ?>
			</section>
		</div>
		
	</div>


</div>