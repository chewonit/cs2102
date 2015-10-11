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
		
			<?php $attributes = array('class' => 'form', 'id' => 'joinCompanyForm'); ?>
			<?php echo form_open('company/join', $attributes); ?>
			
				<div class="form-group">
						<select name="inputCompany" class="form-control">
						<option value="">Select Company</option>
						<?php foreach($company_list->result() as $company) : ?>
						<option value="<?php echo $company->company_reg_no ?>">
						<?php echo $company->company_name ?>
						</option>
						<?php endforeach ?>	
						</select>
						
						<input type="hidden" name="inputEmail" value="<?php echo $user_info['email'] ?>">		
				</div>
				

				<button type="submit" class="btn btn-default">Submit</button>
				
				<input type=button class="btn btn-default" onClick="parent.location='/cs2102/company/create/'" value='Create Company'>
				
				<?php //if($join_success) : ?>
				<!--<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4>Your request is pending for approval.</h4>
				</div>
				<?php //elseif(!$join_success ) : ?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4>Unable to join company.</h4>
				</div>	-->	
				<?php //endif ?>
		
			<?php echo form_close() ?>
			
		</div>

	</div>

</div>