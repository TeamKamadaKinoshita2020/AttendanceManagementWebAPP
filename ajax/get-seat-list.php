<?php
/**
 * @author Shinya Kinoshita
 * ajaxで呼び出して指定教室の座席情報をリストで取得するファイル
 */
require '../DAO.php';

// Ajax通信ではなく、直接URLを叩かれた場合はエラーを表示
if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
   && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    echo "このurlには直接アクセスしないでください<br>";
    echo "<a href=../index.php>トップページへ</a>";
} else {
    $room_id =$_POST['r_id'];
    if ((isset($room_id))) {
        $dao = new DAO();
        $seat_list = $dao->get_seat_list($room_id);
        //jsonとして出力
        header('Content-type: application/json');
        echo json_encode($seat_list);
    } else {
        echo 'The parameter of "request" is not found.';
    }
}
