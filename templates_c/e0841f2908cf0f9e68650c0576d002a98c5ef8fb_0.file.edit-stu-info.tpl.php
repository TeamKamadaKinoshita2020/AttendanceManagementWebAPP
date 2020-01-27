<?php
/* Smarty version 3.1.30, created on 2017-12-26 08:08:02
  from "C:\xampp\htdocs\attendancesystem\templates\edit-stu-info.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a41f5523d4f93_22614696',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e0841f2908cf0f9e68650c0576d002a98c5ef8fb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\attendancesystem\\templates\\edit-stu-info.tpl',
      1 => 1514272037,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5a41f5523d4f93_22614696 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>学生ユーザ情報編集</title>
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

             <form action="edit-stu-info.php" method="post">
                <h4>●変更内容の入力</h4>
                ID
                <br>
                <input type="text" value=<?php echo $_smarty_tpl->tpl_vars['stu_info']->value['user_id'];?>
 name="id" id="id"  required minlength="4" maxlength="15">
                <input type="hidden" name="before_id" value=<?php echo $_smarty_tpl->tpl_vars['stu_info']->value['user_id'];?>
>
                <br>
                ユーザネーム
                <br>
                <input type="text" value=<?php echo $_smarty_tpl->tpl_vars['stu_info']->value['name'];?>
 name="name" id="name"  required maxlength="15">
                <br>
                所属学部
                <br>
                <input type="text" value=<?php echo $_smarty_tpl->tpl_vars['stu_info']->value['department'];?>
 name="department"  required maxlength="15" placeholder="例:工学部">
                <br>
                所属学科
                <br>
                <input type="text" value=<?php echo $_smarty_tpl->tpl_vars['stu_info']->value['course'];?>
 name="course"  required maxlength="15" placeholder="例:情報工学科">
                <br>
                学年
                <br>
                <input type="number" value=<?php echo $_smarty_tpl->tpl_vars['stu_info']->value['grade'];?>
 name="grade" min="1" max="9" required>年生  
                <br>
                性別
                <br>
                <input type="radio" name="select_gender" value="man"<?php if ($_smarty_tpl->tpl_vars['stu_info']->value['gender'] == 0) {?>checked="checked"<?php }?>> 男
                <br>
                <input type="radio" name="select_gender" value="woman"<?php if ($_smarty_tpl->tpl_vars['stu_info']->value['gender'] == 1) {?>checked="checked"<?php }?>> 女
                <br>
                <input type="radio" name="select_gender" value="other"<?php if ($_smarty_tpl->tpl_vars['stu_info']->value['gender'] == 2) {?>checked="checked"<?php }?>> その他
                <br>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
                <input type="submit" name="update" id="update" value="変更を保存" >
             </form>
        </div>
    </div>
</body>
</html><?php }
}
