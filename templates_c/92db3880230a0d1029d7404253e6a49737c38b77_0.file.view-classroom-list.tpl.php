<?php
/* Smarty version 3.1.30, created on 2017-12-18 06:20:16
  from "C:\xampp\htdocs\attendancesystem\templates\view-classroom-list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a3750102927b0_92780959',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '92db3880230a0d1029d7404253e6a49737c38b77' => 
    array (
      0 => 'C:\\xampp\\htdocs\\attendancesystem\\templates\\view-classroom-list.tpl',
      1 => 1513574413,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5a3750102927b0_92780959 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     
     <link rel="stylesheet" href="comn/base-setting.css">
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
    <?php echo '<script'; ?>
 language="JavaScript" type="text/javascript">
    function openConfirmWin(roomId){
        var a = window.open("confirm-classroom-layout.php?room_id=" + roomId,"a","width=820,height=620,scrollbars=yes,status=no,toolbar=no,location=no,menubar=no,directories=no,resizable=yes");
        a.focus();
    }
    <?php echo '</script'; ?>
>
     <title>登録ユーザ一覧</title>
</head>
<body>
    <?php echo '<script'; ?>
>
        $(function() {
            $('#classroom-table').tablesorter();
        });
    <?php echo '</script'; ?>
>
    
    <?php echo '<script'; ?>
>
        function deleteConfirm(roomId){
            if(window.confirm("この教室情報をデータベースから削除しますか？")){
                var data = {id : roomId};
                $.ajax({
                    type: 'POST',
                    url: 'delete-classroom-info.php',
                    data: data,
                    timeout: 500,
                    success: function(data) {
                        alert("削除が完了しました");
                        window.location.href = 'view-classroom-list.php'; // 通常の遷移
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                        //エラーメッセージの表示
                        alert('Error : ' + errorThrown);
                    }
                });
            }   
        }
    <?php echo '</script'; ?>
>
    
    <div id="wrapper">
        <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <div class="main">
            <h4>登録教室一覧</h4>
             <table id="classroom-table" class="tablesorter">
              <thead>
                <tr>
                  <th>教室ID
                  <th>教室名
                  <th>
                  <?php if ($_SESSION['auth'] == TRUE) {?>
                    <th>
                    <th>
                  <?php }?>
              <tbody>
                <?php if (count($_smarty_tpl->tpl_vars['classroom_list']->value) > 0) {?>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['classroom_list']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['val']->value['room_id'];?>

                                <td><?php echo $_smarty_tpl->tpl_vars['val']->value['name'];?>

                                <td width="60"><input type="button" name="btn" value="レイアウトの確認" onclick="openConfirmWin(<?php echo $_smarty_tpl->tpl_vars['val']->value['room_id'];?>
);">
                                <?php if ($_SESSION['auth'] == TRUE) {?>
                                    <td width="60"><form action="edit-classroom-info.php" method="POST">
                                                    <input type="hidden" name="id" value=<?php echo $_smarty_tpl->tpl_vars['val']->value['room_id'];?>
>
                                                    <input type="submit" value="編集"/>
                                                    </form>
                                    <td width="60">
                                                    <input type="button" name="btn" value="削除" onclick="deleteConfirm(<?php echo $_smarty_tpl->tpl_vars['val']->value['room_id'];?>
);">
                                <?php }?>
                            </tr>
                      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                <?php }?>
            </table>
        </div>
    </div>
</body>
</html><?php }
}
