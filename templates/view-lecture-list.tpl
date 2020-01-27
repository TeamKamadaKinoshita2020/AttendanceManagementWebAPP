<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <link rel="stylesheet" href="comn/base-setting.css">
     <link rel="stylesheet" href="comn/style.css">
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>{*jQueryの読み込み*}
    <script type="text/javascript" src="./js/jquery.tablesorter.min.js"></script>
     <title>登録ユーザ一覧</title>
</head>
<body>
    <script>
        $(function() {
            $('#lecture-table').tablesorter();
        });
    </script>
    {literal}
    <script>
        function openwin(url) {
            window.open(url, "", "width=820,height=620");
        }
        
        function deleteConfirm(lectureId){
            if(window.confirm("この講義をデータベースから削除しますか？")){
                var data = {id : lectureId};
                $.ajax({
                    type: 'POST',
                    url: 'delete-lecture-info.php',
                    data: data,
                    timeout: 500,
                    success: function(data) {
                        alert("削除が完了しました");
                        window.location.href = 'view-lecture-list.php'; // 通常の遷移
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                        //エラーメッセージの表示
                        alert('Error : ' + errorThrown);
                    }
                });
            }   
        }
    </script>
    {/literal}
    <div id="wrapper">
        {include file='header.tpl'}{*ヘッダーとメニューの読み込み*}
        <div class="main">
            <h4>登録講義一覧</h4>
             <table id= lecture-table" class="tablesorter">
              <thead>
                <tr>
                  <th>講義ID
                  <th>講義名
                  <th>担当教員
                  <th>使用教室
                  <th>曜日
                  <th>時限
                  <th>開講時期
                  <th>
                  <th>
              <tbody>
                {if count($lecture_list) > 0}
                      {foreach $lecture_list as $val}
                            <tr>
                                <td>{$val['lecture_id']}
                                <td>{$val['name']}
                                <td>{$val['rep_name']}
                                <td><a href="{"confirm-classroom-layout.php?room_id="|cat:$val['room_id']}" onclick="window.open('{"confirm-classroom-layout.php?room_id="|cat:$val['room_id']}', '', 'width=820,height=620'); return false;">{$val['room_name']}</a>
                                <td>{if {$val['day']} == 1}
                                        月
                                    {else if {$val['day']} == 2}
                                        火
                                    {else if {$val['day']} == 3}
                                        水
                                    {else if {$val['day']} == 4}
                                        木
                                    {else if {$val['day']} == 5}
                                        金
                                    {else if {$val['day']} == 6}
                                        土
                                    {else}
                                        日
                                    {/if}
                                    
                                <td>{$val['period']}
                                <td>{if {$val['season']} == 1}
                                        後期
                                    {else}
                                        前期
                                    {/if}                                    
                                <td width="60"><form action="edit-lecture-info.php" method="POST">
                                                <input type="hidden" name="id" value={$val['lecture_id']}>
                                                <input type="submit" value="編集"/>
                                                </form>
                                <td width="60"><input type="button" name="btn" value="削除" onclick=deleteConfirm("{$val['lecture_id']}");>
                      {/foreach}
                {/if}
            </table>
        </div>
    </div>
</body>
</html>