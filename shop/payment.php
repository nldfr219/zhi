<?php
require "conf/config.php";
include "chk.php";
?>






<html>
<head>
<title><?php echo $sitename ?> -- Shopping complete</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#efefef"> 
    <td bgcolor="#FFFFFF"> 
      <?php
if ($basket_items==0)
{
 echo "<br><br><img src='images/emptcart.gif'>";
 echo  "<br><input  name='continue shopping' onClick=\"window.location.href='index.php';\" type=button value=continue shopping>";
 echo "<br>";
}
else
{
?>
      <table width="630" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td> 
            <table cellpadding=0 cellspacing=0 width=630>
              <tbody> 
              <tr> 
                <td align=left width="80%"><b><font class=p14 color=#cc0000>Your order this time:</font></b></td>
              </tr>
              <tr bgcolor=#cc0000> 
                <td height=2 valign=top></td>
              </tr>
              </tbody> 
            </table>
          </td>
        </tr>
        <tr> 
          <td> 
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr> 
                <td bgcolor="#e4e4e4"><font color=#000000 
      size=2>product name</font></td>
                <td width="15%" align="center" bgcolor="#e4e4e4">retail</td>
                <td width="15%" align="center" bgcolor="#e4e4e4"><font color=#000000 
      size=2>membership</font></td>
                <td width="15%" align="center" bgcolor="#e4e4e4"><font color=#000000 
      size=2>quantity</font></td>
                <td width="15%" align="center" bgcolor="#e4e4e4"><font color=#000000 
      size=2>subtotal</font></td>
              </tr>
              <?php
$price_all=0;
$price_sum=0;
$sendtmp="";
for ($basket_counter=0;$basket_counter<$basket_items;$basket_counter++) 
{
//把购物车中的商品的id添加到shopping表中
  $db2->query("insert into $shopping_t          values(null,0,$login_id,$basket_id[$basket_counter],$basket_amount[$basket_counter],'$date_tmp')");

			$amount=$basket_amount[$basket_counter];;
			$db->query("select name,price_m,price from $goods_t where id=$basket_id[$basket_counter]");
            $db->next_record();
			$price_all=$price_all+$db->f('price')*$amount;
			$price_sum=$price_sum+$db->f('price')*$amount;
	   $sendtmp.="<tr >
      <td width=\"60%\"><b>".stripslashes($db->f('name'))."</b></td>
      <td width=\"20%\"><font color=\"red\">".$db->f('price')."</font>元</td>
      <td width=\"20%\">".$basket_amount[$basket_counter]."</td>
    </tr>\n";
?>
              <tr> 
                <td><b> 
                  <?php echo stripslashes($db->f('name')); ?>
                  </b></td>
                <td width="15%" align="center"><font color=#000000 
      size=2><strike>$<?php echo $db->f('price_m'); ?></strike> </font> </td>
                <td width="15%" align="center"><b><font 
      color=#cc0000>$<?php echo $db->f('price'); ?></font></b></td>
                <td width="15%" align="center"> 
                  <?php echo $basket_amount[$basket_counter] ?>
                </td>
                <td width="15%" align="center"> 
                  <?php echo $db->f('price')*$amount; ?>
                </td>
              </tr>
              <?php 
}
$price_all_format=sprintf("%01.2f",$price_all); 
$flag=1;
 for ($basket_counter=0;$basket_counter<$basket_items;$basket_counter++) 
    if ($basket_amount[$basket_counter] >= $jiti_num) 
      {
       $price_all=$price_all*(1-$jiti_rebate);
       $flag=0;
      }

//如果购买同一商品超过指定的个数，则优惠用户所设的优惠值$jiti_rebate
if ($price_all >= 1000 and $flag)  $price_all=$price_all*(1-$rebate);
//单张定单总额超过1000元的折扣

//把用户的订单的送货信息添加到requests表中

$db2->query("insert into $requests_t(id, user_id, name, sex, email, state, city, tel, address, post, fee, date_created, cardnumber, nameoncard, expdate)
           values(null,'$login_id','$name','$sex','$email','$state','$city','$tel',
               '$address','$post','$price_all','$date_tmp','$cardnumber','$nameoncard','$month-$year')");
$key_requests=$db2->insert_id();
//得到此次的订单号

$db->query("select id from $shopping_t where user_id=$login_id and requests_id=0");
 while($db->next_record())
  { 
    $id_shopping=$db->f('id');
    $db2->query("update $shopping_t set requests_id=$key_requests where id=$id_shopping");
  }
//用生成的订单号，更新shopping表中的每条记录

$basket_items=0;
array_splice($basket_amount,0);  //删除购物车的数组的所有元素
array_splice($basket_id,0);
unset($basket_amount);
unset($basket_id);
//当生成订单后，把购物车的内容清空
?>
              <tr> 
                <td colspan="5" width="100%" height="1" background="images/speaking_bg.gif"></td>
              </tr>
              <tr> 
                <td colspan="5">&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp; </td>
                <td>&nbsp; </td>
                <td>&nbsp;</td>
                <td colspan="2"> 
                  <?php echo "total:<b><font color=red>$$price_all_format</font></b>";?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <br>
      <table width="630" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td align="center"><h1>Delivery information</h1></td>
        </tr>
        <tr> 
          <td> 
            <table cellspacing="0" cellpadding="0" width="630">
              <tr> 
                <td align="left" width="80%"><b><font color="#CC0000" class="p14">Congratulations, you order is complete:</font></b></td>
              </tr>
              <tr bgcolor="#CC0000"> 
                <td colspan="4" height="2" valign="top"> </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr align="center"> 
          <td>&nbsp;</td>
        </tr>
        <tr align="center"> 
          <td>This is your confirmation</td>
        </tr>
        <tr> 
          <td> 
            <table cellspacing="0" cellpadding="2" width="100%" border="1" style="font-size:9pt" bordercolorlight="#D2D2D2" bordercolordark="#FFFFFF">
              <tr> 
                <td width="116" bgcolor="f5f5f5">Member name</td>
                <td width="500" bgcolor="f5f5f5"> 
                  <?php echo $login_name; ?>
                </td>
              </tr>

              <tr bgcolor="f5f5f5"> 
                <td width="116">Consignee</td>
                <td width="500"> 
                  <?php echo  $name;  ?>
                </td>
              </tr>
              <tr> 
                <td width="116">State</td>
                <td width="500"> 
                  <?php echo  $state; ?>
                </td>
              </tr>
              <tr bgcolor="f5f5f5"> 
                <td width="116">City</td>
                <td width="500"> 
                  <?php echo  $city; ?>
                </td>
              </tr>
              <tr> 
                <td width="116">Email</td>
                <td width="500"> 
                  <?php echo  $email; ?>
                </td>
              </tr>
              <tr> 
                <td width="116" bgcolor="f5f5f5">Address</td>
                <td width="500" bgcolor="f5f5f5"> 
                  <?php echo  $address; ?>
                </td>
              </tr>
              <tr> 
                <td width="116">Zip code</td>
                <td width="500"> 
                  <?php echo  $post; ?>
                </td>
              </tr>
              <tr> 
                <td width="116" bgcolor="f5f5f5">Phone number</td>
                <td width="500" bgcolor="f5f5f5"> 
                  <?php echo  $tel; ?>
                </td>
              </tr>
              <tr> 
                <td width="116" >oder number</td>
                <td width="500" ><b><font  size="4" color="red"> 
                  <?php echo  $key_requests+$init_num; ?>
                  </font></b> (Please remember this number in order to inquire the info ) </td>
              </tr>
              <tr> 
                <td width="116" bgcolor="f5f5f5" >order time</td>
                <td width="500" bgcolor="f5f5f5" > 
                  <?php echo  $date_tmp; ?>
                </td>
              </tr>
              
              <tr> 
                <td width="116" bgcolor="f5f5f5" >Total money</td>
                <td width="500" bgcolor="f5f5f5" ><font color="red" size="4"> 
                  <?php echo  $price_all; ?>
                  $
                   </td>
              </tr>
              
              
              
              
            </table>
          </td>
        </tr>
        <tr align="center"> 
          <td> 

            <p>&nbsp;
			</p>
            <p>
           
              <input name="continue shopping" onClick="window.location.href='index.php?op=clear';" type=button value="continue shopping">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  name="print this page" onClick="window.print();" type=button value="print this page">
              
            
            </p>
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
