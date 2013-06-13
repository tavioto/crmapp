<?php

class State extends Model {
 
    // Properties
    protected
        $id = 0,
        $table = 'states';
 
 
    // Accessors
    public function getId () {
        return $this->id;
    }
     
    protected function setId ($id) {
        $this->id = $id;
    }
    
    
}

?>