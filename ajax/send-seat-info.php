<?php
/**
 * @author Shinya Kinoshita
 * 指定教室の座席情報を登録するファイル　座席番号、座席座標、カードIDなどが登録される
 */
require '../DAO.php';

// Ajax通信ではなく、直接URLを叩かれた場合はエラーを表示
if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
   && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    echo "このurlには直接アクセスしないでください<br>";
    echo "<a href=../index.php>トップページへ</a>";
} else {
    $room_id = $_POST['r_id'];
    $seat_number = $_POST['seat_num'];
    $point_x = $_POST['point_x'];
    $point_y = $_POST['point_y'];
    $card_id = $_POST['card_id'];
    $dao = new DAO();
    if (!empty($room_id) && !empty($seat_number) && !empty($point_x) && !empty($point_y)) {
        $dao->register_seat_info($room_id, $seat_number, $point_x, $point_y, $card_id);
    } else {
        echo false;
    }
}
