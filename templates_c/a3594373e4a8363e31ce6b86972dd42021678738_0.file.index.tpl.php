<?php
/* Smarty version 3.1.30, created on 2017-11-14 12:03:48
  from "C:\xampp\htdocs\JS_Test\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a0acd9487dab2_00050258',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a3594373e4a8363e31ce6b86972dd42021678738' => 
    array (
      0 => 'C:\\xampp\\htdocs\\JS_Test\\templates\\index.tpl',
      1 => 1510657427,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5a0acd9487dab2_00050258 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <link rel="stylesheet" href="comn/base-setting.css">
     <title>トップページ</title>
</head>
<body>
    <div id="wrapper">
        <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <div class="main">
            ようこそ <?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
(<?php echo $_smarty_tpl->tpl_vars['user_position']->value;?>
)さん
            <br>
            上記のメニューから扱いたい機能を選択してください
        </div>
        <div id="news">
            ・ニュース的なものをここに追加
        </div>
    </div>
</body>
</html><?php }
}
