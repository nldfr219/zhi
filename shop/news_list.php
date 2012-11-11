<?php
require "conf/config.php";
session_start();
setcookie("news_t",$id,time()+60*10);
if ($HTTP_COOKIE_VARS["news_t"]!=$id) 
  $db->query("update $news_t set read_no=read_no+1 where id=$id");
?>
<html>
<head>
<title><?php echo $sitename ?> -- 新闻浏览</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center">
  <tr> 
    <td width="182" valign="top" align="center"> 
      <?php include "news_hot.php" ?>
      <table width="98%" border="0" cellspacing="1" cellpadding="1">
        <tr> 
          <td height="20" align="center" class="p13">相关新闻</td>
        </tr>
        <?php
  $db->query("select * from $news_t where id=$id");
  $db->next_record();
$t_key=$db->f('key_words');
if ($t_key!="")
{
$db2->query("select 
        id,title
        from $news_t        
        where key_words like '%$t_key%' and id!=$id 
        order by id DESC limit 8");
while($db2->next_record())
 {
?>
        <tr> 
          <td> 
            <?php
   echo "<li> <a href=\"news_list.php?id=".$db2->f('id')."\" class='clink03'>".$db2->f('title')."</a>"; 
}
?>
          </td>
        </tr>
        <tr> 
          <td height="20" class="p13" align="center">&nbsp;</td>
        </tr>
        <?php } ?>
        <tr> 
          <td height="20" class="p13" align="center">新闻搜索</td>
        </tr>
        <tr> 
          <td> 
            <form name="form1" method="post" action="news_s.php">
              <input type="text" name="key" size="14">
              <input type="submit" name="Submit" value="搜索">
            </form>
          </td>
        </tr>
      </table>
    </td>
    <td width="1" bgcolor="#586011"><img src="images/spacer.gif" width="1" height="1"></td>
    <td width="10" align="center" valign="top">&nbsp;</td>
    <td width="558" align="center" valign="top"> 
    <br>
      <?php
  if ($db->num_rows())
  {
?>
      <script language=JavaScript>
<!--
function click() {
if (event.button==2) {
	if(document.all.auto.status==true){document.all.auto.status=false;alert("自动滚屏已经停止了！")}
	scroller();
	}
}
document.onmousedown=click

var position = 0; 
function scroller() {
if (document.all.auto.status==true){ 
	position++; 
	scroll(0,position); 
	clearTimeout(timer); 
	var timer = setTimeout("scroller()",50); 
	timer;
	}
else{
	clearTimeout(timer);
	}
}

function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>
      <table width="100%" border="0">
        <tr> 
          <td align="center" height="32"><b><font class=p13> 
            <?php echo stripslashes($db->f('title')); ?>
            </font></b></td>
        </tr>
        <tr> 
          <td align="center" height="27">发布时间 
            <?php echo $db->f('date') ?>
            　阅读次数： 
            <?php echo $db->f('read_no') ?>
            　
<input name=auto onClick="MM_callJS('scroller() ; ')" 
      type=checkbox value=on>
            自动滚屏(右键暂停) </td>
        </tr>
        <tr> 
          <td> 
            <?php
if (eregi("</",$db->f('content')))
    echo stripslashes($db->f('content'));
else
   echo stripslashes(nl2br($db->f('content')));
?>
          </td>
        </tr>
      </table>
      <p> 
        <?php
}
else
 echo "对不起，您游览的新闻不存在!<br><br>";
?>
      </p>
      </td>
  </tr>
</table>
<div align="left">
  <?php include "conf/footer.php"; ?>
</div>
</body>
</html>
