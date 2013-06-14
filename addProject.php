<?php 
require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}
$company_id = $_SESSION['id_company'];
require_once('inc/header.php'); 
require_once('inc/topnav.php'); 

extract($_REQUEST);
$saved = 0;

if(isset($_POST['action']) && $_POST['action'] != ""){
		
		extract($_POST);
		
		switch($action){
			case "add":
				
				$project = new Project();
				$project->name = $name;
				$project->description = $description;
				$project->status = $status;
				$project->start_date = $start_date;
				$project->end_date = $end_date;
				$project->type = $type;
				$project->contact = $contact;
				$project->phone = $phone;
				$project->email = $email;
				$project->address = $address;
				$project->id_company = $company_id;
				$project->save();
				$pro_id = $project->getId();
				
				foreach($employees as $e){
					$pro_emp = new ProjectEmployee();
					$pro_emp->id_project = $pro_id;
					$pro_emp->id_employee = $e;
					$pro_emp->save();
				}
	        	$saved = 1;
	        	
		break;
		case "edit":
				$project = new Project($project_id);
				$project->name = $name;
				$project->description = $description;
				$project->status = $status;
				$project->start_date = $start_date;
				$project->end_date = $end_date;
				$project->type = $type;
				$project->contact = $contact;
				$project->phone = $phone;
				$project->email = $email;
				$project->address = $address;
				$project->id_company = $company_id;
				$project->save();
				$pro_emp = new ProjectEmployee();
				$pro_emp->deleteEmployees($project_id);
				foreach($employees as $e){
					$pro_emp = new ProjectEmployee();
					$pro_emp->id_project = $project_id;
					$pro_emp->id_employee = $e;
					$pro_emp->save();
				}
	        	$saved = 1;
		break;
	}
}


if(isset($project_id)){
	$project = new Project($project_id);
	$pro_emp = new ProjectEmployee($project_id);
}

$state_model = new State();
$state = $state_model->fetchAll();

$user_model = new User();
$user = $user_model->fetchAll(array(array('id_company', '=', $company_id),
									array('id_role', '=', 2)
							  ));

?>
<section id="<addcustomer></addcustomer>">
	<h1><?php if(isset($project_id)){echo "Edit";}else{echo "Add";}?> a Project</h1>
	<?php if($saved == 1){?>
	<div class="alert alert-success">
		<strong>Done!</strong> The Project was <?php if(isset($project_id)){echo "Edited";}else{echo "Created";}?>.
	</div>
	<?php } ?>
	<form class="add-customer" action="" method="post">
		<input type="text" class="input-block-level" placeholder="Name" name="name" id="name" value="<?php echo $project->name;?>" required>
		<textarea name="description" id="description" cols="30" rows="10" class="input-block-level"><?php echo $project->description; ?></textarea>
		<select name="status" id="status" class="input-block-level">
			<option value="">--Status--</option>
			<option value="Active" <?php if($project->status == "Active"){echo "selected";}?>>Active</option>
			<option value="Inactive" <?php if($project->status == "Inactive"){echo "selected";}?>>Inactive</option>
			<option value="Pending" <?php if($project->status == "Pending"){echo "selected";}?>>Pending</option>
		</select>
		<input type="text" class="input-block-level" placeholder="Start Date" name="start_date" id="start_date" required value="<?php echo $project->start_date;?>">
		<input type="text" class="input-block-level" placeholder="End Date" name="end_date" id="end_date" required value="<?php echo $project->end_date;?>">
		<input type="text" class="input-block-level" placeholder="Type of Project" name="type" id="type" required value="<?php echo $project->type;?>">
		<input type="text" class="input-block-level" placeholder="Contact" name="contact" id="contact" required value="<?php echo $project->contact;?>">
		<input type="text" class="input-block-level" placeholder="Phone" name="phone" id="phone" required value="<?php echo $project->phone;?>">
		<input type="email" class="input-block-level" placeholder="Email" name="email" id="email" required value="<?php echo $project->email;?>">
		<input type="text" class="input-block-level" placeholder="Address" name="address" id="address" required value="<?php echo $project->address;?>">
		<legend>Asign Employees</legend>
		
		<div class="controls span2">
			<?php 
				$c = 0; 
				foreach($user as $u){ ?>
						<label class="checkbox">
							<input type="checkbox" value="<?php echo $u->id; ?>" id="inlineCheckbox1" name="employees[]"> <?php echo $u->first_name." ".$u->last_name; ?>
						</label>
						<?php $c++; if($c == 3){ $c = 0; ?>
							</div>
							<div class="controls span2">
						<?php }?>
				<?php } ?>
		</div>
		<input type="text" class="input-block-level" placeholder="Employees" name="" id="" disabled>
		<legend>Documents</legend>
		<input type="hidden" class="input-block-level" value="<?php if(!$project_id){echo "add";}else{echo "edit";}?>" name="action">
		<button class="btn btn-large btn-primary" type="submit">Save</button>
	</form>
</section>
<?php require_once('inc/footer.php'); ?>