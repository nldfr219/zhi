<?php
$dir="./data/";				##数据文件目录
mkdir($dir,0777);
$data=fopen($dir."/main.dat","w");
fwrite($data,"0");
fclose($data);
$data=fopen($dir."/user.list","w");
fwrite($data,"0");
fclose($data);
echo"成功了！可以运行您的留言簿了！";
?>