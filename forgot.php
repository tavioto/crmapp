<?php 

require_once("includes/includes.php");

extract($_REQUEST);

if(!isset($f)){
	header('location: index.php');
}
require_once('inc/header.php'); 


if(isset($_POST['action']) && $_POST['action'] != ""){
		
		extract($_POST);
		switch($f){
			case "user":
				$user = new User();
				$username = $user->getUsername($email);
	        	getUserMail($email, $username);
	        	$saved = 'user';
			break;
			case "pass":
				$user = new User();
				$new_pass = $user->forgotPassword($email);
	        	forgotPassMail($email, $new_pass);
	        	$saved = 'pass';
			break;
	}
}
?>
<div class="container">
<section id="forgot">
	<h1>Forgot Username or Password</h1>
	<?php if($saved == 'pass'){?>
	<div class="alert alert-success">
		<strong>Done!</strong> The Password was reset, We'll send an email with your new password.<br>
		<a href="index.php">Go to Login Page</a>
	</div>
	<?php } ?>
	<?php if($saved == 'user'){?>
	<div class="alert alert-success">
		<strong>Done!</strong> We'll send an email with your username.<br>
		<a href="index.php">Go to Login Page</a>
	</div>
	<?php } ?>
	<form action="" method="post">
		<input type="email" class="input-block-level" placeholder="Email" name="email" id="email" required>
		<input type="hidden" class="input-block-level" value="add" name="action">
		<button class="btn btn-large btn-primary" type="submit">Reset</button>
	</form>
</section>
<?php require_once('inc/footer.php'); ?>