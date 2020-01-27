/**
* @fileoverview JavaScriptファイルでの表示文字列を集めたファイル(androidのstring.xml的な)
*                日本語(ja)と英語に(en)に対応
* @author ShinyaKinoshita
*/

string = new Object();

/*
 * ブラウザの使用言語を取得(jaかja以外(en)かを判別)
 */
var lang = (window.navigator.userLanguage || window.navigator.language || window.navigator.browserLanguage).substr(0, 2) == "ja" ? "ja" : "en";

/*
 * 教室レイアウト管理
 */

/*
 * 出席集計関連
 */
string.lecture_start = { ja: "この講義の出席集計を開始しますか？:", en: "Do you start attendance collect ?" };
string.attendance_count = { ja: "現在の出席人数", en: "Attendance count" };
string.end_collect = { ja: "集計終了", en: "EndCollect" };
string.lecture_end_confirm = { ja: "出席集計を終了しますか？", en: "Do you end attendance collect ?" };
string.lecture_end_result = { ja: "正常に集計が終了しました", en: "Successful completion" };
string.attend = { ja: "出席", en: "Present" };
string.attend_memo = { ja: "出席(メモ有)", en: "Present(Memo)" };
string.absence = { ja: "出席無し", en: "Absent" };
string.lecture_restart_button = { ja: "集計が停止した場合押してください", en: "Press on error" };
string.lecture_restart_text = { ja: "出席集計が再開されました", en: "Successful reestart process" };

/*
* 座席詳細表示関連
*/
string.non_detail_message = { ja: "ここに席の詳細が表示されます", en: "Seat Detailed Information Display Space" };
string.seat_num = { ja: "座席番号", en: "Seat Number" };
string.student_name = { ja: "出席学生", en: "Student name" };
string.student_id = { ja: "学籍番号", en: "Student ID" };
string.memo_detail = { ja: "メモ内容", en: "Memo detail" };
string.memo_entry = { ja: "メモを入力", en: "Memo entry" };
string.X_coordinate = { ja: "X座標", en: "X-coordinate" };
string.Y_coordinate = { ja: "Y座標", en: "Y-coordinate" };
string.coordinate_change = { ja: "座標変更", en: "Change coordinate" };
//メモ機能
string.memo_form1 = { ja: "出席ID:", en: "Attendance ID" };
string.memo_form2 = { ja: " この座席へのメモの内容を入力してください", en: "Please enter a memo" };
string.memo_comform1 = { ja: "この内容でよろしいですか？\n変更前：", en: "Is this the change you want?\nBefore:" };
string.memo_comform2 = { ja: "　→ 変更後：", en: " → After:" };
/**
 * 教室管理関連
 */
string.selected = { ja: "選択中", en: "Selected" };
string.registration_card = { ja: "登録カード", en: "Registration card" };
string.nothing = { ja: "なし", en: "Nothing" };
string.delete_seat = { ja: "この席を削除", en: "Delete this seat" };
/*
 * 出席履歴関連
 */
string.confirm_attend_history_list = { ja: "この講義の出席履歴表を表示しますか？:", en: "Do you want to display the history table of this lecture?:" };
/*
 * エラーメッセージ
 */
string.lecture_end_error = { ja: "終了処理に失敗しました", en: "End processing failed" };
string.memo_update_error = { ja: "変更に失敗しました", en: "Change failed" };
string.lecture_restart_error =  { ja: "条件を満たしていない為集計を再開できませんでした", en: "Restart processing failed" };