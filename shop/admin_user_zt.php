<?php
require "conf/config.php";
include "admin_check.php";
if ($f=="y")
{
 $tmp="�˺ż���";
 $tmp2="�����˺��Ѿ���ͨ��������ʹ�������˺Ž��в�����";
 }
else
{
 $tmp="�˺�ʧЧ";
 $tmp2="�����˺��Ѿ���ʱ������Աͣ�á����뿪ͨ�˺ţ��������Ա��ϵ��";
 }
?>
<html>
<head>
<title><?php echo $sitename ?> -- ��Ա�˺Ų���</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0">
<center>
<?php
if ($action=="active")
{
$db->query("update $user_t set action='$f' where id=$id"); //�����û����˺�״̬

//���û���һ���ʼ�֪ͨ
$headers="From:$siteemail";
@mail($email,$sitename."--".$tmp."֪ͨ", $body,$headers); 
echo '<BR><BR>  <p class="p13">��Ա�˺�״̬�����ɹ���</p>';
echo '<input type="button" name="Submit22" value="�رմ���" onClick="self.close();" class="stbtm2">';
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
        <td class="p13" align="center" width="88%">��Ա�˺Ų���--<?php echo$tmp ?></td>
      </tr>
      <tr> 
        <td width="12%" align="right">�˺�:</td>
        <td width="88%"> 
          <?php echo $db->f('u_name') ?>
        </td>
      </tr>
      <tr> 
        <td valign="top" width="12%" align="right"><br>
          ����:</td>
        <td width="88%"> 
          <textarea name="body" cols="44" rows="10">�𾴵��û�:
    
     ����!

     �����û���:<?php echo $db->f('u_name') ?>   ����:<?php echo $db->f('u_pass') ?>

     <?php echo $tmp2 ?> 


           <?php echo "$sitename($siteurl)"; ?>
			   
               email��<?php echo $siteemail; ?>
			   
			   
                           <?php echo date("Y��m��d��"); ?>
						   </textarea>
        </td>
      </tr>
      <tr> 
        <td width="12%" align="right">ѡ��:</td>
        <td width="88%">&nbsp;</td>
      </tr>
      <tr> 
        <td width="12%" align="right">ѡ��:</td>
        <td width="88%">1��30����δ�����κν��ף����ǽ���ʱ�������Ļ�Ա�ʸ�����ָ��������Ա��� <br>
          2��������Ա�ʸ�ת�������ã� Ϊ��֤������Ա�����棬���ǽ���ʱ�������Ļ�Ա�ʸ�����ָ��������Ա���<br>
          3����20��δ��½��վ�����ǽ���ʱ�������Ļ�Ա�ʸ�����ָ��������Ա���</td>
      </tr>
    </table>
    <br>
    <input type="hidden" name="email" value="<?php echo $db->f('email') ?>">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="hidden" name="f" value="<?php echo $f ?>">
    <input type="hidden" name="action" value="active">
    <input type="submit" name="Submit" value="ȷ ��" class="stbtm2">
    ���� 
    <input type="button" name="Submit2" value="�� ��" onclick="self.close();" class="stbtm2">
</form>
  <?php } ?>
</center>
</body>
</html>
