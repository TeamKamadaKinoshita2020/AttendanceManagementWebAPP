<?php
/**
 * @author Shinya Kinoshita
 * 教室管理アプリで指定カードIDの情報を取得する
 */
require '../DAO.php';

$card_id = $_POST['c_id'];
if ((isset($card_id))) {
    $dao = new DAO();
    $result = $dao->get_card_info($card_id);
    if (empty($result['identity_id'])) {
        $result['success'] = 0;
    } else {
        $result['success'] = 1;
    }
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
} else {
    echo 'The parameter of "request" is not found.';
}
