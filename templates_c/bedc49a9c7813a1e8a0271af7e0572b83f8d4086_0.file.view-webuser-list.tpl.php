<?php
/* Smarty version 3.1.30, created on 2017-11-07 09:22:32
  from "C:\xampp\htdocs\JS_Test\templates\view-webuser-list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a016d48cbc882_18563161',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bedc49a9c7813a1e8a0271af7e0572b83f8d4086' => 
    array (
      0 => 'C:\\xampp\\htdocs\\JS_Test\\templates\\view-webuser-list.tpl',
      1 => 1510042566,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5a016d48cbc882_18563161 (Smarty_Internal_Template $_smarty_tpl) {
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
     <title>登録ユーザ一覧</title>
</head>
<body>
    <?php echo '<script'; ?>
>
        $(function() {
            $('#webuser-table').tablesorter();
        });
    <?php echo '</script'; ?>
>
    
    <?php echo '<script'; ?>
>
        function deleteConfirm(userId){
            if(window.confirm("このユーザをデータベースから削除しますか？")){
                var data = {id : userId};
                $.ajax({
                    type: 'POST',
                    url: 'delete-webuser-info.php',
                    data: data,
                    timeout: 500,
                    success: function(data) {
                        alert("削除が完了しました");
                        window.location.href = 'view-webuser-list.php'; // 通常の遷移
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
            <h4>登録ユーザ一覧</h4>
             <table id="webuser-table" class="tablesorter">
              <thead>
                <tr>
                  <th>ユーザID
                  <th>名前
                    <th>役職
                  <th>上位権限
                  <th>
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

                                <td><?php echo $_smarty_tpl->tpl_vars['val']->value['name'];?>


                                <?php if ($_smarty_tpl->tpl_vars['val']->value['position'] == 0) {?>
                                        <td><span style="display: none;">0</span>管理者
                                <?php } elseif ($_smarty_tpl->tpl_vars['val']->value['position'] == 1) {?>
                                        <td><span style="display: none;">1</span>学務
                                <?php } elseif ($_smarty_tpl->tpl_vars['val']->value['position'] == 2) {?>
                                        <td><span style="display: none;">2</span>教師
                                <?php } else { ?>
                                    <td>役職無し
                                <?php }?>
                                <td><?php ob_start();
echo $_smarty_tpl->tpl_vars['val']->value['auth'];
$_prefixVariable1=ob_get_clean();
if ($_prefixVariable1 == 1) {?>
                                        有
                                    <?php } else {
ob_start();
echo $_smarty_tpl->tpl_vars['val']->value['auth'];
$_prefixVariable2=ob_get_clean();
if ($_prefixVariable2 == 0) {?>
                                        無
                                    <?php }}?>
                                <td width="60"><form action="edit-webuser-info.php" method="POST">
                                                <input type="hidden" name="id" value=<?php echo $_smarty_tpl->tpl_vars['val']->value['user_id'];?>
>
                                                <input type="submit" value="編集"/>
                                                </form>
                                <td width="60"><input type="button" name="btn" value="削除" onclick=deleteConfirm("<?php echo $_smarty_tpl->tpl_vars['val']->value['user_id'];?>
");>
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
