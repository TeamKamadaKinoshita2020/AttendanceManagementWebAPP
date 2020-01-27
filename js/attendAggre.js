/**
 * @fileOverview 講義開催時に出席集計の状況を座席表として表示するファイル 非同期通信(Ajax)で情報を取得する
 * @author ShinyaKinoshita
 */

var timer;// 定期実行の開始、停止用の変数

/*
 * canvas関連の変数
 */
var objects = [];
var seatInfo = [];
var log = [];
var logCount = 0;

var count = 0;
var canvas;
var context;
var x, y, relX, relY, objX, objY;
var objWidth = 70;
var objHeight = 60;
var dragging = false;
var targetObj = -1;
var detailObj = -1;

var firstFlag = true;// 初回処理を行うためのフラグ 
var endFlag = false;
var aggreFlag = false;// 集計中か否かを判定するフラグ
var errorFlag = false;// 集計中にタイムアウトしたかどうかの判別

var holdingInfo; // 集計している講義の情報を格納する

/**
 * 入力されたIDよりDBとajax通信を行い出席集計を開始する処理を行う（attendAgreeの呼出）
 */
function lectureStart() {

    if (window.confirm(string.lecture_start[lang] + $('#lecture_list :selected').text())) {// 開始の確認
        // POSTメソッドで送るデータを定義します var data = {パラメータ名 : 値};
        var data = { l_id: $('#lecture_list :selected').val() };
        /**
         * Ajax通信メソッド
         * @param type  : HTTP通信の種類
         * @param url   : リクエスト送信先のURL
         * @param data  : サーバに送信する値
         */
        $.ajax({
            type: "POST",
            url: "ajax/start-lecture.php",
            data: data,
            timeout: TIME_OUT,

            /**
             * Ajax通信が成功した場合に呼び出されるメソッド
             */
            success: function (result, dataType) {
                // 変数resultに結果が格納されているか
                // 集計中フラグをオンにする
                window.sessionStorage.setItem(['aggre_flag'], [true]);
                holdingInfo = result;
                attendAggre(result);
            },
            /*
             * 失敗時の処理
             */
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                //　エラーメッセージの表示
                errorFlag = true;
                alert('Error : ' + errorThrown);
            }
        }
        );
        //　サブミット後、ページをリロードしないようにする
        return false;
    }
}

/**
 * 自身を一定間隔で実行しリアルタイムな出席情報の表示を行うメソッド
 * @param {type} result lectureStartメソッドより渡されたajax通信の結果　集計に必要な情報が入る
 */
function attendAggre(result) {
    var seatList;
    var r_id = { r_id: result['room_id'] };
    /**
     * Ajax通信メソッド
     * 教室の席情報を取得する
     * @param type  : HTTP通信の種類
     * @param url   : リクエスト送信先のURL
     * @param data  : サーバに送信する値
     */
    $.ajax({
        type: "POST",
        url: "ajax/get-seat-list.php",
        data: r_id,
        timeout: TIME_OUT,

        /**
         * Ajax通信が成功した場合に呼び出されるメソッド
         */
        success: function (data, dataType) {
            seatList = data;
            var h_id = { h_id: result['holding_id'] };
            /**
             * Ajax通信メソッド
             * 出席状況を取得する
             * @param type  : HTTP通信の種類
             * @param url   : リクエスト送信先のURL
             * @param data  : サーバに送信する値
             */
            $.ajax({
                type: "POST",
                url: "ajax/get-attend-list.php",
                data: h_id,
                timeout: TIME_OUT,

                /**
                 * Ajax通信が成功した場合に呼び出されるメソッド
                 */
                success: function (attendList, dataType) {
                    /*
                     * 初回のみ行われる処理
                     */
                    if (firstFlag) {
                        /*
                         * 講義名の追加
                         */
                        var html = "<b5>" + result['lecture_name'] + " #" + result['count'] + "【ID:" + result['holding_id'] + "】" + "<input type = hidden id = holding_id value=" + result['holding_id'] + ">\n";;
                        $("#lecture_name").empty();// 追加部分の初期化
                        $('#lecture_name').append(html);
                        /*
                         * キャンバスの追加
                         */
                        $("#chart").empty();// 追加部分の初期化
                        $('#chart').append("<div class=" + "contents" + "><canvas id=canvas" + " height=" + "600" + " width=" + "800" + "></canvas></div>");// 指定部分に表の追加

                        init(seatList);
                        firstFlag = false;
                    }
                    /*
                     * 出席状況の反映、描画
                     */
                    attendCheck(attendList);
                    draw();

                    /*
                     * 集計終了ボタンの追加
                     */
                    var end_button = $(makeEndButton(attendList['count']));
                    $("#end_button").empty();//追加部分の初期化
                    $('#end_button').append(end_button);//指定部分に表の追加

                    $("#lecture_select").prop("disabled", true);//成功したので集計開始ボタンの無効化
                    $("#lecture_list").prop("disabled", true);
                    timer = setTimeout(function () { attendAggre(result) }, 3000);// 3秒に1回自身を定期実行しDBの変化を反映させる
                },
                /**
                 * Ajax通信が失敗した場合に呼び出されるメソッド
                 */
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    //エラーメッセージの表示
                    errorFlag = true;
                    alert('Error : ' + errorThrown);
                }
            });
        },
        /**
         * Ajax通信が失敗した場合に呼び出されるメソッド
         */
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            //エラーメッセージの表示
            errorFlag = true;
            alert('Error : ' + errorThrown);
        }
    });
}
/**
 * ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
 * canvas関連のメソッド群　
 */

