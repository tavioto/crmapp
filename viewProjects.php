<?php 

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}


require_once('inc/header.php'); 
require_once('inc/topnav.php'); 
$saved = 0;
$result = 10;
$company_id = $_SESSION['id_company'];
$paginacion = new Zebra_Pagination();
$projects = new Project();

$project = $projects->queryPag($paginacion->get_page(), $result, $company_id);
$countprojects = $projects->qttyProject($company_id);

$paginacion->records_per_page($result);
$paginacion->padding(false);
$paginacion->records($countprojects[0]->qtty);

?>
<section id="viewcustomers">
	<h1>View Projects</h1>
	<table class="table table-hover">
	            <thead>
	                <tr>
	            		<th>Project Name</th>
	                    <th>Start Date</th>
	                    <th>End Date</th>
	                    <th>Contact Name</th>
	                    <th>Email</th>
	                    <th>Actions</th>
	                </tr>
	            </thead>
	            <tbody>
	                <?php foreach ($project as $p): ?>
	                <tr>
	                	<input type="hidden" value="<?php echo $p->id?>" name="projectId" class="projectId" />
	                	<td><?php echo ucwords($p->name); ?></td>
                        <td><?php echo $p->start_date; ?></td>
                        <td><?php echo $p->end_date; ?></td>
                        <td><?php echo $p->contact; ?></td>
                        <td><?php echo $p->email; ?></td>
                        <td><a class="btn btn-primary" href="addProject.php?project_id=<?php echo $p->id;?>"><i class="icon-edit icon-white"></i></a><a class="btn dltePro" href="#"><i class="icon-remove"></i></a><a class="btn" href="projectDetails.php?project_id=<?php echo $p->id; ?>"><i class="icon-eye-open"></i></a></td>
	                </tr>
	                <?php endforeach ?>
	            </tbody>
            </table>
			<?php $paginacion->render(); ?>
			<div class="alert alert-block alert-error fade in" id="delete_record">
				<h4 class="alert-heading">You will delete this record !!</h4>
				<p>Are you sure to delete this record?</p>
				<p>
					<a class="btn btn-danger" id="yes_delete" href="#">Yes</a> <a class="btn" id="no_delete" href="#">No</a>
				</p>
			</div>
</section>
<?php require_once('inc/footer.php'); ?>