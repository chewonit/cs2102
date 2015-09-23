<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo $page_title?></h1>
			</div>
		</div>
	</div>

	<div class="row">
	
		<div class="col-md-9">
		    
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
						<button onclick="myFunction(<?php echo "$row->Id"; ?>)" 
							class="btn btn-default btn-danger">
								<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</button>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			
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
		<div class="col-md-3">
			<p>
				Sed accumsan augue a lacus luctus condimentum. Aenean aliquam id sapien id molestie. 
				Maecenas eu pharetra turpis. Aenean nec facilisis odio. Mauris sodales sodales suscipit. 
				Morbi rhoncus elit et egestas interdum. Ut et magna ac nisi ultrices mattis in sit amet leo. 
				Nunc consectetur egestas ligula, id vulputate ligula congue id. Pellentesque nec hendrerit arcu, at accumsan massa. 
				Etiam eu varius purus. Vivamus et purus risus. Nam vulputate tempus nulla, id tempor quam pellentesque sed. 
				Etiam mi est, tempus in dapibus sit amet, ultrices et nibh.
			</p>
		</div>
	</div>