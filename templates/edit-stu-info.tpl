<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>学生ユーザ情報編集</title>
     <link rel="stylesheet" href="comn/base-setting.css">
     <link rel="stylesheet" href="comn/update-user.css">
     <link rel="stylesheet" href="comn/d-menu.css">
</head>
<body>
    <div id="wrapper">
        {include file='header.tpl'}{*ヘッダーとメニューの読み込み*}
        <div id="main">
            {$message}
             <form action="edit-stu-info.php" method="post">
                <h4>●変更内容の入力</h4>
                ID
                <br>
                <input type="text" value={$stu_info['user_id']} name="id" id="id"  required minlength="4" maxlength="15">
                <input type="hidden" name="before_id" value={$stu_info['user_id']}>
                <br>
                ユーザネーム
                <br>
                <input type="text" value={$stu_info['name']} name="name" id="name"  required maxlength="15">
                <br>
                所属学部{*後で複数から選択する形に変えたい 12/1*}
                <br>
                <input type="text" value={$stu_info['department']} name="department"  required maxlength="15" placeholder="例:工学部">
                <br>
                所属学科
                <br>
                <input type="text" value={$stu_info['course']} name="course"  required maxlength="15" placeholder="例:情報工学科">
                <br>
                学年
                <br>
                <input type="number" value={$stu_info['grade']} name="grade" min="1" max="9" required>年生  
                <br>
                性別
                <br>
                <input type="radio" name="select_gender" value="man"{if $stu_info['gender'] == 0}checked="checked"{/if}> 男
                <br>
                <input type="radio" name="select_gender" value="woman"{if $stu_info['gender'] == 1}checked="checked"{/if}> 女
                <br>
                <input type="radio" name="select_gender" value="other"{if $stu_info['gender'] == 2}checked="checked"{/if}> その他
                <br>
                <input type="hidden" name="token" value="{$smarty.session.token}">
                <input type="submit" name="update" id="update" value="変更を保存" >
             </form>
        </div>
    </div>
</body>
</html>