<?php
require 'login-check.php';// 他ファイルでログイン状態のチェックを行う
require 'DAO.php';
require 'constants.php';

permission_check(AFFAIRS, AUTH_NOCHECK);// 権限のチェック

$room_id = $_POST['id'];
$classroom_info;
$seat_info;

if ((isset($room_id))) {
    $dao = new DAO();
    $classroom_info = $dao->get_classroom_info($room_id);
    $seat_info = $dao->get_seat_list($room_id);
} else {
    echo 'The parameter of "request" is not found.';
}

// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/Autoloader.php");
Smarty_Autoloader::register();

$smarty = new Smarty();
$smarty->assign('classroom_info', $classroom_info);
$smarty->assign('seat_info', $seat_info);
$smarty->display('edit-classroom-info.tpl');
