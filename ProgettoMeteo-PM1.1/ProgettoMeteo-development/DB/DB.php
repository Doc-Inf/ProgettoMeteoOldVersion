<?php
    interface DB{
        public function getConnection();
        public function query(string $sql,$params=[]);
        public function dmlCommand(string $sql,$params=[]);
    }

?>