<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <link rel="stylesheet" href="comn/base-setting.css">
     <link rel="stylesheet" href="comn/style.css">
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>{*jQueryの読み込み*}
    <script type="text/javascript" src="./js/jquery.tablesorter.min.js"></script>
    <script language="JavaScript" type="text/javascript">
    function openConfirmWin(roomId){
        var a = window.open("confirm-classroom-layout.php?room_id=" + roomId,"a","width=820,height=620,scrollbars=yes,status=no,toolbar=no,location=no,menubar=no,directories=no,resizable=yes");
        a.focus();
    }
    </script>
     <title>登録ユーザ一覧</title>
</head>
<body>
    <script>
        $(function() {
            $('#classroom-table').tablesorter();
        });
    </script>
    {literal}
    <script>
        function deleteConfirm(roomId){
            if(window.confirm("この教室情報をデータベースから削除しますか？")){
                var data = {id : roomId};
                $.ajax({
                    type: 'POST',
                    url: 'delete-classroom-info.php',
                    data: data,
                    timeout: 500,
                    success: function(data) {
                        alert("削除が完了しました");
                        window.location.href = 'view-classroom-list.php'; // 通常の遷移
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
            <h4>登録教室一覧</h4>
             <table id="classroom-table" class="tablesorter">
              <thead>
                <tr>
                  <th>教室ID
                  <th>教室名
                  <th>
                  {if $smarty.session.auth == TRUE}{*上位権限がないと編集ができない*}
                    <th>
                    <th>
                  {/if}
              <tbody>
                {if count($classroom_list) > 0}
                      {foreach $classroom_list as $val}
                            <tr>
                                <td>{$val['room_id']}
                                <td>{$val['name']}
                                <td width="60"><input type="button" name="btn" value="レイアウトの確認" onclick="openConfirmWin({$val['room_id']});">
                                {if $smarty.session.auth == TRUE}{*上位権限がないと編集ができない*}
                                    <td width="60"><form action="edit-classroom-info.php" method="POST">
                                                    <input type="hidden" name="id" value={$val['room_id']}>
                                                    <input type="submit" value="編集"/>
                                                    </form>
                                    <td width="60"> <input type="button" name="btn" value="削除" onclick="deleteConfirm({$val['room_id']});">
                                {/if}
                            </tr>
                      {/foreach}
                {/if}
            </table>
        </div>
    </div>
</body>
</html>