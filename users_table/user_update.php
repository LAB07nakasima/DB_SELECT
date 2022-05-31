<?php
include(dirname(__FILE__).'/../function.php');
session_start();
check_session_id();;
// データが揃ってることを確認して
if(
  !isset($_POST['username']) || $_POST['username'] == '' ||
  !isset($_POST['password']) || $_POST['password'] == '' ||
  !isset($_POST['id']) || $_POST['id'] == '' 
){
  exit();
}
// データを受け取る
$username =$_POST['username'];
$password = $_POST['password'];
$id = $_POST['id'];

// DB接続して
$pdo = connect_to_task_db();

// UPDATEのSQLを実施
$sql = 'UPDATE users_table SET username=:username, password=:password WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

// SQLが正常に実行されたら一覧画面に移動
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
// var_dump($username);
header('Location: user_read.php');
exit();
?>