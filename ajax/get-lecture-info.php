<?php
/**
 * @author Shinya Kinoshita
 * ajaxで呼び出して指定講義の情報を取得するファイル
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
        $lecture_info = $dao->get_lecture_info($lecture_id);
        $rep_info = $dao->get_webuser_info($lecture_info['user_id']);//担当教員の情報も取得する
        $lecture_info['rep_id'] = $rep_info['user_id'];
        $lecture_info['rep_name'] = $rep_info['name'];
        // jsonとして出力
        header('Content-type: application/json');
        //echo json_encode(htmlspecialchars($lecture_info), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        echo json_encode($lecture_info, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    } else {
        echo 'The parameter of "request" is not found.';
    }
}
