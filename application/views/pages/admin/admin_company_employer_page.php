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
		<div class="col-md-2">
			<ul class="nav nav-pills nav-stacked">
				<li role="presentation"><a href="<?php echo base_url("admin/")?>">Users</a></li>
				<li role="presentation"><a href="<?php echo base_url("admin/roles")?>">Roles</a></li>
				<li role="presentation"><a href="<?php echo base_url("admin/resumes")?>">Resumes</a></li>
				<li role="presentation"><a href="<?php echo base_url("admin/company/")?>">Company</a></li>
				<li role="presentation" class="active"><a href="#">Company Employer</a></li>
				<li role="presentation"><a href="<?php echo base_url("admin/job_category/")?>">Job Category</a></li>
				<li role="presentation"><a href="<?php echo base_url("admin/jobs/")?>">Jobs</a></li>
				<li role="presentation"><a href="<?php echo base_url("admin/job_application/")?>">Job Application</a></li>
			</ul>
		</div>
		<div class="col-md-10">
			<div class="admin-table-wrapper">
				<h3 class="admin-table-wrapper-header">Company Table</h3>
				<br />
				<button class="btn btn-success" onclick="add_entry()"><i class="glyphicon glyphicon-plus"></i> Add Entry</button>
				<br />
				<br />
				<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
						<th>Employer</th>
						<th>Reg. Number</th>
						<th>Accepted</th>
						<th style="width:125px;">Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
						<th>Employer</th>
						<th>Reg. Number</th>
						<th>Accepted</th>
						<th>Action</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div> 
	</div>
	
	<script type="text/javascript">
	var jq = jQuery.noConflict();
	var save_method; //for save method string
	var table;
	jq(document).ready(function() {
		table = jq('#table').DataTable({ 

			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			responsive: true,

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('admin/company_employer_list/')?>",
				"type": "POST"
			},

			//Set column definition initialisation properties.
			"columnDefs": [
				{ 
				"targets": [ -1 ], //last column
				"orderable": false, //set not orderable
				},
			],

		});
	});

	function add_entry()
	{
		save_method = 'add';
		jq('form')[0].reset(); // reset form on modals
		jq('#modal_form_add').modal('show'); // show bootstrap modal
		jq('.modal-title').text('Add Entry'); // Set Title to Bootstrap modal title
	}

	function edit_entry(key)
	{
		save_method = 'update';
		jq('form')[0].reset(); // reset form on modals

		//Ajax Load data from ajax
		jq.ajax({
			url : "<?php echo site_url('admin/company_employer_edit')?>/",
			type: "POST",
			data: { employer: key },
			dataType: "JSON",
			success: function(data)
			{
				jq('[name="originalEmployer"]').val(data.employer);
				jq('[name="inputEmployer"]').val(data.employer);
				jq('[name="inputRegNo"]').val(data.company_reg_no);
				jq('[name="inputAccepted"]').val(data.accepted);

				jq('#modal_form_update').modal('show'); // show bootstrap modal when complete loaded
				jq('.modal-title').text('Edit Entry'); // Set title to Bootstrap modal title

			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				jq.bootstrapGrowl('<h5>Error in retrieving data entry.</h5>' , {type: 'danger'});
			}
		});
	}

	function reload_table()
	{
		table.ajax.reload(null,false); //reload datatable ajax 
	}

	function save()
	{
		var url, _form;
		if(save_method == 'add') 
		{
			url = "<?php echo site_url('admin/company_employer_add/')?>";
			_form = "#form_add";
		}
		else
		{
			url = "<?php echo site_url('admin/company_employer_update/')?>";
			_form = "#form_update";
		}
		
		if( jq( _form ).valid() ){
			jq.ajax({
				url : url,
				type: "POST",
				data: jq( _form ).serialize(),
				dataType: "JSON",
				success: function(data)
				{
					if (data['form_validation'] === false) 
					{
						jq.bootstrapGrowl(
							'<h5>There are errors in your form entries.</h5>'
							+ data['form_validation_errors']
						,{type: 'danger'});
					} 
					else if(data['success'] === false) 
					{
						jq.bootstrapGrowl('<h5>Error in saving entry.</h5>' , {type: 'danger'});
					}
					else 
					{
						//if success close modal and reload ajax table
						jq('.modal').modal('hide');
						reload_table();
						jq.bootstrapGrowl('<h5>Entry saved.</h5>' , {type: 'success'});
					}
				},
					error: function (jqXHR, textStatus, errorThrown)
				{
					jq.bootstrapGrowl('<h5>Error in saving entry.</h5>' , {type: 'danger'});
				}
			});
		}
	}

	function delete_entry(key)
	{
		if(confirm('Are you sure delete this data?'))
		{
			// ajax delete data to database
			jq.ajax({
				url : "<?php echo site_url('admin/company_employer_delete')?>/",
				type: "POST",
				data: { employer: key },
				dataType: "JSON",
				success: function(data)
				{
					//if success reload ajax table
					jq('.model').modal('hide');
					reload_table();
					jq.bootstrapGrowl('<h5>Entry deleted.</h5>' , {type: 'success'});
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					jq.bootstrapGrowl('<h5>Error in deleting entry.</h5>' , {type: 'danger'});
				}
			});

		}
	}
	
	jq( document ).ready(function() {

		jq("#form_add").validate({
			rules: {
				inputEmployer: "required",
				inputRegNo: "required",
				inputAccepted: "required"
			},
			messages: {
				inputEmployer: "Please enter the employer.",
				inputRegNo: "Please enter the company registration number.",
				inputAccepted: "Please enter the value for accepted."
			}
		});
		
		jq("#form_update").validate({
			rules: {
				inputRegNo: "required",
				inputAccepted: "required"
			},
			messages: {
				inputRegNo: "Please enter the company registration number.",
				inputAccepted: "Please enter the value for accepted."
			}
		});
	});	

	</script>

	<!-- Bootstrap modal -->
	<div class="modal fade" id="modal_form_add" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title">Form</h3>
				</div>
				<div class="modal-body form">
					<form action="#" id="form_add" class="form-horizontal">
						<input type="hidden" value="" name="originalEmployer"/> 
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3">Employer</label>
								<div class="col-md-9">
									<input required type="text" class="form-control" id="inputEmployer" name="inputEmployer" placeholder="Employer">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Company Reg No.</label>
								<div class="col-md-9">
									<input required type="text" class="form-control" id="inputRegNo" name="inputRegNo" placeholder="Company Reg No.">
								</div>
							</div>							
							<div class="form-group">
								<label class="control-label col-md-3">inputAccepted</label>
								<div class="col-md-9">
									<input required type="text" class="form-control" id="inputAccepted" name="inputAccepted" placeholder="Accepted">
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade" id="modal_form_update" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title">Form</h3>
				</div>
				<div class="modal-body form">
					<form action="#" id="form_update" class="form-horizontal">
						<input type="hidden" value="" name="originalEmployer"/> 
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3">Company Reg No.</label>
								<div class="col-md-9">
									<input required type="text" class="form-control" id="inputRegNo" name="inputRegNo" placeholder="Company Reg No.">
								</div>
							</div>							
							<div class="form-group">
								<label class="control-label col-md-3">inputAccepted</label>
								<div class="col-md-9">
									<input required type="text" class="form-control" id="inputAccepted" name="inputAccepted" placeholder="Accepted">
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<!-- End Bootstrap modal -->
</div>