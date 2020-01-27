<?php
/**
 * @author Shinya Kinoshita
 * 出席アプリで座席番号を取得する
 */
require '../DAO.php';

$card_id = $_POST['c_id'];
$holding_id = $_POST['h_id'];

$result = [];

if ((isset($card_id))) {
    $dao = new DAO();

    $num = $dao->get_seat_info($card_id);
    $holding_info = $dao->get_holding_info($holding_id);
    // 座席番号が空でないか、不正な出席でないかを確認
    if ((!empty($num)) && ($num['room_id'] == $holding_info['room_id'])) {
        //echo $num['seat_number'];

        $result["seatNum"] = $num['seat_number'];
        header('content-type: application/json; charset=utf-8');
        echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);

    }
    //エラーならば0を返す
    else {
        $result["seatNum"] = "0";
        header('content-type: application/json; charset=utf-8');
        echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }
} else {
    $result["seatNum"] = "0";
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}
