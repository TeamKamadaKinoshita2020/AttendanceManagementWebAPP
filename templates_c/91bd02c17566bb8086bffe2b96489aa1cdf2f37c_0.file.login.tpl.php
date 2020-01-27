<?php
/* Smarty version 3.1.30, created on 2018-02-23 07:42:44
  from "C:\xampp\htdocs\attendancesystem\templates\login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a8fb7e43ae2f6_94462455',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '91bd02c17566bb8086bffe2b96489aa1cdf2f37c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\attendancesystem\\templates\\login.tpl',
      1 => 1519368161,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a8fb7e43ae2f6_94462455 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_i18n')) require_once 'C:\\xampp\\htdocs\\attendancesystem\\smarty\\plugins\\function.i18n.php';
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title><?php echo smarty_function_i18n(array('ja'=>"ログイン",'en'=>"Login"),$_smarty_tpl);?>
</title>
     <link rel="stylesheet" href="comn/login.css">
</head>
<body>
    <h3><?php echo smarty_function_i18n(array('ja'=>"システムログイン",'en'=>"System Login"),$_smarty_tpl);?>
</h3>
     <div id="main">
     <form action="login.php" method="post">
     <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

     <br>
     User ID
     <br>
     <input type="text" name="id" id="id" size="15">
     <br>
     Password
     <br>
     <input type="password" name="pass" id="name" size="16">
     <br>
     <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
     <input type="submit" name="login" id="login" value=<?php echo smarty_function_i18n(array('ja'=>"ログイン",'en'=>"Login"),$_smarty_tpl);?>
 >
     </form>
     </div>
</body>
</html><?php }
}
