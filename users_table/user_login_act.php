<?php
include('../function.php');
// echo"OK";
// exit();
// include('../function.php');
session_start();
// check_session_id();

$username = $_POST['username'];
$password = $_POST['password'];
// $admin = $_POST['is_admin'];

$pdo = connect_to_task_db();
// var_dump($username);


// username,password,is_deleted 管理者id全ての条件を満たすデータを抽出する
$sql ='SELECT * FROM users_table WHERE username=:username AND password=:password AND is_deleted= 0 ';

$stmt = $pdo -> prepare($sql);
$stmt -> bindValue(':username', $username, PDO::PARAM_STR);
$stmt -> bindValue(':password', $password, PDO::PARAM_STR);
// $stmt -> bindValue(':is_admin', $is_admin, PDO::PARAM_STR);

try{
$status = $stmt -> execute();
}catch(PDOException $e){
  echo json_encode(["sql error" => "{$e -> getMessage()}"]);
  exit();
}

// データがない場合はログイン画面へ移動する
$val = $stmt -> fetch(PDO::FETCH_ASSOC);
if(!$val){
  echo"<p>ログイン情報に誤りがあります</p>";
  echo"<a href=user_login.php>ログイン</a>";
  exit();
}else{
  // まず空にして
  $_SESSION = array();
  // セッションidを取得
  $_SESSION['session_id'] = session_id();
  $_SESSION['is_admin'] = $val['is_admin'];
  $_SESSION['username'] = $val['username'];
  header("Location: ../topic_read.php");
  exit();
}

// データを存在したらセッション変数にidやユーザーデータを入れて画面に映る
?>