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
		
		<!--<script type="text/javascript">
				var jq = jQuery.noConflict();
				
				jq( document ).ready(function() {

					jq("#createForm").validate({
						rules: {
							inputRegNo: {
								remote: {
									url: '<?php echo base_url(); ?>/company/check_unique_regNo',
									type: 'post'
								}
							},
						},
						messages: {
							inputEmail: {
								remote: "Company has already been registered."
							},
						},
						errorPlacement: function(error, element) {
							if (element.attr("name") == "inputRegNo")
								error.insertAfter(element.parent());
							else
								error.insertAfter(element);
						}
					});
				});			
			</script>-->
		
		
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
				<label for="inputLocation" class="col-sm-2 control-label">Location</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputLocation" name="inputLocation" rows="3" placeholder="Location" required>
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
			
				<?php //if ($profile_updated) : ?>
					<!--<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4>Company Created.</h4>
					</div>
				<?php //else : ?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4>Failed to create company.</h4>
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