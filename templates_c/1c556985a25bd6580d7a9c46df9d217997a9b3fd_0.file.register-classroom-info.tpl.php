<?php
/* Smarty version 3.1.30, created on 2018-06-15 10:02:27
  from "C:\xampp\htdocs\attendancesystem\templates\register-classroom-info.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b23729307ae95_22232652',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1c556985a25bd6580d7a9c46df9d217997a9b3fd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\attendancesystem\\templates\\register-classroom-info.tpl',
      1 => 1529049666,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5b23729307ae95_22232652 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_i18n')) require_once 'C:\\xampp\\htdocs\\attendancesystem\\smarty\\plugins\\function.i18n.php';
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
 type="text/javascript" src="./js/classroomEditer.js"><?php echo '</script'; ?>
> 
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/string.js"><?php echo '</script'; ?>
> 
    <title><?php echo smarty_function_i18n(array('ja'=>"新規教室登録",'en'=>"New Class"),$_smarty_tpl);?>
</title>
</head>
<body>
    <div id="wrapper">
        <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <h4><?php echo smarty_function_i18n(array('ja'=>"新規教室登録",'en'=>"New Class"),$_smarty_tpl);?>
</h4>
        <form name="form1" id="id_form1" action="">
            <?php echo smarty_function_i18n(array('ja'=>"教室名",'en'=>"Classroom name"),$_smarty_tpl);?>
:<input type="text" name="room_name" id="room_name" maxlength="20">
            <div id="space_height"></div>
            
            <div id="parent">
                <div id="layout_editer"><canvas id=canvas height="600" width=800"></canvas></div>
                <div id="space_width"></div>
                <div id="detail_editer"></div>
                <?php echo '<script'; ?>
>init();<?php echo '</script'; ?>
>
            </div>
            <div id="register"><button type = button id="register_button" onclick="registerClassroomInfo();">
                    <?php echo smarty_function_i18n(array('ja'=>"登録",'en'=>"Register"),$_smarty_tpl);?>
</button></div>
        </form>
    </div>
</body>
</html><?php }
}
