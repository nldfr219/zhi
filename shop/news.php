<?php
require "conf/config.php";
session_start();
?>
<html>
<head>
<title><?php echo $sitename ?> -- 行业动态</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center">
  <tr> 
    <td width="182"> <br>
      <?php include "news_hot.php" ?>
      <form name="form1" method="post" action="news_s.php">
        新闻搜索： 
        <input type="text" name="key" size="16">
        <input type="submit" name="Submit" value="搜索">
      </form>
  
      </td>
    <td width="558" class="p13" align="center" valign="top"> 
      <?php
  if (!$page) $page=1;
  $db->query("select null from $news_t");
  $total_num=$db->num_rows();//得到总记录数
  $totalpage=ceil($total_num/$num_to_show);//得到总页数
  $init_record=($page-1)*$num_to_show;
  $db->query("select id,title,DATE_FORMAT(date,'%Y-%m-%d') as date
   from $news_t
   order by id DESC limit $init_record, $num_to_show_news");        
?>
      行业动态
      <table width="98%" border="1" class="black" cellspacing="1" cellpadding="3" bordercolor="#FFFFFF" bgcolor="#FCF3E0">
        <tr bgcolor="#0099CC"> 
          <td width="81%" align="center">新闻标题</td>
          <td width="19%" align="center">发布日期</td>
        </tr>
        <?php
		   while($db->next_record())
			   {
			   $i++;
			   ?>
        <tr> 
          <td width="81%" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
            <a href="news_list.php?id=<?php echo $db->f('id') ?>" class='clink03' target="_blank"> 
            <?php echo stripslashes($db->f('title')) ?>
            </a></td>
          <td width="19%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
            <?php echo $db->f('date') ?>
          </td>
        </tr>
        <?php } ?>
      </table>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF ?> " method="post" name="form88" onSubmit="return check_page('form88.page')">
          <tr> 
            <td align="right"> 总计: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>首  页&nbsp;上一页</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1'>首  页</a>&nbsp;<a href='$PHP_SELF?page=$page1'>上一页</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>下一页&nbsp;尾  页</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2'>下一页</a>&nbsp;<a href='$PHP_SELF?page=$totalpage'>尾  页</a>&nbsp;"; 
?>
              当前页:<b> 
              <?php echo $page."/".$totalpage ?>
              </b>&nbsp; 转到第
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
              <input type="text" name="page" size="2">
              <input type="submit" name="Submit222" value="GO">
            </td>
          </tr>
        </form>
      </table>
    </td>
  </tr>
</table>
<div align="left">
  <?php include "conf/footer.php"; ?>
</div>
</body>
</html>
