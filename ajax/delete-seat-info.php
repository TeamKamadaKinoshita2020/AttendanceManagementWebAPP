<?php
/**
 * @author Shinya Kinoshita
 * 指定教室の座席情報を削除する
 */
require '../DAO.php';

// Ajax通信ではなく、直接URLを叩かれた場合はエラーを表示
if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
   && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    echo "このurlには直接アクセスしないでください<br>";
    echo "<a href=../index.php>トップページへ</a>";
} else {
    $room_id = $_POST['r_id'];

    $dao = new DAO();
    if (!empty($room_id)) {
        echo $dao->delete_seat_info($room_id);
    } else {
        echo false;
    }
}
