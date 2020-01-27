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
            $('#webuser-table').tablesorter();
        });
    </script>
    {literal}
    <script>
        function deleteConfirm(userId){
            if(window.confirm("このユーザをデータベースから削除しますか？")){
                var data = {id : userId};
                $.ajax({
                    type: 'POST',
                    url: 'delete-stu-info.php',
                    data: data,
                    timeout: 500,
                    success: function(data) {
                        alert("削除が完了しました");
                        window.location.href = 'view-stuuser-list.php'; // 通常の遷移
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
            <h4>登録ユーザ一覧</h4>
             <table id="stuuser-table" class="tablesorter">
              <thead>
                <tr>
                  <th>ユーザID
                  <th>名前
                  <th>所属学部
                  <th>所属学科
                  <th>学年
                  <th>性別
                  <th>
                  <th>
              <tbody>
                {if count($stuuser_list) > 0}
                      {foreach $stuuser_list as $val}
                            <tr>
                                <td>{$val['user_id']}
                                <td>{$val['name']}
                                <td>{$val['department']}
                                <td>{$val['course']}
                                <td>{$val['grade']}
                                {if $val['gender'] == 0}
                                        <td><span style="display: none;">0</span>男
                                {elseif $val['gender'] == 1}
                                        <td><span style="display: none;">1</span>女
                                {elseif $val['gender'] == 2}
                                        <td><span style="display: none;">2</span>その他
                                {else}
                                    <td>役職無し
                                {/if}
                                <td width="60"><form action="edit-stu-info.php" method="POST">
                                                <input type="hidden" name="id" value={$val['user_id']}>
                                                <input type="submit" value="編集"/>
                                                </form>
                                <td width="60"><input type="button" name="btn" value="削除" onclick=deleteConfirm("{$val['user_id']}");>
                      {/foreach}
                {/if}
            </table>
        </div>
    </div>
</body>
</html>