<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="98%" border="0" cellpadding="1" cellspacing="0">
  <tr> 
    <td bgcolor="ffcc00"> 
      <table width=100% border=0 cellspacing=0 cellpadding=0>
        <tr> 
          <td height=20 bgcolor=ffcc00 align=center>Hot News 
            <?php
  $db->query("select id,title from $news_t order by read_no DESC limit 10");
?>
            　<a href="news.php"><img src="images/more.gif" width="50" height="10" border="0" alt="更多..."></a> 
          </td>
        </tr>
        <tr> 
          <td height=1 bgcolor=586011><spacer type=block width=1></td>
        </tr>
        <?php
 while($db->next_record())
			   { 
?>
        <tr> 
          <td class=p7 bgcolor="f8f8e5" style="line-height:150%"> <font color=FF9933> 
            → <a href="news_list.php?id=<?php echo $db->f('id') ?>" class='clink03' target="_blank"> 
            <?php echo stripslashes($db->f('title')) ?>
            </a></font></td>
        </tr>
        <?php } ?>
      </table>
    </td>
  </tr>
</table>
<br>
</body>
</html>
