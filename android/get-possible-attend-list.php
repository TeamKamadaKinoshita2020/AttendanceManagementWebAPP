<?php
/**
 * @author Shinya Kinoshita
 * 出席アプリで現在出席可能な講義一覧を取得する
 */
require '../DAO.php';

$dao = new DAO();
$possible_attend_list = [];
$possible_attend_list = $dao->get_possible_attend_list();
if (!empty($possible_attend_list)) {
    // jsonとして出力
    $possible_attend_list['count'] = strval($possible_attend_list['count']);
    header('content-type: application/json; charset=utf-8');
    echo json_encode($possible_attend_list, JSON_UNESCAPED_UNICODE) ;//json_encode($possible_attend_list);
} else {
    echo false;
}
