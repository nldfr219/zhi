<?php
function mtime()
{
  $a = explode(" ", microtime());
  return round(((double)$a[1] + (double)$a[0]) * 1000);
}

function timer($testName)
{
  global $t0;
  echo $testName." ����ʱ��Ϊ ";
  echo mtime() - $t0;
  echo " ����<br>\n";
}

$t0 = mtime();
require "conf/config.php";
include "admin_check.php";

timer("�������ݿ�����");

$t0 = mtime();
$db->query("select * from $goods_t limit 10");

while($db->next_record());
timer("��ѯ10���򵥼�¼");

echo "<br>���԰� F5 ˢ�£����²���<br>"
?>