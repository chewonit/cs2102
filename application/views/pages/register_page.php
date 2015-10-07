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
		
			<script type="text/javascript">
				var jq = jQuery.noConflict();

				jQuery.validator.addMethod("alphanumeric", function(value, element) {
					return this.optional(element) || /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9$&+,:;=?@#|'<>.-^*()%!]+)$/.test(value);
				}, "The input must contain Alphabets and Numbers."); 
				
				jQuery.validator.addMethod('positiveNumber',
					function (value) { 
						return Number(value) > 0;
					}, 
					'Invalid contact number.');

				jq( document ).ready(function() {

					jq("#signUpForm").validate({
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
				});			
			</script>
			
			<?php if($submitted && $create_success) : ?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4>Your account was created successfully.</h4>
				</div>
			<?php elseif( $submitted && !$form_validation ) : ?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4>Please check your form input entries.</h4>
					<?php echo validation_errors(); ?>
				</div>
			<?php elseif( $submitted && $form_validation && !$create_success ) : ?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4>An error encountered when creating your account.</h4>
					<br />Please contact the administrator for assistance. 
				</div>
			<?php endif ?>
								
			<?php $attributes = array('id' => 'signUpForm'); ?>
			<?php echo form_open('register/register_user/', $attributes);?>
				<div id="registerForm" class="fluid-container">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="inputFirstName">First Name</label>
							<input required type="text" class="form-control" id="inputFirstName" name="inputFirstName" placeholder="First Name" value="<?php echo $form_data['first_name'] ?>">
						</div>
						<div class="form-group col-md-6">
							<label for="inputLastName">Last Name</label>
							<input required type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="Last Name" value="<?php echo $form_data['last_name'] ?>">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="inputEmail">Email address</label>
							<div id="inputEmail-container" class="input-group">
								<div class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></div>
								<input required type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email address" value="<?php echo $form_data['email'] ?>">
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="inputPassword">Password</label>
							<div class="input-group">
								<div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
								<input required type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
							</div>
						</div>
					</div>
					<div class="row">
					
						<script type="text/javascript">
							var jq = jQuery.noConflict();
							jq( document ).ready(function() {
								jq("#inputNationality").val("<?php echo $form_data['nationality'] ?>");
								jq("#inputGender").val("<?php echo $form_data['gender'] ?>");
							});
						</script>
						
						<div class="form-group col-md-6">
							<label for="inputNationality">Nationality</label>
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
						<div class="form-group col-md-6">
							<label for="inputContact">Contact Number</label>
							<input required type="number" class="form-control" id="inputContact" name="inputContact"placeholder="Contact Number" value="<?php echo $form_data['contact'] ?>">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<div class="form-group">
								<label for="inputGender">Gender:</label>
								<select required class="form-control" id="inputGender" name="inputGender">
									<option value="">Gender</option>
									<option value="female">Female</option>
									<option value="male">Male</option>
								</select>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="inputAccount">Account:</label><br />
							<div class="btn-group" data-toggle="buttons">
								<label class="btn btn-default active">
									<input type="radio" name="inputAccount" id="inputAccount_jobseeker" autocomplete="off" value="jobseeker" checked> Jobseeker
								</label>
								<label class="btn btn-default">
									<input type="radio" name="inputAccount" id="inputAccount_employer" autocomplete="off" value="employer"> Employer
								</label>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-default btn-success">Sign Up</button>
				</div>
			<?php echo form_close();?>
			
		</div> 
	</div>
</div>