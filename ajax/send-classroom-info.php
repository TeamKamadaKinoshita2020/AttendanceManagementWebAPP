<?php
/**
 * @author Shinya Kinoshita
 * 新規教室情報を登録するファイル　POST値は教室名
 */
require '../DAO.php';

// Ajax通信ではなく、直接URLを叩かれた場合はエラーを表示
if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
   && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    echo "このurlには直接アクセスしないでください<br>";
    echo "<a href=../index.php>トップページへ</a>";
} else {
    $room_name = $_POST['name'];
    $dao = new DAO();
    if (!empty($room_name)) {
        $dao->register_classroom_info($room_name);
    } else {
        echo false;
    }
}
