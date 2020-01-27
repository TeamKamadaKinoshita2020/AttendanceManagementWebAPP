<?php
/* Smarty version 3.1.30, created on 2018-03-06 07:39:16
  from "C:\xampp\htdocs\attendancesystem\templates\attend-aggre.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a9e37948af772_76160305',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f04d218eefb4606abf99f1d03a00bbad4b6c7029' => 
    array (
      0 => 'C:\\xampp\\htdocs\\attendancesystem\\templates\\attend-aggre.tpl',
      1 => 1520318284,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5a9e37948af772_76160305 (Smarty_Internal_Template $_smarty_tpl) {
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
    <title>出席集計</title>
</head>
<body>
    <div id="wrapper">
    <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <form name="form1" id="id_form1" action="">
            集計講義選択:
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
                    <p id="c_button"><a href="javascript:;"><input type="button" id = "lecture_select" class="btn" value="集計開始" onclick="lectureStart()"></a></p>
            <?php } else { ?>
                現在集計可能な講義はありません
            <?php }?>
        </form>
        <div id="lecture_name"></div>
        <div id="space_height"></div>
        操作方法(ダブルクリック：各席の詳細表示)
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
