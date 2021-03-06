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
$users = new User();

$user = $users->queryPag($paginacion->get_page(), $result, $company_id);
$countUsers = $users->qttyUser($company_id);

$paginacion->records_per_page($result);
$paginacion->padding(false);
$paginacion->records($countUsers[0]->qtty);

?>
<section id="viewUsers">
	<h1>View Users</h1>
	<table class="table table-hover">
	            <thead>
	                <tr>
	            		<th>Role</th>
	                    <th>Name</th>
	                    <th>Username</th>
	                    <th>Mail</th>
	                    <th>Status</th>
	                    <th>Actions</th>
	                </tr>
	            </thead>
	            <tbody>
	                <?php foreach ($user as $u): 
	                	$role = new Role($u->id_role);
	                	
		                if($u->active == 1){
			                $status = "Active";
		                }else{
			                $status = "Inactive";
		                }
	                ?>
	                <tr>
	                	<input type="hidden" value="<?php echo $u->id?>" name="userId" class="userId" />
	                	<td><?php echo ucwords($role->name); ?></td>
                        <td><?php echo $u->first_name." ".$u->last_name; ?></td>
                        <td><?php echo $u->username; ?></td>
                        <td><?php echo $u->mail; ?></td>
                        <td><?php echo $status ?></td>
                        <td><a class="btn btn-primary" href="addUser.php?user_id=<?php echo $u->id;?>"><i class="icon-edit icon-white"></i></a><a class="btn dlte" href="#"><i class="icon-remove"></i></a><a class="btn" href="userDetail.php?user_id=<?php echo $u->id; ?>"><i class="icon-eye-open"></i></a></td>
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