<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>CS2102 Group 9</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<?php echo link_tag('assets/css/bootstrap-yeti.css')?>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/additional-methods.min.js"></script>
	<script src="<?php echo base_url() ?>/assets/js/jquery.bootstrap-growl.min.js"></script>
	
	<!-- DataTables -->
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="http://cdn.datatables.net/responsive/1.0.0/css/dataTables.responsive.css" rel="stylesheet">
	<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
	<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
	<script src="http://cdn.datatables.net/responsive/1.0.0/js/dataTables.responsive.js"></script>
	
	<!-- DatePicker -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datetimepicker.min.css')?>">
	<script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js')?>"></script>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	
	<?php echo link_tag('assets/css/main.css')?>

</head>
<body>

<nav class="<?php echo $nav_class ?> navbar navbar-default">
	<div class="container">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?php echo site_url(); ?>"><?php echo $site_title; ?></a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<!--<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>-->
			<li><a href="<?php echo site_url("browse/"); ?>">Browse</a></li>
			<li><a href="<?php echo site_url("search/"); ?>">Search</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Demo <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo site_url("demo/query/"); ?>">Query</a></li>
					<li><a href="<?php echo site_url("demo/insert/"); ?>">Insert</a></li>
					<li><a href="<?php echo site_url("demo/update/"); ?>">Update</a></li>
					<li><a href="<?php echo site_url("demo/delete/"); ?>">Delete</a></li>
				</ul>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			
			<?php if($is_login) : ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo site_url("dashboard/"); ?>">Dashboard</a></li>
					
					<?php if (!$is_admin) : ?>
						<li><a href="<?php echo site_url("profile/"); ?>">Profile</a></li>
						<li><a href="<?php echo site_url("job_list/"); ?>">Job List</a></li>
					<?php elseif ($is_admin) : ?>
						<li><a href="<?php echo site_url("admin/"); ?>">Admin</a></li>
					<?php endif ?>
					
				</ul>
			</li>
			<div id="logout-buttons-section">
				<a href="<?php echo site_url("login/logout_user/"); ?>">			
					<button type="button" class="btn btn-default navbar-btn btn-danger">
						<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log out
					</button>
				</a>
			</div>
			<?php else : ?>
			<div id="login-buttons-section">
				<a href="<?php echo site_url("register/"); ?>">			
					<button type="button" class="btn btn-default navbar-btn">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Sign up
					</button>
				</a>
				<button type="button" class="btn btn-default navbar-btn btn-success" data-toggle="modal" data-target="#loginModel">
					<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Log in
				</button>
			</div>
			<?php endif; ?>
			
		</ul>
	</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>