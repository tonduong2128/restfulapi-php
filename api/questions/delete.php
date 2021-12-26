<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With");

include_once "../../config/db.php";
include_once "../../model/questions.php";
if ($_SERVER["REQUEST_METHOD"]=="DELETE"){
    $db = new Db();
    $connect = $db->connect();

    $question = new Question($connect);
    $data = json_decode(file_get_contents('php://input')); //lấy dữ liệu từ json gửi lên còn qua form là dùng $_POST
    $question->id = $data->id;
    
    if ($question->delete()){
        echo json_encode(["mesage"=>1]);
    } else{
        echo json_encode(["mesage"=>0]);
    }
} else{
    echo json_encode(["mesage"=>0]);
}
?>