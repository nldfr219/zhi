<?php
require "conf/config.php";
if ($u=="")
{
 echo "error parameter!";
 exit();
}
if ($user_reg_flag==0)
{
 echo "Can't register<BR><BR>Sorry，Registration is closed";
 exit();
}
?>
<html>
<head>
<title><?php echo $sitename ?> -- User registration</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="center" bgcolor="#EFEFEF"> 
    <td bgcolor="#FFFFFF"> 
      <table width="630" border="0">
        <tr> 
          <td height="18" class="p14"> 
            <table border=0 cellpadding=0 cellspacing=0 width="100%">
              <tbody> 
              <tr align="left"> 
                <th bgcolor=#ffffff colspan=4 height=22 valign=top> <font class=p14 color=#cc0000>Registration Result
             </font></th>
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
            <p><br>
              <?php
$db->query("select null from $user_t where u_name='$u'");
if ($db->num_rows()==0) 
{

$reg_date=date("Y-m-d");
$str_sql = "insert into $user_t(id, u_name, u_pass, name, sex, email, state, city, tel, address, post, reg_date, last_date,times,action)
           values(null,'$u','$u_pass','$name','$sex','$email','$state','$city','$tel','$address',
                  '$post','$reg_date','$date_tmp',0,'$init_action')";
}
if ($db->query($str_sql))
{  echo "You have successfully registered to a member of our community.<BR><BR>";
if ($init_action=="y")
 echo "Please use the username and password to log in the website.";
else
 echo "But now you can't log in. The account will be activated in two days. Pleae check your email";
}
else
  echo "Sorry, you fail the registration. Please register again.";
?>
            </p>
            <p> 
              <input type="button" value="return" onClick="JavaScript:window.location.href='index.php'" class="stbtm"  name="button3">
            </p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
