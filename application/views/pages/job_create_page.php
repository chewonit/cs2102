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
	
		<?php $attributes = array('class' => 'form-horizontal'); ?>
		<?php echo form_open('job/create_job/', $attributes); ?>
	
		<div id="dashboard-content" class="col-md-6">
			
			<section>
				<div class="form-group">
					<label for="inputTitle" class="col-sm-2 control-label">Title</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputTitle" name="inputTitle" placeholder="Title" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputDescription" class="col-sm-2 control-label">Description</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="inputDescription" name="inputDescription" rows="8" placeholder="Description" required></textarea>
					</div>
				</div>
				<input type="hidden" name="hiddenRegNo" value="<?php echo $job_details->company_reg_no; ?>">
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Create Job</button>
					</div>
				</div>
			
			</section>
			
		</div>
		<div class="col-md-6">
		
			<div class="form-group">
				<label for="inputPublished" class="col-sm-2 control-label">Publish Job</label>
				<div class="col-sm-10">
					<select class="form-control" id="inputPublished" name="inputPublished" required>
						<option value="">Select One</option>
						<option value="true">True</option>
						<option value="false">False</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputCategory" class="col-sm-2 control-label">Category</label>
				<div class="col-sm-10">
					<select name="inputCategory" id="inputCategory" class="form-control" required>
						<option value="">Category</option>
						
						<?php foreach($job_categories as $row) : ?>
							<option value="<?php echo $row->category_id; ?>">
								<?php echo $row->name; ?>
							</option>
						<?php endforeach ?>
						
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputExperience" class="col-sm-2 control-label">Experience (years)</label>
				<div class="col-sm-10">
					<input type="number" class="form-control" id="inputExperience" name="inputExperience" placeholder="Experience" value="0" required>
				</div>
			</div>
			<div class="form-group">
				<label for="inputSkills" class="col-sm-2 control-label">Skills</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputSkills" name="inputSkills" placeholder="Skills">
				</div>
			</div>
			
		</div>
		
		<?php echo form_close(); ?>
	</div>

</div>