/** 席オブジェクトに関する情報を持つクラス　*/
var SeatObject = function (x, y) {
    this.name = '';
    this.userId = '';
    this.attendId = '';
    this.memo = '';
    this.x = x;
    this.y = y;
    this.attendFlag = false;
    this.memoFlag = false;
}

function init(seatList) {
    canvas = document.getElementById("canvas");
    context = canvas.getContext('2d');

    //キャンバス上のイベント追加
    canvas.addEventListener('mousedown', onDown, false);
    canvas.addEventListener('mousemove', onMove, false);
    canvas.addEventListener('mouseup', onUp, false);
    canvas.addEventListener('dblclick', onDblClick, false);


    for (var i = 0; i < seatList['count']; i++) {
        objects[i] = new SeatObject(seatList[i]['point_x'], seatList[i]['point_y']);
    }
    draw();



    
    //座標ずらし(初期座標だと正しく描画されないので)
    for (var i = 0; i < objects.length; i++) {
        objects[i].x = parseInt(objects[i].x) + 0.1;
        objects[i].y = parseInt(objects[i].y) + 0.1;
        //alert(objects[i].x + " " + objects[i].y);
    }
}

function attendCheck(attendList) {
    /*
     * 座標以外の席情報を初期化する
     */
    for (var i = 0; i < objects.length; i++) {
        objects[i].name = '';
        objects[i].userId = '';
        objects[i].attendId = '';
        objects[i].memo = '';
        objects[i].attendFlag = false;
        objects[i].memoFlag = false;
    }

    //出席のチェック
    for (var i = 0; i < attendList['count']; i++) {
        var num = attendList[i]['seat_num'] - 1;
        objects[num].name = attendList[i]['name'];
        objects[num].userId = attendList[i]['user_id'];
        objects[num].attendId = attendList[i]['attend_id'];
        objects[num].attendFlag = true;

        /*メモの有無判定*/
        if (attendList[i]['memo']) {
            objects[num].memo = attendList[i]['memo'];
            objects[num].memoFlag = true;
        }
        else {
            objects[num].memo = "";
            objects[num].memoFlag = false;
        }
    }
    /**
     * 座席移動のチェック処理
     */
}

