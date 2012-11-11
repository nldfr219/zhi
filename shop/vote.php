<?php
require "conf/config.php";
session_start();

if ($id)
  $str="select id,caption,thing,data,DATE_FORMAT(date,\"%Y年%m月%d日\") as date from $vote_t where id=$id";
else
  $str="select id,caption,thing,data,DATE_FORMAT(date,\"%Y年%m月%d日\") as date from $vote_t order by id DESC limit 1";
$db->query($str);
$db->next_record();
$caption=stripslashes($db->f('caption'));
$thing=stripslashes($db->f('thing'));
$thing2=explode(";",$thing);
$data2=explode(";",$db->f('data'));

//如果有投票，则进行处理
if ($vote && $HTTP_COOKIE_VARS["CookVote"]!="vote")
{
for($i=0;$i<count($thing2);$i++)
   if ($vote==$i) $data2[$i]++;
$data=join(";",$data2);
$db2->query("update $vote_t set data='$data' where id=".$db->f('id'));
setcookie("CookVote","vote",time()+60*60*24*2); //防止重复投票的有效时间，2天
}

//得到投票的总数
$all=0;
foreach ($data2 as $this)
  $all+=$this;
?>
<html>
<head>
<title><?php echo $sitename ?> -- 调查结果</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<p>&nbsp;</p>
<center class="p14">
  <font color="#333399">
  主题: 
  <?php echo $caption ?>
  发起时间： <?php echo $db->f('date') ?>
  共有<?php echo $all ?>人参加投票 </font> 
</center>
<table width="600" border="0" cellpadding="3" cellspacing="2" align="center">
  <tr align="center" bgcolor="#ff9900"> 
    <td width="97" ><strong><font color="#FFFFFF">调查项目</font></strong></td>
    <td width="358" ><strong><font color="#FFFFFF">图 示</font></strong></td>
    <td width="51" ><strong><font color="#FFFFFF">比率</font></strong></td>
    <td width="60" ><strong><font color="#FFFFFF">得票数</font></strong></td>
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
