<?php
	$dsn = 'データベース名';
	$user = 'ユーザ名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	$sql2 ='SHOW CREATE TABLE tbtest';
	$result = $pdo -> query($sql2);
	foreach ($result as $row){
		echo $row[1];
	}
	echo "<hr>";
?>