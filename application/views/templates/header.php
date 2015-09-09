<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>CS2102 Group 9</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<?php echo link_tag('assets/css/main.css')?>

</head>
<body>

<nav class="navbar navbar-default">
	<div class="container">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#"><?php echo $site_title; ?></a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
			<li><a href="#">Link</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#">Link</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#">Link</a></li>
				</ul>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="#">Login</a></li>
		</ul>
	</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>

<div class="container">