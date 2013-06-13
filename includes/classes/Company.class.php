<?php

class Company extends Model {
 
    // Properties
    protected
        $id = 0,
        $table = 'companies';
 
 
    // Accessors
    public function getId () {
        return $this->id;
    }
     
    protected function setId ($id) {
        $this->id = $id;
    }
}

?>