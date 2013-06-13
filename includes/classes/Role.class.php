<?php

class Role extends Model {
 
    // Properties
    protected
        $id = 0,
        $table = 'roles';
 
 
    // Accessors
    public function getId () {
        return $this->id;
    }
     
    protected function setId ($id) {
        $this->id = $id;
    }
    
    
}

?>