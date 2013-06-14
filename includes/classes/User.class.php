<?php

class User extends Model {
 
    // Properties
    protected
        $id = 0,
        $table = 'users';
 
 
    // Accessors
    public function getId () {
        return $this->id;
    }
     
    protected function setId ($id) {
        $this->id = $id;
    }
    
    public function forgotPassword($mail){
    	$pass = RandomPassword();
    	$password = md5($pass);
	   	$sql = "UPDATE users SET password = ? WHERE mail = ?";
	   	$stmt = $this->conn->prepare($sql);
	   	$stmt->execute(array($password, $mail));
	   	return $pass;
    }
    
    public function getUsername($mail){
	    $sql = "SELECT username FROM users WHERE mail = '{$mail}'";
	   	$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
    	return $qtty[0]->username;
	   	
    }
    
    public function queryPag($page, $result, $company){
    	$index = ($page - 1) * $result;
    	if($user == -1){
	    	$sql = "SELECT * FROM users LIMIT {$index}, {$result}";	
    	}else{
	    	$sql = "SELECT * FROM users WHERE id_company = {$company} LIMIT {$index}, {$result}";	
    	}
		
		$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
		return $qtty;    
    }
    
    public function qttyUser($company){
    	if($user == -1){
	    	$sql = "SELECT count(*) as qtty FROM users";
    	}else{
	    	$sql = "SELECT count(*) as qtty FROM users WHERE id_company = {$company}";	
    	}
		
		$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
		return $qtty;    
    }
    
    public function deleteUser($user_id){
	   $sql = "DELETE FROM users WHERE id = {$user_id}";	
	   $data = $this->conn->query($sql);
	   
    }
 
     
 
}

?>