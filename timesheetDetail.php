<?php 

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

require_once('inc/header.php'); 
require_once('inc/topnav.php'); 

extract($_REQUEST);
$timeSheet = new Timesheet($timesheet_id);
$customer = new Customer($timeSheet->id_customer);
$project = new Project($timeSheet->id_project);

if($timeSheet->billable == 1){
	$billable = "Yes";
}else{
	$billable = "No";
}
?>
<section id="userDetail">
	<h1>Timesheet Detail</h1>
	
          	<table class="table table-hover table-bordered">
	            <tbody>
	            	<tr>
	            		<th>Customer</th>
	            		<td><?php echo $customer->company_name; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Project</th>
	            		<td><?php echo $project->name?></td>
	            	</tr>
	            	<tr>
	            		<th>Date</th>
	            		<td><?php echo $timeSheet->date_; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Amount Hours</th>
	            		<td><?php echo $timeSheet->time_; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Billable</th>
	            		<td><?php echo $billable; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Description</th>
	            		<td><?php echo $timeSheet->description; ?></td>
	            	</tr>	            		
	            </tbody>
            </table>
</section>
<?php require_once('inc/footer.php'); ?>