<?php
//DB設定
$host = 'localhost';
$user = 'root';
$pass = 'wei123';
$database = 'enquiry';

// sql insert
function sql_insert($query, $subject, $name, $email, $phone, $body)
{
        global $host,$user,$pass,$database;
        // DBに接続
        $conn = mysqli_connect($host, $user, $pass, $database);
        $runquery = mysqli_prepare($conn, $query);
        // sql injection の予防
        // プリペアドステートメントのパラメータに変数をバインドする
        $runquery->bind_param( 'sssis', $subject, $name, $email, $phone, $body );
        // 実行
        $runquery->execute();
        return $runquery->affected_rows;
}

//HTMLを解析置き換えて出力する
function read_and_parser($filename,$parser_array=null)
{
        $handle = fopen($filename,'r');
        $buffer = fread($handle,filesize($filename));

        if( !empty($parser_array) )
        foreach ($parser_array as $key => &$val)
        {
                // 置き換える
                $buffer = str_replace($key,$val,$buffer);
        }
        fclose($handle);
        return $buffer;
}

// メール送信
function send_email( $body ){
        $to_email = "clerkhsiao@gmail.com";
        $subject = "お問い合わせありがとうございます。";
        $headers = "From: 問い合わせセンター";
        return mail($to_email, $subject, $body, $headers);
}
// 先頭や末尾の空白文字や改行コードを削除する方法
function variable_trim( $array ){
        foreach ($array as $key => $value) {
                $array[$key] = trim($value);
        }
        return $array;
}

// 件名の転換
function subject_convert( $subject ){
        if( $subject == 2 ){
                return "ご意見";
        }else if( $subject == 3 ){
                return "ご感想";
        }else if( $subject == 4 ){
                return "その他";
        }else{
                return $subject;
        }
}
?>