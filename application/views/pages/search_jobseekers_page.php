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
	
		<div class="col-md-3">
			<?php $attributes = array('class' => 'form', 'id' => 'searchForm'); ?>
			<?php echo form_open('search/', $attributes); ?>
				<div class="form-group">
					<input type="text" class="search-box form-control" id="inputSearch" name="inputSearch" placeholder="Search" value="<?php echo $search_query ?>">
				</div>
				<button type="submit" class="btn btn-default">Search</button>
			<?php echo form_close() ?>
		</div>
	
		<div class="col-md-9">
			
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