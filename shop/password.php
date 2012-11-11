<?php
require "conf/config.php";

?>
<html>
<head>
<title><?php echo $sitename ?> -- Get back the password</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#efefef"> 
    <td> 
      <p>&nbsp; </p>
      <p> 
        <?php
if (isset($u_name))
{
$db->query("select u_pass,email from $user_t where u_name='$u_name'");
$db->next_record();
if ($db->num_rows())
{
$password=$db->f('u_pass');
$to=$db->f('email');
$date=date('Y-m-d H:i:s');

$body="Dear $u_name ，hello：<br>

  below is the username and password you registered at  $sitename($siteurl):<br>
     
  username：$u_name <br>

  password: $password <br>

  Please modify your password as soon as possible。<br>
                    
  $date
"; 






require("class.phpmailer.php"); //下载的文件必须放在该文件所在目录
$mail = new PHPMailer(); //建立邮件发送类

$mail->IsSMTP(); // 使用SMTP方式发送
$mail->Host = "smtp.gmail.com"; // 您的企业邮局域名
$mail->SMTPAuth = true; // 启用SMTP验证功能
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->Username = "nldfr219@gmail.com"; // 邮局用户名(请填写完整的email地址)
$mail->Password = "137082127z"; // 邮局密码

$mail->From = "nldfr219@gmail.com"; //邮件发送者email地址
$mail->FromName = "Admin";
$mail->AddAddress($to);//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
//$mail->AddReplyTo("", "");

//$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
//$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式

$mail->Subject = "Zhi Ma's Online Shop -- Your password"; //邮件标题
$mail->Body = $body; //邮件内容
$mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //附加信息，可以省略

if(!$mail->Send())
{
	echo "Fail to send the email.";
	
	
}
else
echo "The password has been successfully sent to your email address.";











}
else
echo "Sorry, the username does not exist.";
echo "<br><br>";
echo "<input type=\"button\" value=\"return\" onClick=\"JavaScript:window.location.href='index.php'\" class=\"stbtm\"  name=\"button3\">";
}
else
{
?>
        <script language=javascript>
function chk()
{
if(document.form10.u_name.value=="")
{
   window.alert("Please enter the username!");
   document.form10.u_name.focus();
   return false; 
}
}   
</script>
      </p>
      <form name="form10" method="post" onSubmit="return chk();">
        <p>Please enter your username, we will send the password to your email address.</p>
        <p> 
          <input type="text" name="u_name"  class=think>
          <input type="submit" name="Submit" value="submit"  class="stbtm">
        </p>
      </form>
      <?php } ?>
      <p>&nbsp;</p>
      <p>&nbsp; </p>
      <p>&nbsp;</p></td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
