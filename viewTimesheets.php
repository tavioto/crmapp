<?php 

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

require_once('inc/header.php'); 
require_once('inc/topnav.php'); 

$user_id = $_SESSION['userId'];
?>
<section id="viewcustomers">
<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>" />
	<h1>View Timesheets</h1>
	
	<div id="calendar"></div>
<script>
	$(document).ready(function() {
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		var user_id = $('#user_id').val();
		
		$.ajax({
			url: 'ajaxbackend.php?function=LoadTimesheet',
			dataType: 'jsonp',
			data:{
				user_id: user_id
			}
		}).done(function(data){
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,basicWeek,basicDay'
				},
				defaultView: 'basicWeek',
				editable: true,
				events: data
			});
		});
	});
</script>

</section>
<?php require_once('inc/footer.php'); ?>