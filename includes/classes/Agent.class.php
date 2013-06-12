<?php

// http://www.profilepicture.co.uk/php-mvc-model-class/

/**
 * User - Administrator/Moderator/Member
 *
 * @author Phil Parsons
 */
class Agent extends Model {
 
    // Properties
    protected
        $id = 0,
        $table = 'Agent';
 
    protected $primaryCounties = NULL;
    protected $defaultCounties = NULL;

    protected $has = array(
    						'AgentCounties' => 	array(
    												'local_key' => 'AgentId',
    												'remote_key'=> 'AgentID'
    											),
    						/*
'State'	=> array(
    										'local_key' => 'StateId',
    										'remote_key'=> 'State'
    									),
*/
    						'CancellationQueue'	=> array(
    												'query' => array(
    																array(
    																	'local_key'=>'Type',
    																	'operator'=>'=',
    																	'value'=>'Agent'
    																),
    																array(
    																	'local_key'=>'id',
    																	'operator'=>'=',
    																	'remote_key'=>'AgentID'
    																)
    															)
    											)
    					);


    // Accessors
    public function inactiveToActive($agentId){
		$cancelRequest = "NULL";
		$cancellationDate = "NULL";
		$sql = "UPDATE AgentCity SET CancellationDate = ?, CancellationRequest = ? WHERE AgentId = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array($cancellationDate, $cancelRequest, $agentId));
	}
	
	public function getId () {
        return $this->AgentID;
    }
     
    protected function setId ($id) {
        $this->AgentID = $id;
    }

    public function load ($where = array()) {
    	parent::load($where);  // load the parent class' load
    	
    	// load code for this specific model
    	
    	$this->loadPrimaryCounties();
    	$this->loadDefaultCounties();
    	
    } 
    
    public function CreditCard($num){
	    $sql = "SELECT *, RIGHT(CardNumber, 4) CN FROM Agent WHERE RIGHT(CardNumber, 4) = '$num'";
	    $data = $this->conn->query($sql);
	    
	    return $data->fetchAll();
    }
  
    protected function loadPrimaryCounties(){
    	if($this->primaryCounties==NULL){
	    	$sql = "SELECT CountyId FROM AgentCity WHERE AgentId = ? AND isPrimary = 1";
	        $stmt = $this->conn->prepare($sql);
	        $stmt->execute(array($this->getId()));
	        
	        $counties = $stmt->fetchAll();
	        $this->primaryCounties = array();
	        foreach($counties as $c){
			    $this->primaryCounties[] = $c->CountyId;   
	        }	        
    	}
    }
    
    protected function loadDefaultCounties(){
    	if($this->defaultCounties==NULL){
	    	$sql = "SELECT CountyId FROM AgentCity WHERE AgentId = ? AND isPrimary = 0";
	        $stmt = $this->conn->prepare($sql);
	        $stmt->execute(array($this->getId()));
	        
	        $counties = $stmt->fetchAll();
	        $this->defaultCounties = array();
	        foreach($counties as $c){
			    $this->defaultCounties[] = $c->CountyId;
		        
	        }
    	}
    }
    
	public function save() {
		parent::save();  // load the parent class' save
		
		// save code for this specific model
		
		//$this->savePrimaryCounties();
		//$this->saveDefaultCounties();
		
		
	}

	protected function savePrimaryCounties(){
		if(empty($this->primaryCounties)){
			$this->deletePrimaryCounties();
		}else{
			$counties = implode(',', $this->primaryCounties);
			$this->conn->query("DELETE FROM AgentCity WHERE AgentId = {$this->getId()} AND Isprimary = 1");
						
			foreach($this->primaryCounties as $countyId){
		        $this->saveCounty($countyId, 1);
			}
		}
	}

	protected function saveDefaultCounties(){
		if(empty($this->defaultCounties)){
			$this->deleteDefaultCounties();
		}else{
			$counties = implode(',', $this->defaultCounties);
			$this->conn->query("DELETE FROM AgentCity WHERE AgentId = ".$this->getId()." AND Isprimary = 0");

			foreach($this->defaultCounties as $countyId){
		        $this->saveCounty($countyId, 0);
			}
			
		}
	}

