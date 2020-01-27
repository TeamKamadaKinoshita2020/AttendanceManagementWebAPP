<?php
require 'login-check.php';// 他ファイルでログイン状態のチェックを行う
require 'DAO.php';
require 'constants.php';

// Ajax通信ではなく、直接URLを叩かれた場合はエラーメッセージを表示
if (
    !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
    && (!empty($_SERVER['SCRIPT_FILENAME']) && 'json.php' === basename($_SERVER['SCRIPT_FILENAME']))
    ) {
    die('このページは直接ロードしないでください。');
}

    $room_id =$_POST['r_id'];

    $dao = new DAO();
    if (!empty($room_id)) {
        echo $dao->delete_seat_info($room_id);
    } else {
        echo false;
    }
