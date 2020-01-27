<?php
/* Smarty version 3.1.30, created on 2018-12-19 08:15:39
  from "C:\xampp\htdocs\attendancesystem\templates\view-lecture-list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5c19f01bc54a60_66824496',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83a708496bcce8605f19ec34659123dbc3532f7d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\attendancesystem\\templates\\view-lecture-list.tpl',
      1 => 1545203670,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5c19f01bc54a60_66824496 (Smarty_Internal_Template $_smarty_tpl) {
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
            $('#lecture-table').tablesorter();
        });
    <?php echo '</script'; ?>
>
    
    <?php echo '<script'; ?>
>
        function openwin(url) {
            window.open(url, "", "width=820,height=620");
        }
        
        function deleteConfirm(lectureId){
            if(window.confirm("この講義をデータベースから削除しますか？")){
                var data = {id : lectureId};
                $.ajax({
                    type: 'POST',
                    url: 'delete-lecture-info.php',
                    data: data,
                    timeout: 500,
                    success: function(data) {
                        alert("削除が完了しました");
                        window.location.href = 'view-lecture-list.php'; // 通常の遷移
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
            <h4>登録講義一覧</h4>
             <table id= lecture-table" class="tablesorter">
              <thead>
                <tr>
                  <th>講義ID
                  <th>講義名
                  <th>担当教員
                  <th>使用教室
                  <th>曜日
                  <th>時限
                  <th>開講時期
                  <th>
                  <th>
              <tbody>
                <?php if (count($_smarty_tpl->tpl_vars['lecture_list']->value) > 0) {?>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lecture_list']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['val']->value['lecture_id'];?>

                                <td><?php echo $_smarty_tpl->tpl_vars['val']->value['name'];?>

                                <td><?php echo $_smarty_tpl->tpl_vars['val']->value['rep_name'];?>

                                <td><a href="<?php echo ("confirm-classroom-layout.php?room_id=").($_smarty_tpl->tpl_vars['val']->value['room_id']);?>
" onclick="window.open('<?php echo ("confirm-classroom-layout.php?room_id=").($_smarty_tpl->tpl_vars['val']->value['room_id']);?>
', '', 'width=820,height=620'); return false;"><?php echo $_smarty_tpl->tpl_vars['val']->value['room_name'];?>
</a>
                                
                                <td><?php ob_start();
echo $_smarty_tpl->tpl_vars['val']->value['day'];
$_prefixVariable1=ob_get_clean();
if ($_prefixVariable1 == 1) {?>
                                        月
                                    <?php } else {
ob_start();
echo $_smarty_tpl->tpl_vars['val']->value['day'];
$_prefixVariable2=ob_get_clean();
if ($_prefixVariable2 == 2) {?>
                                        火
                                    <?php } else {
ob_start();
echo $_smarty_tpl->tpl_vars['val']->value['day'];
$_prefixVariable3=ob_get_clean();
if ($_prefixVariable3 == 3) {?>
                                        水
                                    <?php } else {
ob_start();
echo $_smarty_tpl->tpl_vars['val']->value['day'];
$_prefixVariable4=ob_get_clean();
if ($_prefixVariable4 == 4) {?>
                                        木
                                    <?php } else {
ob_start();
echo $_smarty_tpl->tpl_vars['val']->value['day'];
$_prefixVariable5=ob_get_clean();
if ($_prefixVariable5 == 5) {?>
                                        金
                                    <?php } else {
ob_start();
echo $_smarty_tpl->tpl_vars['val']->value['day'];
$_prefixVariable6=ob_get_clean();
if ($_prefixVariable6 == 6) {?>
                                        土
                                    <?php } else { ?>
                                        日
                                    <?php }}}}}}?>
                                    
                                <td><?php echo $_smarty_tpl->tpl_vars['val']->value['period'];?>

                                <td><?php ob_start();
echo $_smarty_tpl->tpl_vars['val']->value['season'];
$_prefixVariable7=ob_get_clean();
if ($_prefixVariable7 == 1) {?>
                                        後期
                                    <?php } else { ?>
                                        前期
                                    <?php }?>                                    
                                <td width="60"><form action="edit-lecture-info.php" method="POST">
                                                <input type="hidden" name="id" value=<?php echo $_smarty_tpl->tpl_vars['val']->value['lecture_id'];?>
>
                                                <input type="submit" value="編集"/>
                                                </form>
                                <td width="60"><input type="button" name="btn" value="削除" onclick=deleteConfirm("<?php echo $_smarty_tpl->tpl_vars['val']->value['lecture_id'];?>
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
