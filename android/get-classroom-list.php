<?php
/**
 * @author Shinya Kinoshita
 * 教室管理アプリで教室一覧を取得する
 */
require '../DAO.php';

$dao = new DAO();
$classroom_list = [];
$classroom_list = $dao->get_classroom_list();
if (!empty($classroom_list)) {
    // jsonとして出力
    $classroom_list['count'] = strval($classroom_list['count']);
    header('content-type: application/json; charset=utf-8');
    echo json_encode($classroom_list, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
} else {
    echo false;
}
