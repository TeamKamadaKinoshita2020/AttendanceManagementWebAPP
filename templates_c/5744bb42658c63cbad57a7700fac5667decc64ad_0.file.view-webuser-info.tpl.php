<?php
/* Smarty version 3.1.30, created on 2017-09-26 06:21:02
  from "C:\xampp\htdocs\JS_Test\templates\view-webuser-info.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59c9d5af0174b1_88608434',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5744bb42658c63cbad57a7700fac5667decc64ad' => 
    array (
      0 => 'C:\\xampp\\htdocs\\JS_Test\\templates\\view-webuser-info.tpl',
      1 => 1506399658,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_59c9d5af0174b1_88608434 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     
     <link rel="stylesheet" href="comn/d-menu.css">
     <link rel="stylesheet" href="comn/style.css">
    <?php echo '<script'; ?>
 src="//code.jquery.com/jquery-3.2.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/jquery.tablesorter.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="./js/jquery.metadata.js"><?php echo '</script'; ?>
>
     <title>登録ユーザ一覧</title>
</head>
<body>
    <?php echo '<script'; ?>
>
        $(function() {
            $('#sorter').tablesorter();
        });
    <?php echo '</script'; ?>
>
    <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <div class="main">
        <h4>登録ユーザ一覧</h4>
 <table id="sorter" class="tablesorter">
  <thead>
    <tr>
      <th>ユーザID
      <th>名前
      
        <th class="{sorter:'metadata'}">役職
      
      <th>上位権限
      <th>
  <tbody>
    <?php if (count($_smarty_tpl->tpl_vars['webuser_list']->value) > 0) {?>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['webuser_list']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['val']->value['user_id'];?>

                    <td><a href='index.php'><?php echo $_smarty_tpl->tpl_vars['val']->value['name'];?>
</a>
                        
                    
                    <?php if ($_smarty_tpl->tpl_vars['val']->value['position'] == 0) {?>
                        
                            <td class="{sortValue: 0}"><span style="display: none;">0</span>管理者
                        
                    <?php } elseif ($_smarty_tpl->tpl_vars['val']->value['position'] == 1) {?>
                        
                            <td class="{sortValue: 1}"><span style="display: none;">1</span>学務
                        
                    <?php } elseif ($_smarty_tpl->tpl_vars['val']->value['position'] == 2) {?>
                        
                            <td class="{sortValue: 2}"><span style="display: none;">2</span>教師
                        
                    <?php } else { ?>
                        <td>役職無し
                    <?php }?>
                    <td><?php echo $_smarty_tpl->tpl_vars['val']->value['auth'];?>

                    <td width="60"><button>編集</button>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    <?php }?>
</table>
    </div>
</body>
</html><?php }
}
