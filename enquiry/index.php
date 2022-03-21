<?php
include_once('function.php');

$page = 'index.html';
$varaible_array = array();
$variable_arr['{subject_msg}'] = "";
$variable_arr['{name_msg}'] = "";
$variable_arr['{email_msg}'] = "";
$variable_arr['{phone_msg}'] = "";
$variable_arr['{body_msg}'] = "";
$variable_arr['{subject}'] = "";
$variable_arr['{name}'] = "";
$variable_arr['{email}'] = "";
$variable_arr['{phone}'] = "";
$variable_arr['{body}'] = "";
$variable_arr['{subject_selected}'] = "";
$variable_arr['{subject_name}'] = "";


//送信後のバリデーション
if( isset($_POST['submit']) )
{
        //エラー数の初期化
        $error_count = 0;
        //件名の入力チェック
        if( $_POST["subject"] == 1 )
        {
                $variable_arr['{subject_msg}'] = "件名を入力してください。";
                $error_count++;
        }
        else
        {
                $variable_arr['{subject_msg}'] = "";
        }
        
        //名前の入力チェック
        if( $_POST["name"] == "" )
        {
                $variable_arr['{name_msg}'] = "名前を入力してください。";
                $error_count++;
        }
        else
        {
                $variable_arr['{name_msg}'] = "";
        }
        //メールアドレスの入力チェック
        if( $_POST["email"] == "" )
        {
                $variable_arr['{email_msg}'] = "メールアドレスを入力してください。";
                $error_count++;
        }
        else
        {
                //メールアドレスのフォーマットチェック
                $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
                if (!preg_match($pattern,$_POST["email"]))
                {
                        $variable_arr['{email_msg}'] = "メールアドレスのフォーマットが正しくありません。";
                        $error_count++;
                }
                else
                {
                        $variable_arr['{email_msg}'] = "";
                }
        }
        //電話番号の入力チェック
        if( $_POST["phone"] == "" )
        {
                $variable_arr['{phone_msg}'] = "電話番号を入力してください。";
                $error_count++;
        }
        else
        {
                //電話番号のフォーマットチェック
                if (!preg_match('#[0-9]#',$_POST["phone"]))
                {
                        $variable_arr['{phone_msg}'] = "数字を入力してください。";
                        $error_count++;
                }
                else
                {
                        $variable_arr['{phone_msg}'] = "";
                }
        }
        //問い合わせ内容の入力チェック
        if( $_POST["body"] == "" )
        {
                $variable_arr['{body_msg}'] = "お問い合わせ内容を入力してください。";
                $error_count++;
        }
        else
        {
                $variable_arr['{body_msg}'] = "";
        }
        //バリデーションのチェックでエラーがなければ
        if( $error_count == 0 )
        {
                $_POST = variable_trim($_POST);
                $variable_arr['{subject}'] = $_POST["subject"];
                $variable_arr['{name}']    = $_POST["name"];
                $variable_arr['{email}']   = $_POST["email"];
                $variable_arr['{phone}']   = $_POST["phone"];
                $variable_arr['{body}']    = $_POST["body"];
                $variable_arr['{subject_selected}'] = $_POST["subject_selected"];
        
                if( isset($_POST["edit"]) && $_POST["edit"] == 1 )
                {
                        $page =  'index.html';
                }
                else if( isset($_POST["send"]) && $_POST["send"] == 1 )
                {
                        $sql = "INSERT INTO form ( subject, name, email, phone, body )VALUES(?,?,?,?,?)";
                        $result = sql_insert($sql, $_POST["subject"],  $_POST["name"], $_POST["email"], $_POST["phone"], $_POST["body"] );
                        $body = "";
                        $body .= "件名：".subject_convert($_POST["subject"])."\n";
                        $body .= "名前：".$_POST["name"]."\n";
                        $body .= "メールアドレス：".$_POST["email"]."\n";
                        $body .= "電話番号：".$_POST["phone"]."\n";
                        $body .= "お問い合わせ内容：".$_POST["body"]."\n";
                        if( send_email($body) )
                        {
                                header("Location: completed.php");
                        }
                        else
                        {
                                header("Location: fail.php");
                        }
                }
                else
                {
                        $variable_arr['{subject_name}']    = subject_convert($_POST["subject"]);
                        $page =  'confirm.html';
                }
        }
}
$output = read_and_parser($page,$variable_arr);//変数置き換える

echo $output;//顯示頁面  

?>