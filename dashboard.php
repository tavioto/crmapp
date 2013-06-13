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
		<h2>Users</h2>
		<ul>
			<li>Add a New User</li>
			<li>Modify a User</li>
		</ul>
	</div>
	<div class="span3 block orange">
		<h2>Customers</h2>
		<ul>
			<li>Add a New Customer</li>
			<li>Modify a Customer</li>
			<li>View Customer Report</li>
		</ul>
	</div>
	<div class="span3 block blue">
		<h2>Projects</h2>
		<ul>
			<li>Add a New Project</li>
			<li>Modify a Project</li>
			<li>View a Project</li>
			<li>View Project Report</li>
		</ul>
	</div>
	<div class="span3 block green">
		<h2>Reports</h2>
		<ul>
			<li>Employee Report</li>
			<li>Project Report</li>
			<li>Custom Report</li>
		</ul>
	</div>
</div>

<?php require_once('inc/footer.php'); ?>