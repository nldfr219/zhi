<?php
if($ref) $HTTP_REFERER = $ref;
require("new-visitor.inc.php");

// style function
// 1 ��
function STYLE1() {
}

// 2 �����ı�
function STYLE2() {
  global $lvc_url, $lvc_site_name, $pagecount, $newtoday, $online_user;
  // get pagecount
  $pagecount++;

  // get ipcount

  $sql = "select count(*) as num from $lvc_table_visiteurs";
  $ipresult = @mysql_db_query($lvc_db_database, $sql);
  $ipcount = @mysql_result($ipresult,0,"num");

  // get todayipcount

  $timenow = date("Y/m/d");
  $sql = "select count(*) as num from $lvc_table_visiteurs where date like '".$timenow."%'";
  $ipresult = @mysql_db_query($lvc_db_database, $sql);
  $todayipcount = @mysql_result($ipresult,0,"num");
  echo "document.write(\"<table width=100 border=2 bordercolorlight=#A9C6FA bordercolordark=#000000 cellspacing=0 cellpadding=3><tr bgcolor=black><td><marquee behavior=loop scrollDelay=100 scrollAmount=3><a style=text-decoration:none; href=$lvc_url target=_blank><font color=white style=font:12px>$lvc_site_name ��ҳ������<b>$pagecount</b>������ҳ������<b>$newtoday</b>���ܣɣ�����<b>$ipcount</b>�����գɣ�����<b>$todayipcount</b>�����ߣ�<b>$online_user</b></font></a></marquee></td></tr></table>\");";
}

// 3 Сͼ��
function STYLE3() {
global $lvc_url;
echo "document.write(\"<a href=$lvc_url target=_blank><img border=0 src=$lvc_url/images/button.gif width=20 height=20></a>\");";
}

// 4 ��ͼ��
function STYLE4() {
global $lvc_url;
echo "document.write(\"<a href=$lvc_url target=_blank><img border=0 src=$lvc_url/include/countimg.php></a>\");";
}


if ($style == "1")
STYLE1();
elseif ($style == "2")
STYLE2();
elseif ($style == "3")
STYLE3();
elseif ($style == "4")
STYLE4();
else
STYLE3();

?>