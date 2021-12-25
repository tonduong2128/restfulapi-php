<?php
    class Question{
        private $conn;

        //question property
        public $id;
        public $title;
        public $a;
        public $b;
        public $c;
        public $d;
        public $answer;

        //connect db
        function __construct($db){
            $this->conn = $db;
        }

        //read data
        public function read(Type $var = null)
        {
            $query ="SELECT* FROM tbl_questions as c order by c.id DESC";
            $statement = $this->conn->prepare($query);

            $statement->execute(); //giống query
            return $statement;
        }
    }
?>