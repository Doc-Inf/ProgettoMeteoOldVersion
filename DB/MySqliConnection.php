<?php

class MysqliConnection implements DB{
    private $hostname;
    private $username;
    private $password;
    private $port;
    private $dbname;
    private $con;

    public function __construct($hostname,$username,$password,$dbname,$port){
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;        
        $this->dbname = $dbname;
        $this->port = $port;
        $this->con = $this->getConnection();
    }

    public function getConnection(){
        if($this->con==null){
            $this->con = new mysqli($this->hostname,$this->username, $this->password,$this->dbname,$this->port);
            if ($this->con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            } 
        }      
        return $this->con;
    }

    private function fetchData($resultSet){
        $res = [];
        for($i=0; $row = $resultSet->fetch(); ++$i) {
            $res[$i] = $row;
        }
        return $res;
    }

    public function query(string $sql,$params=[]) { // `
        $con = $this->getConnection();            
        if(count($params)>1){
            //$res = ($con->execute_query($sql,$param))->fetch_all(MYSQLI_ASSOC);
            $stmt = $con->prepare($sql);
            $stmt->bind_param($params[0],...array_slice($params,1));
            $stmt->execute();           
            $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }else{
            $res = $con->query($sql)->fetch_all(MYSQLI_ASSOC);            
        }              
        return $res;            
    }

    public function dmlCommand(string $sql, $params=[]) { // `
        $con = $this->getConnection();
        $result = -1;
        $stmt = $con->prepare($sql);
        if(count($params)>0){    
            $stmt->bind_param($params[0],...array_slice($params,1));        
            $result = $stmt->execute($params);                          
        }else{
            $result = $stmt->execute();
        }   
        $stmt->close();          
        return $result;        
    }

    public function beginTransaction(){
        $this->con->begin_transaction();
    }

    public function commit(){
        $this->con->commit();
    }

    public function roolback(){
        $this->con->rollback();
    }

    public function close(){
        $this->con->close(); 
        $this->con = null;
    }

    public function getErrors(){
        return "Errors: " . $con -> error;
    }
}


?>