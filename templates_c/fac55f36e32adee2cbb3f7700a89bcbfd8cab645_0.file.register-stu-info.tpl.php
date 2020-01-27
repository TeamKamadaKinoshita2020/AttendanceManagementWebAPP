<?php
/* Smarty version 3.1.30, created on 2017-12-26 08:07:36
  from "C:\xampp\htdocs\attendancesystem\templates\register-stu-info.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a41f538080f62_25901832',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fac55f36e32adee2cbb3f7700a89bcbfd8cab645' => 
    array (
      0 => 'C:\\xampp\\htdocs\\attendancesystem\\templates\\register-stu-info.tpl',
      1 => 1514272054,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5a41f538080f62_25901832 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>学生ユーザ登録</title>
     <link rel="stylesheet" href="comn/base-setting.css">
     <link rel="stylesheet" href="comn/register-user.css">
</head>
<body>
    <div id="wrapper">
        <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <h4>学生ユーザ登録</h4>
            <div id="main">
            <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

             <br>
             <form action="register-stu-info.php" method="post">
                <h4>●ユーザ情報の入力</h4>
                ID(学籍番号)
                <br>
                <input type="text" name="id" id="id"  required minlength="4" maxlength="15" placeholder="例:14T4099Z">
                <br>
                ユーザネーム
                <br>
                <input type="text" name="name" id="name"required maxlength="20">
                <br>
                所属学部
                <br>
                <input type="text" name="department" required maxlength="15" placeholder="例:工学部">
                <br>
                所属学科
                <br>
                <input type="text" name="course" required maxlength="15" placeholder="例:情報工学科">
                <br>
                学年
                <br>
                <input type="number" name="grade" min="1" max="9">年生    
                <br>
                性別
                <br>
                <input type="radio" name="select_gender" value="man"> 男
                <br>
                <input type="radio" name="select_gender" value="woman"> 女
                <br>
                <input type="radio" name="select_gender" value="other"> その他
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
