<!-- データの参照 -->
<?php
// DBへ接続
include(dirname(__FILE__).'/../function.php');
session_start();
check_session_id();;
$pdo = connect_to_task_db();

// SQLの作成 SELECT文データの取得
$sql = 'SELECT * FROM users_table';

$stmt = $pdo->prepare($sql);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
// SQL実行の処理
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record["username"]}</td>
      <td>{$record["password"]}</td>
      <td>
        <a href='user_edit.php?id={$record["id"]}'> edit </a>
      </td>
      <td>
        <a href='user_delete.php?id={$record["id"]}'> delete </a>
      </td>
    </tr>
  ";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー登録</title>
</head>
<body>

  <fieldset>
    <table>
      <thead>
        <tr>
          <th>username</th>
          <th>password</th>
        </tr>
      </thead>
      <tbody>
        <?= $output?>
      </tbody>
    </table>
  </fieldset>
</body>
</html>



