{*
    ヘッダー＆ダウンメニュー部分のレイアウトファイル
    ログインしているユーザの権限に応じて表示する項目を切り替える
*}
<link rel="stylesheet" href="comn/header.css">
<link rel="stylesheet" href="comn/down-menu.css">

    <div id="parent">
        <div id="title">
            <h4>TeamKamada {i18n ja="出席管理システム" en="Attendance Management System"}</h4>{*サイトのタイトル*}
        </div>
        <div id="login_user">
            <h5>{i18n ja="ログインユーザ" en="Login User"}：{$smarty.session.name}</h5>{*ログインユーザの情報*}
        </div>
    </div>
    <div id="menu">
        <ul class="d_menu">
            <li><a href=index.php>Home</a></li>
            <li><a href="#">{i18n ja="ユーザ管理" en="Users"}</a>
                <ul>
                {if $smarty.session.position != "teacher"}{*教員ユーザはwebシステムユーザの管理はできない*}
                    <li><a href="#">{i18n ja="Webシステムユーザ" en="Web System Users"} &raquo;</a>
                        <ul>
                            {if $smarty.session.position == "administer"}{*ユーザ登録は管理者のみができる*}
                                <li><a href=register-webuser.php>{i18n ja="新規ユーザ登録" en="New Register"}</a></li>
                            {/if}
                            <li><a href=view-webuser-list.php>{i18n ja="登録ユーザ一覧" en="Users List"}</a></li>
                        </ul>
                    </li>
                {/if}
                <li><a href="#">{i18n ja="学生ユーザ" en="Student Users"} &raquo;</a>
                    <ul>
                        {if $smarty.session.position == "administer"}{*ユーザ登録は管理者のみができる*}
                            <li><a href=register-stu-info.php>{i18n ja="新規ユーザ登録" en="New Register"}</a></li>
                        {/if}
                        <li><a href=view-stuuser-list.php>{i18n ja="登録ユーザ一覧" en="Users List"}</a></li>
                    </ul>
                </li>
                </ul>
            </li>
            {if $smarty.session.position != "teacher"}{*教員ユーザは講義情報関連の登録・編集はできない*}
                <li><a href="#">{i18n ja="講義情報関連" en="Lectures"}</a>
                    <ul>
                        <li><a href="#">{i18n ja="講義情報の管理" en="Lecture"} &raquo;</a>
                            <ul>
                                <li><a href="register-lecture-info.php">{i18n ja="新規講義登録" en="New Register"}</a></li>
                                <li><a href="view-lecture-list.php">{i18n ja="登録講義一覧"  en="Lecture List"}</a></li>
                            </ul>
                        </li>
                        <li><a href="#">{i18n ja="教室情報の管理" en="Classroom"} &raquo;</a>
                            <ul>
                                <li><a href="register-classroom-info.php">{i18n ja="新規教室登録" en="New Register"}</a></li>
                                <li><a href="view-classroom-list.php">{i18n ja="登録教室一覧" en="Classroom List"}</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            {/if}
            {if $smarty.session.position != "affairs" || $smarty.session.auth}{*上位権限のない学務ユーザは出席関連の機能を使えない*}
                <li><a href="#">{i18n ja="出席関連" en="Attendance"}</a>
                    <ul>
                        {if ($smarty.session.position == "teacher" || $smarty.session.position == "administer")}{*教員か管理者ならば集計できる*}
                            <li><a href=attendance-collect.php>{i18n ja="出席集計" en="Attendance Collect"}</a></li>
                        {/if}
                        <li><a href="view-attendance-history-list.php">{i18n ja="出席履歴の確認" en="Attendance Records"}</a></li>
                    </ul>
                </li>
            {/if}
            <li><a href=logout.php>{i18n ja="ログアウト" en="Logout"}</a></li>
        </ul>
    </div>