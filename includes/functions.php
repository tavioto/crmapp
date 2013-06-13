<?php
	//require_once 'libs/sendgrid/SendGrid_loader.php';
	function __autoload($class_name) {
		$path = CLASS_PATH."/$class_name.class.php";
		//echo "<br>loading: $path  ...";
		if(file_exists($path)){
	    	require_once($path);		
	    	//echo "...Loaded <br>";
		}else{
			echo "Could not load: Class: $class_name. ($path)<br>";
		}
    }
    
	function isPost(){
		if(isset($_POST) && !empty($_POST)){
			return true;
		}
		return false;
	}

	function getParam($name){
		if(isset($_POST[$name]) && $_POST[$name]!=''){
			return addslashes($_POST[$name]);
		}
		if(isset($_GET[$name]) && $_GET[$name]!=''){
			return addslashes($_GET[$name]);
		}
		return false;
	}
	
	function checkHttp($url){
	    if(preg_match('#^http://.*#s', trim($url))){
	    }else{
	    	$url = "http://".$url;
	    }
		return $url;
	}
	
	function RandomPassword()
	{
		$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$stringLength=strlen($string);
		$pass = "";
		$passLength=10;
		
		for($i=1 ; $i<=$passLength ; $i++){
			$pos=rand(0,$stringLength-1);
			$pass .= substr($string,$pos,1);
		}
		return $pass;
	}
	
	/*function forgotPassMail($mail, $pass){
		$sendgrid = new SendGrid('tavioto', 'PHPMaster01'); 
		$mail = new SendGrid\Mail();
		$subject = "Your new password";
		$varMsg = "<p>This message was created automatically</p>";
		$varMsg.= "<label>Your new Password: </label>{$pass}<br><br>";
		$mail->addTo($mail)->setFrom('CRM@CRM.COM')->setSubject($subject)->setText($varMsg)->setHtml($varMsg);
		$sendgrid->smtp->send($mail);
	}
	
	function getUserMail($mail, $user){
	
		$sendgrid = new SendGrid('tavioto', 'PHPMaster01'); 
		$mail = new SendGrid\Mail();
		$subject = "We are remembering your Username";
		$varMsg = "<p>This message was created automatically</p>";
		$varMsg.= "<label>Your Username: </label>{$user}<br><br>";
		$mail->addTo($mail)->setFrom('CRM@CRM.COM')->setSubject($subject)->setText($varMsg)->setHtml($varMsg);
		$sendgrid->smtp->send($mail);
		
	}*/
	
	

?>