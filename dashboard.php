<?php
require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

$user_id = $_SESSION["userId"];
require_once('inc/header.php'); 
require_once('inc/topnav.php'); 


?>
<div class="row">
	<div class="span3 block red">
		<h2>Add User</h2>
	</div>
	<div class="span3 block orange">
		<h2>Add Customer</h2>
	</div>
	<div class="span3 block blue">
		<h2>Add Project</h2>
	</div>
	<div class="span3 block green">
		<h2>View Reports</h2>
	</div>
</div>

<?php require_once('inc/footer.php'); ?>