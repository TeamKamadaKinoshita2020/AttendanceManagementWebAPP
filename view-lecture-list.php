<?php
require 'login-check.php';// 他ファイルでログイン状態のチェックを行う
require 'DAO.php';


$dao = new DAO();
$lecture_list = $dao->get_lecture_list();
unset($lecture_list['count']);

// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/Autoloader.php");
Smarty_Autoloader::register();

$smarty = new Smarty();
$smarty->assign('lecture_list', $lecture_list);
$smarty->display('view-lecture-list.tpl');