function onDown(e) {
    var rect = e.target.getBoundingClientRect();
    var x = e.clientX - rect.left;
    var y = e.clientY - rect.top;

    //checkObjPoint(x,y);//席のオブジェクト(丸)がクリックされたか判定する
    checkRectObjPoint(x, y);//席のオブジェクト(四角)がクリックされたか判定する
}
function onMove(e) {
    var rect = e.target.getBoundingClientRect();
    var x = e.clientX - rect.left;
    var y = e.clientY - rect.top;
    if (dragging) {
        objects[targetObj].x = x + relX;
        objects[targetObj].y = y + relY;

        draw();
    }
}
function onUp(e) {
    dragging = false;
    targetObj = -1;
}
function onDblClick(e) {
    // console.log("db");
    var rect = e.target.getBoundingClientRect();
    var x = e.clientX - rect.left;
    var y = e.clientY - rect.top;
    checkRectObjPoint(x, y);//席のオブジェクト(四角)がクリックされたか判定する
    if (targetObj != -1) {
        if (detailObj == targetObj) {
            detailObj = -1;
        }
        else {
            detailObj = targetObj;
        }
        dragging = false;
        targetObj = -1;
    }
    draw();
}
/**
 * 座席表の描画(再描画)を行う
 */
function draw() {
    // console.log("描画ァァァァ!!");
    context.clearRect(0, 0, canvas.width, canvas.height); // キャンバスをクリア 

    /**座席表の生成**/
    for (var i = 0; i < objects.length; i++) {
        if (objects[i].memoFlag) { /**出席済みでメモが書かれている場合**/
            /*drawArcFill(objects[i].x,objects[i].y);
            drawArcStroke(objects[i].x,objects[i].y);*/
            drawRectFill(objects[i].x - objWidth / 2, objects[i].y - objHeight / 2, "#FFEF00");//黄色で塗りつぶし
            drawRectStroke(objects[i].x - objWidth / 2, objects[i].y - objHeight / 2, "#000000");//枠
            drawText(i + 1, objects[i].x - 25, objects[i].y - 15, '15');//座席番号
            drawText(string.attend_memo[lang], objects[i].x, objects[i].y, '10');//席の状態
            drawText(objects[i].userId, objects[i].x, objects[i].y + 15, '10');//学籍番号
            drawText(objects[i].name, objects[i].x, objects[i].y + 28, '10');//名前
        }
        else if (objects[i].attendFlag) { /**出席済みでメモがない場合**/
            /*drawArcFill(objects[i].x,objects[i].y);
            drawArcStroke(objects[i].x,objects[i].y);*/
            drawRectFill(objects[i].x - objWidth / 2, objects[i].y - objHeight / 2, "#40FF40");//緑色で塗りつぶし
            drawRectStroke(objects[i].x - objWidth / 2, objects[i].y - objHeight / 2, "#000000");//枠
            drawText(i + 1, objects[i].x - 25, objects[i].y - 15, '15');//座席番号
            drawText(string.attend[lang], objects[i].x, objects[i].y, '10');//席の状態
            drawText(objects[i].userId, objects[i].x, objects[i].y + 15, '10');//学籍番号
            drawText(objects[i].name, objects[i].x, objects[i].y + 28, '10');//名前
        }
        else { /**出席されていない場合**/
            /*drawArcFill(objects[i].x,objects[i].y);
            drawArcStroke(objects[i].x,objects[i].y);*/
            drawRectFill(objects[i].x - objWidth / 2, objects[i].y - objHeight / 2, "#E2E2E2");//薄灰色で塗りつぶし
            drawRectStroke(objects[i].x - objWidth / 2, objects[i].y - objHeight / 2, "#000000");//枠
            drawText(i + 1, objects[i].x - 25, objects[i].y - 15, '15');//座席番号
            drawText(string.absence[lang], objects[i].x, objects[i].y, '10');//席の状態
        }
        //選択状態の描画
        if (detailObj == i) {
            drawRectStroke(objects[i].x - objWidth / 2, objects[i].y - objHeight / 2, "#DDAAAA");//枠
        }
    }
    /*
    * 席詳細エディタの描画
    */
    var editer = makeSeatDetailInfoEditer();
    $("#detail_editer").empty();//追加部分の初期化
    $('#detail_editer').append(editer);//指定部分に表の追加
}


function drawRectStroke(x, y, color) {
    context.beginPath();
    context.strokeStyle = color;
    context.strokeRect(x, y, objWidth, objHeight);
    context.restore();
    context.save();
}

