<?php
require "conf/config.php";

if (isset($u_name))
{
if (strpos($u_name,"'") || strpos($u_pass,"'"))
{
echo "The way you log in is wrong£¡Please relogin <a href='login.php'>[login]</a>";
exit();
}
$db->query("select id,u_pass,action from $user_t where u_name='$u_name'");
$db->next_record();
if ($db->num_rows())
{
if ($db->f('u_pass')==$u_pass)
{
	if ($db->f('action')=="n")
        $err="Sorry the account has not been activated <a href='mailto:$siteemail' class='title'>Please inform the administrator</a>";
    else
	{
$_SESSION['login_id']=null;  
$_SESSION['login_name']=NULL;
$_SESSION['login_id']=$db->f('id');
$_SESSION['login_name']=$u_name;

setcookie("cookielogintime",$date_tmp,time()+7200,"/");
$db->query("update $user_t set last_date='$date_tmp',times=times+1
            where u_name='$u_name'");
 $url="index.php";

$err='<meta http-equiv="refresh" content="2;URL='.$url.'">log in successful, returning......';
	}
}
else
  $err="The password is not correct, please relogin<a href='login.php' class='title'>[login]</a>";
}
else
  $err="Username does not exsit, please relogin <a href='login.php' class='title'>[login]</a>";
$err.="<br><br><input type=\"button\" value=\"return\" onClick=\"JavaScript:window.location.href='index.php'\" class=\"stbtm\"  name=\"button3\">";
}
?>
<html>
<head>
<title><?php echo $sitename ?> -- User Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" <?php if (!isset($err)) echo 'onload="document.login.u_name.focus();"' ?>>
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#efefef"> 
    <td> 
      <p>&nbsp; </p>
      <p>
        <?php
if (isset($u_name))
  echo $err;
else
{
?>
      </p>
      <table align=center border=0 cellspacing=0 width=300>
        <tbody> 
        <tr> 
          <td height=30 align="center"> <img height=35 src="images/denlu1.gif" 
            width=170> 
            <script language="JavaScript">
function check()
{
 document.login.submit.disabled=true;
 document.login.submit2.disabled=true;
}
</script>
          </td>
        </tr>
        <tr> 
          <td align="center"> <br>
            <?php if (isset($login_name))
  echo "Dear <font color='#cc0000'>".$login_name."</font>.Hello, you have successfully loged in.";
?>            
            <form action="" method=post name=login onSubmit="return(check());">
              <table align=center border=0 cellpadding=2 cellspacing=5 
width="80%">
                <tbody> 
                <tr> 
                  <td width="35%" align="right"> username<b>:</b></td>
                  <td width="65%"> 
                    <input class=think name=u_name size=15>
                  </td>
                </tr>
                <tr> 
                  <td width="35%" align="right"> password<b>:</b></td>
                  <td width="65%"> 
                    <input class=think name=u_pass size=15 
                  type=password>
                  </td>
                </tr>
                <tr align="center"> 
                  <td colspan=2 height=27 width="65%"> 
                    <input class=stbtm name=submit type=submit value=login>
                    <input class=stbtm name=submit2 onClick="JavaScript:window.location.href='register1.php'" type=button value=register>
                    <input type="hidden" name="url" value="<?php echo $url ?>">
                  </td>
                </tr>
                <tr align="center">
                  <td colspan=2 height=27 width="65%"><img height=11 
                  src="images/forget.gif" width=11> &nbsp;I forget my password,<a 
                  href="password.php"><font 
                  color=#ce0929>Please click here!</font></a></td>
                </tr>
                </tbody> 
              </table>
            </form>
          </td>
        </tr>
        <tr> 
          <td height=10></td>
        </tr>
        <tr> 
          <td> </td>
        </tr>
        </tbody> 
      </table>
      <?php } ?>
    <p>&nbsp;</p></td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
