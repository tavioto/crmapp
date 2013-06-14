<?php
	date_default_timezone_set('America/New_York');
	require_once("config.php");
	require_once("functions.php");
	require_once("libs/Zebra_Pagination.php");
        
    $db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $auth = new Auth($db);

	/*if(!$auth->userLogged()){
		header('location: index.php');
	}*/
?>