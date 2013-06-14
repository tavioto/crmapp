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
$customers = new Customer();

$customer = $customers->queryPag($paginacion->get_page(), $result, $company_id);
$countcustomers = $customers->qttyCustomer($company_id);

$paginacion->records_per_page($result);
$paginacion->padding(false);
$paginacion->records($countcustomers[0]->qtty);

?>
<section id="viewcustomers">
	<h1>View customers</h1>
	<table class="table table-hover">
	            <thead>
	                <tr>
	            		<th>Company Name</th>
	                    <th>Company Contact</th>
	                    <th>Email</th>
	                    <th>Website URL</th>
	                    <th>Actions</th>
	                </tr>
	            </thead>
	            <tbody>
	                <?php foreach ($customer as $c): ?>
	                <tr>
	                	<input type="hidden" value="<?php echo $c->id?>" name="customerId" class="customerId" />
	                	<td><?php echo ucwords($c->company_name); ?></td>
                        <td><?php echo $c->company_contact; ?></td>
                        <td><?php echo $c->email; ?></td>
                        <td><?php echo $c->website; ?></td>
                        <td><a class="btn btn-primary" href="addCustomer.php?customer_id=<?php echo $c->id;?>"><i class="icon-edit icon-white"></i></a><a class="btn dlteCust" href="#"><i class="icon-remove"></i></a><a class="btn" href="customerDetails.php?customer_id=<?php echo $c->id; ?>"><i class="icon-eye-open"></i></a></td>
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