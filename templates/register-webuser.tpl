<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Webユーザ登録</title>
     <link rel="stylesheet" href="comn/base-setting.css">
     <link rel="stylesheet" href="comn/register-user.css">
</head>
<body>
    <div id="wrapper">
        {include file='header.tpl'}{*ヘッダーとメニューの読み込み*}
        <h4>Webユーザ登録</h4>
            <div id="main">
            {$message}
             <br>
             <form action="register-webuser.php" method="post">
                <h4>●ユーザ情報の入力</h4>
                ID
                <br>
                <input type="text" pattern="^[0-9A-Za-z]+$" required autofocus name="id" id="id" minlength="4" maxlength="15">
                <br>
                パスワード
                <br>
                <input type="password" name="pass" id="pass" minlength="4" maxlength="20">
                <br>
                パスワード(再入力)
                <br>
                <input type="password" name="pass2" id="pass2" minlength="4" maxlength="20">
                <br>
                ユーザネーム
                <br>
                <input type="text" name="name" id="name" required maxlength="20">
                <h5>●ユーザの種類を選択</h5>
                <input type="radio" name="select_position" value="administer"> 管理者として登録
                <br>
                <input type="radio" name="select_position" value="affairs"> 学務として登録
                <br>
                <input type="radio" name="select_position" value="teacher" checked="checked"> 教師として登録
                <h5>●上位権限の有無を選択</h5>
                <input type="radio" name="select_auth" value="yes"> 上位権限有り
                <br>
                <input type="radio" name="select_auth" value="no" checked="checked"> 上位権限無し
                <br>
                <input type="hidden" name="token" value="{$smarty.session.token}">
                <input type="submit" name="register" id="register" value="登録" >
             </form>
             <br>
        </div>
    </div>
</body>
</html>