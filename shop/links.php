<?php
require "conf/config.php";

require("./link.php");
?>
<html>
<head>
<title><?php echo $sitename ?> -- 友情链接</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php
include "conf/header.php";

$db->query("select id,name,url,width,height from $link_t where visible=1 order by id desc");
echo "<p></p>";
echo "<table width=500 align=center border=0 cellspacing=0 cellpadding=10>\n";
$i = 0;
while($db->next_record())
{
  if($i % 2 == 0) echo "<tr>\n";

  echo "<td align=center width=120>" . getALink($link) ."</td>\n";
  echo "<td><a href=\"link.php?id=".$db->f('id')."&url=".$db->f('url')."\" target=\"_blank\" class=\"clink03\">".$db->f('name') . "</a><br>".$db->f('url')."</td>\n";

  if($i % 2 == 0) echo "<td width=20%></td>\n";
  if($i % 2 == 1) echo "</tr>\n";
  $i ++;
}
if($i % 2 == 1) echo "<td></td><td></td></tr>\n";
echo "</table>\n";
?>
<p>&nbsp;</p>
<table width=500 align=center border=0 cellspacing=0 cellpadding=2 class="p9">
  <tr> 
    <td bgcolor="#f7f7f7" height=30 valign="top" align="center"> 
      <div id="elFader" style="position:relative;visibility:true;width:100%">本站愿意与所有相关站点交换友情链接！</div>
    </td>
  </tr>
  <tr> 
    <td bgcolor="fbfbfb" align="center">欢迎 <a href=mailto:<?php echo $siteemail; ?> class=clink03>来信联系</a>。</td>
  </tr>
  <tr> 
    <td bgcolor="fbfbfb" align="center" class="p9"> 网站的Logo图标建议用标准的 88x31 大小，宽度最大不超过120像素，高度最大不超过50像素。 
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td bgcolor="fbfbfb" align="center"> <font color=red>本站Logo如下：</font> </td>
  </tr>
  <tr> 
    <td bgcolor="#f7f7f7" align="center" height="50"> <a href=images/logo.gif><img src=images/logo.gif border=0 width="96" height="37"></a> 
    </td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
