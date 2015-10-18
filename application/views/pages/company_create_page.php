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
				<?php $attributes = array('class' => 'form-horizontal', 'id' => 'createForm'); ?>
				<?php echo form_open('company/create_company/', $attributes); ?>
				<div class="form-group">
					<label for="inputRegNo" class="col-sm-2 control-label">Registration No.</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputRegNo" name="inputRegNo" placeholder="Company Registration Number" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputCompanyName" class="col-sm-2 control-label">Company Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputCompanyName" name="inputCompanyName" placeholder="Company Name" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputAddress" class="col-sm-2 control-label">Address</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputAddress" name="inputAddress" rows="3" placeholder="Address" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputDescription" class="col-sm-2 control-label">Description</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputDescription" name="inputDescription" rows="3" placeholder="Description" required>
					</div>
				</div>
				
				<input type="hidden" name="inputEmail" value="<?php echo $user_info['email'] ?>">
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Create</button>
					</div>
				</div>
				
				<?php echo form_close(); ?>
			</section>
		</div>
		<div class="col-md-6">
		</div>
	</div>

</div>