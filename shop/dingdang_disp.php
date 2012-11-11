<?php
require "conf/config.php";
include "chk.php";
?>
<html>
<head>
<title><?php echo $sitename ?> -- Search orders</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="749" border="0" cellspacing="1" align="center">
  <tr bgcolor="#EFEFEF" align="center"> 
    <td> <br>
      <table width="96%" border="0" cellspacing="0" bgcolor="#ffffff">
        <tr> 
          <td height="17"><b>Order ID
            <?php echo $id; ?>
            </b></td>
        </tr>
      </table>
<?php
$db->query("select * from $shopping_t where user_id=$login_id and requests_id=($id-$init_num)");
if ($db->num_rows())
{
?>
      <br>
      <table align=center border=0 cellspacing=0 width="96%">
        <tbody> 
        <tr> 
          <td>Products in the order:</td>
        </tr>
        </tbody> 
      </table>
      <table border=1 cellspacing=0 width="85%">
        <tbody> 
        <tr align=middle> 
          <td width="35%"><font color=#cc0000>Product name</font></td>
          <td width="15%"><font color=#cc0000>Quantity</font></td>
          <td width="15%"><font color=#cc0000>retail</font></td>
          <td width="15%"><font color=#cc0000>membership</font></td>
          <td width="20%"><font color="#cc0000">Bought time</font></td>
        </tr>
        <?php
while($db->next_record())
{
?>
        <tr> 
          <td width="35%">
            <?php
$db2->query("select name,price_m,price from $goods_t where id=".$db->f('goods_id'));
$db2->next_record();
echo stripslashes($db2->f('name'));
?>
          </td>
          <td align=middle width="15%">
            <?php echo $db->f('goods_num'); ?>
          </td>
          <td align=center width="15%">
            <?php echo $db2->f('price_m'); ?>$
            </td>
          <td align=center width="15%">
            <?php echo $db2->f('price'); ?>$
            </td>
          <td align=center width="20%">
            <?php echo $db->f('date_created'); ?>
          </td>
        </tr>
        <?php } ?>
        </tbody> 
      </table>
      <br>
      <table border=0 cellspacing=0 width="89%">
        <tbody> 
        <tr> 
          <td> Additional information:</td>
        </tr>
        </tbody> 
      </table>
      <?php
$db->query("select * from $requests_t where id=($id-$init_num)");
$db->next_record();
?>
      <br>
      <table align=center border=0 cellspacing=0 width="86%">
        <tbody> 
        <tr> 
          <td height=25 width="18%"><font color=#cc0000>Order ID:</font> </td>
          <td width="31%">
            <?php echo $id; ?>
          </td>
          <td width="16%"><font color=#cc0000>Order time:</font> </td>
          <td width="35%">
            <?php echo $db->f('date_created'); ?>
          </td>
        </tr>
        <tr> 
          <td height=26 width="18%"><font color=#cc0000>Order status:</font></td>
          <td height=26 width="31%">
            <?php 
            switch($db->f('orderstatus'))
						{
							case 0:
								echo "not shipped";
								break;
							case 1:
								echo "shipped out";
								break;
							case 2:
								echo "delivered";
								break;
									

						} ?>
          </td>
          <td height=26 width="16%">&nbsp;</td>
          <td height=26 width="35%">&nbsp;</td>
        </tr>
        <tr> 
          
          <td height=24 width="16%"><font color=#cc0000>Fee:</font></td>
          <td height=24 width="35%">
            <?php echo $db->f('fee'); ?>
            $</td>
        </tr>
        
       
        </tbody> 
      </table>
      <table border=0 cellspacing=0 width="89%">
        <tbody> 
        <tr> 
          <td> Recipients information:</td>
        </tr>
        </tbody> 
      </table>
      <table align=center border=0 cellspacing=0 width="86%">
        <tbody> 
        <tr> 
          
          <td width="16%"><font color=#cc0000>Name:</font> </td>
          <td width="35%">
            <?php echo $db->f('name'); ?>
          </td>
        </tr>
        <tr> 
          <td height=28 width="18%"><font color=#cc0000>Email:</font> </td>
          <td height=28 width="31%">
            <?php echo "<a href='mailto:".$db->f('email')."'>".$db->f('email')."</a>"; ?>
          </td>
          <td height=28 width="16%"><font color=#cc0000>Telephone:</font> </td>
          <td height=28 width="35%">
            <?php echo $db->f('tel'); ?>
          </td>
        </tr>
        <tr> 
          <td height=28 width="18%"><font color=#cc0000>State:</font> </td>
          <td height=28 width="31%">
            <?php echo $db->f('state'); ?>
          </td>
          <td height=28 width="16%"><font color=#cc0000>City:</font> </td>
          <td height=28 width="35%">
            <?php echo $db->f('city'); ?>
          </td>
        </tr>
        <tr> 
          <td height=28 width="18%"><font color=#cc0000>Zip code:</font> </td>
          <td height=28 width="31%">
            <?php echo $db->f('post'); ?>
          </td>
          <td height=28 width="16%"><font color=#cc0000>Address:</font> </td>
          <td height=28 width="35%">
            <?php echo $db->f('address'); ?>
          </td>
        </tr>
        </tbody> 
      </table>
<?php
 }
else
 echo "<br><br>Sorry this order doesn't exist!<br><br>";
?>
	  <br>
	  
    </td>
  </tr>
</table>
<div align="left">
  <?php include "conf/footer.php"; ?>
</div>
</body>
</html>
