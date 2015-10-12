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
		
			<?php $string = $_SERVER['REQUEST_URI']; ?>
			<?php $code = explode ("/", $string ) ?>
			<?php $_SESSION['jobid'] = $code[3] ; ?>
 		</div>
		<div class="col-md-6">
		</div>
	</div>
	
	<div ="row">
	<div class="col-md-12">
				
	<?php foreach($jobs_list->result() as $row): ?>
		<section id="jobID" class="job-item"  >
			<div class="container-fluid" >
				<div class="row">
					<div class="col-md-9">
						<h4 class="job-item-header"><?php echo $row->title; ?></h4>
						<h5>
							<a class="link-nostyle" href="<?php echo base_url('profile/' . rawurlencode($row->company_name) .'/' ); ?>">
								<?php echo ucwords($row->company_name); ?>
							</a>
						</h5>
						<h5><?php echo $row->name; ?></h5>
					</div>
					<div class="col-md-3 text-right">
						<h5>Location: <?php echo $row->location; ?></h5>
						<h6>Date Created: <?php echo $row->date_created ?></h6>
						<h6>Job ID: <?php echo $row->job_id ?></h6>
					</div>
				</div>
					<div class="row">
						<div class="col-md-12"> <?php echo $row->description ; ?> </font>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					<font size="2.2">Experience: <?php echo $row->experience; ?> </font>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					<font size="2.2">Skills: <?php echo $row->skills; ?> </font>
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