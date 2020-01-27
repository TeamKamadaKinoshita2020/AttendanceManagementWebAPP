<?php
/**
 * @author Shinya Kinoshita
 * 出席を行おうとしている学生が出席済みかどうか調べる(座席移動かどうか)
 * @return 座席移動処理になるかどうか: Boolean
 */
require '../DAO.php';

$dao = new DAO();
$holding_id = $_POST['h_id'];
$user_id = $_POST['u_id'];

$result = [];

if (!empty($holding_id) && !empty($user_id)) {
    $dao = new DAO();
    if ($dao->check_already_attend($holding_id, $user_id)) {
        $result["result"] = true;
        header('content-type: application/json; charset=utf-8');
        echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }
    else {
        $result["result"] = false;
        header('content-type: application/json; charset=utf-8');
        echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }
} else {
    $result["result"] = false;
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}
