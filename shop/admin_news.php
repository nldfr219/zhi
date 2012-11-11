<?php
require "conf/config.php";
include "admin_check.php";
if ($Submit)
{
   $aryid=@implode(",",$delete);
   $db2->query("delete from $news_t where id in($aryid)");
   $result="删除新闻成功。";
}
?>
<html>
<head>
<title><?php echo $sitename ?> -- 新闻管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/admin.php"; ?>
<table width="750" align="center">
  <tr align="center"> 
    <td bgcolor="#EFEFEF"> 
      <p class="p13"><br>
        新闻管理</p>
      <form name="form1" method="post" action="">
        关键字查询： 
        <input type="text" name="key" class="think">
        　
        <input type="submit" name="Submit1" value="查 询" class="stbtm2">
      </form>   　 
      <?php
 echo $result;
 if ($key)
     $tmp="where title like '%$key%' or content like '%$key%'";
  if (!$page) $page=1;
  $db->query("select null from $news_t $tmp");
  $total_num=$db->num_rows();//得到总记录数
  $totalpage=ceil($total_num/$num_to_show);//得到总页数
  $init_record=($page-1)*$num_to_show;
  $db->query("select id,title,date,read_no
   from $news_t $tmp
   order by id DESC limit $init_record, $num_to_show_news");        
?>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF."?key=$key" ?> " method="post" name="form8" onSubmit="return check_page('form8.page')">
          <tr> 
            <td align="right"> <a href="admin_news_work.php?action=insert" class="clink03">添加新闻</a>　总计: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>首  页&nbsp;上一页</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1&key=$key'>首  页</a>&nbsp;<a href='$PHP_SELF?page=$page1&key=$key'>上一页</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>下一页&nbsp;尾  页</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2&key=$key'>下一页</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&key=$key'>尾  页</a>&nbsp;"; 
?>
              当前页:<b> 
              <?php echo $page."/".$totalpage ?>
              </b>&nbsp; 
              <script language="JavaScript">
function check_page(name)
{
 eval("page="+name+".value");
 if (isNaN(page) || page <=0 || page > <?php echo $totalpage ?>)
  {
    alert ("请正确输入页数，最大值为 <?php echo $totalpage ?> ！");
    eval(name+".select()");
	return false;
  }
}
</script>
              转到第 
              <input type="text" name="page" size="2">
              <input type="submit" name="Submit22" value="GO">
            </td>
          </tr>
        </form>
      </table>
      <form name="form_sele" method="post" action="">
      <table width="98%" border="1" class="black" cellspacing="1" cellpadding="3" bordercolor="#FFFFFF" bgcolor="#D3E3FE">
          <tr> 
            <td colspan="6" align="center"> 
            <input type="checkbox" name="deleteall" value="on" onClick="CheckAll(this.form,this.checked)"   >
            <font color="#CC3366">全选 </font> 　 
              <input type="submit" name="Submit" value="删除" onClick="if(!confirm('确定要删除这些吗？')) return false;" class="stbtm2">
          </td>
        </tr>
        <tr class="jyel"> 
            <td width="8%" align="center">编号</td>
            <td width="50%" align="center">新闻标题</td>
            <td width="17%" align="center">发布日期</td>
            <td width="11%" align="center">阅读次数</td>
            <td width="7%" align="center">修改</td>
            <td width="7%" align="center">删除</td>
        </tr>
        <?php
		   while($db->next_record())
			   {
			   $i++;
			   ?>
        <tr> 
            <td width="8%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php echo $db->f('id') ?>
            </td>
            <td width="50%" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <a href="news_list.php?id=<?php echo $db->f('id') ?>" class='clink03' target="_blank"> 
              <?php echo stripslashes($db->f('title')) ?>
              </a></td>
            <td width="17%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php echo $db->f('date') ?>
            </td>
            <td width="11%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php echo $db->f('read_no') ?>
            </td>
            <td width="7%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php 
    $link_order = "action=update&id=".$db->f('id');
    echo "<a href=\"admin_news_work.php?$link_order\">";
    echo '<img src="images/xg.gif" alt="修 改" border="0"></a>';
    ?>
            </td>
            <td width="7%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <input type="checkbox" name="delete[]" value="<?php echo $db->f('id') ?>">
          </td>
        </tr>
		<?php } ?>
          <tr bgcolor="#D3E3FE"> 
            <td colspan="6" align="center"> 
              <input type="checkbox" name="deleteall2" value="on" onClick="CheckAll(this.form,this.checked)"   >
            <font color="#CC3366">全选 </font> 　 
              <input type="submit" name="Submit" value="删除" onClick="if(!confirm('确定要删除这些吗？')) return false;" class="stbtm2">
            </td>
        </tr>        
      </table>
	  </form>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF."?key=$key" ?> " method="post" name="form88" onSubmit="return check_page('form88.page')">
          <tr> 
            <td align="right"> <a href="admin_news_work.php?action=insert" class="clink03">添加新闻</a>　总计: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>首  页&nbsp;上一页</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1&key=$key'>首  页</a>&nbsp;<a href='$PHP_SELF?page=$page1&key=$key'>上一页</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>下一页&nbsp;尾  页</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2&key=$key'>下一页</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&key=$key'>尾  页</a>&nbsp;"; 
?>
              当前页:<b> 
              <?php echo $page."/".$totalpage ?>
              </b>&nbsp; 转到第 
              <input type="text" name="page" size="2">
              <input type="submit" name="Submit222" value="GO">
            </td>
          </tr>
        </form>
      </table>
    </td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
