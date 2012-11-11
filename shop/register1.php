<?php
require "conf/config.php";
if (isset($u))
{
 $db->query("select null from $user_t where u_name='$u'");
 if ($db->num_rows()==0) 
   header("Location: register2.php?u=$u");
 else
   $flag=1;
}
?>
<html>
<head>
<title><?php echo $sitename ?> -- User Registration</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center">
  <tr align="center"> 
    <td><h1>User registration step 1</h1> 
      <script language="JavaScript">
function check()
{
	if (document.formlogin.u.value.length<4 || document.formlogin.u.value.indexOf(' ')!=-1 || document.formlogin.u.value.indexOf("'") != -1 )
	{
		document.formlogin.u.focus();
		window.alert("4-16 characters!");
		return false;  
	}
}
</script>
    </td>
  </tr>
  <tr align="center"> 
    <td> 
<?php
if ($user_reg_flag==0)
{
 echo "<BBR><BR>Can't register new users <BR><BR>Sorry the registrition is closed。";
}
else
{
?>      
	  <table width="630" border="0">
        <tr> 
          <td height="18" class="p14"> 
            <table border=0 cellpadding=0 cellspacing=0 width="100%">
              <tbody> 
              <tr align="left"> 
                <th bgcolor=#ffffff colspan=4 height=22 valign=top> <font class=p14 color=#cc0000>Account Information <span 
                  class=p9><font color=#666666><b>(<font 
                  color=#cc0000>*</font>is a must)</b></font></span></font> </th>
              </tr>
              <tr bgcolor=#cc0000> 
                <td colspan=4 height=2 valign=top></td>
              </tr>
              </tbody> 
            </table>
          </td>
        </tr>
        <tr align="center"> 
          <td height="18"> 
            <form name="formlogin" method="post" action="" onSubmit="return(check());">
              <table width="63%" border="0">
                <tr> 
                  <td height="18">&nbsp; </td>
                </tr>
                <tr> 
                  <td height="19">
                    <?php
if (isset($flag)) echo "<b><font color=#cc0033>Sorry，the username:".$u."has been registered, please try another one.</font></b>";
?>
                  </td>
                </tr>
                <tr> 
                  <td height="19">username: 
                    <input type="text" name="u" class=think maxlength="16" size="12">
                    <font color=#cc0000>*</font>(4-16 characters) </td>
                </tr>
                <tr> 
                  <td height="18">&nbsp;</td>
                </tr>
                <tr> 
                  <td height="18">&nbsp;</td>
                </tr>
                <tr align="center"> 
                  <td> 
                    <input type="submit" name="Submit" value=" register" class=stbtm2>
                  </td>
                </tr>
              </table>
            </form>
          </td>
        </tr>
      </table>
    <?php } ?>
	</td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
