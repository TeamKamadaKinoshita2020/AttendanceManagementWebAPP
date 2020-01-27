/**
 * @fileOverview 指定された回の出席履歴詳細を表示するファイル
 * @author ShinyaKinoshita
 */

/*
 *canvas関連の変数
 */
var objects = [];
var seatInfo = [];
var attendLog = function (t, d) {// 出席ログクラス
    this.text = t;
    this.date = d;
}
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


function makeAttendanceHistory(holdingId) {
    console.log(holdingId);
    var data = { h_id: holdingId };
    $.ajax({
        type: "POST",
        url: "ajax/get-holding-info.php",
        data: data,
        timeout: 500,

        /**
         * Ajax通信が成功した場合に呼び出されるメソッド
         */
        success: function (result, dataType) {
            getAttendHistory(result);
        },
        /*
         * 失敗時の処理
         */
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            // エラーメッセージの表示
            alert('Error : ' + errorThrown);
        }
    }
    );
}

/**
 * 自身を一定間隔で実行しリアルタイムな出席情報の表示を行うメソッド
 * @param {type} result lectureStartメソッドより渡されたajax通信の結果　集計に必要な情報が入る
 */
function getAttendHistory(result) {//holding_id,width,height){
    console.log(result);
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
        timeout: 500,

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
                timeout: 500,

                /**
                 * Ajax通信が成功した場合に呼び出されるメソッド
                 */
                success: function (attendList, dataType) {
                    /*
                     * 講義名の追加
                     */
                    var html = "<b5>" + result['name'] + " #" + result['count'] + "【ID:" + result['holding_id'] + "】"; $("#lecture_name").empty();//追加部分の初期化
                    $('#lecture_name').append(html);
                    /*
                     * キャンバスの追加
                     */
                    $("#chart").empty();//追加部分の初期化
                    $('#chart').append("<canvas id=canvas" + " height=" + "600" + " width=" + "800" + "></canvas>");//指定部分に表の追加

                    init(seatList);
                    firstFlag = false;

                    /*
                     * 出席状況の反映、描画
                     */
                    attendCheck(attendList);
                    draw();
                },
                /**
                 * Ajax通信が失敗した場合に呼び出されるメソッド
                 */
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    // エラーメッセージの表示
                    alert('Error : ' + errorThrown);
                }
            });
        },
        /**
         * Ajax通信が失敗した場合に呼び出されるメソッド
         */
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            // エラーメッセージの表示
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

    // キャンバス上のイベント追加
    canvas.addEventListener('dblclick', onDblClick, false);


    for (var i = 0; i < seatList['count']; i++) {
        objects[i] = new SeatObject(seatList[i]['point_x'], seatList[i]['point_y']);
    }
    draw();
    //座標ずらし(初期座標だと正しく描画されないので)
    for (var i = 0; i < objects.length; i++) {
        objects[i].x = parseInt(objects[i].x) + 0.1;
        objects[i].y = parseInt(objects[i].y) + 0.1;
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

function onDblClick(e) {
    console.log("db");
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
    console.log("描画ァァァァ!!");
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
            drawRectStroke(objects[i].x - objWidth / 2, objects[i].y - objHeight / 2, "#FFAAAA");//枠
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
    html += "<b5>第" + result['count'] + "回 " + result['name'] + "</b5>\n開催ID:" + result['holding_id'] + "\n";
    html += "<input type = hidden id = holding_id value=" + result['holding_id'] + ">\n";


    html += "<div class=" + "contents" + "><canvas id=canvas" + " height=" + "600" + " width=" + "800" + "></canvas></div>";
    //表作成終わり

    return html;
}

function makeEndButton(attendCount) {
    var html = "";
    html += "<div><b4>現在の出席人数:" + attendCount + "人</b4><br>";
    //集計終了ボタン作成
    //var holding_id = result['holding_id'];
    html += "<button type = button id = lecture_end class = btn  \n\
             onClick = lectureEnd(" /*+ result['holding_id']*/ + ");>" + "集計終了" + "</button></div>";

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
        html += "ここに席の詳細が表示されます"
    }
    else {
        var seat_num = parseInt(detailObj) + 1;
        html += "<h4><button type = button  style=width:50px;height120px id=left onClick = changeTargetSeatLeft();><b>←</b></button>";
        html += "　座席番号:" + seat_num + "番　";
        html += "<button type = button style=width:50px;height120px id=right onClick = changeTargetSeatRight();><b>→</b></button></h4>";

        // 出席されていれば出席学生の情報を表示
        if (objects[detailObj].attendFlag) {
            html += "　出席学生:" + objects[detailObj].name + "<br>"
                + "学籍番号:" + objects[detailObj].userId + "<br>";

            if (objects[detailObj].memoFlag) {
                html += "メモ内容：" + objects[detailObj].memo + "<br>";
            }
            else {
                html += "メモ内容：" + "登録されていません" + "<br>";
            }
        }
        else {
            html += "出席されていません";
        }
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