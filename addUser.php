<?php 

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

require_once('inc/header.php'); 
require_once('inc/topnav.php'); 
$saved = 0;
if(isset($_POST['action']) && $_POST['action'] != ""){
		
		extract($_POST);
		
		switch($action){
			case "add":
				$createDate = date("Y-m-d", time());
				$user = new User();
				$user->first_name = $first_name;
				$user->last_name = $last_name;
				$user->password = md5($password);
				$user->mail = $email;
				$user->username = $username;
				$user->save();
	        	$saved = 1;
	        	
		break;
		case "edit":
				

		break;
	}
}

extract($_REQUEST);
if(isset($user_id)){
	$user = new User($user_id);	
}

?>
<section id="addUser">
	<h1>Add a User</h1>
	<?php if($saved == 1){?>
	<div class="alert alert-success">
		<strong>Done!</strong> The User was created.
	</div>
	<?php } ?>
	<form class="add-user" action="" method="post">
		<input type="text" class="input-block-level" placeholder="First Name" name="first_name" id="first_name" value="<?php echo $user->first_name;?>" required>
		<input type="text" class="input-block-level" placeholder="Last Name" name="last_name" id="last_name" required value="<?php echo $user->last_name;?>">
		<select name="state" id="state" class="input-block-level">
			<option value="">--State--</option>
		</select>
		<select name="city" id="city" class="input-block-level">
			<option value="">--City--</option>
		</select>
		<input type="text" class="input-block-level" placeholder="Address" name="address" id="address" required value="<?php echo $user->address;?>">
		<input type="text" class="input-block-level" placeholder="Zipcode" name="zip" id="zip" required value="<?php echo $user->zip;?>">
		<input type="email" class="input-block-level" placeholder="Email" name="email" id="email" required value="<?php echo $user->mail;?>">
		<input type="text" class="input-block-level" placeholder="Phone Number" name="phone" id="phone" required value="<?php echo $user->phone;?>">
		<input type="text" class="input-block-level" placeholder="Birthday" name="birthday" id="birthday" required value="<?php echo $user->birthday;?>">
		<input type="text" class="input-block-level" placeholder="Employment Start Date" name="start_date" id="start_date" required value="<?php echo $user->emp_start_day;?>">
		<select name="emp_type" id="emp_type" class="input-block-level">
			<option value="Contractor">Contractor</option>
			<option value="Full Time">Full Time</option>
			<option value="Part Time">Part Time</option>
		</select>
		<input type="text" class="input-block-level" placeholder="Hourly Pay Rate" name="hourly_pay" id="hourly_pay" required value="<?php echo $user->hourly_pay;?>">
		<input type="text" class="input-block-level" placeholder="Hourly Charge Rate" name="hourly_charge" id="hourly_charge" required value="<?php echo $user->hourly_charge;?>">
		<input type="text" class="input-block-level" placeholder="Username" name="username" id="username" required value="<?php echo $user->username;?>">
		<?php if(!$user_id){?><input type="password" class="input-block-level" placeholder="Password" name="password" id="password" required><?php } ?>
		<select name="role" id="role" class="input-block-level">
			<option value="2" <?php if($user->id_role == 2){echo "selected";}?>>Employee</option>
			<option value="1" <?php if($user->id_role == 1){echo "selected";}?>>Administrator</option>
		</select>
		<input type="hidden" class="input-block-level" value="<?php if(!$user_id){echo "add";}else{echo "edit";}?>" name="action">
		<button class="btn btn-large btn-primary" type="submit">Add</button>
	</form>
</section>
<?php require_once('inc/footer.php'); ?>