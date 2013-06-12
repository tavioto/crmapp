<?php

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
	
	function forgotPassMail($mail, $pass){
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$cabeceras .= 'From: CRM<CRM@CRM.com>' . "\r\n";
		$asunto = "Your new password";
		$mensaje.= "<p>This message was created automatically</p>";
		$mensaje.= "<label>Your new Password: </label>{$pass}<br><br>";
		mail($mail, $asunto, $mensaje, $cabeceras);
	}
	
	function getUserMail($mail, $user){
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$cabeceras .= 'From: CRM<CRM@CRM.com>' . "\r\n";
		$asunto = "We are remembering your Username";
		$mensaje.= "<p>This message was created automatically</p>";
		$mensaje.= "<label>Your Username: </label>{$user}<br><br>";
		mail($mail, $asunto, $mensaje, $cabeceras);
	}

?>