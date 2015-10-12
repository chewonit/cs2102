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
			Edit Job fields
		</div>
		<div class="col-md-6">
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<br />
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<h2>Job Applications (Beta)</h2><br />
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

</div>