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
	<?php $cat=0; ?>
	<?php $exp=0; ?>
	<div class="row">
	
		<div class="col-md-3">
			<?php $attributes = array('class' => 'form', 'id' => 'searchForm'); ?>
			<?php echo form_open('search/', $attributes); ?>
				<div class="form-group">
					<input type="text" class="search-box form-control" id="inputSearch" name="inputSearch" placeholder="Search for Jobs" value="<?php echo $search_query ?>">
				</div>
				<div class="form-group">
						<select id = 'variable' name="variable" class="form-control" > 
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
					<?php if (isset($_POST['variable'])) {$cat=$_POST['variable'];}  
					//echo $cat;
					?>
					
				</div>
				<div class="form-group">
				
					<select id = 'variable1' name='variable1' class="form-control" >
						<option value="">Jobs By Experience</option>
						<option value="1">Less than 1 Year</option>
						<option value="2">1 to 4 Years</option>
						<option value="3">4 to 7 Years</option>
						<option value="4">7 to 10 Years</option>
						<option value="5">More than 10 Years</option>
					</select>
					<?php if (isset($_POST['variable1'])) {$exp=$_POST['variable1'];}  
					//echo $exp;
					?>
					
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
								<h4 class="job-item-header"><a href="#"><?php echo $row->title; ?></a></h4>
								
							</div>
							<div class="col-md-3 text-right">
								<h5>
									<font size="2.2">Job id: 
									<?php echo $row->job_id; ?></h5>
								<h5>
									<font size="2.2">Company Register number: 
									<?php echo $row->company_reg_no; ?></h5>
								<h5>
									<font size="2.2">Date Created: 
									<?php echo $row->date_created; ?></h5>
								<h5>
									<font size="2.2">Published: 
									<?php echo $row->published; ?></h5>
								<h5>
									<font size="2.2">Category Id: 
									<?php echo $row->category_id; ?></h5>
								<h5>
									<font size="2.2">Experience: 
									<?php echo $row->experience; ?>
									<font size="2.2">Years 
									</h5>
								<h5>
									<font size="2.2">skills: 
										<?php echo $row->skills; ?></h5>
								
					
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"><font size="2.2">Job Description: 
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
							<div class="col-md-12 job-item-btns">
								<button class="btn btn-default btn-sm">More Info</button>
								<button class="btn btn-default btn-sm btn-success">Apply</button>
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