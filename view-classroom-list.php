<?php
require 'login-check.php';// 他ファイルでログイン状態のチェックを行う
require 'DAO.php';

$dao = new DAO();
$classroom_list = $dao->get_classroom_list();
unset($classroom_list['count']);

// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/Autoloader.php");
Smarty_Autoloader::register();

$smarty = new Smarty();
$smarty->assign('classroom_list', $classroom_list);
$smarty->display('view-classroom-list.tpl');
