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
					<h4><?php echo $row->title; ?></h4>
					<h5><?php echo $row->company_name; ?></h5>
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
			
			<hr />
		
			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
				Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
				Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. 
				Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. 
				In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. 
				Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. 
				Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. 
				Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. 
				Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, 
				sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, 
				lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. 
				Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. 
				Donec sodales sagittis magna.
			</p>

			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
				Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
				Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. 
				Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. 
				In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. 
				Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. 
				Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. 
				Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. 
				Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, 
				sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, 
				lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. 
				Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. 
				Donec sodales sagittis magna.
			</p>
		
		</div>
		<div class="col-md-3">
			<div class="well">
				User ID: demo@demo.com<br />
				Password: pass1234
			</div>
			<div class="well">
				Is Logged in: <?php echo $is_login ? 'True' : 'False'; ?>
			</div>
		</div>
	</div>
</div>
