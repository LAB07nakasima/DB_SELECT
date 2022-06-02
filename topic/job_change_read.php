<!-- 一覧画面 -->
<?php
// 階層１つ上を取得　dirname(__FILE__).' /../'**** '
include(dirname(__FILE__).'/../function.php');
session_start();
$uname = "<p>ユーザー名：".$_SESSION['username']."</p>";

// DB接続
$pdo = connect_to_task_db();

// SQL作成&実行
// SQL文の記述 作成はINSERT、読み込みはSELECT *:全部 後ろにソート付けるやカラム指定OK WHERE keyword
$sql = 'SELECT * FROM job_change';
$stmt = $pdo->prepare($sql);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();
    $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
      // echo'<pre>';
      // var_dump($result);
      // echo'</pre>';

    // $output = "";
    // $output_text ="";
    // $output_title ="";
    

    foreach($result as $record) {

      $output_text .=
      // mb_substr( 文字列, 開始位置, 文字数 ) 文字の指定
      mb_substr("{$record['text']}", 0,15);

      $output_title .=
       $record["title"];
    
      //  <td>{$output_text}</td>
      //aタグでidを元に、編集と削除へのリンクを作成しておくこと.URLにidを仕込んでおく
      $output .= "
      <tr>
        <td>{$record["title"]}</td>
         
        <td>
          <a href='change_edit.php?id={$record["article_id"]}'> edit </a>
        </td>
        <td>
          <a href='change_delete.php?id={$record["article_id"]}'> delete </a>
        </td>
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
<style>
    h1 {
      position: relative;
      padding: 1em 2em;
      text-align: center;
    }

    h1:before,
    h1:after {
      position: absolute;
      content: '';
    }

    h1:after {
      top: 0;
      left: 300px;
      width: 50px;
      height: 50px;
      border-top: 2px solid #000;
      border-left: 2px solid #000;
    }

    h1:before {
      right: 300px;
      bottom: 0;
      width: 50px;
      height: 50px;
      border-right: 2px solid #000;
      border-bottom: 2px solid #000;
    }

    .input_area{
      margin: 50px 10px;
    }

    .head_h1{
     max-width: 600px;    /* 線の大きさmaxを指定 */
    }
    .head_test {
        
        margin:  0;             /* デフォルトCSS打ち消し */
        font-size:  24px;       /* 文字サイズ指定 */
        border-bottom:  solid;  /* 線指定 */
        /* display: inline-block; 文字の分だけ線の長さ？*/
        padding-bottom:  5px;   /* 余白指定 */
        margin-bottom: 15px;    /* 周りの余白指定 */
        padding-left: 5%;
    }
    p {
        margin:  0;             /* デフォルトCSS打ち消し */
        line-height: 2;         /* 行間調整 */
      }
    .contents_text{
      font-size: 20px;
    }
   
</style>
<body>
  <table>
    <?= $uname?>
    <thead>
      <h1>転職記事</h1>

      <div class=input_area>
        <a href="change_input.php">入力画面</a>
      </div>

      <div class=head_h1>
        <h2 class=head_test>TITLE <?=$output_title ?></h2>
      </div>
      <p class=contents_text>
        記事内容
        <?= $output_text?>
      </p>
      <br>
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