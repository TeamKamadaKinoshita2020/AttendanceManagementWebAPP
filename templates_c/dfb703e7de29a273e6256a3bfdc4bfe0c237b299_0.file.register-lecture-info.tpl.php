<?php
/* Smarty version 3.1.30, created on 2019-10-21 08:49:44
  from "C:\xampp\htdocs\attendancesystem\templates\register-lecture-info.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5dad5508292cd8_62019630',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dfb703e7de29a273e6256a3bfdc4bfe0c237b299' => 
    array (
      0 => 'C:\\xampp\\htdocs\\attendancesystem\\templates\\register-lecture-info.tpl',
      1 => 1571640292,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5dad5508292cd8_62019630 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>講義情報登録</title>
     <link rel="stylesheet" href="comn/base-setting.css">
     <link rel="stylesheet" href="comn/register-user.css">
</head>
<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript">
function openConfirmWin(){
    var roomId = document.form1.classroom_list.value;
    var a = window.open("confirm-classroom-layout.php?room_id=" + roomId,"a","width=820,height=620,scrollbars=yes,status=no,toolbar=no,location=no,menubar=no,directories=no,resizable=yes");
    a.focus();
}
<?php echo '</script'; ?>
>
<body>
    <div id="wrapper">
        <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <h4>講義情報登録</h4>
            <div id="main">
            <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

             <br>
             <form name="form1" action="register-lecture-info.php" method="post">
                <h4>●情報の入力</h4>
                講義名
                <br>
                <input type="text" name="name" id="name" required maxlength="30" placeholder="例:テスト講義I">
                <br>
                担当教員
                <br>
                <select id="teacher_list" name="teacher_list">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['teacher_list']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                        <option value=<?php echo $_smarty_tpl->tpl_vars['val']->value['user_id'];?>
><?php echo $_smarty_tpl->tpl_vars['val']->value['name'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                </select>
                <br>
                使用教室
                <br>
                <select id="classroom_list" name="classroom_list">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['classroom_list']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                        <option value=<?php echo $_smarty_tpl->tpl_vars['val']->value['room_id'];?>
><?php echo $_smarty_tpl->tpl_vars['val']->value['name'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                </select>
                
                <br>
                曜日
                <br>
                <select name="day">
                    <option value="mon">月</option>
                    <option value="tue">火</option>
                    <option value="wen">水</option>
                    <option value="thu">木</option>
                    <option value="fri">金</option>
                    <option value="sat">土</option>
                </select>
                <br>
                時限
                <br>
                <select name="period">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                </select>
                限目
                <br>
                開講時期
                <br>
                <input type="radio" name="select_season" value="first"> 前期
                <br>
                <input type="radio" name="select_season" value="second"> 後期
                <br>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>
">
                <input type="submit" name="register" id="register" value="登録" >
             </form>
             <br>
        </div>
    </div>
</body>
</html><?php }
}
