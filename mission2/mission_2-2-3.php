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
$file=fopen("mission_2-2.txt","w");
fwrite($file,$comment);
fclose($file);

//ファイルの表示
$filename="mission_2-2.txt";
$fp=fopen($filename,"r");
$txt=fgets($fp);

echo $txt."<br>";
fclose($fp);
}
else{

echo "保存されません<br>";
}
?>

