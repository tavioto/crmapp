$(document).ready(function(){
	
	function validateEmail(){
		var email = $("#user_mail").val();
		$.ajax({
			url: 'ajaxBackEnd.php?function=validateEmail',
			dataType: 'jsonp',
			data:{email : email}
			
		}).done(function(data){
			if(data == 1){
				$("#user_save").attr("disabled", "disabled");
				$(".email-error").show();
			}else{
				$("#user_save").removeAttr("disabled");
				$(".email-error").hide();
			}
		})
	}
	
	function validateUsername(){
		var username = $("#user_username").val();
		$.ajax({
			url: 'ajaxBackEnd.php?function=validateUsername',
			dataType: 'jsonp',
			data:{username : username}
			
		}).done(function(data){
			if(data == 1){
				$("#user_save").attr("disabled", "disabled");
				$(".username-error").show();
			}else{
				$("#user_save").removeAttr("disabled");
				$(".username-error").hide();
			}
		})
	}
	
	function closeAlert(){
		$("#delete_record").hide();
	}
	
	function showAlertDelete(){
		$("#delete_record").show();
	}
	
	function loadCities(){
		var stateId = $('#state').val();
	   	$.ajax({
			url: 'ajaxbackend.php?function=LoadCities',
			dataType: 'jsonp',
			data:{
				stateId: stateId
			}
		}).done(function(data){
			var i;
			var html = '';
			for(i = 0; i < data.length; i++){
				html += "<option value='"+data[i].id+"'>"+data[i].name+"</option>"
			}
			$('#city').html(html);
		});
	}
	
	function loadProjects(){
		var customerId = $('#customerId').val();
	   	$.ajax({
			url: 'ajaxbackend.php?function=LoadProjects',
			dataType: 'jsonp',
			data:{
				customerId: customerId
			}
		}).done(function(data){
			var i;
			var html = '';
			html+= "<option value=''>--Project--</option>";
			for(i = 0; i < data.length; i++){
				html += "<option value='"+data[i].id+"'>"+data[i].name+"</option>"
			}
			$('#projectId').html(html);
		});
	}
	
	$("#user_mail").on("change", validateEmail);
	
	$("#user_username").on("change", validateUsername);
	
	$("#no_delete").on("click", closeAlert);
	
	$(".dlte").on("click", function(){
		var user_id = $(this).closest('tr').find('.userId').val();
		$("#yes_delete").attr("href", "deleteUser.php?user_id=" + user_id);
		$("#delete_record").show();
	});
	
	$(".dlteCust").on("click", function(){
		var customer_id = $(this).closest('tr').find('.customerId').val();
		$("#yes_delete").attr("href", "deleteCustomer.php?customer_id=" + customer_id);
		$("#delete_record").show();
	});
	
	$(".dltePro").on("click", function(){
		var project_id = $(this).closest('tr').find('.projectId').val();
		$("#yes_delete").attr("href", "deleteProject.php?project_id=" + project_id);
		$("#delete_record").show();
	});
	
	$('#start_date').datepicker({format: 'yyyy-mm-dd'});
	
	$('#end_date').datepicker({format: 'yyyy-mm-dd'});
	
	$('#birthday').datepicker({format: 'yyyy-mm-dd'});
	
	$('#state').on('change', loadCities);
	
	$('#customerId').on('change', loadProjects);
	
	$('#time').on('change', function(){
		var hour = $('#time').val();
		if(hour < 1 ){
			aler("Please insert a int value");
		}
	});
	
	$('#time').validCampoFranz('0123456789.'); 
	
	
	
	
	
})