<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="comn/base-setting.css">
    <link rel="stylesheet" href="comn/classroom-editer.css">
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>{*jQueryの読み込み*}
    <script type="text/javascript" src="./js/constants.js"></script>    
    <script type="text/javascript" src="./js/attendHistoryDetail.js"></script> 
    <script type="text/javascript" src="./js/string.js"></script> 
    <title>出席履歴詳細</title>
</head>
<body>
    <div id="wrapper">
        {include file='header.tpl'}{*ヘッダーとメニューの読み込み*}
        <h4>出席履歴の詳細確認</h4>
        <div id="lecture_name"></div>{*講義名、開催回が入る*}
        <div id="space_height"></div>
        <div id="parent">
            <div id="chart"><canvas id=canvas height="600" width=800"></canvas></div>{*座席表が入る*}
            <div id="space_width"></div>{*空白*}
            <div id="detail_editer"></div>{*席詳細エディタが入る*}
            <script type="text/javascript">{*エディタ等の初期化処理*}
                makeAttendanceHistory({$holding_id});
            </script>
        </div>
    </div>
</body>
</html>