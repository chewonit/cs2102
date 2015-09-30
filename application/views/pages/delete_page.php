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
		    
			<div class="table-responsive">
				<table id="jobTable" class="table table-striped">
					<thead>
						<th>Job ID</th>
						<th>Company</th>
						<th>Title</th>
						<th>Description</th>
						<th>Location</th>
						<th></th>
					</thead>
					<?php foreach($demo_list->result() as $row): ?>
					<tr id="jobTable-<?php echo $row->Id; ?>">
						<td><?php echo $row->Id; ?></td>
						<td><?php echo $row->Name; ?></td>
						<td><?php echo $row->Title; ?></td>
						<td><?php echo $row->Description; ?></td>
						<td><?php echo $row->Location; ?></td>
						<td>
							<button onclick="myFunction(<?php echo "'$row->Id'"; ?>)" 
								class="btn btn-default btn-danger">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
							</button>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
			</div>
			
			<script type="text/javascript">
				var jq = $.noConflict();
				function myFunction(id) {
					
					var data = {inputJobId: id};
					
					var jqxhr = jq.post("<?php echo site_url("Delete_controller/delete/") ?>", data)
					.done(function(data) {
						console.log( data );
						jq("#jobTable-"+id).slideUp();	
					})
					.fail(function() {
						alert( "Failed to delete entry" );
					});
				}
			</script>
			
		</div>
	</div>
	
</div>