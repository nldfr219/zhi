<?php
require "conf/config.php";
include "admin_check.php";
if ($action=="del")
{
  //删除用户订单表的订单
  $db->query("delete from $requests_t where id=($id-$init_num)");
  //删除用户shopping表的商品id
  $db->query("delete from $shopping_t where requests_id=($id-$init_num)");
  }
if ($do=="update")
  $db->query("update $requests_t set $action=$value where id=($id-$init_num)");
?>
<html>
<head>
<title><?php echo $sitename ?> -- 订单管理</title>
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
        订单管理</p>
      <table width="96%" border="0" cellspacing="0" bgcolor="#ffffff">
        <form name="form1" method="post" action="<?php echo $PHP_SELF ?>" >
          <tr> 
            <td> 按订单号、姓名查询: 
              <input type="text" name="key" size="15" class="think" >
              <input type="hidden" name="search" value="1">
              <input type="submit" name="submit1" value=":查 询:" class="stbtm2">
              (按订单查询时，订单号需减去<font color=red>
              <?php echo  $init_num; ?>
              </font>) </td>
          </tr>
        </form>
      </table>     
        
      <table width="99%" border="0" cellspacing="0" align="center" >
        <tr> 
          <td width="55%"> <b> 
            <?php
$db->query("select id,u_name from $user_t where id=$user_id");
$db->next_record();
$s='<a href="user_list.php?id='.$db->f('id').'" class="clink03" target="_blank">'.$db->f('u_name').'</a>';
echo $s;
?>
            的所有订单列表：</b> </td>
          <td width="45%">其他订单： <a href="admin_dingdang.php"><font color="blue">待处理的订单</font></a> 
            <a href="fail_admin_dingdang.php?action=all" onClick="return confirm('确定要删除所有的无效订单吗?')"><font color="blue"></font></a><a href="succeed_admin_dingdang.php"><font color="blue">成功的订单</font></a> 
            <a href="fail_admin_dingdang.php"><font color="blue">无效的订单</font></a>　</td>
        </tr>
      </table>
      <?php  
  if (!$page) $page=1;
  $tmp="where (user_id=$user_id)"; 
  if ($key)
    $tmp.=" and (id like '%".$key."%' or name like '%".$key."%') ";
  $db->query("select null from $requests_t $tmp"); //从订单表中查出用户的订单
  $total_num=$db->num_rows();//得到总记录数
  $totalpage=ceil($total_num/$num_to_show);//得到总页数
  $init_record=($page-1)*$num_to_show;
  $db->query("select * from $requests_t $tmp
     order by id DESC limit $init_record, $num_to_show");        
 ?>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF."?key=$key&user_id=$user_id" ?> " method="post" name="form8" onSubmit="return check_page('form8.page')">
          <tr> 
            <td align="right"> 总计: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>首  页&nbsp;上一页</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1&key=$key&user_id=$user_id'>首  页</a>&nbsp;<a href='$PHP_SELF?page=$page1&key=$key&user_id=$user_id'>上一页</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>下一页&nbsp;尾  页</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2&key=$key&user_id=$user_id'>下一页</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&key=$key&user_id=$user_id'>尾  页</a>&nbsp;"; 
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
      <table width="98%" border="1" cellspacing="0" align=center>
        <tr> 
          <td align=center><font color="#cc0000">订单序号</font></td>
          <td align=center><font color="#cc0000">订单会员</font></td>
          <td align=center><font color="#cc0000">付款方式</font></td>
          <td align=center><font color="#cc0000">下单时间</font></td>
          <td align=center><font color="#cc0000">是否发货</font></td>
          <td align=center><font color="#cc0000">是否付款</font></td>
          <td align=center><font color="#cc0000">应付款</font></td>
          <td align=center><font color="#cc0000">发货操作</font></td>
          <td align=center><font color="#cc0000">付款操作</font></td>
          <td align=center>&nbsp;</td>
        </tr>
        <?php
while($db->next_record())
  { 
?>
        <tr> 
          <td align=center> <a href='admin_dingdang_disp.php?id="<?php echo $db->f('id')+$init_num ?>' class='clink03'> 
            <?php echo $db->f('id')+$init_num; ?>
            </a> </td>
          <td align=center>
<?php echo $s; ?>
          </td>
          <td align=center> 
            <?php
echo substr($pay_str[$db->f('pay')],0,8);
?>
          </td>
          <td align=center> 
            <?php echo $db->f('date_created'); ?>
          </td>
          <td align=center> 
            <?php if ($db->f('send_out')) echo "己发货"; else echo "<font color=\"#cc0000\">未发货</font>"; ?>
          </td>
          <td align=center> 
            <?php if ($db->f('payment')) echo "己付款"; else echo "<font color=\"#cc0000\">未付款</font>"; ?>
          </td>
          <td align=center> 
            <?php echo $db->f('fee')+$send_money; ?>
            元</td>
          <td align=center> 
            <?php
			if ($db->f('send_out'))
			 echo "<a href='$PHP_SELF?user_id=$user_id&do=update&action=send_out&value=0&id=".($db->f('id')+$init_num)."' onClick=\"return confirm('确定该条订单未发货吗?')\" class='clink03'>"."未发货</a>";
            else
			 echo "<a href='$PHP_SELF?user_id=$user_id&do=update&action=send_out&value=1&id=".($db->f('id')+$init_num)."' onClick=\"return confirm('确定该条订单已发货吗?')\" class='clink03'>"."己发货</a>";
			 ?>
          </td>
          <td align=center> 
            <?php
			if ($db->f('payment'))
              echo "<a href='$PHP_SELF?user_id=$user_id&do=update&action=payment&value=0&id=".($db->f('id')+$init_num)."' onClick=\"return confirm('确定该条订单未付款吗?')\" class='clink03'>"."未付款</a>";
		   else
			  echo "<a href='$PHP_SELF?user_id=$user_id&do=update&action=payment&value=1&id=".($db->f('id')+$init_num)."' onClick=\"return confirm('确定该条订单已付款吗?')\" class='clink03'>"."己付款</a>";
			?>
          </td>
          <td align=center> 
            <input type="button" name="Button2" value="删除" class="think" <?php echo "onclick=\"javaScript:return confirm('确定要删除吗?');window.location.href='$PHP_SELF?user_id=$user_id&action=del&id=".($db->f('id')+$init_num)."'\""; ?>>
          </td>
        </tr>
        <?php } ?>
      </table>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF."?key=$key&user_id=$user_id" ?> " method="post" name="form88" onSubmit="return check_page('form88.page')">
          <tr> 
            <td align="right"> 总计: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>首  页&nbsp;上一页</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1&key=$key&user_id=$user_id'>首  页</a>&nbsp;<a href='$PHP_SELF?page=$page1&key=$key&user_id=$user_id'>上一页</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>下一页&nbsp;尾  页</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2&key=$key&user_id=$user_id'>下一页</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&key=$key&user_id=$user_id'>尾  页</a>&nbsp;"; 
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
