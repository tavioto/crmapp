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
    
    
}

?>