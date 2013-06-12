<?php

// http://www.profilepicture.co.uk/php-mvc-model-class/

abstract class Model {
    protected
        $conn,
        $bindArray = array(),
        $pk,
        $table,
        $validConjunctions = array('AND', 'OR');

    protected $has = NULL;
     
    public function __construct ($id = 0) {

    	global $db;
        $this->conn = $db;
        if($this->table!=NULL)
	        $this->createBindArray();
	        
        if ($id > 0) {
            $primary = $this->pk;
            $this->$primary = $id;
            $this->load();
        }
    }
     
    //must have id controls
    abstract public function getId();
    abstract protected function setId($id);
 
    // General Accessors
    public function get ($field) {
        return $this->$field;
    }
 
    public function __get($name){
        if (isset($this->$name)) {
            return $this->$name;
        }
        return null;
    }

    public function __set($name, $value){
    	if(!in_array($name, array('conn', 'bindArray', 'pk','table'))){
	        $this->$name = $value;	    	
    	}
    }
    
    public function set ($field, $val) {
        if ($field == $this->pk) // don't allow setting of ID from outside
            throw new Exception('Invalid request to set ID on ' . $field . ' in Model (' . $this->table . ')');
        if ($field == "password")
            $val = crypt($val, AUTH_KEY);
        $this->$field = $val;
    }
 
    protected function createBindArray () {
        if (!count($this->bindArray)) {
            
			$cols = $this->conn->query("SHOW COLUMNS FROM {$this->table}");  
			$results = $cols->fetchAll();
            foreach($results as $row) {
                if ($row->Key == 'PRI') $this->pk = $row->Field;
                if (strpos($row->Type, 'text') !== false || strpos($row->Type, 'varchar') !== false )
                    $paramType = 's';
                elseif (strpos($row->Type, 'int') !== false )
                    $paramType = 'i';
                elseif (strpos($row->Type, 'date') !== false )
                    $paramType = 's';
                $this->bindArray[$row->Field] = $paramType;
            }
        }
        //echo "Model::createBindArray()<br>";
    }
    
    public function load($where = array()) {
	    
	    $where = $this->transformWhereParams($where);
	    
	    $fields = '';
	    $results = array();
	    $resultParams = array();
	    $whereParams = array();
	    $wp = array(); // temp var to deal with pass by reference issue in call_user_func_arrray
	    $keys = array_keys($this->bindArray);
	    for ($i = 0; $i < count($keys); $i++) {
	        $fields .= $keys[$i];
	        if ($i + 1 < count($keys)) {
	            $fields .= ',';
	        }
	        $fields .= ' ';
	        $resultParams[] = &$results[$keys[$i]];
	    }
	    $whereClause = $this->buildWhereClause($where, '', $whereParams);
	    $sql = 'SELECT ' . $fields . 'FROM ' . $this->table . $whereClause;
	    
	    $stmt = $this->conn->prepare($sql);
	    if ($stmt) {
	        @call_user_func_array(array($stmt, 'bindParam'), $wp);
	        $stmt->execute($whereParams);
	        $result = $stmt->fetch();
	        foreach ($result as $key=>$value) {
	            $this->$key = $value;
	        }
	        $stmt->closeCursor();
	        
	        // Process Relationships with other Models:
	        if($this->has){
		    	foreach($this->has as $modelName => $params){
			    	$modelObj = new $modelName();
		    		if($params['local_key']){
				    	$modelData = $modelObj->fetchAll(array(array($params['local_key'],'=',$this->$params['remote_key'])));
				    	if($modelData){
				    		if(count($modelData)>1){
						    	$this->$modelName = $modelData;				    						    		
				    		}else{
					    		$this->$modelName = $modelData[0];
				    		}
				    	}		
		    		}else{
			    		if(is_array($params['query'])){
			    			$query = array();
							foreach($params['query'] as $query_element){
								if($query_element['remote_key']){
									$query[] = array($query_element['local_key'], $query_element['operator'], $this->$query_element['remote_key']);									
								}
								if($query_element['value']){
									$query[] = array($query_element['local_key'], $query_element['operator'], $query_element['value']);																		
								}
							}				    		
							
							$modelData = $modelObj->fetchAll($query);
							if($modelData){
					    		if(count($modelData)>1){
							    	$this->$modelName = $modelData;				    						    		
					    		}else{
						    		$this->$modelName = $modelData[0];
					    		}
					    	}
			    		}
		    		}
		    	}
	        }
	        
	        
	    }
    	//echo "Model::load()<br>";

	}
	
