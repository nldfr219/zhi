<?php
require "conf/config.php";
if ($siteclose_flag)
{
	echo $sitereason;
	exit();
}

require("link.php");

?>
<?php 
if(isset($op)){
	if($op=="clear")
	{
		
	
			$_SESSION['basket_items']=0;
			array_splice($_SESSION['basket_amount'],0);  
			array_splice($_SESSION['basket_id'],0);
			unset($_SESSION['basket_amount']);
			unset($_SESSION['basket_id']);
			
	}
}

?>



<html>
<head>
<title><?php echo $sitename ?> -- index</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center">
  <tr> 
    <td width="158" valign="top" align="center" class="softtitle"> 
      <table width="98%" border="0" cellpadding="1" cellspacing="0">
        <tr> 
          <td bgcolor="#cccccc" height="57"> 
            <table width=100% border=0 cellspacing=0 cellpadding=0>
              <tr> 
                <td height=20 bgcolor=#F0F788 align=center><font color="#663300">Login</font></td>
              </tr>
              <tr> 
                <td height=2 bgcolor=#000000><spacer type=block width=1></td>
              </tr>
              <tr> 
                <td class=p7 bgcolor="#FFFFFF"  align="center"> 
                  <table align=center border=0 cellpadding=0 cellspacing=3 
width="100%">
                    <form action="login.php" method=post name=login onSubmit="return(check());">
                      <tbody> 
                      <tr> 
                        <td width="35%" align="right" height="43"> 
                          <script language="JavaScript">
function check()
{
 document.login.submit.disabled=true;
 document.login.submit2.disabled=true;
}
</script>
                          User Id<b>:</b></td>
                        <td width="65%" height="43"> 
                          <input class=think name=u_name size=10>
                        </td>
                      </tr>
                      <tr> 
                        <td width="35%" align="right" height="20"> Password<b>:</b></td>
                        <td width="65%" height="20"> 
                          <input class=think name=u_pass size=10 
                  type=password>
                        </td>
                      </tr>
                      <tr align="center"> 
                        <td colspan=2 height=34 width="65%"> 
                          <input name=submit type=submit value="login" class="think">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name=submit2 onClick="JavaScript:window.location.href='register1.php'" type=button value=register class="think">
                          <input type="hidden" name="url" value="<?php echo $url ?>">
                        </td>
                      </tr>
                      <tr align="center"> 
                        <td colspan=2 height=20 width="65%"><img height=11 
                  src="images/forget.gif" width=11> &nbsp;Forget the password?<a 
                  href="password.php"><font 
                  color=#ce0929>Click here!</font></a></td>
                      </tr>
                      </tbody> 
                    </form>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <br>
      <table width=100% border=0 cellspacing=0 cellpadding=0>
        <tr> 
          <td height=20 bgcolor=#7A5E12 align=center><font color="#FFFFFF">Category</font></td>
        </tr>
        <tr> 
          <td height=1 bgcolor=#000000><spacer type=block width=1></td>
        </tr>
        <tr> 
          <td class=p7 bgcolor="#FAEEFD" style="line-height:150%" align="center"> 
            <?php
$db->query("select id,name from $class_t where up_id=0");
$h=0;
while($db->next_record())
 {
 	echo "<a href='index.php?up_id=".$db->f('id')."' class='title'>".$db->f('name')."</a><br>";
 }
?>
          </td>
        </tr>
      </table>
      
      <script language="JavaScript">
<?php
if (isset($sh))
   echo "showmenu(menu$sh,$h);";
?>
function showmenu(name,num)
{
   flag=name.style.display;
   for(i=0;i<num;i++) 
	   eval("menu"+i+".style.display='none';");
   if (flag=="none")
	   name.style.display="";
   else
	   name.style.display="none";
}
function winopen(url,flag)
{
window.open(url,flag,"toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=yes,width=640,height=450,top=60,left=80");
}
</script>
      <br>
      <table width="98%" border="0" cellpadding="1" cellspacing="0">
        <tr> 
          <td bgcolor="#ff6000" height="57"> 
            <table width=100% border=0 cellspacing=0 cellpadding=0>
              <tr> 
                <td height=20 bgcolor=#ff6000 align=center><font color="#FFFFFF">Links</font></td>
              </tr>
              <tr> 
                <td height=2 >
                <center>
                <br>
                <a href="http://www.amazon.com">Amazon</a><br><br>
               <a href="http://www.ebay.com">Ebay</a><br><br>
               <a href="http://shopping.yahoo.com/">Yahoo</a><br><br>
               </center>
                </td>
              </tr>
              <tr> 
               
               
              </tr>
              <tr> 
                <td class=p7 bgcolor="#FFFFFF"  align="right" height="24"> &nbsp;&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      
      
    </td>
    <td valign="top"> 
      <?php if (isset($login_name))
{

 echo "Dear <font color='#cc0000'>".$login_name."</font>, hello!Welcome!";
 if(isset($cookielogintime))
 echo " Last login time:".$cookielogintime;
 echo " <a href='logout.php' class='clink03'>[logout]</a>";

}
else
 echo "Dear customer. Hello!Welcome! <a href='login.php' class='clink03'>[Please Log in]</a> ";


