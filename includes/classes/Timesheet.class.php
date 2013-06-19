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
    
    public function HoursDay($userId, $date){
	 	$sql = "SELECT SUM(time_) as TotalHours FROM timesheet WHERE id_user = $userId AND date_ = '$date'";
	 	$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
		return $qtty;    
    }
    
    
}

?>