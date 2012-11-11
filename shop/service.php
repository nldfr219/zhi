<?php
require "conf/config.php";

?>
<html>
<head>
<title><?php echo $sitename ?> -- Customer service</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#efefef"> 
    <td class="p14"> <br>
      <table cellspacing=0 cellpadding=0 width="90%" border=0>
        <tbody> 
        <tr> 
          <td> 
            <table cellspacing=0 cellpadding=0 width="100%" border=0>
              <tbody> 
              <tr> 
                <td><a class="clink03"  name=Top></a><font 
                  style="FONT-SIZE: 16px; FONT-FAMILY: 宋体"><font 
                  style="FONT-SIZE: 16px; FONT-FAMILY: 宋体">Customer service</font></font></td>
                <td><a class="clink03"  href="contact.php"><font 
                  style="FONT-SIZE: 16px; FONT-FAMILY: 宋体" 
                  color=red>Contact Us</font></a></td>
              </tr>
              </tbody>
            </table>

<?php include "conf/footer.php"; ?>
</body>
</html>
