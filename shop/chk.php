<?php

 if (isset($_SESSION["login_id"]) && isset($_SESSION["login_name"]) && isset($login_id))
   return ;
  else
  {
?>
<html>
<head>
<title><?php echo $sitename ?> -- User Logout</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#efefef"> 
    <td> 
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>You haven't loged in, please <a href="login.php?url=<?php echo $PHP_SELF ?>" class="title">[login]</a></p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      </td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
<?php
 }
 exit(); 
?>