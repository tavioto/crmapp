<?php 
	require_once("includes/config.php");
	require_once("includes/functions.php");
	 
    $db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    $auth = new Auth($db);
    $log = -1;
	if(isPost()){
		if($auth->validUser($_POST)){
			$log = 1;
			$auth->loggedUser();
		}else{
			$log = 0;
		}
	}
	
?>
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
	    <link href="stylesheets/screen.css" media="print" rel="stylesheet" type="text/css" />
		<link href="stylesheets/bootstrap.css" media="screen, projection" rel="stylesheet" type="text/css" />
		<link href="stylesheets/bootstrap-responsive.css" media="screen, projection" rel="stylesheet" type="text/css" />

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
	
		<div class="container">
		
			<section id="login">
				<h1>Login to Your Account</h1>
				<form class="form-signin" action="" method="post">
					<h2 class="form-signin-heading">Please sign in</h2>
					<input type="text" class="input-block-level" placeholder="Email address" name="username" id="username">
					<input type="password" class="input-block-level" placeholder="Password" name="password" id="password">
					<label class="checkbox">
						<a href="forgot.php?f=user">Forgot your user?</a> | <a href="forgot.php?f=pass">Forgot your password?</a>
					</label>
					<button class="btn btn-large btn-primary" type="submit">Sign in</button>
				</form>
			</section>