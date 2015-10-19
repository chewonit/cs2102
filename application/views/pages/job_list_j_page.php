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
			
			<?php foreach($job_list as $row): ?>
				<section class="job-item">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-9">
								<h4 class="job-item-header">
									<a href="<?php echo base_url("job/$row->job_id/") ?>">
										<?php echo ucwords($row->title); ?>
									</a>
								</h4>
								<h5><?php echo ucwords($row->company_name); ?></h5>
							</div>
							<div class="col-md-3 text-right">
								<h5><?php echo ucwords($row->location); ?></h5>
								<h6><?php echo $row->date_created ?></h6>
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
							<div class="col-md-12">
							<font size="2.2">Experience: 
								<?php 
									$str = $row->experience;
									if (strlen($str) > 300) {
										$str = substr($str, 0, 297) . '...';
									}
									echo $str;
								?> years</font>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
							<font size="2.2">Skills:
								<?php 
									$str = $row->skills;
									if (strlen($str) > 300) {
										$str = substr($str, 0, 297) . '...';
									}
									echo $str;
								?></font>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 job-item-btns">
								<a href="<?php echo base_url("job/$row->job_id/") ?>">
									<button class="btn btn-default btn-sm">More Info</button>
								</a>
								<button type="button" class="btn btn-default btn-danger" 
								onClick="delete_application('<?php echo $row->job_id; ?>', '<?php echo $row->applicant; ?>')">Delete Application</button>
							</div>
						</div>
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