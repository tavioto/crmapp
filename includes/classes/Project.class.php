<?php

class Project extends Model {
 
    // Properties
    protected
        $id = 0,
        $table = 'projects';
 
 
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
	    	$sql = "SELECT * FROM projects LIMIT {$index}, {$result}";	
    	}else{
	    	$sql = "SELECT * FROM projects WHERE id_company = {$company} LIMIT {$index}, {$result}";	
    	}
		
		$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
		return $qtty;    
    }
    
    public function qttyProject($company){
    	if($user == -1){
	    	$sql = "SELECT count(*) as qtty FROM projects";
    	}else{
	    	$sql = "SELECT count(*) as qtty FROM projects WHERE id_company = {$company}";	
    	}
		
		$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
		return $qtty;    
    }
    
    public function deleteProject($project_id){
	   $sql = "DELETE FROM projects WHERE id = {$project_id}";	
	   $data = $this->conn->query($sql);
	   
	   $sql = "DELETE FROM projects_employees WHERE id_project = {$project_id}";	
	   $data = $this->conn->query($sql);
	   
	   $sql = "DELETE FROM projects_documents WHERE id_project = {$project_id}";	
	   $data = $this->conn->query($sql);
	   
    }
}

?>