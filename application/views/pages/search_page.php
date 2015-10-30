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
					<input type="text" class="search-box form-control" id="inputSearch" name="inputSearch" placeholder="Search for Jobs" value="<?php echo $search_query ?>">
				</div>
				<div class="form-group">
					<select name="inputCategory" class="form-control" onchange="this.form.submit()" ; >
						<option value="">Category</option>					
						<?php foreach($category_list->result() as $category) : ?>
							<option value="<?php echo $category->category_id ?>">
								<?php echo $category->name ?>
							</option>
						<?php endforeach ?>	
					</select>
				</div>
				<div class="form-group">
					<select id = 'inputExp' name='inputExp' class="form-control" >
						<option value="">Experience</option>
						<option value="1">Less than 1 Year</option>
						<option value="2">1 to 4 Years</option>
						<option value="3">4 to 7 Years</option>
						<option value="4">7 to 10 Years</option>
						<option value="5">More than 10 Years</option>
					</select>
				</div>
				
				<div class="form-group">
					<select name='inputLocation' class="form-control" onchange="this.form.submit();" >
						<option value="">Location</option>
						<option value="central">Central</option>
						<option value="north">North</option>
						<option value="south">South</option>
						<option value="east">East</option>
						<option value="west">West</option>
					</select>
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
								<h4 class="job-item-header"><a href="job/<?php echo $row->job_id?>"><?php echo ucwords($row->title); ?></a></h4>
								<h5>
									<a href="<?php echo base_url('profile/'.rawurlencode($row->company_reg_no).'/'); ?>">
										<?php echo ucwords($row->company_name); ?>
									</a>
								</h5>
								<h5><?php echo $row->name; ?></h5>
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
							</div>
						</div>
					</div>
				</section>
				<?php endforeach; ?>
			</div>
			
			<?php endif ?>
			
		</div>
		
		<script type="text/javascript">
			var jq = jQuery.noConflict();
			
			jq(document).ready(function() {
				jq('[name="inputCategory"]').val("<?php echo $search_cat; ?>");
				jq('[name="inputExp"]').val("<?php echo $search_exp; ?>");
				jq('[name="inputSearch"]').val("<?php echo $search_query; ?>");
				jq('[name="inputLocation"]').val("<?php echo $search_location; ?>");
			});
		</script>
	</div>
</div>