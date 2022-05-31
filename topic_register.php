<!-- ログインしたらid発行してログイン情報を管理 -->
<?php
// 領域展開
session_start();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー登録画面</title>
</head>
<body>
<form action="topic_register_act.php" method="POST">
  <fieldset>
    <legend>ユーザー登録画面</legend>
    <div>
      username: <input type="text" name="">
    </div>
    <div>
      passowrd: <input type="text" name="">
    </div>
    <div>
      <button>登録</button>
    </div>
    <a href="users_table/user_login.php">すでに登録されてる方はこちら</a>
  </fieldset>
</form>
</body>
</html>