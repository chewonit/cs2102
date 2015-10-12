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
	
	<?php if(count($company_applied_list) == 0) : ?>

	<div class="row">
	
		<div class="col-md-3">
		
			<?php $attributes = array('class' => 'form', 'id' => 'joinCompanyForm'); ?>
			<?php echo form_open('company/join_company/', $attributes); ?>
			
				<div class="form-group">
						<select required name="inputCompany" class="form-control">
							<option value="">Select Company</option>
							
							<?php foreach($company_list->result() as $company) : ?>
								<option value="<?php echo $company->company_reg_no ?>">
								<?php echo $company->company_name ?>
								</option>
							<?php endforeach ?>	
							
						</select>
						
						<input type="hidden" name="inputEmail" value="<?php echo $user_email ?>">		
				</div>
				

				<button type="submit" class="btn btn-default">Submit</button>
				
				<input type="button" class="btn btn-default" onClick="parent.location='/cs2102/company/create/'" value='Create Company'>
				
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
		
		<div class="col-md-9">

		</div>
	</div>
	
	
	<?php else :?>
	
		<?php for ($i = 0; $i < count($company_applied_list); $i++) : ?>
		<div class="row">
			<?php for ($j = 0; $j < 3; $j++, $i++) : ?>
			<?php if ( $i >= count($company_applied_list) ) : ?>
				<div class="col-md-4"></div>
			<?php else : ?>
				<div class="col-md-4">
					<?php $row = $company_applied_list[$i]; ?>
					<section class="company-employer-item">
						<h3 style="margin-top:0">Company: <?php echo ucwords($row->company_name); ?></h3>
						<h5>Status: Pending</h5>
						
						<?php echo form_open('company/cancel_join_company/'); ?>
							<input type="hidden" name="inputEmail" value="<?php echo $user_email ?>">
							<button class="btn btn-default btn-danger">Cancel</button>
						<?php echo form_close(); ?>
						
					</section>
				</div>
			<?php endif ?>
			<?php endfor ?>
			<?php $i-- ?>
		</div>
		<?php endfor; ?>
	
	<?php endif ?>
	
	<div class="row">
		<div class="col-md-12">
			
			
			
		</div>
	</div>

</div>