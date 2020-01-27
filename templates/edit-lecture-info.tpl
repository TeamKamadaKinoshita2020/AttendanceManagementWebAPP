<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>講義情報の変更</title>
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
        <h4>講義情報の変更</h4>
            <div id="main">
            {$message}
             <br>
             <form name="form1" action="edit-lecture-info.php" method="post">
                <input type="hidden" name="id" value={$lecture_info['lecture_id']}>
                <h4>●情報の入力</h4>
                講義名
                <br>
                <input type="text" value={$lecture_info['name']} name="name" id="name" required maxlength="30" placeholder="例:テスト講義I">
                <br>
                担当教員
                <br>
                <select id="teacher_list" name="teacher_list">
                    {foreach $teacher_list as $val}
                        <option value={$val['user_id']} {if $val['user_id'] == $lecture_info['user_id']}selected="selected"{/if}>{$val['name']}</option>
                    {/foreach}
                </select>
                <br>
                使用教室
                <br>
                <select id="classroom_list" name="classroom_list">
                    {foreach $classroom_list as $val}
                        <option value={$val['room_id']} {if $val['room_id'] == $lecture_info['room_id']}selected="selected"{/if}>{$val['name']}</option>
                    {/foreach}
                </select>
                <br>
                曜日
                <br>
                <select name="day">
                    <option value="mon" {if $lecture_info['day'] == 1}selected="selected"{/if}>月</option>
                    <option value="tue" {if $lecture_info['day'] == 2}selected="selected"{/if}>火</option>
                    <option value="wen" {if $lecture_info['day'] == 3}selected="selected"{/if}>水</option>
                    <option value="thu" {if $lecture_info['day'] == 4}selected="selected"{/if}>木</option>
                    <option value="fri" {if $lecture_info['day'] == 5}selected="selected"{/if}>金</option>
                    <option value="sat" {if $lecture_info['day'] == 6}selected="selected"{/if}>土</option>
                </select>
                <br>
                時限
                <br>
                <select name="period">
                    <option value="1"{if $lecture_info['period'] == 1}selected="selected"{/if}>1</option>
                    <option value="2"{if $lecture_info['period'] == 2}selected="selected"{/if}>2</option>
                    <option value="3"{if $lecture_info['period'] == 3}selected="selected"{/if}>3</option>
                    <option value="4"{if $lecture_info['period'] == 4}selected="selected"{/if}>4</option>
                    <option value="5"{if $lecture_info['period'] == 5}selected="selected"{/if}>5</option>
                    <option value="6"{if $lecture_info['period'] == 6}selected="selected"{/if}>6</option>
                    <option value="7"{if $lecture_info['period'] == 7}selected="selected"{/if}>7</option>
                </select>
                限目
                <br>
                開講時期
                <br>
                <input type="radio" name="select_season" value="first"{if $lecture_info['season'] == 0}checked="checked"{/if}> 前期
                <br>
                <input type="radio" name="select_season" value="second"{if $lecture_info['season'] == 1}checked="checked"{/if}> 後期
                <br>
                <input type="hidden" name="token" value="{$smarty.session.token}">
                <input type="submit" name="update" id="update" value="変更を保存" >
             </form>
             <br>
        </div>
    </div>
</body>
</html>