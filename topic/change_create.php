<?php
// 入力チェック
if(
  !isset($_POST['title']) || $_POST['title']== '' ||
  !isset($_POST['keyword']) || $_POST['keyword']== '' ||
  !isset($_POST['text']) || $_POST['text']== '' 
  ){
    exit('ParamError');
  }

// データの受け取り
$title = $_POST['title'];
$keyword = $_POST['keyword'];
$text = $_POST['text'];

//DB接続　 各種項目設定
$dbn ='mysql:dbname=gif_lo07_task;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続　try{}catchでエラー出す
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// SQL作成と実行　文字
// $sql = 'INSERT INTO job_change (article_id, title, text, keyword,  updated_at) VALUES (NULL, :title, :text, :keyword, now(), now())';

$sql ="INSERT INTO job_change(article_id, title, text, keyword, updated_at) VALUES (NULL,:title,:text,:keyword,now())";

$stmt = $pdo->prepare($sql);
// バインド変数を設定 :topicなどは名前変えてOK！$sqlの:***も変更する
$stmt->bindValue(':title', $title, PDO::PARAM_STR); //数字の時はinteger PDO::PARAM_INT,受け取る値によって変更.
$stmt->bindValue(':text', $text, PDO::PARAM_STR);
$stmt->bindValue(':keyword', $keyword, PDO::PARAM_STR);

// SQL実行
try {
  $status = $stmt->execute(); //executeで実行

} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行時の処理
header('Location: change_input.php');
exit();

?>