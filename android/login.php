<?php
/**
 * @author Shinya Kinoshita
 * 管理用Androidアプリケーションでログインを行う
 */
require '../DAO.php';

$dao = new DAO();
$user_id = $_POST['u_id'];
$pass = $_POST['pass'];
$result = [];
$result = $dao->android_login($user_id, $pass);
if (!empty($result)) {
    // jsonとして出力
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
} else {
    $result['success'] = 0;
    // jsonとして出力
    header('content-type: application/json; charset=utf-8');
    echo json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}
