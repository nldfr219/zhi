<?php
require "conf/config.php";
include "admin_check.php";
?>
<html>
<head>
<title><?php echo $sitename ?> -- 新产品批量上传管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/admin.php"; ?>
<?php include "js_setselect.php"; ?>
<table width="750" align="center">
  <tr align="center"> 
    <td bgcolor="#EFEFEF"> 
      <p class="p13"><br>
        商品管理</p>
      <script language="JavaScript">
function check()
{
 if (document.form1.up_id.value == "")
  {
    alert ("请选择商品类别!");
    document.form1.up_id.focus();
    return false;
  }
 if (document.form1.fgf.value == "")
  {
    alert ("请填写各字段间的分隔符!");
    document.form1.fgf.focus();
    return false;
  }
 if (document.form1.upfile.value == "")
  {
    alert ("请您要上传的数据文件!");
    return false;
  }
 return confirm("确定要上传吗?");
 document.form1.Submit.disabled=true;
 document.form1.Submit2.disabled=true;
}
</script>
      <center>
        <?php
if ($usage==1)
{
$fp=fopen($upfile,"r");
while(!feof($fp))
{
$msg=@split($fgf,trim(fgets($fp,4096)));

$name=@addslashes($msg[0]);
$descript=@addslashes($msg[1]);
$price_m=@addslashes($msg[2]);
$price=@addslashes($msg[3]);

$str_sql = "insert into $goods_t
     	           values (null,$up_id,$class_id,'$name','$descript','',
     	           $price_m,$price,$state,'$date')";
$db->query($str_sql);
 }
fclose($fp);
echo '添加商品成功,正在返回商品管理首页<meta http-equiv="refresh" content="2;URL=admin_goods.php?up_id='.$up_id.'&sf='.$class_id.'"><br><br>';
}
else
{
?>
		<form name="form1" method="post" action="" onSubmit="return check();" enctype="multipart/form-data">
          <table width="80%" border="1" cellspacing="0" cellpadding="2" bgcolor="#E1EAF4" align="center" bordercolor="#FFFFFF">
            <tr> 
              <td colspan="2" height="35" align="center"> <font color="#FF0000">*</font> 
                表示为必填项 </td>
            </tr>
            <tr> 
              <td width="16%" align="right">商品类别：</td>
              <td width="84%"><font color="#FF0000"> 
                <select name="up_id" onchange="sele(this.selectedIndex);">
                  <option selected>请选择类别</option>
                  <?php
          $db->query("select id,name from $class_t where up_id=0");
          while($db->next_record())
                 echo "<option value=".$db->f('id').">&nbsp;".$db->f('name')."</option>\n";
       ?>
                </select>
                * 　　子类类别： 
                <select name="class_id">
                </select>
                <script language="JavaScript">
 
<?php
$db->query("select id from $class_t where up_id=0");
$n=0;
while($db->next_record())
{
   $db2->query("select id,name from $class_t where up_id=".$db->f('id'));
   echo "\n\nA".$n."=new Array(".$db2->num_rows().");";
   $m=0;
   while($db2->next_record())
	{
	  echo "\nA".$n."[".$db2->f('id')."]='".$db2->f('name')."';";
      $m++;
    }
  $n++;
}
?>

function sele(s)
{
		if(s!=0)
		{
			document.form1.class_id.options.length=0;
			A=eval("A"+(s-1));
			i=0;
			for(name in A) //访问该数组中的所有元素，name为下标，
			{
				document.form1.class_id.options.length++;
				document.form1.class_id.options[i].text=A[name];			
				document.form1.class_id.options[i].value=name;
				i++;
			}
			document.form1.class_id.selectedIndex=0;
		}
		else
		{
			document.form1.class_id.options.length=0;
		}
}

</script>
                </font></td>
            </tr>
            <tr> 
              <td colspan="2">　　　各字段间的分隔符符： 
                <input type="text" name="fgf" size="4" value=";" maxlength="6">
                <font color="#FF0000">*</font></td>
            </tr>
            <tr> 
              <td width="16%" align="right" height="37">每行的格式为：</td>
              <td width="84%" height="37">名称;介绍;市场价;会员价</td>
            </tr>
            <tr> 
              <td width="16%" align="right">上传文件：</td>
              <td width="84%"> 
                <input type="file" name="upfile" maxlength="40">
                <font color="#FF0000">*</font> </td>
            </tr>
            <tr> 
              <td width="16%" align="right">商品状态：</td>
              <td width="84%"> 
                <input type="radio" name="state" value="0" checked>
                有货　 
                <input type="radio" name="state" value="1">
                缺货 </td>
            </tr>
            <tr> 
              <td width="16%" align="right">发布日期：</td>
              <td width="84%"> 
                <input type="text" name="date" value="<?php echo date("Y-m-d H:i:s"); ?>" maxlength="19" size="21">
              </td>
            </tr>
            <tr> 
              <td colspan="2" align="center"> 
                <input type="hidden" name="usage" value="1">
                <input type="submit" name="Submit" value="提 交" class="stbtm2">
                　 
                <input type="reset" name="Submit2" value="重 填" class="stbtm2">
              </td>
            </tr>
          </table>
        </form>
        <?php } ?>
   </center>
</td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
