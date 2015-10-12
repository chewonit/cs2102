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
		<?php echo form_open('job/update/', $attributes); ?>
	
		<div id="dashboard-content" class="col-md-6">
			
			<section>
				<div class="form-group">
					<label for="inputTitle" class="col-sm-2 control-label">Title</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inputTitle" name="inputTitle" placeholder="Title" value="<?php echo ucwords($job_details->title); ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputDescription" class="col-sm-2 control-label">Description</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="inputDescription" name="inputDescription" rows="8" placeholder="Description" required><?php echo $job_details->description; ?></textarea>
					</div>
				</div>
				<input type="hidden" name="hiddenJobId" value="<?php echo $job_details->job_id; ?>">
				<input type="hidden" name="hiddenRegNo" value="<?php echo $job_details->company_reg_no; ?>">
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Update</button>
						<button type="button" class="btn btn-default btn-danger" 
						onClick="delete_job('<?php echo $job_details->job_id; ?>', '<?php echo $job_details->company_reg_no; ?>')">Delete Job</button>
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
					<input type="number" class="form-control" id="inputExperience" name="inputExperience" placeholder="Experience" value="<?php echo $job_details->experience; ?>" required>
				</div>
			</div>
			<div class="form-group">
				<label for="inputSkills" class="col-sm-2 control-label">Skills</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputSkills" name="inputSkills" placeholder="Skills" value="<?php echo ucwords($job_details->skills); ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Job ID</label>
				<div class="col-sm-10">
					<h5 class="profile-public-field"><?php echo $job_details->job_id; ?></h5>
				</div>
			</div>
			
		</div>
		
		<?php echo form_close(); ?>
		
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2>Job Applicants</h2>
			</div>
		</div>
	</div>
	
	<?php if(count($job_applications) == 0) : ?>
	
		<div class="row">
			<div class="col-md-12">
				No applications to view.
			</div>
		</div>
	
	<?php else :?>
	
		<?php for ($i = 0; $i < count($job_applications); $i++) : ?>
		<div class="row">
			<?php for ($j = 0; $j < 3; $j++, $i++) : ?>
			<?php if ( $i >= count($job_applications) ) : ?>
				<div class="col-md-4"></div>
			<?php else : ?>
				<div class="col-md-4">
					<?php $row = $job_applications[$i]; ?>
					<a class="company-employer-link-wrapper" href="<?php echo base_url('profile/' . rawurlencode($row->applicant) . '/'); ?>">
					<section class="company-employer-item">
						<h5><?php echo $row->applicant; ?></h5>
						<h6>
							Job ID: <?php echo $row->job_id; ?>
						</h6>
						<h6>
							Date Submitted: <?php echo $row->date_submitted; ?>
						</h6>
					</section>
					</a>
				</div>
			<?php endif ?>
			<?php endfor ?>
			<?php $i-- ?>
		</div>
		<?php endfor; ?>
	
	<?php endif ?>

	<script type="text/javascript">
		var jq = jQuery.noConflict();
		jq( document ).ready(function() {
			jq('[name="inputPublished"]').val("<?php echo $job_details->published ? 'true' : 'false'; ?>");
			jq('[name="inputCategory"]').val("<?php echo $job_details->category_id; ?>");
		});
		
		function delete_job(job_id, company_reg_no) {
		
			jq('<form action="<?php echo base_url("job/delete/") ?>" method="POST">' + 
			'<input type="hidden" name="hiddenJobId2" value="' + job_id + '">' +
			'<input type="hidden" name="hiddenRegNo2" value="' + company_reg_no + '">' +
			'</form>').submit();
		}
	</script>
	
</div>