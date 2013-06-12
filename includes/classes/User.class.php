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
 
     
 
}

?>