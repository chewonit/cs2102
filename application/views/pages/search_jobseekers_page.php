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
					<input type="text" class="search-box form-control" id="inputSearch" name="inputSearch"  placeholder="Search" value="<?php echo $search_query ?>">
				</div>
				<div class="form-group">
					<select class="form-control">
						<option value="">Filters 1</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
				<div class="form-group">
					<select class="form-control">
						<option value="">Filters 2</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
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
								<h4 class="job-item-header"><a href="#"><?php echo $row->Title; ?></a></h4>
								<h5><?php echo $row->Name; ?></h5>
							</div>
							<div class="col-md-3 text-right">
								<h5><?php echo $row->Location; ?></h5>
								<h6><?php echo "15 June 2015" ?></h6>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?php 
									$str = $row->Description;
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