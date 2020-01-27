<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Webユーザ情報編集</title>
     <link rel="stylesheet" href="comn/base-setting.css">
     <link rel="stylesheet" href="comn/update-user.css">
     <link rel="stylesheet" href="comn/d-menu.css">
</head>
<body>
    <div id="wrapper">
        {include file='header.tpl'}{*ヘッダーとメニューの読み込み*}
        <div id="main">
            {$message}
             <form action="edit-webuser-info.php" method="post">
                <h4>●変更内容の入力</h4>
                ID
                <br>
                <input type="text" value={$webuser_info['user_id']} name="id" id="id" s minlength="4" maxlength="15">
                <input type="hidden" name="before_id" value={$webuser_info['user_id']}>
                <br>
                役職
                <br>
                <input type="radio" name="select" value="administer" {if $webuser_info['position']=='0'}checked="checked"{/if}> 管理者
                <input type="radio" name="select" value="affairs" {if $webuser_info['position']=='1'}checked="checked"{/if}> 学務
                <input type="radio" name="select" value="teacher" {if $webuser_info['position']=='2'}checked="checked"{/if}> 教師
                <br>
                ユーザネーム
                <br>
                <input type="text" value={$webuser_info['name']} name="name" id="name"  required maxlength="20">
                <br>
                <h5>●上位権限の有無を選択</h5>
                <input type="radio" name="select_auth" value="yes"{if $webuser_info['auth'] == 1}checked="checked"{/if}> 上位権限有り
                <br>
                <input type="radio" name="select_auth" value="no" {if $webuser_info['auth'] == 0}checked="checked"{/if}> 上位権限無し
                <br>
                <input type="hidden" name="token" value="{$smarty.session.token}">
                <input type="submit" name="update" id="update" value="変更を保存" >
                <br>
             </form>
        </div>
    </div>
</body>
</html>