function drawRectFill(x, y, color) {
    context.beginPath();
    context.fillStyle = color;
    context.fillRect(x, y, objWidth, objHeight);
    context.restore();
    context.save();
}


function drawArcStroke(x, y) {
    context.beginPath();
    context.arc(x, y, objWidth, 0, Math.PI * 2, true);
    context.stroke();
}

function drawArcFill(x, y) {
    context.beginPath();
    context.fillStyle = "white";
    context.arc(x, y, objWidth, 0, Math.PI * 2, true);
    context.fill();
}

function drawText(txt, x, y, size) {
    context.beginPath();
    context.fillStyle = "black";
    context.textAlign = 'center';//中央から表示
    context.font = size + "px Arial";
    context.fillText(txt, x, y, 80); //テキストの最大幅を80pxに指定
    context.restore();
    context.save();
}


function checkObjPoint(x, y) {
    for (var i = 0; i < objects.length; i++) {
        if ((objects[i].x - objWidth) < x && (objects[i].x + objWidth) > x && (objects[i].y - objHeight) < y && (objects[i].y + objHeight) > y) {
            dragging = true;
            targetObj = i;
            relX = objects[i].x - x;
            relY = objects[i].y - y;
            return i;
        }
    }
    return -1;
}

function checkRectObjPoint(x, y) {
    var rectX = objWidth / 2;
    var rectY = objHeight / 2;
    for (var i = 0; i < objects.length; i++) {
        if ((x + rectX > objects[i].x) && (x - rectX < objects[i].x) && (y + rectY > objects[i].y) && (y - rectY < objects[i].y)) {
            //デバック用
            /*var s = "rectX:" + rectX + " rectY:" + rectY + " x,y:" + x + " " + y;
            console.log(s);
            console.log(objects[i].x + " " + objects[i].y);*/
            dragging = true;
            targetObj = i;
            relX = objects[i].x - x;
            relY = objects[i].y - y;
            return i;
        }
    }
    return -1;
}
/**
 * canvas関連終わり
 * ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
 */

/**
 * 
 * @param {type} result
 */
function makeSeatingChart(result) {//width,height,attendList,holding_id){
    //==== 変数の設定 ================
    //変数 $html の初期化
    var html = "";
    //html += "<b5>第"+ result['count'] + "回 " + result['lecture_name'] +"</b5>\n開催ID:" + result['holding_id'] + "\n" ;
    html += "<b5>" + result['lecture_name'] + " #" + result['count'] + "【ID:" + result['holding_id'] + "】";
    html += "<input type = hidden id = holding_id value=" + result['holding_id'] + ">\n";
    // console.log(html); // デバッグ用
    html += "<div class=" + "contents" + "><canvas id=canvas" + " height=" + "600" + " width=" + "800" + "></canvas></div>";
    //表作成終わり

    return html;
}

function makeEndButton(attendCount) {
    var html = "";
    html += "<div><b4>" + string.attendance_count[lang] + ":" + attendCount + "</b4><br>";
    // 集計終了ボタン作成
    //var holding_id = result['holding_id'];
    html += "<button type = button id = lecture_end class = btn  \n\
             onClick = lectureEnd(" /*+ result['holding_id']*/ + ");>" + string.end_collect[lang] + "</button>";
             
             
    // エラー用の集計再開ボタン
    html += "<button type = button id = restart_attend_agree class = btn  \n\
    onClick = restartAttendAgree();>" + string.lecture_restart_button[lang] + "</button>";

    html += "</div>";

    return html;
}

/**
 * 教室のid番目の座席に出席されているかどうかを調べる
 * @param {type} data　出席情報の入った多次元配列
 * @param {type} id
 * @returns {Number} id番目の席に出席があればその配列の番号を、そうでなければ-1を返す
 */
function checkSeatId(data, id) {
    for (var i = 0; i < Number(data['count']); i++) {
        if (data[String(i)]['seat_num'] === String(id)) {
            //alert(data[String(i)]['seat_num']);//デバック用
            return i;
        }
    }
    return -1;//falseは0として扱われてるっぽいので-1に変更
}


