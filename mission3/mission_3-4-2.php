<html>
<head>
<title>sample</title>
</head>
<body>
<form action="" method="post">
  名前：<br />
  <input type="text" name="name" size="30" value="名前" /><br />
  
  コメント：<br />
  <input type="text" name="comment" size="60" value="コメント" /><br />
  
  <input type="submit" value="送信" />
  削除対象番号：<br />
  <input type="text" name="delete" size="20" value="" /><br />
  
  <input type="submit" value="削除" />

  編集対象番号：<br />
  <input type="text" name="change" size="20" value="" /><br />
  
  <input type="submit" value="編集" />



</form>
</body>
</html>

<?php

$name=$_POST["name"];
$comment=$_POST["comment"];
$delete=$_POST["delete"];
$change=$_POST["change"];


//送信フォームと削除フォームで分岐
if(!empty($name)&&($comment)){


//投稿時間
$timestamp=time();

$filename="mission_3-3-1x.txt";
//ファイルの存在がある場合は投稿番号+1、なかったら１を指定する
if (file_exists($filename)) {
    $num = count(file($filename))+1;
} else {
    $num = 1;
}
//}
//テキスト保存
$file=fopen("mission_3-3-1x.txt","a");
fwrite($file,$num."<>".$name."<>".$comment."<>".date("Y/m/d  H:i:s" , $timestamp )."\r\n");
fclose($file);


//ファイルの表示
$filename="mission_3-3-1x.txt";
$fp=fopen($filename,"r");

//全て表示
echo "画面表示<br>";
//while ($txt= fgets($fp)) {
  
  //echo "$txt<br />";
//}

echo "配列表示<br>";
//配列に格納
$array=file($filename);

//foreach($array as $comment){
//echo $comment."<br>";
//}

//<>なし表示
//for($i=0;$i<$num;$i++){
//$line=$array[$i];
//$s=explode("<>", $line);
//print_r($s);
//$data=implode(" ",$s );
//echo $data."<br>";
//}

fclose($fp);

}

//削除フォーム
else if(!empty($delete)){

$filename="mission_3-3-1x.txt";

//配列に格納
$array=file($filename);

//<>なし表示
for($i=0;$i<count($array);$i++){
$line=$array[$i];
$s=explode("<>", $line);
//print_r($s);
//削除番号が違ったら、ファイルに書き写す
if($s[0]===$delete){
$file=fopen("mission_3-3-2.txt","a");
fwrite($file,"削除します\r\n");
fclose($file);

}

else {
$file=fopen("mission_3-3-2.txt","a");
fwrite($file,$s."\r\n");
fclose($file);

//$file=fopen("mission_3-3-1.txt","a");
//fwrite($file,"削除します\r\n");
//fclose($file);

}

}

}
else if(!empty($change)){
$filename="mission_3-3-1x.txt";

//配列に格納
$array=file($filename);

for($i=0;$i<count($array);$i++){
$line=$array[$i];
$s=explode("<>", $line);
echo "配列の中身居いいいい<br>";
print_r($s);
//編集番号が同じなら「名前」「コメント」を取得、表示
if($s[0]===$change){
echo "<font color=blue>No$line[0]の書き込みを編集できます</font><br>";
echo "<form method=POST action=test.php>";
echo "題名<input type='text' name='name' size='20' value='" . $s[1] . "'><br>";
echo "<input type='text' name='comment' size='60' value='" . $s[2] . "'><br>";
echo "<input type='submit' name='uwagaki' value='上書き保存'><input type='hidden' name='bno' value='".$change. "'>";
echo "</form>";
break;

}


}
}
else{

echo "保存されません<br>";
}
?>

