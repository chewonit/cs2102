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
	
	<div ="row">
	<div class="col-md-12">
				
	<?php foreach($jobs_list->result() as $row): ?>
		<section id="jobID" class="job-item"  >
			<div class="container-fluid" >
				<div class="row">
					<div class="col-md-9">
						<h4 class="job-item-header"><?php echo ucwords($row->title); ?></h4>
						<h5>
							<a class="link-nostyle" href="<?php echo base_url('profile/' . rawurlencode($row->company_reg_no) .'/' ); ?>">
								<?php echo ucwords($row->company_name); ?>
							</a>
						</h5>
						<h5><?php echo ucwords($row->name); ?></h5>
					</div>
					<div class="col-md-3 text-right">
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
						<?php echo $row->job_description ; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 job-item-btns">
																
						<?php if($show_apply) : ?>
						<?php echo form_open('job/apply_job/'); ?>
						<input type="hidden" name="hiddenJobId" value="<?php echo $row->job_id; ?>">
						<input type="hidden" name="hiddenApplicant" value="<?php echo $user_email; ?>">
						<button type="submit" class="btn btn-default btn-sm btn-success">Apply</button> 
						<?php echo form_close(); ?>
						<?php endif ?>
					</div>
				</div>
			</tr>
			</div>
		</section>
		<?php endforeach; ?>
	</div>
	</div>

</div>