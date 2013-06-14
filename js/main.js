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
	
	$("#user_mail").on("change", validateEmail);
	
	$("#user_username").on("change", validateUsername);
	
	$("#no_delete").on("click", closeAlert);
	
	$(".dlte").on("click", function(){
		var user_id = $(this).closest('tr').find('.userId').val();
		$("#yes_delete").attr("href", "deleteUser.php?user_id=" + user_id);
		$("#delete_record").show();
	});
	
	$('#start_date').datepicker({format: 'yyyy-mm-dd'});
	
	$('#birthday').datepicker({format: 'yyyy-mm-dd'});
	
	$('#state').on('change', loadCities);
	
	
	
})