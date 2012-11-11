<?php
require "conf/config.php";
include "admin_check.php";
?>
<html>
<head>
<title><?php echo $sitename ?> -- Browse members</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/admin.php"; ?>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="center"> 
    <td>&nbsp;</td>
  </tr>
  <tr align="center" bgcolor="#EFEFEF"> 
    <td> 
      <?php
$db->query("select * from $user_t where id=$id");
$db->next_record();
if ($db->num_rows())
  {
?>
      <table width="630" border="0">
        <tr> 
          <td height="18" class="p14"> 
            <table border=0 cellpadding=0 cellspacing=0 width="100%">
              <tbody> 
              <tr align="left"> 
                <th bgcolor=#ffffff colspan=4 height=22 valign=top><font color=#ffffcc 
                  face="Arial, Helvetica, sans-serif"><b><font class=p14 
                  color=#cc0000>
                  <?php echo $db->f('u_name') ?>
                  detail information:</font></b></font></th>
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
    
              <table width="96%" border="1" bordercolorlight="#d2d2d2" cellpadding="0" cellspacing="0" bordercolordark="#ffffff">
                <tr align="center"> 
                  <td> 
                    
                  <table width="90%" border="1" height="381" cellspacing="1" cellpadding="3" bgcolor="#CCCCCC" bordercolor="#FFFFFF">
                    <tr bgcolor="#FFFFFF"> 
                      <td align="right" width="21%">Username:</td>
                      <td width="79%"> <font color="#CC0000"> 
                        <?php echo $db->f('u_name') ?>
                        </font></td>
                    </tr>
                    <tr bgcolor="#FFFFFF"> 
                      <td align="right" height="27" width="21%">password:</td>
                      <td height="27" width="79%"> <font color="#CC0000"> 
                        <?php echo $db->f('u_pass') ?>
                        </font></td>
                    </tr>
                    <tr bgcolor="#FFFFFF"> 
                      <td align="right" width="21%">Email:</td>
                      <td width="79%"> <font color="#CC0000"> 
                        <?php echo "<a href='mailto:".$db->f('email')."' class='clink03'>".$db->f('email')."</a>"; ?>
                        </font></td>
                    </tr>
                    <tr bgcolor="#FFFFFF"> 
                      <td align="right" width="21%">Real name:</td>
                      <td width="79%"> <font color="#CC0000"> 
                        <?php echo $db->f('name') ?>
                        </font></td>
                    </tr>
                    <tr bgcolor="#FFFFFF"> 
                      <td width="21%" align="right">Sex: </td>
                      <td width="79%"> <font color="#CC0000"> 
                        <?php if ($db->f('sex')==1) echo "male"; else echo "female"; ?>
                        </font></td>
                    </tr>
                    <tr bgcolor="#FFFFFF"> 
                      <td align="right" width="21%">State: </td>
                      <td width="79%"> <font color="#CC0000"> 
                        <?php echo $db->f('state') ?>
                        </font></td>
                    </tr>
                    <tr bgcolor="#FFFFFF"> 
                      <td align="right" width="21%">City: </td>
                      <td width="79%"> <font color="#CC0000"> 
                        <?php echo $db->f('city') ?>
                        </font></td>
                    </tr>
                    <tr bgcolor="#FFFFFF"> 
                      <td align="right" width="21%">Telephone: </td>
                      <td width="79%"> <font color="#CC0000"> 
                        <?php echo $db->f('tel') ?>
                        </font></td>
                    </tr>
                    <tr bgcolor="#FFFFFF"> 
                      <td align="right" width="21%">Address: </td>
                      <td width="79%"> <font color="#CC0000"> 
                        <?php echo $db->f('address') ?>
                        </font></td>
                    </tr>
                    <tr bgcolor="#FFFFFF"> 
                      <td align="right" width="21%">Zip code: </td>
                      <td width="79%"> <font color="#CC0000"> 
                        <?php echo $db->f('post') ?>
                        </font></td>
                    </tr>
                  
                    <tr bgcolor="#FFFFFF"> 
                      <td width="21%" align="right">Register time:</td>
                      <td width="79%"> <font color="#CC0000"> 
                        <?php echo $db->f('reg_date'); ?>
                        </font></td>
                    </tr>
                    <tr bgcolor="#FFFFFF"> 
                      <td width="21%" align="right">Last login time:</td>
                      <td width="79%"> <font color="#CC0000"> 
                        <?php echo $db->f('last_date'); ?>
                        </font></td>
                    </tr>
                    <tr bgcolor="#FFFFFF"> 
                      <td width="21%" align="right">Login times:</td>
                      <td width="79%"> <font color="#CC0000"> 
                        <?php echo $db->f('times');?>
                        </font></td>
                    </tr>
                    
                  </table>
                  </td>
                </tr>
              </table>
            
          </td>
        </tr>
      </table>
      <?php
}
else
 echo "<br><br>对不起，您浏览的用户不存在!<br><br>";
?>
    </td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
