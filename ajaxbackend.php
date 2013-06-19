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

function LoadProjects(){
	extract($_REQUEST);
	$project_model = new Project();
	$data = $project_model->fetchAll(array(array('id_customer','=', $customerId)));
	if(isset($_GET['callback'])){ 
		echo $_GET['callback'].'('.json_encode($data).')';
	}else{
		echo json_encode($data); 
	}
}

function LoadTimesheet(){
	extract($_REQUEST);
	$proj_emp_model = new ProjectEmployee();
	$proj_emp = $proj_emp_model->fetchAll(array(array('id_employee', '=', $user_id)));
	
	$project_model = new Project();
	
	foreach($proj_emp as $pe){
		$project = new Project($pe->id_project);
		$date = explode('-', $project->end_date);
		$year = $date[0];
		$month = $date[1];
		$day = $date[2];
		$data[] = array(
					'id' => $project->id,
					'title' => "Due $project->name",
					'start' => "$year-$month-$day",
					'url' => "projectDetails.php?project_id=$project->id"
		);
	}
	
	$timesheet_model = new Timesheet();
	$timesheet = $timesheet_model->fetchAll(array(array('id_user', '=', $user_id)));
	
	foreach($timesheet as $t){
		$project = new Project($t->id_project);
		$customer = new Customer($t->id_customer);
		$date = explode('-', $t->date_);
		$year = $date[0];
		$month = $date[1];
		$day = $date[2];	
		$data[] = array(
					'id' => $t->id,
					'title' => "$project->name, $customer->company_name",
					'start' => "$year-$month-$day",
					'url' => "timesheetDetail.php?timesheet_id=$t->id"
					
		);
	}
	
	$timesheet_model = new Timesheet();
	$timesheet = $timesheet_model->fetchAll(array(array('id_user', '=', $user_id)));
	
	foreach($timesheet as $t){
		$date = explode('-', $t->date_);
		$year = $date[0];
		$month = $date[1];
		$day = $date[2];
		$total_hours = $timesheet_model->HoursDay($user_id, $t->date_);
		$tHours[] = $t->date_.":".$total_hours[0]->TotalHours;
		
	}
	$result = array_unique($tHours);
	
	foreach($result as $r){
		$re = explode(":", $r);
		
		$data[] = array(
					'title' => "Total Hours: $re[1]",
					'start' => "$re[0]"
		);	
	}
	
	
	if(isset($_GET['callback'])){ 
		echo $_GET['callback'].'('.json_encode($data).')';
	}else{
		echo json_encode($data); 
	}
}
?>