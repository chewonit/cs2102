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
	
	
	<div class="col-md-15">
				
	<?php foreach($jobs_list->result() as $row): ?>
		<section id="jobID" class="job-item"  >
			<div class="container-fluid" >
				<div class="row">
					<div class="col-md-9">
						<h4 class="job-item-header"><a href="#"><?php echo $row->title; ?></a></h4>
						<h5><?php echo $row->company_name; ?></h5>
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
																
						<?php if($is_login) : ?>
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