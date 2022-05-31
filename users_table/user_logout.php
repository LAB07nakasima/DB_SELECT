<?php
include(dirname(__FILE__).'/../function.php');
check_session_id();
session_start();
$_SESSION = array();

if (isset($_COOKIE[session_name()])) {
  setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
header('Location: user_login.php');
exit();


?>