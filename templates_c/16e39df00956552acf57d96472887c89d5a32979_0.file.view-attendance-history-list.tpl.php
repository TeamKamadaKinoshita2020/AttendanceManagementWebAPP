<?php
/* Smarty version 3.1.30, created on 2017-12-12 06:30:48
  from "C:\xampp\htdocs\JS_Test\templates\view-attendance-history-list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a2f698899f432_27719213',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '16e39df00956552acf57d96472887c89d5a32979' => 
    array (
      0 => 'C:\\xampp\\htdocs\\JS_Test\\templates\\view-attendance-history-list.tpl',
      1 => 1513056646,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5a2f698899f432_27719213 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="comn/base-setting.css">
    <link rel="stylesheet" href="comn/attend-aggre.css">
    <link rel="stylesheet" href="comn/style.css">
    <?php echo '<script'; ?>
 src="//code.jquery.com/jquery-3.2.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/attendanceHistoryChart.js"><?php echo '</script'; ?>
>    
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/constants.js"><?php echo '</script'; ?>
>    
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/unloadAggre.js"><?php echo '</script'; ?>
> 
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/message.js"><?php echo '</script'; ?>
> 
    <title>出席履歴一覧</title>
</head>
<body>
    <div id="wrapper">
    <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <form name="form1" id="id_form1" action="">
            履歴を確認する講義を選択:
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
                    <p id="c_button"><a href="javascript:;"><input type="button" id = "lecture_select" class="btn" value="選択" onclick="makeAttendanceHistoryChart()"></a></p>
            <?php } else { ?>
                講義が登録されていません
            <?php }?>
        </form>
        <div id="attendance_history_list">
        </div>
    </div>
</body>
</html><?php }
}
