<?php
/* Smarty version 3.1.30, created on 2017-12-12 06:30:54
  from "C:\xampp\htdocs\JS_Test\templates\view-attendance-history-detail.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a2f698e297163_54509070',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4be5da820141750ab13529c6bf295d71bee960b5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\JS_Test\\templates\\view-attendance-history-detail.tpl',
      1 => 1513056646,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5a2f698e297163_54509070 (Smarty_Internal_Template $_smarty_tpl) {
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
 type="text/javascript" src="./js/message.js"><?php echo '</script'; ?>
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
        操作方法(ダブルクリック：各席の詳細表示)
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
