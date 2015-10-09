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
	<?php $exp=0 ?>
	<?php $loc='' ?>
	<?php $skill='' ?>
	<?php $name='' ?>
	<div class="row">
	
		<div class="col-md-3">
			<?php //$attributes = array('class' => 'form', 'id' => 'browseForm'); ?>
			<?php //echo form_open('', $attributes)?>
				<div class="form-group">
					<form action="" method="post">
					<select name="variable" class="form-control" onchange="this.form.submit();" >
						<option value="">Jobs By Category</option>					
						<?php foreach($category_list->result() as $category) : ?>
						<option value="<?php echo $category->category_id ?>">
						<?php echo $category->name ?>
						</option>
						<?php endforeach ?>	
					</select>
					</form>
					<?php if (isset($_POST['variable'])) {$cat=$_POST['variable'];}  ?>
				</div>

				<div class="form-group">
				<form action="" method="post">
					<select name='variable1' class="form-control" onchange="this.form.submit();" >
						<option value="">Jobs By Experience</option>
						<option value="1">Less than 1 Year</option>
						<option value="2">1 to 4 Years</option>
						<option value="3">4 to 7 Years</option>
						<option value="4">7 to 10 Years</option>
						<option value="5">More than 10 Years</option>
					</select>
					</form>
					<?php if (isset($_POST['variable1'])) {$exp=$_POST['variable1'];}  ?>
				</div>
				
				<div class="form-group">
					<form action= "" method="post">
					<select name='variable4' class="form-control" onchange="this.form.submit();" >
						<option value="">Jobs By Company</option>
						<?php foreach($company_list->result() as $company) : ?>
						<option value="<?php echo $company->company_reg_no ?>">
						<?php echo $company->company_name ?>
						</option>
						<?php endforeach ?>
					</select>
					<?php if (isset($_POST['variable4'])) {$name=$_POST['variable4'];}  ?>
					</form>
				</div>
				
				<div class="form-group">
					<form action="" method="post">
					<select name='variable2' class="form-control" onchange="this.form.submit();" >
						<option value="">Jobs By Location</option>
						<?php foreach($location_list->result() as $location) : ?>
						<option value="<?php echo $location->location ?>">
						<?php echo $location->location ?>
						</option>
						<?php endforeach ?>
					</select>
					<?php if (isset($_POST['variable2'])) {$loc=$_POST['variable2'];}  ?>
					</form>
				</div>
				
				<div class="form-group">
					<form action= "" method="post">
					<select name='variable3' class="form-control" onchange="this.form.submit();" >
						<option value="">Jobs By Skills</option>
						<?php foreach($skills_list->result() as $skills) : ?>
						<option value="<?php echo $skills->skills ?>">
						<?php echo $skills->skills ?>
						</option>
						<?php endforeach ?>
					</select>
					<?php if (isset($_POST['variable3'])) {$skill=$_POST['variable3'];}  ?>
					</form>
				</div>
				
			<?php //echo form_close() ?>
		</div>
	
		<div class="col-md-9">
			
			<?php if ($cat==0 && $exp==0 && strlen($loc)==0 && strlen($skill)==0 && strlen($name)==0 ) : ?>
			<h4> Displaying ALL Jobs. </h4>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no
			ORDER BY j.date_created DESC'); ?>
									
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
								<?php if($is_login) : ?>
								<button class="btn btn-default btn-sm btn-success">Apply</button> 
								<?php endif ?>
							</div>
						</div>
					</div>
				</section>
				<?php endforeach; ?>
				
			
			<?php elseif ($cat!=0) : ?>
			
			<div class="job-list">
			<?php $sql = "SELECT jc.name FROM job_category jc WHERE jc.category_id=?" ; ?>
			<?php $query = $this->db->query($sql, array($cat)); ?>
			<?php foreach($query->result() as $data) ;?>
				<h4> Displaying <?php echo $data->name ;?> Jobs.</h4>
			
			<?php $sql = "SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location
			FROM jobs j , company c
			WHERE c.company_reg_no=j.company_reg_no AND (j.category_id = ?)
			GROUP BY j.date_created DESC" ;?>
			
			<?php $query = $this->db->query($sql, array($cat)); ?>
			
			<?php if ( count($query->result()) == 0) : ?>

			<h4>No results found.</h4>
			
			<?php else : ?>

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
								<?php if($is_login) : ?>
								<button class="btn btn-default btn-sm btn-success">Apply</button> 
								<?php endif ?>
							</div>
						</div>
					</div>
				</section>
				<?php endforeach; ?>
				<?php endif ?>
					
			</div>
				

			<?php elseif ($exp!=0) : ?>
			
			<div class="job-list">
			<?php if ($exp==1) :?>
			<h4> Displaying Jobs with less than 1 Year of Experience.</h4>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (j.experience = 0)
			ORDER BY j.date_created DESC'); ?>
			
			<?php elseif ($exp==2) :?>
			<h4> Displaying Jobs with 1 - 4 Years of Experience.</h4>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (j.experience >= 1) AND (j.experience <=4)
			ORDER BY j.date_created DESC'); ?>
			
			<?php elseif ($exp==3) :?>
			<h4> Displaying Jobs with 4 - 7 Years of Experience.</h4>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (j.experience>=4) AND (j.experience<=7)
			ORDER BY j.date_created DESC'); ?>
			
			<?php elseif ($exp==4) :?>
			<h4> Displaying Jobs with 7 - 10 Years of Experience.</h4>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (j.experience>=7) AND (j.experience<=10)
			ORDER BY j.date_created DESC'); ?>
			
			<?php elseif ($exp==5) :?>
			<h4> Displaying Jobs with more than 10 Years of Experience.</h4>
			<?php $query = $this->db->query('SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
			FROM jobs j , company c 
			WHERE c.company_reg_no=j.company_reg_no AND (j.experience >=10)
			ORDER BY j.date_created DESC'); ?>
			
			<?php endif ?>	
			
			<?php if ( count($query->result()) == 0) : ?>

			<h4>No results found.</h4>
			
			<?php else : ?>
			
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
								<?php if($is_login) : ?>
								<button class="btn btn-default btn-sm btn-success">Apply</button> 
								<?php endif ?>
							</div>
						</div>
					</div>
				</section>
				<?php endforeach; ?>
				<?php endif ?>
			</div>
			
			<?php elseif (strlen($loc)!=0) : ?>
			
			<div class="job-list">
				<h4> Displaying jobs with <?php echo $loc ;?> location.</h4>
			
			<?php $sql = "SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location
			FROM jobs j , company c
			WHERE c.company_reg_no=j.company_reg_no AND c.location LIKE '%$loc%'
			ORDER BY j.date_created DESC" ;?>
			
			<?php $query = $this->db->query($sql); ?>
			
			<?php if ( count($query->result()) == 0) : ?>

			<h4>No results found.</h4>
			
			<?php else : ?>

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
								<?php if($is_login) : ?>
								<button class="btn btn-default btn-sm btn-success">Apply</button> 
								<?php endif ?>
							</div>
						</div>
					</div>
				</section>
				<?php endforeach; ?>
				<?php endif ?>
					
			</div>
			
			<?php elseif (strlen($skill)!=0) : ?>
			
			<div class="job-list">
				<h4> Displaying jobs with <?php echo $skill ;?> skills.</h4>
			
			<?php $sql = "SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location
			FROM jobs j , company c
			WHERE c.company_reg_no=j.company_reg_no AND j.skills LIKE '%$skill%'
			ORDER BY j.date_created DESC" ;?>
			
			<?php $query = $this->db->query($sql); ?>

			<?php if ( count($query->result()) == 0) : ?>

			<h4>No results found.</h4>
			
			<?php else : ?>
			
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
								<?php if($is_login) : ?>
								<button class="btn btn-default btn-sm btn-success">Apply</button> 
								<?php endif ?>
							</div>
						</div>
					</div>
				</section>
				<?php endforeach; ?>
				<?php endif ?>
					
			</div>
			
			<?php elseif (strlen($name)!=0) : ?>
			
			<div class="job-list">
			<?php $sql = "SELECT c.company_name FROM company c WHERE c.company_reg_no=?" ; ?>
			<?php $query = $this->db->query($sql, array($name)); ?>
			<?php foreach($query->result() as $data) ;?>
				<h4> Displaying jobs from <?php echo $data->company_name ;?>.</h4>
			
			<?php $sql = "SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location
			FROM jobs j , company c
			WHERE c.company_reg_no=j.company_reg_no AND c.company_reg_no=?
			ORDER BY j.date_created DESC" ;?>
			
			<?php $query = $this->db->query($sql, array($name)); ?>

			<?php if ( count($query->result()) == 0) : ?>

			<h4>No results found.</h4>
			
			<?php else : ?>
			
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
								<?php if($is_login) : ?>
								<button class="btn btn-default btn-sm btn-success">Apply</button> 
								<?php endif ?>
							</div>
						</div>
					</div>
				</section>
				<?php endforeach; ?>
				<?php endif ?>
					
			</div>
			
			<?php endif ?>
		</div>
		
	</div>
</div>