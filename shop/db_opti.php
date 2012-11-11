<?php
require "conf/config.php";
include "admin_check.php";
$tables = mysql_list_tables($db->Database, $db->connect());
$num_tables = mysql_numrows($tables);
for($j = 0; $j < $num_tables; $j ++)
{
  $table = mysql_tablename($tables, $j);
  $sql = "optimize table $table";
  echo "$sql ...";
  flush();
  $db->query($sql);
  echo "<b>ok!</b><br>\n";
  flush();
}
echo "<BR>数据库中所有表优化完毕!";
?>