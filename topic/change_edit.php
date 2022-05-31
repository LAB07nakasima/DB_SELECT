<?php
include(dirname(__FILE__).'/../function.php');
session_start();
check_session_id();
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

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>編集画面</title>
</head>
<body>
  <form action="change_update.php" method="POST">
    <fieldset>投稿記事の編集画面</fieldset>
    <a href="change_read.php">一覧画面</a>
    <div>
      
    </div>
  </form>
</body>
</html>
