<?php
/* Smarty version 3.1.30, created on 2017-12-21 08:24:18
  from "C:\xampp\htdocs\attendancesystem\templates\edit-lecture-info.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a3b61a2daf912_48291592',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2076f75d0c4a1dde0c80b45ded085ae57adf4e8a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\attendancesystem\\templates\\edit-lecture-info.tpl',
      1 => 1513841054,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5a3b61a2daf912_48291592 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>講義情報の変更</title>
     <link rel="stylesheet" href="comn/base-setting.css">
     <link rel="stylesheet" href="comn/register-user.css">
</head>
<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript">
function openConfirmWin(){
    var roomId = document.form1.classroom_list.value;
    var a = window.open("confirm-classroom-layout.php?room_id=" + roomId,"a","width=820,height=620,scrollbars=yes,status=no,toolbar=no,location=no,menubar=no,directories=no,resizable=yes");
    a.focus();
}
<?php echo '</script'; ?>
>
<body>
    <div id="wrapper">
        <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <h4>講義情報の変更</h4>
            <div id="main">
            <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

             <br>
             <form name="form1" action="edit-lecture-info.php" method="post">
                <input type="hidden" name="id" value=<?php echo $_smarty_tpl->tpl_vars['lecture_info']->value['lecture_id'];?>
>
                <h4>●情報の入力</h4>
                講義名
                <br>
                <input type="text" value=<?php echo $_smarty_tpl->tpl_vars['lecture_info']->value['name'];?>
 name="name" id="name" required maxlength="30" placeholder="例:テスト講義I">
                <br>
                担当教員
                <br>
                <select id="teacher_list" name="teacher_list">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['teacher_list']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                        <option value=<?php echo $_smarty_tpl->tpl_vars['val']->value['user_id'];?>
 <?php if ($_smarty_tpl->tpl_vars['val']->value['user_id'] == $_smarty_tpl->tpl_vars['lecture_info']->value['user_id']) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['val']->value['name'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                </select>
                <br>
                使用教室
                <br>
                <select id="classroom_list" name="classroom_list">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['classroom_list']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                        <option value=<?php echo $_smarty_tpl->tpl_vars['val']->value['room_id'];?>
 <?php if ($_smarty_tpl->tpl_vars['val']->value['room_id'] == $_smarty_tpl->tpl_vars['lecture_info']->value['room_id']) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['val']->value['name'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                </select>
                
                <br>
                曜日
                <br>
                <select name="day">
                    <option value="mon" <?php if ($_smarty_tpl->tpl_vars['lecture_info']->value['day'] == 1) {?>selected="selected"<?php }?>>月</option>
                    <option value="tue" <?php if ($_smarty_tpl->tpl_vars['lecture_info']->value['day'] == 2) {?>selected="selected"<?php }?>>火</option>
                    <option value="wen" <?php if ($_smarty_tpl->tpl_vars['lecture_info']->value['day'] == 3) {?>selected="selected"<?php }?>>水</option>
                    <option value="thu" <?php if ($_smarty_tpl->tpl_vars['lecture_info']->value['day'] == 4) {?>selected="selected"<?php }?>>木</option>
                    <option value="fri" <?php if ($_smarty_tpl->tpl_vars['lecture_info']->value['day'] == 5) {?>selected="selected"<?php }?>>金</option>
                    <option value="sat" <?php if ($_smarty_tpl->tpl_vars['lecture_info']->value['day'] == 6) {?>selected="selected"<?php }?>>土</option>
                </select>
                <br>
                時限
                <br>
                <select name="period">
                    <option value="1"<?php if ($_smarty_tpl->tpl_vars['lecture_info']->value['period'] == 1) {?>selected="selected"<?php }?>>1</option>
                    <option value="2"<?php if ($_smarty_tpl->tpl_vars['lecture_info']->value['period'] == 2) {?>selected="selected"<?php }?>>2</option>
                    <option value="3"<?php if ($_smarty_tpl->tpl_vars['lecture_info']->value['period'] == 3) {?>selected="selected"<?php }?>>3</option>
                    <option value="4"<?php if ($_smarty_tpl->tpl_vars['lecture_info']->value['period'] == 4) {?>selected="selected"<?php }?>>4</option>
                    <option value="5"<?php if ($_smarty_tpl->tpl_vars['lecture_info']->value['period'] == 5) {?>selected="selected"<?php }?>>5</option>
                    <option value="6"<?php if ($_smarty_tpl->tpl_vars['lecture_info']->value['period'] == 6) {?>selected="selected"<?php }?>>6</option>
                    <option value="7"<?php if ($_smarty_tpl->tpl_vars['lecture_info']->value['period'] == 7) {?>selected="selected"<?php }?>>7</option>
                </select>
                限目
                <br>
                開講時期
                <br>
                <input type="radio" name="select_season" value="first"<?php if ($_smarty_tpl->tpl_vars['lecture_info']->value['season'] == 0) {?>checked="checked"<?php }?>> 前期
                <br>
                <input type="radio" name="select_season" value="second"<?php if ($_smarty_tpl->tpl_vars['lecture_info']->value['season'] == 1) {?>checked="checked"<?php }?>> 後期
                <br>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
                <input type="submit" name="update" id="update" value="変更を保存" >
             </form>
             <br>
        </div>
    </div>
</body>
</html><?php }
}
