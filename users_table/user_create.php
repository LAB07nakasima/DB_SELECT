<?php
include(dirname(__FILE__).'/../function.php');
session_start();
// DB接続
$pdo = connect_to_task_db();

if(
  !isset($_POST['username']) || $_POST['username'] == '' ||
  !isset($_POST['password']) || $_POST['password'] == ''
){
  exit('ParamError');
}

// データの受け取り
$username = $_POST['username'];
$password = $_POST['password'];
// var_dump($username);
// exit();

// SQL作成&実行
$sql = 'INSERT INTO users_table (id, username, password, is_admin, is_deleted, created_at, updated_at) VALUES (NULL, :username, :password, 0, 0, now(), now())';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
// var_dump($stmt);
// exit();


// SQL実行の処理
header('Location: user_input.php');
exit();

?>