<?php

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

extract($_REQUEST);

$customer_model = new Customer(); 
$delete = $customer_model->deleteCustomer($customer_id); 
header('location: viewCustomers.php');
?>