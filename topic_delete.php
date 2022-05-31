<!-- 削除機能 一覧画面にdelete.phpへのリンクを追加しておくこと！-->
<?php
$id = $_GET['id'];

include('function.php');
session_start();
check_session_id();
$pdo = connect_to_task_db();
// SQL実行
$sql = 'DELETE FROM topic_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// 完了したらread.phpに戻る
header("Location:topic_read.php");
exit();

?>