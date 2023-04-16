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
        $con = new mysqli($this->hostname,$this->username, $this->password,$this->dbname,$this->port);
        if ($con->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        return $con;
    }

    private function fetchData($resultSet){
        $res = [];
        for($i=0; $row = $resultSet->fetch(); ++$i) {
            $res[$i] = $row;
        }
        return $res;
    }

    public function query(string $sql,$param=[]) { // `
        $con = $this->getConnection();            
        if(count($param)>1){
            //$res = ($con->execute_query($sql,$param))->fetch_all(MYSQLI_ASSOC);
            $stmt = $con->prepare($sql);
            $stmt->bind_param($param[0],...array_slice($param,1));
            $stmt->execute();           
            $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }else{
            $res = $con->query($sql)->fetch_all(MYSQLI_ASSOC);            
        }
        $con->close();            
        return $res;            
    }

    public function dmlCommand(string $sql, $params=[]) { // `
        $con = $this->getConnection();
        $result = -1;
        if(count($params)>0){
            $stmt = $con->prepare($sql);
            $result = $stmt->execute($param);    
            $stmt->close();            
        }else{
            $result = $con->query($sql);
        }             
        $con->close();    
        return $result;        
    }

}


?>