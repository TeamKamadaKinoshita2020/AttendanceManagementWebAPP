<?php
require 'login-check.php';//他ファイルでログイン状態のチェックを行う
require 'DAO.php';
require 'constants.php';

permission_check(TEACHER, AUTH_NOCHECK);//権限のチェック

// smartyの設定ファイル読み込み
require_once(realpath(__DIR__) . "/smarty/Autoloader.php");
Smarty_Autoloader::register();


$dao = new DAO();
$lecture_list = $dao->get_lecture_list();

//上位権限無しの教員がログインしている場合はその教員の担当科目のみをリストにする
if ($_SESSION['position'] == TEACHER && !($_SESSION['auth'])) {
    //コピーリストを作成し初期化
    $copy_list = $lecture_list;
    $lecture_list = array();
    
    $i=0;
    for ($i = 0;$i < $copy_list['count'];$i++) {
        if ($copy_list[$i]['user_id'] == $_SESSION['user_id']) {
            array_push($lecture_list, $copy_list[$i]);
        }
    }
}

$smarty = new Smarty();

$smarty->assign('lecture_list', $lecture_list);
$smarty->display('attendance-collect.tpl');
