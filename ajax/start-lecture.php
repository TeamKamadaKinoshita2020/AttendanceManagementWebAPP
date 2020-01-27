<?php
/**
 * @author Shinya Kinoshita
 * 出席集計開始時に講義開催情報を作成するファイル
 */
require '../DAO.php';

// Ajax通信ではなく、直接URLを叩かれた場合はエラーを表示
if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
   && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    echo "このurlには直接アクセスしないでください<br>";
    echo "<a href=../index.php>トップページへ</a>";
} else {
    $l_id = $_POST['l_id'];
    $dao = new DAO();
    if (isset($l_id)) {
        if (!empty($l_id)) {
            $date = new DateTime();
            $date->modify('now');
            $date->format('Y-m-d');
            $dao->start_lecture($l_id, $date->format('Y-m-d'));
        } else {
            echo "集計の開始に失敗しました";
        }
    } else {
        echo 'The parameter of "request" is not found.';
    }
}
