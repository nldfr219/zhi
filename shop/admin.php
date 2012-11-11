<?php
require "conf/config.php";

//检测install.php文件,如果存在则删除
if (file_exists("install.php")==1)
{
	if (!@unlink("install.php"))
	{
		echo "<html><body><p> install.php still exist. 
</p></body></html>";
		exit;
	}
}

if (isset($submit))
 if ($a_xmxm==$ad_name && $a_pass==$ad_pass)
  {     
   $_SESSION['admin_name']=$a_xmxm;
   
   }
?>
<html>
<head>
<title><?php echo $sitename ?> -- Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" <?php if (!isset($_SESSION['admin_name'])) echo 'onload="document.login.a_xmxm.focus();"'; ?>>
<?php
if (isset($_SESSION['admin_name']))
 include "conf/admin.php";
?>
<table width="750" align="center">
  <tr align="center"> 
    <td bgcolor="#EFEFEF" class="p13"> 
      <p><br>
        Admin Homepage<br>
      </p>
      <table align=center border=0 cellspacing=0 width=510>
        <tbody> 
        <tr> 
          <td height=30 align="center"> Admin Login</td>
        </tr>
        <tr>
          <td height="38" align="center" class="p13"> 
            <?php
if (isset($logout))
{
 session_destroy();
 echo "<br>You have loged out,";
 echo '<meta http-equiv="refresh" content="2;URL=index.php">return......';
}
if (isset($_SESSION['admin_name']))
   echo "<br>Admin status: <font color=blue>".$_SESSION['admin_name']."</font> now admin ing...&nbsp;&nbsp;  <input class=stbtm2 name=button2 type=button onClick=\"JavaScript:if (confirm('Are you sure to log out?')) window.location.href='admin.php?logout=1'\" value=\"logout\">";
else
   echo "<br>Admin status:not loged in yet...";
if (isset($submit))
  if (isset($_SESSION['admin_name']))
   echo "";
  else
   echo "<br>username or password is not correct, please  <a href='admin.php'><font color=blue>[reglogin]</a>";
else
{
?>
          
          </td>
        </tr>
        <tr> 
          <td align="center"> 
            <?php
 if (!(isset($_SESSION['admin_name'])))
{
?>
            <form  method=post name=login>
              <table align=center border=0 cellpadding=2 cellspacing=5 width="260">
                <tbody> 
                <tr> 
                  <td width="35%" align="right"> username<b>:</b></td>
                  <td width="65%"> 
                    <input class=think name=a_xmxm size=15>
                  </td>
                </tr>
                <tr> 
                  <td width="35%" align="right"> password<b>:</b></td>
                  <td width="65%"> 
                    <input class=think name=a_pass size=15 
                  type=password>
                  </td>
                </tr>
                <tr align="center"> 
                  <td colspan=2 height=27 width="65%"> 
                    <input class=stbtm name=submit type=submit value="login">
                    <input class=stbtm name=reset type=reset value="reset">
                    <input class=stbtm name=button type=button onClick="JavaScript:if (confirm('Are you sure to log out?')) window.location.href='admin.php?logout=1'" value="logout">
                  </td>
                </tr>
                </tbody> 
              </table>
            </form><?php } ?>
          </td>
        </tr><?php } ?>

        </tbody> 
      </table>
      <?php
 if (isset($_SESSION['admin_name']))
{
?>
      <br>
      <table width="500" border="0" cellpadding="2" cellspacing="1" bgcolor="#7777777">
        <tr> 
          <td colspan="5" height="26" align="center"><b><font color="#FFFFFF">website statistic</font></b></td>
        </tr>
        <tr> 
          <td bgcolor="#dddddd" width="25%" align="right">number of product class</td>
          <td bgcolor="#eeeeee" width="20%"> 
            <?php
$db->query("select count(*) as total from $class_t");
$db->next_record();
echo $db->f('total');
?>
          </td>
          
        </tr>
        <tr> 
          <td height="20" bgcolor="#dddddd" width="25%" align="right">product number</td>
          <td height="20" bgcolor="#eeeeee" width="20%"> 
            <?php
$db->query("select count(*) as total from $goods_t");
$db->next_record();
echo $db->f('total');
?>
          </td>
          </tr>
          <tr>
        
          <td bgcolor="#dddddd" width="25%" align="right">pending order</td>
          <td bgcolor="#eeeeee" width="20%"> 
            <?php
$db->query("select count(*) as total from $requests_t where orderstatus=0 ");
$db->next_record();
echo $db->f('total');
?>
          </td>
        </tr>
        <tr> 
   
          
          <td height="20" bgcolor="#dddddd" width="25%" align="right"> successful orders </td>
          <td height="20" bgcolor="#eeeeee" width="20%"> 
            <?php
$db->query("select count(*) as total from $requests_t where orderstatus=1");
$db->next_record();
echo $db->f('total');
?>
          </td>
        </tr>
        <tr> 
          <td height="20" bgcolor="#dddddd" width="25%" align="right">number of registration</td>
          <td height="20" bgcolor="#eeeeee" width="20%"> 
            <?php
$db->query("select count(*) as total from $user_t");
$db->next_record();
echo $db->f('total');
?>
          </td>
          </tr>

      
     
          
       
        
      </table>
      <?php } ?>
      <br>
    </td>
  </tr>
</table>
<br>

<?php include "conf/footer.php"; ?>
</body>
</html>
