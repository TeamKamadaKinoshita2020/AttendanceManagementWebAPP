<?php
/* Smarty version 3.1.30, created on 2017-11-14 15:31:24
  from "C:\xampp\htdocs\JS_Test\templates\confirm-classroom-layout.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a0afe3c9532b1_61541116',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '49e66402a4ffb5fff1b07ee4ee38ce3055f8961d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\JS_Test\\templates\\confirm-classroom-layout.tpl',
      1 => 1510669880,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a0afe3c9532b1_61541116 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     
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
  type="text/javascript">
        var data = <?php echo json_encode($_smarty_tpl->tpl_vars['seat_info']->value);?>
;
        init(data);
     <?php echo '</script'; ?>
>
</body>
</html><?php }
}
