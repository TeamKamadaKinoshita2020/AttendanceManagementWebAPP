<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>講義情報登録</title>
     <link rel="stylesheet" href="comn/base-setting.css">
     <link rel="stylesheet" href="comn/register-user.css">
</head>
<script language="JavaScript" type="text/javascript">
function openConfirmWin(){
    var roomId = document.form1.classroom_list.value;
    var a = window.open("confirm-classroom-layout.php?room_id=" + roomId,"a","width=820,height=620,scrollbars=yes,status=no,toolbar=no,location=no,menubar=no,directories=no,resizable=yes");
    a.focus();
}
</script>
<body>
    <div id="wrapper">
        {include file='header.tpl'}{*ヘッダーとメニューの読み込み*}
        <h4>講義情報登録</h4>
            <div id="main">
            {$message}
             <br>
             <form name="form1" action="register-lecture-info.php" method="post">
                <h4>●情報の入力</h4>
                講義名
                <br>
                <input type="text" name="name" id="name" required maxlength="30" placeholder="例:テスト講義I">
                <br>
                担当教員
                <br>
                <select id="teacher_list" name="teacher_list">
                    {foreach $teacher_list as $val}
                        <option value={$val['user_id']}>{$val['name']}</option>
                    {/foreach}
                </select>
                <br>
                使用教室
                <br>
                <select id="classroom_list" name="classroom_list">
                    {foreach $classroom_list as $val}
                        <option value={$val['room_id']}>{$val['name']}</option>
                    {/foreach}
                </select>
                {*<button onclick="openConfirmWin()">レイアウトの確認</button>*}
                <br>
                曜日
                <br>
                <select name="day">
                    <option value="mon">月</option>
                    <option value="tue">火</option>
                    <option value="wen">水</option>
                    <option value="thu">木</option>
                    <option value="fri">金</option>
                    <option value="sat">土</option>
                </select>
                <br>
                時限
                <br>
                <select name="period">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                </select>
                限目
                <br>
                開講時期
                <br>
                <input type="radio" name="select_season" value="first"> 前期
                <br>
                <input type="radio" name="select_season" value="second"> 後期
                <br>
                <input type="hidden" name="token" value="{$smarty.session.token}">
                <input type="submit" name="register" id="register" value="登録" >
             </form>
             <br>
        </div>
    </div>
</body>
</html>