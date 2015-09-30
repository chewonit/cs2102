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
	
		<div class="col-md-12">
		    
			<h2>Insert Job Entry</h2>
			
			<?php echo form_open('Insert_controller/insert/');?>
			<div id="insertForm" class="fluid-container">
			<div class="row">
				<div class="form-group col-md-6">
					<label for="inputJobId">Job ID*</label>
					<input type="text" class="form-control" name="inputJobId" id="inputJobId" placeholder="Job ID" required>
				</div>
				<div class="form-group col-md-6">
					<label for="inputCompanyName">Company Name*</label>
					<input type="text" class="form-control" name="inputCompanyName" id="inputCompanyName" placeholder="Company Name" required>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-6">
					<label for="inputTitle">Job Title*</label>
					<input type="text" class="form-control" name="inputTitle" id="inputTitle" placeholder="Job Title" required>
				</div>
				<div class="form-group col-md-6">
					<label for="inputLocation">Location*</label>
					<input type="text" class="form-control" name="inputLocation" id="inputLocation" placeholder="Location" required>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<label for="inputDescription">Description*</label>
					<textarea rows="3" class="form-control" name="inputDescription" id="inputDescription" placeholder="Description" required></textarea>
				</div>
			</div>
			<button type="submit" class="btn btn-default">Insert</button>
			</div>
			<?php echo form_close();?>
			
			<hr />
			
			<div class="table-responsive">
				<table id="jobTable" class="table table-striped">
					<thead>
						<th>Job ID</th>
						<th>Company</th>
						<th>Title</th>
						<th>Description</th>
						<th>Location</th>
					</thead>
					<?php foreach($demo_list->result() as $row): ?>
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
			
		</div>
	</div>
	
</div>