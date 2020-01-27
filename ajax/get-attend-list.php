<?php
/**
 * @author Shinya Kinoshita
 * ajaxで呼び出して指定回講義の出席リストを取得するファイル
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
        $attend_list = $dao->get_attend_list($holding_id);
        //jsonとして出力
        header('Content-type: application/json');
        echo json_encode($attend_list, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    } else {
        echo 'The parameter of "request" is not found.';
    }
}
