
<!-- editしたものを受け取ってDBに変更内容送ってる　見えてない部分 -->
<?php
include('function.php');
session_start();
check_session_id();
$pdo = connect_to_task_db();

 if(
   !isset($_POST['topic']) || $_POST['topic'] == '' ||
   !isset($_POST['keyword']) || $_POST['keyword'] == '' ||
   !isset($_POST['id']) || $_POST['id'] == ''
 ){
   exit('paramError');
 }

$topic = $_POST['topic'];
$keyword = $_POST['keyword'];
$id = $_POST['id'];
// var_dump($title);
// exit();

// SQL実行
$sql = 'UPDATE topic_table SET topic=:topic, keyword=:keyword WHERE id=:id' ;

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':topic', $topic, PDO::PARAM_STR);
$stmt->bindValue(':keyword', $keyword, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:topic_read.php");
exit();

?>