<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>job change</title>
</head>
<body>
  <form action="change_create.php" method="POST">
    <fieldset>
      <div>
        title:<input type="text" name="title">
      </div>
      <div>
        keyword: <input type="text" name="keyword">
      </div>
      <div>
        <label for="job_change">記事・コラム:</label><br>
        <textarea id="job_change" name="text" rows="5" cols="33"></textarea>
      </div>
      <div>
        <button>送信</button>
      </div>
      </textarea>
    </fieldset>
  </form>
</body>
</html>

