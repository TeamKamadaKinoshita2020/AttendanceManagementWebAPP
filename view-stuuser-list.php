<?php
require 'login-check.php';// 他ファイルでログイン状態のチェックを行う
require 'DAO.php';


$dao = new DAO();
$stuuser_list = $dao->get_stu_list();

// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/Autoloader.php");
Smarty_Autoloader::register();

$smarty = new Smarty();
$smarty->assign('stuuser_list', $stuuser_list);
$smarty->display('view-stuuser-list.tpl');
