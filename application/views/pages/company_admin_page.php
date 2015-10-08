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
			<h4>Pending Employers</h4>
		</div>
	</div>
	
	<?php if (count($employer_list) == 0) : ?>
	<div class="row">
		<div class="col-md-12">
			<p>No pending employers.</p>
		</div>
	</div>
	<?php endif ?>
	
	<?php for ($i = 0; $i < count($employer_list); $i++) : ?>
	<div class="row">
		<?php for ($j = 0; $j < 3; $j++, $i++) : ?>
		<?php if ( $i >= count($employer_list) ) : ?>
			<div class="col-md-4"></div>
		<?php else : ?>
			<div class="col-md-4">
				<?php $row = $employer_list[$i]; ?>
				<section class="company-employer-item">
					<div class="container-fluid">
						<div class="row">
						<div class="col-md-8">
							<h5><?php echo Ucwords($row->first_name . " " . $row->last_name); ?></h5>
							<h6>
								<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?php echo $row->employer; ?>
							</h6>
							<h6>
								<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <?php echo $row->contact; ?>
							</h6>
							<h6>
								<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo Ucwords($row->gender); ?>
							</h6>						
							
						</div>
						<div class="col-md-4 text-right">
							<button class="btn btn-default btn-sm btn-success" onclick="accept_employer(this, '<?php echo $row->employer; ?>')">Accept</button>
						</div>
						</div>
					</div>
				</section>
			</div>
		<?php endif ?>
		<?php endfor ?>
		<?php $i-- ?>
	</div>
	<?php endfor; ?>
	
	
	<div class="row">
		<div class="col-md-12">
			<h4>Accepted Employers</h4>
		</div>
	</div>
	
	<?php if (count($employer_list_accepted) == 0) : ?>
	<div class="row">
		<div class="col-md-12">
			<p>No accepted employers.</p>
		</div>
	</div>
	<?php endif ?>
	
	<?php for ($i = 0; $i < count($employer_list_accepted); $i++) : ?>
	<div class="row">
		<?php for ($j = 0; $j < 3; $j++, $i++) : ?>
		<?php if ( $i >= count($employer_list_accepted) ) : ?>
			<div class="col-md-4"></div>
		<?php else : ?>
			<div class="col-md-4">
				<?php $row = $employer_list_accepted[$i]; ?>
				<section class="company-employer-item">
					<div class="container-fluid">
						<div class="row">
						<div class="col-md-8">
							<h5><?php echo Ucwords($row->first_name . " " . $row->last_name); ?></h5>
							<h6>
								<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?php echo $row->employer; ?>
							</h6>
							<h6>
								<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <?php echo $row->contact; ?>
							</h6>
							<h6>
								<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo Ucwords($row->gender); ?>
							</h6>						
							
						</div>
						<div class="col-md-4 text-right">
							<button class="btn btn-default btn-sm btn-danger" onclick="reject_employer(this, '<?php echo $row->employer; ?>')">Reject</button>
						</div>
						</div>
					</div>
				</section>
			</div>
		<?php endif ?>
		<?php endfor ?>
		<?php $i-- ?>
	</div>
	<?php endfor; ?>

	<script type="text/javascript">
	var jq = jQuery.noConflict();
	var reloadDelay = 500;
	
	function accept_employer(btn, employer) {
		jq(btn).attr('disabled',true);
		jq(btn).removeClass( "btn-success" );
		jq(btn).text("Processing...");
		jq.post( "<?php echo site_url('company/company_accept_employer')?>/", 
			{
				'employer': employer 
			},
			function(data) {
				var status = jQuery.parseJSON(data).status;
				if (status) {
					jq.bootstrapGrowl('<h5>Employer Accepted.</h5>Page will reload.' , {type: 'success'});
					setTimeout(function(){
						location.reload();
					}, reloadDelay);
				}
				else
				{
					jq(btn).attr('disabled',false);
					jq(btn).addClass( "btn-success" );
					jq(btn).text("Accept");
					jq.bootstrapGrowl('<h5>Error. Could not accept employer.</h5>' , {type: 'danger'});
				}
			})
			.fail(function() {
				jq(btn).attr('disabled',false);
				jq(btn).addClass( "btn-success" );
				jq(btn).text("Accept");
				jq.bootstrapGrowl('<h5>Error. Could not accept employer.</h5>' , {type: 'danger'});
			})
			.always(function() {});
			
	}
	
	function reject_employer(btn, employer) {
		jq(btn).attr('disabled',true);
		jq(btn).removeClass( "btn-danger" );
		jq(btn).text("Processing...");
		jq.post( "<?php echo site_url('company/company_reject_employer')?>/", 
			{
				'employer': employer 
			},
			function(data) {
				var status = jQuery.parseJSON(data).status;
				if (status) {
					jq.bootstrapGrowl('<h5>Employer Rejected.</h5>Page will reload.' , {type: 'success'});
					setTimeout(function(){
						location.reload();
					}, reloadDelay);
				}
				else
				{
					jq(btn).attr('disabled',false);
					jq(btn).addClass( "btn-danger" );
					jq(btn).text("Reject");
					jq.bootstrapGrowl('<h5>Error. Could not accept employer.</h5>' , {type: 'danger'});
				}
			})
			.fail(function() {
				jq(btn).attr('disabled',false);
				jq(btn).addClass( "btn-danger" );
				jq(btn).text("Reject");
				jq.bootstrapGrowl('<h5>Error. Could not accept employer.</h5>' , {type: 'danger'});
			})
			.always(function() {});
			
	}

	</script>
	
</div>

