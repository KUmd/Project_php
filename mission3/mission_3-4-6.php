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
$filename1="mission_3-4-1.txt";

//送信フォームと削除フォームで分岐
if(!empty($name)&&($comment)){


//投稿時間
$timestamp=time();

//ファイルの存在がある場合は投稿番号+1、なかったら１を指定する
if (file_exists($filename1)) {
    $num = count(file($filename1))+1;
} else {
    $num = 1;
}
//}
//テキスト保存
$file=fopen($filename1,"a");
fwrite($file,$num."<>".$name."<>".$comment."<>".date("Y/m/d  H:i:s" , $timestamp )."\r\n");
fclose($file);


//ファイルの表示
$fp=fopen($filename1,"r");

//全て表示
echo "画面表示<br>";
//while ($txt= fgets($fp)) {
  
  //echo "$txt<br />";
//}

echo "配列表示<br>";
//配列に格納
$array=file($filename1);

//foreach($array as $comment){
//echo $comment."<br>";
//}

//<>なし表示
for($i=0;$i<$num;$i++){
$line=$array[$i];
$s=explode("<>", $line);
//print_r($s);
$data=implode(" ",$s );
echo $data."<br>";
}

fclose($fp);

}

//削除フォーム
else if(!empty($delete)){

//配列に格納
$array=file($filename1);

//<>なし表示
for($i=0;$i<count($array);$i++){
$line=$array[$i];
$s=explode("<>", $line);
//print_r($s);
//削除番号が違ったら、ファイルに書き写す
if($s[0]===$delete){
$file=fopen("mission3-4-1x","a");
fwrite($file,"削除します\r\n");
fclose($file);

}

else {
$file=fopen("mission_3-4-1x.txt","a");
fwrite($file,$array[$i]."\r\n");
fclose($file);
}

}

}
else if(!empty($change)){

//配列に格納
$array=file($filename1);

for($i=0;$i<count($array);$i++){
$line=$array[$i];
$s=explode("<>", $line);
echo "配列の中身居いいいい<br>";
print_r($s);
//編集番号が同じなら「名前」「コメント」を取得、表示
if($s[0]===$change){
 $newline = "$name,$comment\n";
 array_splice($array,$i,1,"$newline");
 
}


}
}
else{

echo "保存されません<br>";
}
?>

