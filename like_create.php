<?php
include('function.php');
// var_dump($_GET);
// exit();
// readからGETで送られてきた内容を追加する
$user_id = $_GET['user_id'];
$todo_id = $_GET['todo_id'];

var_dump($user_id);
// DB接続
$pdo = connect_to_task_db();

// SQL作成と実行
// $sql = 'INSERT INTO like_table (id, user_id, todo_id, created_at) VALUES (NULL, :user_id, :todo_id, now())';
$sql = 'INSERT INTO like_table (id, user_id, todo_id, created_at) VALUES (NULL, :user_id, :todo_id, now())';
// $now = now();
// var_dump($now);
// exit();

$stmt = $pdo->prepare($sql);

// バインド変数を設定 :topicなどは名前変えてOK！$sql
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR); //数字の時はinteger PDO::PARAM_INT,受け取る値によって変更.
$stmt->bindValue(':todo_id', $todo_id, PDO::PARAM_STR);


// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute(); //executeで実行
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location: topic_read.php");
exit();

?>