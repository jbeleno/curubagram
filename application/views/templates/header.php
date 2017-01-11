<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title><?php print $header_title; ?></title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Custom -->
	<link rel="stylesheet" type="text/css" href="<?php print base_url(); ?>assets/css/custom.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar-custom navbar navbar-default">
		<div class="container">

		    <div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#custom-navbar" aria-expanded="false">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand link-teal" href="<?php print base_url(); ?>index.php/web/index">CurubaGram</a>
		    </div>
		    <!-- /.navbar-brand -->

		    <div class="collapse navbar-collapse" id="custom-navbar">
		      	<ul class="nav navbar-nav navbar-right">
		      		<?php 
		      			if($this->session->userdata('logged_in'))
		      			{
		      		?>
			      		<li><a class="link-teal"><?php print $this->session->userdata('username') ?></a></li>
			      		<li><a href="<?php print base_url(); ?>index.php/web/logout" class="link-teal">Salir</a></li>
		      		<?php 
		      			}
		      			else
		      			{
		      		?>
		      			<li><a class="link-teal" href="<?php print base_url(); ?>index.php/web/login">Ingresar</a></li>
			      		<li><a class="link-teal" href="<?php print base_url(); ?>index.php/web/register">Registrarse</a></li>
		      		<?php 
		      			}
		      		?>
              	</ul>
		    </div>
		    <!-- #navbar-collapse -->

		</div>
		<!-- /.container -->
	</nav>
	<!-- /.navbar -->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<div id="wrapper">
		<div class="content">