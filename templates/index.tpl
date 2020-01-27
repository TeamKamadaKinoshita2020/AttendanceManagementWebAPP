<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <link rel="stylesheet" href="comn/base-setting.css">
     <title>{i18n ja="トップページ" en="Top Page"}</title>
</head>
<body>
    <div id="wrapper">
        {include file='header.tpl'}{*ヘッダーとメニューの読み込み*}
        <div class="main">
            {i18n ja="ようこそ" en="Welcome to Top Page!"} <b>{$user_name}{*【{$user_position}】*}</b> {i18n ja="さん"}
            <br>
            {i18n ja="上記のメニューから扱いたい機能を選択してください"
                  en="Please select the operation from the top menu"}
        </div>
        {*<div id="news">
            ・ニュース的なものをここに追加
        </div>*}
    </div>
</body>
</html>