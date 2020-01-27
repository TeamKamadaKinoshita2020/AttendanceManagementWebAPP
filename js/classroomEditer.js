/**
 * @fileOverview 教室情報の登録・編集を行う為のファイル
 * @author ShinyaKinoshita
 */

/*
 *canvas関連の変数
 */
var objects = [];//座席オブジェクトが入る
var count = 0;
var canvas;
var context;
var x, y, relX, relY, objX, objY;
var objWidth = 70;
var objHeight = 60;
var dragging = false;
var targetObj = -1;
var detailObj = -1;

var roomId;
var updateFlag = false;

const UNREGISTER_CARD_ID = '000000000000000';//座席カードが未登録であることを表す定数

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
    this.card_id = UNREGISTER_CARD_ID;//デフォルトのカードIDは未設定
    this.identity_id = '';
    this.attendFlag = false;
    this.memoFlag = false;
}

/**
 * 新規教室登録時に呼ばれる初期化関数
 */
function init() {
    canvas = document.getElementById("canvas");
    context = canvas.getContext('2d');

    //キャンバス上のイベント追加
    canvas.addEventListener('mousedown', onDown, false);
    canvas.addEventListener('mousemove', onMove, false);
    canvas.addEventListener('mouseup', onUp, false);
    canvas.addEventListener('dblclick', onDblClick, false);

    draw();
}

/**
 * DB登録情報の編集時に呼ばれる初期化関数
 * @param {type} seatInfo DBに登録されている座席配置情報
 */
function initEdit(seatInfo, rId) {
    canvas = document.getElementById("canvas");
    context = canvas.getContext('2d');
    roomId = rId;

    //キャンバス上のイベント追加
    canvas.addEventListener('mousedown', onDown, false);
    canvas.addEventListener('mousemove', onMove, false);
    canvas.addEventListener('mouseup', onUp, false);
    canvas.addEventListener('dblclick', onDblClick, false);

    // 変数 json_data の値がnullではない時
    if (seatInfo != null) {
        // この中で変数 json_data を用いた処理を行う
        console.log(seatInfo); // JSONのデータを取得出来る

        for (var i = 0; i < seatInfo['count']; i++) {
            objects[i] = new SeatObject(seatInfo[i]['point_x'], seatInfo[i]['point_y']);
            if (seatInfo[i]['card_id']) {
                objects[i].card_id = seatInfo[i]['card_id'];//カードIDを取得
            }
            if (seatInfo[i]['identity_id']) {
                objects[i].identity_id = seatInfo[i]['identity_id'];//識別IDを取得
            }
        }
    }

    draw();
}


/**
 * キャンバス上のイベント処理
 */
