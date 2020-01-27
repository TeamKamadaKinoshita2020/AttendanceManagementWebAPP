<?php
/* Smarty version 3.1.30, created on 2017-12-12 06:39:18
  from "C:\xampp\htdocs\JS_Test\templates\header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a2f6b86574058_82490207',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6b01385fda83c232f68c217b923155d5b42f269e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\JS_Test\\templates\\header.tpl',
      1 => 1513057157,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a2f6b86574058_82490207 (Smarty_Internal_Template $_smarty_tpl) {
?>

<link rel="stylesheet" href="comn/down-menu.css">

    <div id="header">
        <h4>出席管理システム</h4>
    </div>
    <div id="menu">
        <ul class="d_menu">
            <li><a href=index.php>HOME</a></li>
            
            <li><a href="#">システムユーザ管理</a>
                <ul>
                <li><a href="#">WEBシステムユーザ &raquo;</a>
                    <ul>
                        <li><a href=register-webuser.php>新規ユーザ登録</a></li>
                        <li><a href=view-webuser-list.php>登録ユーザ一覧</a></li>
                    </ul>
                </li>
                <li><a href="#">学生ユーザ &raquo;</a>
                    <ul>
                        <li><a href=register-stu-info.php>新規ユーザ登録</a></li>
                        <li><a href=view-stuuser-list.php>登録ユーザ一覧</a></li>
                    </ul>
                </li>
                </ul>
            </li>
            <li><a href="#">講義情報関連</a>
                <ul>
                    <li><a href="#">講義情報の管理 &raquo;</a>
                        <ul>
                            <li><a href="register-classroom-info.php">新規講義登録</a></li>
                            <li><a href="view-classroom-list.php">登録講義一覧</a></li>
                        </ul>
                    </li>
                    <li><a href="#">教室情報の管理 &raquo;</a>
                        <ul>
                            <li><a href="register-classroom-info.php">新規教室登録</a></li>
                            <li><a href="view-classroom-list.php">登録教室一覧</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#">出席関連</a>
                <ul>
                    <li><a href=attend-aggre.php>出席集計</a></li>
                    <li><a href="view-attendance-history-list.php">出席履歴の確認</a></li>
                </ul>
            </li>
            <li><a href=logout.php>ログアウト</a></li>
        </ul>
    </div><?php }
}
