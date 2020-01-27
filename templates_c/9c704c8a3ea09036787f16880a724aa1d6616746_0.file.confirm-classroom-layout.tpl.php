<?php
/* Smarty version 3.1.30, created on 2017-12-12 08:53:47
  from "C:\xampp\htdocs\attendancesystem\templates\confirm-classroom-layout.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a2f8b0b372f37_50333520',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9c704c8a3ea09036787f16880a724aa1d6616746' => 
    array (
      0 => 'C:\\xampp\\htdocs\\attendancesystem\\templates\\confirm-classroom-layout.tpl',
      1 => 1510669880,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a2f8b0b372f37_50333520 (Smarty_Internal_Template $_smarty_tpl) {
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
