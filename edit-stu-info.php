<?php
require 'login-check.php';// 他ファイルでログイン状態のチェックを行う
require 'DAO.php';
require 'constants.php';

permission_check(ADMINISTER, AUTH_CHECK);// 権限のチェック

$message = "";
$dao = new DAO();
$user_id =$_POST['id'];
$before_id = "";
$webuser_info = [];

// トークン生成
if (!isset($_POST["update"])) {
    $token = rtrim(base64_encode(openssl_random_pseudo_bytes(32)), '=');
    $_SESSION["token"] = $token;
}

// 登録ボタンが押された場合
if (isset($_POST["update"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["id"])) {  // 値が空のとき
        $message = 'ユーザーIDが未入力です。';
    } elseif (empty($_POST["name"])) {
        $message = 'ユーザネームが未入力です。';
    } elseif (empty($_POST["department"])) {
        $message = '所属学部が未入力です。';
    } elseif (empty($_POST["course"])) {
        $message = '所属学科が未入力です。';
    } elseif (empty($_POST["grade"])) {
        $message = '学年が未入力です。';
    } elseif (empty($_POST["select_gender"])) {
        $message = '性別を選択してください。';
    }

    if (!empty($_POST["id"]) && !empty($_POST["name"]) && !empty($_POST["department"]) && !empty($_POST["course"]) && !empty($_POST["grade"]) && !empty($_POST["select_gender"])) {
        // IDとパスワードが半角英数字であるか
        if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST["id"])) {
            $message = "IDは半角英数字で入力してください。";
        }
        // ID、パスワード、ユーザ名の文字数の確認
        elseif (mb_strlen($_POST["id"]) < ID_MIN || mb_strlen($_POST["id"]) > ID_MAX || mb_strlen($_POST["name"]) > USERNAME_MAX) {
            $message = "IDは".ID_MIN."文字以上".ID_MAX."文字以内で
                        <br>ユーザ名は".USERNAME_MAX."文字以内で入力してください。";
        }
        // トークン一致の確認
        elseif (empty($_SESSION["token"]) || $_SESSION["token"] != $_POST["token"]) {
            $message = "トークンが一致しません。";
        } else {
            $dao = new DAO();

            // 入力した内容を格納
            $id = $_POST["id"];
            $name = $_POST["name"];
            $department = $_POST["department"];
            $course = $_POST["course"];
            $grade = $_POST["grade"];
            $gender = $_POST["select_gender"];
            
            $before_id =$_POST['before_id'];
   
            
            if ($gender == "man") {// 男性が選択された場合
                if ($dao->check_stu_id($id) && $user_id != $before_id) {// 重複するIDが見つかった場合
                    $message = 'このIDは既に登録されています。';
                } else {// 登録処理
                    if ($dao->update_stu_info($id, $name, $department, $course, $grade, 0, $before_id)) {
                        header("Location: view-stuuser-list.php");  // トップページへ遷移
                    } else {
                        $message = 'データベースでエラーが発生しました。';
                    }
                }
            } elseif ($gender== "woman") {// 女性が選択された場合
                if ($dao->check_stu_id($id) && $user_id != $before_id) {// 重複するIDが見つかった場合
                    $message = 'このIDは既に登録されています。';
                } else {// 登録処理
                    if ($dao->update_stu_info($id, $name, $department, $course, $grade, 1, $before_id)) {
                        header("Location: view-stuuser-list.php");  // トップページへ遷移
                    } else {
                        $message = 'データベースでエラーが発生しました。';
                    }
                }
            } elseif ($gender == "other") {// その他が選択された場合
                if ($dao->check_stu_id($id) && $user_id != $before_id) {// 重複するIDが見つかった場合
                    $message = 'このIDは既に登録されています。';
                } else {// 登録処理
                    if ($dao->update_stu_info($id, $name, $department, $course, $grade, 2, $before_id)) {
                        header("Location: view-stuuser-list.php");  // トップページへ遷移
                    } else {
                        $message = 'データベースでエラーが発生しました。';
                    }
                }
            }
        }
    }
    $stu_info = $dao->get_stu_info($_POST["before_id"]);// 失敗用にもう一度取得
} else {
    if (isset($user_id)) {
        $stu_info = $dao->get_stu_info($user_id);
    } else {
        $message = "登録ユーザ情報が存在しません";
    }
}

// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/Autoloader.php");
Smarty_Autoloader::register();

$smarty = new Smarty();
$smarty->assign('stu_info', $stu_info);
$smarty->assign('message', $message);
$smarty->display('edit-stu-info.tpl');
