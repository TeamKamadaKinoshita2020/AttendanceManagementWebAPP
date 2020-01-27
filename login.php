<?php
session_start();

require 'DAO.php';
require 'constants.php';
require 'Localizations.php';

// エラーメッセージの初期化
$message = set_multi_lang("Login to Your Account", "IDとパスワードを入力してください");

// トークン生成
if (!isset($_POST["login"])) {
    $token = rtrim(base64_encode(openssl_random_pseudo_bytes(32)), '=');
    $_SESSION["token"] = $token;
}

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 入力チェック
    if (empty($_POST["id"])) {  // emptyは値が空のとき
        $message = set_multi_lang("Please enter your User ID", "ユーザーIDが未入力です");
    } elseif (empty($_POST["pass"])) {
        $message = set_multi_lang("Please enter your Password", "パスワードが未入力です");
    }
    
    if (!empty($_POST["id"]) && !empty($_POST["pass"])) {
        // IDとパスワードが半角英数字であるか
        if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST["id"]) || !preg_match('/^[a-zA-Z0-9]+$/', $_POST["pass"])) {
            $message = "IDとパスワードは半角英数字で入力してください";
        }
        // ID、パスワード、ユーザ名の文字数の確認
        elseif (strlen($_POST["id"]) < ID_MIN || strlen($_POST["id"]) > ID_MAX || strlen($_POST["pass"]) < PASSWORD_MIN || strlen($_POST["pass"]) > PASSWORD_MAX) {
            $message = "ID、パスワードは4文字以上15文字以内で入力してください";
        }
        // トークン一致の確認
        elseif (empty($_SESSION["token"]) || $_SESSION["token"] != $_POST["token"]) {
            $message = "トークンが一致しません";
        } else {
            $id =$_POST["id"];
            $pass =$_POST["pass"];
            $dao = new DAO();

            if ($dao->login($id, $pass)) {
                header("Location: index.php");  // トップページへ遷移
            } else {
                $message = set_multi_lang("The User ID or Password you entered is incorrect", "IDかパスワードに誤りがあります");
            }
        }
    }
}

// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/Autoloader.php");
Smarty_Autoloader::register();

$smarty = new Smarty();
$smarty->assign('message', $message);
$smarty->display('login.tpl');
