<!-- inputからデータを受け取り、DBへの新規データを作成 -->
<?php 
include('function.php');

// 入力ない場合、取得できなかったら、エラー
if(
  !isset($_POST['topic']) || $_POST['topic'] == '' ||
  !isset($_POST['keyword']) || $_POST['keyword'] == ''
){
  exit('ParamError');
}

$topic = $_POST['topic'];
$keyword = $_POST['keyword'];


//DB接続　 各種項目設定
$pdo = connect_to_task_db();

// 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる．

// SQL作成と実行　文字
$sql = 'INSERT INTO topic_table (id, topic, keyword, created_at, updated_at) VALUES (NULL, :topic, :keyword, now(), now())';

$stmt = $pdo->prepare($sql);

// バインド変数を設定 :topicなどは名前変えてOK！$sql
$stmt->bindValue(':topic', $topic, PDO::PARAM_STR); //数字の時はinteger PDO::PARAM_INT,受け取る値によって変更.
$stmt->bindValue(':keyword', $keyword, PDO::PARAM_STR);


// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute(); //executeで実行
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行時の処理
header('Location: topic_input.php');
exit();

?>