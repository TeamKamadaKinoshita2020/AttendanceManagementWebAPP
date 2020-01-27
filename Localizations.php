<?php
/**
 * phpファイル内での表示文字列の多言語化を行うファイル　参考→【http://blog.e-archi.net/2015/11/15/php-multilang/】
 * @author ShinyaKinoshita
 */

// 言語定数を定義
if (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) == 'ja') {
    define('LANG', 'ja');
} else {
    define('LANG', 'en');
}

/**
 * 表示文字列の「英語」と「日本語」を引数にし、言語設定に応じて返り値を変化させる
 * @param type $en
 * @param type $ja
 * @return type
 */
function set_multi_lang($en, $ja)
{
    $ret = array(
        'en' => $en,
        'ja' => $ja
    );
    return $ret[LANG];
}
