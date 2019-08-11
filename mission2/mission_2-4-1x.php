<html>
<head>
<title>sample</title>
</head>
<body>
<form action="" method="post">
  入力：<br />
  <input type="text" name="name" size="30" value="コメント" /><br />
  <br />
  <input type="submit" value="送信" />
</form>
</body>
</html>

<?php

if(isset($_POST["name"])){

$comment=$_POST["name"];
echo $comment."を受け付けました。";

if($_POST["name"]==="hello"){
echo "hello<br>";
}

else if($_POST["name"]==="C"){
echo "優勝<br>";
}

else{
echo "あ<br>";
}
//テキスト保存
$file=fopen("mission_2-4.txt","a");
fwrite($file,"$comment\n");
fclose($file);

//ファイルの表示
$filename="mission_2-4.txt";
$fp=fopen($filename,"r");

//全て表示
while ($txt= fgets($fp)) {
 
  echo "$array<br />";
}

//配列に格納
$array=file($filename);
print_r($array);

//
//$txt=fgets($fp);

//echo $txt."<br>";
fclose($fp);
}
else{

echo "保存されません<br>";
}
?>

