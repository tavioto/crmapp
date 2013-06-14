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
				$customer = new Customer();
				$customer->company_name = $company_name;
				$customer->phone = $phone;
				$customer->state_id = $state;
				$customer->city_id = $city;
				$customer->email = $email;
				$customer->company_contact = $company_contact;
				$customer->address = $address;
				$customer->zip = $zip;
				$customer->website = $website;
				$customer->id_company = $company_id;
				$customer->save();
	        	$saved = 1;
	        	
		break;
		case "edit":
				$customer = new Customer($customer_id);
				$customer->company_name = $company_name;
				$customer->phone = $phone;
				$customer->state_id = $state;
				$customer->city_id = $city;
				$customer->email = $email;
				$customer->company_contact = $company_contact;
				$customer->address = $address;
				$customer->zip = $zip;
				$customer->website = $website;
				$customer->id_company = $company_id;
				$customer->save();
	        	$saved = 1;
		break;
	}
}


if(isset($customer_id)){
	$customer = new Customer($customer_id);
	$city_model = new City();
	$city_ = $city_model->fetchAll(array(array('state_id', '=', $customer->state_id)));
}

$state_model = new State();
$state = $state_model->fetchAll();

?>
<section id="<addcustomer></addcustomer>">
	<h1><?php if(isset($customer_id)){echo "Edit";}else{echo "Add";}?> a Customer</h1>
	<?php if($saved == 1){?>
	<div class="alert alert-success">
		<strong>Done!</strong> The Customer was <?php if(isset($customer_id)){echo "Edited";}else{echo "Created";}?>.
	</div>
	<?php } ?>
	<form class="add-customer" action="" method="post">
		<input type="text" class="input-block-level" placeholder="Company Name" name="company_name" id="company_name" value="<?php echo $customer->company_name;?>" required>
		<input type="text" class="input-block-level" placeholder="Phone" name="phone" id="phone" required value="<?php echo $customer->phone;?>">
		<select name="state" id="state" class="input-block-level">
			<option value="">--State--</option>
			<?php foreach($state as $st){?>
			<option value="<?php echo $st->id; ?>" <?php if($customer->state_id == $st->id){echo "selected";}?>><?php echo $st->name; ?></option>
			<?php } ?>
		</select>
		<select name="city" id="city" class="input-block-level">
			<option value="">--City--</option>
			<?php foreach($city_ as $ct){?>
			<option value="<?php echo $ct->id; ?>" <?php if($customer->city_id == $ct->id){echo "selected";}?>><?php echo $ct->name; ?></option>
			<?php } ?>
		</select>
		<input type="email" class="input-block-level" placeholder="Email" name="email" id="email" required value="<?php echo $customer->email;?>">
		<input type="text" class="input-block-level" placeholder="Company Contact" name="company_contact" id="company_contact" required value="<?php echo $customer->company_contact;?>">
		<input type="text" class="input-block-level" placeholder="Address" name="address" id="address" required value="<?php echo $customer->address;?>">
		<input type="text" class="input-block-level" placeholder="Zip Code" name="zip" id="zip" required value="<?php echo $customer->zip;?>">
		<input type="text" class="input-block-level" placeholder="Website URL" name="website" id="website" required value="<?php echo $customer->website;?>">
		<input type="hidden" class="input-block-level" value="<?php if(!$customer_id){echo "add";}else{echo "edit";}?>" name="action">
		<button class="btn btn-large btn-primary" type="submit">Save</button>
	</form>
</section>
<?php require_once('inc/footer.php'); ?>