<?php 
require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

$company_id = $_SESSION['id_company'];
$user_id = $_SESSION['userId'];

require_once('inc/header.php'); 
require_once('inc/topnav.php'); 

extract($_REQUEST);
$saved = 0;

if(isset($_POST['action']) && $_POST['action'] != ""){
		
		extract($_POST);
		
		switch($action){
			case "add":
				$task = new Task();
				$task->title = $title;
				$task->description = $description;
				$task->estimated_hours = $time;
				$task->id_project = $project;
				$task->save();
				$tas_id = $task->getId();
				
				foreach($employees as $e){
					$task_emp = new TaskEmployee();
					$task_emp->id_project = $project;
					$task_emp->id_employee = $e;
					$task_emp->id_task = $tas_id;
					$task_emp->save();
				}
				
	        	$saved = 1;
	        	
		break;
		case "edit":
				
	        	$saved = 1;
		break;
	}
}

$project_model = new Project();
$project = $project_model->fetchAll(array(array('id_company', '=', $company_id)));

$user_model = new User();
$user = $user_model->fetchAll(array(
	            				array('id_company', '=', $company_id),
	            				array('AND', 'id_role', '=', 2)
	            			));
?>
<section id="addProject">
	<h1><?php if(isset($task_id)){echo "Edit";}else{echo "Add";}?> a Task</h1>
	<?php if($saved == 1){?>
	<div class="alert alert-success">
		<strong>Done!</strong> The Task was <?php if(isset($task_id)){echo "Edited";}else{echo "Created";}?>.
	</div>
	<?php } ?>
	<form class="add-customer" action="" method="post">
		<input type="text" class="input-block-level" placeholder="Title" name="title" id="title" required value="">
		<label for="">Description:</label>
		<textarea name="description" id="description" cols="30" rows="10" class="input-block-level"></textarea>
		<select name="project" id="project" class="input-block-level">
			<option value="">--Projects--</option>
			<?php foreach($project as $pro){?>
			<option value="<?php echo $pro->id;?>"><?php echo $pro->name;?></option>
			<?php } ?>
		</select>
		<input type="text" class="input-block-level" placeholder="Estimated Hours Ex: 1.5" name="time" id="time" required value="">
		<legend>Asign Employees</legend>
		
		<div class="controls span2">
			<?php 
				$c = 0; 
				foreach($user as $u){ 
					if(in_array($u->id, $empl)){
						$checked = "checked";
					}else{
						$checked = "";
					}
				?>
						<label class="checkbox">
							<input type="checkbox" value="<?php echo $u->id; ?>" id="inlineCheckbox1" name="employees[]" <?php echo $checked; ?>> <?php echo $u->first_name." ".$u->last_name; ?>
						</label>
						<?php $c++; if($c == 3){ $c = 0; ?>
							</div>
							<div class="controls span2">
						<?php }?>
				<?php } ?>
		</div>
		<legend>&nbsp;</legend>
		<input type="hidden" class="input-block-level" value="<?php if(!$project_id){echo "add";}else{echo "edit";}?>" name="action">
		<button class="btn btn-large btn-primary" type="submit">Save</button>
	</form>
</section>
<?php require_once('inc/footer.php'); ?>