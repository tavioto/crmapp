<?php 

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}


require_once('inc/header.php'); 
require_once('inc/topnav.php'); 
$saved = 0;

?>
<section id="viewUsers">
	<h1>View Users</h1>
	
	
</section>
<?php require_once('inc/footer.php'); ?>