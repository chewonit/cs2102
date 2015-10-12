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
	
	<?php if ( count($resume_profile->result()) == 0) : ?>
	
		<div class="col-md-12">
			<h4>No profile found.</h4>
		</div>
	
	<?php else : ?>
	
		<div class="col-md-12">
			<div class="job-list">
				<?php foreach($resume_profile->result() as $row): ?>
			
				<div id="dashboard-content" class="col-md-6">
					
					<section>
					<?php $attributes = array('class' => 'form-horizontal'); ?>
					<?php echo form_open('profile/update/', $attributes); ?>
					
					<div class="form-group">
						<label for="inputLoginEmail" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							
							<input type="email" class="form-control" id="inputLoginEmail" name="inputLoginEmail" placeholder="<?php echo $row->owner; ?>" readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
						<div class="col-sm-10">
							<?php foreach($first_name->result() as $row2) : ?>
							
							<input type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="<?php echo $row2->first_name; ?>" readonly>
								<?php endforeach ?>	
						</div>
					</div>
					<div class="form-group">
						<label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
						<div class="col-sm-10">
							<?php foreach($last_name->result() as $row3) : ?>
							<input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="<?php echo $row3->last_name; ?>" readonly>
							<?php endforeach ?>	
							
						</div>
					</div>
					<div class="form-group">
						<label for="inputProfileAddress" class="col-sm-2 control-label">Address</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="inputProfileAddress" name="inputProfileAddress" rows="3"  required></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="inputProfileAbout" class="col-sm-2 control-label">About</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="inputProfileAbout" name="inputProfileAbout" rows="3" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="inputProfileEducation" class="col-sm-2 control-label">Education</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="inputProfileEducation" name="inputProfileEducation" rows="3" required></textarea>
						
							
						</div>
					</div>
					<div class="form-group">
						<label for="inputProfileWork" class="col-sm-2 control-label">Work</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="inputProfileWork" name="inputProfileWork" rows="3"  required></textarea>
						</div>
						<script>
						var workhistory = "<?php echo $row->work_history; ?>";
						var eduhistory = "<?php echo $row->edu_history; ?>";
						var about = "<?php echo $row->description; ?>";
						var add="<?php echo $row->address; ?>";
						document.getElementById('inputProfileWork').value = workhistory;
						document.getElementById('inputProfileEducation').value = eduhistory;
						document.getElementById('inputProfileAbout').value = about;
						document.getElementById('inputProfileAddress').value = add;
						</script>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default" >Update</button>
						</div>
					</div>
					<?php echo form_close(); ?>
					</section>
				</div>
				<?php endforeach; ?>
				
			</div>
		</div>
	<?php endif ?>

	</div>
</div>
			