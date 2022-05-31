<?php
// idを取得し
$id = $_GET['id'];
// var_dump($id);

// DB接続
include(dirname(__FILE__).'/../function.php');
$pdo = connect_to_task_db();

// SQLのDELETE文実行
$sql = 'DELETE FROM users_table WHERE id=:id';

$stmt = $pdo -> prepare($sql);
$stmt -> bindValue(':id', $id, PDO::PARAM_STR);

try{
  $status = $stmt -> execute();
}catch (PDOException $e){
  echo json_encode(["sql error" => "{$e -> getMessage()}"]);
  exit();
}

// 一覧画面へ移動
header("Location: user_read.php");
exit();
?>