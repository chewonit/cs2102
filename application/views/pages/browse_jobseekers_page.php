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
			<?php $attributes = array('class' => 'form', 'id' => 'browseForm'); ?>
			<?php echo form_open('', $attributes); ?>
				<div class="form-group">
					<select class="form-control">
						<option value="">Filters 1</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
				<div class="form-group">
					<select class="form-control">
						<option value="">Filters 2</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
			<?php echo form_close() ?>
			
		</div>
	
		<div class="col-md-9">
		    
			<h4>Please select a category to browse under.</h4>
			
		</div>
	</div>
	
</div>