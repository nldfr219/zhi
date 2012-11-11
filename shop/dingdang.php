<?php
require "conf/config.php";
include "chk.php";
if (isset($action)&&$action=="del")
{
	$id=$id-$init_num;
	//删除用户订单表的订单
	$db->query("delete from $requests_t
			where id=$id and user_id=$login_id and UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(date_created)<$del_delay");
	//删除用户shopping表的商品id
	$db->query("delete from $shopping_t
			where requests_id=$id and user_id=$login_id and UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(date_created)<$del_delay");
}
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
	<table width="750" border="0" align="center" cellspacing="0"
		cellpadding="0">
		<tr align="center" bgcolor="#efefef">
			<td><?php
			$db->query("select sex from $user_t where id=$login_id");
			$db->next_record();
			$title=$login_name;
			if ($db->f('sex')==1)
				$title.="";
			else if ($db->f('age')<30)
				$title.="";
			else
				$title.="";

			if (!isset($page)) $page=1;
			$db->query("select null from $requests_t where user_id=$login_id"); //从订单表中查出用户的订单
			$total_num=$db->num_rows();//得到总记录数
			$totalpage=ceil($total_num/$num_to_show);//得到总页数
			$init_record=($page-1)*$num_to_show;
			$db->query("select *,UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(date_created) as mytime from $requests_t where user_id=$login_id
     order by id DESC limit $init_record, $num_to_show");
 ?> <br>
				<table width="96%" border="0" cellspacing="0" bgcolor="#ffffff">
					<tr>
						<td height="17"><b><font color="#cc0000"> <?php echo $title; ?>'s
									orders
							</font>&nbsp;&nbsp; <?php if (!$total_num) echo "You don't have orders currently!";?>
						</b></td>
					</tr>
				</table> <br>
				<table width="99%" border="0" cellspacing="0" align="center">
					<tr>
						<td>
							<div width="20">
								<b>Order list:</b>
							</div>
						</td>
					</tr>
				</table>
				<table width="96%" border="0" cellspacing="1" cellpadding="1">
					<form action="<?php echo $PHP_SELF."?key=$key" ?> " method="post"
						name="form8" onSubmit="return check_page('form8.page')">
						<tr>
							<td align="right">total: <?php echo $total_num." orders ";
							$page1=$page-1;
							$page2=$page+1;
							if ($page1 < 1) echo "<FONT color=#999999>first&nbsp;previous</FONT>&nbsp;";
							else echo "<a href='$PHP_SELF?page=1&key=$key'>first</a>&nbsp;<a href='$PHP_SELF?page=$page1&key=$key'>previous</a>&nbsp;";
							if ($page2 > $totalpage) echo "<FONT color=#999999>next&nbsp;last</FONT>&nbsp;";
							else echo "<a href='$PHP_SELF?page=$page2&key=$key'>next</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&key=$key'>last</a>&nbsp;";
							?> current:<b> <?php echo $page."/".$totalpage ?>
							</b>&nbsp; <script language="JavaScript">
function check_page(name)
{
 eval("page="+name+".value");
 if (isNaN(page) || page <=0 || page > <?php echo $totalpage ?>)
  {
    alert ("请正确输入页数，最大值为 <?php echo $totalpage ?> ！");
    eval(name+".select()");
	return false;
  }
}
</script>

							</td>
						</tr>
					</form>
				</table>
				<table width="98%" border="1" cellspacing="0" align=center>
					<tr>
						<td align=center><font color="#cc0000">Oder ID</font></td>
						<td align=center><font color="#cc0000">Payment details</font></td>
						<td align=center><font color="#cc0000">Order time</font></td>
						<td align=center><font color="#cc0000">Order status</font></td>

						<td align=center><font color="#cc0000">Fee</font></td>

						<td align=center><font color="#cc0000">Operations</font></td>
					</tr>
					<?php
					while($db->next_record())
					{
						?>
					<tr>
						<td align=center><?php echo $db->f('id')+$init_num; ?>
						</td>
						<td align=center><?php
						echo $db->f('nameoncard')." ".$db->f('cardnumber')." ".$db->f('expdate');
						?>
						</td>
						<td align=center><?php echo $db->f('date_created'); ?>
						</td>
						<td align=center><?php
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
									

						}
						?></td>

						<td align=center><?php echo $db->f('fee'); ?>$</td>
						
						<td align=center><input type="button" name="Button" value="view"
							class="think"
							<?php echo "onclick=\"javaScript:window.open('dingdang_disp.php?id=".($db->f('id')+$init_num)."')\"" ?>>
							<input type="button" name="Button2" value="delete" class="think"
							<?php echo "onclick=\"javaScript:if (confirm('Are you sure to delete?')) window.location.href='$PHP_SELF?action=del&id=".($db->f('id')+$init_num)."'\""; if ($db->f('mytime')>$del_delay) echo "disabled"; ?>>
						</td>
					</tr>
					<?php } ?>
				</table>
			</td>
		</tr>
	</table>
	<br>
	<?php include "conf/footer.php"; ?>
</body>
</html>
