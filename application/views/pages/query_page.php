<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js">
</script>
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo $page_title?></h1>
			</div>
		</div>
	</div>

	<div class="row">
	
		<div class="col-md-12">
		    
			<table id="jobTable" class="table table-striped">
				<thead>
					<th>Job ID</th>
					<th>Company</th>
					<th>Title</th>
					<th>Description</th>
					<th>Location</th>
				</thead>
				<?php $count = 1 ?>
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
			
		</form>
		</div>
	</div>