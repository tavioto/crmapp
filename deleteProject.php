<?php

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

extract($_REQUEST);

$project_model = new Project();
$delete = $project_model->deleteProject($project_id);
header('location: viewProjects.php');
?>