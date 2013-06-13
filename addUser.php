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

$user = new User($user_id);
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
		<input type="email" class="input-block-level" placeholder="Email" name="email" id="email" required value="<?php echo $user->mail;?>">
		<input type="text" class="input-block-level" placeholder="Username" name="username" id="username" required value="<?php echo $user->username;?>">
		<?php if(!$user_id){?><input type="password" class="input-block-level" placeholder="Password" name="password" id="password" required><?php } ?>
		<select name="role" id="role" class="input-block-level">
			<option value="2" <?php if($user->id_role == 2){echo "selected";}?>>Employee</option>
			<option value="1" <?php if($user->id_role == 1){echo "selected";}?>>Administrator</option>
		</select>
		<input type="hidden" class="input-block-level" value="add" name="action">
		<button class="btn btn-large btn-primary" type="submit">Add</button>
	</form>
</section>
<?php require_once('inc/footer.php'); ?>