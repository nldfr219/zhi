<?php
$dir="./data/";				##�����ļ�Ŀ¼
mkdir($dir,0777);
$data=fopen($dir."/main.dat","w");
fwrite($data,"0");
fclose($data);
$data=fopen($dir."/user.list","w");
fwrite($data,"0");
fclose($data);
echo"�ɹ��ˣ����������������Բ��ˣ�";
?>