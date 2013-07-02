<?php

class ProjectDocuments extends Model {
 
    // Properties
    protected
        $id = 0,
        $table = 'projects_documents';
 
 
    // Accessors
    public function getId () {
        return $this->id;
    }
     
    protected function setId ($id) {
        $this->id = $id;
    }
}

?>