<?php
require "conf/config.php";

?>
<html>
<head>
<title><?php echo $sitename ?> -- product search</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center">
  <tr> 
    <td width="182" valign="top"> 
      <table border=0 cellpadding=0 cellspacing=0 width=180>
        <tbody> 
        <tr> 
          <center>Your shopping cart</center>
        </tr>
        <tr valign=top> 
          <td colspan=3> 
            <table align=center border=0 cellpadding=0 cellspacing=0 
            width="100%">
              <tbody> 
              <tr> 
                <td bgcolor=#ffcc00><img height=1 
                  src="images/spacer.gif" width=1></td>
              </tr>
              <tr> 
                <td bgcolor=#ffcc00 valign=top> 
                  <table align=center border=0 cellpadding=0 cellspacing=0 
                  width="99%">
                    <tbody> 
                    <tr> 
                      <td bgcolor=#ffffff valign=top><iframe frameborder=0 
                        height=182 name=cart scrolling=no 
                        src="shopping.php" 
                    width="100%"></iframe></td>
                    </tr>
                    </tbody> 
                  </table>
                </td>
              </tr>
              <tr> 
                <td bgcolor=#ffcc00 height=1><img height=1 
                  src="images/spacer.gif" 
        width=1></td>
              </tr>
              </tbody> 
            </table>
          </td>
        </tr>
        </tbody> 
      </table>
    </td>
    <td width="558"> 
      <?php 
  $tmp="where (name like '%$key%' or descript like '%$key%') ";
  if ($sf) $tmp.="and class_id=$sf";
  if (!$page) $page=1;
  $key=trim($key);
  $db->query("select null from $goods_t ".$tmp);
  $total_num=$db->num_rows();//得到总记录数
  $totalpage=ceil($total_num/$num_to_show);//得到总页数
  $init_record=($page-1)*$num_to_show;
  $db->query("select id,name,image,price_m,price,state
   from $goods_t $tmp
   order by id DESC limit $init_record, $num_to_show");   
?>
      <table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" height="150">
        <tr> 
          <td colspan="5" height="4"></td>
        </tr>
        <?php
  while($db->next_record())
  {
?>
        <tr> 
          <td width="104" align="center"> 
            <?php 
			echo "<a href='goods_list.php?id=".$db->f('id')."' target='_blank'><img src='".show_img($db->f('image'),50,50)." border='0'></a>";
			 ?>
          </td>
          <td width="141" valign="middle"><b><font class=p14 color=#000000> 
            <?php echo "<a href='goods_list.php?id=".$db->f('id')."' class='softtitle' target='_blank'>".stripslashes($db->f('name'))."</a>"; ?>
            </font></b></td>
          <td width="127" valign="middle"><b><font class=p14 color=#000000> </font></b>零售价：<strike><font color=red> 
            <?php echo $db->f('price_m'); ?>
            </font></strike>元<br>
          </td>
          <td width="97" valign="middle">会员价：<font class=p13 color=#ff3333 
                  size=2> 
            <?php
			if ($user_price)
			  if (isset($login_name))
			     echo $db->f('price');
			  else
			    echo "";
			else
			   echo $db->f('price');
			 ?>
            </font>元</td>
          <td width="67" valign="middle"><a href="shopping.php?id=<?php echo $db->f('id') ?>" target="cart"><img src="images/gou.gif" width="60" height="22" border="0"></a> 
            <a href="shopping.php?id2=<?php echo $db->f('id') ?>" target="cart"><img src="images/sc.gif" width="60" height="22" border="0"></a></td>
        </tr>
        <tr> 
          <td colspan="5"><img src="images/spacer.gif" width="1" height="1"></td>
        </tr>
        <tr > 
          <td colspan="5" background="images/line1.gif"><img src="images/spacer.gif" width="1" height="1"></td>
        </tr>
        <?php } ?>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF."?key=$key" ?> " method="post" name="form8" onSubmit="return check_page('form8.page')">
          <tr> 
            <td align="right"> 总计: 
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
    </td>
  </tr>
</table>
<div align="left">
  <?php include "conf/footer.php"; ?>
</div>
</body>
</html>
