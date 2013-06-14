<?php

class Customer extends Model {
 
    // Properties
    protected
        $id = 0,
        $table = 'customers';
 
 
    // Accessors
    public function getId () {
        return $this->id;
    }
     
    protected function setId ($id) {
        $this->id = $id;
    }
    
    public function queryPag($page, $result, $company){
    	$index = ($page - 1) * $result;
    	if($user == -1){
	    	$sql = "SELECT * FROM customers LIMIT {$index}, {$result}";	
    	}else{
	    	$sql = "SELECT * FROM customers WHERE id_company = {$company} LIMIT {$index}, {$result}";	
    	}
		
		$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
		return $qtty;    
    }
    
    public function qttyCustomer($company){
    	if($user == -1){
	    	$sql = "SELECT count(*) as qtty FROM customers";
    	}else{
	    	$sql = "SELECT count(*) as qtty FROM customers WHERE id_company = {$company}";	
    	}
		
		$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
		return $qtty;    
    }
    
    public function deleteCustomer($customer_id){
	   $sql = "DELETE FROM customers WHERE id = {$customer_id}";	
	   $data = $this->conn->query($sql);
	   
    }
    
    
}

?>