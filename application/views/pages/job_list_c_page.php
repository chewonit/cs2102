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

	<div class="row">
	
		<div id="dashboard-content" class="col-md-6">
		</div>
		<div class="col-md-6"> 
		<?php $sql = "SELECT c.company_name FROM company c, company_employer ce WHERE ce.employer= ? AND ce.company_reg_no=c.company_reg_no" ; ?>
		<?php $query = $this->db->query($sql, array($email)) ; ?>
		
		<?php foreach($query->result() as $data) ;?>
			<h3>Displaying ALL Jobs Created by: 
			<BR><?php echo $data->company_name ;?></h3>
		</div>
	</div>
	
	
	<?php $sql = "SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, 
	        c.company_name, c.location, 
			u.email, e.employer
			FROM jobs j , company c , users u, company_employer e
			WHERE e.employer= ? AND c.company_reg_no=j.company_reg_no AND e.company_reg_no=c.company_reg_no 
			GROUP BY j.date_created DESC" ; ?>
			
	<?php $query = $this->db->query($sql, array($email)) ; ?>
			
			<?php foreach($query->result() as $row): ?>
				<section class="job-item">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-9">
								<h4 class="job-item-header"><a href="#"><?php echo $row->title; ?></a></h4>
								<h5><?php echo $row->company_name; ?></h5>
							</div>
							<div class="col-md-3 text-right">
								<h5><?php echo $row->location; ?></h5>
								<h6><?php echo $row->date_created ?></h6>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?php 
									$str = $row->description;
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
								<button class="btn btn-default btn-sm">More Info</button>
							</div>
						</div>
					</div>
				</section>
				<?php endforeach; ?>

</div>