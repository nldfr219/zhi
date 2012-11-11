<?php
require "conf/config.php";
 
?>
<html>
<head>
<title><?php echo $sitename ?> -- Contact</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#efefef"> 
    <td height="237" class="p14"> 
      <p>Address: 
        <?php echo $siteadd ?><br>Telephone: 
        <?php echo $sitetel ?>
      </p>
      <p>
        E_mail:<a href="mailto:<?php echo $siteemail ?>" class="clink03"> 
        <?php echo $siteemail ?>
        </a></p>
    </td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
