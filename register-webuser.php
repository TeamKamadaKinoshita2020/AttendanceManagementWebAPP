<?php
require 'login-check.php';// 他ファイルでログイン状態のチェックを行う
require 'DAO.php';
require 'constants.php';

permission_check(ADMINISTER, AUTH_CHECK);// 権限のチェック

$message = "登録したい情報を入力してください";


// トークン生成
if (!isset($_POST["register"])) {
    $token = rtrim(base64_encode(openssl_random_pseudo_bytes(32)), '=');
    $_SESSION["token"] = $token;
}

// 登録ボタンが押された場合
if (isset($_POST["register"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["id"])) {  // 値が空のとき
        $message = 'ユーザーIDが未入力です。';
    } elseif (empty($_POST["pass"])) {
        $message = 'パスワードが未入力です。';
    } elseif (empty($_POST["pass2"])) {
        $message = 'パスワードが未入力です。';
    } elseif (empty($_POST["name"])) {
        $message = 'ユーザネームが未入力です。';
    } elseif (empty($_POST["select_position"])) {
        $message = '登録種類を選択してください。';
    } elseif (empty($_POST["select_auth"])) {
        $message = '権限の有無を選択してください。';
    }

    if (!empty($_POST["id"]) && !empty($_POST["pass"]) && !empty($_POST["pass2"]) && !empty($_POST["name"]) && !empty($_POST["select_position"])  && !empty($_POST["select_auth"]) && $_POST["pass"] === $_POST["pass2"]) {
        // IDとパスワードが半角英数字であるか
        if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST["id"]) || !preg_match('/^[a-zA-Z0-9]+$/', $_POST["pass"])) {
            $message = "IDとパスワードは半角英数字で入力してください。";
        }
        // ID、パスワード、ユーザ名の文字数の確認
        elseif (mb_strlen($_POST["id"]) < ID_MIN || mb_strlen($_POST["id"]) > ID_MAX || mb_strlen($_POST["pass"]) < PASSWORD_MIN || mb_strlen($_POST["pass"]) > PASSWORD_MAX  || mb_strlen($_POST["name"]) > USERNAME_MAX) {
            $message = "ID、は".ID_MIN."文字以上".ID_MAX."文字以内で
                        <br>パスワードは".PASSWORD_MIN."文字以上".PASSWORD_MAX."文字以内で
                        <br>ユーザ名は".USERNAME_MAX."文字以内で入力してください。";
        }
        // トークン一致の確認
        elseif (empty($_SESSION["token"]) || $_SESSION["token"] != $_POST["token"]) {
            $message = "トークンが一致しません。";
        } else {
            $dao = new DAO();

            // 入力したユーザID、パスワード、ユーザネームを格納
            $id = $_POST["id"];
            $pass = $_POST["pass"];
            $name = $_POST["name"];
            //上位権限のセット（yes以外は権限無しとする
            $auth;
            if ($_POST["select_auth"] == "yes") {
                $auth = 1;
            } else {
                $auth = 0;
            }
            

            if ($_POST["select_position"] == "administer") {// 管理者登録が選択された場合
                if ($dao->check_webuser_id($id)) {// 重複するIDが見つかった場合
                    $message = 'このIDは既に登録されています。';
                } else {// 登録処理
                    if ($dao->register_webuser($id, $name, $pass, 0, $auth)) {
                        header("Location: index.php");  // トップページへ遷移
                    } else {
                        $message = 'データベースでエラーが発生しました。';
                    }
                }
            } elseif ($_POST["select_position"] == "affairs") {// 学務登録が選択された場合
                if ($dao->check_webuser_id($id)) {// 重複するIDが見つかった場合
                    $message = 'このIDは既に登録されています。';
                } else {// 登録処理
                    if ($dao->register_webuser($id, $name, $pass, 1, $auth)) {
                        header("Location: index.php");  // トップページへ遷移
                    } else {
                        $message = 'データベースでエラーが発生しました。';
                    }
                }
            } elseif ($_POST["select_position"] == "teacher") {// 教員登録が選択された場合
                if ($dao->check_webuser_id($id)) {// 重複するIDが見つかった場合
                    $message = 'このIDは既に登録されています。';
                } else {// 登録処理
                    if ($dao->register_webuser($id, $name, $pass, 2, $auth)) {
                        header("Location: index.php");  // トップページへ遷移
                    } else {
                        $message = 'データベースでエラーが発生しました。';
                    }
                }
            }
        }
    } elseif ($_POST["pass"] != $_POST["pass2"]) {
        $message = '2つのパスワードが一致しません。';
    }
}


// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/Autoloader.php");
Smarty_Autoloader::register();

$smarty = new Smarty();
$smarty->assign('message', $message);
$smarty->display('register-webuser.tpl');
