/**
 * @fileOverview 指定された講義の出席履歴一覧表のhtmlを作成、出力する
 * @author ShinyaKinoshita
 */

/** 講義に関する情報を持つクラス　*/
var Lecture = function (lectureId, name, repId, repName) {
    this.lectureId = lectureId;// 講義ID
    this.name = name;
    this.repId = repId;// 担当教員のID
    this.repName = repName;// 担当教員の名前
    this.holdingId = [];// 各開催回の開催ID
    this.holdingCount = 0;// 開催回数
}

/** 学生に関する情報を持つクラス　*/
var Student = function (userId, name, holdingCount) {
    this.userId = userId;// 学籍番号
    this.name = name;
    this.attend = (new Array(holdingCount)).fill(0);// 各開催回での出席の有無 欠席→0 出席→1
    this.attendCount = 0;// 出席回数　初期値は全欠席なので0
}


/** 変数の宣言 */
var chart = "";// 出席履歴表のhtmlが格納される
var lectureInfo;
var stuInfo;
var stuCount = 0;
var attendInfo = [];// 各回(1～n回)の出席状況が入る

/**
 * 指定講義に出席した全学生の出席情報を取得し表で表示するメソッド
 */
function makeAttendanceHistoryChart() {
    var lectureInfo;
    var stuInfo = [];

    if (window.confirm(string.confirm_attend_history_list[lang] + $('#lecture_list :selected').text())) {// 開始の確認
        var data = { l_id: $('#lecture_list :selected').val() };
        /**
         * 指定された講義情報の取得を行う
         */
        /**
         * Ajax通信メソッド
         * @param type  : HTTP通信の種類
         * @param url   : リクエスト送信先のURL
         * @param data  : サーバに送信する値
         */
        $.ajax({
            type: "POST",
            url: "ajax/get-lecture-info.php",
            data: data,
            timeout: 500,
            /**
             * Ajax通信が成功した場合に呼び出されるメソッド
             */
            success: function (result, dataType) {
                // 変数resultに結果が格納されている
                // console.log(result);
                lectureInfo = new Lecture(result['lecture_id'], result['name'], result['rep_id'], result['rep_name']);
                /**
                 * 過去の開催情報リストの取得を行う
                 */
                $.ajax({
                    type: "POST",
                    url: "ajax/get-holding-list.php",
                    data: data,
                    timeout: 500,

                    success: function (result, dataType) {
                        // 講義情報に開催情報を格納
                        // console.log(result);//デバッグ
                        lectureInfo.holdingCount = result['count'];
                        for (var i = 0; i < lectureInfo.holdingCount; i++) {
                            lectureInfo.holdingId[i] = result[i]['holding_id'];
                            // console.log(lectureInfo.holdingId[i]);//デバッグ
                        }
                        /**
                         * ajax(同期通信)で各開催回での出席情報を取得する
                         */
                        for (var i = 0; i < lectureInfo.holdingCount; i++) {
                            attendInfo[i] = getAttendList(lectureInfo.holdingId[i]).responseJSON;
                            /**
                             * 第i回での出席状況をチェックする
                             */
                            for (var j = 0; j < attendInfo[i]['count']; j++) {
                                console.log(attendInfo[i][j]['user_id']);
                                // 第i回の出席リストのj人目に配列stuInfoに格納された学生が存在するかどうか
                                if (searchAttendStudent(attendInfo[i][j], stuInfo) != -1) {// 存在すれば第i回を出席扱いにする
                                    var searchResult = searchAttendStudent(attendInfo[i][j], stuInfo);
                                    stuInfo[searchResult].attend[i] = 1;
                                    stuInfo[searchResult].attendCount++;
                                }
                                else {// 存在しなければ追加で学生情報を作成する
                                    stuInfo[stuInfo.length] = new Student(attendInfo[i][j]['user_id'], attendInfo[i][j]['name'], lectureInfo.holdingCount);
                                    stuInfo[stuInfo.length - 1].attend[i] = 1;
                                    stuInfo[stuInfo.length - 1].attendCount++;
                                }
                            }
                        }

                        for (var i = 0; i < stuInfo.length; i++) {
                        }
                        chart = makeChartHtml(lectureInfo, stuInfo);
                        $("#attendance_history_list").empty();// 追加部分の初期化
                        $('#attendance_history_list').append(chart);

                    },
                    /*
                     * 開催情報取得失敗時の処理
                     */
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        // エラーメッセージの表示
                        alert('Error : ' + errorThrown);
                    }
                }
                );
            },
            /*
            * 講義情報取得失敗時の処理
            */
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                // エラーメッセージの表示
                alert('Error : ' + errorThrown);
            }
        }
        );
        // サブミット後、ページをリロードしないようにする
        return false;
    }
}

