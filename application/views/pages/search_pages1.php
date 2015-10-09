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
	<?php $input = "job"; ?>
	
	<div class="row">
	
		<div class="col-md-3">
			<?php //$attributes = array('class' => 'form', 'id' => 'browseForm'); ?>
			<?php //echo form_open('', $attributes)?>
			<form action="" method="post">
			<div class="form-group">
				<input type="text" class="search-box form-control" id="inputSearch" name="inputSearch" placeholder="Search for Jobs">
			
							
			</div>
				<div class="form-group">
					
					<select name="variable" class="form-control" > 
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
					<?php if (isset($_POST['variable'])) {$cat=$_POST['variable'];}  ?>
				</div>

				<div class="form-group">
				
					<select name='variable1' class="form-control" >
						<option value="">Jobs By Experience</option>
						<option value="1">Less than 1 Year</option>
						<option value="2">1 to 4 Years</option>
						<option value="3">4 to 7 Years</option>
						<option value="4">7 to 10 Years</option>
						<option value="5">More than 10 Years</option>
					</select>
					
					<?php if (isset($_POST['variable1'])) {$exp=$_POST['variable1'];}  ?>
				</div>
				<button type="submit" class="btn btn-default" onclick="this.form.submit();">Search</button>
			</form>
			<?php //echo form_close() ;
			 if (isset($_POST['inputSearch'])) {$input=$_POST['inputSearch'];} 
			
			?>
		</div>
	
		<div class="col-md-9">
		    
			<h4>Please select a category to browse under.</h4>
			
			<?php if ($cat==0 && $exp==0) : ?>
			<h4>Category / Experience.</h4>
			
			<?php $query = $this->db->query("SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (j.title = '$input')
			ORDER BY j.date_created DESC"); ?>
			
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
								<button class="btn btn-default btn-sm btn-success">Apply</button>
							</div>
						</div>
					</div>
				</section>
				<?php endforeach; ?>
			
			<?php elseif ($cat!=0) : ?>
			
			<div class="job-list">
			<?php if ($cat==1) :?>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (category_id = 1) 
			ORDER BY j.date_created DESC'); ?>
			
			<?php elseif ($cat==2) :?>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (category_id = 2)
			ORDER BY j.date_created DESC'); ?>
			
			<?php elseif ($cat==3) :?>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (category_id = 3)
			ORDER BY j.date_created DESC'); ?>
			
			<?php elseif ($cat==4) :?>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (category_id = 4)
			ORDER BY j.date_created DESC'); ?>
			
			<?php elseif ($cat==5) :?>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (category_id = 5)
			ORDER BY j.date_created DESC'); ?>
			
			<?php elseif ($cat==6) :?>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (category_id = 6)
			ORDER BY j.date_created DESC'); ?>
			
			<?php elseif ($cat==7) :?>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (category_id = 7)
			ORDER BY j.date_created DESC'); ?>
			
			<?php elseif ($cat==8) :?>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (category_id = 8)
			ORDER BY j.date_created DESC'); ?>			

			<?php endif ?>	
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
								<button class="btn btn-default btn-sm btn-success">Apply</button>
							</div>
						</div>
					</div>
				</section>
				<?php endforeach; ?>
				
					
			</div>
				

			<?php elseif ($exp!=0) : ?>
			
			<div class="job-list">
			<?php if ($exp==1) :?>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (j.experience = 0)
			ORDER BY j.date_created DESC'); ?>
			
			<?php elseif ($exp==2) :?>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (j.experience >= 1) AND (j.experience <=4)
			ORDER BY j.date_created DESC'); ?>
			
			<?php elseif ($exp==3) :?>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (j.experience>=4) AND (j.experience<=7)
			ORDER BY j.date_created DESC'); ?>
			
			<?php elseif ($exp==4) :?>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (j.experience>=7) AND (j.experience<=10)
			ORDER BY j.date_created DESC'); ?>
			
			<?php elseif ($exp==5) :?>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (j.experience >=10)
			ORDER BY j.date_created DESC'); ?>
			
			<?php endif ?>	
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