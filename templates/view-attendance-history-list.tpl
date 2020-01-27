<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="comn/base-setting.css">
    <link rel="stylesheet" href="comn/attend-aggre.css">
    <link rel="stylesheet" href="comn/style.css">
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>{*jQueryの読み込み*}
    <script type="text/javascript" src="./js/attendanceHistoryChart.js"></script>    
    <script type="text/javascript" src="./js/constants.js"></script>    
    <script type="text/javascript" src="./js/unloadAggre.js"></script> 
    <script type="text/javascript" src="./js/string.js"></script> 
    <title>出席履歴一覧</title>
</head>
<body>
    <div id="wrapper">
    {include file='header.tpl'}{*ヘッダーとメニューの読み込み*}
        <form name="form1" id="id_form1" action="">
            履歴を確認する講義を選択:
            {if count($lecture_list) > 0}
                <label id="label">
                    <select id="lecture_list">
                        {foreach $lecture_list as $val}
                            <option value={$val['lecture_id']}>{$val['name']}</option>
                        {/foreach}
                    </select>
                </label>
                    <p id="c_button"><a href="javascript:;"><input type="button" id = "lecture_select" class="btn" value="選択" onclick="makeAttendanceHistoryChart()"></a></p>
            {else}
                講義が登録されていません
            {/if}
        </form>
        <div id="attendance_history_list">
        </div>
    </div>
</body>
</html>