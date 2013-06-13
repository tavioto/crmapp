<?php
	require_once 'libs/sendgrid/SendGrid_loader.php';
	
	function email_user_register($email_e, $user_name_e, $password_e, $name_e){
		
		$sendgrid = new SendGrid('tavioto', 'PHPMaster01'); 
		$mail = new SendGrid\Mail();
		$subject = "Test"; 
		$varMsg = "Test";
		$mail->addTo('jarg5487@gmail.com')->setFrom('CRM@CRM.com')->setSubject($subject)->setText($varMsg)->setHtml($varMsg);
		$sendgrid->smtp->send($mail);
		
		
	}
	
	function forgotPassMail($email, $pass){
		$sendgrid = new SendGrid('tavioto', 'PHPMaster01'); 
		$mail = new SendGrid\Mail();
		$subject = "Your new password";
		$varMsg = "<p>This message was created automatically</p>";
		$varMsg.= "<label>Your new Password: </label>{$pass}<br><br>";
		$mail->addTo($email)->setFrom('CRM@CRM.COM')->setSubject($subject)->setText($varMsg)->setHtml($varMsg);
		$sendgrid->smtp->send($mail);
	}
	
	function getUserMail($email, $user){
		
		$sendgrid = new SendGrid('tavioto', 'PHPMaster01'); 
		$mail = new SendGrid\Mail();
		$subject = "We are remembering your Username";
		$varMsg = "<p>This message was created automatically</p>";
		$varMsg.= "<label>Your Username: </label>{$user}<br><br>";
		$mail->addTo($email)->setFrom('CRM@CRM.COM')->setSubject($subject)->setText($varMsg)->setHtml($varMsg);
		$sendgrid->smtp->send($mail);
		
	}
	
?>