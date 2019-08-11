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
$comment=$_POST["name"];
echo $comment."を受け付けました。";

?>

