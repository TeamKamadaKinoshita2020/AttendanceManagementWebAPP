<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="comn/base-setting.css">
    <link rel="stylesheet" href="comn/attend-aggre.css">
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>{*jQueryの読み込み*}
    <script type="text/javascript" src="./js/constants.js"></script>    
    <script type="text/javascript" src="./js/attendAggre.js"></script>
    <script type="text/javascript" src="./js/unloadAggre.js"></script> 
    <script type="text/javascript" src="./js/string.js"></script> 
    <title>{i18n ja="出席集計" en="Attendance Collect"}</title>
</head>
<body>
    <div id="wrapper">
    {include file='header.tpl'}{*ヘッダーとメニューの読み込み*}
        <form name="form1" id="id_form1" action="">
            {i18n ja="集計講義選択" en="Lecture Selection"}:
            {if count($lecture_list) > 0}
                <label id="label">
                    <select id="lecture_list">
                        {foreach $lecture_list as $val}
                            <option value={$val['lecture_id']}>{$val['name']}</option>
                        {/foreach}
                    </select>
                </label>
                    <p id="c_button"><a href="javascript:;"><input type="button" id = "lecture_select" class="btn" value={i18n ja="集計開始" en="StartCollect"} onclick="lectureStart()"></a></p>
            {else}
                {i18n ja="現在集計可能な講義はありません" en="There is no lectures"}
            {/if}
        </form>
        <div id="lecture_name"></div>{*講義名、開催回が入る*}
        <div id="space_height"></div>
        <div id="parent">
            <div id="chart"></div>{*座席表が入る*}
            <div id="space_width"></div>{*空白*}
            <div id="detail_editer"></div>{*席の詳細が入る*}
        </div>
        <div id="end_button"></div>{*終了ボタンが入る*}
    </div>
</body>
</html>