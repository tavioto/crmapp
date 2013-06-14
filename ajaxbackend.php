<?php 
require_once("includes/includes.php");
extract($_REQUEST);
echo eval("return ($function());");


function LoadCities(){
	extract($_REQUEST);
	$city_model = new City();
	$data = $city_model->fetchAll(array(array('state_id','=', $stateId)));
	if(isset($_GET['callback'])){ 
		echo $_GET['callback'].'('.json_encode($data).')';
	}else{
		echo json_encode($data); 
	}
}
?>