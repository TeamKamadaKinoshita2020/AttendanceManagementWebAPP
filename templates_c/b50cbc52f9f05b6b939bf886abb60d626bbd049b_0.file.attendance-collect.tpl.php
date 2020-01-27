<?php
/* Smarty version 3.1.30, created on 2018-06-15 10:11:43
  from "C:\xampp\htdocs\attendancesystem\templates\attendance-collect.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b2374bf82bad8_58100540',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b50cbc52f9f05b6b939bf886abb60d626bbd049b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\attendancesystem\\templates\\attendance-collect.tpl',
      1 => 1529050028,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5b2374bf82bad8_58100540 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_i18n')) require_once 'C:\\xampp\\htdocs\\attendancesystem\\smarty\\plugins\\function.i18n.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="comn/base-setting.css">
    <link rel="stylesheet" href="comn/attend-aggre.css">
    <?php echo '<script'; ?>
 src="//code.jquery.com/jquery-3.2.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/constants.js"><?php echo '</script'; ?>
>    
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/attendAggre.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/unloadAggre.js"><?php echo '</script'; ?>
> 
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/string.js"><?php echo '</script'; ?>
> 
    <title><?php echo smarty_function_i18n(array('ja'=>"出席集計",'en'=>"Attendance Collect"),$_smarty_tpl);?>
</title>
</head>
<body>
    <div id="wrapper">
    <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <form name="form1" id="id_form1" action="">
            <?php echo smarty_function_i18n(array('ja'=>"集計講義選択",'en'=>"Lecture Selection"),$_smarty_tpl);?>
:
            <?php if (count($_smarty_tpl->tpl_vars['lecture_list']->value) > 0) {?>
                <label id="label">
                    <select id="lecture_list">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lecture_list']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                            <option value=<?php echo $_smarty_tpl->tpl_vars['val']->value['lecture_id'];?>
><?php echo $_smarty_tpl->tpl_vars['val']->value['name'];?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    </select>
                </label>
                    <p id="c_button"><a href="javascript:;"><input type="button" id = "lecture_select" class="btn" value=<?php echo smarty_function_i18n(array('ja'=>"集計開始",'en'=>"StartCollect"),$_smarty_tpl);?>
 onclick="lectureStart()"></a></p>
            <?php } else { ?>
                <?php echo smarty_function_i18n(array('ja'=>"現在集計可能な講義はありません",'en'=>"There is no lectures"),$_smarty_tpl);?>

            <?php }?>
        </form>
        <div id="lecture_name"></div>
        <div id="space_height"></div>
        
        <div id="parent">
            <div id="chart"></div>
            <div id="space_width"></div>
            <div id="detail_editer"></div>
        </div>
        <div id="end_button"></div>
    </div>
</body>
</html><?php }
}
