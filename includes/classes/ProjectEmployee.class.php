<?php

class ProjectEmployee extends Model {
 
    // Properties
    protected
        $id = 0,
        $table = 'projects_employees';
 
 
    // Accessors
    public function getId () {
        return $this->id;
    }
     
    protected function setId ($id) {
        $this->id = $id;
    }
    
    public function deleteEmployees($project_id){
	 $sql = "DELETE FROM projects_employees WHERE id_project = {$project_id}";	
	   $data = $this->conn->query($sql);   
    }
    
    
}

?>