
<?php
// DBからデータを取得してデータの一覧画面を作成する
// 表示ファイル read.phpへアクセス時、DB接続する

$dbn ='mysql:dbname=gif_lo07_task;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit('OK');
}

// SQL作成&実行
$sql = 'SELECT * FROM topic_table';
$stmt = $pdo->prepare($sql);

// バインド変数を設定は不要
// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
// $statusに実行結果が入るが、この時点ではまだデータ自体の取得はできてない！
  $status = $stmt->execute();

// // SQL実行の処理 fetchAll関数でデータ自体を取得
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// ここで確認
  echo'<pre>';
  var_dump($result);
  echo'</pre>';
  exit();

// $output = "";
// // 繰り返し処理　取得したデータをHTMLタグ生成
// foreach ($result as $record) {
//   $output .= 
//     // "<button>{$record["topic"]}</button>"
//     "<p>{$record["topic"]}</p>
//       <p>{$record["keyword"]}</p>
//      ";
//   }

//   echo'<pre>';
//   var_dump($output);
//   echo'</pre>';


// // } catch (PDOException $e) {
// //   echo json_encode(["sql error" => "{$e->getMessage()}"]);
// //   exit();
}
?>


<!-- <!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Topic一覧</title>
</head>
<body>
  <a href="topic_input.php">入力画面</a>
  <h1>トピック</h1>
 
  
</body>
</html>

<script>

</script> -->