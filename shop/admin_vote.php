<?php
require "conf/config.php";
include "admin_check.php";

if ($Submit)
{
   $aryid=@implode(",",$delete);
   $db2->query("delete from $vote_t where id in($aryid)");
   $result="ɾ���ɹ���";
}
?>
<html>
<head>
<title><?php echo $sitename ?> -- �������</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/admin.php"; ?>
<?php include "js_setselect.php"; ?>
<table width="750" align="center">
  <tr align="center"> 
    <td bgcolor="#EFEFEF"> 
      <p class="p13"><br>
        ������� </p>
 <?php echo "<p class=\"p13\">$result</p>";
if ($action=="")
{
  if (!$page) $page=1;
  $db->query("select null from $vote_t");
  $total_num=$db->num_rows();//�õ��ܼ�¼��
  $totalpage=ceil($total_num/$num_to_show);//�õ���ҳ��
  $init_record=($page-1)*$num_to_show;
  $db->query("select id,caption,date from $vote_t
   order by id DESC limit $init_record, $num_to_show");        
?>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF ?> " method="post" name="form8" onSubmit="return check_page('form8.page')">
          <tr> 
            <td align="right"> <a href="admin_vote.php?action=insert" class="clink03">����µĵ���</a>���ܼ�: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>��  ҳ&nbsp;��һҳ</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1&&up_id=$up_id&sf=$sf&key=$key'>��  ҳ</a>&nbsp;<a href='$PHP_SELF?page=$page1&&up_id=$up_id&sf=$sf&key=$key'>��һҳ</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>��һҳ&nbsp;β  ҳ</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2&&up_id=$up_id&sf=$sf&key=$key'>��һҳ</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&&up_id=$up_id&sf=$sf&key=$key'>β  ҳ</a>&nbsp;"; 
?>
              ��ǰҳ:<b> 
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
              ת���� 
              <input type="text" name="page" size="2">
              <input type="submit" name="Submit22" value="GO">
            </td>
          </tr>
        </form>
      </table>
	  <form name="form_sele" method="post" action="">
      <table width="98%" border="1" class="black" cellspacing="1" cellpadding="3" bordercolor="#FFFFFF" bgcolor="#D3E3FE">
        <tr> 
          <td colspan="6" align="center"> 
            <input type="checkbox" name="deleteall" value="on" onClick="CheckAll(this.form,this.checked)"   >
            <font color="#CC3366">ȫѡ </font> �� 
              <input type="submit" name="Submit" value="ɾ��" onClick="if(!confirm('ȷ��Ҫɾ����Щ��')) return false;" class="stbtm2">
          </td>
        </tr>
        <tr> 
            <td width="8%" align="center">���</td>
            <td width="55%" align="center">��������</td>
            <td width="15%" align="center">��������</td>
            <td width="10%" align="center">�鿴���</td>
            <td width="6%" align="center">�޸�</td>
            <td width="6%" align="center">ɾ��</td>
        </tr>
        <?php
		   while($db->next_record())
			   {
			   $i++;
			   ?>
        <tr> 
            <td width="8%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php echo $db->f('id') ?>
            </td>
            <td width="55%" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php echo stripslashes($db->f('caption')) ?>
            </td>
            <td width="15%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php echo $db->f('date') ?>
            </td>
            <td width="10%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <a href="vote.php?id=<?php echo $db->f('id') ?>" target="_blank" class="clink03">�鿴���</a> 
            </td>
            <td width="6%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php 
    $link_order = "action=update&id=".$db->f('id');
    echo "<a href=\"?$link_order\">";
    echo '<img src="images/xg.gif" alt="�� ��" border="0"></a>';
    ?>
            </td>
            <td width="6%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <input type="checkbox" name="delete[]" value="<?php echo $db->f('id') ?>">
          </td>
        </tr> 
		   <?php } ?>
        <tr> 
          <td colspan="6" align="center">
              <input type="checkbox" name="deleteall" value="on" onClick="CheckAll(this.form,this.checked)"   >
            <font color="#CC3366">ȫѡ </font> �� 
              <input type="submit" name="Submit" value="ɾ��" onClick="if(!confirm('ȷ��Ҫɾ����Щ��')) return false;" class="stbtm2">
          </td>
        </tr>    
      </table>
	  </form>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF ?> " method="post" name="form88" onSubmit="return check_page('form88.page')">
          <tr> 
            <td align="right"> <a href="admin_vote.php?action=insert" class="clink03">����µĵ���</a>���ܼ�: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>��  ҳ&nbsp;��һҳ</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1&&up_id=$up_id&sf=$sf&key=$key'>��  ҳ</a>&nbsp;<a href='$PHP_SELF?page=$page1&&up_id=$up_id&sf=$sf&key=$key'>��һҳ</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>��һҳ&nbsp;β  ҳ</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2&&up_id=$up_id&sf=$sf&key=$key'>��һҳ</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&&up_id=$up_id&sf=$sf&key=$key'>β  ҳ</a>&nbsp;"; 
?>
              ��ǰҳ:<b> 
              <?php echo $page."/".$totalpage ?>
              </b>&nbsp; ת���� 
              <input type="text" name="page" size="2">
              <input type="submit" name="Submit222" value="GO">
            </td>
          </tr>
        </form>
      </table>
      <?php
}
else
{
if ($usage!=1)
{
          $db->query("select caption,thing from $vote_t where id=$id");
          $db->next_record();
      	  $caption=stripslashes($db->f('caption'));
      	  $thing=str_replace(";","\n",stripslashes($db->f('thing')));
 	switch ($action)
	{
		case "insert":
			$result = "�������";
			break;
		case "update":
			$result = "�޸ĵ���";
	}
?>
      <form name="form1" method="post" action="" onSubmit="return check();">
        <table width="70%" border="1" cellspacing="0" cellpadding="2" bgcolor="#E1EAF4" align="center" bordercolor="#FFFFFF">
          <tr> 
            <td colspan="3" height="35" align="center"> <font color="#FF0000">*</font> 
              ��ʾΪ������ </td>
          </tr>
          <tr> 
            <td colspan="3" class="p13"><?php echo $result; ?> 
              <script language="JavaScript">
function check()
{
 if (document.form1.caption.value == "")
  {
    alert ("����д���������!");
    document.form1.caption.focus();
    return false;
  }
 if (document.form1.thing.value == "")
  {
    alert ("����д���������!");
    document.form1.thing.focus();
    return false;
  }
 document.form1.Submit.disabled=true;
 document.form1.Submit2.disabled=true;
}
</script>
              <input type="hidden" name="action" value="<?php echo $action ?>">
              <input type="hidden" name="usage" value="1">
              <input type="hidden" name="id" value="<?php echo $id ?>">
            </td>
          </tr>
          <tr> 
            <td width="32%"> 
              <p>�ڱ༭�����������ݣ�</p>
              <p>ÿһ��Ϊһ������ѡ�</p>
            </td>
            <td width="50%">����: 
              <input type="text" name="caption" size="25" maxlength="100" value="<?php echo htmlspecialchars($caption) ?>">
              <textarea name="thing" cols="30" rows="10"><?php echo $thing ?></textarea>
            </td>
            <td width="18%" align="center"> 
              <input type="submit" name="Submit" value="<?php echo $result; ?>" class="stbtm2">
              <br>
              <br>
              <input type="reset" name="Submit2" value="������д" class="stbtm2">
            </td>
          </tr>
        </table>
      </form>
<?php
}
else
{
$caption=addslashes($caption);
$thing=addslashes($thing);

$thing2=explode("\n",$thing);
$thing=str_replace("\n",";",$thing);
$data="";
for($i=0;$i<count($thing2);$i++)
   $data.="0;";

switch($action)
{
 case "insert" :
     $db->query("insert into $vote_t(caption,thing,data,date) values('$caption','$thing','$data','$date_tmp')");
     $result = "��ӳɹ���";
	 break;
 case "update" :
     $db->query("update $vote_t set caption='$caption',thing='$thing' where id=$id");
     $result = "�޸ĵ��顣";
}
echo $result."���ڷ��ص���ҳ��...<meta http-equiv=\"refresh\" content=\"2;URL=admin_vote.php\"><br><br>";
 }
 }?>
    </td>
  </tr>
</table>
<br>
<u><span class="p14">������Ϣ</span></u><span class="p14">�� </span> 
<ul>
  <li><span class="p14">��վ��ҳ��&quot;��վ����&quot;��Ŀ����ʾ�ĵ���Ϊ���һ����ӵ�</span></li>
  <li><span class="p14">����&quot;����µĵ���&quot;���ӣ��������µĵ���</span></li>
  <li><span class="p14">�㡰���ġ�ͼ�꣬�޸ĵ�������⡢����ѡ�</span><span class="p13">ע�⣺�޸ĵ����ѡ��ʱ���벻Ҫ���ӻ���ɾ��һ��ѡ����򣬽�����</span></li>
  <li><span class="p14">�㡰ɾ����ͼ�꣬ȷ��ɾ����ɾ��һ������</span><br>
  </li>
</ul>
<?php include "conf/footer.php"; ?>
</body>
</html>
