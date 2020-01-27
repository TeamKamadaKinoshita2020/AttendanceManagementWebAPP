<?php
/* Smarty version 3.1.30, created on 2017-12-06 07:21:32
  from "C:\xampp\htdocs\JS_Test\templates\edit-webuser-info.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a278c6c179757_27985349',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '839e683dea32e7b3f175e228e5950e4b89ac43d9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\JS_Test\\templates\\edit-webuser-info.tpl',
      1 => 1512112247,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5a278c6c179757_27985349 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Webユーザ情報編集</title>
     <link rel="stylesheet" href="comn/base-setting.css">
     <link rel="stylesheet" href="comn/update-user.css">
     <link rel="stylesheet" href="comn/d-menu.css">
</head>
<body>
    <div id="wrapper">
        <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <div id="main">
            <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

             <form action="edit-webuser-info.php" method="post">
                <h4>●変更内容の入力</h4>
                ID
                <br>
                <input type="text" value=<?php echo $_smarty_tpl->tpl_vars['webuser_info']->value['user_id'];?>
 name="id" id="id" size="15">
                <input type="hidden" name="before_id" value=<?php echo $_smarty_tpl->tpl_vars['webuser_info']->value['user_id'];?>
>
                <br>
                役職
                <br>
                <input type="radio" name="select" value="administer" <?php if ($_smarty_tpl->tpl_vars['webuser_info']->value['position'] == '0') {?>checked="checked"<?php }?>> 管理者
                <input type="radio" name="select" value="affairs" <?php if ($_smarty_tpl->tpl_vars['webuser_info']->value['position'] == '1') {?>checked="checked"<?php }?>> 学務
                <input type="radio" name="select" value="teacher" <?php if ($_smarty_tpl->tpl_vars['webuser_info']->value['position'] == '2') {?>checked="checked"<?php }?>> 教師
                <br>
                ユーザネーム
                <br>
                <input type="text" value=<?php echo $_smarty_tpl->tpl_vars['webuser_info']->value['name'];?>
 name="name" id="name" size="15">
                <br>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
                <input type="submit" name="update" id="update" value="変更を保存" >
                <br>
             </form>
        </div>
    </div>
</body>
</html><?php }
}
