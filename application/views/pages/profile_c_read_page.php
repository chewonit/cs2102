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
			
			<section>
			<?php $attributes = array('class' => 'form-horizontal'); ?>
			<?php echo form_open('#', $attributes); ?>
			
			
			<div class="form-group">
				<label class="col-sm-1 control-label">Company Reg. No.</label>
				<div class="col-sm-10">
					<h5 class="profile-public-field"><?php echo $company_profile->company_reg_no ?></h5>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">Company Name</label>
				<div class="col-sm-10">
					<h5><?php echo ucwords($company_profile->company_name) ?></h5>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">Location</label>
				<div class="col-sm-10">
					<h5><?php echo ucwords($company_profile->location) ?></h5>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">Description</label>
				<div class="col-sm-10">
					<h5><?php echo ucwords($company_profile->description) ?></h5>
				</div>
			</div>
			
			<?php echo form_close(); ?>
			</section>
		
		</div>
	</div>

</div>