<?php

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

extract($_REQUEST);

//if($_SESSION["profile"] != "admin"){
//	header('location: dashboard.php?user_id='.$user_id);
//}

$user_model = new User();
$delete = $user_model->deleteUser($user_id);
header('location: viewUsers.php');
?>