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
    
    public function totalWeek($userId){
	    $sql = "SELECT SUM(time_) as TotalWeek FROM timesheet WHERE id_user = $userId AND date_ BETWEEN DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY) AND DATE_ADD(DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY),INTERVAL 7 DAY)";
	    $data = $this->conn->query($sql);
	    $qtty = $data->fetchAll();
	    return $qtty;
    }
    
    public function totalMonth($month, $userId){
	    $sql = "SELECT SUM(time_) as TotalMonth FROM timesheet WHERE MONTH(date_) = $month AND id_user = $userId";
	    $data = $this->conn->query($sql);
	    $qtty = $data->fetchAll();
	    return $qtty;
    }
    
    
}

?>