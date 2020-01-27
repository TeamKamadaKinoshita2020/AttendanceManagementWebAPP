<?php
/* Smarty version 3.1.30, created on 2017-11-07 05:54:29
  from "C:\xampp\htdocs\JS_Test\templates\comfirm-classroom-layout.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a013c8547ed96_25233151',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '80f73d84738fbf9a2a4b309a1f6d834b5485fb4b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\JS_Test\\templates\\comfirm-classroom-layout.tpl',
      1 => 1510030463,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a013c8547ed96_25233151 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <?php echo '<script'; ?>
 src="//code.jquery.com/jquery-3.2.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/constants.js"><?php echo '</script'; ?>
>    
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/message.js"><?php echo '</script'; ?>
> 
     <?php echo '<script'; ?>
 type="text/javascript" src="./js/classroomLayout.js"><?php echo '</script'; ?>
>
     <title>レイアウト確認</title>
</head>
<body>
    <div>
        <canvas id="canvas" height="600" width=800"></canvas>
    </div>
    <?php echo '<script'; ?>
>init(<?php echo $_smarty_tpl->tpl_vars['room_id']->value;?>
);<?php echo '</script'; ?>
>
</body>
</html><?php }
}
