<?php

class Timesheet extends Model {
 
    // Properties
    protected
        $id = 0,
        $table = 'timesheet';
 
 
    // Accessors
    public function getId () {
        return $this->id;
    }
     
    protected function setId ($id) {
        $this->id = $id;
    }
    
    
}

?>