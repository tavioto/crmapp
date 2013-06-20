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
    
    
}

?>