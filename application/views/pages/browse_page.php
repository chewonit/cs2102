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
	
		<div class="col-md-3">
			
			<?php $attributes = array('class' => 'form', 'id' => 'browseForm'); ?>
			<?php echo form_open('', $attributes)?>
				
				<div class="form-group">
					<select name="inputCategory" class="form-control" onchange="this.form.submit()" ; >
						<option value="">Jobs By Category</option>					
						<?php foreach($category_list->result() as $category) : ?>
							<option value="<?php echo $category->category_id ?>">
								<?php echo $category->name ?>
							</option>
						<?php endforeach ?>	
					</select>
					
					
				</div>

				<div class="form-group">
					<select name='inputExp' class="form-control" onchange="this.form.submit();" >
						<option value="">Jobs By Experience</option>
						<option value="1">Less than 1 Year</option>
						<option value="2">1 to 4 Years</option>
						<option value="3">4 to 7 Years</option>
						<option value="4">7 to 10 Years</option>
						<option value="5">More than 10 Years</option>
					</select>
					
				</div>
				
				<div class="form-group">
					<select name='inputCompany' class="form-control" onchange="this.form.submit();" >
						<option value="">Jobs By Company</option>
						<?php foreach($company_list->result() as $company) : ?>
							<option value="<?php echo ucwords($company->company_reg_no) ?>">
								<?php echo $company->company_name ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				
				<div class="form-group">
					<select name='inputLocation' class="form-control" onchange="this.form.submit();" >
						<option value="">Jobs By Location</option>
						<?php foreach($location_list->result() as $location) : ?>
							<option value="<?php echo $location->location ?>">
								<?php echo $location->location ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				
				<div class="form-group">
					<select name='inputSkills' class="form-control" onchange="this.form.submit();" >
						<option value="">Jobs By Skills</option>
						<?php foreach($skills_list->result() as $skills) : ?>
							<option value="<?php echo $skills->skills ?>">
								<?php echo $skills->skills ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				
			<?php echo form_close() ?>
			
			<a href="<?php echo base_url('browse/'); ?>">
				<button class="btn btn-default btn-primary">Clear Filters</button>
			</a>
		</div>
	
		<div class="col-md-9">
									
			<?php if ( count($browse_query->result()) == 0) : ?>

			<h4>No results found.</h4>
			
			<?php else : ?>						
									
			<?php foreach($browse_query->result() as $row): ?>
				<section id="jobID" class="job-item"  >
					<div class="container-fluid" >
						<div class="row">
							<div class="col-md-9">
								<h4 class="job-item-header"><a href="job/<?php echo $row->job_id?>"><?php echo $row->title; ?></a></h4>
								<h5>
									<a href="<?php echo base_url('profile/'.rawurlencode($row->company_reg_no).'/'); ?>">
										<?php echo ucwords($row->company_name); ?>
									</a>
								</h5>
								<h5><?php echo $row->name ?></h5>
							</div>
							<div class="col-md-3 text-right-md">
								<h5><?php echo ucwords($row->location); ?></h5>
								<h6><?php echo $row->date_created ?></h6>
								<h6>Job ID: <?php echo $row->job_id ?></h6>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h5>Experience: <?php echo $row->experience; ?> years</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h5>Skills: <?php echo $row->skills; ?></h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?php 
									$str = $row->job_description;
									if (strlen($str) > 300) {
										$str = substr($str, 0, 297) . '...';
									}
									echo $str;
								?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 job-item-btns">
								
								<button class="btn btn-default btn-sm" onclick="document.location.href='job/<?php echo $row->job_id?>'">More Info</button>
								
								<?php if($is_login) : ?>
								<button type="submit" class="btn btn-default btn-sm btn-success">Apply</button> 
								<?php endif ?>
							</div>
						</div>
						</tr>
					</div>
				</section>
				<?php endforeach; ?>
			<?php endif ?>
		</div>
		
		<script type="text/javascript">
			var jq = jQuery.noConflict();
			
			jq(document).ready(function() {
				jq('[name="inputCategory"]').val("<?php echo $browse_cat; ?>");
				jq('[name="inputExp"]').val("<?php echo $browse_exp; ?>");
				jq('[name="inputCompany"]').val("<?php echo $browse_name; ?>");
				jq('[name="inputLocation"]').val("<?php echo $browse_loc; ?>");
				jq('[name="inputSkills"]').val("<?php echo $browse_skill; ?>");
			});
		</script>
	</div>
</div>