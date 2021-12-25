<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=utf-8");
    
    include_once "../../config/db.php";
    include_once "../../model/questions.php";
    $db = new Db();
    $connect = $db->connect();
    $question = new Question($connect);
    $read = $question->read();
    $num = $read->rowCount(); //trong PDO luôn
    if ($num > 0){
        $question_array = [];
        while ($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row); //Trong PDO, giải các thành phần bên trong ra. để có thể dùng $id,...
            $question_item = [
                'id' => $id,
                'a' => $a,
                'b' => $b,
                'c' => $c,
                'd' => $d,
                'answer' => $answer
            ];
            array_push($question_array, $question_item); //thêm vào mảng
        }
        echo json_encode(["data" => $question_array]);
    }
?>