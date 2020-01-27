<?php
/**
 * データベースとのやりとりをまとめたファイル
 * @author ShinyaKinoshita
 */

class DAO
{
    
    
    // AWS用設定 RDS
    private $db_host = "database-1.ccy4ybdnvvrm.ap-northeast-1.rds.amazonaws.com"; // DBサーバのURL
    private $db_user = "admin"; // ユーザー名
    private $db_pass = "adminadmin"; // ユーザー名のパスワード
    private $db_dbname = "attendance_system"; // データベース名
    private $pdo;
    public $daomessage = "";
    

    /*
    
    // ローカルホスト時の設定
    private $db_host = "localhost"; // DBサーバのURL
    private $db_user = "18nm714n"; // ユーザー名
    private $db_pass = "N417"; // ユーザー名のパスワード
    private $db_dbname = "attendance_system"; // データベース名
    private $pdo;
    public $daomessage = "";
    




    
    /**
     * データベース接続を行うメソッド
     */
    public function db_connect()
    {
        $this->pdo = new PDO("mysql:dbname=$this->db_dbname; host=$this->db_host;charset=utf8; port=3306", $this->db_user, $this->db_pass);
        // 静的プレースホルダを用いるようにエミュレーションを無効化
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // エラー時に例外を発生させる（任意）
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    /**
    * ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
    * DB登録内容(ユーザ、講義内容、教室管理)関連
    */
    
    public function check_webuser_id($user_id)
    {// ユーザIDの重複チェックを行う
        try {
            $this->db_connect();
            //idの一致するデータを検索
            $stmt = $this->pdo->prepare("SELECT * FROM webuser_info WHERE user_id = :u_id");
            $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);// 値のbind
            $stmt->execute();

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {// 重複が見つかればTRUEを返す
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * webユーザの新規登録を行う
     * @param type $user_id
     * @param type $name
     * @param type $pass
     * @param type $position
     * @param type $auth
     * @return boolean
     */
    public function register_webuser($user_id, $name, $pass, $position, $auth)
    {
        try {
            $this->db_connect();
            $stmt = $this->pdo->prepare("INSERT INTO webuser_info(user_id,name,pass,position,auth) VALUES (:u_id, :name, :pass, :position, :auth)");
            $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);// 値のbind
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $hash = password_hash($pass, PASSWORD_DEFAULT);//パスワードのハッシュ化
            $stmt->bindValue(':pass', $hash, PDO::PARAM_STR);
            $stmt->bindValue(':position', $position, PDO::PARAM_STR);
            $stmt->bindValue(':auth', $auth, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * 登録されているWEBユーザの情報を取得する
     * @return int
     */
    public function get_webuser_info($user_id)
    {
        try {
            $this->db_connect();
            
            //情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM webuser_info WHERE user_id = :u_id");
            $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);// 値のbind
            $stmt->execute();
            
            $data = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {//情報をkeyで分けて格納
                    $data[$key] = $value;
                }
            }
            return $data;
        } catch (PDOException $e) {
            echo false;
        }
    }

    /**
     * 登録されているWEBユーザのリストを取得する
     * @return int
     */
    public function get_webuser_list()
    {
        try {
            $this->db_connect();
            
            //情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM webuser_info");
            $stmt->execute();
            
            $data = [];
            
            //全ての座席の「カードID」、「座席番号」をdataに格納
            $i = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {//情報をkeyで分けて格納
                    $data[$i][$key] = $value;
                }
                $i++;
            }
            $data['count'] = $i;
            return $data;
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    /**
     * WEBユーザ情報の変更を行う
     * @param type $user_id
     * @param type $name
     * @param type $position
     * @param type $auth
     * @return boolean
     */
    public function update_webuser_info($user_id, $name, $position, $auth, $before_id)
    {
        try {
            $this->db_connect();
            $stmt = $this->pdo->prepare("UPDATE webuser_info SET user_id = :u_id, name = :name, position = :position, auth = :auth WHERE user_id = :b_id");
            $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);// 値のbind
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':position', $position, PDO::PARAM_INT);
            $stmt->bindValue(':auth', $auth, PDO::PARAM_INT);
            $stmt->bindValue(':b_id', $before_id, PDO::PARAM_STR);//前のIDで検索して更新する
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e;
            //return FALSE;
        }
    }
    
    /**
     * WEBユーザの削除を行う
     * @param type $user_id
     * @return boolean
     */
    public function delete_webuser_info($user_id)
    {
        try {
            $this->db_connect();
            
            $stmt = $this->pdo->prepare("DELETE FROM webuser_info WHERE user_id = :u_id");
            $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);// 値のbind
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * webシステムのログイン認証用のメソッド
     * @param type $user_id
     * @param type $pass
     * @return boolean 結果を真偽で返す
     */
    public function login($user_id, $pass)
    {
        try {
            $this->db_connect();
            
            // 教室の基本情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM webuser_info WHERE user_id = :u_id");
            $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);// 値のbind
            $stmt->execute();

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($pass, $row['pass'])) {//パスワードの比較
                    session_regenerate_id(true);// IDの再生成？
                    /*役職の設定*/
                    switch ($row['position']) {
                        case 0://管理者
                            $_SESSION["position"] = "administer"; break;
                        case 1://学務
                            $_SESSION["position"] = "affairs"; break;
                        case 2://教員
                            $_SESSION["position"] = "teacher"; break;
                        default:
                            return false;
                            //$_SESSION["teacher"] = TRUE; break;
                    }
                    /*権限の設定*/
                    if ($row['auth'] == 1) {
                        $_SESSION["auth"] = true;
                    } else {
                        $_SESSION["auth"] = false;
                    }
                    $_SESSION["name"] = htmlspecialchars($row['name'], ENT_QUOTES);// エスケープ処理
                    $_SESSION["user_id"] = htmlspecialchars($row['user_id'], ENT_QUOTES);
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * androidアプリからログインを行う為のメソッド
     * @param type $user_id
     * @param type $pass
     * @return  結果をJSONで返す
     */
    public function android_login($user_id, $pass)
    {
        $data = [];
        try {
            $this->db_connect();
            
            $stmt = $this->pdo->prepare("SELECT * FROM webuser_info WHERE user_id = :u_id");
            $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);// 値のbind
            $stmt->execute();
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($pass, $row['pass'])) {//パスワードの比較
                    /*役職の設定*/
                    $data['position'] = $row['position'];//0=管理者　1=学務 2=先生
                    /*権限の設定*/
                    $data['auth'] = $row['auth'];
                    $data["name"] = htmlspecialchars($row['name'], ENT_QUOTES);// エスケープ処理
                    $data['success'] = "1";
                    return $data;
                } else {
                    $data['success'] = "0";
                    return $data;
                }
            } else {
                $data['success'] = "0";
                return $data;
            }
        } catch (PDOException $e) {
            $data['success'] = "0";
            return $data;
        }
    }
    
    /**
     * 学生ユーザのID重複をチェックする
     * @return boolean
     */
    public function check_stu_id($user_id)
    {
        try {
            $this->db_connect();
            //idの一致するデータを検索
            $stmt = $this->pdo->prepare("SELECT * FROM stu_info WHERE user_id = :u_id");
            $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);// 値のbind
            $stmt->execute();

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {// 重複が見つかればTRUEを返す
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * 学生情報を登録するメソッド
     * pass(パスワード),shot(顔写真)は機能拡張で使うかもしれないので保留
     * @param type $user_id 学籍番号
     * @param type $name 氏名
     * @param type $department 学部
     * @param type $course 学科
     * @param type $grade 学年
     * @param type $gender 性別 0:男 1:女 2:その他
     */
    public function register_stu_info($user_id, $name, $department, $course, $grade, $gender)
    {
        try {
            $this->db_connect();
            $stmt = $this->pdo->prepare("INSERT INTO stu_info(user_id,name,department,course,grade,gender) VALUES (:u_id, :name, :d, :c, :grade, :gender)");
            $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);// 値のbind
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':d', $department, PDO::PARAM_STR);
            $stmt->bindValue(':c', $course, PDO::PARAM_STR);
            $stmt->bindValue(':grade', $grade, PDO::PARAM_INT);
            $stmt->bindValue(':gender', $gender, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * 登録された学生情報のリストの取得を行う
     * @return type
     */
    public function get_stu_list()
    {
        try {
            $this->db_connect();
            
            //情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM stu_info");
            $stmt->execute();
            
            $data = [];
            
            //全ての座席の「カードID」、「座席番号」をdataに格納
            $i = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {//情報をkeyで分けて格納
                    $data[$i][$key] = $value;
                }
                $i++;
            }
            //$data['count'] = $i;
            return $data;
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    /**
     * 指定された学生情報の取得を行う
     * @param type $user_id
     * @return type
     */
    public function get_stu_info($user_id)
    {
        try {
            $this->db_connect();
            
            //情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM stu_info WHERE user_id = :u_id");
            $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);// 値のbind
            $stmt->execute();
            
            $data = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {//情報をkeyで分けて格納
                    $data[$key] = $value;
                }
            }
            return $data;
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    /**
     *
     *
     */
    public function update_stu_info($user_id, $name, $department, $course, $grade, $gender, $before_id)
    {
        try {
            $this->db_connect();
            $stmt = $this->pdo->prepare("UPDATE stu_info SET user_id = :u_id, name = :name, department = :d, course = :c, grade = :grade, gender = :gender "
                    . "WHERE user_id = :b_id");
            $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);// 値のbind
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':d', $department, PDO::PARAM_STR);
            $stmt->bindValue(':c', $course, PDO::PARAM_STR);
            $stmt->bindValue(':grade', $grade, PDO::PARAM_INT);
            $stmt->bindValue(':gender', $gender, PDO::PARAM_INT);
            $stmt->bindValue(':b_id', $before_id, PDO::PARAM_STR);//前のIDで検索して更新する
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e;
            //return FALSE;
        }
    }
    
    /**
     * 学生情報の削除を行う
     * @param type $user_id
     * @return boolean
     */
    public function delete_stu_info($user_id)
    {
        try {
            $this->db_connect();
            $stmt = $this->pdo->prepare("DELETE FROM stu_info WHERE user_id = :u_id");
            $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);// 値のbind
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    
    /*
     * ↑↑↑↑↑
     * ユーザ、ログイン関連終わり
     *
     */
    
    
    public function register_classroom_info($name)
    {
        try {
            $this->db_connect();
            $stmt = $this->pdo->prepare("INSERT INTO classroom_info(name) VALUES (:name)");
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);// 値のbind
            $stmt->execute();
            
            $room_id = $this->pdo->lastInsertId('room_id');
             
            echo $room_id;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function get_classroom_list()
    {
        try {
            $this->db_connect();
            
            //情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM classroom_info");
            $stmt->execute();
            
            $data = [];
            
            $i = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {//情報をkeyで分けて格納
                    $data[$i][$key] = $value;
                }
                $i++;
            }
            $data['count'] = $i;
            return $data;
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    /**
     * 教室情報の更新を行う
     * @param type $room_id
     * @param type $name
     * @return boolean
     */
    public function update_classroom_info($room_id, $name)
    {
        try {
            $this->db_connect();
            $stmt = $this->pdo->prepare("UPDATE classroom_info SET name = :name
                                    WHERE room_id = :r_id");
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);// 値のbind
            $stmt->bindValue(':r_id', $room_id, PDO::PARAM_INT);
            $stmt->execute();

            echo $room_id;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * 教室情報とそれに紐づけられた座席の削除を行う
     * @param type $room_id
     * @return boolean
     */
    public function delete_classroom_info($room_id)
    {
        try {
            $this->db_connect();
            /**席情報の削除**/
            $stmt = $this->pdo->prepare("DELETE FROM seat_info WHERE room_id = :r_id");
            $stmt->bindValue(':r_id', $room_id, PDO::PARAM_STR);// 値のbind
            $stmt->execute();
            
            $this->db_connect();
            /**教室情報の削除**/
            $stmt = $this->pdo->prepare("DELETE FROM classroom_info WHERE room_id = :r_id");
            $stmt->bindValue(':r_id', $room_id, PDO::PARAM_STR);// 値のbind
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * 座席情報の登録を行う
     * @param type $room_id
     * @param type $seat_number
     * @param type $point_x
     * @param type $point_y
     * @return boolean
     */
    public function register_seat_info($room_id, $seat_number, $point_x, $point_y, $card_id)
    {
        try {
            $this->db_connect();
            $stmt = $this->pdo->prepare("INSERT INTO seat_info(room_id,seat_number,point_x,point_y,card_id) VALUES (:r_id,:seat_num,:x,:y,:c_id);");
            $stmt->bindValue(':r_id', $room_id, PDO::PARAM_INT);// 値のbind
            $stmt->bindValue(':seat_num', $seat_number, PDO::PARAM_INT);
            $stmt->bindValue(':x', $point_x, PDO::PARAM_INT);
            $stmt->bindValue(':y', $point_y, PDO::PARAM_INT);
            $stmt->bindValue(':c_id', $card_id, PDO::PARAM_STR);
            $stmt->execute();
            
            $room_id = $this->pdo->lastInsertId('room_id');
            
            echo $room_id;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * 座席にカードIDを登録する関数(update文を使う)
     * @param type $room_id
     * @param type $seat_number
     * @param type $card_id
     * @return boolean
     */
    public function register_card_id($room_id, $seat_number, $card_id)
    {
        $result = [];
        try {
            $this->db_connect();
            $stmt = $this->pdo->prepare("UPDATE seat_info SET card_id = :c_id
                                    WHERE room_id = :r_id AND seat_number = :seat_num");
            $stmt->bindValue(':c_id', $card_id, PDO::PARAM_STR);// 値のbind
            $stmt->bindValue(':r_id', $room_id, PDO::PARAM_INT);
            $stmt->bindValue(':seat_num', $seat_number, PDO::PARAM_INT);
            $stmt->execute();
            
            $result['success'] = 1;
            
            return $result;
        } catch (PDOException $e) {
            $result['success'] = 0;
            
            return $result;
        }
    }
    
    /**
     * 座席情報の削除を行う
     * @param type $room_id
     * @return boolean
     */
    public function delete_seat_info($room_id)
    {
        try {
            $this->db_connect();
            /**席情報の削除**/
            $stmt = $this->pdo->prepare("DELETE FROM seat_info WHERE room_id = :r_id");
            $stmt->bindValue(':r_id', $room_id, PDO::PARAM_STR);// 値のbind
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * カード情報の新規登録を行う
     * @param type $card_id カードに元々設定されている固有ID
     * @param type $identity_id カード管理をしやすくするために設定する識別ID
     * @return int
     */
    public function register_card_info($card_id, $identity_id)
    {
        $result = [];
        try {
            $this->db_connect();
            $stmt = $this->pdo->prepare("INSERT INTO card_info(card_id,identity_id) VALUES (:c_id,:i_id)");
            $stmt->bindValue(':c_id', $card_id, PDO::PARAM_STR);// 値のbind
            $stmt->bindValue(':i_id', $identity_id, PDO::PARAM_STR);
            $check = $stmt->execute();
            
            //成否の判定
            if ($check) {
                $result['success'] = 1;
            } else {
                $result['success'] = 0;
            }
            
            return $result;
        } catch (PDOException $e) {
            $result['success'] = 0;
            
            return $result;
        }
    }
    
    /**
     * IDから登録されているカードの情報を取り出す
     * @param type $card_id
     * @return type
     */
    public function get_card_info($card_id)
    {
        try {
            $this->db_connect();
            
            //情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM card_info WHERE card_id = :c_id");
            $stmt->bindValue(':c_id', $card_id, PDO::PARAM_STR);// 値のbind
            $stmt->execute();
            
            $data = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {//情報をkeyで分けて格納
                    $data[$key] = $value;
                }
            }
            return $data;
        } catch (PDOException $e) {
            echo false;
        }
    }
    

    
    /*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
    
    /**
     * ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
     * 出席送信、集計関連
     */
    
    
    /**
     * 教室情報をデータベースから取得して配列にして返す（教室の基本情報、座席のID情報も含む）
     * @param type $classroom_id　情報を取り出したい教室のID
     * @return int
     */
    public function get_classroom_info($classroom_id)
    {
        try {
            $this->db_connect();
            
            // 教室の基本情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM classroom_info WHERE room_id = :c_id");
            $stmt->bindValue(':c_id', $classroom_id, PDO::PARAM_INT);// 値のbind
            $stmt->execute();
            
            $data = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {//情報をkeyで分けて格納
                    $data[$key] = $value;
                }
            }
            
            //座席情報の取得
            /*$stmt = $this->pdo->prepare("SELECT card_i,seat_number FROM seat_info WHERE room_id = :c_id");
            $stmt->bindValue(':c_id', $classroom_id, PDO::PARAM_INT);// 値のbind
            $stmt->execute();


            //全ての座席の「カードID」、「座席番号」をdataに格納
            $i = 0;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                foreach($row as $key => $value){//情報をkeyで分けて格納
                    $data[$i][$key] = $value;
                }
                $i++;
            }
            $data['count'] = $i;*/
            
            
            return $data;
            
            /*
            //jsonとして出力
            header('Content-type: application/json');
            echo json_encode($data);*/
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    /**
     * 講義情報の登録を行う
     * @param type $room_id 使用する教室のID
     * @param type $user_id 講義を担当する教員のID
     * @param type $name 講義名
     * @param type $day 開催する曜日(0:日,1:月,2:火,3:水,4:木,5:金,6:土)
     * @param type $period 時限(1～7)
     * @param type $season 前後期のどちらか(0:前期,1:後期)
     */
    public function register_lecture_info($room_id, $user_id, $name, $day, $period, $season)
    {
        try {
            $this->db_connect();
            $stmt = $this->pdo->prepare("INSERT INTO lecture_info(room_id,user_id,name,day,period,season) VALUES (:r_id,:u_id,:name,:d,:p,:s)");
            $stmt->bindValue(':r_id', $room_id, PDO::PARAM_INT);// 値のbind
            $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':d', $day, PDO::PARAM_INT);
            $stmt->bindValue(':p', $period, PDO::PARAM_INT);
            $stmt->bindValue(':s', $season, PDO::PARAM_INT);
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * 講義に関する情報をデータベースから取得し返すメソッド
     * @param type $lecture_id　取得したい講義のID
     * @return type
     */
    public function get_lecture_info($lecture_id)
    {
        try {
            $this->db_connect();
            
            // 教室情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM lecture_info WHERE lecture_id = :l_id");
            $stmt->bindValue(':l_id', $lecture_id, PDO::PARAM_INT);// 値のbind
            $stmt->execute();
            
            $data = array();
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {//情報をkeyで分けて格納
                    $data[$key] = $value;
                }
            }
            $rep_info = $this->get_webuser_info($data['user_id']);//担当教員の情報も取得する
            $data['rep_id'] = $rep_info['user_id'];
            $data['rep_name'] = $rep_info['name'];

            $classroom_info = $this->get_classroom_info($data['room_id']);//教室情報も取得する
            $data['room_name'] = $classroom_info['name'];
            $data['room_id'] = $classroom_info['room_id'];
            
            return $data;
            
            //jsonとして出力
            //header('Content-type: application/json');
            //echo json_encode($data);
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    /**
     * DBに登録されている講義の一覧を取得するメソッド   後日ユーザIDで絞り込むように変更を行う(8/28)
     */
    public function get_lecture_list()
    {//($user_id){
        try {
            $this->db_connect();
            
            // 教室情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM lecture_info");
            $stmt->execute();
            

            $data = [];
            
            $i = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {//情報をkeyで分けて格納
                    $data[$i][$key] = $value;
                }
                $rep_info = $this->get_webuser_info($data[$i]['user_id']);//担当教員の情報も取得する
                $data[$i]['rep_id'] = $rep_info['user_id'];
                $data[$i]['rep_name'] = $rep_info['name'];
                
                $classroom_info = $this->get_classroom_info($data[$i]['room_id']);//教室情報も取得する
                $data[$i]['room_name'] = $classroom_info['name'];
                $data[$i]['room_id'] = $classroom_info['room_id'];
                $i++;
            }
            //２次元用配列の最終値を行カウンターとして投入
            $data['count'] = $i;

            return $data;
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    public function update_lecture_info($room_id, $user_id, $name, $day, $period, $season, $lecture_id)
    {
        try {
            $this->db_connect();
            $stmt = $this->pdo->prepare("UPDATE lecture_info SET room_id = :r_id, user_id = :u_id, name = :name, day = :d, period = :p, season = :s
                                    WHERE lecture_id = :l_id");
            $stmt->bindValue(':r_id', $room_id, PDO::PARAM_INT);// 値のbind
            $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':d', $day, PDO::PARAM_INT);
            $stmt->bindValue(':p', $period, PDO::PARAM_INT);
            $stmt->bindValue(':s', $season, PDO::PARAM_INT);
            $stmt->bindValue(':l_id', $lecture_id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * 講義情報の削除を行う
     * その講義の開催情報も一緒に削除される
     * @param type $lecture_id
     * @return boolean
     */
    public function delete_lecture_info($lecture_id)
    {
        try {
            $this->db_connect();
            //講義の開催情報をすべて削除
            $this->delete_holding_list($lecture_id);
            //講義情報自体の削除
            $stmt = $this->pdo->prepare("DELETE FROM lecture_info WHERE lecture_id = :l_id");
            $stmt->bindValue(':l_id', $lecture_id, PDO::PARAM_INT);// 値のbind
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * 講義開始時に出席、第何回目などの情報を持つ開催情報をデータベースに登録するメソッド
     * add_holiding_info的な扱い
     * @param type $lecture_id　開催する講義のID
     * @param type $date　講義が開催された日付
     * @return json形式としてjavascriptにechoしている
     */
    public function start_lecture($lecture_id, $date)
    {
        try {
            $this->db_connect();
            //開催する講義に関する情報を取得i
            $l_info = $this->get_lecture_info($lecture_id);
            $room_id = $l_info['room_id'];
            $data = [];
            $count = $this->get_holding_count($lecture_id) + 1;//開催講義が何回目なのかを取得
            
            // 新たな開催情報を作成
            $stmt = $this->pdo->prepare("INSERT INTO holding_info(lecture_id,count,date,room_id)
                                VALUES (:l_id,:c,:d,:r_id);");
            $stmt->bindValue(':l_id', $lecture_id, PDO::PARAM_INT);// 値のbind
            $stmt->bindValue(':c', $count, PDO::PARAM_INT);
            $stmt->bindValue(':d', $date, PDO::PARAM_STR);
            $stmt->bindValue(':r_id', $room_id, PDO::PARAM_INT);
            
            $stmt->execute();
            
            //オートインクリメントで自動作成されたID・講義名・開催回・部屋IDをjsonで返す
            $data['holding_id'] =  $this->pdo->lastInsertId();
            $data['lecture_name'] = $l_info['name'];
            $data['count'] = $count;
            $data['room_id'] = $room_id;
            //集計リストにこの講義を追加
            $this->add_possible_attend($this->pdo->lastInsertId());
            //jsonとして出力
            header('Content-type: application/json');
            echo json_encode($data);
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    
    /**
     * ある講義の指定された回の開催情報を単体で取得する
     * @param type $holding_id
     * @return type
     */
    public function get_holding_info($holding_id)
    {
        try {
            $this->db_connect();
            
            // 教室情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM holding_info WHERE holding_id = :h_id");
            $stmt->bindValue(':h_id', $holding_id, PDO::PARAM_INT);// 値のbind
            $stmt->execute();
            
            $data = [];

            $i = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {//情報をkeyで分けて格納
                    $data[$key] = $value;
                }
            }
            
            return $data;
        } catch (PDOException $e) {
            return $e;
        }
    }
    
    /**
     * 指定された講義の開催情報を全て取得する
     * @param type $lecture_id
     * @return int
     */
    public function get_holding_list($lecture_id)
    {
        try {
            $this->db_connect();
            
            // 教室情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM holding_info WHERE lecture_id = :l_id");
            $stmt->bindValue(':l_id', $lecture_id, PDO::PARAM_INT);// 値のbind
            $stmt->execute();
            
            $data = [];

            $i = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {//情報をkeyで分けて格納
                    $data[$i][$key] = $value;
                }
                $i++;
            }
            //２次元用配列の最終値を行カウンターとして投入
            $data['count'] = $i;
            
            return $data;
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    
    /**
     * とある講義が現在何回行われているかを返すメソッド
     * @param type $lecture_id　開講回数を知りたい講義のID
     * @return type 現在登録されている講義情報の数
     */
    public function get_holding_count($lecture_id)
    {
        try {
            $this->db_connect();
            
            // 開催情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM holding_info WHERE lecture_id = :l_id");
            $stmt->bindValue(':l_id', $lecture_id, PDO::PARAM_INT);// 値のbind
            $stmt->execute();
            
            //回数を変数に格納（rowCountは非推奨？正常に動かないようなら変える）
            $count = $stmt->rowCount();

            return $count;
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    /**
     * 講義の開催情報(1回分)を削除する
     * @param type $holding_info
     */
    public function delete_holding_info($holding_id)
    {
        try {
            $this->db_connect();
            
            $stmt = $this->pdo->prepare("DELETE FROM holding_info WHERE holding_id = :h_id");
            $stmt->bindValue(':h_id', $holding_id, PDO::PARAM_INT);// 値のbind
            $stmt->execute();

            echo true;
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    /**
     * 指定講義の開催情報を全て削除する
     * @param type $lecture_id
     */
    public function delete_holding_list($lecture_id)
    {
        try {
            $this->db_connect();
            
            $stmt = $this->pdo->prepare("DELETE FROM holding_info WHERE l_id = :l_id");
            $stmt->bindValue(':l_id', $lecture_id, PDO::PARAM_INT);// 値のbind
            $stmt->execute();

            echo true;
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    /**
     * 現在登録されているカードIDのリスト一覧を取得（デバック用
     * 後から引数に教室IDを入れる可能性有
     * →入れた(10/12)
     */
    public function get_seat_list($room_id)
    {
        try {
            $this->db_connect();
            
            // 教室情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM seat_info WHERE room_id = :r_id");
            $stmt->bindValue(':r_id', $room_id, PDO::PARAM_INT);// 値のbind
            $stmt->execute();
            
            $data = [];

            $i = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {//情報をkeyで分けて格納
                    $data[$i][$key] = $value;
                }
                //席に設定されたカードIDからカードの詳細情報を取り出す
                $card_info = $this->get_card_info($data[$i]['card_id']);
                $data[$i]['identity_id'] = $card_info['identity_id'];
                $i++;
            }
            //２次元用配列の最終値を行カウンターとして投入
            $data['count'] = $i;
            
            //sqlの結果配列を座席番号順でソートする
            foreach ((array) $data as $key => $value) {
                $sort[$key] = $value['seat_number'];
            }

            array_multisort($sort, SORT_ASC, $data);
            return $data;
            /*
            //jsonとして出力
            header('Content-type: application/json');
            return json_encode($data);*/
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    
    
    /**
     * 座席カードIDから席情報(番号)を取得するメソッド
     * @param type $idm　座席のカードのID
     * @return type IDに対応する座席の番号
     */
    public function get_seat_info($idm)
    {
        try {
            $this->db_connect();
            
            // 情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM seat_info WHERE  card_id = :idm");
            $stmt->bindValue(':idm', $idm, PDO::PARAM_STR);//bind
            
            $stmt->execute();
            
            $data = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {//情報をkeyで分けて格納
                    $data[$key] = $value;
                }
                //席に設定されたカードIDからカードの詳細情報を取り出す
                $card_info = $this->get_card_info($data['card_id']);
                $data['identity_id'] = $card_info['identity_id'];
            }
            return $data;
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    /**
     * 出席情報をデータベースに登録するメソッド
     * @param type $holding_id
     * @param type $user_id
     * @param type $card_id
     * @param type $memo
     */
    public function send_attend_info($holding_id, $user_id, $card_id, $memo)
    {
        if ($this->check_already_attend($holding_id, $user_id)) {/*既に出席されていれば情報の更新(座席移動)を行う*/
            try {
                $this->db_connect();
                $stmt = $this->pdo->prepare("UPDATE attend_info SET card_id = :c_id
                                             WHERE holding_id = :h_id AND user_id = :u_id");
                $stmt->bindValue(':c_id', $card_id, PDO::PARAM_STR); // 値のbind
                $stmt->bindValue(':h_id', $holding_id, PDO::PARAM_INT);
                $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $e) {
                echo $e;
            }
        } else {/*出席されていなければ通常の出席処理を行う*/
            try {
                $this->db_connect();
                // 出席情報を送信
                $stmt = $this->pdo->prepare("INSERT INTO attend_info(holding_id,user_id,card_id,memo,late_info)
                                    VALUES (:h_id,:u_id,:c_id,:m,0);");
                $stmt->bindValue(':h_id', $holding_id, PDO::PARAM_INT);// 値のbind
                $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);
                $stmt->bindValue(':c_id', $card_id, PDO::PARAM_STR);
                $stmt->bindValue(':m', $memo, PDO::PARAM_STR);

                $stmt->execute();
            } catch (PDOException $e) {
                echo $e;
            }
        }
    }
    
    /**
     * 既に同講義に同学生が出席しているか確認を行うメソッド
     * @param type $holding_id
     * @param type $user_id
     * @return boolean
     */
    public function check_already_attend($holding_id, $user_id)
    {
        try {
            $this->db_connect();
            
            // 情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM attend_info WHERE  holding_id = :h_id AND user_id = :u_id");
            $stmt->bindValue(':h_id', $holding_id, PDO::PARAM_INT);//bind
            $stmt->bindValue(':u_id', $user_id, PDO::PARAM_STR);
            $stmt->execute();


            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {//既に出席していた場合
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * 既に同講義に同学生が出席しているか確認を行うメソッド
     * @param type $card_id
     * @param type $holding_id
     * @return boolean
     */
    public function check_empty_seat($card_id, $holding_id)
    {
        try {
            $this->db_connect();
            
            // 情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM attend_info WHERE card_id = :c_id AND holding_id = :h_id");
            $stmt->bindValue(':c_id', $card_id, PDO::PARAM_STR);//bind
            $stmt->bindValue(':h_id', $holding_id, PDO::PARAM_INT);
            $stmt->execute();


            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {//既に出席していた場合
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    
    
    
    /**
     * 指定講義の出席状況をデータベースから取得して返す
     * @param type $holding_id 授業開催情報のID
     * @return json出力をechoで行っている
     */
    public function get_attend_list($holding_id)
    {
        try {
            $this->db_connect();
            
            // 教室情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM attend_info WHERE holding_id = :h_id");
            $stmt->bindValue(':h_id', $holding_id, PDO::PARAM_INT);// 値のbind
            $stmt->execute();
            
            $data = [];

            $i = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {//情報をkeyで分けて格納
                    $data[$i][$key] = htmlspecialchars($value);
                }
                //ユーザIDより名前を取得
                $data[$i]['name'] = $this->get_stu_info($data[$i]['user_id'])['name'];
                //カードIDより座席番号を取得
                $data[$i]['seat_num'] = $this->get_seat_info($data[$i]['card_id'])['seat_number'];//番号を入れている
                $i++;
            }
            
            //２次元用配列の最終値を行カウンターとして投入
            $data['count'] = $i;
            
            return $data;
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    /**
     * 出席座席のメモ内容が変更された場合それを適用する
     */
    public function update_attend_info_memo($attend_id, $memo)
    {
        try {
            $this->db_connect();
            $stmt = $this->pdo->prepare("UPDATE attend_info SET memo = :m
                                         WHERE attend_id = :a_id");
            $stmt->bindValue(':m', $memo, PDO::PARAM_STR); // 値のbind
            $stmt->bindValue(':a_id', $attend_id, PDO::PARAM_INT);
            $stmt->execute();
            
            echo true;
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    public function add_possible_attend($holding_id)
    {
        try {
            $this->db_connect();
            
            $stmt = $this->pdo->prepare("INSERT INTO possible_attend_list(holding_id)
                                VALUES(:h_id);");
            $stmt->bindValue(':h_id', $holding_id, PDO::PARAM_INT);// 値のbind
            $stmt->execute();
        } catch (PDOException $e) {
            echo false;
        }
    }

    
    public function get_possible_attend_list()
    {
        try {
            $this->db_connect();
            
            // 教室情報を取得
            $stmt = $this->pdo->prepare("SELECT * FROM possible_attend_list");
            $stmt->execute();
            

            $data = [];
            $lecture_data_array = [];
            
            $i = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {//情報をkeyで分けて格納
                    $data[$i][$key] = $value;
                }
                
                /*
                    表示文字列の作成(例：第n回●●入門
                    英語の時困るからなんとかしよ(2018/08/19)→st,nd,ed,th付ける処理実装完了
                    →「#number」にやっぱり変更
                */

                /*
                    新処理20190908
                    講義情報のAPIのJSON形式を企業ベースに整形した
                */
                $lecture_data = [];

                $h_info = $this->get_holding_info($data[$i]['holding_id']);
                $l_info = $this->get_lecture_info($h_info['lecture_id']);

                $text = (string)$l_info['name'] . " #" . (string)$h_info['count'];// 講義情報のテキスト
                $lecture_data['text'] = $text;
                $lecture_data['room_name'] = (string)$l_info['room_name'];// 使用部屋名のテキスト
                $lecture_data['rep_name'] = (string)$l_info['rep_name']; // 担当教員名のテキスト
                $lecture_data["holding_id"] = $data[$i]['holding_id']; // 固有ID
                
                $lecture_data_array[$i] = $lecture_data; // 講義を順番にリスト化

                // 旧処理 20190908 　retrofit使用時、リストの添え字($i)で不具合が出たため
                /*
                $h_info = $this->get_holding_info($data[$i]['holding_id']);
                $l_info = $this->get_lecture_info($h_info['lecture_id']);

                $text = (string)$l_info['name'] . " #" . (string)$h_info['count'];// 講義情報のテキスト
                $data[$i]['text'] = $text;
                $data[$i]['room_name'] = (string)$l_info['room_name'];// 使用部屋名のテキスト
                $data[$i]['rep_name'] = (string)$l_info['rep_name']; // 担当教員名のテキスト
                */
                $i++;
            }
            // 新処理 20190908
            $data["results"] = $lecture_data_array; // リスト化した講義をresultに格納
            //２次元用配列の最終値を行カウンターとして投入
            $data['count'] = $i;
            return $data;
        } catch (PDOException $e) {
            echo false;
        }
    }
    
    public function delete_possible_attend($holding_id)
    {
        try {
            $this->db_connect();
            
            $stmt = $this->pdo->prepare("DELETE FROM possible_attend_list WHERE holding_id = :h_id");
            $stmt->bindValue(':h_id', $holding_id, PDO::PARAM_INT);// 値のbind
            $stmt->execute();

            echo true;
        } catch (PDOException $e) {
            echo false;
        }
    }
}
