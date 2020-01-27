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
    <title>新規教室登録</title>
</head>
<body>
    <div id="wrapper">
        {include file='header.tpl'}{*ヘッダーとメニューの読み込み*}
        <h4>教室情報の編集</h4>
        <form name="form1" id="id_form1" action="">
            教室名:<input type="text" name="room_name" id="room_name" size="15" value={$classroom_info['name']}>
            <div id="space_height"></div>
            教室レイアウト：
            <br>
            操作方法(左クリック：席追加　　ドラッグ：席移動　　ダブルクリック：席詳細表示・編集)
            <div id="parent">
                <div id="layout_editer"><canvas id=canvas height="600" width=800"></canvas></div>{*座席表エディタが入る*}
                <div id="space_width"></div>{*空白*}
                <div id="detail_editer"></div>{*席詳細エディタが入る*}
                <script type="text/javascript">{*エディタ等の初期化処理*}
                    var data = {$seat_info|@json_encode};
                    initEdit(data,{$classroom_info['room_id']});
                </script>
            </div>
            <div id="register"><button type = button id="register_button" onclick="updateClassroomInfo();">
                    この内容で変更</button></div>{*登録ボタンが入る*}
        </form>
    </div>
</body>
</html>