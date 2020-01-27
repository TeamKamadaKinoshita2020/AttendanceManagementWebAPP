<?php
require 'login-check.php';//他ファイルでログイン状態のチェックを行う
// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/Autoloader.php");
Smarty_Autoloader::register();

$smarty = new Smarty();
$smarty->assign('user_name', $user_name);
$smarty->assign('message', $message);
$smarty->display('index.tpl');