function onDown(e) {
    var rect = e.target.getBoundingClientRect();
    var x = e.clientX - rect.left;
    var y = e.clientY - rect.top;
    checkRectObjPoint(x, y);//席のオブジェクト(四角)がクリックされたか判定する
    if (targetObj == -1) {
        objects[objects.length] = new SeatObject(x, y);
    }
    draw();
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
 * 座席表の描画(再描画)を行う関数
 */
function draw() {
    context.clearRect(0, 0, canvas.width, canvas.height); // キャンバスをクリア 

    /**座席表の生成**/
    for (var i = 0; i < objects.length; i++) {
        if (detailObj == i) {//選択中座席の描画
            drawRectFill(objects[i].x - objWidth / 2, objects[i].y - objHeight / 2, "#FFBBBB");//赤で塗りつぶし
            drawRectStroke(objects[i].x - objWidth / 2, objects[i].y - objHeight / 2, "#000000");//枠
            drawText(i + 1, objects[i].x - 25, objects[i].y - 15, '15');//座席番号
            drawText(string.selected[lang], objects[i].x, objects[i].y, '12');//席の状態            
        }
        else {
            drawRectFill(objects[i].x - objWidth / 2, objects[i].y - objHeight / 2, "#FFFFFF");//白色で塗りつぶし
            drawRectStroke(objects[i].x - objWidth / 2, objects[i].y - objHeight / 2, "#000000");//枠
            drawText(i + 1, objects[i].x - 25, objects[i].y - 15, '15');//座席番号
            //drawText(message.vacancy['ja'],objects[i].x,objects[i].y);//席の状態
        }
    }
    //選択状態の描画
    if (detailObj == i) {
        drawRectStroke(objects[i].x - objWidth / 2, objects[i].y - objHeight / 2, "#DDAAAA");//枠
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
    context.font = size + "px Arial";//表示サイズ、フォントの設定
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
        html += string.seat_num[lang] + ":" + seat_num;//座席番号//"　座席番号:" + seat_num +"番　";
        html += "<button type = button style=width:50px;height120px id=right onClick = changeTargetSeatRight();><b>→</b></button></h4>";


        //座席に設定されたカードの識別IDを表示
        if (objects[detailObj].card_id) {
            if (objects[detailObj].card_id == UNREGISTER_CARD_ID) {
                html += string.registration_card[lang] + ":" + string.nothing[lang];
            }
            else {
                html += string.registration_card[lang] + ":" + objects[detailObj].identity_id;
            }
        }
        html += "<br>";
        //カードID表示
        if (objects[detailObj].card_id && (objects[detailObj].card_id != UNREGISTER_CARD_ID)) {
            html += "　CardID:" + objects[detailObj].card_id;
            html += "<br>";
        }

        html += string.X_coordinate[lang] + ":<input type=text name=x id=x_position  maxlength=3 size=3 value=" + parseInt(objects[detailObj].x) + "><br>"//html += "X座標:<input type=text name=x id=x_position  maxlength=3 size=3 value=" + parseInt(objects[detailObj].x) + "><br>"
        html += "<div id=space_height></div>"
        html += string.Y_coordinate[lang] + ":<input type=text name=y id=y_position maxlength=3  size=3 value=" + parseInt(objects[detailObj].y) + "><br>"//html += "Y座標:<input type=text name=y id=y_position maxlength=3  size=3 value=" + parseInt(objects[detailObj].y) + "><br>"
        html += "<div id=space_height></div>"
        html += "<button type = button id=change_button  style=width:100px;height:40px onClick = changeSeatPosition();>" + string.coordinate_change[lang] + "</button>"//html += "<button type = button id=change_button  style=width:100px;height:40px onClick = changeSeatPosition();>座標変更</button>"
        html += "<button type = button id=change_button  style=width:100px;height:40px onClick = deleteSeatObject();>" + string.delete_seat[lang] + "</button><br>"
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
 * 新規の教室情報をデータベースに登録する
 */
function registerClassroomInfo() {
    if (document.getElementById('room_name').value) {//教室名が入力されているか
        if (window.confirm('この内容で教室を登録しますか？')) {
            var data = { name: $('#room_name').val() };
            /**
             * Ajax通信メソッド
             * @param type  : HTTP通信の種類
             * @param url   : リクエスト送信先のURL
             * @param data  : サーバに送信する値
             */
            $.ajax({
                type: "POST",
                url: "ajax/send-classroom-info.php",
                data: data,
                timeout: 500,

                /**
                 * Ajax通信が成功した場合に呼び出されるメソッド
                 * resultは登録された教室の固有ID
                 * 次に座席レイアウトの登録処理を行う
                 */
                success: function (result, dataType) {
                    /*
                     * for文でajax回して座席登録処理
                     */
                    var i = 0;
                    while (i < objects.length) {
                        //alert(objects.length);
                        var seatNum = i + 1;
                        var seatInfo = { r_id: result, seat_num: seatNum, point_x: parseInt(objects[i].x), point_y: parseInt(objects[i].y), card_id: objects[i].card_id };
                        //alert(seatInfo['seat_num'] + "  " + seatInfo['r_id']);
                        $.ajax({
                            type: "POST",
                            url: "ajax/send-seat-info.php",
                            data: seatInfo,
                            timeout: 500,

                            success: function (result, dataType) {
                            },
                            /*
                            * 失敗時の処理
                            */
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                //エラーメッセージの表示
                                alert('Error : ' + errorThrown);
                            }
                        }
                        );
                        i++;
                    }
                },
                /*
                 * 失敗時の処理
                 */
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    //エラーメッセージの表示
                    alert('Error : ' + errorThrown);
                }
            }
            );
            alert("登録処理が完了しました\nトップページへ遷移します");
            window.location.href = 'index.php'; // トップページへ
        }
    }
    else {
        alert("教室名が入力されていません");
    }
}

/**
 * 変更された教室情報を更新する処理を行う
 * 教室情報変更→席全体削除→新規席登録の順番で処理を行い更新する
 */
function updateClassroomInfo() {
    if (document.getElementById('room_name').value) {//教室名が入力されているか
        if (window.confirm('この内容で教室情報を更新しますか？')) {
            var data = { r_id: roomId, name: $('#room_name').val() };
            /**
             * Ajax通信メソッド
             * @param type  : HTTP通信の種類
             * @param url   : リクエスト送信先のURL
             * @param data  : サーバに送信する値
             */
            $.ajax({
                type: "POST",
                url: "ajax/update-classroom-info.php",
                data: data,
                timeout: 500,

                /**
                 * Ajax通信が成功した場合に呼び出されるメソッド
                 * resultは登録された教室の固有ID
                 * 座席レイアウトの更新処理を行う
                 */
                success: function (result, dataType) {
                    $.ajax({
                        type: "POST",
                        url: "ajax/delete-seat-info.php",
                        data: data,
                        timeout: 500,

                        success: function (result, dataType) {
                            /*
                             * for文でajax回して座席登録処理
                             */
                            var i = 0;
                            while (i < objects.length) {
                                //alert(objects.length);
                                var seatNum = i + 1;
                                var seatInfo = { r_id: roomId, seat_num: seatNum, point_x: parseInt(objects[i].x), point_y: parseInt(objects[i].y), card_id: objects[i].card_id };
                                //alert(seatInfo['seat_num'] + "  " + seatInfo['r_id']);
                                $.ajax({
                                    type: "POST",
                                    url: "ajax/send-seat-info.php",
                                    data: seatInfo,
                                    timeout: 500,

                                    success: function (result, dataType) {
                                    },
                                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                                        //エラーメッセージの表示
                                        alert('Error : ' + errorThrown);
                                    }
                                }
                                );
                                i++;
                            }
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            //エラーメッセージの表示
                            alert('Error : ' + errorThrown);
                        }
                    });
                },
                /*
                 * 失敗時の処理
                 */
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    //エラーメッセージの表示
                    alert('Error : ' + errorThrown);
                }
            }
            );
        }
        alert("更新処理が完了しました");
        //window.location.href = 'view-classroom-list.php'; // 教室一覧へ
    }
    else {
        alert("教室名が入力されていません");
    }
}