$tmp="";
  if (isset($f)) $tmp="where class_id=$f";
  
  if (isset($up_id))
    $tmp="where up_id=$up_id";
  if (isset($sf))
     $tmp="where class_id=$sf";
	 
  if (!isset($page)) $page=1;
  $db->query("select null from $goods_t ".$tmp);
  $total_num=$db->num_rows();//得到总记录数
  $totalpage=ceil($total_num/$num_to_show);//得到总页数
  $init_record=($page-1)*$num_to_show;
  $db->query("select id,name,image,price_m,price,state
   from $goods_t $tmp
   order by id DESC limit $init_record, $num_to_show");   
?>
      <table width="99%" border="0">
        <tr> 
          <td bgcolor="#333366"><font color="#FFFFFF"> 
            <?php if (isset($text)) echo "You are visiting $text category products"; ?>
            </font></td>
        </tr>
      </table>
      <table width="96%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <?php
  $i=0;
  while($db->next_record())
  {
  if ($i%2==0) echo "</tr><tr>";
?>
          <td width="50%" align="center">
            <table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" height="120">
              <tr> 
                <td colspan="3" height="4"></td>
              </tr>
              <tr> 
                <td width="20%" align="center"> 
                  <?php 
			echo "<a href='goods_list.php?id=".$db->f('id')."' target='_blank'><img src='".show_img($db->f('image'),80,80)." border='0'></a>";
			 ?>
                </td>
                <td width="2" valign="top">&nbsp;</td>
                <td width="77%" valign="top"><b><font class=p14 color=#000000> 
                  <?php echo "<a href='goods_list.php?id=".$db->f('id')."' class='softtitle' target='_blank'>".stripslashes($db->f('name'))."</a>"; ?>
                  </font></b><br>
                  retail:<font color=red> 
                  <?php echo $db->f('price_m'); ?>
                  </font>$<br>
                  membership:<font class=p13 color=#ff3333 
                  size=2><?php
			if ($user_price)
			  if (isset($login_name))
			     echo $db->f('price');
			  else
			    echo "";
			else
			   echo $db->f('price');
			 ?>
                  </font>$<br>
                  status:<font color=red> 
                  <?php			
			if ($db->f('state')==0)  echo "In stock"; 
			if ($db->f('state')==1)  echo "Out Of Stock";
			?>
                  </font><br>
                  <a href="shopping.php?id=<?php echo $db->f('id') ?>" target="cart" class='clink03'>Buy it</a> 
                  </td>
              </tr>
              <tr> 
                <td colspan="3"><img src="images/spacer.gif" width="1" height="1"></td>
              </tr>
              <tr > 
                <td colspan="3" background="images/line1.gif"><img src="images/spacer.gif" width="1" height="1"></td>
              </tr>
            </table>
          </td>
          <?php
		$i++;
		}
		?>
        </tr>
      </table>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF."?up_id=$up_id&sf=$sf" ?> " method="post" name="form8" onSubmit="return check_page('form8.page')">
          <tr> 
            <td align="right"> total: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
 if ($page1 < 1) echo "<FONT color=#999999>first&nbsp;previous</FONT>&nbsp;"; 
  else{ 
  if(isset($up_id))	
  echo "<a href='$PHP_SELF?page=1&up_id=$up_id'>first</a>&nbsp;<a href='$PHP_SELF?page=$page1&up_id=$up_id'>previous</a>&nbsp;";
  else
  	echo "<a href='$PHP_SELF?page=1'>first</a>&nbsp;<a href='$PHP_SELF?page=$page1'>previous</a>&nbsp;";

 }
  
  if ($page2 > $totalpage) echo "<FONT color=#999999>next&nbsp;last</FONT>&nbsp;"; 
  else {
if(isset($up_id))
echo "<a href='$PHP_SELF?page=$page2&up_id=$up_id'>next</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&up_id=$up_id'>last</a>&nbsp;";
else
	echo "<a href='$PHP_SELF?page=$page2'>next</a>&nbsp;<a href='$PHP_SELF?page=$totalpage'>last</a>&nbsp;";
} 
?>
              current:<b> 
              <?php echo $page."/".$totalpage ?>
              </b>&nbsp; 
              <script language="JavaScript">
function check_page(name)
{
 eval("page="+name+".value");
 if (isNaN(page) || page <=0 || page > <?php echo $totalpage ?>)
  {
    alert ("Please enter the page number, the maximum is <?php echo $totalpage ?> ！");
    eval(name+".select()");
	return false;
  }
}
</script>
              
            </td>
          </tr>
        </form>
      </table>
    </td>
    <td width="170" valign="top" align="center"> 
      <table border=0 cellpadding=0 cellspacing=0 width=100%>
        <tbody> 
        <tr> 
          <td ><center>Your Shopping Cart</center></td>
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
      <br>
     
    
      <br>

    </td>
  </tr>
</table>
<?php include "conf/footer.php"; ?>
</body>
</html>
