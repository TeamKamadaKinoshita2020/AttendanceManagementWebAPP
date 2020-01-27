<?php
require 'login-check.php';// 他ファイルでログイン状態のチェックを行う
require 'DAO.php';
require 'constants.php';

permission_check(ADMINISTER, AUTH_CHECK);// 権限のチェック

$dao = new DAO();
$user_id =$_POST['id'];

$dao->delete_webuser_info($user_id);

header("Location: view-webuser-list.php"); // 一覧ページへ遷移
