<?php
require "conf/config.php";
include "admin_check.php";

if ($action=="all")
{
  //ɾ��shopping�����Ʒid
  $db->query("selete id from $requests_t where (payment=0 and send_out=0)
     and (TO_DAYS(now())-TO_DAYS(date_created)) > $dingdang_days");
  while($db->next_record())
	  $db2->query("delete from $shopping where requests_id=".$db->f('id'));

  //ɾ��������Ķ���
  $db->query("delete from $requests_t where (payment=0 and send_out=0)
     and (TO_DAYS(now())-TO_DAYS(date_created)) > $dingdang_days");  
  }
if ($action=="del")
{
  //ɾ���û�������Ķ���
  $db->query("delete from $requests_t where id=($id-$init_num)");
  //ɾ���û�shopping�����Ʒid
  $db->query("delete from $shopping_t where requests_id=($id-$init_num)");
  }
if ($do=="update")
{
  $db->query("update $requests_t set $action=$value where id=($id-$init_num)");
//���û����ʼ�֪ͨ�û�
  
}
?>
<html>
<head>
<title><?php echo $sitename ?> -- ��������</title>
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
        ��������</p>
      <table width="96%" border="0" cellspacing="0" bgcolor="#ffffff">
        <form name="form1" method="post" action="<?php echo $PHP_SELF ?>" >
          <tr> 
            <td> �������š�������ѯ: 
              <input type="text" name="key" size="15" class="think" >
              <input type="hidden" name="search" value="1">
              <input type="submit" name="submit1" value=":�� ѯ:" class="stbtm2">
            </td>
          </tr>
        </form>
      </table>     
        
      <?php  
  if (!$page) $page=1;
  $tmp="where (payment=0 or send_out=0) and (TO_DAYS(now())-TO_DAYS(date_created)) > $dingdang_days"; 
  if ($key)
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
 ?>
      <table width="99%" border="0" cellspacing="0" align="center" >
        <tr> 
          <td> <b>��Ч������</b> (ָ��û������ͬʱ��û������������ɹ���ʱ�䳬��<font color="#FF0000"> 
            <?php echo $dingdang_days ?>
            </font> ��)</td>
          <td><a href="admin_dingdang.php"><font color="blue">������Ķ���</font></a> <a href="fail_admin_dingdang.php?action=all" onClick="return confirm('ȷ��Ҫɾ�����е���Ч������?')"><font color="blue"></font></a><a href="admin_succeed_dingdang.php"><font color="blue">�ɹ��Ķ���</font></a> 
            <a href="admin_fail_dingdang.php"><font color="blue">��Ч�Ķ���</font></a>��<a href="admin_fail_dingdang.php?action=all" onClick="return confirm('ȷ��Ҫɾ�����е���Ч������?')"><font color="blue">ɾ��������Ч����</font></a> 
          </td>
        </tr>
      </table>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF."?key=$key" ?> " method="post" name="form8" onSubmit="return check_page('form8.page')">
          <tr> 
            <td align="right"> �ܼ�: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>��  ҳ&nbsp;��һҳ</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1&key=$key'>��  ҳ</a>&nbsp;<a href='$PHP_SELF?page=$page1&key=$key'>��һҳ</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>��һҳ&nbsp;β  ҳ</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2&key=$key'>��һҳ</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&key=$key'>β  ҳ</a>&nbsp;"; 
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
      <table width="98%" border="1" cellspacing="0" align=center>
        <tr> 
          <td align=center><font color="#cc0000">�������</font></td>
          <td align=center><font color="#cc0000">������Ա</font></td>
          <td align=center><font color="#cc0000">���ʽ</font></td>
          <td align=center><font color="#cc0000">�µ�ʱ��</font></td>
          <td align=center><font color="#cc0000">�Ƿ񷢻�</font></td>
          <td align=center><font color="#cc0000">�Ƿ񸶿�</font></td>
          <td align=center><font color="#cc0000">Ӧ����</font></td>
          <td align=center><font color="#cc0000">��������</font></td>
          <td align=center><font color="#cc0000">�������</font></td>
          <td align=center>&nbsp;</td>
        </tr>
        <?php
while($db->next_record())
  { 
?>
        <tr> 
          <td align=center> <a href='admin_dingdang_disp.php?id="<?php echo $db->f('id')+$init_num ?>' class='clink03'> 
            <?php echo $db->f('id')+$init_num; ?>
            </a> </td>
          <td align=center> 
            <?php
$db2->query("select id,u_name from $user_t where id=".$db->f('user_id'));
$db2->next_record();
echo '<a href="user_list.php?id='.$db2->f('id').'" class="clink03" target="_blank">'.$db2->f('u_name').'</a>';
?>
          </td>
          <td align=center> 
            <?php
echo substr($pay_str[$db->f('pay')],0,8);
?>
          </td>
          <td align=center> 
            <?php echo $db->f('date_created'); ?>
          </td>
          <td align=center> 
            <?php if ($db->f('send_out')) echo "������"; else echo "<font color=\"#cc0000\">δ����</font>"; ?>
          </td>
          <td align=center> 
            <?php if ($db->f('payment')) echo "������"; else echo "<font color=\"#cc0000\">δ����</font>"; ?>
          </td>
          <td align=center> 
            <?php echo $db->f('fee')+$send_money; ?>
            Ԫ</td>
          <td align=center> 
            <?php
			if ($db->f('send_out'))
			 echo "<a href='$PHP_SELF?do=update&action=send_out&value=0&id=".($db->f('id')+$init_num)."' onClick=\"return confirm('ȷ����������δ������?')\" class='clink03'>"."δ����</a>";
            else
			 echo "<a href='$PHP_SELF?do=update&action=send_out&value=1&id=".($db->f('id')+$init_num)."' onClick=\"return confirm('ȷ�����������ѷ�����?')\" class='clink03'>"."������</a>";
			 ?>
          </td>
          <td align=center> 
            <?php
			if ($db->f('payment'))
              echo "<a href='$PHP_SELF?do=update&action=payment&value=0&id=".($db->f('id')+$init_num)."' onClick=\"return confirm('ȷ����������δ������?')\" class='clink03'>"."δ����</a>";
		   else
			  echo "<a href='$PHP_SELF?do=update&action=payment&value=1&id=".($db->f('id')+$init_num)."' onClick=\"return confirm('ȷ�����������Ѹ�����?')\" class='clink03'>"."������</a>";
			?>
          </td>
          <td align=center> 
            <input type="button" name="Button2" value="ɾ��" class="think" <?php echo "onclick=\"javaScript:if (confirm('ȷ��Ҫɾ����?')) window.location.href='$PHP_SELF?action=del&id=".($db->f('id')+$init_num)."'\""; ?>>
          </td>
        </tr>
        <?php } ?>
      </table>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF."?key=$key" ?> " method="post" name="form88" onSubmit="return check_page('form88.page')">
          <tr> 
            <td align="right"> �ܼ�: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>��  ҳ&nbsp;��һҳ</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1&key=$key'>��  ҳ</a>&nbsp;<a href='$PHP_SELF?page=$page1&key=$key'>��һҳ</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>��һҳ&nbsp;β  ҳ</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2&key=$key'>��һҳ</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&key=$key'>β  ҳ</a>&nbsp;"; 
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
    </td>
  </tr>
</table>
<br>

<?php include "conf/footer.php"; ?>
</body>
</html>
