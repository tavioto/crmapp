<?php 

require_once("includes/includes.php");
if(!$auth->userLogged()){
	header('location: index.php');
}

require_once('inc/header.php'); 
require_once('inc/topnav.php'); 

$user_id = $_SESSION['userId'];
$timesheet_model = new Timesheet();
$totalWeek = $timesheet_model->totalWeek($user_id);
$currentMonth = date('m');
$totalMonth = $timesheet_model->totalMonth($currentMonth, $user_id);
//print_r($totalMonth);die;
?>
<section id="viewcustomers">
<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>" />
	<h1>View Timesheets</h1>
	<div id="totalHours">
		<label class="perweek"><h4>Total Hours per Week: <?php echo $totalWeek[0]->TotalWeek; ?></h4></label>
		<label class="permonth" style="display:none"> <h4>Total Hours per Month: <?php echo $totalMonth[0]->TotalMonth; ?></h4></label>
	</div>
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
			
			$('.fc-button-month').on('click', function(){
				$('.perweek').hide();
				$('.permonth').show();
			});
			
			$('.fc-button-basicWeek').on('click', function(){
				$('.perweek').show();
				$('.permonth').hide();
			});
			
			$('.fc-button-basicDay').on('click', function(){
				$('.perweek').hide();
				$('.permonth').hide();
			});
		});
		
			

	});
</script>


</section>
<?php require_once('inc/footer.php'); ?>