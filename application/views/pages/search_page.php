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
		    
			<?php if($search_query == "") :?>
			
			<h4>Please enter your search in the search box.</h4>
			
			<?php elseif ( count($search_results->result()) == 0) : ?>

			<h4>No results found.</h4>
			
			<?php else : ?>
			
			<div class="table-responsive">
				<table id="jobTable" class="table table-striped">
					<thead>
						<th>Job ID</th>
						<th>Company</th>
						<th>Title</th>
						<th>Description</th>
						<th>Location</th>
					</thead>
					<?php $count = 1 ?>
					<?php foreach($search_results->result() as $row): ?>
					<tr id="jobTable-<?php echo $row->Id; ?>">
						<td><?php echo $row->Id; ?></td>
						<td><?php echo $row->Name; ?></td>
						<td><?php echo $row->Title; ?></td>
						<td><?php echo $row->Description; ?></td>
						<td><?php echo $row->Location; ?></td>
					</tr>
					<?php endforeach; ?>
				</table>
			</div>
			
			<?php endif ?>
			
		</div>
	</div>
	
</div>