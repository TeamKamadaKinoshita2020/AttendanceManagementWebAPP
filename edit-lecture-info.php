<?php
ini_set('display_errors',1);

require 'login-check.php';// 他ファイルでログイン状態のチェックを行う
require 'DAO.php';
require 'constants.php';

permission_check(AFFAIRS, AUTH_NOCHECK);// 権限のチェック

$message = "";
$dao = new DAO();
$lecture_id =$_POST['id'];
$before_id = "";
$lecture_info = [];

// トークン生成
if (!isset($_POST["update"])) {
    $token = rtrim(base64_encode(openssl_random_pseudo_bytes(32)), '=');
    $_SESSION["token"] = $token;
}

// 変更ボタンが押された場合
if (isset($_POST["update"])) {
    /*echo '<script type="text/javascript">alert("正常に変更が完了しました\n一覧ページへ移動します");</script>';
    echo'<script type="text/javascript">window.location.replace("/view-lecture-list.php")</script>';*/
    // 1. ユーザIDの入力チェック
    if (empty($_POST["name"])) {  // 値が空のとき
        $message = '講義名が未入力です。';
    } elseif (empty($_POST["teacher_list"])) {
        $message = '担当教員が未指定です。';
    } elseif (empty($_POST["classroom_list"])) {
        $message = '使用教室が未指定です。';
    } elseif (empty($_POST["day"])) {
        $message = '開催曜日が未指定です。';
    } elseif (empty($_POST["period"])) {
        $message = '開催時限が未指定です。';
    } elseif (empty($_POST["select_season"])) {
        $message = '開催時期が未選択です。';
    }

    if (!empty($_POST["name"]) && !empty($_POST["teacher_list"]) && !empty($_POST["classroom_list"]) && !empty($_POST["day"]) && !empty($_POST["period"]) && !empty($_POST["select_season"])) {
        // 講義名の文字数の確認
        if (mb_strlen($_POST["name"]) > LECTURENAME_MAX) {
            $message = "講義名は".LECTURENAME_MAX."文字以内で入力してください。";
        }
        // トークン一致の確認
        else if (empty($_SESSION["token"]) || $_SESSION["token"] != $_POST["token"]) {
            $message = "トークンが一致しません。";
        } else {
            $dao = new DAO();

            // 入力した内容を格納
            $name = $_POST["name"];
            $rep_id = $_POST["teacher_list"];
            $room_id = $_POST["classroom_list"];
            $day = check_select_day($_POST["day"]);
            $period = $_POST["period"];
            $season;
            if ($_POST["select_season"] == "first") {
                if ($dao->update_lecture_info($room_id, $rep_id, $name, $day, $period, 0, $lecture_id)) {
                    echo '<script type="text/javascript">alert("正常に変更が完了しました\n一覧ページへ移動します");</script>';
                    echo'<script type="text/javascript">window.location.replace("view-lecture-list.php")</script>';
                    //header("Location: view-lecture-list.php");  // 一覧ページへ遷移
                } else {
                    $message = 'データベースでエラーが発生しました。';
                }
            } elseif ($_POST["select_season"] == "second") {
                if ($dao->update_lecture_info($room_id, $rep_id, $name, $day, $period, 1, $lecture_id)) {
                    echo '<script type="text/javascript">alert("正常に変更が完了しました\n一覧ページへ移動します");</script>';
                    echo'<script type="text/javascript">window.location.replace("view-lecture-list.php")</script>';
                    //header("Location: view-lecture-list.php");  // 一覧ページへ遷移
                } else {
                    $message = 'データベースでエラーが発生しました。';
                }
            }
        }
    }
}


$dao = new DAO();

// 講義情報の取得
$lecture_info = $dao->get_lecture_info($lecture_id);

// 教員と教室の情報を取得
$webuser_list = $dao->get_webuser_list();
$teacher_list = [];
$i=0;
for ($i = 0;$i < $webuser_list['count'];$i++) {
    if ($webuser_list[$i]['position'] == 2) {
        array_push($teacher_list, $webuser_list[$i]);
    }
}
$classroom_list = $dao->get_classroom_list();

// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/Autoloader.php");
Smarty_Autoloader::register();

$smarty = new Smarty();
$smarty->assign('lecture_info', $lecture_info);
$smarty->assign('teacher_list', $teacher_list);
$smarty->assign('classroom_list', $classroom_list);
$smarty->assign('message', $message);
$smarty->display('edit-lecture-info.tpl');

/**
 * 曜日の判定を行う
 */
function check_select_day($post)
{
    $value = 0;
    if ($post == "mon") {
        $value = 1;
    } elseif ($post == "tue") {
        $value = 2;
    } elseif ($post == "wen") {
        $value = 3;
    } elseif ($post == "thu") {
        $value = 4;
    } elseif ($post == "fri") {
        $value = 5;
    } elseif ($post == "sat") {
        $value = 6;
    }
    
    return $value;
}
