<?php
require "conf/config.php";
include "admin_check.php";
?>
<html>
<head>
<title><?php echo $sitename ?> -- Mail List</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/admin.php"; ?>
<table width="750" align="center">
  <tr align="center"> 
    <td bgcolor="#EFEFEF"> 
      <p class="p13"><br>
        Sending mail list
        <script language="JavaScript">
function check()
{
if (document.form1.from.value == ""){
       alert("Please enter the from email!");
       document.form1.from.focus();
      return false;}
if (document.form1.subject.value == ""){
       alert("Please enter the subject!");
       document.form1.subject.focus();
      return false;}
if (document.form1.body.value == ""){
       alert("Please fill in the content!");
       document.form1.body.focus();
      return false;}
return confirm("Are you sure to send all the emails?");
}
</script>
        <br>
      </p>
      <?php
# 如果用户已经按了"Send"按钮" 
if (isset($send))
{
 #if ($mf=="html")
  #{
     # 定义分界线 
   # $boundary = uniqid("");
     # 确定上传文件的MIME类型 
    #if ($attachment_type) $mimeType = $attachment_type;
     # 如果浏览器没有指定文件的MIME类型，
    # 我们可以把它设为"application/unknown". 
    #else $mimeType =  "text/html";
    # 确定文件的名字 
/*  $fileName = $attachment_name;
     # 打开文件 
    $fp = fopen($attachment,  "r");
     # 把整个文件读入一个变量 
    $read = fread($fp, filesize($attachment));
     # 好，现在变量$read中保存的是包含整个文件内容的文本块。
# 现在我们要把这个文本块转换成邮件程序可以读懂的格式
#  我们用base64方法把它编码
    $body = base64_encode($body);
     # 现在我们有一个用base64方法编码的长字符串。
# 下一件事是要把这个长字符串切成由每行76个字符组成的小块
    $body = chunk_split($body);
*/
   # 生成邮件头 
  #  $headers =  "From: $from
#Content-type: $mimeType; boundary=\"$boundary\"";
     # 现在我们可以建立邮件的主体 
 # }
 #if ($mf=="text") $headers="From: $from";

#$db->query("select email from $user_t");
#while($db->next_record())  
# mail($db->f('email'), $subject, $body,$headers);  
#echo "<br><br>All the emails are sent successfully!";
	require("class.phpmailer.php"); //下载的文件必须放在该文件所在目录
	$mail = new PHPMailer(); //建立邮件发送类
	
	$mail->IsSMTP(); // 使用SMTP方式发送
	$mail->Host = "smtp.gmail.com"; // 您的企业邮局域名
	$mail->SMTPAuth = true; // 启用SMTP验证功能
	$mail->SMTPSecure = "ssl";
	$mail->Port = 465;
	$mail->Username = "nldfr219@gmail.com"; // 邮局用户名(请填写完整的email地址)
	$mail->Password = "137082127z"; // 邮局密码
	
	$mail->From = $from; //邮件发送者email地址
	$mail->FromName = "Admin";
	//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
	$db->query("select email from $user_t");
	while($db->next_record())
   $mail->AddAddress($db->f('email'));
	//$mail->AddReplyTo("", "");
	
	//$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
	//$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
	
	$mail->Subject = $subject; //邮件标题
	$mail->Body = $body; //邮件内容
	$mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //附加信息，可以省略
	
	if(!$mail->Send())
	{
		echo "Fail to send all the emails.";
	
	
	}
	else
		echo "All the emails are sent successfully！";
	
	
	
	
	
	
}
else
{
?>
      <form name="form1" method="post" action="" onSubmit="return check()">
        <table align=center bgcolor=#ffe6bf border=1 bordercolor=#d5ab7d 
      bordercolordark=#fff0d9 cellpadding=2 cellspacing=0 width="90%">
          <tbody> 
         
          <tr> 
            <td align=right width="19%">From:</td>
            <td width="81%"> 
              <input class="ks" name=from value="<?php echo $siteemail ?>">
            </td>
          </tr>
          <tr> 
            <td align=right width="19%">To:</td>
            <td width="81%"><font color="#0000FF">All members(total:<?php
			  $db->query("select null from $user_t");
  echo $db->num_rows(); ?>)</font></td>
          </tr>
          <tr> 
            <td align=right width="19%">Subject:</td>
            <td width="81%"> 
              <input class="ks" name=subject>
            </td>
          </tr>
         
          <tr> 
            <td align=right width="19%" height="34">Content:</td>
            <td width="81%" height="34"> 
              <textarea name="body" cols="50" rows="6"></textarea>
            </td>
          </tr>
          <tr> 
            <td width="19%" height="2">&nbsp;</td>
            <td width="81%" height="2">&nbsp;</td>
          </tr>
          <tr bgcolor=#ffd18c> 
            <td colspan=2 align="center"> <br>
              <input class="stbtm" name=send type=submit  value="Send">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class=stbtm name=Reset type=reset value="Reset">
            </td>
          </tr>
          </tbody> 
        </table>
      </form>
      <?php } ?>
      <p class="p13">&nbsp;</p>
      </td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
