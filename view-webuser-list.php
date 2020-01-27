<?php
require 'login-check.php';// 他ファイルでログイン状態のチェックを行う
require 'DAO.php';
require 'constants.php';

permission_check(AFFAIRS, AUTH_NOCHECK);

$dao = new DAO();
$webuser_list = $dao->get_webuser_list();
unset($webuser_list['count']);

// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/Autoloader.php");
Smarty_Autoloader::register();

$smarty = new Smarty();
$smarty->assign('webuser_list', $webuser_list);
$smarty->display('view-webuser-list.tpl');
