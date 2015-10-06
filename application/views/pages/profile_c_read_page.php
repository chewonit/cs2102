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

	<div class="row">
	
		<div id="dashboard-content" class="col-md-6">
			
			<section>
			<?php $attributes = array('class' => 'form-horizontal'); ?>
			<?php echo form_open('dashboard/', $attributes); ?>
			<div class="form-group">
				<label for="inputLoginEmail" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="inputLoginEmail" name="inputLoginEmail" placeholder="Email" readonly>
				</div>
			</div>
			<div class="form-group">
				<label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="First Name" readonly>
				</div>
			</div>
			<div class="form-group">
				<label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="Last Name" readonly>
				</div>
			</div>
			<?php echo form_close(); ?>
			</section>
			
			<section>
			<h4>Change Password</h4>
			
			<?php $attributes = array('class' => 'form-horizontal', 'id' => 'chagePasswordForm'); ?>
			<?php echo form_open('dashboard/', $attributes); ?>
			<div class="form-group">
				<label for="inputChangePassword" class="col-sm-2 control-label">Password</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="inputChangePassword" name="inputChangePassword" placeholder="Password" required>
				</div>
			</div>
			<div class="form-group">
				<label for="inputChangePassword2" class="col-sm-2 control-label">Confirm Password</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="inputChangePassword2" name="inputChangePassword2" placeholder="Password" required>
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
		<div class="col-md-6">
		</div>
	</div>

</div>