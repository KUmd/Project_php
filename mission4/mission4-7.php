<?php
	$dsn = '�f�[�^�x�[�X��';
	$user = '���[�U��';
	$password = '�p�X���[�h';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	$id = 1; //�ύX���铊�e�ԍ�
	$name = "nnn";
	$comment = "xftxkfyhf"; //�ύX���������O�A�ύX�������R�����g�͎����Ō��߂邱��
	$sql = 'update tbtest set name=:name,comment=:comment where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$sql = 'SELECT * FROM tbtest';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$row�̒��ɂ̓e�[�u���̃J������������
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}

	
?>