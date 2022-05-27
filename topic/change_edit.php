<?php
include(dirname(__FILE__).'/../function.php');
$pdo = connect_to_task_db();

$id =$_GET['id'];
// var_dump($id);
// exit();

$sql = 'SELECT * FROM job_change WHERE article_id=:id';

$stmt = $pdo->prepare($sql);
// バインド変数を設定 :topicなどは名前変えてOK！$sqlの:***も変更する
$stmt->bindValue(':id', $id, PDO::PARAM_STR); 
//数字の時はinteger PDO::PARAM_INT,受け取る値によって変更.


// SQL実行
try {
  $status = $stmt->execute(); //executeで実行

} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

?>