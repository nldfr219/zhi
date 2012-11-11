<?php
require "conf/config.php";
?>
<html>
<head>
<title><?php echo $sitename ?> -- Cart</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="conf/style.css">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?php
$tmp="";
if (isset($basket_items))
{
    $price_all=0;  
	
    if ($basket_items<=5)
	{
		echo "<center>You have chosen <font color=red>$basket_items</font> products</center>";
		for($n=$basket_items;$n<5;$n++)
			$tmp.="&nbsp;<BR>";
	}
    else 
      echo "<center>total<font color=red>$basket_items</font>kinds of products,previous<font color=red>5</font> listed below:<br></center>";
    $h=($basket_items<5) ? $basket_items : 5;
	for ($basket_counter=0;$basket_counter<$h;$basket_counter++){
            $amount=$basket_amount[$basket_counter];
            $db->query("select name,price from $goods_t where id=$basket_id[$basket_counter]");
            $db->next_record();
			$name=stripslashes($db->f('name'));            
			if (strlen($name)>16) $name=substr_2($name,16).'...';
            $price_all=$price_all+$db->f('price')*$amount;
            $delete_it="<A href=\"goods_list.php?id=$basket_id[$basket_counter]\" class='clink03'  target='_blank'>$name</A>";
        echo "&nbsp;&nbsp;<b><font color=red>$amount</font></b>&nbsp&nbsp&nbsp";
        echo $delete_it;
        echo "<BR> ";
    }    
	//统计出购物车中未显示出来的产品的价格总和
	for ($basket_counter=$h;$basket_counter<$basket_items;$basket_counter++)
    {
            $amount=$basket_amount[$basket_counter];
			$db->query("select name,price from $goods_t where id=$basket_id[$basket_counter]");
            $db->next_record();		
		    $price_all=$price_all+$db->f('price')*$amount;
	}
   $price_all_format=sprintf("%01.2f",$price_all); 
   echo "<center>total:<b><font color=red>$$price_all_format</font></b><br>";
   echo "<a href='bank.php' target='_blank'><font color='#cc0000'>check out</font></a>";
   echo " | <a href='buycar.php' target='_blank'><font color='#cc0000'>adjust products</font></a></center>";
} 
else {
	
    $basket_items=0;
    unset($basket_amount);
    unset($basket_id);
echo "<center><br><br>Your cart is currently empty<br><br><br></center>";
}
echo $tmp;
?>
<TABLE align=center border=0 cellPadding=0 cellSpacing=0 width="180">
   <TR>
    <TD bgColor=#ffcc00 colSpan=2 height=1></TD></TR>
  <TR>
    <TD align=middle bgColor=#ffffd2 colSpan=2 height=20>
<?php
$n=(!isset($scj))?0:count(split("&&",$scj));
if ($n)
  echo "<a href='buystore.php' target='_blank'>Your favorite folder has".$n."products&gt;&gt; </a>";
else
  echo "Your favorite folder has 0 product&gt;&gt; ";
?>
    </TD></TR></TABLE>
</body>
</html>