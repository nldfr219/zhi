<?php
require "conf/config.php";
include "admin_check.php";
if ($f=="y")
{
 $tmp="账号激活";
 $tmp2="您的账号已经开通，您可以使用您的账号进行操作。";
 }
else
{
 $tmp="账号失效";
 $tmp2="您的账号已经暂时被管理员停用。若想开通账号，请与管理员联系。";
 }
?>
<html>
<head>
<title><?php echo $sitename ?> -- 会员账号操作</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0">
<center>
<?php
if ($action=="active")
{
$db->query("update $user_t set action='$f' where id=$id"); //更改用户的账号状态

//给用户发一封邮件通知
$headers="From:$siteemail";
@mail($email,$sitename."--".$tmp."通知", $body,$headers); 
echo '<BR><BR>  <p class="p13">会员账号状态操作成功。</p>';
echo '<input type="button" name="Submit22" value="关闭窗口" onClick="self.close();" class="stbtm2">';
}
else
{
$db->query("select u_name,u_pass,email from $user_t where id=$id");
$db->next_record();
?>
<form name="form1" method="post" action="">
    <table width="100%" border="1" cellspacing="0" cellpadding="1" bordercolor="#CCCCCC">
      <tr> 
        <td width="12%">&nbsp;</td>
        <td class="p13" align="center" width="88%">会员账号操作--<?php echo$tmp ?></td>
      </tr>
      <tr> 
        <td width="12%" align="right">账号:</td>
        <td width="88%"> 
          <?php echo $db->f('u_name') ?>
        </td>
      </tr>
      <tr> 
        <td valign="top" width="12%" align="right"><br>
          理由:</td>
        <td width="88%"> 
          <textarea name="body" cols="44" rows="10">尊敬的用户:
    
     您好!

     您的用户名:<?php echo $db->f('u_name') ?>   密码:<?php echo $db->f('u_pass') ?>

     <?php echo $tmp2 ?> 


           <?php echo "$sitename($siteurl)"; ?>
			   
               email：<?php echo $siteemail; ?>
			   
			   
                           <?php echo date("Y年m月d日"); ?>
						   </textarea>
        </td>
      </tr>
      <tr> 
        <td width="12%" align="right">选择:</td>
        <td width="88%">&nbsp;</td>
      </tr>
      <tr> 
        <td width="12%" align="right">选择:</td>
        <td width="88%">1、30日内未发生任何交易，我们将暂时锁定您的会员资格，如需恢复请与管理员申告 <br>
          2、您将会员资格转与他人用， 为保证其他会员的利益，我们将暂时锁定您的会员资格，如需恢复请与管理员申告<br>
          3、您20日未登陆本站，我们将暂时锁定您的会员资格，如需恢复请与管理员申告</td>
      </tr>
    </table>
    <br>
    <input type="hidden" name="email" value="<?php echo $db->f('email') ?>">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="hidden" name="f" value="<?php echo $f ?>">
    <input type="hidden" name="action" value="active">
    <input type="submit" name="Submit" value="确 定" class="stbtm2">
    　　 
    <input type="button" name="Submit2" value="关 闭" onclick="self.close();" class="stbtm2">
</form>
  <?php } ?>
</center>
</body>
</html>
