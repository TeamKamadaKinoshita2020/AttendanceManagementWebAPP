<?php
/* Smarty version 3.1.30, created on 2019-09-26 08:09:01
  from "C:\xampp\htdocs\attendancesystem\templates\header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5d8c55fd7f4d96_49242234',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c2d0f51dbc463b7c41492da276b6de8d3acc73d3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\attendancesystem\\templates\\header.tpl',
      1 => 1569478138,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d8c55fd7f4d96_49242234 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_i18n')) require_once 'C:\\xampp\\htdocs\\attendancesystem\\smarty\\plugins\\function.i18n.php';
?>

<link rel="stylesheet" href="comn/header.css">
<link rel="stylesheet" href="comn/down-menu.css">

    <div id="parent">
        <div id="title">
            <h4>TeamKamada <?php echo smarty_function_i18n(array('ja'=>"出席管理システム",'en'=>"Attendance Management System"),$_smarty_tpl);?>
</h4>
        </div>
        <div id="login_user">
            <h5><?php echo smarty_function_i18n(array('ja'=>"ログインユーザ",'en'=>"Login User"),$_smarty_tpl);?>
：<?php echo $_SESSION['name'];?>
</h5>
        </div>
    </div>
    <div id="menu">
        <ul class="d_menu">
            <li><a href=index.php>Home</a></li>
            
            <li><a href="#"><?php echo smarty_function_i18n(array('ja'=>"ユーザ管理",'en'=>"Users"),$_smarty_tpl);?>
</a>
                <ul>
                <?php if ($_SESSION['position'] != "teacher") {?>
                    <li><a href="#"><?php echo smarty_function_i18n(array('ja'=>"Webシステムユーザ",'en'=>"Web System Users"),$_smarty_tpl);?>
 &raquo;</a>
                        <ul>
                            <?php if ($_SESSION['position'] == "administer") {?>
                                <li><a href=register-webuser.php><?php echo smarty_function_i18n(array('ja'=>"新規ユーザ登録",'en'=>"New Register"),$_smarty_tpl);?>
</a></li>
                            <?php }?>
                            <li><a href=view-webuser-list.php><?php echo smarty_function_i18n(array('ja'=>"登録ユーザ一覧",'en'=>"Users List"),$_smarty_tpl);?>
</a></li>
                        </ul>
                    </li>
                <?php }?>
                <li><a href="#"><?php echo smarty_function_i18n(array('ja'=>"学生ユーザ",'en'=>"Student Users"),$_smarty_tpl);?>
 &raquo;</a>
                    <ul>
                        <?php if ($_SESSION['position'] == "administer") {?>
                            <li><a href=register-stu-info.php><?php echo smarty_function_i18n(array('ja'=>"新規ユーザ登録",'en'=>"New Register"),$_smarty_tpl);?>
</a></li>
                        <?php }?>
                        <li><a href=view-stuuser-list.php><?php echo smarty_function_i18n(array('ja'=>"登録ユーザ一覧",'en'=>"Users List"),$_smarty_tpl);?>
</a></li>
                    </ul>
                </li>
                </ul>
            </li>
            <?php if ($_SESSION['position'] != "teacher") {?>
                <li><a href="#"><?php echo smarty_function_i18n(array('ja'=>"講義情報関連",'en'=>"Lectures"),$_smarty_tpl);?>
</a>
                    <ul>
                        <li><a href="#"><?php echo smarty_function_i18n(array('ja'=>"講義情報の管理",'en'=>"Lecture"),$_smarty_tpl);?>
 &raquo;</a>
                            <ul>
                                <li><a href="register-lecture-info.php"><?php echo smarty_function_i18n(array('ja'=>"新規講義登録",'en'=>"New Register"),$_smarty_tpl);?>
</a></li>
                                <li><a href="view-lecture-list.php"><?php echo smarty_function_i18n(array('ja'=>"登録講義一覧",'en'=>"Lecture List"),$_smarty_tpl);?>
</a></li>
                            </ul>
                        </li>
                        <li><a href="#"><?php echo smarty_function_i18n(array('ja'=>"教室情報の管理",'en'=>"Classroom"),$_smarty_tpl);?>
 &raquo;</a>
                            <ul>
                                <li><a href="register-classroom-info.php"><?php echo smarty_function_i18n(array('ja'=>"新規教室登録",'en'=>"New Register"),$_smarty_tpl);?>
</a></li>
                                <li><a href="view-classroom-list.php"><?php echo smarty_function_i18n(array('ja'=>"登録教室一覧",'en'=>"Classroom List"),$_smarty_tpl);?>
</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            <?php }?>
            <?php if ($_SESSION['position'] != "affairs" || $_SESSION['auth']) {?>
                <li><a href="#"><?php echo smarty_function_i18n(array('ja'=>"出席関連",'en'=>"Attendance"),$_smarty_tpl);?>
</a>
                    <ul>
                        <?php if (($_SESSION['position'] == "teacher" || $_SESSION['position'] == "administer")) {?>
                            <li><a href=attendance-collect.php><?php echo smarty_function_i18n(array('ja'=>"出席集計",'en'=>"Attendance Collect"),$_smarty_tpl);?>
</a></li>
                        <?php }?>
                        <li><a href="view-attendance-history-list.php"><?php echo smarty_function_i18n(array('ja'=>"出席履歴の確認",'en'=>"Attendance Records"),$_smarty_tpl);?>
</a></li>
                    </ul>
                </li>
            <?php }?>
            <li><a href=logout.php><?php echo smarty_function_i18n(array('ja'=>"ログアウト",'en'=>"Logout"),$_smarty_tpl);?>
</a></li>
        </ul>
    </div><?php }
}
