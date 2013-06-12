<?php

	class Auth{
		
		var $db = NULL;
		
		public function __construct(&$db){
			$this->db = $db;
		}
		
		public function userLogged(){
			session_start();
			if(isset($_SESSION['loggedUser'])){
				return true;
			}
			return false;
		}
		
		public function validUser($data){
			
			$username = $data['username'];			
			$password = md5($data['password']);			
			$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
			$login = $this->db->prepare($sql);
			$login->execute(array($username, $password));
			$rows = $login->fetchAll();
			
			if($rows){
				session_start();
				$_SESSION['loggedUser'] = 'logged';
				$_SESSION['userName'] = $rows[0]->name;
				$_SESSION['userId'] = $rows[0]->id;
					
				return true;
			}
			else
			{
				return false;
			}
			
		}
		
		public function loggedUser(){
			session_start();
			if($_SESSION['loggedUser'] == 'logged'){
				 header('Location: dashboard.php');
			}
		}
		
		public function logoutUser(){
			session_start();
			session_destroy();
			header('location: index.php');
		}
		
	}

?>


