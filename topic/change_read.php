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

// SQL作成&実行
// SQL文の記述 作成はINSERT、読み込みはSELECT *:全部 後ろにソート付けるやカラム指定OK
$sql = 'SELECT * FROM job_change';
$stmt = $pdo->prepare($sql);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
    $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    $output = "";

    foreach($result as $record) {
      $output .= "
      <tr>
        <td>{$record["title"]}</td>
        <td>{$record["text"]}</td>
      </tr>
      ";}
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
  <title>JobChange</title>
</head>
<body>
  <table>
    <thead>
      <h1>転職記事</h1>
      <a href="change_input.php">入力画面</a>
      <tr>
        <th>title</th>
        <th>text</th>
      </tr>
      <tbody>
        <?= $output?>
      </tbody>
    </thead>
  </table>
</body>
</html>