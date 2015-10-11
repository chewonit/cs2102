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
	<?php if($is_login) : ?>
		<?php $email= $_SESSION['email']; ?> 
	<?php endif ?>
	
	
	<div class="row">
	
		<div class="col-md-3">
			<?php $attributes = array('class' => 'form', 'id' => 'browseForm'); ?>
			<?php echo form_open('', $attributes)?>
				<div class="form-group">
				
					<form action="" method="post">
					<select name="variable" class="form-control" onchange="this.form.submit()" ; >
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
					<select name='variable2' class="form-control" onchange="this.form.submit();" >
						<option value="">Jobs By Company</option>
						<?php foreach($company_list->result() as $company) : ?>
						<option value="<?php echo $company->company_reg_no ?>">
						<?php echo $company->company_name ?>
						</option>
						<?php endforeach ?>
					</select>
					<?php if (isset($_POST['variable2'])) {$name=$_POST['variable2'];}  ?>
					</form>
				</div>
				
				<div class="form-group">
					<form action="" method="post">
					<select name='variable3' class="form-control" onchange="this.form.submit();" >
						<option value="">Jobs By Location</option>
						<?php foreach($location_list->result() as $location) : ?>
						<option value="<?php echo $location->location ?>">
						<?php echo $location->location ?>
						</option>
						<?php endforeach ?>
					</select>
					<?php if (isset($_POST['variable3'])) {$loc=$_POST['variable3'];}  ?>
					</form>
				</div>
				
				<div class="form-group">
					<form action= "" method="post">
					<select name='variable4' class="form-control" onchange="this.form.submit();" >
						<option value="">Jobs By Skills</option>
						<?php foreach($skills_list->result() as $skills) : ?>
						<option value="<?php echo $skills->skills ?>">
						<?php echo $skills->skills ?>
						</option>
						<?php endforeach ?>
					</select>
					<?php if (isset($_POST['variable4'])) {$skill=$_POST['variable4'];}  ?>
					</form>
				</div>
				
			<?php echo form_close() ?>
		</div>
	
	
	
		<div class="col-md-9">
									
			<?php if ( count($browse_query->result()) == 0) : ?>

			<h4>No results found.</h4>
			
			<?php else : ?>						
									
			<?php foreach($browse_query->result() as $row): ?>
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
								<button type="submit" class="btn btn-default btn-sm btn-success">Apply</button> 
								<?php endif ?>
							</div>
						</div>
					</div>
				</section>
				<?php endforeach; ?>
			<?php endif ?>
		</div>
		
	</div>
</div>