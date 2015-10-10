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
	
	<?php $own='' ?>
	<?php $wor='' ?>
	<?php $des='' ?>
	<?php $add='' ?>
	<?php $edu='' ?>
	
	<div class="row">
	
		<div class="col-md-3">
			<?php $attributes = array('class' => 'form', 'id' => 'browseForm'); ?>
			<?php echo form_open('browse/', $attributes); ?>
				<div class="form-group">
					<select name="inputSearch1" class="form-control" onchange="this.form.submit();" >
						<option value="">Jobseekers By Email</option>
						<?php foreach($owner_list->result() as $owner) : ?>
						<option value="<?php echo $owner->owner ?>">
						<?php echo $owner->owner ?>
						</option>
						<?php endforeach ?>
					</select>
				</div>

				<div class="form-group">
					<select name="inputSearch2" class="form-control" onchange="this.form.submit();" >
						<option value="">Jobseekers By Work History</option>
						<?php foreach($work_list->result() as $work) : ?>
						<option value="<?php echo $work->work_history ?>">
						<?php echo $work->work_history ?>
						</option>
						<?php endforeach ?>
					</select>
				</div>

				<div class="form-group">
					<select name="inputSearch3" class="form-control" onchange="this.form.submit();" >
						<option value="">Jobseekers By Description</option>
						<?php foreach($description_list->result() as $description) : ?>
						<option value="<?php echo $description->description ?>">
						<?php echo $description->description ?>
						</option>
						<?php endforeach ?>
					</select>
				</div>

				<div class="form-group">
					<select name="inputSearch4" class="form-control" onchange="this.form.submit();" >
						<option value="">Jobseekers By Address</option>
						<?php foreach($address_list->result() as $address) : ?>
						<option value="<?php echo $address->address ?>">
						<?php echo $address->address ?>
						</option>
						<?php endforeach ?>
					</select>
				</div>

				<div class="form-group">
					<select name="inputSearch5" class="form-control" onchange="this.form.submit();" >
						<option value="">Jobseekers By Education History</option>
						<?php foreach($education_list->result() as $education) : ?>
						<option value="<?php echo $education->edu_history ?>">
						<?php echo $education->edu_history ?>
						</option>
						<?php endforeach ?>
					</select>
				</div>
			<?php echo form_close() ?>
			
		</div>
	
		<div class="col-md-9">
		    
			<h4>Please select a category to browse under.</h4>
			<?php if ( count($search_results->result()) == 0) : ?>

			<h4>No results found.</h4>
			
			<?php else : ?>
			
			<div class="job-list">
				<?php foreach($search_results->result() as $row): ?> 
				<section class="job-item">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-9">
								<h4 class="job-item-header">
									<?php echo $row->owner; ?>
								</h4>
								<h5>
									<font size="2.2">Work History: 
									<?php echo $row->work_history; ?>
								</h5>
								<h5>
									<font size="2.2">Description: 
									<?php echo $row->description; ?>
								</h5>
							</div>
							<div class="col-md-3 text-right">
								<h5>
									<font size="2.2">Address: 
									<?php echo $row->address; ?>
								</h5>
								<h5>
									<font size="2.2">Education History: 
									<?php echo $row->edu_history; ?>
								</h5>
							</div>
						</div>						
					</div>
				</section>
				<?php endforeach; ?>
			</div>
			
			<?php endif ?>		
			
		</div>
	</div>
	
</div>