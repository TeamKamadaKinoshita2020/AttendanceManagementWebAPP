<?php
require 'DAO.php';

$room_id = $_GET['room_id'];
$seat_info;

if ((isset($room_id))) {
    $dao = new DAO();

    $seat_info = $dao->get_seat_list($room_id);
} else {
    echo 'The parameter of "request" is not found.';
}

// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/Autoloader.php");
Smarty_Autoloader::register();

$smarty = new Smarty();
$smarty->assign('seat_info', $seat_info);
$smarty->display('confirm-classroom-layout.tpl');
