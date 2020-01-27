<?php
/* Smarty version 3.1.30, created on 2017-12-12 09:19:08
  from "C:\xampp\htdocs\attendancesystem\templates\edit-classroom-info.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a2f90fce73d30_71380987',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d2a2930953cd49456776efe3e678a77e582e8d5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\attendancesystem\\templates\\edit-classroom-info.tpl',
      1 => 1511154942,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5a2f90fce73d30_71380987 (Smarty_Internal_Template $_smarty_tpl) {
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
 type="text/javascript" src="./js/message.js"><?php echo '</script'; ?>
> 
    <title>新規教室登録</title>
</head>
<body>
    <div id="wrapper">
        <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <h4>教室情報の編集</h4>
        <form name="form1" id="id_form1" action="">
            教室名:<input type="text" name="room_name" id="room_name" size="15" value=<?php echo $_smarty_tpl->tpl_vars['classroom_info']->value['name'];?>
>
            <div id="space_height"></div>
            教室レイアウト：
            <br>
            操作方法(左クリック：席追加　　ドラッグ：席移動　　ダブルクリック：席詳細表示・編集)
            <div id="parent">
                <div id="layout_editer"><canvas id=canvas height="600" width=800"></canvas></div>
                <div id="space_width"></div>
                <div id="detail_editer"></div>
                <?php echo '<script'; ?>
 type="text/javascript">
                    var data = <?php echo json_encode($_smarty_tpl->tpl_vars['seat_info']->value);?>
;
                    initEdit(data,<?php echo $_smarty_tpl->tpl_vars['classroom_info']->value['room_id'];?>
);
                <?php echo '</script'; ?>
>
            </div>
            <div id="register"><button type = button id="register_button" onclick="updateClassroomInfo();">
                    この内容で変更</button></div>
        </form>
    </div>
</body>
</html><?php }
}
