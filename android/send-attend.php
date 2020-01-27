<?php
/**
 * @author Shinya Kinoshita
 * 出席用Androidアプリケーションから送られてきた出席情報(POST)をデータベースに格納する
 *  返り値の先頭になぜか"1"がくっつくホラーバグがある
 */
require '../DAO.php';

$holding_id = $_POST['h_id'];
$user_id = $_POST['u_id'];
$card_id = $_POST['c_id'];
$result = [];

if (empty($_POST['memo'])) {
    $memo = "";
} else {
    $memo = $_POST['memo'];
}
if ((isset($holding_id)) && (isset($user_id)) && (isset($card_id))) {
    $dao = new DAO();
    $num = $dao->get_seat_info($card_id);
    if (!empty($num)) {
        $dao->send_attend_info($holding_id, $user_id, $card_id, $memo);
        /*$result["result"] = "1";
        header('content-type: application/json; charset=utf-8');
        echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);*/
        echo "1";
    } else {
        /*
        $result["result"] = "0";
        header('content-type: application/json; charset=utf-8');
        echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);*/
        echo "0";
    }
} else {
    /*
    $result["result"] = "0";
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);  */
    echo "0";
}
