<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>mission_5-1</title>
</head>
<body>


<?php
//DB接続設定
$dsn = 'mysql:dbname=XXXDB;host=localhost';
$user = 'XXXUSER';
$password = 'XXXPASSWORD';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//テーブルの作成
$sql = "CREATE TABLE IF NOT EXISTS m_5"
." ("
. "id INT AUTO_INCREMENT PRIMARY KEY,"
. "name CHAR(32),"
. "comment TEXT,"
. "datetime DATETIME,"
. "password TEXT"
.");";
$stmt = $pdo->query($sql);

?>

       
</body>
</head>