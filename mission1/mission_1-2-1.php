<?php
$hensu="Hello World";
$filename = 'mission1-2.txt';
$fp=fopen($filename,"w");
fwrite($fp,$hensu);
fclose($fp)
?>