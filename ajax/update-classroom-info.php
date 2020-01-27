<?php
/**
 * @author Shinya Kinoshita
 * 教室情報の更新を行うファイル
 */
require '../DAO.php';

// Ajax通信ではなく、直接URLを叩かれた場合はエラーを表示
if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
   && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    echo "このurlには直接アクセスしないでください<br>";
    echo "<a href=../index.php>トップページへ</a>";
} else {
    $room_id = $_POST['r_id'];
    $name = $_POST['name'];

    $dao = new DAO();
    if (!empty($room_id) && !empty($name)) {
        $dao->update_classroom_info($room_id, $name);
    } else {
        echo false;
    }
}
