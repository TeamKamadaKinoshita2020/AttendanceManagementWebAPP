<?php
/**
 * @author Shinya Kinoshita
 * 座席に対してメモが追加されたときそれをDBに反映させるファイル
 */
require '../DAO.php';

// Ajax通信ではなく、直接URLを叩かれた場合はエラーを表示
if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
   && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    echo "このurlには直接アクセスしないでください<br>";
    echo "<a href=../index.php>トップページへ</a>";
} else {
    $attend_id = $_POST['a_id'];
    $memo = $_POST['memo'];
    $dao = new DAO();
    if (!empty($attend_id)) {
        $dao->update_attend_info_memo($attend_id, $memo);
    } else {
        echo false;
    }
}
