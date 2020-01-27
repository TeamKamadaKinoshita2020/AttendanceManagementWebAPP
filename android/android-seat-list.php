<?php
/**
 * @author Shinya Kinoshita
 * 教室管理アプリで指定教室の座席情報を取得するファイル
 */
require '../DAO.php';

$room_id = $_POST['r_id'];
if ((isset($room_id))) {
    $dao = new DAO();
    $seat_list = $dao->get_seat_list($room_id);
    //jsonとして出力
    header('content-type: application/json; charset=utf-8');
    echo json_encode($seat_list, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
} else {
    echo 'The parameter of "request" is not found.';
}
?>

