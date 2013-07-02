<?php 

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

require_once('inc/header.php'); 
require_once('inc/topnav.php'); 

extract($_REQUEST);
$project = new Project($project_id);

$pro_emp = new ProjectEmployee();
$emp = $pro_emp->fetchAll(array(array('id_project', '=', $project_id)));
$qttyEmp = count($emp);

$pro_doc = new ProjectDocuments();
$docs = $pro_doc->fetchAll(array(array('id_project', '=', $project_id)));
$qttyDocs = count($docs);
?>
<section id="userDetail">
	<h1>Project Detail</h1>
	<legend><?php echo $project->name; ?></legend>
          	<table class="table table-hover table-bordered">
	            <tbody>
	            	<tr>
	            		<th>Project Name</th>
	            		<td><?php echo $project->name; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Description</th>
	            		<td><?php echo $project->description; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Status</th>
	            		<td><?php echo $project->status; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Start Date</th>
	            		<td><?php echo $project->start_date; ?></td>
	            	</tr>
	            	<tr>
	            		<th>End Date</th>
	            		<td><?php echo $project->end_date; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Type</th>
	            		<td><?php echo $project->type; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Contact Name</th>
	            		<td><?php echo $project->contact; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Phone</th>
	            		<td><?php echo $project->phone; ?></td>
	            	</tr> 
	            	<tr>
	            		<th>Address</th>
	            		<td><?php echo $project->address; ?></td>
	            	</tr>
	            	<tr>
	            		<th>Email</th>
	            		<td><?php echo $project->email; ?></td>
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
		            <?php if($qttyDocs > 0){?>
		            <tr>
	            		<th rowspan="<?php echo $qttyDocs; ?>">Documents</th>
	            		<?php
		            		$i=0;
		            		foreach($docs as $d){
			            		$i++;
			            	?>
			            		<td><?php echo $i.". ";?><a href="/uploads/<?php echo $d->docname?>"><?php echo $d->docname; ?></a></td></tr><tr>
		            	<?php } ?>
		            </tr>
	            	<?php } ?>
	            </tbody>
            </table>
</section>
<?php require_once('inc/footer.php'); ?>