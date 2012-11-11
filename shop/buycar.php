<?php
require "conf/config.php";

if(isset($op)){
switch($op)
{
case "add":
//把商品的id加入购物车
if ($id!="")
    {
         if (session_is_registered("basket_items"))  
              require("addto_basket.inc"); 
         else  
              require("new_basket.inc") ;
	}
	 break;
case "del":
     require("del_basket.inc");
     header("Location:buycar.php");
	 break;
case "clear":
     $_SESSION['basket_items']=0;
     array_splice($_SESSION['basket_amount'],0);  //删除购物车的数组的所有元素
     array_splice($_SESSION['basket_id'],0);
     unset($_SESSION['basket_amount']);
     unset($_SESSION['basket_id']);
     header("Location:buycar.php");
     break;
case "update":
  for ($basket_counter=0;$basket_counter<$basket_items;$basket_counter++) 
  {
       $_SESSION['basket_amount'][$basket_counter]=$num[$basket_counter];
       header("Location:buycar.php");
  }
  break;
}
}
if(isset($op2)){
switch($op2)
{
case "add":

$f=1;  //确定该商品的id是否存在收藏夹中
$scsp=split("&&",$scj);
for($j=0;$j<count($scsp);$j++)
   if ($scsp[$j]==$prod) $f=0;
if ($f) //表示商品的id不存在收藏夹中,则添加到收藏夹中
  if ($scj)
     setcookie("scj",$scj."&&".$prod,time()+60*60*24*365); //设置cookie的有效时间为一年
  else
     setcookie("scj",$prod,time()+60*60*24*365); //设置cookie的有效时间为一年
	 break;
case "del":

$scsp=split("&&",$scj);
for($j=0;$j<count($scsp);$j++)
         {
          if ($scsp[$j]!=$prod) $new_scsp[]=$scsp[$j];
     	 } 
if (is_array($new_scsp))
    $tmp=@implode("&&",$new_scsp);
else
	$tmp="";
setcookie("scj",$tmp,time()+60*60*24*365); //设置cookie的有效时间为一年
     break;
}
//if ($op2) header("Location: buycar.php");
//if ($op2) echo '<meta http-equiv="refresh" content="0;URL=buycar.php">';
if ($op2) echo '<script language="javascript"> location.href="buycar.php";</script>';
}?>
<html>
<head>
<title><?php echo $sitename ?> -- Cart</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="630" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr align="center"> 
          <td> 
            <p>&nbsp;</p>
            <p><h1>My shopping cart</h1>
              <script language=javascript>
function PutInStore(a,prod)
{
	document.frmbuy.action = 'buycar.php?op=del&counter='+a+'&op2=add&prod='+prod;
	document.frmbuy.submit();
}	

function DelProduct(a)
{
	document.frmbuy.action = 'buycar.php?op=del&counter='+a;
	document.frmbuy.submit();
}

function ClearCart()
{
	if(confirm('Are you sure to clear out all the products?'))	
	{
		document.frmbuy.action = 'buycar.php?op=clear';
		document.frmbuy.submit();
	}
}

function ChangeN()
{
	if(confirm('Are you sure to update the quantity of the products?'))	
	{
	    document.frmbuy.action="buycar.php?op=update";
	    document.frmbuy.submit();
	}
}

function buy2(prod){
	document.form2.action='buycar.php?op2=del&prod='+prod;
	document.form2.submit();
}

function buy22(prod){
	document.form2.action='buycar.php?op2=del&prod='+prod+'&op=add&id='+prod;
	document.form2.submit();
}
</script>
            </p>
          </td>
        </tr>
        <tr> 
          <td> 
            <table border=0 cellpadding=0 cellspacing=0 width=630>
              <tbody> 
              <tr> 
                <th bgcolor=#ffffff height=22 valign=top width="3%">&nbsp;</th>
                <td bgcolor=#ffffff colspan=3 height=22><b><font class=p14 color=#cc0000>Cart 
                </font></b></td>
              </tr>
              <tr bgcolor=#cc0000> 
                <td colspan=4 height=2 valign=top></td>
              </tr>
              </tbody> 
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr> 
    <td height="2">       
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
         <form name="frmbuy" method="post">
		 <tr bgcolor="#e4e4e4"> 
            <td width="40%" align="center">product name</td>
            <td width="8%" align="center">retail</td>
            <td width="8%" align="center">membership</td>
            <td width="8%" align="center">quantity</td>
            <td width="8%" align="center">subtotal</td>
            <td width="8%" align="center">operations</td>
          </tr>
          <?php
$price_all=0;
if(!isset($basket_items))
	$basket_items=0;
for ($basket_counter=0;$basket_counter<$basket_items;$basket_counter++) 
{
            $amount=$basket_amount[$basket_counter];;
			$db->query("select name,price_m,price from $goods_t where id=$basket_id[$basket_counter]");
            $db->next_record();
			$price_all=$price_all+$db->f('price')*$amount;
?>
          <tr> 
            <td width="40%"><b> 
              <?php echo stripslashes($db->f('name')); ?>
              </b></td>
            <td width="8%"><FONT color=#000000 
      size=2><STRIKE>$<?php echo $db->f('price_m'); ?></STRIKE> </FONT> </td>
            <td width="8%"><B><FONT 
      color=#cc0000>$<?php echo $db->f('price'); ?></FONT></B></td>
            <td width="8%"> 
              <input maxlength=4 name="num[]" 
      onChange=" if(isNaN(this.value) || this.value>1000 ||this.value.indexOf('.') >= 0 || this.value.indexOf('-') >= 0) {alert('Please enter a positive number which is less than 1000！');this.focus();return false;}else{return true;}" 
      size=3 value="<?php echo $basket_amount[$basket_counter] ?>">
            </td>
            <td width="8%"> 
              <?php echo $db->f('price')*$amount; ?>
            </td>
            <td width="8%"> 
              <input class=stbtm name=del onClick=" if (confirm('Are you sure to cancel?')) DelProduct('<?php echo $basket_counter ?>');" type=button value=cancel>
              
            </td>
          </tr>
          <?php 
}
$price_all_format=sprintf("%01.2f",$price_all); 
?>
          <tr> 
            <td width="40%">&nbsp;</td>
            <td width="8%">&nbsp;</td>
            <td width="8%">&nbsp;</td>
            <td width="8%">&nbsp;</td>
            <td colspan="2"> total:<b><font color=red>$<?php echo $price_all_format ?>
              </font></b> </td>
          </tr>
          <tr> 
            <td colspan="6" height="1" background="images/speaking_bg.gif"></td>
          </tr>
          <tr> 
            <td colspan="6"> <br>
              <table width="100%" border="0">
                <tr> 
                  <td>If you<font 
      color=#cc0000> has changed the quantity</font>,please click 
                    <input class=stbtm name=update onClick="ChangeN();return false;" type=button value="update"  <?php if ($basket_items==0) echo "disabled"; ?>>
                  </td>
                  <td> 
                    <input  name=continueshopping onClick="window.location.href='index.php';" type=button value="continue shopping">
                  </td>
                  <td> 
                    <input  name=abandonshopping onClick=" ClearCart();return false;" type=submit value="abandon shopping" <?php if ($basket_items==0) echo "disabled"; ?>>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
		  </form>
        </table>   
    </td>
  </tr>
  
  <tr align="center"> 
    <td> 
      <input class=stbtm2 name=bank onClick="window.location.href='bank.php';" type=button value="check out" <?php if ($basket_items==0) echo "disabled"; ?>>
    </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
</table>

<br>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
