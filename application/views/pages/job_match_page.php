<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">

<?php $email = $_SESSION['email']; ?>

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo $page_title?></h1>
				
			</div>
		</div>
	</div>
	
	<?php if( count($job_list) == 0 ) : ?>
	<div class="row">
		<div class="col-md-12">
			<h4>No applications.</h4>
		</div>
	</div>
	<?php endif ?>
	
	<div class="row">
		<div class="col-md-12">
			<h4> Suggested job offers</h4>
			<br />
			<?php foreach($job_list as $row): ?>
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
								
								<?php if($is_jobseeker) : ?>
								<button type="submit" class="btn btn-default btn-sm btn-success">Apply</button> 
								<?php endif ?>
							</div>
						</div>
						</tr>
					</div>
				</section>
			<?php endforeach; ?>
	
		</div>
	</div>
	
	<script type="text/javascript">
		function delete_application(job_id, applicant) {
		
			jq('<form action="<?php echo base_url("job/delete_application/") ?>" method="POST">' + 
			'<input type="hidden" name="hiddenJobId2" value="' + job_id + '">' +
			'<input type="hidden" name="hiddenApplicant2" value="' + applicant + '">' +
			'</form>').submit();
		}
	</script>

</div>