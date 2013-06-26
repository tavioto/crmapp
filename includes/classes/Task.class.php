<?php

class Task extends Model {
 
    // Properties
    protected
        $id = 0,
        $table = 'tasks';
 
 
    // Accessors
    public function getId () {
        return $this->id;
    }
     
    protected function setId ($id) {
        $this->id = $id;
    }
    
    public function queryPag($page, $result){
    	$index = ($page - 1) * $result;
	    $sql = "SELECT * FROM tasks LIMIT {$index}, {$result}";	
    	
		$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
		return $qtty;    
    }
    
    public function qttyTask(){
    	$sql = "SELECT count(*) as qtty FROM tasks";
    	
    	$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
		return $qtty;    
    }
    
    public function deleteTask($task_id){
	 	$sql = "DELETE FROM tasks_employees WHERE id_task = {$task_id}";	
	 	$data = $this->conn->query($sql);   
	 	
	 	$sql = "DELETE FROM tasks WHERE id = {$task_id}";	
	 	$data = $this->conn->query($sql);   
    }
    
    
}

?>