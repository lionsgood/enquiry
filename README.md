# お問い合わせフォーム

## 開発環境

XAMPP:
PHP 8.1.4
Apache 2.4.53
MariaDB 10.4.24
PhpMyAdmin 5.1.3
JavaScript
CSS

## 実装に費やした時間

プログラミング:5時間
テスト:2時間

## 実装中に問題となったこと・工夫したところ

・いつもPHPのMVCフレームワークで開発していましたが、ピュアのPHPでソースコードを分離した経験があまりないため、どうやって分離するかグーグル等で調べながら開発していました。

## 改善点

・フレームワークのようにModel、View、Controllerでソースコードを分離したほうが、機能ごとの分離が明確になることによって、それぞれの独立性が確保されます。
・画面のデザイン

## どのような動作テストを行ったか
・バリデーションのテスト( 文字列、数字、必須など )
・データベースへ登録保存ができるかどうか
・データベースに登録される値がフロント側で入力した値と合致するかどうか
・管理者の送信先へメールが送信されるかどうか
・確認ページで修正ボタンをクリックした際に、お問い合わせフォームに戻り、入力値が記録されるかどうか

## 参考資料又は参考サイト
・https://www.itread01.com/articles/1478429705.html
・https://www.php.net/manual/ja/mysqli-stmt.bind-param.php
・https://codingdeekshi.com/php-7-script-to-insert-data-to-mysql-database-using-prepared-statements-and-preventing-sql-injection/