	protected function transformWhereParams($where){
		$params = array();
		foreach($where as $w){
			if(!in_array($w[0], $this->validConjunctions)){
				if(count($w)==1){
					$params[] = $w;					
				}else{
					$params[] = array(
									'conjunction'=>'AND',
									'field'=>$w[0],
									'operator'=>$w[1],
									'value'=>$w[2]
								); 
				}
				
			}else{				
				$params[] = array(
								'conjunction'=>$w[0],
								'field'=>$w[1],
								'operator'=>$w[2],
								'value'=>$w[3]
							); 
			}
		}
		return $params;
	}
	
	protected function buildWhereClause ($where, $bindings, &$bindParams) {
	    $whereClause = ' WHERE ';
	    if (count($where)) {
	        for($i = 0; $i < count($where); $i++) {
	        	
	        	if(count($where[$i])==1){	        	
		            $whereClause .= ' '.$where[$i][0];
	            }else{
		            if ($i > 0) 
		            	$whereClause .= ' ' . $where[$i]['conjunction'] . ' ';
		            
		            $whereClause .= $where[$i]['field'] . ' ' . $where[$i]['operator'] . ' ?';
		            $bindings .= $this->getBindType($where[$i]['value']);
		            $bindParams[] = $where[$i]['value'];
	            }
	        }
	    } else {
	        $whereClause .= $this->pk . ' = ?';
	        $bindings .= 'i';
	        $primaryKey = $this->pk;
	        $bindParams[] = $this->$primaryKey;
	    }
	    //array_unshift($bindParams, $bindings);
	    return $whereClause;
	}
    
    public function save () {
	    if ($this->getId() > 0) {
	        $this->update();
	    } else 
	    {
	    	$this->insert();
	    }
	}
	
	protected function insert ($insertFields = array()) {
	    $fields = '';
	    $params = '';
	    $bindings = '';
	    $bindParams = array();
	    if (count($insertFields)) $keys = $insertFields;
	    else $keys = array_keys($this->bindArray);
	    for ($i = 0; $i < count($keys); $i++) {
	        if ($keys[$i] != $this->pk) {
	            $fields .= $keys[$i];
	            $bindings .= $this->bindArray[$keys[$i]];
	            $params .= '? ';
	            if ($i + 1 < count($keys)) {
	                $fields .= ',';
	                $params .= ',';
	            }
	            $fields .= ' ';

	        }
	    }
	    
	    $sql = 'INSERT INTO ' . $this->table . ' (' . $fields . ') ';
	    $sql .= 'VALUES (' . $params . ')';
	    //echo "$sql<br>";
	    
	    try{
	    
		    $stmt = $this->conn->prepare($sql);
	        
	        $values = array();
	   	    foreach($keys as $fieldName) {
	       		if($fieldName!=$this->pk){
		       		$values[] = $this->$fieldName?$this->$fieldName:'';    				       		
	       		}
	       	}

	        $stmt->execute($values);
	   }catch(PDOException $e){
	   		echo $e->getMessage();
	   }
        $this->setId($this->conn->lastInsertId());
        $stmt->closeCursor();
        //echo "<br>Model::insert()<br>";	

	}
    
