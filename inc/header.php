<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->

	<head>
		<title>CRM</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1, user-scalable=no" />
		<meta name="description" content="" />

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    	<meta name="msapplication-TileColor" content="" /> <!-- SET COLOR -->
		<meta name="msapplication-TileImage" content="icons/fav144.png" />

    	<!-- FAVICON -->
    	<link rel="icon" href="icons/fav16.png" sizes="16x16" type="image/png" />
	    <link rel="icon" href="icons/fav32.png" sizes="32x32" type="image/png" />
	    <link rel="icon" href="icons/fav48.png" sizes="48x48" type="image/png" />
	    <link rel="icon" href="icons/fav64.png" sizes="64x64" type="image/png" />
	    <link rel="icon" href="icons/fav128.png" sizes="128x128" type="image/png" />
	    <link rel="icon" href="icons/fav32.png" />

	    <!-- HOMESCREEN ICON - OPTIONAL 
	    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="touch-icon-114.png" />
	    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="touch-icon-114.png" />
	    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="touch-icon-144.png" />
	    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="touch-icon-144.png" />
		-->

	    <!-- STYLE -->
	    <link href="stylesheets/screen.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="stylesheets/bootstrap.css" media="screen, projection" rel="stylesheet" type="text/css" />
		<link href="stylesheets/bootstrap-responsive.css" media="screen, projection" rel="stylesheet" type="text/css" />
		<link href="stylesheets/datepicker.css" media="screen, projection" rel="stylesheet" type="text/css" />
		<link href="stylesheets/zebra_pagination.css" media="screen, projection" rel="stylesheet" type="text/css" />

		<!-- JS LIBRARY -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
		
		<!-- IE CONDITIONALS -->
		<!--[if IE]>
			<link rel="shortcut icon" href="icons/favicon.ico" />
		<![endif]-->
		<!--[if lt IE 9]>
			<link href="stylesheets/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
			<script type="text/javascript" src="js/modernizr.2.6.2.js"></script>
		<![endif]-->
		
		

	</head>
	<body>
	<?php 
		$company = new Company($_SESSION['id_company']);
	?>
		<div class="header">
			<h1><?php echo $company->name; ?></h1>
		</div>
