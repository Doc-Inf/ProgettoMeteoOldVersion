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
                $con = new PDO($this->dbmsName . ":host=" . $this->hostname . ";dbname=" . $this->dbname,$this->username, $this->password,[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
            } catch (PDOException $e){
                die("Connessione fallita ".$e->getMessage());
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
            if(count($param)>0){
                $stmt = $con->prepare($sql);
                $stmt->execute($param);
                $res = $stmt->fetchAll();
                $stmt = null;
            }else{
                $resultSet = $con->query($sql);
                $res = $this->fetchData($resultSet);
            }            
            $con = null;
            return $res;            
        }
    
        public function dmlCommand(string $sql, $param=[]) { // `
            $con = $this->getConnection();
            $result = -1;
            if(count($param)>0){
                $stmt = $con->prepare($sql);
                $result = $stmt->execute($param); 
                $stmt = null;               
            }else{
                $result = $con->query($sql);
            }      
            $con = null;           
            return $result;        
        }
    
    }
?>