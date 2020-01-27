<?php
/* 権限エラー画面を表示する */
require 'Localizations.php';
$message = set_multi_lang("Permission error", "権限エラーです");

?>
﻿<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title><?=set_multi_lang("Permission error", "エラーページ");?></title>
</head>
<body>
    <?=$message?>
    <br>
    <a href="index.php"><?=set_multi_lang("Top Page", "トップページへ");?></a>
</body>
</html>