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

?>