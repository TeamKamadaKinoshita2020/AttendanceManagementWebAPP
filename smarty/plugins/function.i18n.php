<?php
/**
 * 日本語と英語の言語切り替え用プラグイン
 * @param type $params
 * @param type $smarty
 * @return type
 */
function smarty_function_i18n($params, &$smarty)
{
  //言語を取得
 $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);//_LANG; //定数の言語指定値を取得(ja,enなど)

 $output = null; //init
 if(isset($params[$lang])){
    $output = $params[$lang];
 }
 return $output;
}
