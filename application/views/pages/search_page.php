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
					<select id = 'inputCategory' name="inputCategory" class="form-control"> 
						<option value="">Jobs By Category</option>
						<option value="1">Finance & Account</option>
						<option value="2">Human Resources</option>
						<option value="3">Purchase & Supply Chain</option>
						<option value="4">Administrations/ Secretarial</option>
						<option value="5">Legal</option>
						<option value="6">Customer Service/ BPO/ KPO</option>
						<option value="7">Sales</option>
						<option value="8">Marketing</option>		
					</select>
				</div>
				<div class="form-group">
					<select id = 'inputExp' name='inputExp' class="form-control" >
						<option value="">Jobs By Experience</option>
						<option value="1">Less than 1 Year</option>
						<option value="2">1 to 4 Years</option>
						<option value="3">4 to 7 Years</option>
						<option value="4">7 to 10 Years</option>
						<option value="5">More than 10 Years</option>
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
								<h4 class="job-item-header"><a href="job/<?php echo $row->job_id?>"><?php echo $row->title; ?></a></h4>
								<h5>
									<a href="<?php echo base_url('profile/'.rawurlencode($row->company_reg_no).'/'); ?>">
										<?php echo ucwords($row->company_name); ?>
									</a>
								</h5>
								<h5><?php echo $row->name; ?></h5>
							</div>
							<div class="col-md-3 text-right-md">
								<h5><?php echo ucwords($row->address); ?></h5>
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
								<?php if($is_login) : ?>
								<button type="submit" class="btn btn-default btn-sm btn-success">Apply</button> 
								<?php endif ?>
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
			});
		</script>
	</div>
</div>