<?php
require 'login-check.php';// 他ファイルでログイン状態のチェックを行う
require 'constants.php';

//学務で権限無しのユーザを蹴る
if (($_SESSION['position'] == AFFAIRS) && !($_SESSION['auth'])) {
    header("Location: permission-error.php");// エラーページへ遷移
}

$holding_id = $_POST['h_id'];

// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/Autoloader.php");
Smarty_Autoloader::register();

$smarty = new Smarty();
$smarty->assign('holding_id', $holding_id);
$smarty->display('view-attendance-history-detail.tpl');
