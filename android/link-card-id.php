<?php
/**
 * @author Shinya Kinoshita
 * 教室管理アプリでカード情報と教室座席情報をリンクさせるためのファイル
 */
require '../DAO.php';

$dao = new DAO();
$room_id = $_POST['r_id'];
$seat_number = $_POST['seat_num'];
$card_id = $_POST['c_id'];
$result = [];
$result = $dao->register_card_id($room_id, $seat_number, $card_id);
if (!empty($result)) {
    // jsonとして出力
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
} else {
    echo false;
}
