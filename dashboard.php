<?php
require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

$user_id = $_SESSION["userId"];
require_once('inc/header.php'); 
require_once('inc/topnav.php'); 


?>
<h1>Dashboard</h1>

<?php require_once('inc/footer.php'); ?>