	protected function saveCounty($countyId, $isPrimary){
			$noPrimary = 0;
			$agentCountyObj = new AgentCounties();
			$totalCounties = $agentCountyObj->fetchAll(array( 
															array('AgentId','=', $this->getId()), 
															array('CountyId','=', $countyId), 
															array('Isprimary', '=', $isPrimary) 
														)
												);
			if($isPrimary == 0){
				$existCounties = $agentCountyObj->fetchAll(array(
															array('CountyId', '=', $countyId),
															array('Isprimary', '=', $noPrimary)
														 )
												);
				if(count($existCounties)>0){
					$this->conn->query("DELETE FROM AgentCity WHERE CountyId = {$countyId} AND Isprimary = 0");
				}
			}
			//echo count($totalCounties);die;
			//mail('octavio.herrera@gmail.com','totalCounties', print_r($totalCounties, true));
			//if(count($totalCounties)==0){
				$sql = "INSERT INTO AgentCity (AgentId, CountyId, Isprimary, CreatedOn) VALUES (?, ?, ?, ?)";
				$stmt = $this->conn->prepare($sql);
				$stmt->execute(array($this->getId(), $countyId, $isPrimary, date('Y-m-d H:i:s')));
			//	mail('octavio.herrera@gmail.com','saveCounty', $sql.print_r($totalCounties, true));
			//}
		}

	protected function deletePrimaryCounties(){
    	$sql = "DELETE FROM AgentCity WHERE AgentId = ? AND Isprimary = 1";
        $stmt = $this->conn->prepare($sql);
		$stmt->execute(array($this->getId()));
		$stmt->closeCursor();
	}

	protected function deleteDefaultCounties(){
    	$sql = "DELETE FROM AgentCity WHERE AgentId = ? AND Isprimary = 0";
        $stmt = $this->conn->prepare($sql);
		$stmt->execute(array($this->getId()));
		$stmt->closeCursor();
	}

