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
					<?php foreach($company_reg_no->result() as $row) : ?>
					<input type="text" class="form-control" id="inputRegNo" name="inputRegNo" placeholder="<?php echo $row->company_reg_no; ?>" readonly>
					<?php endforeach ?>	
				</div>
			</div>
			<div class="form-group">
				<label for="inputCompanyName" class="col-sm-2 control-label">Company Name</label>
				<div class="col-sm-10">
					<?php foreach($company_name->result() as $row2) : ?>
					<input type="text" class="form-control" id="inputCompanyName" name="inputCompanyName" placeholder="<?php echo $row2->company_name; ?>" readonly>
					<?php endforeach ?>	
				</div>
			</div>
			<div class="form-group">
				<label for="inputLocation" class="col-sm-2 control-label">Location</label>
				<div class="col-sm-10">
					<?php foreach($location->result() as $row3) : ?>
					<input type="text" class="form-control" id="inputLocation" name="inputLocation" rows="3" placeholder="Location" value="<?php echo $row3->location; ?>" required>
					<?php endforeach ?>
				</div>
			</div>
			<div class="form-group">
				<label for="inputDescription" class="col-sm-2 control-label">Description</label>
				<div class="col-sm-10">
					<?php foreach($description->result() as $row4) : ?>
					<input type="text" class="form-control" id="inputDescription" name="inputDescription" rows="3" placeholder="Description" value="<?php echo $row4->description; ?>" required>
					<?php endforeach ?>
				</div>
			</div>
			<input type="hidden" name="inputEmail" value="<?php echo $user_info['email'] ?>">
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Update</button>
				</div>
			</div>
			
				<?php //if ($profile_updated) : ?>
					<!--<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4>Updated Successfully.</h4>
					</div>
				<?php //else : ?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4>Update Failed.</h4>
						<?php //echo validation_errors(); ?>
					</div>-->
				<?php //endif ?>
			
			<?php echo form_close(); ?>
			</section>
		
		</div>
		<div class="col-md-6">
		</div>
	</div>

</div>