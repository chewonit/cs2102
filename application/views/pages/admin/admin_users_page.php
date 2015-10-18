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
				<li role="presentation" class="active"><a href="#">Users</a></li>
				<li role="presentation"><a href="<?php echo base_url("admin/roles/")?>">Roles</a></li>
				<li role="presentation"><a href="<?php echo base_url("admin/resumes/")?>">Resumes</a></li>
				<li role="presentation"><a href="<?php echo base_url("admin/company/")?>">Company</a></li>
				<li role="presentation"><a href="<?php echo base_url("admin/company_employer/")?>">Company Employer</a></li>
				<li role="presentation"><a href="<?php echo base_url("admin/job_category/")?>">Job Category</a></li>
				<li role="presentation"><a href="<?php echo base_url("admin/jobs/")?>">Jobs</a></li>
				<li role="presentation"><a href="<?php echo base_url("admin/job_application/")?>">Job Application</a></li>
			</ul>
		</div>
		<div class="col-md-10">
			<div class="admin-table-wrapper">
				<h3 class="admin-table-wrapper-header">Users Table</h3>
				<br />
				<button class="btn btn-success" onclick="add_entry()"><i class="glyphicon glyphicon-plus"></i> Add Entry</button>
				<br />
				<br />
				<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
						<th>Email</th>
						<!--<th>Password</th>-->
						<th>First Name</th>
						<th>Last Name</th>
						<th>Nationality</th>
						<th>Date of Birth</th>
						<th>Contact</th>
						<th>Gender</th>
						<th>Role</th>
						<th style="width:125px;">Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
						<th>Email</th>
						<!--<th>Password</th>-->
						<th>First Name</th>
						<th>Last Name</th>
						<th>Nationality</th>
						<th>Date of Birth</th>
						<th>Contact</th>
						<th>Gender</th>
						<th>Role</th>
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
				"url": "<?php echo site_url('admin/users_list/')?>",
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

	function edit_entry(_email)
	{
		save_method = 'update';
		jq('form')[0].reset(); // reset form on modals

		//Ajax Load data from ajax
		jq.ajax({
			url : "<?php echo site_url('admin/users_edit')?>/",
			type: "POST",
			data: { email: _email },
			dataType: "JSON",
			success: function(data)
			{
				jq('[name="inputEmail"]').val(data.email);
				jq('[name="inputFirstName"]').val(data.first_name);
				jq('[name="inputLastName"]').val(data.last_name);
				jq('[name="inputNationality"]').val(data.nationality);
				jq('[name="inputContact"]').val(data.contact);
				jq('[name="inputGender"]').val(data.gender);
				jq('[name="inputAccount"]').val(data.role);
				jq('[name="inputDob"]').val(data.dob);

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
			url = "<?php echo site_url('admin/users_add/')?>";
			_form = "#form_add";
		}
		else
		{
			url = "<?php echo site_url('admin/users_update/')?>";
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

	function delete_entry(_email)
	{
		if(confirm('Are you sure delete this data?'))
		{
			// ajax delete data to database
			jq.ajax({
				url : "<?php echo site_url('admin/users_delete')?>/",
				type: "POST",
				data: { email: _email },
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
	
	jQuery.validator.addMethod("alphanumeric", function(value, element) {
		return this.optional(element) || /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9$&+,:;=?@#|'<>.-^*()%!]+)$/.test(value);
	}, "The input must contain Alphabets and Numbers."); 
	
	jQuery.validator.addMethod('positiveNumber',
		function (value) { 
			return Number(value) > 0;
		}, 
		'Invalid contact number.');

	jq( document ).ready(function() {

		jq("#form_add").validate({
			rules: {
				inputFirstName: "required",
				inputLastName: "required",
				inputEmail: {
					required: true,
					email: true,
					remote: {
						url: '<?php echo base_url(); ?>/register/check_unique_email',
						type: 'post'
					}
				},
				inputPassword: {
					required: true,
					minlength: 8,
					alphanumeric: true
				},
				inputNationality: "required",
				inputContact: {
					required: true,
					number: true,
					positiveNumber: true
				},
				inputGender: "required",
				inputAccount: "required"
			},
			messages: {
				inputFirstName: "Please specify your first name.",
				inputLastName: "Please specify your last name.",
				inputEmail: {
					required: "Your email is required.",
					email: "Please enter a valid email address.",
					remote: "Email address has already been registered."
				},
				inputPassword: {
					required: "Please enter your password.",
					minlength: "A minimum of length of 8 is required..",
					alphanumeric: "The password must contain Alphabets and Numbers."
				},
				inputNationality: "Please select your nationality.",
				inputContact: {
					required: "Please enter your contact number.",
					number: "Please enter a valid phone number."
				},
				inputGender: "Please spcify your gender.",
				inputAccount: "Please select one option"
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "inputEmail" 
					|| element.attr("name") == "inputPassword" )
					error.insertAfter(element.parent());
				else
					error.insertAfter(element);
			}
		});
		
		jq("#form_update").validate({
			rules: {
				inputFirstName: "required",
				inputLastName: "required",
				inputNationality: "required",
				inputContact: {
					required: true,
					number: true,
					positiveNumber: true
				},
				inputGender: "required",
				inputAccount: "required"
			},
			messages: {
				inputFirstName: "Please specify your first name.",
				inputLastName: "Please specify your last name.",
				inputNationality: "Please select your nationality.",
				inputContact: {
					required: "Please enter your contact number.",
					number: "Please enter a valid phone number."
				},
				inputGender: "Please spcify your gender.",
				inputAccount: "Please select one option"
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "inputEmail" 
					|| element.attr("name") == "inputPassword" )
					error.insertAfter(element.parent());
				else
					error.insertAfter(element);
			}
		});
		
		jq(".form_datetime").datetimepicker({format: 'yyyy-mm-dd'});
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
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3">First Name</label>
								<div class="col-md-9">
									<input required type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="First Name">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Last Name</label>
								<div class="col-md-9">
									<input required type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="Last Name">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Email</label>
								<div class="col-md-9">
									<div id="inputEmail-container" class="input-group">
										<input required type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email address">
										<div class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Password</label>	
								<div class="col-md-9">
									<div class="input-group">
										<input required type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
										<div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Nationality</label>
								<div class="col-md-9">
									<select required class="form-control" id="inputNationality" name="inputNationality">
										<option value="">Nationality</option>
										<option value="singaporean">Singaporean</option>
										<option value="afghan">Afghan</option>
										<option value="albanian">Albanian</option>
										<option value="algerian">Algerian</option>
										<option value="american">American</option>
										<option value="andorran">Andorran</option>
										<option value="angolan">Angolan</option>
										<option value="antiguans">Antiguans</option>
										<option value="argentinean">Argentinean</option>
										<option value="armenian">Armenian</option>
										<option value="australian">Australian</option>
										<option value="austrian">Austrian</option>
										<option value="azerbaijani">Azerbaijani</option>
										<option value="bahamian">Bahamian</option>
										<option value="bahraini">Bahraini</option>
										<option value="bangladeshi">Bangladeshi</option>
										<option value="barbadian">Barbadian</option>
										<option value="barbudans">Barbudans</option>
										<option value="batswana">Batswana</option>
										<option value="belarusian">Belarusian</option>
										<option value="belgian">Belgian</option>
										<option value="belizean">Belizean</option>
										<option value="beninese">Beninese</option>
										<option value="bhutanese">Bhutanese</option>
										<option value="bolivian">Bolivian</option>
										<option value="bosnian">Bosnian</option>
										<option value="brazilian">Brazilian</option>
										<option value="british">British</option>
										<option value="bruneian">Bruneian</option>
										<option value="bulgarian">Bulgarian</option>
										<option value="burkinabe">Burkinabe</option>
										<option value="burmese">Burmese</option>
										<option value="burundian">Burundian</option>
										<option value="cambodian">Cambodian</option>
										<option value="cameroonian">Cameroonian</option>
										<option value="canadian">Canadian</option>
										<option value="cape verdean">Cape Verdean</option>
										<option value="central african">Central African</option>
										<option value="chadian">Chadian</option>
										<option value="chilean">Chilean</option>
										<option value="chinese">Chinese</option>
										<option value="colombian">Colombian</option>
										<option value="comoran">Comoran</option>
										<option value="congolese">Congolese</option>
										<option value="costa rican">Costa Rican</option>
										<option value="croatian">Croatian</option>
										<option value="cuban">Cuban</option>
										<option value="cypriot">Cypriot</option>
										<option value="czech">Czech</option>
										<option value="danish">Danish</option>
										<option value="djibouti">Djibouti</option>
										<option value="dominican">Dominican</option>
										<option value="dutch">Dutch</option>
										<option value="east timorese">East Timorese</option>
										<option value="ecuadorean">Ecuadorean</option>
										<option value="egyptian">Egyptian</option>
										<option value="emirian">Emirian</option>
										<option value="equatorial guinean">Equatorial Guinean</option>
										<option value="eritrean">Eritrean</option>
										<option value="estonian">Estonian</option>
										<option value="ethiopian">Ethiopian</option>
										<option value="fijian">Fijian</option>
										<option value="filipino">Filipino</option>
										<option value="finnish">Finnish</option>
										<option value="french">French</option>
										<option value="gabonese">Gabonese</option>
										<option value="gambian">Gambian</option>
										<option value="georgian">Georgian</option>
										<option value="german">German</option>
										<option value="ghanaian">Ghanaian</option>
										<option value="greek">Greek</option>
										<option value="grenadian">Grenadian</option>
										<option value="guatemalan">Guatemalan</option>
										<option value="guinea-bissauan">Guinea-Bissauan</option>
										<option value="guinean">Guinean</option>
										<option value="guyanese">Guyanese</option>
										<option value="haitian">Haitian</option>
										<option value="herzegovinian">Herzegovinian</option>
										<option value="honduran">Honduran</option>
										<option value="hungarian">Hungarian</option>
										<option value="icelander">Icelander</option>
										<option value="indian">Indian</option>
										<option value="indonesian">Indonesian</option>
										<option value="iranian">Iranian</option>
										<option value="iraqi">Iraqi</option>
										<option value="irish">Irish</option>
										<option value="israeli">Israeli</option>
										<option value="italian">Italian</option>
										<option value="ivorian">Ivorian</option>
										<option value="jamaican">Jamaican</option>
										<option value="japanese">Japanese</option>
										<option value="jordanian">Jordanian</option>
										<option value="kazakhstani">Kazakhstani</option>
										<option value="kenyan">Kenyan</option>
										<option value="kittian and nevisian">Kittian and Nevisian</option>
										<option value="kuwaiti">Kuwaiti</option>
										<option value="kyrgyz">Kyrgyz</option>
										<option value="laotian">Laotian</option>
										<option value="latvian">Latvian</option>
										<option value="lebanese">Lebanese</option>
										<option value="liberian">Liberian</option>
										<option value="libyan">Libyan</option>
										<option value="liechtensteiner">Liechtensteiner</option>
										<option value="lithuanian">Lithuanian</option>
										<option value="luxembourger">Luxembourger</option>
										<option value="macedonian">Macedonian</option>
										<option value="malagasy">Malagasy</option>
										<option value="malawian">Malawian</option>
										<option value="malaysian">Malaysian</option>
										<option value="maldivan">Maldivan</option>
										<option value="malian">Malian</option>
										<option value="maltese">Maltese</option>
										<option value="marshallese">Marshallese</option>
										<option value="mauritanian">Mauritanian</option>
										<option value="mauritian">Mauritian</option>
										<option value="mexican">Mexican</option>
										<option value="micronesian">Micronesian</option>
										<option value="moldovan">Moldovan</option>
										<option value="monacan">Monacan</option>
										<option value="mongolian">Mongolian</option>
										<option value="moroccan">Moroccan</option>
										<option value="mosotho">Mosotho</option>
										<option value="motswana">Motswana</option>
										<option value="mozambican">Mozambican</option>
										<option value="namibian">Namibian</option>
										<option value="nauruan">Nauruan</option>
										<option value="nepalese">Nepalese</option>
										<option value="new zealander">New Zealander</option>
										<option value="ni-vanuatu">Ni-Vanuatu</option>
										<option value="nicaraguan">Nicaraguan</option>
										<option value="nigerien">Nigerien</option>
										<option value="north korean">North Korean</option>
										<option value="northern irish">Northern Irish</option>
										<option value="norwegian">Norwegian</option>
										<option value="omani">Omani</option>
										<option value="pakistani">Pakistani</option>
										<option value="palauan">Palauan</option>
										<option value="panamanian">Panamanian</option>
										<option value="papua new guinean">Papua New Guinean</option>
										<option value="paraguayan">Paraguayan</option>
										<option value="peruvian">Peruvian</option>
										<option value="polish">Polish</option>
										<option value="portuguese">Portuguese</option>
										<option value="qatari">Qatari</option>
										<option value="romanian">Romanian</option>
										<option value="russian">Russian</option>
										<option value="rwandan">Rwandan</option>
										<option value="saint lucian">Saint Lucian</option>
										<option value="salvadoran">Salvadoran</option>
										<option value="samoan">Samoan</option>
										<option value="san marinese">San Marinese</option>
										<option value="sao tomean">Sao Tomean</option>
										<option value="saudi">Saudi</option>
										<option value="scottish">Scottish</option>
										<option value="senegalese">Senegalese</option>
										<option value="serbian">Serbian</option>
										<option value="seychellois">Seychellois</option>
										<option value="sierra leonean">Sierra Leonean</option>
										<option value="slovakian">Slovakian</option>
										<option value="slovenian">Slovenian</option>
										<option value="solomon islander">Solomon Islander</option>
										<option value="somali">Somali</option>
										<option value="south african">South African</option>
										<option value="south korean">South Korean</option>
										<option value="spanish">Spanish</option>
										<option value="sri lankan">Sri Lankan</option>
										<option value="sudanese">Sudanese</option>
										<option value="surinamer">Surinamer</option>
										<option value="swazi">Swazi</option>
										<option value="swedish">Swedish</option>
										<option value="swiss">Swiss</option>
										<option value="syrian">Syrian</option>
										<option value="taiwanese">Taiwanese</option>
										<option value="tajik">Tajik</option>
										<option value="tanzanian">Tanzanian</option>
										<option value="thai">Thai</option>
										<option value="togolese">Togolese</option>
										<option value="tongan">Tongan</option>
										<option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
										<option value="tunisian">Tunisian</option>
										<option value="turkish">Turkish</option>
										<option value="tuvaluan">Tuvaluan</option>
										<option value="ugandan">Ugandan</option>
										<option value="ukrainian">Ukrainian</option>
										<option value="uruguayan">Uruguayan</option>
										<option value="uzbekistani">Uzbekistani</option>
										<option value="venezuelan">Venezuelan</option>
										<option value="vietnamese">Vietnamese</option>
										<option value="welsh">Welsh</option>
										<option value="yemenite">Yemenite</option>
										<option value="zambian">Zambian</option>
										<option value="zimbabwean">Zimbabwean</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Contact</label>
								<div class="col-md-9">
									<input required type="number" class="form-control" id="inputContact" name="inputContact"placeholder="Contact Number">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Gender</label>
								<div class="col-md-9">
									<select required class="form-control" id="inputGender" name="inputGender">
										<option value="">Gender</option>
										<option value="female">Female</option>
										<option value="male">Male</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Date of Birth</label>
								<div class="col-md-9">
									<input required type="text" class="form-control form_datetime" id="inputDob" name="inputDob"placeholder="Date of Birth">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Role</label>
								<div class="col-md-9">
									<select name="inputAccount" class="form-control">
										<option value="">Account</option>
										<option value="admin">Admin</option>
										<option value="jobseeker">Jobseeker</option>
										<option value="employer">Employer</option>
									</select>
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
						<input type="hidden" type="text" name="inputEmail" id="inputEmail"/> 
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3">First Name</label>
								<div class="col-md-9">
									<input required type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="First Name">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Last Name</label>
								<div class="col-md-9">
									<input required type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="Last Name">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Nationality</label>
								<div class="col-md-9">
									<select required class="form-control" id="inputNationality" name="inputNationality">
										<option value="">Nationality</option>
										<option value="singaporean">Singaporean</option>
										<option value="afghan">Afghan</option>
										<option value="albanian">Albanian</option>
										<option value="algerian">Algerian</option>
										<option value="american">American</option>
										<option value="andorran">Andorran</option>
										<option value="angolan">Angolan</option>
										<option value="antiguans">Antiguans</option>
										<option value="argentinean">Argentinean</option>
										<option value="armenian">Armenian</option>
										<option value="australian">Australian</option>
										<option value="austrian">Austrian</option>
										<option value="azerbaijani">Azerbaijani</option>
										<option value="bahamian">Bahamian</option>
										<option value="bahraini">Bahraini</option>
										<option value="bangladeshi">Bangladeshi</option>
										<option value="barbadian">Barbadian</option>
										<option value="barbudans">Barbudans</option>
										<option value="batswana">Batswana</option>
										<option value="belarusian">Belarusian</option>
										<option value="belgian">Belgian</option>
										<option value="belizean">Belizean</option>
										<option value="beninese">Beninese</option>
										<option value="bhutanese">Bhutanese</option>
										<option value="bolivian">Bolivian</option>
										<option value="bosnian">Bosnian</option>
										<option value="brazilian">Brazilian</option>
										<option value="british">British</option>
										<option value="bruneian">Bruneian</option>
										<option value="bulgarian">Bulgarian</option>
										<option value="burkinabe">Burkinabe</option>
										<option value="burmese">Burmese</option>
										<option value="burundian">Burundian</option>
										<option value="cambodian">Cambodian</option>
										<option value="cameroonian">Cameroonian</option>
										<option value="canadian">Canadian</option>
										<option value="cape verdean">Cape Verdean</option>
										<option value="central african">Central African</option>
										<option value="chadian">Chadian</option>
										<option value="chilean">Chilean</option>
										<option value="chinese">Chinese</option>
										<option value="colombian">Colombian</option>
										<option value="comoran">Comoran</option>
										<option value="congolese">Congolese</option>
										<option value="costa rican">Costa Rican</option>
										<option value="croatian">Croatian</option>
										<option value="cuban">Cuban</option>
										<option value="cypriot">Cypriot</option>
										<option value="czech">Czech</option>
										<option value="danish">Danish</option>
										<option value="djibouti">Djibouti</option>
										<option value="dominican">Dominican</option>
										<option value="dutch">Dutch</option>
										<option value="east timorese">East Timorese</option>
										<option value="ecuadorean">Ecuadorean</option>
										<option value="egyptian">Egyptian</option>
										<option value="emirian">Emirian</option>
										<option value="equatorial guinean">Equatorial Guinean</option>
										<option value="eritrean">Eritrean</option>
										<option value="estonian">Estonian</option>
										<option value="ethiopian">Ethiopian</option>
										<option value="fijian">Fijian</option>
										<option value="filipino">Filipino</option>
										<option value="finnish">Finnish</option>
										<option value="french">French</option>
										<option value="gabonese">Gabonese</option>
										<option value="gambian">Gambian</option>
										<option value="georgian">Georgian</option>
										<option value="german">German</option>
										<option value="ghanaian">Ghanaian</option>
										<option value="greek">Greek</option>
										<option value="grenadian">Grenadian</option>
										<option value="guatemalan">Guatemalan</option>
										<option value="guinea-bissauan">Guinea-Bissauan</option>
										<option value="guinean">Guinean</option>
										<option value="guyanese">Guyanese</option>
										<option value="haitian">Haitian</option>
										<option value="herzegovinian">Herzegovinian</option>
										<option value="honduran">Honduran</option>
										<option value="hungarian">Hungarian</option>
										<option value="icelander">Icelander</option>
										<option value="indian">Indian</option>
										<option value="indonesian">Indonesian</option>
										<option value="iranian">Iranian</option>
										<option value="iraqi">Iraqi</option>
										<option value="irish">Irish</option>
										<option value="israeli">Israeli</option>
										<option value="italian">Italian</option>
										<option value="ivorian">Ivorian</option>
										<option value="jamaican">Jamaican</option>
										<option value="japanese">Japanese</option>
										<option value="jordanian">Jordanian</option>
										<option value="kazakhstani">Kazakhstani</option>
										<option value="kenyan">Kenyan</option>
										<option value="kittian and nevisian">Kittian and Nevisian</option>
										<option value="kuwaiti">Kuwaiti</option>
										<option value="kyrgyz">Kyrgyz</option>
										<option value="laotian">Laotian</option>
										<option value="latvian">Latvian</option>
										<option value="lebanese">Lebanese</option>
										<option value="liberian">Liberian</option>
										<option value="libyan">Libyan</option>
										<option value="liechtensteiner">Liechtensteiner</option>
										<option value="lithuanian">Lithuanian</option>
										<option value="luxembourger">Luxembourger</option>
										<option value="macedonian">Macedonian</option>
										<option value="malagasy">Malagasy</option>
										<option value="malawian">Malawian</option>
										<option value="malaysian">Malaysian</option>
										<option value="maldivan">Maldivan</option>
										<option value="malian">Malian</option>
										<option value="maltese">Maltese</option>
										<option value="marshallese">Marshallese</option>
										<option value="mauritanian">Mauritanian</option>
										<option value="mauritian">Mauritian</option>
										<option value="mexican">Mexican</option>
										<option value="micronesian">Micronesian</option>
										<option value="moldovan">Moldovan</option>
										<option value="monacan">Monacan</option>
										<option value="mongolian">Mongolian</option>
										<option value="moroccan">Moroccan</option>
										<option value="mosotho">Mosotho</option>
										<option value="motswana">Motswana</option>
										<option value="mozambican">Mozambican</option>
										<option value="namibian">Namibian</option>
										<option value="nauruan">Nauruan</option>
										<option value="nepalese">Nepalese</option>
										<option value="new zealander">New Zealander</option>
										<option value="ni-vanuatu">Ni-Vanuatu</option>
										<option value="nicaraguan">Nicaraguan</option>
										<option value="nigerien">Nigerien</option>
										<option value="north korean">North Korean</option>
										<option value="northern irish">Northern Irish</option>
										<option value="norwegian">Norwegian</option>
										<option value="omani">Omani</option>
										<option value="pakistani">Pakistani</option>
										<option value="palauan">Palauan</option>
										<option value="panamanian">Panamanian</option>
										<option value="papua new guinean">Papua New Guinean</option>
										<option value="paraguayan">Paraguayan</option>
										<option value="peruvian">Peruvian</option>
										<option value="polish">Polish</option>
										<option value="portuguese">Portuguese</option>
										<option value="qatari">Qatari</option>
										<option value="romanian">Romanian</option>
										<option value="russian">Russian</option>
										<option value="rwandan">Rwandan</option>
										<option value="saint lucian">Saint Lucian</option>
										<option value="salvadoran">Salvadoran</option>
										<option value="samoan">Samoan</option>
										<option value="san marinese">San Marinese</option>
										<option value="sao tomean">Sao Tomean</option>
										<option value="saudi">Saudi</option>
										<option value="scottish">Scottish</option>
										<option value="senegalese">Senegalese</option>
										<option value="serbian">Serbian</option>
										<option value="seychellois">Seychellois</option>
										<option value="sierra leonean">Sierra Leonean</option>
										<option value="slovakian">Slovakian</option>
										<option value="slovenian">Slovenian</option>
										<option value="solomon islander">Solomon Islander</option>
										<option value="somali">Somali</option>
										<option value="south african">South African</option>
										<option value="south korean">South Korean</option>
										<option value="spanish">Spanish</option>
										<option value="sri lankan">Sri Lankan</option>
										<option value="sudanese">Sudanese</option>
										<option value="surinamer">Surinamer</option>
										<option value="swazi">Swazi</option>
										<option value="swedish">Swedish</option>
										<option value="swiss">Swiss</option>
										<option value="syrian">Syrian</option>
										<option value="taiwanese">Taiwanese</option>
										<option value="tajik">Tajik</option>
										<option value="tanzanian">Tanzanian</option>
										<option value="thai">Thai</option>
										<option value="togolese">Togolese</option>
										<option value="tongan">Tongan</option>
										<option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
										<option value="tunisian">Tunisian</option>
										<option value="turkish">Turkish</option>
										<option value="tuvaluan">Tuvaluan</option>
										<option value="ugandan">Ugandan</option>
										<option value="ukrainian">Ukrainian</option>
										<option value="uruguayan">Uruguayan</option>
										<option value="uzbekistani">Uzbekistani</option>
										<option value="venezuelan">Venezuelan</option>
										<option value="vietnamese">Vietnamese</option>
										<option value="welsh">Welsh</option>
										<option value="yemenite">Yemenite</option>
										<option value="zambian">Zambian</option>
										<option value="zimbabwean">Zimbabwean</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Contact</label>
								<div class="col-md-9">
									<input required type="number" class="form-control" id="inputContact" name="inputContact"placeholder="Contact Number">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Gender</label>
								<div class="col-md-9">
									<select required class="form-control" id="inputGender" name="inputGender">
										<option value="">Gender</option>
										<option value="female">Female</option>
										<option value="male">Male</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Date of Birth</label>
								<div class="col-md-9">
									<input required type="text" class="form-control form_datetime" id="inputDob" name="inputDob"placeholder="Date of Birth">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Role</label>
								<div class="col-md-9">
									<select name="inputAccount" class="form-control">
										<option value="">Account</option>
										<option value="admin">Admin</option>
										<option value="jobseeker">Jobseeker</option>
										<option value="employer">Employer</option>
									</select>
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