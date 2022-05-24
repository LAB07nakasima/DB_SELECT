<!-- ここで入力　入力データcreate.phpへ送信 -->

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Topic</title>
</head>
<body>
  <!-- form action,method,name -->
  <form action="topic_create.php" method="POST">
    <fieldset>
      <legend>DB連携topicリスト(入力フォーム)</legend>
      <div>
        topic: <input type="text" name="topic">
      </div>
      <div>
        keyword: <input type="text" name="keyword">
      </div>
      <div>
        <button> submit </button>
      </div>
    </fieldset>
  </form>
</body>
</html>