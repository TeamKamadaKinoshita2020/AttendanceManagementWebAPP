<?php
/* Smarty version 3.1.30, created on 2017-08-28 05:08:18
  from "C:\xampp\htdocs\JS_Test\templates\attend.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59a389228b20f2_03762252',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f5494aa2613b71a5eeef57577c08bf7ef6366a4e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\JS_Test\\templates\\attend.tpl',
      1 => 1503889690,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59a389228b20f2_03762252 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>出席フォーム</title>
</head>
<body>
    <?php echo '<script'; ?>
 src="//code.jquery.com/jquery-3.2.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/aj.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/jQ.js"><?php echo '</script'; ?>
>    

    <?php echo '<script'; ?>
 type="text/javascript" src="./js/seatList.js"><?php echo '</script'; ?>
> 
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/attend.js"><?php echo '</script'; ?>
> 

    <h1>出席システム　出席フォーム</h1>


    
    

    <form name="attend_form" id="attend_form" action="">
        
        
        出席可能講義:
        <?php if (count($_smarty_tpl->tpl_vars['possible_attend_list']->value) > 0) {?>
            <select id="possible_attend">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['possible_attend_list']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                    <option value=<?php echo $_smarty_tpl->tpl_vars['val']->value['holding_id'];?>
><?php echo $_smarty_tpl->tpl_vars['val']->value['text'];?>
</option>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </select>
        <?php } else { ?>
            現在開講中の講義はありません
        <?php }?>
        <br>
        名前：<input type="text" id ="name" value="">
        <br>
        学籍番号：<input type="text" id ="user_id" value="">
        <br>
        カードID：<input type="text" id ="card_id" value="">
        <br>
        
        メモ：<input type="text" id ="memo" value="">
        <br>
           <p id="c_button"><a href="javascript:;"><input type="button" id = "attend" value="出席"></a></p>
    </form>
    <p><span></span></p>
    <div id="seat_list"></div>
    <br>
    <div id="message"></div>
</body>
</html><?php }
}
