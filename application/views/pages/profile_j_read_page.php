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
		<div class="col-md-12">
			
			<?php $attributes = array('class' => 'form-horizontal'); ?>
			<?php echo form_open('#', $attributes); ?>
			
			<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<h5 class="profile-public-field"><?php echo $user_data->email ?></h5>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">First Name</label>
						<div class="col-sm-10">
							<h5><?php echo ucwords($user_data->first_name) ?></h5>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Last Name</label>
						<div class="col-sm-10">
							<h5><?php echo ucwords($user_data->last_name) ?></h5>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Date of Birth</label>
						<div class="col-sm-10">
							<h5><?php echo $user_data->dob ?></h5>
						</div>
					</div>

				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-sm-2 control-label">Nationality</label>
						<div class="col-sm-10">
							<h5><?php echo ucwords($user_data->nationality) ?></h5>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Gender</label>
						<div class="col-sm-10">
							<h5><?php echo ucwords($user_data->gender) ?></h5>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Contact</label>
						<div class="col-sm-10">
							<h5><?php echo ucwords($user_data->contact) ?></h5>
						</div>
					</div>
				</div>
			</div>
			</div>
			
			<?php echo form_close(); ?>
			
			<hr />
			
		</div>
	</div>
		
	<div class="row">
		<div class="col-md-12">
		
			<?php if ( is_null($user_profile) ) : ?>
			
			<h4>This user has not created a public profile.</h4>
			
			<?php else : ?>
		
			<?php $attributes = array('class' => 'form-horizontal'); ?>
			<?php echo form_open('#', $attributes); ?>
			
			<div class="container-fluid">
			<div class="row">
			
				<div class="col-md-6">
			
					<div class="form-group">
						<label class="col-sm-2 control-label">Address</label>
						<div class="col-sm-10">
							<h5 class="profile-public-field"><?php echo $user_profile->address ?></h5>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10">
							<h5><?php echo $user_profile->description ?></h5>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Work History</label>
						<div class="col-sm-10">
							<h5><?php echo $user_profile->work_history ?></h5>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Edu History</label>
						<div class="col-sm-10">
							<h5><?php echo $user_profile->edu_history ?></h5>
						</div>
					</div>
				
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-sm-2 control-label">Location Preference</label>
						<div class="col-sm-10">
							<h5><?php echo $user_profile->location_pref ?></h5>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Skills</label>
						<div class="col-sm-10">
							<h5 class="profile-public-field"><?php echo $user_profile->skills ?></h5>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Interest Areas</label>
						<div class="col-sm-10">
							<h5><?php echo $user_profile->interest_area ?></h5>
						</div>
					</div>
				</div>
				
			</div>
			</div>
			<?php echo form_close(); ?>
			
			<?php endif ?>
			
		</div>
	</div>

</div>