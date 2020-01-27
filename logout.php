<?php
session_start();


// セッションの変数のクリア
$_SESSION = array();
// セッションcookieを削除
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}
// セッションクリア
session_destroy();

header("Location: login.php");  // ログインページへ遷移
