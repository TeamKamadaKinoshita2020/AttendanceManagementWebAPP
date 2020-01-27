<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="comn/base-setting.css">
    <link rel="stylesheet" href="comn/classroom-editer.css">
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>{*jQueryの読み込み*}
    <script type="text/javascript" src="./js/constants.js"></script>    
    <script type="text/javascript" src="./js/classroomEditer.js"></script> 
    <script type="text/javascript" src="./js/string.js"></script> 
    <title>{i18n ja="新規教室登録" en="New Class"}</title>
</head>
<body>
    <div id="wrapper">
        {include file='header.tpl'}{*ヘッダーとメニューの読み込み*}
        <h4>{i18n ja="新規教室登録" en="New Class"}</h4>
        <form name="form1" id="id_form1" action="">
            {i18n ja="教室名" en="Classroom name"}:<input type="text" name="room_name" id="room_name" maxlength="20">
            <div id="space_height"></div>
            <div id="parent">
                <div id="layout_editer"><canvas id=canvas height="600" width=800"></canvas></div>{*座席表エディタが入る*}
                <div id="space_width"></div>{*空白*}
                <div id="detail_editer"></div>{*席詳細エディタが入る*}
                <script>init();</script>{*エディタ等の初期化処理*}
            </div>
            <div id="register"><button type = button id="register_button" onclick="registerClassroomInfo();">
                    {i18n ja="登録" en="Register"}</button></div>{*登録ボタンが入る*}
        </form>
    </div>
</body>
</html>