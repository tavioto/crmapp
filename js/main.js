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
	
	$("#user_mail").on("change", validateEmail);
	
	$("#user_username").on("change", validateUsername);
	
	$("#no_delete").on("click", closeAlert);
	
	$(".dlte").on("click", function(){
		var lead_id = $(this).closest('tr').find('.leadId').val();
		
		$("#yes_delete").attr("href", "deleteLead.php?lead_id=" + lead_id);
		$("#delete_record").show();
	});
	
	$('#next_call').datepicker({format: 'yyyy-mm-dd'});
	
	
})