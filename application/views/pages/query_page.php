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
	
		<div class="col-md-9">
		    
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
					<td>
						<!-- <button onclick="myFunction(<?php //echo "'jobTable-".$row->Id."'";?>)" 
							class="btn btn-default">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						</button>
							-->
					</td>
				</tr>
				<?php $count += 1 ?>
				<?php endforeach; ?>
			</table>
			
			<script type="text/javascript">
				var jq = $.noConflict();
				
				var formInputIds = ["#inputJobId", "#inputCompanyName", "#inputTitle", "#inputDescription", "#inputLocation"];
				
				function myFunction(form) {
					//window.alert("c");
					var jobId = 'jobTable-' + form.elements[0].value; //this is correct field
					//	window.alert("d");
				//	window.alert(jobId);
					
					//window.alert("e");
					jq("#jobTable").find("#"+jobId).find('td').each( function(index) {
					//	window.alert(index);
						if (index < formInputIds.length) {
							jq( formInputIds[index] ).val(jq( this ).html());
						}
					});
					//window.alert("f");
				}
			</script>
			
			
			<h2>Query Job Entry</h2>
			
			<form name='test' target = "#">
			<div id="updateForm" class="fluid-container">
			<div class="row">
				<div class="form-group col-md-6">
					<label for="inputJobId">Job ID</label>
					<input type="text" class="form-control" name="inputJobId" id="inputJobId" placeholder="Job ID" >
				</div>
				<div class="form-group col-md-6">
					<label for="inputCompanyName">Company Name</label>
					<input type="text" class="form-control" name="inputCompanyName" id="inputCompanyName" placeholder="Company Name" readonly>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-6">
					<label for="inputTitle">Job Title</label>
					<input type="text" class="form-control" name="inputTitle" id="inputTitle" placeholder="Job Title" readonly>
				</div>
				<div class="form-group col-md-6">
					<label for="inputLocation">Location</label>
					<input type="text" class="form-control" name="inputLocation" id="inputLocation" placeholder="Location" readonly>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<label for="inputDescription">Description</label>
					<textarea rows="3" class="form-control" name="inputDescription" id="inputDescription" placeholder="Description" readonly> </textarea>
				</div>
			</div>
			<script type="text/javascript"> //window.alert("a"); </script>
			<button class="submit" onclick = "myFunction(this.form)" type ="button" >Query</button>
			
			<script type="text/javascript">// window.alert("b"); </script>
			</div>
			

		</form>
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