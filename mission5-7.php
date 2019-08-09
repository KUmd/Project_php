<?php
	$dsn = 'データベース名';
	$user = 'ユーザー名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
	$editNumber="";
	$editName="";
	$editComment="";	
	$editPass1="";
	$editPass2="";
	$editPass3="";

	

	//表作る
	$sql = "CREATE TABLE IF NOT EXISTS tbtest2"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name CHAR(32),"
	. "comment TEXT,"
	. "date TEXT,"
	. "pass TEXT"
	.");";
	$stmt = $pdo->query($sql);

	//$timestamp=time();

	if(!empty($_POST["normal"])){
		if(empty($_POST["edit_post"])){
			if(!empty($_POST["name"])&&!empty($_POST["comment"])){

								
				$name = $_POST["name"];
				$comment = $_POST["comment"];
				$date = new DateTime(); 
				$date = $date->format('Y-m-d H:i:s'); 
				$pass = $_POST["password1"];
				$sql = $pdo -> prepare("INSERT INTO tbtest2 (name, comment, date, pass) VALUES (:name, :comment, :date, :pass)");
				$sql -> bindParam(':name', $name, PDO::PARAM_STR);
				$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
				$sql -> bindParam(':date', $date, PDO::PARAM_STR);
				$sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
				$sql -> execute();
			}

			else{
				echo "保存されません<br>";
			}
		}
		else{
			if(!empty($_POST["name"])&&!empty($_POST["comment"])){
				
				$id2=$_POST["edit_post"];
				$sql = 'SELECT * FROM tbtest2';
				$stmt = $pdo->query($sql);
				$results = $stmt->fetchAll();
				foreach ($results as $row){
					if($id2==$row['id']){
						$id = $_POST["edit_post"];
						$name = $_POST["name"];
						$comment = $_POST["comment"]; //変更したい名前、変更したいコメントは自分で決めること
						$date = new DateTime(); 
						$date = $date->format('Y-m-d H:i:s'); 
						$pass = $_POST["password1"];
						$sql = 'update tbtest2 set name=:name,comment=:comment,date=:date,pass=:pass where id=:id';
						$stmt = $pdo->prepare($sql);
						$stmt->bindParam(':name', $name, PDO::PARAM_STR);
						$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
						$stmt->bindParam(':id', $id, PDO::PARAM_INT);
						$stmt -> bindParam(':date', $date, PDO::PARAM_STR);
						$stmt -> bindParam(':pass', $pass, PDO::PARAM_STR);
				
						$stmt->execute();
					}
				}
			}
			else{
				echo "編集できません<br>";
			}
		}
	}

	//編集フォーム
	else if((!empty($_POST["edit"]))&&(!empty($_POST["password3"]))){
	
		$id =$_POST["edit"];//変更する投稿番号
		$pass2 = $_POST["password3"];
		$sql = 'SELECT * FROM tbtest2';
		$stmt = $pdo->query($sql);
		$results = $stmt->fetchAll();
		
		//既存フォームに表示
		foreach ($results as $row){
			if(($id==$row['id'])&&($pass2==$row['pass'])){
				$editNumber=$row['id'];
				$editName=$row['name'];
				$editComment=$row['comment'];

			}
		}
	}

	//削除フォーム
	else if((!empty($_POST["delete"]))&&(!empty($_POST["password2"]))){
		$id = $_POST["delete"];
		$pass=  $_POST["password2"];
		$sql = 'SELECT * FROM tbtest2';
		$stmt = $pdo->query($sql);
		$results = $stmt->fetchAll();
		foreach ($results as $row){
			if(($id==$row['id'])&&($pass==$row['pass'])){
				$sql = 'delete from tbtest2 where id=:id';
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->execute();
			}
		}
	
		
	}


	else{
		echo"操作できません<br>";
	}

?>	

<html>
<head>
<title>sample</title>
</head>
<body>
<form action="" method="post">
  <input type="hidden" name="edit_post" value="<?php echo $editNumber; ?>">

  名前<br />
  <input type="text" name="name" size="30" value="<?php echo $editName; ?>" /><br />
  
  コメント<br />
  <input type="text" name="comment" size="60" value="<?php echo $editComment; ?>" /><br />
  パスワード<br />
  <input type="text" name="password1" size="30" value="<?php echo $editPass1; ?>" /><br />
  
  <input type="submit" name="normal" value="送信"><br />

  削除対象番号：<br />
  <input type="text" name="delete" size="20" value="" /><br />
  パスワード<br />
  <input type="text" name="password2" size="30" value="<?php echo $editPass2; ?>" /><br />
  
  <input type="submit" value="削除" /><br />

  編集対象番号：<br />
  <input type="text" name="edit" size="20" value="" /><br />
  パスワード<br />
  <input type="text" name="password3" size="30" value="<?php echo $editPass3; ?>" /><br />
  
  <input type="submit" value="編集" />

</form>
</body>
</html>
	

<?php
	$sql = 'SELECT * FROM tbtest2';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//画面表示
		echo $row['id'].'<>';
		echo $row['name'].'<>';
		echo $row['comment'].'<>';
		echo $row['date'].'<>';
		//echo $row['pass'].'<br>';

	echo "<hr>";
	}

?>

