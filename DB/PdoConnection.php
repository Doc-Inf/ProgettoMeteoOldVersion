<?php
    class PdoConnection implements DB{
        private $hostname;
        private $username;
        private $password;
        private $port;
        private $dbname;
        private $dbmsName;
        private $con;

        public function __construct($hostname,$username,$password,$port,$dbname,$dbmsName){
            $this->hostname = $hostname;
            $this->username = $username;
            $this->password = $password;
            $this->port = $port;
            $this->dbname = $dbname;
            $this->dbmsName = $dbmsName;
            $this->con = $this->getConnection();
        }

        public function getConnection(){
            try {
                if($this->con==null){
                    $this->con = new PDO($this->dbmsName . ":host=" . $this->hostname . ";dbname=" . $this->dbname,$this->username, $this->password,[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
                }                
            } catch (PDOException $e){
                die("Connessione fallita ".$e->getMessage());
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
                   
        public function query(string $sql,$params=[]) { 
            $con = $this->getConnection();            
            if(count($params)>0){
                $stmt = $con->prepare($sql);
                $stmt->execute($params);
                $res = $stmt->fetchAll();
                $stmt = null;
            }else{
                $resultSet = $con->query($sql);
                $res = $this->fetchData($resultSet);
            }         
            return $res;            
        }
    
        public function dmlCommand(string $sql, $params=[]) { // `
            $con = $this->getConnection();
            $result = -1;
            $stmt = $con->prepare($sql);
            if(count($params)>0){                
                $result = $stmt->execute($params);                             
            }else{
                $result = $stmt->execute();                 
            }     
            $stmt = null;                     
            return $result;        
        }

        public function beginTransaction(){
            $this->con->beginTransaction();
        }
    
        public function commit(){
            $this->con->commit();
        }
    
        public function roolback(){
            $this->con->rollback();
        }
    
        public function close(){
            $this->con = null;
        }

        public function getErrors(){
            return "Errors: " . $con->errorInfo();
        }
    }
?>