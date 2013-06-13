<?php 

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}


require_once('inc/header.php'); 
require_once('inc/topnav.php'); 
$saved = 0;

$user_model = new User();
$user = $user_model->fetchAll(array(array('id_company', '=', $_SESSION['id_company'])));


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
	                	<td><?php echo ucwords($role->name); ?></td>
                        <td><?php echo $u->first_name." ".$u->last_name; ?></td>
                        <td><?php echo $u->username; ?></td>
                        <td><?php echo $u->mail; ?></td>
                        <td><?php echo $status ?></td>
                        <td><div class="btn-group">
      <a href="#" class="btn btn-inverse disabled"><i class="icon-white icon-thumbs-up"></i></a>
      <a href="#" class="btn btn-inverse disabled"><i class="icon-white icon-heart"></i></a>
      <a href="#" class="btn btn-inverse disabled"><i class="icon-white icon-share-alt"></i></a>
  </div></td>
	                </tr>
	                <?php endforeach ?>
	            </tbody>
            </table>
	
</section>
<?php require_once('inc/footer.php'); ?>