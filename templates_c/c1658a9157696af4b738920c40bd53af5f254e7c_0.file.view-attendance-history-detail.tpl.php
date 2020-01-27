<?php
/* Smarty version 3.1.30, created on 2018-06-15 10:22:34
  from "C:\xampp\htdocs\attendancesystem\templates\view-attendance-history-detail.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b23774a278931_01928783',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c1658a9157696af4b738920c40bd53af5f254e7c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\attendancesystem\\templates\\view-attendance-history-detail.tpl',
      1 => 1529050336,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5b23774a278931_01928783 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="comn/base-setting.css">
    <link rel="stylesheet" href="comn/classroom-editer.css">
    <?php echo '<script'; ?>
 src="//code.jquery.com/jquery-3.2.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/constants.js"><?php echo '</script'; ?>
>    
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/attendHistoryDetail.js"><?php echo '</script'; ?>
> 
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/string.js"><?php echo '</script'; ?>
> 
    <title>出席履歴詳細</title>
</head>
<body>
    <div id="wrapper">
        <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <h4>出席履歴の詳細確認</h4>
        <div id="lecture_name"></div>
        <div id="space_height"></div>
        
        <div id="parent">
            <div id="chart"><canvas id=canvas height="600" width=800"></canvas></div>
            <div id="space_width"></div>
            <div id="detail_editer"></div>
            <?php echo '<script'; ?>
 type="text/javascript">
                makeAttendanceHistory(<?php echo $_smarty_tpl->tpl_vars['holding_id']->value;?>
);
            <?php echo '</script'; ?>
>
        </div>
    </div>
</body>
</html><?php }
}
