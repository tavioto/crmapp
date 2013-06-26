<?php 

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}


require_once('inc/header.php'); 
require_once('inc/topnav.php'); 
$saved = 0;
$company_id = $_SESSION['id_company'];
$result = 10;

$paginacion = new Zebra_Pagination();
$tasks = new Task();

$task = $tasks->queryPag($paginacion->get_page(), $result);
$countTasks = $tasks->qttyTask();

$paginacion->records_per_page($result);
$paginacion->padding(false);
$paginacion->records($countTasks[0]->qtty);

?>
<section id="viewUsers">
	<h1>View Tasks</h1>
	<table class="table table-hover">
	            <thead>
	                <tr>
	            		<th>Title</th>
	                    <th>Project</th>
	                    <th>Estimated Hours</th>
	                    <th>Actions</th>
	                </tr>
	            </thead>
	            <tbody>
	                <?php foreach ($task as $t): 
	                	$project = new Project($t->id_project);
	                	
		                
	                ?>
	                <tr>
	                	<input type="hidden" value="<?php echo $t->id?>" name="taskId" class="taskId" />
                        <td><?php echo $t->title; ?></td>
                        <td><?php echo $project->name; ?></td>
                        <td><?php echo $t->estimated_hours; ?></td>
                        <td><a class="btn btn-primary" href="addTask.php?task_id=<?php echo $t->id;?>"><i class="icon-edit icon-white"></i></a><a class="btn dlteTask" href="#"><i class="icon-remove"></i></a><a class="btn" href="taskDetail.php?task_id=<?php echo $t->id; ?>"><i class="icon-eye-open"></i></a></td>
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