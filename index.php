<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
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
			
			<nav>
				<div class="navbar navbar-inverse">
				  <div class="navbar-inner">
				    <div class="container">
				 
				      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
				      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </a>
				 
				      <!-- Be sure to leave the brand out there if you want it shown -->
				      <a class="brand" href="#">Administrator</a>
				 
				      <!-- Everything you want hidden at 940px or less, place within here -->
				      <div class="nav-collapse collapse">
				        <!-- .nav, .navbar-search, .navbar-form, etc -->
				        <ul class="nav nav-pills">
					        <li><a href="#">Home</a></li>
					        <li><a href="#">Login/Logout</a></li>
					        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Company Profile</a>
					        	<ul class="dropdown-menu">
						        	<li><a href="#">Login/Logout</a></li>
						        	<li><a href="#">Login/Logout</a></li>
					        	</ul>
					        </li>
				        </ul>
				      </div>
				 
				    </div>
				  </div>
				</div>
			</nav>
	
			<section id="login">
				<h1>Login to Your Account</h1>
				<form class="form-signin">
					<h2 class="form-signin-heading">Please sign in</h2>
					<input type="text" class="input-block-level" placeholder="Email address">
					<input type="password" class="input-block-level" placeholder="Password">
					<label class="checkbox">
						<input type="checkbox" value="remember-me"> Remember me
					</label>
					<button class="btn btn-large btn-primary" type="submit">Sign in</button>
				</form>
			</section>
			
			<section id="addUser">
				<h1>Add a User</h1>
				<form class="add-user">
					<input type="text" class="input-block-level" placeholder="First Name">
					<input type="text" class="input-block-level" placeholder="Last Name">
					<input type="text" class="input-block-level" placeholder="Phone Number">
					<input type="text" class="input-block-level" placeholder="City">
					<input type="text" class="input-block-level" placeholder="State">
					<input type="text" class="input-block-level" placeholder="Address">
					<input type="text" class="input-block-level" placeholder="Zipcode">
					<input type="text" class="input-block-level" placeholder="Birthday">
					<input type="text" class="input-block-level" placeholder="Employment Start Date">
					<input type="text" class="input-block-level" placeholder="Role">
					<button class="btn btn-large btn-primary" type="submit">Add</button>
				</form>
			</section>
	
			<footer></footer>
			
		</div>

		

		<!-- JS -->
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
		<script type="text/javascript" src="js/plugins.js"></script>
		

		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-XXXXX-X']); // REPLACE WITH YOUR UA KEY
			_gaq.push(['_trackPageview']);

			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
	</body>
</html>