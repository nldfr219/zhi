<?php
require "conf/config.php";
?>
<html>
<head>
<title><?php echo $sitename ?> -- 需求登记</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0">
<script language="JavaScript">
function validateinfo()
{

 if(document.stockout.productname2.value.length==0)
 {
    alert('请输入商品类别、品牌！');
    document.stockout.productname2.focus();
    return false;
 
 }

 if(document.stockout.productname.value.length==0)
 {
    alert('请输入商品名称！');
    document.stockout.productname.focus();
    return false;
 
 } 

if(document.stockout.productnum.value)
 if(isNaN(document.stockout.productnum.value) || document.stockout.productnum.value<=0)
 {
    alert('请正确输入商品数量！');
    document.stockout.productnum.focus();
    return false;
 
 } 
 if(document.stockout.productprice.value)
 if(isNaN(document.stockout.productprice.value) || document.stockout.productprice.value<=0)
 {
    alert('请正确输入商品的价格！');
    document.stockout.productprice.focus();
    return false;
 
 } 
 
 var email; 
 
 
 email=document.stockout.useremail.value;
 if(email==='')
  {
    alert('请输入您的电子邮件地址！');
    document.stockout.useremail.focus();
    return false;
  }

  var regu = "^(([0-9a-zA-Z]+)|([0-9a-zA-Z]+[_.0-9a-zA-Z-]*[0-9a-zA-Z]+))@([a-zA-Z0-9-]+[.])+([a-zA-Z]{2}|net|NET|com|COM|gov|GOV|mil|MIL|org|ORG|edu|EDU|int|INT)$"
  var re = new RegExp(regu);

  if (email.search(re)===-1)
  {
     alert ("请输入有效合法的E-mail地址 ！")
     document.stockout.useremail.focus();
     return false;
  }
 
}

</script>
<center>
<?php
if ($productname)
{
//给管理员发一封邮件通知
$headers="From:$useremail";
$body="以下是用户发布的产品信息：

商品类别、品牌: $productname2

商品名称: $productname

功能描述: $description

商品数量: $productnum

商品价格: $productprice


                     发布用户E-mail:$useremail
					 
			   
                	 发布时间: $date_tmp";
@mail($siteemail,$sitename."--用户发布产品".$f."通知", $body,$headers); 

echo '<BR><BR>  <p class="p13">产品发布成功，您发布的信息已经发到管理员的邮箱里。</p>';
echo '<input type="button" name="Submit22" value="关闭窗口" onClick="self.close();" class="stbtm2">';
}
else
{
if ($f==1)
 $tmp="求购";
else
 $tmp="出售";
?>
<table width="500" border="0" cellspacing="0" align="center">
  <tr> 
    <td colspan="2" height="1" bgcolor="#000000"></td>
  </tr>
  <tr> 
    <td height="1" colspan="2" bgcolor="#FFFF00"></td>
  </tr>
  <tr bgcolor="#E4E4E4"> 
    <td colspan="2" bgcolor="#FFFFD2"> <br>
      <form name="stockout" method="post" action="" onSubmit="return validateinfo()">
        <table width="98%" border="0" cellspacing="0" align="center">
          <tr> 
            <td colspan="2"> 
              <div align="left"><font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;<font color="#003300">如果您想在 
                <?php echo $sitename ?>
                发布<?php echo $tmp ?>产品，请填写以下信息，信息将发到管理员的邮箱里</font>。<font color="#CC0000"><br>
                </font><br>
                </font></div>
            </td>
          </tr>
          <tr > 
            <td colspan="2" height=1 background="images/speaking_bg.gif"></td>
          </tr>
          <tr> 
            <td width="22%" valign="bottom"> 
              <div align="right"><b>商品类别、品牌:</b></div>
            </td>
            <td width="78%" height="35" valign="bottom"> 
              <input type="text" name="productname2" size="20" class=think maxlength="40">
              　<font color="red">*</font> </td>
          </tr>
          <tr> 
            <td width="22%" valign="bottom"> 
              <div align="right"><b>商品名称:</b></div>
            </td>
            <td width="78%" height="30" valign="middle"> &nbsp; 
              <div align="left"> 
                <input type="text" name="productname" size="30" class=think maxlength="40">
                　<font color="red">*</font> </div>
            </td>
          </tr>
          <tr> 
            <td colspan="2" valign="bottom"> 
              <div align="right"><font color="#003300"><br>
                &nbsp;&nbsp;&nbsp;&nbsp;<b>功能描述</b><b>:</b>（如果您不知道产品名称，可以将所需要产品的功能进行简单的描述）</font></div>
            </td>
          </tr>
          <tr> 
            <td width="22%"> 
              <div align="right"></div>
            </td>
            <td width="78%" height="20"> &nbsp; 
              <div align="left"> 
                <textarea name="description" cols="45" rows="5" class="think"></textarea>
              </div>
            </td>
          </tr>
          <tr> 
            <td width="22%" height="30" valign="middle" align="right"><b>商品数量:</b></td>
            <td width="78%" height="50"><b> 
              <input type="text" name="productnum" size="10" class=think maxlength="14">
              商品价格: 
              <input type="text" name="productprice" size="14" class=think maxlength="20">
              (单位:元)</b></td>
          </tr>
          <tr> 
            <td width="22%" height="30" valign="middle"> 
              <div align="right"><b>E-mail:</b> </div>
            </td>
            <td width="78%" height="50"> 
              <div align="left"><b> 
                <input type="text" name="useremail" size="30" class=think maxlength="40">
                </b>　<font color="red">*</font> </div>
            </td>
          </tr>
          <tr> 
            <td colspan="2" height="10">　　　　请注意*栏目为必填项</td>
          </tr>
          <tr> 
            <td height="50" colspan="2"> 
              <div align="center">
                  <input type="hidden" name="f" value="<?php echo $tmp ?>">
                  <input class=stbtm name=ok!2 type=submit value=提交 >
                <input class=stbtm name=ok!22 type=reset value=重填 >
                <br>
              </div>
          </tr>
        </table>
      </form>
    </td>
  </tr>
  <tr bgcolor="#666666"> 
    <td colspan="2" height=2> 
  </tr>
</table>
<?php } ?>
</center>
</body>
</html>
