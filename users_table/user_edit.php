<?php
include(dirname(__FILE__).'/../function.php');
session_start();
check_session_id();
$pdo = connect_to_task_db();

$id = $_GET['id'];

// id指定してデータ取得
$sql = 'SELECT * FROM users_table WHERE id=:id' ;
$stmt = $pdo -> prepare($sql);
$stmt -> bindValue(':id', $id, PDO::PARAM_INT);
try{
  $status = $stmt->execute();
  $result = $stmt -> fetch(PDO::FETCH_ASSOC);
}catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e -> getMessage()}"]);
  exit();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー編集</title>
</head>
<body>
<form action="user_update.php" method="POST">
  <legend>ユーザー登録リスト 編集画面</legend>
  <a href="user_read.php">一覧画面</a>
<div>
  username: <input type="text" name="username" value="<?= $result['username']?>">
</div>
<div>
  password: <input type="text" name="password" value="<?= $result['password']?>">
</div>
 <div>
   <input type="text" name="id" value="<?= $result['id']?>">
 </div>
 <div>
   <button>送信</button>
 </div>
</form>
</body>
</html>
