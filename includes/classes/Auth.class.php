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
				if($rows[0]->active == 1){
					session_start();
					$_SESSION['loggedUser'] = 'logged';
					$_SESSION['userName'] = $rows[0]->name;
					$_SESSION['userId'] = $rows[0]->id;
					$_SESSION['id_company'] = $rows[0]->id_company;
					$_SESSION['id_role'] = $rows[0]->id_role;
					return true;
				}else{
					echo "<div class='alert alert-error'>Account is inactive</div>";
					return false;
				}
				
			}
			else
			{
				echo "<div class='alert alert-error'>Username or Password is incorrect</div>";
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


