<?php
require "conf/config.php";
include "admin_check.php";

if ($Submit)
{
   $aryid=@implode(",",$delete);
   $db2->query("delete from $vote_t where id in($aryid)");
   $result="删除成功。";
}
?>
<html>
<head>
<title><?php echo $sitename ?> -- 调查管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/admin.php"; ?>
<?php include "js_setselect.php"; ?>
<table width="750" align="center">
  <tr align="center"> 
    <td bgcolor="#EFEFEF"> 
      <p class="p13"><br>
        调查管理 </p>
 <?php echo "<p class=\"p13\">$result</p>";
if ($action=="")
{
  if (!$page) $page=1;
  $db->query("select null from $vote_t");
  $total_num=$db->num_rows();//得到总记录数
  $totalpage=ceil($total_num/$num_to_show);//得到总页数
  $init_record=($page-1)*$num_to_show;
  $db->query("select id,caption,date from $vote_t
   order by id DESC limit $init_record, $num_to_show");        
?>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF ?> " method="post" name="form8" onSubmit="return check_page('form8.page')">
          <tr> 
            <td align="right"> <a href="admin_vote.php?action=insert" class="clink03">添加新的调查</a>　总计: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>首  页&nbsp;上一页</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1&&up_id=$up_id&sf=$sf&key=$key'>首  页</a>&nbsp;<a href='$PHP_SELF?page=$page1&&up_id=$up_id&sf=$sf&key=$key'>上一页</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>下一页&nbsp;尾  页</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2&&up_id=$up_id&sf=$sf&key=$key'>下一页</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&&up_id=$up_id&sf=$sf&key=$key'>尾  页</a>&nbsp;"; 
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
        <tr> 
            <td width="8%" align="center">编号</td>
            <td width="55%" align="center">调查主题</td>
            <td width="15%" align="center">调查日期</td>
            <td width="10%" align="center">查看结果</td>
            <td width="6%" align="center">修改</td>
            <td width="6%" align="center">删除</td>
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
            <td width="55%" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php echo stripslashes($db->f('caption')) ?>
            </td>
            <td width="15%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php echo $db->f('date') ?>
            </td>
            <td width="10%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <a href="vote.php?id=<?php echo $db->f('id') ?>" target="_blank" class="clink03">查看结果</a> 
            </td>
            <td width="6%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php 
    $link_order = "action=update&id=".$db->f('id');
    echo "<a href=\"?$link_order\">";
    echo '<img src="images/xg.gif" alt="修 改" border="0"></a>';
    ?>
            </td>
            <td width="6%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <input type="checkbox" name="delete[]" value="<?php echo $db->f('id') ?>">
          </td>
        </tr> 
		   <?php } ?>
        <tr> 
          <td colspan="6" align="center">
              <input type="checkbox" name="deleteall" value="on" onClick="CheckAll(this.form,this.checked)"   >
            <font color="#CC3366">全选 </font> 　 
              <input type="submit" name="Submit" value="删除" onClick="if(!confirm('确定要删除这些吗？')) return false;" class="stbtm2">
          </td>
        </tr>    
      </table>
	  </form>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF ?> " method="post" name="form88" onSubmit="return check_page('form88.page')">
          <tr> 
            <td align="right"> <a href="admin_vote.php?action=insert" class="clink03">添加新的调查</a>　总计: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>首  页&nbsp;上一页</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1&&up_id=$up_id&sf=$sf&key=$key'>首  页</a>&nbsp;<a href='$PHP_SELF?page=$page1&&up_id=$up_id&sf=$sf&key=$key'>上一页</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>下一页&nbsp;尾  页</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2&&up_id=$up_id&sf=$sf&key=$key'>下一页</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&&up_id=$up_id&sf=$sf&key=$key'>尾  页</a>&nbsp;"; 
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
      <?php
}
else
{
if ($usage!=1)
{
          $db->query("select caption,thing from $vote_t where id=$id");
          $db->next_record();
      	  $caption=stripslashes($db->f('caption'));
      	  $thing=str_replace(";","\n",stripslashes($db->f('thing')));
 	switch ($action)
	{
		case "insert":
			$result = "发起调查";
			break;
		case "update":
			$result = "修改调查";
	}
?>
      <form name="form1" method="post" action="" onSubmit="return check();">
        <table width="70%" border="1" cellspacing="0" cellpadding="2" bgcolor="#E1EAF4" align="center" bordercolor="#FFFFFF">
          <tr> 
            <td colspan="3" height="35" align="center"> <font color="#FF0000">*</font> 
              表示为必填项 </td>
          </tr>
          <tr> 
            <td colspan="3" class="p13"><?php echo $result; ?> 
              <script language="JavaScript">
function check()
{
 if (document.form1.caption.value == "")
  {
    alert ("请填写调查的主题!");
    document.form1.caption.focus();
    return false;
  }
 if (document.form1.thing.value == "")
  {
    alert ("请填写调查的内容!");
    document.form1.thing.focus();
    return false;
  }
 document.form1.Submit.disabled=true;
 document.form1.Submit2.disabled=true;
}
</script>
              <input type="hidden" name="action" value="<?php echo $action ?>">
              <input type="hidden" name="usage" value="1">
              <input type="hidden" name="id" value="<?php echo $id ?>">
            </td>
          </tr>
          <tr> 
            <td width="32%"> 
              <p>在编辑框中输入数据，</p>
              <p>每一行为一个调查选项。</p>
            </td>
            <td width="50%">主题: 
              <input type="text" name="caption" size="25" maxlength="100" value="<?php echo htmlspecialchars($caption) ?>">
              <textarea name="thing" cols="30" rows="10"><?php echo $thing ?></textarea>
            </td>
            <td width="18%" align="center"> 
              <input type="submit" name="Submit" value="<?php echo $result; ?>" class="stbtm2">
              <br>
              <br>
              <input type="reset" name="Submit2" value="重新填写" class="stbtm2">
            </td>
          </tr>
        </table>
      </form>
<?php
}
else
{
$caption=addslashes($caption);
$thing=addslashes($thing);

$thing2=explode("\n",$thing);
$thing=str_replace("\n",";",$thing);
$data="";
for($i=0;$i<count($thing2);$i++)
   $data.="0;";

switch($action)
{
 case "insert" :
     $db->query("insert into $vote_t(caption,thing,data,date) values('$caption','$thing','$data','$date_tmp')");
     $result = "添加成功。";
	 break;
 case "update" :
     $db->query("update $vote_t set caption='$caption',thing='$thing' where id=$id");
     $result = "修改调查。";
}
echo $result."正在返回调查页面...<meta http-equiv=\"refresh\" content=\"2;URL=admin_vote.php\"><br><br>";
 }
 }?>
    </td>
  </tr>
</table>
<br>
<u><span class="p14">帮助信息</span></u><span class="p14">： </span> 
<ul>
  <li><span class="p14">网站首页的&quot;本站调查&quot;栏目，显示的调查为最后一个添加的</span></li>
  <li><span class="p14">单击&quot;添加新的调查&quot;链接，将发起新的调查</span></li>
  <li><span class="p14">点“更改”图标，修改调查的主题、调查选项。</span><span class="p13">注意：修改调查的选项时，请不要增加或者删除一个选项，否则，将出错</span></li>
  <li><span class="p14">点“删除”图标，确认删除后，删除一条调查</span><br>
  </li>
</ul>
<?php include "conf/footer.php"; ?>
</body>
</html>