/**
 * 指定回講義の出席状況をajaxで取得し返すメソッド
 * @param {type} holdingId 指定回の開催ID
 * @returns result; 出席状況のJSON
 */
function getAttendList(holdingId) {
    var data = { h_id: holdingId };
    return $.ajax({
        type: "POST",
        url: "ajax/get-attend-list.php",
        data: data,
        timeout: 500,
        async: false// データをきちんと取るため同期通信化(あまりやりたくないけど)
    });
}
/**
 * 出席情報取得後に実行される処理
 */
getAttendList().done(function (result) {
    console.log(result);
    return result.responseJSON.value;
}).fail(function () {
    alert("出席情報の取得に失敗しました");
});

/**
 * 1つの出席情報と学生情報配列を比較し出席学生の情報が既に配列に追加されているかどうかチェックする
 * @param {type} attendInfo
 * @param {type} stuInfo
 * @returns {Number} 配列の何番目に該当生徒がいるか返す　いなければ-1を返す
 */
function searchAttendStudent(attendInfo, stuInfo) {
    for (var j = 0; j < stuInfo.length; j++) {
        if (attendInfo['user_id'] === stuInfo[j].userId) {
            return j;// 該当あり
        }
    }
    // console.log("該当なし！ｗｗ");
    return -1;// 該当なし
}

/**
 * 指定講義の出席履歴表htmlを作成し返すメソッド
 * @param {type} lectureInfo 指定講義の情報
 * @param {type} stuInfo その講義に1回でも出席した学生情報の配列
 * @returns {String} 履歴表のhtml
 */
function makeChartHtml(lectureInfo, stuInfo) {
    var html = "";
    // 1回も開催されていない場合
    if (lectureInfo.holdingCount == 0) {
        alert("講義の履歴がありません");
        html += "<b>講義の履歴がありません</b>"
    }
    // 開催履歴があれば表の作成を行う
    else {
        /**
         * 授業名、表の列部分の作成
         */
        html += "<h4>" + lectureInfo.name + " 担当教員:" + lectureInfo.repName + "</h4>";
        html += "<table id=stuuser-table class=tablesorter>\n\
                  <thead>\n\
                    <tr>\n\
                      <th>学籍番号\n\
                      <th>名前\n";
        html += "<form action=view-attendance-history-detail.php method=post name=confirmForm target=_blank>\n\
                <input type=hidden name=h_id>\n\
                <input type=hidden name=l_id>\n\
                </form>"
        for (var i = 0; i < lectureInfo.holdingCount; i++) {
            html += "<th><a href=javascript:Post(" + lectureInfo.holdingId[i] + ")>第" + (i + 1) + "回</a>";
        }
        html += "<th>出席回数\n\
                      <tbody>";

        /**
         * 各開催回の出席人数の表示
         */
        html += "<tr>\n<td>\n<td><b>出席学生数</b>";
        for (var i = 0; i < lectureInfo.holdingCount; i++) {
            html += "<td>" + attendInfo[i]['count'] + " 人\n"
        }
        html += "</tr>";

        /**
         * 学生部分の行を作成
         */
        for (var i = 0; i < stuInfo.length; i++) {
            html += "<tr>\n";
            html += "<td>" + stuInfo[i].userId + "\n";
            html += "<td>" + stuInfo[i].name + "\n";
            // 各回で出席しているかどうか
            for (var j = 0; j < lectureInfo.holdingCount; j++) {
                if (stuInfo[i].attend[j] == 1) {
                    html += "<td><b>◯</b>\n";
                }
                else {
                    html += "<td><b>×</b>\n";
                }
            }
            html += "<td>" + stuInfo[i].attendCount + "/" + lectureInfo.holdingCount + " 回\n\
                </tr>";
        }
        html += "</table>";
    }
    return html;// 作成した表のhtmlを返す
}

/**
 * Postを行うときに使われる
 * @param {type} holdingId
 * @param {type} attendId
 * @returns {undefined}
 */
function Post(holdingId) {
    if (window.confirm("この回の履歴詳細を確認しますか？(別タブで開きます)")) {
        var confirmForm = document.confirmForm;
        confirmForm.h_id.value = holdingId;
        confirmForm.submit();
    }
}

