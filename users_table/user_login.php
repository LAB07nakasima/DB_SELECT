<!-- データ入力画面 -->

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>ユーザーログイン</title>
</head>
<body>
  <header>
    <!-- <a href=../topic_read.php>ログイン</a> -->
  </header>

  <form action="user_login_act.php" method="POST">
    <fieldset>
      <div>
        username: <input type="text" name="username">
      </div>
      <div>
        password: <input type="text" name="password">
      </div>
      <div>
        <button>ログイン</button>
      </div>
      <a href="../topic_register.php">新規登録</a>
    </fieldset>
  </form>
  
</body>
</html>