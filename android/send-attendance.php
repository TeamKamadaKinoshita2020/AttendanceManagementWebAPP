<?php
/**
 * @author Shinya Kinoshita
 * 旧出席ファイル(send-attend)が謎バグが出るので再実装 20190909
 * @return 出席が成功したかどうか: Boolean
 * 
 */
require '../DAO.php';


$holding_id = $_POST['h_id'];
$user_id = $_POST['u_id'];
$card_id = $_POST['c_id'];
$memo = "";

$result = [];

if ((isset($holding_id)) && (isset($user_id)) && (isset($card_id))) {
    $dao = new DAO();
    $dao -> send_attend_info($holding_id, $user_id, $card_id, $memo);

    $result["result"] = true;
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
} else {
    $result["result"] = false;
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}