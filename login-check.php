<?php
session_start();
$user_name = "";
$user_position = "";// ユーザの種類情報
$message = "";

// ログイン状態チェック、表示するユーザ名を代入
if (isset($_SESSION["position"]) && isset($_SESSION["name"])) {
    $user_name = htmlspecialchars($_SESSION["name"], ENT_QUOTES);
    if ($_SESSION["position"] == "administer") {
        $user_position = "管理者";
    } elseif ($_SESSION["position"] == "affairs") {
        $user_position = "学務";
    } elseif ($_SESSION["position"] == "teacher") {
        $user_position = "教員";
    }
} else {/*ログインされていなければログイン画面を表示する*/
    header("Location: logout.php") ;
}
// メッセージがある場合
if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
}

/**
 * 現在ログインしているユーザ情報と引数を比べて権限の有無をチェックする
 */
function permission_check($permission, $auth_check)
{
    //管理者でログインしていればチェックを行わない
    if ($_SESSION["position"] != ADMINISTER) {
        // 役職と権限両方のチェック
        if ($auth_check == AUTH_CHECK) {
            if (($permission != $_SESSION["position"]) || !($_SESSION["auth"])) {
                header("Location: permission-error.php");//エラーページへ遷移
            }
        }
        // 役職だけチェック
        else {
            if (($permission != $_SESSION["position"])) {
                header("Location: permission-error.php");//エラーページへ遷移
            }
        }
    }
}