    protected function update ($where = array(), $updateFields = array()) {
	    $bindings = '';
	    $bindParams = array();
	    $wp = array(); // temp var to deal with pass by reference issue in call_user_func_arrray
	    $sql = 'UPDATE ' . $this->table . ' SET ';
	    if (count($updateFields)) $keys = $updateFields;
	    else $keys = array_keys($this->bindArray);
	    for ($i = 0; $i < count($keys); $i++) {
	        if ($keys[$i] != $this->pk) {
	            $sql .= $keys[$i] . ' = ?';
	            $bindings .= $this->bindArray[$keys[$i]];
	            if ($i + 1 < count($keys)) {
	                $sql .= ',';
	            }
	            $bindParams[] =& $this->$keys[$i];
	        }
	    }
	    
	   
	    
	    $whereClause = $this->buildWhereClause($where, $bindings, $bindParams);
	   	
	    foreach($bindParams as $k => $v) $wp[$k] = &$bindParams[$k];
	    $sql .= $whereClause;
	    $stmt = $this->conn->prepare($sql);
	    if ($stmt) {
	        $values = array();
       	    foreach($keys as $fieldName) {
	       		if($fieldName!=$this->pk){
		       		$values[] = $this->$fieldName?$this->$fieldName:'';    				       		
	       		} 		
	       	}
	       	$values[] = $this->getId();

	        $stmt->execute($values);
	        $stmt->closeCursor();
	    }

        //echo "<br>Model::update()<br>";	

	}
 
	protected function getBindType ($param) {
	    if (is_int($param)) return 'i';
	    else if (is_string($param)) return 's';
	    else if (gettype($param)=='NULL') return 's';
	    else throw new Exception('Invalid type applied to bind variable in database query');
	}
	
	public function delete () {
        $primaryKey = $this->pk;
        $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $primaryKey . ' = ?';
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->execute(array($this->$primaryKey));
            $stmt->closeCursor();
        }
    }
    
    public function fetchAll($where = array(), $orderBy = false){
    	try{
	        $whereParams = array();
	        if(count($where)){
				$where = $this->transformWhereParams($where);
				$whereClause = $this->buildWhereClause($where, '', $whereParams);	        
	        }
	        
	        if($orderBy){
		        $orderParams = array();
		        foreach($orderBy as $order){
					$orderParams[] = $order;
		        }
		        $orderClause = "ORDER BY ".implode(',', $orderParams);
	        }
	        
		    $sql = "SELECT ".implode(', ', array_keys($this->bindArray))." FROM ".$this->table. " $whereClause $orderClause ";
	        $stmt = $this->conn->prepare($sql);
	        $stmt->execute($whereParams);
        
        }catch(Exception $e){
	        echo "error: ".$e->getMessage();
        }
        
        $data = $stmt->fetchAll();
       	// Process Relationships with other Models:
        if($this->has){        
	        foreach($data as &$d){
		    	foreach($this->has as $modelName => $params){
			    	$modelObj = new $modelName();

			    	
			    	if($params['local_key']){
				    	$modelData = $modelObj->fetchAll(array(array($params['local_key'],'=',$d->$params['remote_key'])));
				    	if($modelData){
					    	if(count($modelData)>1){
						    	$d->$modelName = $modelData;				    						    		
				    		}else{
					    		$d->$modelName = $modelData[0];
				    		}
				    	}		
		    		}else{
			    		if(is_array($params['query'])){
			    			$query = array();
							foreach($params['query'] as $query_element){
								if($query_element['remote_key']){
									$query[] = array($query_element['local_key'], $query_element['operator'], $d->$query_element['remote_key']);									
								}
								if($query_element['value']){
									$query[] = array($query_element['local_key'], $query_element['operator'], $query_element['value']);																		
								}
							}				    		
							
							$modelData = $modelObj->fetchAll($query);
							if($modelData){
								if(count($modelData)>1){
							    	$d->$modelName = $modelData;				    						    		
					    		}else{
						    		$d->$modelName = $modelData[0];
					    		}
					    	}
			    		}
		    		}
			    	
			    	
		    	}
	        }	        
	        unset($d);
		}        
	    return $data;
    }

}










?>