/**
 * 詳細表示する座席情報のhtmlを生成する
 * @returns {String}
 */
function makeSeatDetailInfoEditer() {
    var html = '';
    if (detailObj == -1) {
        html += string.non_detail_message[lang];//"ここに席の詳細が表示されます"
    }
    else {
        var seat_num = parseInt(detailObj) + 1;
        html += "<h4><button type = button  style=width:50px;height120px id=left onClick = changeTargetSeatLeft();><b>←</b></button>";
        html += string.seat_num[lang] + ":" + seat_num;//座席番号
        html += "<button type = button style=width:50px;height120px id=right onClick = changeTargetSeatRight();><b>→</b></button></h4>";


        //出席されていれば出席学生の情報を表示
        if (objects[detailObj].attendFlag) {
            html += string.student_name[lang] + objects[detailObj].name + "<br>"
                + string.student_id[lang] + objects[detailObj].userId + "<br>";//出席学生、学籍番号

            if (objects[detailObj].memoFlag) {
                html += string.memo_detail[lang] + "：" + objects[detailObj].memo + "<br>";//メモ内容
            }
            else {
                html += string.memo_detail[lang] + ":<br>";
            }
            html += "<button type = button id=change_button  style=height:40px onClick = memoEdit();>" + string.memo_entry[lang] + "</button><br>"
        }
        else {
            html += string.absence[lang];
        }
        html += "<br>";

        html += string.X_coordinate[lang] + ":<input type=text name=x id=x_position  maxlength=3 size=3 value=" + parseInt(objects[detailObj].x) + "><br>"
        html += "<div id=space_height></div>"
        html += string.Y_coordinate[lang] + ":<input type=text name=y id=y_position maxlength=3  size=3 value=" + parseInt(objects[detailObj].y) + "><br>"
        html += "<div id=space_height></div>"
        html += "<button type = button id=change_button  style=width:100px;height:40px onClick = changeSeatPosition();>" + string.coordinate_change[lang] + "</button>"
    }
    return html;
}

/**
 * 詳細表示部分で座標の変更があった場合それを適用する関数
 * @returns {undefined}
 */
function changeSeatPosition() {
    objects[detailObj].x = document.getElementById('x_position').value;
    objects[detailObj].y = document.getElementById('y_position').value;

    draw();
}

/**
 * 詳細表示部分で削除処理が行われた場合それを行う関数
 * @returns {undefined}
 */
function deleteSeatObject() {
    objects.splice(detailObj, 1);
    detailObj = -1;
    draw();
}

/**
 * 変更ボタンが押されて詳細表示対象が変更された場合それを適用する関数(+と-で関数を分けた)
 * @returns {undefined}
 */
function changeTargetSeatLeft() {
    if (detailObj > 0) {
        detailObj--;
    }
    draw();
}
function changeTargetSeatRight() {
    if (detailObj != -1 && detailObj <= objects.length) {
        detailObj++;
    }
    draw();
}

/**
 * キーでの操作設定
 */
document.onkeydown = function (e) {
    switch (e.keyCode) {

        case 37:
            // Key: ←
            changeTargetSeatLeft();
            break;
        case 39:
            // Key: →
            changeTargetSeatRight();
            break;
    }

};

/**
 * 各座席のメモの確認、変更を行うメソッド　
 * 学生の出席情報内のボタンがクリックされるとプロンプトを表示し入力を受け付ける
 * @param {type} attend_id 出席のID情報
 * @param {type} memo　元々入力されているメモ内容
 */
