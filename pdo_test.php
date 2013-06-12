<?php

	require_once("includes/includes.php");
	
	try {  	

		$results = $db->query('SELECT * FROM users');  
		$data = $results->fetchAll();
		print_r($data);
		
	}catch(PDOException $e) {  
		echo $e->getMessage();  
	}  
	
?>