<?php 

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}


require_once('inc/header.php'); 
require_once('inc/topnav.php'); 
$saved = 0;
if(isset($_POST['action']) && $_POST['action'] != ""){
		
		extract($_POST);
		
		switch($action){
			case "add":
				$user = new User();
				$user->name = $name;
				$user->password = md5($password);
				$user->mail = $email;
				$user->username = $username;
				$user->save();
	        	$saved = 1;
	        	
		break;
		case "edit":
				

		break;
	}
}
?>
<section id="addUser">
	<h1>Add a User</h1>
	<?php if($saved == 1){?>
	<div class="alert alert-success">
		<strong>Done!</strong> The User was created.
	</div>
	<?php } ?>
	<form class="add-user" action="" method="post">
		<!--
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
-->
		<input type="text" class="input-block-level" placeholder="Name" name="name" id="name" required>
		<input type="text" class="input-block-level" placeholder="Username" name="username" id="username" required>
		<input type="password" class="input-block-level" placeholder="Password" name="password" id="password" required>
		<input type="email" class="input-block-level" placeholder="Email" name="email" id="email" required>
		<input type="hidden" class="input-block-level" value="add" name="action">
		<button class="btn btn-large btn-primary" type="submit">Add</button>
	</form>
</section>
<?php require_once('inc/footer.php'); ?>