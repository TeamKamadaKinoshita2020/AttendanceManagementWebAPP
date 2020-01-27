<?php
/**
 * @author Shinya Kinoshita
 * ajaxで呼び出して指定講義の過去の開催履歴を取得するファイル
 */
require '../DAO.php';

// Ajax通信ではなく、直接URLを叩かれた場合はエラーを表示
if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
   && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    echo "このurlには直接アクセスしないでください<br>";
    echo "<a href=../index.php>トップページへ</a>";
} else {
    $lecture_id = $_POST['l_id'];
    if ((isset($lecture_id))) {
        $dao = new DAO();
        $holding_list = $dao->get_holding_list($lecture_id);
        // jsonとして出力
        header('Content-type: application/json');
        echo json_encode($holding_list, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    } else {
        echo 'The parameter of "request" is not found.';
    }
}
