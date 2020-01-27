function protoLayout() { }
/*
*canvas関連の変数
*/
protoLayout.prototype.objects = [];
protoLayout.prototype.count = 0;
protoLayout.prototype.canvas;
protoLayout.prototype.context;
protoLayout.prototype.x;
protoLayout.prototype.y;
protoLayout.prototype.relX;
protoLayout.prototype.relY;
protoLayout.prototype.objX;
protoLayout.prototype.objY;
protoLayout.prototype.objWidth = 70;
protoLayout.prototype.objHeight = 60;
protoLayout.prototype.dragging = false;
protoLayout.prototype.targetObj = -1;
protoLayout.prototype.detailObj = -1;

protoLayout.prototype.firstFlag = true;//初回処理を行うためのフラグ 
protoLayout.prototype.endFlag = false;
protoLayout.prototype.aggreFlag = false;//集計中か否かを判定するフラグ

/** 席オブジェクトに関する情報を持つクラス　*/
protoLayout.prototype.SeatObject = function (x, y) {
    this.name = '';
    this.userId = '';
    this.attendId = '';
    this.memo = '';
    this.x = x;
    this.y = y;
    this.attendFlag = false;
    this.memoFlag = false;
}


/**
 * ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
 * canvas関連のメソッド群　
 */

function init(seatInfo) {
    var classroomLayout = new protoLayout(seatInfo);
    classroomLayout.prototype.canvas = document.getElementById("canvas");
    classroomLayout.prototype.context = classroomLayout.prototype.canvas.getContext('2d');

    // 変数 json_data の値がnullではない時
    if (seatInfo != null) {
        // この中で変数 json_data を用いた処理を行う
        console.log(seatInfo); // JSONのデータを取得出来る

        for (var i = 0; i < seatInfo['count']; i++) {
            classroomLayout.prototype.objects[i] = new classroomLayout.prototype.SeatObject(seatInfo[i]['point_x'], seatInfo[i]['point_y']);
        }

        draw(classroomLayout);

    }
}

/**
 * 座席表の描画(再描画)を行う
 */
function draw(classroomLayout) {
    console.log("描画実行")
    classroomLayout.prototype.context.clearRect(0, 0, classroomLayout.prototype.canvas.width, classroomLayout.prototype.canvas.height); // キャンバスをクリア 

    if (objects.length > 0) {
        /**座席表の生成**/
        for (var i = 0; i < objects.length; i++) {
            drawRectFill(objects[i].x - objWidth / 2, objects[i].y - objHeight / 2, "#FFFFFF");//白色で塗りつぶし
            drawRectStroke(objects[i].x - objWidth / 2, objects[i].y - objHeight / 2);//枠
            drawText(i + 1, objects[i].x - 25, objects[i].y - 15, '15');//座席番号
            //drawText(message.vacancy['ja'],objects[i].x,objects[i].y);//席の状態
        }
    }
    else {
        alert("座席が登録されていません");
    }
    /**枠線を書く**/
    context.beginPath();
    context.strokeRect(0, 0, canvas.width, canvas.height);
}


function drawRectStroke(x, y) {
    context.beginPath();
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