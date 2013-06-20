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
    
    
}

?>