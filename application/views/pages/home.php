<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="home-header">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="home-message">
					<h1><strong></Strong>Make Today Great</h1>
					<?php $attributes = array('class' => 'form-inline', 'id' => 'searchForm'); ?>
					<?php echo form_open('search/', $attributes); ?>
						<div class="form-group">
							<input type="text" class="form-control" id="inputSearch" name="inputSearch" placeholder="Search Jobs">
						</div>
						<button type="submit" class="btn btn-default">Search</button>
					<?php echo form_close() ?>
				</div>
			</div>
		</div>
	</div>
</section>
	
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>Latest Jobs</h1>
			</div>
		</div>
	</div>

	<div class="row text-center">
	
		<?php foreach($latest_jobs->result() as $row): ?>
		<div class="col-md-6">
			<a class="job-featured" href="<?php echo base_url('job/'.$row->job_id) ?>">
				<section class="job-item">
					<h4><?php echo ucwords($row->title); ?></h4>
					<h5><?php echo ucwords($row->company_name); ?></h5>
					<p><?php 
							$str = $row->description;
							if (strlen($str) > 140) {
								$str = substr($str, 0, 137) . '...';
							}
							echo $str;
						?>
					</p>
				</section>
			</a>
		</div>
		<?php endforeach; ?>

	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>Job Offers</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
	
		<div class="col-md-9">
		
			<p>
				<h4>Project Description</h4>
				The system is a catalogue of job offers and job applicants. 
				Employers can create job offers and search the applicants' database. 
				Job applicants can advertise themselves, search the job offers' database.  
				projects and fund projects. Basic forms of automatic matching can be investigated. 
				Administrators can create, modify and delete all entries.  
				Please refer to <a href="http://www.monster.com.sg" target="_blank">www.monster.com.sg</a>, 
				<a href="http://www.dice.com" target="_blank">www.dice.com</a> or other job offer sites for examples and data.
			
			</p>
		
		</div>
		<div class="col-md-3">
			<a href ="https://github.com/chewonit/cs2102" target="_blank">
				<button type="button" class="btn btn-primary btn-lg btn-block">
					<i class="fa fa-github-square fa-3x"></i><br />
					Find us on GitHub
				</button>
			</a>
		</div>
	</div>
</div>
