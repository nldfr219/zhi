<?php
require "conf/config.php";

?>
<html>
<head>
<title><?php echo $sitename ?> -- visit products</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center">
  <tr> 
    <td width="182" valign="top">
      <table border=0 cellpadding=0 cellspacing=0 width=180>
        <tbody> 
        <tr> 
          <center>Your shopping cart</center>
        </tr>
        <tr valign=top> 
          <td colspan=3> 
            <table align=center border=0 cellpadding=0 cellspacing=0 
            width="100%">
              <tbody> 
              <tr> 
                <td bgcolor=#ffcc00><img height=1 
                  src="images/spacer.gif" width=1></td>
              </tr>
              <tr> 
                <td bgcolor=#ffcc00 valign=top> 
                  <table align=center border=0 cellpadding=0 cellspacing=0 
                  width="99%">
                    <tbody> 
                    <tr> 
                      <td bgcolor=#ffffff valign=top><iframe frameborder=0 
                        height=182 name=cart scrolling=no 
                        src="shopping.php" 
                    width="100%"></iframe></td>
                    </tr>
                    </tbody> 
                  </table>
                </td>
              </tr>
              <tr> 
                <td bgcolor=#ffcc00 height=1><img height=1 
                  src="images/spacer.gif" 
        width=1></td>
              </tr>
              </tbody> 
            </table>
          </td>
        </tr>
        </tbody> 
      </table>
    </td>
    <td width="558" align="center"> 
      <?php
  $db->query("select * from $goods_t where id=$id");
  $db->next_record();
  if ($db->num_rows())
  {
?>
      <table width="96%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td width="27%" align="center"> 
            <?php 
			echo "<img src='".show_img($db->f('image'),100,100)." border='0'>";
			 ?>
          </td>
          <td width="73%" valign="top"><b><font class=p14 color=#000000> 
            <?php echo stripslashes($db->f('name')); ?>
            </font></b><br>
            retail:<font color=red> 
            <?php echo $db->f('price_m'); ?>
            </font>$<br>
            membership:<font class=p13 color=#ff3333 
                  size=2><?php
			if ($user_price)
			  if (isset($login_name))
			     echo $db->f('price');
			  else
			    echo "";
			else
			   echo $db->f('price');
			 ?>
            </font>$<br>
            status:<font color=red> 
            <?php			
			if ($db->f('state')==0)  echo "in stock"; 
			if ($db->f('state')==1)  echo "out of stock";
			?>
            </font><br>
            <a href="shopping.php?id=<?php echo $db->f('id') ?>" target="cart" class='clink03'>Buy it</a> 
             <br>
          </td>
        </tr>
        <tr> 
          <td colspan="2"><img src="images/spacer.gif" width="1" height="1"></td>
        </tr>
        <tr > 
          <td colspan="2" background="images/line1.gif"><img src="images/spacer.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td colspan="2" class="p14"><b>Description</b></td>
        </tr>
        <tr bgcolor="#000000"> 
          <td colspan="2"><img src="images/spacer.gif" width="1" height="1"></td>
        </tr>
        <tr> 
          <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;<font class=p14 color=#000000> 
            <?php echo stripslashes(nl2br($db->f('descript'))) ?>
            </font></td>
        </tr>
        <tr bgcolor="#000000"> 
          <td colspan="2"><img src="images/spacer.gif" width="1" height="1"></td>
        </tr>
      </table>
<?php
}
else
 echo "Sorry, the product you are visiting does not exist!<br><br>";
?>
    </td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
