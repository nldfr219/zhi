<?php
############ ZTSKY���Բ�1.0�汾 ########################################################
# ��Ȩ����: ztsky
# E-mail��: yangyuyan@sina.com
# OICQ����: 605202
# ��ҳ��ַ: "mailto:wyx726@126.com"/
#
# ����Ȩ������
# �������ṩ������վ���ʹ�ã�����Ƿ��޸ģ�
# ת�أ�ɢ��������������ͼ����Ϊ��������ɾ����Ȩ�����Լ��ҵ���ҳ��ַ������
# ���������վ��ʽ����������ű�������֪ͨ���ǣ��Ա����ܹ�֪����
# ������ܣ�����������վ�������ǵ����ӣ�ϣ���ܸ��������лл��
#
# �������ܡ�
#1. ֧�ֶ��û�������ǿ�� 
#2. �������ۣ�ģ��UGB���
#3. ֧��OICQ������ʾ
#4. �����������Բ����߿�ͨ
#5. ���������޸�, ��ʱ��Ч
#6. �������������ʱɾ���������Բ����û�
#7. ����ʾ�ÿ�IP������ʱ�䡣
#8. ÿ�����������Թ����Լ����ڵ����ԣ�������ɾ�����Ժͻظ����ԡ�
#9. �ṩ������������,�ٶȿ졢����ǿ��
#10.��������Զ������Բ�ͷ����ʾ��Ϣ��β����ʾ��Ϣ��
#11.�����趨�Ƿ�֧��ubb���html��
#12.ֻ��ʹ���ı���Ϊ���ݿ⣬�����и���
#
#   ���о���һЩ���õĺ����������˺������֣���ҿ��Ժܷ�����޸ģ��Ǻ�
#   ���ڳ���İ�װ����Ҳ�Ƿǳ��򵥣����������鷳����������run.php
# ��������޸������ļ������ԣ����ڱ�����������μ����ò��֡�
# ���������Բ�����ʾ��2hu.net/free/gb
#########################################################################################
# �����������ǵ��Ͷ��Ͱ�Ȩ����Ҫɾ�����ϵİ�Ȩ�������֣�лл��������
#########################################################################################
####################################���ò���#############################################

require "../conf/options.php";

