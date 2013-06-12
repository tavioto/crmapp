<?php

class User extends Model {
 
    // Properties
    protected
        $id = 0,
        $table = 'users';
 
 
    // Accessors
    public function getId () {
        return $this->id;
    }
     
    protected function setId ($id) {
        $this->id = $id;
    }
 
     
 
}

?>