/**
 * 出席集計中にページ移動をしようとすると確認ウィンドウを起動するイベント
 */

window.addEventListener("beforeunload", function (eve) {
    if (window.sessionStorage.getItem(['aggre_flag'])) {//出席集計フラグを確認
        eve.returnValue = "現在出席集計中です\n本当に移動しても良いですか？"
    }
}, false)

