<?php
require "conf/config.php";
include "admin_check.php";
if (isset($action)&&$action=="del")
{
  //ɾ���û�������Ķ���
  $db->query("delete from $requests_t where id=($id-$init_num)");
  //ɾ���û�shopping�����Ʒid
  $db->query("delete from $shopping_t where requests_id=($id-$init_num)");
  }
if (isset($do)&&$do=="update")
{
  $db->query("update $requests_t set orderstatus=$value where id=($id-$init_num)");
//���û����ʼ�֪ͨ�û�
  if ($action=="send_out" && $value==1)
  {
  //�Ӷ�����$requests_t��ȡ���û���һЩ��Ϣ
$db->query("select name,email,tel,post,address,fee  from $requests_t where id=($id-$init_num)");
$db->next_record();
$email=$db->f('email');
$name=$db->f('name');
$tel=$db->f('tel');
$post=$db->f('post');
$address=$db->f('address');
$price_all=$db->f('fee');

//�Ӷ�����ϸ����ȡ����������ϸ��Ϣ
$sendtmp="";
$db->query("select goods_id,goods_num from $shopping_t where requests_id=($id-$init_num)");
while($db->next_record())
{
//�Ӳ�Ʒ����ȡ����Ʒ����Ӧ�����ƺͼ۸�
$db2->query("select name,price from $goods_t where id=".$db->f('goods_id'));
$db2->next_record();

$sendtmp.="<tr >
      <td width=\"60%\"><b>".stripslashes($db2->f('name'))."</b></td>
      <td width=\"20%\"><font color=\"red\">".$db2->f('price')."</font>$</td>
      <td width=\"20%\">".$db->f('goods_num')."</td>
    </tr>\n";
}

# ����ֽ��� 
$boundary = uniqid("");
# ��������û��ָ���ļ���MIME���ͣ�
$mimeType =  "text/html";  
# �����ʼ�ͷ 
$headers =  "From: $siteemail
Content-type: $mimeType; boundary=\"$boundary\"";
# �������ǿ��Խ����ʼ�������

$sendbody="<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\">
<title>$sitename �� Order Admin</title>
</head>
<body>

<table align=\"center\" border=\"0\" cellPadding=\"0\" cellSpacing=\"0\" width=\"550\">
  <tbody>
    <tr vAlign=\"top\">
      <td><br>
      
        <br><font size=\"3\"><b>Dear $name</b>:</font><br><br>
        <span class=\"p12\">&nbsp;&nbsp;&nbsp;&nbsp;Hello��Thank you for shopping at $sitename.<b>The products you purchased have been shipped��</b><br>
        <br>
      &nbsp;&nbsp;&nbsp;&nbsp;If you have any problem or want to cancel the order. Please send <a href=\"mailto:$siteemail\"><strong><font color=\"red\">email</font></strong></a> with your order ID.<br>
      &nbsp;&nbsp;&nbsp;&nbsp;Regarding the order information, you can log in and get it from our website. Now the order information is as below:
 
      <br>
        <table cellspacing=0 cellpadding=2 width=590 border=1 style='font-size:9pt' bordercolorlight=#D2D2D2 bordercolordark=#FFFFFF >
          <tbody>
            <tr>
              <td bgcolor=\"#f5f5f5\" width=\"20%\">Recipient name</td>
              <td bgcolor=\"#f5f5f5\" width=\"80%\"><b>$name</b></td>
            </tr>
            <tr>
              <td width=\"20%\">Telephone</td>
              <td width=\"80%\"><b>$tel</b></td>
            </tr>
            <tr>
              <td bgcolor=\"#f5f5f5\" width=\"20%\">Zip code</td>
              <td bgcolor=\"#f5f5f5\" width=\"80%\"><b>$post</b></td>
            </tr>
            <tr>
              <td width=\"20%\">Address</td>
              <td width=\"80%\"><b>$address</b></td>
            </tr>
          </tbody>
        </table>
        
        <br>
        <br>
        </span>
    </tr>
  </tbody>
</table>

<table cellspacing=0 cellpadding=2 width=590 border=1 style='font-size:9pt' bordercolorlight=#D2D2D2 bordercolordark=#FFFFFF align=\"center\">
  <tbody>
    <tr bgColor=\"#e6e6e6\">
      <td colSpan=\"3\">Order ID: ".$id."</td>
    </tr>
    <tr>
      <td width=\"60%\">Product name</td>
      <td width=\"20%\">Product price</td>
      <td width=\"20%\">Product quantity</td>
    </tr>
    
    
$sendtmp
    
    <tr align=\"right\" bgColor=\"#f5f5f5\">
      
    <td colSpan=\"3\"> Total:<font color=\"red\">$$price_all</font>$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
  </tbody>
</table>
<br>
 

<div align=\"center\"> <span class=\"p12\"> <br>
  Welcome again to our website <a href=\"$siteurl\"><font color=\"blue\">$sitename</font></a> to do some shopping<br>
  <br>
  <b>telephone:$sitetel</b><br>      
  <b>E-mail:<a href=\"mailto:$siteemail\">$siteemail</a></b><br>      
  <a href=\"$siteurl\">$siteurl</a><br>      
  </b></b></span>      
</div>      

</body>
      
</html>      
";
require("class.phpmailer.php"); //���ص��ļ�������ڸ��ļ�����Ŀ¼
$mail = new PHPMailer(); //�����ʼ�������

$mail->IsSMTP(); // ʹ��SMTP��ʽ����
$mail->Host = "smtp.gmail.com"; // ������ҵ�ʾ�����
$mail->SMTPAuth = true; // ����SMTP��֤����
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->Username = "nldfr219@gmail.com"; // �ʾ��û���(����д������email��ַ)
$mail->Password = "137082127z"; // �ʾ�����

$mail->From = "nldfr219@gmail.com"; //�ʼ�������email��ַ
$mail->FromName = "Admin";
$mail->AddAddress($email);//�ռ��˵�ַ�������滻���κ���Ҫ�����ʼ���email����,��ʽ��AddAddress("�ռ���email","�ռ�������")
//$mail->AddReplyTo("", "");

//$mail->AddAttachment("/var/tmp/file.tar.gz"); // ��Ӹ���
//$mail->IsHTML(true); // set email format to HTML //�Ƿ�ʹ��HTML��ʽ

$mail->Subject = "Zhi Ma's Online Shop -- Your Order has been shipped!"; //�ʼ�����
$mail->Body = $sendbody; //�ʼ�����
$mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //������Ϣ������ʡ��

if(!$mail->Send())
{
	echo "Fail to send the email.";


}
else
	echo "Successfully send the email.";




  }
}
?>
<html>
<head>
<title><?php echo $sitename ?> -- Order admin</title>
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
        Order admin</p>
      <table width="96%" border="0" cellspacing="0" bgcolor="#ffffff">
        <form name="form1" method="post" action="<?php echo $PHP_SELF ?>" >
          <tr> 
            <td> According to order ID and username: 
              <input type="text" name="key" size="15" class="think" >
              <input type="hidden" name="search" value="1">
              <input type="submit" name="submit1" value="Search" class="stbtm2">
            </td>
          </tr>
        </form>
      </table>     
        
      <?php 
  if (!isset($page)) $page=1;
  if(isset($success))
  $tmp="where orderstatus=1 "; 
  else 
  	$tmp="where orderstatus=0 ";
  if (isset($key))
  
     if (($key-$init_num)>0)
	  $tmp.=" and id=".($key-$init_num);
     else
        $tmp.=" and name like '%$key%' ";  

  $db->query("select null from $requests_t $tmp"); //�Ӷ������в���û��Ķ���
  $total_num=$db->num_rows();//�õ��ܼ�¼��
  $totalpage=ceil($total_num/$num_to_show);//�õ���ҳ��
  $init_record=($page-1)*$num_to_show;
  $db->query("select * from $requests_t $tmp
     order by id DESC limit $init_record, $num_to_show");
if(!isset($key))
	$key="";        
 ?>
      <table width="99%" border="0" cellspacing="0" align="center" >
        <tr> 
          <td width="69%"> <b>Order list:</b></td>
          <td width="31%" align="right"><a href="admin_dingdang.php"><font color="blue">pending orders </font></a> 
            <a href="admin_dingdang.php?success=true;"><font color="blue">&nbsp;successful orders</font></a> 
            </td>
        </tr>
        <tr> 
          <td colspan="2" align="center" height="25"><font color="#CC0000">When products are shipped, the user will receive a email about it.</font></td>
        </tr>
      </table>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF."?key=$key" ?> " method="post" name="form8" onSubmit="return check_page('form8.page')">
          <tr> 
            <td align="right"> total: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>first&nbsp;previous</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1&key=$key'>first</a>&nbsp;<a href='$PHP_SELF?page=$page1&key=$key'>previous</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>next&nbsp;last</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2&key=$key'>next</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&key=$key'>last</a>&nbsp;"; 
?>
              current:<b> 
              <?php echo $page."/".$totalpage ?>
              </b>&nbsp; 
              <script language="JavaScript">
function check_page(name)
{
 eval("page="+name+".value");
 if (isNaN(page) || page <=0 || page > <?php echo $totalpage ?>)
  {
    alert ("����ȷ����ҳ�������ֵΪ <?php echo $totalpage ?> ��");
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
          <td align=center><font color="#cc0000">Order Id</font></td>
          <td align=center><font color="#cc0000">Order user</font></td>
          <td align=center><font color="#cc0000">Payment details</font></td>
          <td align=center><font color="#cc0000">Order time</font></td>
          <td align=center><font color="#cc0000">Order status</font></td>
          
          <td align=center><font color="#cc0000">Fee</font></td>
          <td align=center><font color="#cc0000">Shipping</font></td>
          <td align=center><font color="#cc0000">Operation</font></td>
          <td align=center>&nbsp;</td>
        </tr>
        <?php
while($db->next_record())
  { 
?>
        <tr> 
          <td align=center> <a href='admin_dingdang_disp.php?id=<?php echo $db->f('id')+$init_num ?>' class='clink03' target="_blank"> 
            <?php echo $db->f('id')+$init_num; ?>
            </a> </td>
          <td align=center>
            <?php
$db2->query("select id,u_name from $user_t where id=".$db->f('user_id'));
$db2->next_record();
echo '<a href="admin_user_list.php?id='.$db2->f('id').'" class="clink03" target="_blank">'.$db2->f('u_name').'</a>';
?>
          </td>
          <td align=center> 
            <?php
echo $db->f('nameoncard')." ".$db->f('cardnumber')." ".$db->f('expdate');
?>
          </td>
          <td align=center> 
            <?php echo $db->f('date_created'); ?>
          </td>
          <td align=center>
            <?php 
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
            ?>
            </td>
          
          <td align=center> 
            <?php echo $db->f('fee'); ?>
            $</td>
          <td align=center> 
            <?php
			if ($db->f('orderstatus'))
			 echo "<a href='$PHP_SELF?do=update&action=send_out&value=0&id=".($db->f('id')+$init_num)."' onClick=\"return confirm('Are you sure to make it not shipped?')\" class='clink03'>"."make it not shipped</a>";
            else
			 echo "<a href='$PHP_SELF?do=update&action=send_out&value=1&id=".($db->f('id')+$init_num)."' onClick=\"return confirm('Are you sure to make it shipped?')\" class='clink03'>"."make it shipped</a>";
			 ?>
          </td>
          
          <td align=center> 
            <input type="button" name="Button2" value="delete" class="think" <?php echo "onclick=\"javaScript:if (confirm('Are you sure to delete?')) window.location.href='$PHP_SELF?action=del&id=".($db->f('id')+$init_num)."'\""; ?>>
          </td>
        </tr>
        <?php } ?>
      </table>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF."?key=$key" ?> " method="post" name="form88" onSubmit="return check_page('form88.page')">
          <tr> 
            <td align="right"> total: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>first&nbsp;previous</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1&key=$key'>first</a>&nbsp;<a href='$PHP_SELF?page=$page1&key=$key'>previous</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>next&nbsp;last</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2&key=$key'>next</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&key=$key'>last</a>&nbsp;"; 
?>
              current:<b> 
              <?php echo $page."/".$totalpage ?>
              </b>&nbsp; 
            </td>
          </tr>
        </form>
      </table>
    </td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
