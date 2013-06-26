<?php

class TaskEmployee extends Model {
 
    // Properties
    protected
        $id = 0,
        $table = 'tasks_employees';
 
 
    // Accessors
    public function getId () {
        return $this->id;
    }
     
    protected function setId ($id) {
        $this->id = $id;
    }
    
    public function deleteTasks($task_id){
	 $sql = "DELETE FROM tasks_employees WHERE id_task = {$task_id}";	
	   $data = $this->conn->query($sql);   
    }
    
    
}

?>