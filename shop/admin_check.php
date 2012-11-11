<?php

 if (isset($_SESSION['admin_name']))
   return ;
  else
  {
?>
<html>
<head>
<title><?php echo $sitename ?> -- Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div align="center">You haven't loged in <a href="admin.php">[login] </a> </div>
</body>
</html>
<?php
exit(); 
  }
?>