<?php
    //connect database PDO
    class Db{
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $databasename = "restfulapi";
        private $conn;
        public function connect()
        {   
            $this->conn = null;
            try {
                $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename , $this->username, $this->password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn = $conn;
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            return $this->conn;
        }
    }
?>