$admin[path]="./data";				##���ݿ��ļ���·��
$admin[home]=$siteurl;		##��ҳ��ַ
$admin[password]=$ad_pass;				##����Ա����
$admin[email]=$siteemail;			##����Ա����
$admin[name]=$ad_name;				##����Ա�ʺ�
$admin[homename]=$sitename;			##��ҳ����
$admin[ubb]=1;					##�Ƿ�֧��UBB���룬0����
$admin[html]=0;					##�Ƿ�֧��HTML���룬0����
$admin[up]="";					##���Բ��ϲ�HTML����
$admin[down]="";				##���Բ��²�HTML����
$admin[page]=5;					##ÿҳĬ����ʾ������Ŀ
$admin[img]="image";				##ͼƬ�ļ�����URL
$admin[gb]="$siteurl/guestbook/index.php";	##���Բ���ҳ������URL
####################################�������#############################################
if(empty($home))$home=$admin[home];
$pass=$admin[password];
if(empty($email))$email=$admin[email];
#########################################################################################
####################################���ú���#############################################
function oicq($uin){
 if($uin=="")return 1;else
 if(strlen($uin)<=8 and !eregi("([^0-9])",$uin))return 1;else return 0;
}
function getline($file){
  $data=Chop(fgets($file,5000));
  return $data;
}
function nowtime(){
  $date=date("Y-m-d.G:i:s");
  return $date;
}
function getid(){
  $id=date("YmdHis");
  return $id;
}
function ubb($Text) { 
  $Text=htmlspecialchars($Text); 
  $Text=ereg_replace("\r\n","<br>",$Text); 
  $Text=ereg_replace("\r","<br>",$Text); 
  $Text=nl2br($Text); 
  $Text=preg_replace("/\\t/is","  ",$Text); 
  $Text=preg_replace("/\[h1\](.+?)\[\/h1\]/is","<h1>\\1</h1>",$Text); 
  $Text=preg_replace("/\[h2\](.+?)\[\/h2\]/is","<h2>\\1</h2>",$Text); 
  $Text=preg_replace("/\[h3\](.+?)\[\/h3\]/is","<h3>\\1</h3>",$Text); 
  $Text=preg_replace("/\[h4\](.+?)\[\/h4\]/is","<h4>\\1</h4>",$Text); 
  $Text=preg_replace("/\[h5\](.+?)\[\/h5\]/is","<h5>\\1</h5>",$Text); 
  $Text=preg_replace("/\[h6\](.+?)\[\/h6\]/is","<h6>\\1</h6>",$Text); 

  $Text=preg_replace("/\[url\](http:\/\/.+?)\[\/url\]/is","<a href=\\1>\\1</a>",$Text); 
  $Text=preg_replace("/\[url\](.+?)\[\/url\]/is","<a href=\"http://\\1\">http://\\1</a>",$Text); 
  $Text=preg_replace("/\[url=(http:\/\/.+?)\](.*)\[\/url\]/is","<a href=\\1>\\2</a>",$Text); 
  $Text=preg_replace("/\[url=(.+?)\](.*)\[\/url\]/is","<a href=http://\\1>\\2</a>",$Text); 

  $Text=preg_replace("/\[img\](.+?)\[\/img\]/is","<img src=\\1>",$Text); 
  $Text=preg_replace("/\[color=(.+?)\](.+?)\[\/color\]/is","<font color=\\1>\\2</font>",$Text); 
  $Text=preg_replace("/\[size=(.+?)\](.+?)\[\/size\]/is","<font size=\\1>\\2</font>",$Text); 
  $Text=preg_replace("/\[sup\](.+?)\[\/sup\]/is","<sup>\\1</sup>",$Text); 
  $Text=preg_replace("/\[sub\](.+?)\[\/sub\]/is","<sub>\\1</sub>",$Text); 
  $Text=preg_replace("/\[pre\](.+?)\[\/pre\]/is","<pre>\\1</pre>",$Text); 
  $Text=preg_replace("/\[email\](.+?)\[\/email\]/is","<a href=\\1>\\1</a>",$Text); 
  $Text=preg_replace("/\[i\](.+?)\[\/i\]/is","<i>\\1</i>",$Text); 
  $Text=preg_replace("/\[b\](.+?)\[\/b\]/is","<b>\\1</b>",$Text); 
  $Text=preg_replace("/\[quote\](.+?)\[\/quote\]/is","<blockquote><font size='1' face='Courier New'>quote:</font><hr>\\1<hr></blockquote>", $Text); 
   $Text=preg_replace("/\[code\](.+?)\[\/code\]/is","<blockquote><font size='1' face='Times New Roman'>code:</font><hr color='lightblue'><i>\\1</i><hr color='lightblue'></blockquote>", $Text); 
   $Text=preg_replace("/\[sig\](.+?)\[\/sig\]/is","<div style='text-align: left; color: darkgreen; margin-left: 5%'><br><br>--------------------------<br>\\1<br>--------------------------</div>", $Text); 
return $Text; 
} 
function str($msg){
  global $admin;
  if(!$admin[html]) $msg=htmlspecialchars($msg);
  if($admin[ubb]) $msg=ubb($msg);
  $msg=nl2br($msg); #����message
  $msg= str_replace("\n","",$msg); #����message
  $msg= str_replace("\r","",$msg); #����message
  return $msg;
}
function error($msg){
global $admin;
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="<?php echo $admin[img];?>/style.css"><title>���Բ�����</title></head>
<body background="image/bgmc.gif"><html><head></head><body bgcolor="#FFFFFF"> 
<center><table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td width="100%"><table border="0" width="100%" bgcolor="#000000" cellspacing="0" cellpadding="0">
<tr><td width="100%">
              <table border="0" cellspacing="2" width="100%" align=left height="320" bordercolor="#000000" bgcolor="#339966">
                <tr bgcolor="#339966"> 
                  <td width="100%" align=center height="31"><font color="#804000"><span style="font-size: 11pt"><font color="#FFFFFF">���Ա���������</font></span></font></td>
                </tr>
                <tr>
                  <td width="100%" align=left height="247" bgcolor="#F7F7F7"><span style="font-size: 11pt">
                    <p align="center"> ����ԭ��<font color="#FF0000"><?php echo $msg;?></font></p>
                    <p align="center"><a href="javascript:history.go(-1);"><font color="#000000">������ﷵ����һҳ�����������Ƿ�����</font></a></p>
                    <p align="center">[ <a href="javascript:history.go(-1);">������һҳ</a> 
                      ]</p>
                    </span></td>
                </tr>
                <tr bgcolor="#339966" bordercolor="#000000"> 
                  <td width="100%" height="30"> 
                    <p align="right"><font color="#339966"><span  
style="font-size: 9pt">Copyright 200x ztsky <font face="Arial">.Allrights reserved.</font></span> 
                      </font>
                  </td>
                </tr>
              </table>
            </td></tr></table></td></tr></table></center></body></html>
<?php
}
function output($line,$no){
$info=explode("|!:!|",$line);
global $name;
global $admin;
global $user;
?>
<center><TABLE a bgColor=#000000 border=0 cellPadding=0 cellSpacing=0 height=1 width='90%'>
<TR bgColor=#ffffff width="100%"><TD bgColor=#000000 height=1 width="100%">
<TABLE border=0 cellPadding=3 cellSpacing=1 height=8 width="100%"><TBODY><TR>
<TD bgColor=#f7f7f7 height=8 rowSpan=3 vAlign=top width=155>
<TABLE><font color="#000000">���ԣ�NO.<?php echo $no;?></font>
<TBODY></TBODY></TABLE><div align="center"><center><TABLE border=0 cellPadding=0 cellSpacing=0>
<TBODY><TR><TD align=middle><font color="#000000"><img src="<?php echo $info[3];?>" width="32" height="32"></font></TD></TR></TBODY></TABLE></center></div>
<P>������<font color="#000000"><?php echo $info[2];?></font><BR>���ԣ�<font color="#000000"><?php echo $info[7];?></font><BR>�ʼ���<a href="mailto:<?php echo $info[4];?>" title="��<?php echo $info[2];?>����"><IMG border=0 src="<?php echo $admin[img];?>/mail.gif">&nbsp;�ʼ�</a><BR>��ҳ��<a href="<?php echo $info[5];?>" target="_blank" title="����<?php echo $info[2];?>����ҳ"><IMG border=0 src="<?php echo $admin[img];?>/home.gif">&nbsp;��ҳ</a> <BR></P></TD>
<TD bgColor=#ffffff height=1 width=503><IMG src="<?php echo $admin[img];?>/1.gif" width="18" height="18"> �����ڣ�<?php echo $info[8];?> 
<TR><TD bgColor=#ffffff height=95 width=503><TABLE border=0 cellPadding=3 cellSpacing=0 height="100%" width="100%"><TBODY><TR><TD vAlign=top width="100%" height="94"><font color="#0080FF"><?php echo $info[1];?></font></TD></TR></TBODY></TABLE><TR>
            <TD bgColor=#f7f7f7 height=10 width=503>&nbsp; <a href="mailto:<?php echo $info[4];?>" title="��<?php echo $info[2];?>����"><IMG border=0 src="<?php echo $admin[img];?>/mail.gif">&nbsp;�ʼ�</a>&nbsp; 
              <a href="<?php echo $info[5];?>" target="_blank" title="����<?php echo $info[2];?>����ҳ"><IMG border=0 src="<?php echo $admin[img];?>/home.gif">&nbsp;��ҳ</a>&nbsp; 
              <img src=<?php echo $admin[img];?>/oicq.gif alt=<?php echo $info[2];?>��OICQ��<?php echo $info[6];?>>&nbsp;OICQ&nbsp;<IMG alt=<?php echo $info[2];?>��IP��ַ�ǣ�<?php echo $info[7];?> border=0 src="<?php echo $admin[img];?>/ip.gif" width="13" height="15">&nbsp;IP 
              &nbsp;<a href="<?php echo $PHP_SELF;?>?action=reply&user=<?php echo $user;?>&id=<?php echo $info[0];?>" title="�ظ������ԣ�ֻ�а������лظ���Ȩ������"><IMG border=0 src="<?php echo $admin[img];?>/replay.gif">&nbsp;�ظ�</a> 
              &nbsp;<a href="<?php echo $PHP_SELF;?>?action=del&user=<?php echo $user;?>&id=<?php echo $info[0];?>" title="ɾ��������"><IMG border=0 src="<?php echo $admin[img];?>/del.gif">&nbsp;ɾ��</a></TD>
          </TR></TBODY></TABLE></TR></TABLE></CENTER>
<?php
}
####################################�������#############################################
#########################################################################################
####################################���򲿷�#############################################
if(empty($user))$user="main";
$file="$admin[path]/$user.dat";
if(!file_exists($file)) error("�Բ���û���ҵ�����û������Բ���<a href=$PHP_SELF>����������һ����</a>��");
else{
if($user<>"main") include("$admin[path]/$user.php");
if($action=="add"){
if($addsub){ 
$name = ereg_replace("<[^>]*>", "", $name); $msg=str($msg); 
$email = ereg_replace("<[^>]*>", "", $email); 
$home = ereg_replace("<[^>]*>", "", $home); 
  if($msg=="" or $name=="")error("���ǰɣ�������ֺ����Զ���д��������ʲô�����ԡ�����");

   //��֤�û������Ƿ����֤��һ�� 
   if(strcmp($HTTP_POST_VARS['authnum'],$HTTP_POST_VARS['authinput'])!=0) 
       error("��֤���������");   

  elseif(!oicq($oicq))error("���OICQ�����д���");
  else{
    if($sex=="boy")$sex="$admin[img]/01.gif";
	   else $sex="$admin[img]/02.gif";
	if($oicq=="")$oicq="δ֪";
	if($home=="")$home="δ֪";
	if($mail=="")$mail="δ֪";
    $data=fopen("$admin[path]/$user.dat","r");
    $num=Chop(fgets($data,15));
	$num++;
    $old=fread($data,filesize($file));
    fclose($data);
	$id=getid();
	$time=nowtime();
	$ip=$REMOTE_ADDR;$ip2=explode(".",$ip);$ip="$ip2[0].$ip2[1].$ip2[2].$ip2[3]";
	$writemsg="$num\n$id|!:!|$msg|!:!|$name|!:!|$sex|!:!|$email|!:!|$home|!:!|$oicq|!:!|$ip|!:!|$time\n$old";
	$data=fopen($file,"w");
	fwrite($data,$writemsg);
	fclose($data);
	$cookietime=time()+31536000;
	setcookie(ex_user_home,$home,$cookietime);
	setcookie(ex_user_mail,$email,$cookietime);
	setcookie(ex_user_name,$name,$cookietime);
	setcookie(ex_user_oicq,$oicq,$cookietime);
	echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
    echo "<HTML><HEAD><TITLE>��������</TITLE>";
	echo "<META content=\"text/html; charset=gb2312\" http-equiv=Content-Type>";
	echo "<link rel=\"stylesheet\" href=\"$admin[img]/style.css\">";
	echo "<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2;URL=$PHP_SELF?user=$user\">";
	echo "</head><body topmargin=\"0\"><br>";
	echo "<ul>лл�㷢������,�����������Բ���ҳ.<br>";
    echo "&nbsp;<br>��ȴ� ϵͳ���ڴ�������µ�����...<br>";
    echo "&nbsp;<br></font>";
	echo "<a href=$PHP_SELF?user=$user>�����������û���Զ��ķ��ص����Բ���ҳ�������㲻���ٵȴ���������ﷵ��.";
	echo "</font></a></ul>";
  }}else{
if($ex_user_home=="")$ex_user_home="http://";
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="<?php echo $admin[img];?>/style.css"><title>ǩд����</title></head>
<body bgcolor="#ffffff"><table align="center"><tr><td>
<form method="POST" action="<?php echo $PHP_SELF;?>?action=add" align="center">
<center><table border="0" width="85%" height="43" bgcolor="#000000" cellspacing="1">
            <tr bgcolor="#339966"> 
              <td width="732" height="25" colspan="2"> 
                <p align="center"><center>
                    <a href="<?php echo $PHP_SELF;?>?action=add"><font color="#F7F7F7">ǩд����</font></a>
</center></td></tr><tr align="center"><td width="238" valign="middle" align="center" height="1" bgcolor="#FFFFFF"><p align="center"><font color="#000000">�������֣�</font></td> 
<td width="232" valign="middle" align="left" height="1" bgcolor="#FFFFFF"><font color="#000000">&nbsp;<input type="text" name="name" size="35" maxlength="50" class="stedit" value="<?php echo $ex_user_name;?>"> 
</font></td></tr><tr align="center"><td width="238" valign="middle" align="center" height="23" bgcolor="#FFFFFF"> 
<p align="center"><font color="#000000">����OICQ��</font>
</td><td width="232" valign="middle" align="left" height="23" bgcolor="#FFFFFF"><font color="#000000">&nbsp;<input type="text" name="oicq" 
size="35" maxlength="50" class="stedit" value="<?php echo $ex_user_oicq;?>"></font></td></tr><tr align="center"><td width="238" valign="middle" height="25" bgcolor="#FFFFFF" align="left">
<p align="center"><font color="#000000">�����ʼ���</font></td><td width="644" valign="middle" align="left" height="25" bgcolor="#FFFFFF">
<font color="#000000">&nbsp;<input type="text" name="email" size="35" maxlength="30" class="stedit" value="<?php echo $ex_user_mail;?>"></font></td></tr><tr>
<td width="238" valign="middle" height="21" bgcolor="#FFFFFF" align="left"><p align="center"><font color="#000000">��ҳ��ַ��</font></p>
</td><td width="644" valign="middle" align="left" height="21" bgcolor="#FFFFFF"><font color="#000000">&nbsp;<input type="text" name="home" size="35" maxlength="50" class="stedit" value="<?php echo $ex_user_home;?>"></font></td></tr>
<tr><td width="238" valign="middle" height="23" bgcolor="#FFFFFF" align="left"><p align="center"><font color="#000000">�����Ա�</font></p></td><td width="644" valign="middle" align="left" height="23" bgcolor="#FFFFFF">&nbsp; 
<select size="1" name="sex"><option value="boy" selected>˧&nbsp;&nbsp; ��</option><option value="girl">��&nbsp;&nbsp; Ů</option></select></td>
</tr><tr align="center"><td width="238" valign="middle" align="left" height="1" bgcolor="#FFFFFF"><p align="center"><font color="#000000">��������</font></td><td width="644" valign="middle" align="left" height="1" bgcolor="#FFFFFF"><font color="#000000">
<textarea rows="7" name="msg" cols="69" class="stedit" wrap=hard></textarea><input type="hidden" name="user" value="<?php echo $user;?>">
</font></td></tr>
<!-- Ϊ��ֹ��ˮ��������֤�빦�� start -->
<tr>
<td width="238" valign="middle" height="21" bgcolor="#FFFFFF" align="left"><p align="center"><font color="#000000">��������֤�룺</font></p>
</td><td width="644" valign="middle" align="left" height="21" bgcolor="#FFFFFF"><font color="#000000">&nbsp;
<?php
    //�����������
    srand((double)microtime()*1000000); 
   //�����µ���λ������֤�� 
   while(($authnum=rand()%10000)<1000);  
?>

<input type=text name=authinput size="5" maxlength="4">
<img src=authimg.php?authnum=<? echo $authnum; ?>>
<input type=hidden name=authnum value=<? echo $authnum; ?>> 
</font></td></tr>
<!-- Ϊ��ֹ��ˮ��������֤�빦�� end -->
            <tr align="center" bgcolor="#339966"> 
              <td width="732" valign="middle" align="center" height="6" colspan="2"><font color="#000000"> 
                <input type="submit" value="ǩд����" name="addsub" class="stbtm">&nbsp;&nbsp;&nbsp;&nbsp; 
                <input type="reset" value="������д" name="B2" class="stbtm">
                </font></td>
            </tr></table></center></form></td></tr></table><hr width="80%" noshade size="1" color="#000000"><p align="center">������Ա���<font color=#cc0033></font><font color=#ff6633><b><font Helvetica, sans-serif><a href="<?php echo $admin[home];?>" target=_blank><?php echo$admin[homename];?></a></font></b></font><font color=#cc0033></font>�ṩ ����֧�֣�<b><a href="mailto:wyx726@126.com" target=_blank>����ϰϰ</a></b></p></body>
<?php
}
}elseif($action=="del"){
if($delsub){
if($password==$pass){
  echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
  echo "<HTML><HEAD><TITLE>��������</TITLE>";
	echo "<META content=\"text/html; charset=gb2312\" http-equiv=Content-Type>";
	echo "<link rel=\"stylesheet\" href=\"$admin[img]/style.css\">";
	echo "<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2;URL=$PHP_SELF?user=$user\">";
	echo "</head><body topmargin=\"0\"><br>";
	echo "<ul>����ɾ�����Գɹ�.<br>";
    echo "&nbsp;<br>��ȴ� ϵͳ����ɾ���������...<br>";
    echo "&nbsp;<br></font>";
	echo "<a href=$PHP_SELF?user=$user>�����������û���Զ��ķ��ص����Բ���ҳ�������㲻���ٵȴ���������ﷵ��.";
	echo "</font></a></ul>";
  flush();
  $file="$admin[path]/$user.dat";
  $data=fopen($file,"r");
  $num=chop(fgets($data,15));
  $num--;
  $headdata="";$sign=1;$id="$id";
  While($sign){
  	$headdata=$headdata.$temp;
    $temp=fgets($data,5000);
	$line=explode("|!:!|",$temp);
    if($line[0]==$id) $sign=0;
	if(feof($data)){error("û���ҵ����ԡ����Բ�����"); exit;}
  }
  $footdata=fread($data,filesize($file));
  fclose($data);
  $writemsg=$num."\n".$headdata.$footdata;
  $data=fopen($file,"w");
  fwrite($data,$writemsg);
  fclose($data);
}else error("�Ǻǣ��������������㿴�����ǰ��񣬲���ɾ�����ԣ�");
}else{
?>
<html><head><meta http-equiv="Content-Type" content="text/html;charset=gb2312"><title>����ɾ������</title><link rel="stylesheet" href="<?php echo $admin[img];?>/style.css"></head><body bgcolor="#ffffff"><form method="post" action="<?php echo $PHP_SELF;?>?action=del"><center><table width=90% border=0 cellspacing="1" bgcolor="#000000"><tr align=center><td align=center colspan=4 width=652 bgcolor="#336699"><p><font color="#FFFFFF">���Ա�����</font></td></tr><tr align=center><td align=center width=18% bgcolor="#F7F7F7"><p align="center">�����˺�:</p></td> <td align=center bgcolor="#F7F7F7" width="32%">&nbsp;&nbsp;&nbsp; <input type=text name=name size=20 class="stedit"></td><td align=center bgcolor="#F7F7F7" width="18%">��������:</td><td align=center bgcolor="#F7F7F7" width="32%"><input type=password name=password size=20 class="stedit"><input type="hidden" name="user" value="<?php echo $user;?>"><input type="hidden" name="id" value="<?php echo $id;?>"></td></tr><tr align="center"><td align="center" colspan="4" width="652" bgcolor="#F7F7F7"><div align="center"><p><input type="submit" name="delsub" value="ȷ��ɾ��" class="stbtm">&nbsp;&nbsp;&nbsp;<input type="reset" value="��������" name="B1" class="stbtm"></td></tr></table></body></html>
<?php
}}elseif($action=="reply"){
if($replysub){
if($password==$pass){
  echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
  echo "<HTML><HEAD><TITLE>��������</TITLE>";
	echo "<META content=\"text/html; charset=gb2312\" http-equiv=Content-Type>";
	echo "<link rel=\"stylesheet\" href=\"$admin[img]/style.css\">";
	echo "<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2;URL=$PHP_SELF?user=$user\">";
	echo "</head><body topmargin=\"0\"><br>";
	echo "<ul>������ӻظ��ɹ�.<br>";
    echo "&nbsp;<br>��ȴ� ϵͳ�������������ԵĻظ�...<br>";
    echo "&nbsp;<br></font>";
	echo "<a href=$PHP_SELF?user=$user>�����������û���Զ��ķ��ص����Բ���ҳ�������㲻���ٵȴ���������ﷵ��.";
	echo "</font></a></ul>";
  flush();
  $file="$admin[path]/$user.dat";
  $data=fopen($file,"r");
  $headdata="";$sign=1;$id="$id";
  While($sign){
  	$headdata=$headdata.$temp;
    $temp=fgets($data,5000);
	$line=explode("|!:!|",$temp);
    if($line[0]==$id) $sign=0;
	if(feof($data)){error("û���ҵ����ԡ����Բ�����"); exit;}
  }
  $msg=str($msg);
  $line[1]=$line[1]."<br>&nbsp;&nbsp;&nbsp;&nbsp;<font color=#FF0000>����ظ���</font><font color=#000099>$msg</font>";
  $temp2=implode("|!:!|",$line);
  $footdata=fread($data,filesize($file));
  fclose($data);
  $writemsg=$headdata.$temp2.$footdata;
  $data=fopen($file,"w");
  fwrite($data,$writemsg);
  fclose($data);
}else error("�Ǻǣ��������������㿴�����ǰ��񣬲��ܻظ����ԣ�");
}else{
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312"><title>�ظ�����</title><link rel="stylesheet" href="<?php echo $admin[img];?>/style.css"></head><body bgcolor="#ffffff"><form method="post" action="<?php echo "$PHP_SELF?&user=$user&id=$id";?>&action=reply"><center><table width=90% border=0 cellspacing="1" bgcolor="#000000" height="1"><tr align=center><td align=center colspan=4 width=652 bgcolor="#336699" height="18"><p><font color="#FFFFFF">���Ա�����</font></td></tr><tr><td align=center width=18% bgcolor="#F7F7F7" height="25"><p align="center">�����˺�:</p></td> <td align=center bgcolor="#F7F7F7" width="32%" height="25">&nbsp;&nbsp;&nbsp; <input type=text name=adminame size=20 class="stedit"></td><td align=center bgcolor="#F7F7F7" width="18%" height="25">��������:</td><td align=center bgcolor="#F7F7F7" width="32%" height="25"><input type=password name=password size=20 class="stedit"></td></tr><tr><td align=center width=100% bgcolor="#F7F7F7" colspan="4" height="1">�ظ����ݣ�</td></tr><tr align=center><td align=center width=100% bgcolor="#F7F7F7" colspan="4" height="119"><textarea rows="6" name="msg" cols="87" wrap=hard></textarea></td> </tr><tr align="center"><td align="center" colspan="4" width="652" bgcolor="#F7F7F7" height="27"><div align="center"><p><input type="submit" value="ȷ�ϻظ�" class="stbtm" name="replysub">&nbsp;&nbsp;&nbsp;<input type="reset" value="��������" name="B1" class="stbtm"></td></tr></table>
<?php
}
}elseif($searchsub or $action=="search"){
if($keyword=="")error("��ô��д�ؼ��֣�");
else{
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="<?php echo $admin[img];?>/style.css"><title><?php echo $title; ?></title></head>
<body bgcolor="#ffffff"><table border="0" width="100%" cellspacing="3" cellpadding="3">
<tr><td width="100%"><p align="center"><img border="0" src="<?php echo $admin[img];?>/logo.gif" width="400" height="40" alt="<?php echo $title;?>"></td>
</tr></table><table border="0" width="100%" cellpadding="2" height="12"><tr>
<td width="100%" height="6"><p align="center"><font color="#2F5E8C">[</font><a href="<?php echo $PHP_SELF;?>?action=add&user=<?php echo $user;?>"><font color="#008000">ǩд����</font></a><font color="#2F5E8C">]  
[</font><a href="<?php echo $home;?>"><font color="#008000">������ҳ</font></a><font color="#2F5E8C">]  
[</font><a href="mailto:<?php echo $email;?>"><font color="#008000">��������</font></a><font color="#2F5E8C">]  
[</font><font color="#008000">�������</font><font color="#2F5E8C">]  
[</font><a href="<?php echo $PHP_SELF;?>?action=modify&user=<?php echo $user;?>"><font color="#008000">�޸�����</font></a><font color="#2F5E8C">]  
[</font><a href="<?php echo $PHP_SELF;?>?action=admin"><font color="#008000">��������</font></a><font color="#2F5E8C">]  
[</font><a href="<?php echo $admin[img];?>/help.html"><font color="#008000">ʹ�ð���</font></a><font color="#2F5E8C">]</font></td>
</tr><tr><form method="POST" action="<?php echo $PHP_SELF;?>?action=search&user=<?php echo $user;?>"><td width="100%" height="6">
<p align="center">�ؼ��֣�<input size="20" class="stedit" name="keyword">&nbsp;&nbsp;&nbsp;<input name="searchsub" type="submit" value="��������" class="stbtm"></p></td></form></tr></table>
<div align="center"><?php echo $admin[up];?><?php echo $up;?></div>
<TABLE bgColor=#000000 border=0 cellPadding=0 cellSpacing=0 width="90%" align="center" height="8">
<CENTER></center><TR bgColor=#ffffff><TD bgColor=#000000><TABLE border=0 cellPadding=3 cellSpacing=1 height=8 width="100%"><CENTER></center><TR><CENTER>
<TD bgColor=#2f5e8c height=19 width=155><font color="#ffffff">&nbsp;������Ϣ</font></TD>
</center><TD bgColor=#2f5e8c height=19 width=503> 
<p align="left"><font color="#ffff00">&nbsp;��������</font></p></TD>
</TR></TABLE></TR></TABLE>
<!-- Start -->
<?php
  flush();
  if(empty($page))$page=1;
  $start=($page-1)*$admin[page]+1; #�õ���ʼ����
  $list=fopen($admin[path]."/$user.dat","r");
  if($page!=1 and $page!=0){
    $i=0;
    while($i<=$start and !(feof($list))){
	    $line=getline($list);
	    if(strpos($line,$keyword)){
	      $i++;
	    }
	}
  }
  $i=0;
  while($i<=$admin[page] and !(feof($list))){
    $line=getline($list);
	if(strpos($line,$keyword)){
    if($line!="")  output($line,$i);
	$i++;
	}
  }
  fclose($list);
?>
<!-- ended -->
<table border="0" width="100%" height="1" cellpadding="0">  
<tr><td width="100%" height="1"><p align="center"><font color="#004080">&nbsp;<br>
ҳ����&nbsp;
<?php
    $j=$page-1;
	echo "||<a href=$PHP_SELF?user=$user&page=$j&action=search&keyword=$keyword><font color = #8080FF>��һҳ</font></a>||";
	$j=$page+1;
	echo "<a href=$PHP_SELF?user=$user&page=$j&action=search&keyword=$keyword><font color = #8080FF>��һҳ</font></a>||";
}
?>
</font></td></tr></table><HR noShade SIZE=1 width="80%" color="#000000"><div align="center"><center>
<div align="center"><?php echo $admin[down];?><?php echo $down;?></div>
<TABLE border=0 cellSpacing=4 width=545><TBODY><TR align=middle><TD class=unnamed1 width=533>
<P align=center>������Ա���<FONT color=#cc0033> </FONT><FONT color=#ff6633><B><FONT sans-serif Helvetica,><A href="<?php echo $admin[home];?>" target=_blank><?php echo $admin[homename];?></A></FONT></B></FONT><FONT color=#cc0033> </FONT>�ṩ   
����֧�֣�<B><A href="mailto:wyx726@126.com" target=_blank>����ϰϰ</A></B></P></TD></TR></TBODY></TABLE></center></div>
</body></html>
<?php
}elseif($action=="reg"){
if($regsub){
$file="$admin[path]/$name.dat";
if($name==""or$email==""or$home==""or$home=="http://"or$password2<>$password1)error("��������ĸ���������˰���������д�ɣ�");
elseif($password1=="")error("���붼��д��������˺����㰢���Բ�����");
elseif(file_exists($file))error("����û����Ѿ������������˰�����һ���ɣ�");
else{
  $user=$name;
  echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
  echo "<HTML><HEAD><TITLE>��������</TITLE>";
	echo "<META content=\"text/html; charset=gb2312\" http-equiv=Content-Type>";
	echo "<link rel=\"stylesheet\" href=\"$admin[img]/style.css\">";
	echo "</head><body topmargin=\"0\"><br>";
	echo "<ul>��ϲ���ɹ��������Բ�.<br>";
    echo "&nbsp;<br>��ȴ� ϵͳ���ڴ���������Բ�...<br>";
    echo "&nbsp;<br></font>";
	echo "<a href=$admin[gb]?user=$user>������������Բ������ӣ�$admin[gb]?user=$user.";
	echo "</font></a></ul>";
  flush();
  $file2="$admin[path]/user.list";
  $list=fopen($file2,"r");
  $num=chop(fgets($list,15));
  $num++;
  $old=fread($list,filesize($file2));
  $writemsg="$num\n$name|!:!|$password1|!:!|$email|!:!|$home|!:!|$title\n$old";
  $list=fopen($file2,"w");
  fwrite($list,$writemsg);
  fclose($list);
  $data=fopen($file,"w");
  fwrite($data,"0");
  fclose($data);
  $file="$admin[path]/$name.php";
  $data=fopen($file,"w");
  fwrite($data,"<?php\n");
  fwrite($data,"\$title=\"$title\";\n");
  fwrite($data,"\$pass=\"$password1\";\n");
  fwrite($data,"\$home=\"$home\";\n");
  fwrite($data,"\$email=\"$email\";\n");
  fwrite($data,"\$admin[page]=\"$page\";\n");
  fwrite($data,"\$admin[ubb]=\"$ubb\";\n");
  fwrite($data,"\$admin[html]=\"$html\";\n");
  fwrite($data,"\$up=\"$up\";\n");
  fwrite($data,"\$down=\"$down\";\n");
  fwrite($data,"?>");
  fclose($data);
}}else{
?>
<html><head><link rel="stylesheet" href="<?php echo $admin[img];?>/style.css"><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�û�����</title></head><body bgcolor="#ffffff"><form method="POST" action="<?php echo $PHP_SELF;?>?action=reg" align="center"><div align="center"><table border="0" width="615" height="217" bgcolor="#000000" cellspacing="1"><center><tr><td width="615" height="13" bgcolor="#336699" colspan="2"> 
<div align="center"><center><p><font color=#F7F7F7> �������Ա�</font></center></div></td></tr>
<tr align="center"><td width="100" height="23" valign="middle" align="left" bgcolor="#F7F7F7"> 
<p align="center">�� �� ����</p></td>
          <td width="503" height="23" valign="middle" align="left" bgcolor="#F7F7F7"> 
            <input type="text" name="name" size="20" maxlength=8 class="stedit">
            &nbsp;&nbsp;&nbsp;&nbsp; * 1-8λ�������û�����</td>
        </tr>
        <tr align="center"> 
          <td width="100" height="18" valign="middle" align="left" bgcolor="#F7F7F7"> 
            <p align="center">�û����룺</p>
          </td>
          <td width="503" height="18" valign="middle" align="left" bgcolor="#F7F7F7"> 
            <input type="password" 
name="password1" size="20" maxlength="8" class="stedit">
            &nbsp;&nbsp;&nbsp;&nbsp; * 1-8λ�����������룩</td>
        </tr>
        <tr align="center"> 
          <td width=100 height=16 valign=middle align=left bgcolor="#F7F7F7"> 
            <p align="center">�ظ����룺</p>
          </td>
          <td width="503" height="16" valign="middle" align="left" bgcolor="#F7F7F7"> 
            <input type="password" 
name="password2" size="20" maxlength="8" class="stedit">
            &nbsp;&nbsp;&nbsp;&nbsp; * 1-8λ�����������룩</td>
        </tr>
      </center>
      <tr align="center"> 
        <td width="100" height="22" valign="middle" align="left" bgcolor="#F7F7F7"> 
          <p align="center">�����ʼ���</p>
        </td>
        <center>
          <td width="503" height="22" valign="middle" align="left" bgcolor="#F7F7F7"> 
            <input type="text" 
name="email" size="20" class="stedit">
            &nbsp;&nbsp;&nbsp;&nbsp; * �ʼ���ַ���ʼ�֪ͨ��</td>
        </center>
      </tr>
      <tr align="center"> 
        <td width="100" height="14" valign="middle" align="left" bgcolor="#F7F7F7"> 
          <p align="center">��ҳ��ַ��</p>
        </td>
        <td width="503" height="14" valign="middle" align="left" bgcolor="#F7F7F7"> 
          <input type="text" 
name="home" value = "http://" size="20" class="stedit">
          &nbsp;&nbsp;&nbsp;&nbsp; * ��ҳ��ַ</td>
      </tr>
      <tr> 
        <td width="100" height="3" valign="middle" align="left" bgcolor="#F7F7F7"> 
          <p align="center">���Ա�����</p>
        </td>
        <td width="503" height="3" valign="middle" align="left" bgcolor="#F7F7F7"> 
          <input type="text" name="title" 
size="20" value="�ҵ����Ա�" class="stedit">
          &nbsp;&nbsp;&nbsp;&nbsp; * ������Ա�������</td>
      </tr>
      <tr align="center"> 
        <td width="100" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
          <p align="center">UBB ֧�֣�</p>
        </td>
        <td width="503" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
          <select name="ubb">
            <option value="1">֧��</option>
            <option value="0">��֧��</option>
          </select>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          &nbsp;* Ĭ��֧��</td>
      </tr>
      <tr align="center"> 
        <td width="100" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
          <p align="center">HTMl֧�֣�</p>
        </td>
        <td width="503" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
          <select name="html">
            <option value="1">֧��</option>
            <option value="0">��֧��</option>
          </select>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          &nbsp;* Ĭ��֧��</td>
      </tr>
      <tr align="center"> 
        <td width="100" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
          <p align="center">ÿҳ��¼��</p>
        </td>
        <td width="503" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
          <select name="page">
            <option value="2">2</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
          </select>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          &nbsp;* Ĭ��Ϊ2��</td>
      </tr>
      <tr align="center"> 
        <td width="100" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
          <p align="center">ͷ��HTMl��</p>
        </td>
        <td width="503" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
          <input type="text" name="up" size="50" class="stedit">
          *���Բ�ͷ����HTML���� </td>
      </tr>
      <tr align="center"> 
        <td width="100" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
          <p align="center">β��HTML��</p>
        </td>
        <td width="503" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
          <input type="text" name="down" size="50" class="stedit">
          *���Բ�β����HTML���� </td></tr><tr align="center"> 
<td width="603" height="10" valign="middle" align="left" colspan="2" bgcolor="#F7F7F7"><div align="center"> <center>
<p> <input type="submit" value="�ύ����" name="regsub" class="stbtm">&nbsp;&nbsp;<input type="reset"
value="��������" name="reset" class="stbtm"></center></div></td></tr></table>
<table border="0" width="600">
<tr align=middle>
<td class=unnamed1 width=533>
<p align="center">������Ա���<font color=#cc0033> </font><font color=#ff6633><b><font Helvetica, sans-serif><a href=<?php echo $admin[homename];?>  target=_blank><?php echo $admin[homename];?></a></font></b></font><font color=#cc0033> 
</font>�ṩ ����֧�֣�<b><a href="mailto:wyx726@126.com" target=_blank>����ϰϰ</a></b></p>
</td></tr></table></div></form></body></html>
<?php
}}elseif($action=="modify"){
if($modsub){
$file="$admin[path]/$user.php";
if($password1==$pass){
  echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
  echo "<HTML><HEAD><TITLE>��������</TITLE>";
	echo "<META content=\"text/html; charset=gb2312\" http-equiv=Content-Type>";
	echo "<link rel=\"stylesheet\" href=\"$admin[img]/style.css\">";
	echo "<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2;URL=$PHP_SELF?user=$user\">";
	echo "</head><body topmargin=\"0\"><br>";
	echo "<ul>�ɹ��޸��������Բ�������.<br>";
    echo "&nbsp;<br>��ȴ� ϵͳ�����޸�...<br>";
    echo "&nbsp;<br></font>";
	echo "<a href=$PHP_SELF?user=$user>�����������û���Զ��ķ��ص����Բ���ҳ�������㲻���ٵȴ���������ﷵ��.";
	echo "</font></a></ul>";
  flush();
  $file="$admin[path]/$user.php";
  $data=fopen($file,"w");
  fwrite($data,"<?php\n");
  fwrite($data,"\$title=\"$titlenew\";\n");
  fwrite($data,"\$pass=\"$password2\";\n");
  fwrite($data,"\$home=\"$homenew\";\n");
  fwrite($data,"\$email=\"$emailnew\";\n");
  fwrite($data,"\$admin[page]=\"$pagenew\";\n");
  fwrite($data,"\$admin[ubb]=\"$ubbnew\";\n");
  fwrite($data,"\$admin[html]=\"$htmlnew\";\n");
  fwrite($data,"\$up=\"$upnew\";\n");
  fwrite($data,"\$down=\"$downnew\";\n");
  fwrite($data,"?>");
  fclose($data);
}else error("���԰������������ˣ�");
}else{
$file="$admin[path]/$user.php";
?>
<html><head><link rel="stylesheet" href="<?php echo $admin[img];?>/style.css"><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�û����Բ������޸�</title></head><body bgcolor="#ffffff"><form method="POST" action="<?php echo $PHP_SELF;?>?user=<?php echo $user;?>&action=modify" align="center"><div align="center"><table border="0" width="615" height="217" bgcolor="#000000" cellspacing="1"><center><tr><td width="615" height="13" bgcolor="#336699" colspan="2"> 
<div align="center"><center><p><font color=#F7F7F7> �޸����Ա�����</font></center></div></td></tr>
<tr align="center"><td width="100" height="18" valign="middle" align="left" bgcolor="#F7F7F7"> 
<p align="center">�û����룺</p></td>
<td width="503" height="18" valign="middle" align="left" bgcolor="#F7F7F7"> 
<input type="password" name="password1" size="20" maxlength="8" class="stedit">
&nbsp;&nbsp;&nbsp;&nbsp; * 1-8λ��ԭ�����������룩</td>
</tr><tr align="center"><td width=100 height=16 valign=middle align=left bgcolor="#F7F7F7"> 
<p align="center">�޸����룺</p></td>
<td width="503" height="16" valign="middle" align="left" bgcolor="#F7F7F7"> 
<input type="password" name="password2" size="20" maxlength="8" class="stedit">
&nbsp;&nbsp;&nbsp;&nbsp; * 1-8λ�����ڰ��������룩</td>
</tr></center><tr align="center"><td width="100" height="22" valign="middle" align="left" bgcolor="#F7F7F7"><p align="center">�����ʼ���</p></td><center>
<td width="503" height="22" valign="middle" align="left" bgcolor="#F7F7F7"> 
<input type="text" name="emailnew" size="20" class="stedit" value="<?php echo $email;?>">
&nbsp;&nbsp;&nbsp;&nbsp; * �ʼ���ַ���ʼ�֪ͨ��</td>
</center></tr><tr align="center"><td width="100" height="14" valign="middle" align="left" bgcolor="#F7F7F7"><p align="center">��ҳ��ַ��</p></td>
<td width="503" height="14" valign="middle" align="left" bgcolor="#F7F7F7"> 
<input type="text" name="homenew"  value="<?php echo $home;?>" size="20" class="stedit">
&nbsp;&nbsp;&nbsp;&nbsp; * ��ҳ��ַ</td></tr><tr> 
<td width="100" height="3" valign="middle" align="left" bgcolor="#F7F7F7"> 
<p align="center">���Ա�����</p></td>
<td width="503" height="3" valign="middle" align="left" bgcolor="#F7F7F7"> 
<input type="text" name="titlenew" size="20"  value="<?php echo $title;?>" class="stedit">
&nbsp;&nbsp;&nbsp;&nbsp; * ������Ա�������</td>
</tr><tr align="center"><td width="100" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
<p align="center">UBB ֧�֣�</p></td>
<td width="503" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
<select name="ubbnew"><option value="1">֧��</option><option value="0">��֧��</option></select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
&nbsp;* Ĭ��֧��</td></tr><tr align="center"> 
<td width="100" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
<p align="center">HTMl֧�֣�</p></td>
<td width="503" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
<select name="htmlnew"><option value="1">֧��</option><option value="0">��֧��</option>          </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
&nbsp;* Ĭ��֧��</td></tr><tr align="center">
<td width="100" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
<p align="center">ÿҳ��¼��</p></td>
<td width="503" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
<select name="pagenew"><option value="2">2</option><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="20">20</option></select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
&nbsp;* Ĭ��Ϊ2��</td></tr><tr align="center"> 
<td width="100" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
<p align="center">ͷ��HTMl��</p></td>
<td width="503" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
<input type="text" name="upnew" size="50" class="stedit"  value="<?php echo $up;?>">
*���Բ�ͷ����HTML���� </td>
</tr><tr align="center"><td width="100" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
<p align="center">β��HTML��</p></td>
<td width="503" height="13" valign="middle" align="left" bgcolor="#F7F7F7"> 
<input type="text" name="downnew" size="50" class="stedit" value="<?php echo $down;?>">
*���Բ�β����HTML���� </td></tr><tr align="center"> 
<td width="603" height="10" valign="middle" align="left" colspan="2" bgcolor="#F7F7F7"><div align="center"> <center>
<p> <input type="submit" value="�ύ����" name="modsub" class="stbtm">&nbsp;&nbsp;<input type="reset"
value="��������" name="reset" class="stbtm"></center></div></td></tr></table>
<table border="0" width="600">
<tr align=middle>
<td class=unnamed1 width=533>
<p align="center">������Ա���<font color=#cc0033> </font><font color=#ff6633><b><font Helvetica, sans-serif><a href=<?php echo $admin[homename];?>  target=_blank><?php echo $admin[homename];?></a></font></b></font><font color=#cc0033> 
</font>�ṩ ����֧�֣�<b><a href="mailto:wyx726@126.com" target=_blank>����ϰϰ</a></b></p>
</td></tr></table></div></form></body></html>
<?php
}}elseif($action=="admin"){
if($adminsub or $page<>""){
if($password<>$admin[password]){
error("����ð�����Ա��");
}else{
?><html><head><meta http-equiv=Content-Type content=text/html; charset=gb2312><title>���Բ�����Ա������</title><link rel=stylesheet href=<?php echo $admin[img];?>/style.css></head><body bgcolor=#ffffff><p align=center><font color=>���Բ�����Ա�����ڣ�����<?php
$file=$admin[path]."/user.list";
$data=fopen($file,r);
$num=chop(fgets($data,15));
echo $num;
?>���û���</font></p><font color=><div align=center><center><table border=0 width=100% height=9 bgcolor=#000000 cellspacing=1><tr align=center><td width=29 height=1 bgcolor=#336699 align=center><font color=#FFFFFF>����</font></td><td width=145 height=1 bgcolor=#336699 align=center><div align=center><p><font color=#FFFFFF>���Ա���</font></div>    </td><td width=52 height=1 bgcolor=#336699 align=center><div align=center><p><font color=#FFFFFF>�û���</font></div></td><td width=49 height=1 bgcolor=#336699 align=center><font color=#FFFFFF>����</font></td><td width=172 height=1 bgcolor=#336699 align=center><font color=#FFFFFF>��վ��ַ</font></td></tr>
<!-- start -->
<?php
$start=($page-1)*$admin[page]+1;
if($page!=1){
  for($i=1;$i<$start;$i++){
    $trash=fgets($data,5000);
  }
}
$end=$start+$admin[page];
for($i=$start;$i<$end;$i++){
$line=getline($data);
if($line<>""){
$info=explode("|!:!|",$line);
echo"<tr align=center><td width=29 align=center bgcolor=#FFFFFF valign=middle><p align=center><a href=$PHP_SELF?action=admin&id=$info[0]&password=$password><img src=image/del.gif width=11 height=11 border=0></a></p></td><td width=145 align=center bgcolor=#FFFFFF valign=middle><a href=$PHP_SELF?user=$info[0] target = _blank><font color=#0080FF>$info[4]</font></a></td><td width=52 align=center valign=middle bgcolor=#FFFFFF><a href=mailto:$info[2]><font color=#0080FF>$info[0]</font></a></td><td width=49 align=center valign=middle bgcolor=#FFFFFF><font color=#0080FF>$info[1]</font></td><td width=172 align=center valign=middle bgcolor=#FFFFFF><a href=$info[3] target = _blank><font color=#0080FF>$info[3]</font></a></td></tr>";
}}
?>
<!-- ended -->
</table></center><center><table border=0 width=100% bgcolor=#000000 cellspacing=1>
<tr><td colspan=2 align=center valign=middle bgcolor=#336699><font color=#FFFFFF>ҳ����
<?php
for($i=0;$i<$num/$admin[page];$i++){
    $j=$i+1;
    echo "<a href=$PHP_SELF?action=admin&page=$j&password=$password><font color = #FFFFFF>[";
	echo $j;
	echo "]</font></a>&nbsp;";
}
?></font></td></tr></table><p>&nbsp;</p></center></div>
<p align=center>������Ա���<font color=#cc0033></font><font color=#ff6633><b><font Helvetica, sans-serif><a href=<?php echo  $admin[home]?> target=_blank><?php echo $admin[homename]?></a></font></b></font><font color=#cc0033></font>�ṩ ����֧�֣�<b><a href="mailto:wyx726@126.com" target=_blank>����ϰϰ</a></b></p></font></body></html>
<?php
}
}elseif($id<>""){
  echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
  echo "<HTML><HEAD><TITLE>��������</TITLE>";
	echo "<META content=\"text/html; charset=gb2312\" http-equiv=Content-Type>";
	echo "<link rel=\"stylesheet\" href=\"$admin[img]/style.css\">";
	echo "<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2;URL=$PHP_SELF?action=admin&password=$password&page=1\">";
	echo "</head><body topmargin=\"0\"><br>";
	echo "<ul>����ɾ���û��ɹ�.<br>";
    echo "&nbsp;<br>��ȴ� ϵͳ����ɾ������û�...<br>";
    echo "&nbsp;<br></font>";
	echo "<a href=$PHP_SELF?action=admin&password=$password&page=1>�����������û���Զ��ķ��ص���������ҳ�������㲻���ٵȴ���������ﷵ��.";
	echo "</font></a></ul>";
  flush();
  $file=$admin[path]."/user.list";
  $data=fopen($file,"r");
  $num=chop(fgets($data,15));
  $num--;
  $headdata="";$sign=1;
  While($sign){
  	$headdata=$headdata.$temp;
    $temp=fgets($data,5000);
	$line=explode("|!:!|",$temp);
    if($line[0]==$id) $sign=0;
	if(feof($data)){error("û���ҵ�����û������Բ�����"); exit;}
  }
  $footdata=fread($data,filesize($file));
  fclose($data);
  $writemsg=$num."\n".$headdata.$footdata;
  $data=fopen($file,"w");
  fwrite($data,$writemsg);
  fclose($data);
  unlink($admin[path]."/$id.dat");
  unlink($admin[path]."/$id.php");
}else{
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312"><link rel="stylesheet" href="<?php echo $admin[img];?>/style.css"></head><body bgcolor="#ffffff"><form method="post" action="<?php echo $PHP_SELF;?>?action=admin"><center><table width=90% border=0 cellspacing="1" bgcolor="#000000"><tr align=center><td align=center colspan=4 width=652 bgcolor="#336699"><font color="#FFFFFF">����Ա��½</font></td></tr><tr align=center><td align=center width=18% bgcolor="#F7F7F7"><p align="center">�����˺�:</p></td> <td align=center bgcolor="#F7F7F7" width="32%">&nbsp;&nbsp;&nbsp; <input type=text name=name size=20 class="stedit"></td><td align=center bgcolor="#F7F7F7" width="18%">��������:</td><td align=center bgcolor="#F7F7F7" width="32%"><input type=password name=password size=20 class="stedit"></td></tr> <tr align="center"><td align="center" colspan="4" width="652" bgcolor="#F7F7F7"><div align="center"><p><input name=adminsub type="submit" value="������½" class="stbtm">&nbsp;&nbsp;&nbsp;<input type="reset" value="��������" name="B1" class="stbtm"></td></tr>
<?php
}}else{
$file="$admin[path]/$user.dat";
$data=fopen($file,"r");
$num=chop(fgets($data,15));
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="<?php echo $admin[img];?>/style.css"><title><?php echo $admin[homename];?></title></head>
<body bgcolor="#ffffff"><table border="0" width="100%" cellspacing="3" cellpadding="3">
<tr><td width="100%"><p align="center"><img border="0" src="<?php echo $admin[img];?>/logo.gif" width="400" height="40" alt="<?php echo $title;?>"></td>
</tr></table><table border="0" width="100%" cellpadding="2" height="12"><tr>
<td width="100%" height="6"><p align="center"><font color="#2F5E8C">[</font><a href="<?php echo $PHP_SELF;?>?action=add&user=<?php echo $user;?>"><font color="#008000">ǩд����</font></a><font color="#2F5E8C">]  
[</font><a href="<?php echo $home;?>"><font color="#008000">������ҳ</font></a><font color="#2F5E8C">]  
[</font><a href="mailto:<?php echo $email;?>"><font color="#008000">��������</font></a><font color="#2F5E8C">]  
[</font>

<font color="#008000">�������</font><font color="#2F5E8C">]  
[</font><a href="<?php echo $PHP_SELF;?>?action=modify&user=<?php echo $user;?>"><font color="#008000">�޸�����</font></a><font color="#2F5E8C">]  
[</font><a href="<?php echo $PHP_SELF;?>?action=admin"><font color="#008000">��������</font></a><font color="#2F5E8C">]  
[</font><a href="<?php echo $admin[img];?>/help.html"><font color="#008000">ʹ�ð���</font></a><font color="#2F5E8C">]</font></td>
</tr><tr><form method="POST" action="<?php echo $PHP_SELF;?>?action=search&user=<?php echo $user;?>"><td width="100%" height="6">
<p align="center">�����ؼ��֣�<input size="20" class="stedit" name="keyword">&nbsp;&nbsp;&nbsp;<input name="searchsub" type="submit" value="��������" class="stbtm"></p></td></form></tr></table>
<div align="center"><?php echo $admin[up];?><?php echo $up;?></div>
<TABLE bgColor=#000000 border=0 cellPadding=0 cellSpacing=0 width="90%" align="center" height="8">
<CENTER></center><TR bgColor=#ffffff><TD bgColor=#000000><TABLE border=0 cellPadding=3 cellSpacing=1 height=8 width="100%"><CENTER></center><TR><CENTER>
<TD bgColor=#2f5e8c height=19 width=155><font color="#ffffff">&nbsp;������Ϣ</font></TD>
</center><TD bgColor=#2f5e8c height=19 width=503> 
<p align="left"><font color="#ffff00">&nbsp;�������ݣ�����������<?php echo $num;?>��</font></p></TD>
</TR></TABLE></TR></TABLE>
<!-- Start -->
<?php
if(empty($page)){$page=1;}
$start=($page-1)*$admin[page]+1;
if($page!=1){
  for($i=1;$i<$start;$i++){
    $trash=fgets($data,5000);
  }
}
$end=$start+$admin[page];
for($i=$start;$i<$end;$i++){
$line=getline($data);
if($line<>"")output($line,$i);
}
?>
<!-- ended -->
<table border="0" width="100%" height="1" cellpadding="0">  
<tr><td width="100%" height="1"><p align="center"><font color="#004080">&nbsp;<br>
ҳ����&nbsp;
<?php
for($i=0;$i<$num/$admin[page];$i++){
    $j=$i+1;
    echo "<a href=$PHP_SELF?user=$user&page=$j><font color = #8080FF>[";
	echo $j;
	echo "]</font></a>&nbsp;";
}
?>
</font></td></tr></table><HR noShade SIZE=1 width="80%" color="#000000"><div align="center"><center>
<div align="center"><?php echo $admin[down];?><?php echo $down;?></div>
<TABLE border=0 cellSpacing=4 width=545><TBODY><TR align=middle><TD class=unnamed1 width=533>
<P align=center>������Ա���<FONT color=#cc0033> </FONT><FONT color=#ff6633><B><FONT sans-serif Helvetica,><A href="<?php echo $admin[home];?>" target=_blank><?php echo $admin[homename];?></A></FONT></B></FONT><FONT color=#cc0033> </FONT>�ṩ   
����֧�֣�<B><A href="mailto:wyx726@126.com" target=_blank>����ϰϰ</A></B></P></TD></TR></TBODY></TABLE></center></div>
</body></html>
<?php
}
}
?>