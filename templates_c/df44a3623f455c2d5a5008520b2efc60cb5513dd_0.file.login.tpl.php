<?php
/* Smarty version 3.1.30, created on 2017-09-21 08:04:28
  from "C:\xampp\htdocs\JS_Test\templates\login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59c3566c9ae7a8_83614920',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df44a3623f455c2d5a5008520b2efc60cb5513dd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\JS_Test\\templates\\login.tpl',
      1 => 1505973868,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c3566c9ae7a8_83614920 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>ログイン</title>
     <link rel="stylesheet" href="comn/login.css">
</head>
<body>
    <h3>システムログイン画面</h3>
     <div id="main">
     <form action="login.php" method="post">
     <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

     <br>
     ID
     <br>
     <input type="text" name="id" id="id" size="15">
     <br>
     パスワード
     <br>
     <input type="password" name="pass" id="name" size="16">
     <br>
     <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
     <input type="submit" name="login" id="login" value="ログイン" >
     <br>
     <input type="button" onclick="location.href='index.php'" value="トップページへ"> 
     </form>
     </div>
</body>
</html><?php }
}
