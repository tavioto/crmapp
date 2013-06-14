<?php 

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

require_once('inc/header.php'); 
require_once('inc/topnav.php'); 

extract($_REQUEST);
$customer = new Customer($customer_id);

$state = new State($customer->state_id);
$city = new City($customer->city_id);
?>
<section id="userDetail">
	<h1>Customer Detail</h1>
	<legend><?php echo $customer->company_name; ?></legend>
          	<table class="table table-hover table-bordered">
	            <tbody>
	            	<tr>
	            		<th>Company Name</th>
	            		<td><?php echo $customer->company_name; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Company Contact</th>
	            		<td><?php echo $customer->company_contact; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Phone</th>
	            		<td><?php echo $customer->phone; ?></td>
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
	            		<td><?php echo $customer->address; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Zipcode</th>
	            		<td><?php echo $customer->zip; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Email</th>
	            		<td><?php echo $customer->email; ?></td>
	            	</tr> 
	            	<tr>
	            		<th>Website URL</th>
	            		<td><?php echo $customer->website; ?></td>
	            	</tr>
	            		
	            </tbody>
            </table>
</section>
<?php require_once('inc/footer.php'); ?>