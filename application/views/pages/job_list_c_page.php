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
	
		<div class="col-md-12"> 
			<h3><?php echo ucfirst($company_name) ;?></h3>
			<a href="<?php echo base_url('job/create/'); ?>">
				<button class="btn btn-default btn-primary">Create Job</button>
			</a>
			<br /><br />

			<?php if( count($job_list) == 0 ) : ?>
				<h4>No jobs.</h4>
			<?php endif ?>

			<?php foreach($job_list as $row): ?>
			
				<section class="job-item">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-9">
								<h4 class="job-item-header">
									<a href="<?php echo base_url('job/'.$row->job_id.'/') ?>">
										<?php echo ucwords($row->title); ?>
									</a>
								</h4>
								<h5><?php echo ucwords($row->company_name); ?></h5>
							</div>
							<div class="col-md-3 text-right-md">
								<h5><?php echo ucwords($row->address); ?></h5>
								<h6><?php echo $row->date_created ?></h6>
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
								<a href="<?php echo base_url('job/'.$row->job_id.'/') ?>">
									<button class="btn btn-default btn-sm">More Info</button>
								</a>
							</div>
						</div>
					</div>
				</section>
			<?php endforeach; ?>
		
		</div>
		
	</div>

</div>