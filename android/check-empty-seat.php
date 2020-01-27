<?php
/**
 * @author Shinya Kinoshita
 * 出席アプリで出席しようとしている座席が空かどうか調べる
 * @return 座席が空かどうか: Boolean
 */
require '../DAO.php';

$dao = new DAO();
$holding_id = $_POST['h_id'];
$card_id = $_POST['c_id'];

$result = [];

if (!empty($holding_id) && !empty($card_id)) {
    $dao = new DAO();
    if ($dao->check_empty_seat($card_id, $holding_id)) {
        $result["result"] = true;
        header('content-type: application/json; charset=utf-8');
        echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    } else {
        $result["result"] = false;
        header('content-type: application/json; charset=utf-8');
        echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }
} else {
    $result["result"] = false;
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}
