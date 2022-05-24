<?php
// DB接続
$dbn ='mysql:dbname=gif_lo07_task;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}
// ここまでOK

// SQL作成＆実行
$sql = 'SELECT * FROM topic_table';
$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // echo'<pre>';
  // var_dump($result);
  // echo'</pre>';
  // exit();
// ここまでOK

$output_topic = "";
$output_key = "";
// 繰り返し処理で結果を変数に入れる
foreach ($result as $record) {
  $output_topic .= "
      {$record["topic"]}
  ";
}{
  $output_key .="
  {$record["keyword"]}
  ";
}
//  echo'<pre>';
//  var_dump($output_topic);
//  echo'</pre>';
// exit();
// ここまでOK

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Topic一覧</title>
</head>
<body>
  <a href="topic_input.php">入力画面</a>

  <input type="button" onclick="topic_new()" value="topic新規作成ページへ" />
  <div>
    <h1>topicから選んでください</h1>
    <div>
      <button type="button" onclick="location.href='./topic/change_read.php'"><?=$output_topic?></button>
      <!-- <p id="output"></p> -->
      <!-- <p id= "outputBtn"><?=$output_topic?></p> -->
     
      <!-- <p onClick="location.href= './topic/{$keyOutput}'"></p> -->

    </div>
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