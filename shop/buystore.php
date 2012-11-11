<?php
require "conf/config.php";
session_start();

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
	 break;
case "clear":
     $basket_items=0;
     array_splice($basket_amount,0);  //删除购物车的数组的所有元素
     array_splice($basket_id,0);
     unset($basket_amount);
     unset($basket_id);
     break;
case "update":
  for ($basket_counter=0;$basket_counter<$basket_items;$basket_counter++) 
  {
       $basket_amount[$basket_counter]=$num[$basket_counter];
  }
  break;
}

switch($op2)
{
case "add":

$f=1;  //确定该商品的id是否存在收藏夹中
$scsp=split("&&",$scj);
for($j=0;$j<count($scsp);$j++)
   if ($scsp[$j]==$prod) $f=0;
if ($f) //表示商品的id不存在收藏夹中，则添加到收藏夹中
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
if ($op2) echo '<script language="javascript"> location.href="buystore.php";</script>';
?>
<html>
<head>
<title><?php echo $sitename ?> -- 收藏夹</title>
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
            <p><img src="images/new_my_scj.gif" width="183" height="30"> 
              <script language=javascript>
function PutInStore(a,prod)
{
	document.frmbuy.action = 'buystore.php?op=del&counter='+a+'&op2=add&prod='+prod;
	document.frmbuy.submit();
}	

function DelProduct(a)
{
	document.frmbuy.action = 'buystore.php?op=del&counter='+a;
	document.frmbuy.submit();
}

function ClearCart()
{
	if(confirm('真的要清空购物车的所有商品吗？'))	
	{
		document.frmbuy.action = 'buystore.php?op=clear';
		document.frmbuy.submit();
	}
}

function ChangeN()
{
	if(confirm('确定要更新商品的数量吗？'))	
	{
	    document.frmbuy.action="buystore.php?op=update";
	    document.frmbuy.submit();
	}
}

function buy2(prod){
	document.form2.action='buystore.php?op2=del&prod='+prod;
	document.form2.submit();
}

function buy22(prod){
	document.form2.action='buystore.php?op2=del&prod='+prod+'&op=add&id='+prod;
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
                <td bgcolor=#ffffff colspan=3 height=22><b><font class=p14 color=#cc0000>收 
                  藏 夹</font></b></td>
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
      <table border=0 cellpadding=2 cellspacing=1 width=630>
      <form action="" method=post name="form2">
        <tr> 
          <td align=middle bgcolor=#e4e4e4 height=20 width="50%">商品名称</td>
          <td align=middle bgcolor=#e4e4e4 height=20 width="10%">零售价</td>
          <td align=middle bgcolor=#e4e4e4 height=20 width="10%">会员价</td>
          <td align=middle bgcolor=#e4e4e4 height=20 width="30%">操作</td>
        </tr>
        <?php
$scsp=split("&&",$scj);
$m=($scj=="")?0:count($scsp);
for($j=0;$j<$m;$j++)
{
			$prod=$scsp[$j];
			$db->query("select name,price_m,price from $goods_t where id=$prod");
            $db->next_record();
?>
        <tr> 
          <td align=left height=20 width="50%"><b> 
            <?php echo stripslashes($db->f('name')); ?>
            </b></td>
          <td width="8%"><font color=#000000 
      size=2><strike>￥<?php echo $db->f('price_m'); ?></strike> </font> </td>
          <td width="8%"><b><font 
      color=#cc0000>￥ <?php echo $db->f('price'); ?></font></b></td>
          <td align=middle height=20 width="10%"> 
            <input class=stbtm name=清除 onClick="buy2('<?php echo $prod ?>');return false;" type=button value=清除>
            <input class=stbtm1 name=放入购物车 onClick="buy22('<?php echo $prod ?>');return false;" type=button value=放入购物车>
          </td>
        </tr>
        <?php } ?>
        <tr valign=bottom> 
          <td background=images/speaking_bg.gif colspan=4 height=1 
    width="100%"></td>
        </tr>
        </form> 
      </table>
    </td>
  </tr>
  <tr align="center"> 
    <td>&nbsp; </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
</table>
<div align=center>
 
    <table align=center border=0 cellpadding=0 cellspacing=0 width=630>
      <tbody> 
      <tr> 
        <td bgcolor=#cc0000 height=22 valign=top width="3%">&nbsp;</td>
        
      <td bgcolor=#cc0000 height=22 width="87%"> <b><font color=#ffffff>您的购物车里面有"<?php echo intval($basket_items) ?>"种产品</font></b> </td>
      <td bgcolor=#ffc40f class=pad03 height=22 valign=bottom width="87%" align="center"> 
        <img alt=展开购物车 border=0 class=pad03 height=19 
      onClick="JavaScript:tmpstore.style.display=''" 
      src="images/cart_dot03.gif" style="CURSOR: hand" width=19> <img 
      alt=隐藏购物车 border=0 class=pad03 height=19 
      onClick="JavaScript:tmpstore.style.display='none'" 
      src="images/cart_04.gif" style="CURSOR: hand" width=19></td>
        <td bgcolor=#ffc40f height=22 valign=top width="10%">&nbsp; 
         
        </td>
      </tr>
      </tbody>
    </table>    
  <div id=tmpstore name="tmpstore"> 
    <table width="630" border="0" cellspacing="1" cellpadding="0">
        <form action="" method=post name="frmbuy">
		<tr bgcolor="#e4e4e4">		 
          <td width="40%" align="center">商品名称</td>
          <td width="8%" align="center">零售价</td>
          <td width="8%" align="center">会员价</td>
          <td width="8%" align="center">数量</td>
          <td width="8%" align="center">小计</td>
          <td width="28%" align="center">操作</td>
        </tr>
        <?php
$price_all=0;
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
          <td width="8%"><font color=#000000 
      size=2><strike>￥<?php echo $db->f('price_m'); ?></strike> </font> </td>
          <td width="8%"><b><font 
      color=#cc0000>￥<?php echo $db->f('price'); ?></font></b></td>
          <td width="8%"> 
            <input maxlength=4 name="num[]" 
      onChange=" if(isNaN(this.value) || this.value>1000 ||this.value.indexOf('.') >= 0 || this.value.indexOf('-') >= 0) {alert('请输入小于1000的正整数！');this.focus();return false;}else{return true;}" 
      size=3 value="<?php echo $basket_amount[$basket_counter] ?>">
          </td>
          <td width="8%"> 
            <?php echo $db->f('price')*$amount; ?>
          </td>
          <td width="28%"> 
            <input class=stbtm name=del onClick=" if (confirm('确实要取消吗？')) DelProduct('<?php echo $basket_counter ?>');" type=button value=取消>
            <input class=stbtm1 name=puttocar onClick="PutInStore('<?php echo $basket_counter ?>','<?php echo $basket_id[$basket_counter] ?>')" type=button value=放入收藏夹>
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
          <td colspan="2"> 合计：<b><font color=red>￥
            <?php echo $price_all_format ?>
            </font></b> </td>
        </tr>
        <tr> 
          <td colspan="6" height="1" background="images/speaking_bg.gif"></td>
        </tr>
        <tr> 
          <td colspan="6"> <br>
            <table width="100%" border="0">
              <tr> 
                <td>如果您<font 
      color=#cc0000>更改了数量</font>，请点击 
                  <input class=stbtm name=更新 onClick="ChangeN();return false;" type=button value="更新数量"  <?php if ($basket_items==0) echo "disabled"; ?>>
                </td>
                <td> 
                  <input class=stbtm name=继续购买 onClick="window.location.href='index.php';" type=button value=继续购买>
                </td>
                <td> 
                  <input class=stbtm name=放弃购买 onClick=" ClearCart();return false;" type=submit value="放弃购买" <?php if ($basket_items==0) echo "disabled"; ?>>
                </td>
              </tr>
            </table>
          </td>
        </tr>
		</form>
      </table>
      <input class=stbtm2 name=bank onClick="window.location.href='bank.php';" type=button value=去收银台 <?php if ($basket_items==0) echo "disabled"; ?>>
    </div>
</div>
<br>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
