<?php
require "conf/config.php";
session_start();

if ($id)
  $str="select id,caption,thing,data,DATE_FORMAT(date,\"%Y��%m��%d��\") as date from $vote_t where id=$id";
else
  $str="select id,caption,thing,data,DATE_FORMAT(date,\"%Y��%m��%d��\") as date from $vote_t order by id DESC limit 1";
$db->query($str);
$db->next_record();
$caption=stripslashes($db->f('caption'));
$thing=stripslashes($db->f('thing'));
$thing2=explode(";",$thing);
$data2=explode(";",$db->f('data'));

//�����ͶƱ������д���
if ($vote && $HTTP_COOKIE_VARS["CookVote"]!="vote")
{
for($i=0;$i<count($thing2);$i++)
   if ($vote==$i) $data2[$i]++;
$data=join(";",$data2);
$db2->query("update $vote_t set data='$data' where id=".$db->f('id'));
setcookie("CookVote","vote",time()+60*60*24*2); //��ֹ�ظ�ͶƱ����Чʱ�䣬2��
}

//�õ�ͶƱ������
$all=0;
foreach ($data2 as $this)
  $all+=$this;
?>
<html>
<head>
<title><?php echo $sitename ?> -- ������</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<p>&nbsp;</p>
<center class="p14">
  <font color="#333399">
  ����: 
  <?php echo $caption ?>
  ����ʱ�䣺 <?php echo $db->f('date') ?>
  ����<?php echo $all ?>�˲μ�ͶƱ </font> 
</center>
<table width="600" border="0" cellpadding="3" cellspacing="2" align="center">
  <tr align="center" bgcolor="#ff9900"> 
    <td width="97" ><strong><font color="#FFFFFF">������Ŀ</font></strong></td>
    <td width="358" ><strong><font color="#FFFFFF">ͼ ʾ</font></strong></td>
    <td width="51" ><strong><font color="#FFFFFF">����</font></strong></td>
    <td width="60" ><strong><font color="#FFFFFF">��Ʊ��</font></strong></td>
  </tr>
<?php
for($i=0;$i<count($thing2);$i++)
{ 
	$long=@(int)(350*$data2[$i]/$all);
	$rote=sprintf("%001.1f", @(100*($data2[$i]/$all)));;
?>
  <tr bgcolor='#F6F6F6'> 
    <td width="97">
      <?php echo $thing2[$i]; ?>
    </td>
    <td width="358"><img src="images/back.jpg" height="8" width="<?php echo $long ?>"></td>
    <td style='color:red' align=center width="51"><?php echo $rote ?>%</td>
    <td width="60"> 
      <?php echo $data2[$i]; ?>
    </td>
  </tr>
<?php } ?>
</table>
</body>
</html>
