<?php
require "conf/config.php";
include "admin_check.php";

$code = addslashes($code);

if($op == "insert")
{
  $db->query("insert into $ad_t(code,visible,posttime) values('$code','$visible','$date_tmp')");
  $result = "插入成功。";
}
else if($op == "update")
{
  $db->query("update $ad_t set code='$code',visible='$visible' where id=$id");
  $result = "更改成功。";
}
else if($op == "delete")
{
  $db->query("delete from $ad_t where id=$id");
  $result = "删除成功。";
}
if($op)
{
  $name = "";  //方便插入下一条记录
  $url = "";
  $code = "";
}

?>
<html>
<head>
<title><?php echo $sitename ?> -- 广告管理</title>
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
        广告管理 
        <?php
  if (!$page) $page=1;
  $db->query("select null from $ad_t");
  $total_num=$db->num_rows();//得到总记录数
  $totalpage=ceil($total_num/$num_to_show);//得到总页数
  $init_record=($page-1)*$num_to_show;
  $db->query("select id,code,views,visible,posttime 
   from $ad_t
   order by id DESC limit $init_record, $num_to_show");        
?>
      </p>
      <table width="100%" bgcolor="dddddd" align="center" cellspacing="1" cellpadding="2">
        <tr bgcolor="e8e8e8"> 
          <td align="right" width="8%"><b>ID</b></td>
          <td align="center" width="9%"><b>可 见</b></td>
          <td align="center" width="11%"><b>登记日期</b></td>
          <td align="right" width="8%"><b>显示</b></td>
          <td width="55%" bgcolor="e8e8e8" align="center"><b>代 码</b></td>
          <td align="center" width="9%"><b>操 作</b></td>
        </tr>
        <form name="formInsert" enctype="multipart/form-data" method="post" action="">
          <tr bgcolor="<?php if ($i % 2 ==0) echo "#FDFFF7";else echo "#f7f7f7"; ?>"> 
            <td align="right" width="8%">&nbsp;</td>
            <td align="center" width="9%"> 
              <select name="visible">
                <option value="0">否</option>
                <option value="1">是</option>
              </select>
            </td>
            <td align="center" width="11%">&nbsp;</td>
            <td align="right" width="8%">&nbsp;</td>
            <td width="55%"> 
              <textarea cols=62 name=code rows=4 wrap=virtual><?php echo $code; ?></textarea>
            </td>
            <td align="center" width="9%"> 
              <input type="hidden" name="op" value="insert">
              <input class="button" type="submit" name="insertBtn" value="插入">
            </td>
          </tr>
          <script language="JavaScript">
    setSelect("formInsert", "visible", "<?php echo $visible; ?>");
  </script>
        </form>
        <tr bgcolor="<?php echo $defaultColor1; ?>"> 
          <td colspan="10" height="25" align="center" class="p13"> 
            <?php echo $result; ?>
          </td>
        </tr>
        <?php
$i++;
while($db->next_record())
{
  //$color = getColor();
  $id = $db->f('id');
  $code = stripslashes($db->f('code'));
?>
        <form name="form<?php echo $id ?>" enctype="multipart/form-data" method="post" action="">
          <tr bgcolor="<?php  if ($i % 2 ==0) echo "#FDFFF7";else echo "#f7f7f7"; ?>"> 
            <td align="right" width="8%"> 
              <input type="text" name="id" value="<?php echo $id; ?>" size="4" maxlength="10" readonly>
            </td>
            <td align="center" width="9%"> 
              <select name="visible">
                <option value="0">否</option>
                <option value="1">是</option>
              </select>
            </td>
            <td align="center" width="11%"> 
              <?php echo $db->f('posttime'); ?>
            </td>
            <td align="right" width="8%"> 
              <?php echo $db->f('views'); ?>
            </td>
            <td width="55%"> 
              <textarea cols=62 name=code rows=4 wrap=virtual><?php echo $code; ?></textarea>
              <br>
              <?php echo $code; ?>
            </td>
            <td align="center" width="9%"> 
              <input type="hidden" name="page" value="<?php echo $page; ?>">
              <input type="hidden" name="op" value="">
              <input class="button" type="button" name="updateBtn" value="更改"
        onClick="document.forms['form<?php echo $id; ?>'].op.value='update'; document.forms['form<?php echo $id; ?>'].submit();">
              <br>
              <br>
              <input class="button" type="button" name="deleteBtn" value="删除"
        onClick="document.forms['form<?php echo $id; ?>'].op.value='delete'; if(confirm('您确定删除该记录吗？')) document.forms['form<?php echo $id; ?>'].submit();">
            </td>
          </tr>
          <script language="JavaScript">
    setSelect("form<?php echo $id; ?>", "visible", "<?php echo $db->f('visible'); ?>");
  </script>
        </form>
        <?php
 $i++;
 } 
?>
      </table>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF ?> " method="post" name="form" onSubmit="return check_page('form.page')">
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
    </td>
  </tr>
</table>
<br>
<u><span class="p14">帮助信息</span></u><span class="p14">： </span> 
<ul>
  <li><span class="p14">广告将随机显示在每个页面的顶部</span></li>
  <li><span class="p14">修改一个广告的“代码”</span></li>
  <li><span class="p14">可以通过修改一个广告的“可见”为“否”来屏蔽显示一个广告</span></li>
  <li><span class="p14">点“更改”确认修改各变动</span></li>
  <li><span class="p14">点“删除”，确认删除后，删除一条广告</span><br>
  </li>
</ul>
<?php include "conf/footer.php"; ?>
</body>
</html>
