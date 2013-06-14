<?php 

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

require_once('inc/header.php'); 
require_once('inc/topnav.php'); 

extract($_REQUEST);
$user = new User($user_id);

$role = new Role($user->id_role);
$company = new Company($user->id_company);
$state = new State($user->state_id);
$city = new City($user->city_id);

if($user->active == 1){
	$active = 'Active';
}else{
	$active = 'Inactive';
}


?>
<section id="userDetail">
	<h1>User Detail</h1>
	<legend><?php echo $user->first_name." ".$user->last_name; ?></legend>
          	<table class="table table-hover table-bordered">
	            <tbody>
	            	<tr>
	            		<th>Role Type</th>
	            		<td><?php echo $role->name; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Name</th>
	            		<td><?php echo $user->first_name." ".$user->last_name; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Mail</th>
	            		<td><?php echo $user->mail; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Username</th>
	            		<td><?php echo $user->username; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Status</th>
	            		<td><?php echo $active; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Company</th>
	            		<td><?php echo $company->name; ?></td>
	            	</tr>
	            	<tr>
	            		<th>State</th>
	            		<td><?php echo $state->name; ?></td>
	            	</tr>
	            	<tr>
	            		<th>City</th>
	            		<td><?php echo $city->name; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Address</th>
	            		<td><?php echo $user->address; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Zipcode</th>
	            		<td><?php echo $user->zip; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Phone</th>
	            		<td><?php echo $user->phone; ?></td>
	            	</tr> 
	            	<tr>
	            		<th>Birthday</th>
	            		<td><?php echo $user->birthday; ?></td>
	            	</tr> 
	            	<tr>
	            		<th>Employment Start Date</th>
	            		<td><?php echo $user->emp_start_day; ?></td>
	            	</tr> 
	            	<tr>
	            		<th>Employment Type</th>
	            		<td><?php echo $user->emp_type; ?></td>
	            	</tr> 
	            	<tr>
	            		<th>Hourly per Rate</th>
	            		<td><?php echo $user->hourly_pay; ?></td>
	            	</tr> 
	            	<tr>
	            		<th>Hourly Charge Rate</th>
	            		<td><?php echo $user->hourly_charge; ?></td>
	            	</tr> 
	            		
	            </tbody>
            </table>
</section>
<?php require_once('inc/footer.php'); ?>