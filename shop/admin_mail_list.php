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
# ����û��Ѿ�����"Send"��ť" 
if (isset($send))
{
 #if ($mf=="html")
  #{
     # ����ֽ��� 
   # $boundary = uniqid("");
     # ȷ���ϴ��ļ���MIME���� 
    #if ($attachment_type) $mimeType = $attachment_type;
     # ��������û��ָ���ļ���MIME���ͣ�
    # ���ǿ��԰�����Ϊ"application/unknown". 
    #else $mimeType =  "text/html";
    # ȷ���ļ������� 
/*  $fileName = $attachment_name;
     # ���ļ� 
    $fp = fopen($attachment,  "r");
     # �������ļ�����һ������ 
    $read = fread($fp, filesize($attachment));
     # �ã����ڱ���$read�б�����ǰ��������ļ����ݵ��ı��顣
# ��������Ҫ������ı���ת�����ʼ�������Զ����ĸ�ʽ
#  ������base64������������
    $body = base64_encode($body);
     # ����������һ����base64��������ĳ��ַ�����
# ��һ������Ҫ��������ַ����г���ÿ��76���ַ���ɵ�С��
    $body = chunk_split($body);
*/
   # �����ʼ�ͷ 
  #  $headers =  "From: $from
#Content-type: $mimeType; boundary=\"$boundary\"";
     # �������ǿ��Խ����ʼ������� 
 # }
 #if ($mf=="text") $headers="From: $from";

#$db->query("select email from $user_t");
#while($db->next_record())  
# mail($db->f('email'), $subject, $body,$headers);  
#echo "<br><br>All the emails are sent successfully!";
	require("class.phpmailer.php"); //���ص��ļ�������ڸ��ļ�����Ŀ¼
	$mail = new PHPMailer(); //�����ʼ�������
	
	$mail->IsSMTP(); // ʹ��SMTP��ʽ����
	$mail->Host = "smtp.gmail.com"; // ������ҵ�ʾ�����
	$mail->SMTPAuth = true; // ����SMTP��֤����
	$mail->SMTPSecure = "ssl";
	$mail->Port = 465;
	$mail->Username = "nldfr219@gmail.com"; // �ʾ��û���(����д������email��ַ)
	$mail->Password = "137082127z"; // �ʾ�����
	
	$mail->From = $from; //�ʼ�������email��ַ
	$mail->FromName = "Admin";
	//�ռ��˵�ַ�������滻���κ���Ҫ�����ʼ���email����,��ʽ��AddAddress("�ռ���email","�ռ�������")
	$db->query("select email from $user_t");
	while($db->next_record())
   $mail->AddAddress($db->f('email'));
	//$mail->AddReplyTo("", "");
	
	//$mail->AddAttachment("/var/tmp/file.tar.gz"); // ��Ӹ���
	//$mail->IsHTML(true); // set email format to HTML //�Ƿ�ʹ��HTML��ʽ
	
	$mail->Subject = $subject; //�ʼ�����
	$mail->Body = $body; //�ʼ�����
	$mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //������Ϣ������ʡ��
	
	if(!$mail->Send())
	{
		echo "Fail to send all the emails.";
	
	
	}
	else
		echo "All the emails are sent successfully��";
	
	
	
	
	
	
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
