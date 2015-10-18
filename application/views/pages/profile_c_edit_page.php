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
				<?php echo form_open('profile/updateCompanyProfile/', $attributes); ?>
				<div class="form-group">
					<label for="inputRegNo" class="col-sm-2 control-label">Registration No.</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputRegNo" name="inputRegNo" placeholder="<?php echo $company_profile->company_reg_no; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="inputCompanyName" class="col-sm-2 control-label">Company Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputCompanyName" name="inputCompanyName" placeholder="<?php echo $company_profile->company_name; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="inputAddress" class="col-sm-2 control-label">Address</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Address" value="<?php echo $company_profile->address; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputDescription" class="col-sm-2 control-label">Description</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="inputDescription" name="inputDescription" rows="8" placeholder="Description" required><?php echo $company_profile->description; ?></textarea>
					</div>
				</div>
				<input type="hidden" name="hiddenRegNo" value="<?php echo $company_profile->company_reg_no; ?>">
				<input type="hidden" name="hiddenCompanyName" value="<?php echo $company_profile->company_name; ?>">
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Update</button>
					</div>
				</div>
			<?php echo form_close(); ?>
			</section>
		
		</div>
		<div class="col-md-6">
			
			<?php if($is_company_admin) : ?>
	
			<div class="row">
				<div class="col-md-12">
					<h4>Go to Company Admin Page</h4>
					<a href="<?php echo base_url('company/') ?>" >
						<button class="btn btn-default btn-primary">Company Admin</button>
					</a>
				</div>
			</div>

			<?php endif ?>
			
		</div>
	</div>
	
	

</div>