function memoEdit() {
    var attendId = objects[detailObj].attendId;
    var memo = "" + objects[detailObj], memo;
    var str = string.memo_form1[lang] + attendId + string.memo_form2[lang];
    user = prompt(str, memo);//説明文字列とフォーム内の初期文字列を設定

    /**
     * メモ内容に変更があればDBの出席情報に反映させる
     */
    if (user != memo && user != null) {
        //変更の確認ダイアログの表示
        if (window.confirm(string.memo_comform1[lang] + memo + string.memo_comform2[lang] + user)) {
            //変更処理
            var data = { a_id: attendId, memo: user };
            $.ajax({
                type: "POST",
                url: "ajax/update-attend-memo.php",
                data: data,
                timeout: 500,
                /**
                 * Ajax通信が成功した場合に呼び出されるメソッド
                 */
                success: function (data, dataType) {
                    if (!data) {
                        alert(string.memo_update_error[lang]);
                    }
                    return user;
                },
                /*
                 * 失敗時処理
                 */
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert('Error : ' + errorThrown);
                    return '';
                }
            }
            );
        }
    }
}

// FireFox 対策
window.document.onmousemove = myGetEvent;
function myGetEvent(evt) {
    myEvent = (evt) ? evt : window.event;
}

function myIn(myTblNo) {	// カーソルが乗った
    document.getElementById("info").innerHTML = myTbl[myTblNo];
    myObj = document.getElementById("info").style;
    myObj.left = document.body.scrollLeft + myEvent.clientX + 20;	// X表示位置
    myObj.top = document.body.scrollTop + myEvent.clientY + 20;	// Y表示位置
    myObj.visibility = "visible";	// 表示
}
function myOut() {	// カーソルが離れた
    document.getElementById("info").style.visibility = "hidden";	// 非表示
}

//現在時刻取得（yyyy/mm/dd hh:mm:ss）
function getCurrentTime() {
    var now = new Date();
    var res = "" + now.getFullYear() + "/" + padZero(now.getMonth() + 1) +
        "/" + padZero(now.getDate()) + " " + padZero(now.getHours()) + ":" +
        padZero(now.getMinutes()) + ":" + padZero(now.getSeconds());
    return res;
}

//先頭ゼロ付加
function padZero(num) {
    var result;
    if (num < 10) {
        result = "0" + num;
    } else {
        result = "" + num;
    }
    return result;
}

/**
 * 出席集計終了時に出席可能講義一覧から該当講義を削除するメソッド
 */
function lectureEnd() {
    //alert("a" + $('#holding_id').val());//デバック用　
    if (window.confirm(string.lecture_end_confirm[lang])) {//終了確認
        //DBの出席可能一覧から指定idを削除する処理
        var data = { h_id: $('#holding_id').val() };//セキュリティの関係上hiddenからセッション変数に後日変更する必要有(8/28
        //console.log(data);//デバッグ用　終了講義のID出力　←IDが空？？
        $.ajax({
            type: "POST",
            url: "ajax/end-lecture.php",
            data: data,
            timeout: 500,

            /**
             * Ajax通信が成功した場合に呼び出されるメソッド
             */
            success: function (data, dataType) {
                //変数dataに結果が格納されている

                /**
                 * 2018/6/17
                 * ajaxが実行されない不具合有　集計が終了できない
                 */

                if (data == true) {
                    //定期実行されている出席集計関数を止める
                    clearTimeout(timer); 
                    // 集計中フラグをオフにする
                    window.sessionStorage.removeItem(['aggre_flag']);
                    $("#lecture_end").prop("disabled", true);// 処理が成功したので終了ボタンを無効化
                    $("#restart_attend_agree").prop("disabled", true);// 処理が成功したので集計再開ボタンを無効化
                    alert(string.lecture_end_result[lang]);
                }
                else {
                    alert(string.lecture_end_error[lang]);
                }
            },
            /*
             * 失敗時処理
             */
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                //エラーメッセージの表示
                alert('Error : ' + errorThrown);
            }

        }
        );
    }
}

/**
 * エラーで集計が停止した際に集計を再開させるメソッド
 */
function restartAttendAgree() {
    console.log(holdingInfo);
    if (holdingInfo && errorFlag && window.sessionStorage.getItem(['aggre_flag'])){
        timer = setTimeout(function () { attendAggre(holdingInfo) }, 3000);// 3秒に1回自身を定期実行しDBの変化を反映させる
        errorFlag = false;
        alert(string.lecture_restart_text[lang]);
    } else {
        alert(string.lecture_restart_error[lang]);
    }
}