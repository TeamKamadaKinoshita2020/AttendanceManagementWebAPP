<?php
/* Smarty version 3.1.30, created on 2018-02-23 07:48:55
  from "C:\xampp\htdocs\attendancesystem\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a8fb957a711c4_83536709',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '51b519045ff36b66b4ff62c39e1a98e433638853' => 
    array (
      0 => 'C:\\xampp\\htdocs\\attendancesystem\\templates\\index.tpl',
      1 => 1519368534,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5a8fb957a711c4_83536709 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_i18n')) require_once 'C:\\xampp\\htdocs\\attendancesystem\\smarty\\plugins\\function.i18n.php';
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <link rel="stylesheet" href="comn/base-setting.css">
     <title><?php echo smarty_function_i18n(array('ja'=>"トップページ",'en'=>"Top Page"),$_smarty_tpl);?>
</title>
</head>
<body>
    <div id="wrapper">
        <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <div class="main">
            <?php echo smarty_function_i18n(array('ja'=>"ようこそ",'en'=>"Welcome to Top Page!"),$_smarty_tpl);?>
 <b><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</b> <?php echo smarty_function_i18n(array('ja'=>"さん"),$_smarty_tpl);?>

            <br>
            <?php echo smarty_function_i18n(array('ja'=>"上記のメニューから扱いたい機能を選択してください",'en'=>"Please select the operation from the top menu"),$_smarty_tpl);?>

        </div>
        
    </div>
</body>
</html><?php }
}
