<?php

$filename1="mission_3-4-10.txt";
$filename2="mission_3-4-12.txt";
$editPassword1 = '';
$editPassword2 = '';


//送信フォームと削除フォームで分岐
if(!empty($_POST["name"])&&!empty($_POST["comment"])&&!empty($_POST["Password1"])){

	//投稿時間
	$timestamp=time();

	//ファイルの存在がある場合は投稿番号+1、なかったら１を指定する
	if (file_exists($filename1)) {
    		$num = count(file($filename1))+1;
	} 
	else {
   		$num = 1;
	}

	if(isset($_POST["edit_post"])){
		//テキスト保存
		$file=fopen($filename1,"a");
		fwrite($file,$num."<>".$_POST["name"]."<>".$_POST["comment"]."<>".date("Y/m/d  H:i:s" , $timestamp )."<>".$_POST["Password1"]."\r\n");
		fclose($file);
	}

}

//削除フォーム
if(!empty($_POST["delete"])&&!empty($_POST["Password2"])){

	//配列に格納
	$array=file($filename1);

	//<>なし表示
	for($i=0;$i<count($array);$i++){
		$line=$array[$i];
		$s=explode("<>", $line);
		//削除番号が違ったら、ファイルに書き写す;
		if($s[0]===$_POST["delete"]){
			if($s[4]==$_POST["Password2"]){
				$file=fopen($filename2,"a");
				fwrite($file,"削除します\r\n");
				fclose($file);
			}

		}

		else {
		$file=fopen($filename2,"a");
		fwrite($file,$line."\r\n");
		fclose($file);
		}

	}

}
else{

	echo "保存されません<br>";
}

?>



<?php

$editPassword3 = '';
//編集部分
// ファイルからデータ読み取り
$filename = "mission_3-4-10.txt";

//ファイルの表示
$fp=fopen($filename,"r");

// オプションのパラメータの意味は
// https://www.php.net/manual/ja/function.file.php
$lines = file($filename);

// 編集用データ格納変数
$editNumber = '';
$editName = '';
$editComment = '';

// 送信内容によって処理が分かれる
if(isset($_POST["edit"])&&!empty($_POST["Password3"])) {
     
	// データ件数分処理
        foreach($lines as $row) {
		// <>で分割して配列に
		$data = explode("<>", $row);
		// 編集対象番号のときはデータをセットする
		if($data[0] == $_POST["number"]) {
			if($data[4]===$_POST["Password3"]){
                		$editNumber = $data[0];
                		$editName = $data[1];
                		$editComment = $data[2];
                		// 即抜ける
                		break;
			}
		}
        }
    
   
}
	
    

else if(isset($_POST["normal"])&&!empty($_POST["Password1"])) {
        // 書き込みか上書きかをするところ
	$filename2="mission_3-4-13.txt";

        // 書き込むデータを作る
        $writeData = ($_POST["edit_post"] ?: count($lines) + 1) . "<>" . $_POST["name"] . "<>" . $_POST["comment"]."<>".$_POST["Password1"];

        // 編集番号があればデータループして場所を特定して上書きする
	
        if(isset($_POST["edit_post"])&&isset($_POST["Password1"])) {
		// データ件数分処理(&で参照にしてる)
		for($i=0;$i<count(lines);$i++) {
                	// <>で分割して配列に
                	$Data = explode("<>", $lines);
			//echo $Data[0]."<br>";
			//echo $_POST["Password1"]."<br>";
			//echo var_export($_POST["Password1"] == trim($Data[4]));
                	// 編集番号のところだったら上書き
                	if($Data[0] == $_POST["edit_post"]) {
				echo $Data[0]."aaa<br>";
				if(trim($Data[4])===$_POST["Password1"]){
					echo $Data[4]."aaa<br>";
                    			$lines[i] = $writeData;
					echo $row."<br>";
				}
                	}
            	}
	echo "aaa<br>";
        }
        else {
            // 新規投稿なので最後に追加
            $lines[] = $writeData;
        }

        // ファイルに書き込む(implodeで配列を改行付き文字列へ)
        file_put_contents($filename2, implode("\n", $lines));
}
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>課題</title>
</head>
<body>
<form action="" method="POST">
<input type="hidden" name="edit_post" value="<?php echo $editNumber; ?>">
名前<br />
<input type="text" name="name" value="<?php echo $editName; ?>">
<br />
コメント<br />
<textarea name="comment" rows="4" cols="40"><?php echo $editComment; ?></textarea>
<br />
パスワード<br />
<input type="text" name="Password1" value="<?php echo $editPassword1; ?>">
<br />
<input type="submit" name="normal" value="送信">
<br />
<hr>
削除対象番号<br />
<input type="text" name="delete" size="20" value="" /><br />
パスワード<br />
<input type="text" name="Password2" value="<?php echo $editPassword2; ?>">
<br />
<input type="submit" value="削除" />
</form>

<form action="" method="POST">
編集番号を入力<br />
<input type="text" name="number" value="">
<br />
パスワード<br />
<input type="text" name="Password3" value="<?php echo $editPassword3; ?>">
<br />
<input type="submit" name="edit" value="編集">
</form>
</body>
</html>