<?php
// topic の接続
function connect_to_task_db()
{
  $dbn='mysql:dbname=gif_lo07_task;charset=utf8mb4;port=3306;host=localhost';
  $user = 'root';
  $pwd = '';
  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }
}

// ログイン状態のチェック関数
function check_session_id()
{
  if(!isset($_SESSION["session_id"]) || $_SESSION["session_id"] != session_id()){
    header('Location: user_login.php');
  }else{
    // session_regenerate_id(true):idを再生成して更新.true古いidを無効
    session_regenerate_id(true);
    $_SESSION["session_id"] = session_id();
  }
}


?>