<?php
$user = 'ユーザ名';
$pass = 'パスワード';
$dsn='データベース名';

try {
    // MySQLへの接続
    $dbh = new PDO($dsn, $user, $pass);

} catch (PDOException $e) { // PDOExceptionをキャッチする
    print "エラー!: " . $e->getMessage() . "<br/gt;";
    die();
}
?>