	public function getLeadSummary(){
		$sql = "
				SELECT
					Color,
					CountyId,
					Name,
					CASE (AC.IsPrimary) when 1 then 'Primary' when 0 then 'Default' end as Position,
					CreatedOn,
					(
						SELECT
							count(*)
						FROM 
							LeadsAgentsEmployees LAE
						WHERE 
							agent_id = ?
						AND lead_county_id = CountyId
						AND
							TIMESTAMPDIFF(DAY, lead_create_date ,CURDATE())<= 30
							
					) as LeadCount
				FROM
					AgentCounties AC
				WHERE
					AgentId = ?
";
		/*
$sql = "
				
						SELECT
							count(*) leadcount
						FROM 
							LeadsAgentsEmployees LAE
						WHERE 
							agent_id = ?
						AND
							TIMESTAMPDIFF(DAY, lead_create_date ,CURDATE())<= 30;
				";
*/
		//$span = $this->getCurrentTimeSpan();
		$end_date = dateAdd(date('Y-m-d'), '+1 day');
		$start_date = dateAdd($end_date, '-1 month');
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array($this->getId(), $this->getId()));
		$leadSummary = $stmt->fetchAll();
		return $leadSummary;
	}
	
	
  
	public function getCurrentTimeSpan(){
		$day_of_month = date('d', strtotime($this->CreatedOn));
		$current_day = date('d');
		$current_month = date('m');
		$current_year = date('Y');
		
		if($day_of_month>$current_day){
			$end_date   = date('Y-m-d', mktime(0, 0, 0, $current_month, $day_of_month, $current_year));
		}else{
			$end_date   = date('Y-m-d', mktime(0,0,0,$current_month+1,$day_of_month,$current_year));
		}
		$start_date = dateAdd($end_date, '-1 month');
		
		return array($start_date, $end_date);
	}
	
	public function cancelCounty($countyId){
		$cancelRequest = date("Y-m-d H:i:s");
		//T
		$span = $this->getCurrentTimeSpan();
		$cancellationDate = $span[1];
		$sql = "UPDATE AgentCity SET CancellationDate = ?, CancellationRequest = ? WHERE AgentId = ? AND CountyId = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array($cancellationDate, $cancelRequest, $this->getId(), $countyId));
	}
	
	public function renewCounty($countyId){
		$cancelRequest = "NULL";
		$cancellationDate = "NULL";
		$sql = "UPDATE AgentCity SET CancellationDate = ?, CancellationRequest = ? WHERE AgentId = ? AND CountyId = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array($cancellationDate, $cancelRequest, $this->getId(), $countyId));
	}
	
	public function editCancellationDate($countyId, $date){
		$cancelRequest = date("Y-m-d H:i:s");
		$sql = "UPDATE AgentCity SET CancellationDate = ?, CancellationRequest = ? WHERE AgentId = ? AND CountyId = ?";
		$stmt = $this->conn->prepare($sql);
        $stmt->execute(array($date, $cancelRequest, $this->getId(), $countyId));
	}
	
	public function cancellAllCounties($personId){
		$cancelRequest = date("Y-m-d H:i:s");
		$date = date("Y-m-d H:i:s");
		
		$sqlCounties = "UPDATE AgentCity SET CancellationDate = ?, CancellationRequest = ? WHERE AgentId = ?";
		$stmt = $this->conn->prepare($sqlCounties);
		$stmt->execute(array($date, $cancelRequest, $personId));
		
		$status = "Inactive";
		$sqlPerson = "UPDATE Agent SET AccountStatus = ? WHERE AgentID = ?";
		$stmt = $this->conn->prepare($sqlPerson);
		$stmt->execute(array($status, $personId));
		
	}
	
	public function activeAgent(){
		$sql = "SELECT count(*) qtty FROM Agent WHERE AccountStatus = 'Paid'";
		$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
    	return $qtty[0]->qtty;
	}
	
	public function inactiveAgent(){
		$sql = "SELECT count(*) qtty FROM Agent WHERE AccountStatus = 'Inactive'";
		$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
    	return $qtty[0]->qtty;
	}
	
	public function rejectedAgent(){
		$sql = "SELECT count(*) qtty FROM Agent WHERE AccountStatus = 'Rejected'";
		$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
    	return $qtty[0]->qtty;
	}
	
	public function RBActiveAgent(){
		$sql = "SELECT SUM(RecurringBilling) qtty FROM Agent WHERE AccountStatus = 'Paid'";
		$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
    	return $qtty[0]->qtty;
	}
	
	public function RBInactiveAgent(){
		$sql = "SELECT SUM(RecurringBilling) qtty FROM Agent WHERE AccountStatus = 'Inactive'";
		$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
    	return $qtty[0]->qtty;
	}
	
	public function RBRejectedAgent(){
		$sql = "SELECT SUM(RecurringBilling) qtty FROM Agent WHERE AccountStatus = 'Rejected'";
		$data = $this->conn->query($sql);
    	$qtty = $data->fetchAll();
    	return $qtty[0]->qtty;
	}
	
	public function agentCountiesOperation($agentId, $operation, $countyId, $countyType){
		$date = date("Y-m-d H:i:s");
		$cType = $countyType == 'primary' ? 1 : 0;
		if($operation == 'add'){
			$sql = "INSERT INTO AgentCity (AgentId, CountyId, Isprimary, CreatedOn) VALUES (?, ?, ?, ?)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(array($agentId, $countyId, $cType, $date));
		}elseif($operation == 'delete'){
			$sql = "DELETE FROM AgentCity WHERE AgentId = ? AND CountyId = ? AND Isprimary = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(array($agentId, $countyId, $cType));
		}
	}
	
	public function updateCountyDate($agentId, $date){
		$sql = "UPDATE AgentCity SET CreatedOn = ? WHERE AgentId = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array($date, $agentId));
	}

	
}
?>