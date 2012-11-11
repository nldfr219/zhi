<?php

@mysql_pconnect($lvc_db_host,$lvc_db_user,$lvc_db_password);

// 在线统计-------------------------------------------

$zeit= time();
$loeschzeit=$zeit-(5*60);
$ip= getenv(REMOTE_ADDR);

$olresult=mysql_db_query($lvc_db_database, "INSERT INTO $lvc_table_useronline (zeit,ip) VALUES ('$zeit','$ip')");
$olresult=mysql_db_query($lvc_db_database, "DELETE FROM $lvc_table_useronline WHERE zeit<'$loeschzeit'");
$olresult=mysql_db_query($lvc_db_database, "SELECT DISTINCT ip FROM $lvc_table_useronline");
$online_user= mysql_num_rows($olresult);


// 添加页面计数 ---------------------------------------

$sql = "select num, today, time from $lvc_table_counter";

$countresult = @mysql_db_query($lvc_db_database, $sql);

$objResult = @mysql_fetch_object($countresult);
$pagecount = $objResult->num;
$todaypagecount = $objResult->today;

@mysql_db_query($lvc_db_database, $sql);

// 获取ＩＰ总访问数 -----------------------------------

$sql = "select count(*) as num from $lvc_table_visitors";
$ipresult = @mysql_db_query($lvc_db_database, $sql);
$ipcount = mysql_result($ipresult,0,"num");

// 获取今日ＩＰ访问数 ---------------------------------

$timenow = date("Y/m/d");
$sql = "select count(*) as num from $lvc_table_visitors where date like '".$timenow."%'";
$ipresult = @mysql_db_query($lvc_db_database, $sql);
$todayipcount = mysql_result($ipresult,0,"num");

// 显示访问统计总览 ------------------------------------

echo "<CENTER><TABLE CELLSPACING=1 BORDER=0>\n";
echo "<TR><TD COLSPAN=6><A CLASS='array'>";
echo $lvm_total_title."</A></TD></TR>\n";
echo "<TR>";
echo "<TH CLASS='vis'>&nbsp;&nbsp;".$lvm_total_site."&nbsp;&nbsp;</TH>";
echo "<TH CLASS='vis'>&nbsp;&nbsp;".$lvm_total_pagecount."&nbsp;&nbsp;</TH>";
echo "<TH CLASS='vis'>&nbsp;&nbsp;".$lvm_total_ipcount."&nbsp;&nbsp;</TH>";
echo "<TH CLASS='vis'>&nbsp;&nbsp;".$lvm_total_tdpagecount."&nbsp;&nbsp;</TH>";
echo "<TH CLASS='vis'>&nbsp;&nbsp;".$lvm_total_tdipcount."&nbsp;&nbsp;</TH>";
echo "<TH CLASS='vis'>&nbsp;&nbsp;".$lvm_total_online."&nbsp;&nbsp;</TH>";
echo "</TR>\n";
echo "<TR>";
echo "<TH CLASS='vis1'>&nbsp;&nbsp;".$lvc_site_name."&nbsp;&nbsp;</TH>";
echo "<TH CLASS='vis1'>&nbsp;".$pagecount."&nbsp;</TH>";
echo "<TH CLASS='vis1'>&nbsp;".$ipcount."&nbsp;</TH>";
echo "<TH CLASS='vis1'>&nbsp;".$todaypagecount."&nbsp;</TH>";
echo "<TH CLASS='vis1'>&nbsp;".$todayipcount."&nbsp;</TH>";
echo "<TH CLASS='vis1'>&nbsp;".$online_user."&nbsp;</TH>";
echo "</TR>";
echo "</TABLE>\n";

// end ----------------------------------------------------

?>