<?php
require 'login-check.php';// 他ファイルでログイン状態のチェックを行う
require 'DAO.php';
require 'constants.php';

permission_check(AFFAIRS, AUTH_CHECK);// 権限のチェック

$dao = new DAO();
$lecture_id =$_POST['id'];

$dao->delete_lecture_info($lecture_id);

header("Location: view-lecture-list.php"); // 一覧へ遷移
