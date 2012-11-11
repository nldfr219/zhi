<?php
require "conf/config.php";
include "admin_check.php";
  
if (isset($Submit))
{
   $aryid=@implode(",",$delete);
   $db2->query("delete from $user_t where id in($aryid)");
   $result="successfully deleted the ueser.";
}
if (isset($action)&&$action=="active")
  $db->query("update $user_t set action='$f' where id=$id");
?>
<html>
<head>
<title><?php echo $sitename ?> -- Member Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/admin.php"; ?>
<table width="750" border="0" align="center">
  <tr bgcolor="#EFEFEF"> 
    <td class="p13" align="center" height="26">Member admin
      <script language="JavaScript">
function open_win(htmlurl) {
  var newwin=window.open(htmlurl,"<?php echo $sitename ?>","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=400,height=450");
  return false;
}
</script>
    </td>
  </tr>
  <form name="form1" method="post">
    <tr bgcolor="#EFEFEF"> 
      <td align="center" bgcolor="#EFEFEF"> According to username or real name: 
        <input type="text" name="key" size="15" class="think" >
        <input type="submit" name="submit1" value="Search" class="stbtm2">
      </td>
    </tr>
  </form>
  <tr bgcolor="#EFEFEF"> 
    
  </tr>
  <tr bgcolor="#EFEFEF">
    <td height="16" align="center"> 
      <?php if(isset($result)) echo $result;
 if (isset($key))
     $tmp="where u_name like '%$key%' or name like '%$key%'";
  if (isset($date1) && isset($date2)) 
     $tmp="where reg_date between '$date1' and '$date2'";
  if (!isset($page)) $page=1;
  if(!isset($tmp)) $tmp="";
  $db->query("select null from $user_t $tmp");
  $total_num=$db->num_rows();//得到总记录数
  $totalpage=ceil($total_num/$num_to_show);//得到总页数
  $init_record=($page-1)*$num_to_show;
  $db->query("select *
   from $user_t $tmp
   order by id DESC limit $init_record, $num_to_show");        
?>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF."?key=$key" ?> " method="post" name="form8" onSubmit="return check_page('form8.page')">
          <tr> 
            <td align="right"> total: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>first&nbsp;previous</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1&key=$key'>first</a>&nbsp;<a href='$PHP_SELF?page=$page1&key=$key'>previous</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>next&nbsp;last</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2&key=$key'>next</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&key=$key'>last</a>&nbsp;"; 
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
    alert ("请正确输入页数，最大值为 <?php echo $totalpage ?> ！");
    eval(name+".select()");
	return false;
  }
}
</script>
           
            </td>
          </tr>
        </form>
      </table>
      <form name="form_sele" method="post" action="">      
        <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#3196B3" align="CENTER">
          <tr bgcolor="#D3E3FE"> 
            <td colspan="13" align="center"> 
              <input type="checkbox" name="deleteall" value="on" onClick="CheckAll(this.form,this.checked)">
              <font color="#CC3366">select all</font>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" value="delete" onClick="if(!confirm('Are you sure to delete?')) return false;" class="stbtm2">
            </td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF" align="center" width="8%"><font color="#cc0000"> 
              username</font></td>
            
            <td bgcolor="#FFFFFF" align="center" width="6%"><font color="#cc0000">password</font></td>
            <td bgcolor="#FFFFFF" align="center" width="14%"><font color="#cc0000"> 
              email</font></td>
            <td bgcolor="#FFFFFF" align="center" width="6%"><font color="#cc0000">real name</font></td>
            <td bgcolor="#FFFFFF" align="center" width="3%"><font color="#cc0000">sex</font></td>
            <td bgcolor="#FFFFFF" align="center" width="5%"><font color="#cc0000">city</font></td>
            <td bgcolor="#FFFFFF" align="center" width="8%"><font color="#cc0000">register time</font></td>
            <td bgcolor="#FFFFFF" align="center" width="8%"><font color="#cc0000">last login time</font></td>
            <td bgcolor="#FFFFFF" align="center" width="6%"><font color="#cc0000">login times</font></td>
            
            
            <td width="5%" align="center" bgcolor="#FFFFFF" bordercolor="#FFFFFF" class="black">delete</td>
          </tr>
          <?php
 while($db->next_record())
  {
?>
          <tr> 
            <td bgcolor="#FFFFFF" width="8%"> <a href="admin_user_list.php?id=<?php echo $db->f('id') ?>" class='clink03' target="_blank"> 
              <?php echo $db->f('u_name') ?>
              </a> </td>
           
            <td bgcolor="#FFFFFF" width="6%"> 
              <?php echo $db->f('u_pass'); ?>
            </td>
            <td bgcolor="#FFFFFF" width="14%"> 
              <?php echo "<a href='mailto:".$db->f('email')."' class='clink03'>".$db->f('email')."</a>"; ?>
            </td>
            <td bgcolor="#FFFFFF" width="6%"> 
              <?php echo $db->f('name'); ?>
            </td>
            <td bgcolor="#FFFFFF" align="center" width="3%"> 
              <?php if ($db->f('sex')==1) echo "male"; else echo "female"; ?>
            </td>
            <td bgcolor="#FFFFFF" align="center" width="5%"> 
              <?php echo $db->f('city'); ?>
            </td>
            <td bgcolor="#FFFFFF" width="8%" align="center"> 
              <?php echo $db->f('reg_date'); ?>
            </td>
            <td bgcolor="#FFFFFF" width="8%" align="center"> 
              <?php echo substr($db->f('last_date'),0,10); ?>
            </td>
            <td bgcolor="#FFFFFF" width="6%" align="center"> 
              <?php echo $db->f('times');?>
            </td>
            
            
            <td bgcolor="#FFFFFF" align="center" width="5%"> 
              <input type="checkbox" name="delete[]" value="<?php echo $db->f('id') ?>">
            </td>
          </tr>
		  <?php } ?>
          <tr bgcolor="#D3E3FE" align="center"> 
            <td colspan="13"> 
              <input type="checkbox" name="deleteall" value="on" onClick="CheckAll(this.form,this.checked)"   >
              <font color="#CC3366">select all</font>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" value="delete" onClick="if(!confirm('Are you sure to delete?'))return false;" class="stbtm2">
            </td>
          </tr>          
        </table>
	  </form>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF."?key=$key" ?> " method="post" name="form88" onSubmit="return check_page('form88.page')">
          <tr> 
            <td align="right"> total: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>first&nbsp;previous</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1&key=$key'>first</a>&nbsp;<a href='$PHP_SELF?page=$page1&key=$key'>previous</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>next&nbsp;last</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2&key=$key'>next</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&key=$key'>last</a>&nbsp;"; 
?>
              current:<b> 
              <?php echo $page."/".$totalpage ?>
              </b>&nbsp; 
            </td>
          </tr>
        </form>
      </table>
    </td>
  </tr>
</table>
<br>
<div align="center"></div>
<div align="center"></div>
<p>
  <?php include "conf/footer.php"; ?>
</p>
</body>
</html>
