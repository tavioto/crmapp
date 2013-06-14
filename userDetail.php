<?php 

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

require_once('inc/header.php'); 
require_once('inc/topnav.php'); 

?>
<section id="userDetail">
	<h1>User Detail</h1>
	
</section>
<?php require_once('inc/footer.php'); ?>