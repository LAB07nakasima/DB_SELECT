<!--編集画面の作成 -->
<?php 
include('function.php');

// id受け取り
$id = $_GET['id'];
// var_dump($id);
// exit();

// DB接続
$pdo = connect_to_task_db();

// create.phpと同じ内容
$sql = 'SELECT * FROM topic_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
// バインド変数を設定 :topicなどは名前変えてOK！$sqlの:***も変更する
$stmt->bindValue(':id', $id, PDO::PARAM_STR); 

// SQL実行
try {
  $status = $stmt->execute(); //executeで実行
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
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
  <title>Topic</title>
</head>
<body>
  <form action="topic_update.php" method="POST">
    <fieldset>
      <legend>TOPIC編集画面</legend>
      <a href="topic_read.php">一覧画面</a>
      <div>
        topic: <input type="text" name='topic' value="<?= $record['topic']?>">
      </div>
      <div>
      keyword:
        <select name="keyword" id="keyword-select" value="<?= $record['keyword']?>">
          <option value="job_change">転職</option>
          <option value="job_continue">仕事を続ける</option>
          <option value="study_abroad">留学</option>
          <option value="re_learn">学びなおし</option>
          <option value="working_holiday">ワーホリ(ワーキングホリデー)</option>
          <option value="break">休憩</option>
        </select>
      </div>
      <div>
        <input type="text" name="id" value="<?= $record['id']?>">
      </div>
      <div>
        <button> submit </button>
      </div>
    </fieldset>
  </form>
  
</body>
</html>

