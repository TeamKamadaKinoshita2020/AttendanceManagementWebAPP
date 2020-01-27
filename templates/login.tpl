<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>{i18n ja="ログイン" en="Login"}</title>
     <link rel="stylesheet" href="comn/login.css">
</head>
<body>
    <h3>{i18n ja="システムログイン" en="System Login"}</h3>
     <div id="main">
     <form action="login.php" method="post">
     {$message}
     <br>
     User ID
     <br>
     <input type="text" name="id" id="id" size="15">
     <br>
     Password
     <br>
     <input type="password" name="pass" id="name" size="16">
     <br>
     <input type="hidden" name="token" value="{$smarty.session.token}">
     <input type="submit" name="login" id="login" value={i18n ja="ログイン" en="Login"} >
     </form>
     </div>
</body>
</html>