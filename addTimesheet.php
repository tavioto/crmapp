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
				$timesheet = new Timesheet();
				
				if(isset($billable)){
					$timesheet->billable = $billable;
				}else{
					$timesheet->billable = 0;
				}
				$timesheet->id_user = $user_id;
				$timesheet->date_ = $start_date;
				$timesheet->time_ = $time;
				$timesheet->id_customer = $customerId;
				$timesheet->id_project = $projectId;
				$timesheet->description = $description;
				$timesheet->save();
				$saved = 1;
				
	        break;
			case "edit":
				$saved = 1;
				echo "edit";
			break;
	}
}
 if(isset($company_id)){
	 $customer_model = new Customer();
	 $customer = $customer_model->fetchAll(array(array('id_company', '=', $company_id)));
 }
?>
<section id="addTimesheet">
	<h1><?php if(isset($timesheet_id)){echo "Edit";}else{echo "Add";}?> a TimeSheet</h1>
	<?php if($saved == 1){?>
	<div class="alert alert-success">
		<strong>Done!</strong> The TimeSheet was <?php if(isset($timesheet_id)){echo "Edited";}else{echo "Created";}?>.
	</div>
	<?php } ?>
	<form class="add-customer" action="" method="post">
		Billable <input type="checkbox" name="billable" id="billable" value="1" />
		<input type="text" class="input-block-level" placeholder="Date" name="start_date" id="start_date" required value="">
		<input type="text" class="input-block-level" placeholder="Time ex: 1.5" name="time" id="time" value="" required>
		<select name="customerId" id="customerId" class="input-block-level">
			<option value="">--Customer--</option>
			<?php foreach($customer as $c){?>
			<option value="<?php echo $c->id; ?>"><?php echo $c->company_name; ?></option>
			<?php } ?>
		</select>
		<select name="projectId" id="projectId" class="input-block-level">
			<option value="">--Project--</option>
		</select>
		
		Description
		<textarea name="description" id="description" cols="30" rows="10" class="input-block-level"></textarea>
		
		<input type="hidden" class="input-block-level" value="<?php if(!$timesheet_id){echo "add";}else{echo "edit";}?>" name="action">
		<button class="btn btn-large btn-primary" type="submit">Save</button>
	</form>
</section>
<?php require_once('inc/footer.php'); ?>