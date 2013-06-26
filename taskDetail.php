<?php 

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

require_once('inc/header.php'); 
require_once('inc/topnav.php'); 

extract($_REQUEST);
$task = new Task($task_id);
$tsk_emp = new TaskEmployee();
$emp = $tsk_emp->fetchAll(array(array('id_task', '=', $task_id)));
$project = new Project($task->id_project);
$qttyEmp = count($emp);
?>
<section id="userDetail">
	<h1>Task Detail</h1>
          	<table class="table table-hover table-bordered">
	            <tbody>
	            	<tr>
	            		<th>Task Title</th>
	            		<td><?php echo $task->title; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Description</th>
	            		<td><?php echo $task->description; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Estimated Hours</th>
	            		<td><?php echo $task->estimated_hours; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Project</th>
	            		<td><?php echo $project->name; ?></td>
	            	</tr>
	            	<tr>
	            		<th rowspan="<?php echo $qttyEmp; ?>">Employees</th>
	            		<?php
		            		$i=0;
		            		foreach($emp as $e){
			            		$i++;
			            		$user = new User($e->id_employee);
			            	?>
			            		<td><?php echo $i.". ".$user->first_name." ".$user->last_name; ?></td></tr><tr>
		            	<?php } ?>
		            </tr>
	            		
	            </tbody>
            </table>
</section>
<?php require_once('inc/footer.php'); ?>