<?php

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

extract($_REQUEST);

$task_model = new Task(); 
$delete = $task_model->deleteTask($task_id); 
header('location: viewTasks.php');
?>