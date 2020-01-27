<?php
/**
 * 認証、文字数制限等で用いる定数を宣言しているファイル
 * @author ShinyaKinoshita
 */

// 認証時に用いる定数
define("ADMINISTER", "administer");// 役職変数
define("AFFAIRS", "affairs");
define("TEACHER", "teacher");
define("AUTH_CHECK", 1);// 上位権限チェックを行うかどうか
define("AUTH_NOCHECK", 2);


// 入力文字列の文字数チェックに用いる
define("ID_MIN", 4);
define("ID_MAX", 15);
define("PASSWORD_MIN", 4);
define("PASSWORD_MAX", 20);
define("USERNAME_MAX", 20);

define("DEPARTMENT_MAX", 15);
define("COURSE_MAX", 15);

define("CLASSROOMNAME_MAX", 20);
define("LECTURENAME_MAX", 30);
