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
			
			<?php $attributes = array('class' => 'form-horizontal'); ?>
			<?php echo form_open('profile/create/', $attributes); ?>
			<div class="col-md-12">
				<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="inputLoginEmail" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="inputLoginEmail" name="inputLoginEmail" placeholder="<?php echo $email; ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="<?php echo $first_name; ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="<?php echo $last_name; ?>" readonly>
								
							</div>
						</div>
						<div class="form-group">
							<label for="inputProfileAbout" class="col-sm-2 control-label">About</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="inputProfileAbout" name="inputProfileAbout" rows="3" required placeholder="About"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="inputProfileEducation" class="col-sm-2 control-label">Education</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="inputProfileEducation" name="inputProfileEducation" rows="3" placeholder="Education History" required></textarea>
							
								
							</div>
						</div>
						<div class="form-group">
							<label for="inputProfileWork" class="col-sm-2 control-label">Work</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="inputProfileWork" name="inputProfileWork" rows="3" placeholder="Work History" required></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default" >Update</button>
							</div>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<label for="inputProfileAddress" class="col-sm-2 control-label">Address</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="inputProfileAddress" name="inputProfileAddress" rows="3" placeholder="Address" required></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="inputSkills" class="col-sm-2 control-label">Skills</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="inputSkills" name="inputSkills" rows="3" placeholder="Skills"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="inputInterest" class="col-sm-2 control-label">Interest Areas</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="inputInterest" name="inputInterest" rows="3" placeholder="Interest Areas" required></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="inputLocation" class="col-sm-2 control-label">Preferred Location</label>
							<div class="col-sm-10">
								<select class="form-control" id="inputLocation" name="inputLocation" required>
									<option value="central">Central</option>
									<option value="north">North</option>
									<option value="south">South</option>
									<option value="east">East</option>
									<option value="west">West</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				</div>
				
			</div>
			<?php echo form_close(); ?>
		
		</div>
	
	<?php else : ?>
	
		<div class="col-md-12">
			
			<?php foreach($resume_profile->result() as $row): ?>
			<?php $attributes = array('class' => 'form-horizontal'); ?>
			<?php echo form_open('profile/update/', $attributes); ?>
			<div class="col-md-12">
				<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="inputLoginEmail" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="inputLoginEmail" name="inputLoginEmail" placeholder="<?php echo $row->owner; ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="<?php echo $row->first_name; ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="<?php echo $row->last_name; ?>" readonly>
								
							</div>
						</div>
						<div class="form-group">
							<label for="inputProfileAbout" class="col-sm-2 control-label">About</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="inputProfileAbout" name="inputProfileAbout" rows="3" required><?php echo $row->description; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="inputProfileEducation" class="col-sm-2 control-label">Education</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="inputProfileEducation" name="inputProfileEducation" rows="3" required><?php echo $row->edu_history; ?></textarea>
							
								
							</div>
						</div>
						<div class="form-group">
							<label for="inputProfileWork" class="col-sm-2 control-label">Work</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="inputProfileWork" name="inputProfileWork" rows="3"  required><?php echo $row->work_history; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default" >Update</button>
							</div>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<label for="inputProfileAddress" class="col-sm-2 control-label">Address</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="inputProfileAddress" name="inputProfileAddress" rows="3"  required><?php echo $row->address; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="inputSkills" class="col-sm-2 control-label">Skills</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="inputSkills" name="inputSkills" rows="3" placeholder="Skills"><?php echo $row->skills; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="inputInterest" class="col-sm-2 control-label">Interest Areas</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="inputInterest" name="inputInterest" rows="3" placeholder="Interest Areas"  required><?php echo $row->interest_area; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="inputLocation" class="col-sm-2 control-label">Preferred Location</label>
							<div class="col-sm-10">
								<select class="form-control" id="inputLocation" name="inputLocation" required>
									<option value="central">Central</option>
									<option value="north">North</option>
									<option value="south">South</option>
									<option value="east">East</option>
									<option value="west">West</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				</div>
				
				<script type="text/javascript">
					var jq = jQuery.noConflict();
					jq( document ).ready(function() {
						jq('[name="inputLocation"]').val("<?php echo $row->location_pref; ?>");
					});
				</script>
				
			</div>
			<?php echo form_close(); ?>
			<?php endforeach; ?>
		
		</div>
	<?php endif ?>

	</div>
</div>
			