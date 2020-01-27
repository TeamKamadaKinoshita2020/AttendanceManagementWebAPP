<?php
/**
 * @author Shinya Kinoshita
 * 教室管理アプリで指定教室のレイアウトを確認するファイル
 * JSONを返すのではなくWebViewを開く処理を行う
 */
require '../DAO.php';

$room_id = $_GET['room_id'];
$seat_info;
if ((isset($room_id))) {
    $dao = new DAO();
    $seat_info = $dao->get_seat_list($room_id);
} else {
    echo 'The parameter of "request" is not found.';
}
// smartyの設定ファイル読み込み
// require_once(realpath(__DIR__) . "../smarty/Autoloader.php");
require '../smarty/Autoloader.php';
Smarty_Autoloader::register();
$smarty = new Smarty();
$smarty->assign('seat_info', $seat_info);
$smarty->display('../templates/confirm-classroom-layout.tpl');
