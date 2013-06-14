<?php

class City extends Model {
 
    // Properties
    protected
        $id = 0,
        $table = 'city';
 
 
    // Accessors
    public function getId () {
        return $this->id;
    }
     
    protected function setId ($id) {
        $this->id = $id;
    }
    
    
}

?>