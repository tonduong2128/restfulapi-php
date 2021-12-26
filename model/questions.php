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

        //show data
        public function show()
        {
            $query ="SELECT* FROM tbl_questions as c WHERE c.id=? LIMIT 1";
            $statement = $this->conn->prepare($query);

            $statement->bindParam(1, $this->id) ;   //trong PDO , dùng để truyền dữ liệu trong dấu chấm hỏi ở trên
                                                    // 1 tham số
            $statement->execute(); //giống query    //? trên là mysqli

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $this->title = $row["title"];
                $this->a = $row["a"];
                $this->b = $row["b"];
                $this->c = $row["c"];
                $this->d = $row["d"];
                $this->answer = $row["answer"];
                return true;
            } else{
                return false;
            }
        }

        //create data
        public function create()
        {
            $query = "INSERT INTO tbl_questions SET title=:title, a=:a, b=:b, c=:c, d=:d, answer=:answer"; //trong PDO viết z khác với pdo
           
            $statement = $this->conn->prepare($query);

            //clear data //bỏ những kí tự không mong muốn
            $this->title = htmlspecialchars(strip_tags($this->title)); 
            $this->a = htmlspecialchars(strip_tags($this->a));
            $this->b = htmlspecialchars(strip_tags($this->b));
            $this->c = htmlspecialchars(strip_tags($this->c));
            $this->d = htmlspecialchars(strip_tags($this->d));
            $this->answer = htmlspecialchars(strip_tags($this->answer));

            $statement->bindParam(':title', $this->title);
            $statement->bindParam(':a', $this->a);
            $statement->bindParam(':b', $this->b);
            $statement->bindParam(':c', $this->c);
            $statement->bindParam(':d', $this->d);
            $statement->bindParam(':answer', $this->answer);

            if ($statement->execute()){
                return true;
            } else {
                print("Error ".$statement->error);
                return false;
            }
        }
        public function update()
        {
            $query = "UPDATE tbl_questions SET title=:title, a=:a, b=:b, c=:c, d=:d, answer=:answer WHERE id=:id" ; //trong PDO viết z khác với pdo
           
            $statement = $this->conn->prepare($query);

            //clear data //bỏ những kí tự không mong muốn
            $this->id = htmlspecialchars(strip_tags($this->id)); 
            $this->title = htmlspecialchars(strip_tags($this->title)); 
            $this->a = htmlspecialchars(strip_tags($this->a));
            $this->b = htmlspecialchars(strip_tags($this->b));
            $this->c = htmlspecialchars(strip_tags($this->c));
            $this->d = htmlspecialchars(strip_tags($this->d));
            $this->answer = htmlspecialchars(strip_tags($this->answer));

            $statement->bindParam(':id', $this->id);
            $statement->bindParam(':title', $this->title);
            $statement->bindParam(':a', $this->a);
            $statement->bindParam(':b', $this->b);
            $statement->bindParam(':c', $this->c);
            $statement->bindParam(':d', $this->d);
            $statement->bindParam(':answer', $this->answer);

            if ($statement->execute()){
                return true;
            } else {
                print("Error ".$statement->error);
                return false;
            }
        }
        public function delete()
        {
            $query = "DELETE FROM tbl_questions WHERE id=:id" ; //trong PDO viết z khác với pdo
           
            $statement = $this->conn->prepare($query);

            //clear data //bỏ những kí tự không mong muốn
            $this->id = htmlspecialchars(strip_tags($this->id)); 

            $statement->bindParam(':id', $this->id);

            if ($statement->execute()){
                return true;
            } else {
                print("Error ".$statement->error);
                return false;
            }
        }
    }
?>