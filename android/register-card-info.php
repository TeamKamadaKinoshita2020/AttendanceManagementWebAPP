<?php
/**
 * @author Shinya Kinoshita
 * 管理用Androidアプリケーションから送られてきた新規カード情報(POST)をデータベースに登録する
 */
require '../DAO.php';

$card_id = $_POST['c_id'];
$identity_id = $_POST['i_id'];
$result;
if ((isset($card_id)) && (isset($identity_id))) {
    $dao = new DAO();
    $result = $dao->register_card_info($card_id, $identity_id);
    // jsonとして出力
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
} else {
    echo 'The parameter of "request" is not found.';
}
