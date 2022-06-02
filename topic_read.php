<!-- 一覧画面 -->
<?php
// DB接続
include('function.php');
session_start();
// check_session_id();
$pdo = connect_to_task_db();
  // echo('OK');
  // exit();
  // ここまでOK

$user_id = $_SESSION['user_id'];

// SQL作成＆実行
$sql = 'SELECT * FROM topic_table LEFT OUTER JOIN (SELECT todo_id, COUNT(id) AS like_count FROM like_table GROUP BY todo_id) AS result_table ON topic_table.id = result_table.todo_id';
// $sql = 'SELECT topic, FROM topic_table ' ;
$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 配列
  // echo'<pre>';
  // var_dump($result);
  // echo'</pre>';
  // exit();
// ここまでOK

$output_topic = "";
$output_key = "";
// 繰り返し処理で結果を変数に入れる
foreach ($result as $record) {
  // 繰り返しボタンを作成
  // <button onclick=location.href='./topic/change_read.php'>{$record["topic"]}</button>
  $output_topic .= "
  <tr>
    <td><a href='./topic/{$record["keyword"]}_read.php' class='example-link'> {$record["keyword"]} </a></td>
    <td><a href='like_create.php?user_id={$user_id}&todo_id={$record["id"]}' class='example-link'> ☆{$record["like_count"]} </a></td>
    <td><a href='topic_edit.php?id={$record["id"]}' class='example-link'> edit </a></td>
    <td><a href='topic_delete.php?id={$record["id"]}' class='example-link'> delete </a></td>
  </tr><br>  
  <br>
    ";
}{
  $output_key .="
  {$record["keyword"]}
  ";
}
  //  echo'<pre>';
  //  var_dump($record["keyword"]);
  //  echo'</pre>';
  // exit();
  // ここまでOK

$uname = "<p>ユーザー名：".$_SESSION['username']."</p>";

// $keyword = "job_change";

$view ="";
if($status == false){
  $error = $stmt -> errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  foreach($result as $record){
    $view .= "<p>";
    $view .= "<a href='./topic/{$record["keyword"]}_read.php'>[リンク]";
    $view .= "</a>";
    $view .= "</p>";
  }
}

// var_dump($view);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Topic一覧</title>
</head>

<style>
  .example-link {
  display: inline-block;
  margin: 1em 0.5em; /* 前後のスペース */
  padding: 0.6em 1em; /* 文字周りの余白 */
  color: #FFF; /* テキストカラー */
  font-size: 0.95em; /* フォントサイズ */
  text-decoration: none; /* 下線を消す */
  background: #1aa1ff; /* 背景色 */
  border-radius: 3px; /* 角の丸み */
  transition: 0.3s; /* ホバーの変化を滑らかに */
}

  /* ホバー時の見た目 */
  .example-link:hover {
    background: #064fda; /* 背景色 */
}
</style>

<body>
  <!-- <a href="topic_input.php">入力画面</a> -->
  <?= $uname?>
  <a href="users_table/user_logout.php">ログアウト</a>

  <input type="button" onclick="location.href='./topic_input.php'" class="example-link" value="topic新規作成ページへ" />
  <div>
    <h1>topicから選んでください</h1>
    <div>
      <?= $output_topic?>
      <!-- <button type="button" onclick="location.href='./topic/change_read.php'"><?=$output_topic?>$output_topic</button> -->
      
      <!-- <p onClick="location.href= './topic/{$keyOutput}'"></p> -->

    </div>
    <?= $view?>
  </div>
  <script>
    const resultArray = <?= json_encode($output_topic)?>;
    const output = document.getElementById("output")
    console.log(resultArray);

    // キーワード
    const keyArray = <?= json_encode($output_key)?>;
    const keyOutput = document.getElementById("keyOutput");

    let btn = "";

    // resultArray.forEach(item => {
      // btn +=
      // "<button type="button" onclick="location.href='./topic/change.html'"><?=$output_topic?>
      
    // });
    output.innerHTML =  btn;

    // ボタン機能JS クリックしたら新規作成画面に飛ぶ
    function topic_new(){
      location.href = "topic_input.php";
    }
  </script>
</body>
</html>