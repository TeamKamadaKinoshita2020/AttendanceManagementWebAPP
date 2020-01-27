<?php
require 'login-check.php';// 他ファイルでログイン状態のチェックを行う
require 'constants.php';
permission_check(AFFAIRS, AUTH_NOCHECK);// 権限のチェック

// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/Autoloader.php");
Smarty_Autoloader::register();

$smarty = new Smarty();
$smarty->display('register-classroom-info.tpl');
