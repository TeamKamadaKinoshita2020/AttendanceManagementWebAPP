<?php
/* Smarty version 3.1.30, created on 2017-09-25 07:48:10
  from "C:\xampp\htdocs\JS_Test\templates\view-user-info.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59c8989a7dce76_67143483',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '40550d2b06bea7e95127cf28f62e7afc9e49636e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\JS_Test\\templates\\view-user-info.tpl',
      1 => 1506318484,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_59c8989a7dce76_67143483 (Smarty_Internal_Template $_smarty_tpl) {
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
     <title>トップページ</title>
</head>
<body>
    <?php echo '<script'; ?>
>$(function() {
  $('#sorter').tablesorter();
});<?php echo '</script'; ?>
>
    <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <div class="main">
 <table id="sorter" class="tablesorter">
  <thead>
    <tr>
      <th>ユーザID
      <th>名前
      <th>名前(かな)
      <th>年齢
      <th>住所
  <tbody>
    <tr>
      <td>abc123
      <td>田中
      <td>たなか
      <td>25歳
      <td>東京都
    <tr>
      <td>abababa
      <td>鈴木
      <td>すずき
      <td>30歳
      <td>青森県
    <tr>
      <td>yama-kawa
      <td>佐藤
      <td>さとう
      <td>15歳
      <td>鹿児島県
    <tr>
      <td>sasakiki
      <td>佐々木
      <td>ささき
      <td>45歳
      <td>山梨県
    <tr>
      <td>sunnyday
      <td>山田
      <td>やまだ
      <td>19歳
      <td>長崎県
    <tr>
      <td>umi-yama
      <td>大川
      <td>おおかわ
      <td>40歳
      <td>富山県
    <tr>
      <td>nanashi
      <td>名無し
      <td>ななし
      <td>25歳
      <td>北海道
    <tr>
      <td>tora
      <td>小山
      <td>こやま
      <td>32歳
      <td>山梨県
</table>
    </div>
</body>
</html><?php }
}
