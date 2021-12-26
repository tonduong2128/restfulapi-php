<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

include_once "../../config/db.php";
include_once "../../model/questions.php";
$db = new Db();
$connect = $db->connect();
$question = new Question($connect);

$question->id = isset($_GET['id'])?$_GET['id']:die(); //die() không lấy gì hết
if ($question->show()){
    $question_item = [
        'title' => $question->title,
        'id' => $question->id,
        'a' => $question->a,
        'b' => $question->b,
        'c' => $question->c,
        'd' => $question->d,
        'answer' => $question->answer
    ];
} else{
    $question_item = [];
}
echo json_encode(["data"=>$question_item]);
?>