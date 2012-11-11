<?php
function mtime()
{
  $a = explode(" ", microtime());
  return round(((double)$a[1] + (double)$a[0]) * 1000);
}

function timer($testName)
{
  global $t0;
  echo $testName." 所需时间为 ";
  echo mtime() - $t0;
  echo " 毫秒<br>\n";
}

$t0 = mtime();
require "conf/config.php";
include "admin_check.php";

timer("建立数据库连接");

$t0 = mtime();
$db->query("select * from $goods_t limit 10");

while($db->next_record());
timer("查询10条简单记录");

echo "<br>可以按 F5 刷新，重新测试<br>"
?>