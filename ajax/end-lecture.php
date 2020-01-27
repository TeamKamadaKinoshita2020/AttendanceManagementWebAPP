<?php
/**
 * @author Shinya Kinoshita
 * 講義を終了時に出席可能講義一覧からその講義を削除するファイル
 */
require '../DAO.php';

// Ajax通信ではなく、直接URLを叩かれた場合はエラーを表示
if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
   && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    echo "このurlには直接アクセスしないでください<br>";
    echo "<a href=../index.php>トップページへ</a>";
} else {
    $holding_id = $_POST['h_id'];
    if ((isset($holding_id))) {
        $dao = new DAO();
        $dao->delete_possible_attend($holding_id);
    } else {
        echo 'The parameter of "request" is not found.';
    }
}
