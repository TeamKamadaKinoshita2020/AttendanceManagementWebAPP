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
        {include file='header.tpl'}{*ヘッダーとメニューの読み込み*}
        <h4>学生ユーザ登録</h4>
            <div id="main">
            {$message}
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
                所属学部{*後で複数から選択する形に変えたい 12/1*}
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
                <input type="hidden" name="token" value="{$smarty.session.token}">
                <input type="submit" name="register" id="register" value="登録" >
             </form>
             <br>
        </div>
    </div>
</body>
</html>