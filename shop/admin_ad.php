<?php
require "conf/config.php";
include "admin_check.php";

$code = addslashes($code);

if($op == "insert")
{
  $db->query("insert into $ad_t(code,visible,posttime) values('$code','$visible','$date_tmp')");
  $result = "����ɹ���";
}
else if($op == "update")
{
  $db->query("update $ad_t set code='$code',visible='$visible' where id=$id");
  $result = "���ĳɹ���";
}
else if($op == "delete")
{
  $db->query("delete from $ad_t where id=$id");
  $result = "ɾ���ɹ���";
}
if($op)
{
  $name = "";  //���������һ����¼
  $url = "";
  $code = "";
}

?>
<html>
<head>
<title><?php echo $sitename ?> -- ������</title>
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
        ������ 
        <?php
  if (!$page) $page=1;
  $db->query("select null from $ad_t");
  $total_num=$db->num_rows();//�õ��ܼ�¼��
  $totalpage=ceil($total_num/$num_to_show);//�õ���ҳ��
  $init_record=($page-1)*$num_to_show;
  $db->query("select id,code,views,visible,posttime 
   from $ad_t
   order by id DESC limit $init_record, $num_to_show");        
?>
      </p>
      <table width="100%" bgcolor="dddddd" align="center" cellspacing="1" cellpadding="2">
        <tr bgcolor="e8e8e8"> 
          <td align="right" width="8%"><b>ID</b></td>
          <td align="center" width="9%"><b>�� ��</b></td>
          <td align="center" width="11%"><b>�Ǽ�����</b></td>
          <td align="right" width="8%"><b>��ʾ</b></td>
          <td width="55%" bgcolor="e8e8e8" align="center"><b>�� ��</b></td>
          <td align="center" width="9%"><b>�� ��</b></td>
        </tr>
        <form name="formInsert" enctype="multipart/form-data" method="post" action="">
          <tr bgcolor="<?php if ($i % 2 ==0) echo "#FDFFF7";else echo "#f7f7f7"; ?>"> 
            <td align="right" width="8%">&nbsp;</td>
            <td align="center" width="9%"> 
              <select name="visible">
                <option value="0">��</option>
                <option value="1">��</option>
              </select>
            </td>
            <td align="center" width="11%">&nbsp;</td>
            <td align="right" width="8%">&nbsp;</td>
            <td width="55%"> 
              <textarea cols=62 name=code rows=4 wrap=virtual><?php echo $code; ?></textarea>
            </td>
            <td align="center" width="9%"> 
              <input type="hidden" name="op" value="insert">
              <input class="button" type="submit" name="insertBtn" value="����">
            </td>
          </tr>
          <script language="JavaScript">
    setSelect("formInsert", "visible", "<?php echo $visible; ?>");
  </script>
        </form>
        <tr bgcolor="<?php echo $defaultColor1; ?>"> 
          <td colspan="10" height="25" align="center" class="p13"> 
            <?php echo $result; ?>
          </td>
        </tr>
        <?php
$i++;
while($db->next_record())
{
  //$color = getColor();
  $id = $db->f('id');
  $code = stripslashes($db->f('code'));
?>
        <form name="form<?php echo $id ?>" enctype="multipart/form-data" method="post" action="">
          <tr bgcolor="<?php  if ($i % 2 ==0) echo "#FDFFF7";else echo "#f7f7f7"; ?>"> 
            <td align="right" width="8%"> 
              <input type="text" name="id" value="<?php echo $id; ?>" size="4" maxlength="10" readonly>
            </td>
            <td align="center" width="9%"> 
              <select name="visible">
                <option value="0">��</option>
                <option value="1">��</option>
              </select>
            </td>
            <td align="center" width="11%"> 
              <?php echo $db->f('posttime'); ?>
            </td>
            <td align="right" width="8%"> 
              <?php echo $db->f('views'); ?>
            </td>
            <td width="55%"> 
              <textarea cols=62 name=code rows=4 wrap=virtual><?php echo $code; ?></textarea>
              <br>
              <?php echo $code; ?>
            </td>
            <td align="center" width="9%"> 
              <input type="hidden" name="page" value="<?php echo $page; ?>">
              <input type="hidden" name="op" value="">
              <input class="button" type="button" name="updateBtn" value="����"
        onClick="document.forms['form<?php echo $id; ?>'].op.value='update'; document.forms['form<?php echo $id; ?>'].submit();">
              <br>
              <br>
              <input class="button" type="button" name="deleteBtn" value="ɾ��"
        onClick="document.forms['form<?php echo $id; ?>'].op.value='delete'; if(confirm('��ȷ��ɾ���ü�¼��')) document.forms['form<?php echo $id; ?>'].submit();">
            </td>
          </tr>
          <script language="JavaScript">
    setSelect("form<?php echo $id; ?>", "visible", "<?php echo $db->f('visible'); ?>");
  </script>
        </form>
        <?php
 $i++;
 } 
?>
      </table>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF ?> " method="post" name="form" onSubmit="return check_page('form.page')">
          <tr> 
            <td align="right"> �ܼ�: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>��  ҳ&nbsp;��һҳ</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1'>��  ҳ</a>&nbsp;<a href='$PHP_SELF?page=$page1'>��һҳ</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>��һҳ&nbsp;β  ҳ</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2'>��һҳ</a>&nbsp;<a href='$PHP_SELF?page=$totalpage'>β  ҳ</a>&nbsp;"; 
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
    </td>
  </tr>
</table>
<br>
<u><span class="p14">������Ϣ</span></u><span class="p14">�� </span> 
<ul>
  <li><span class="p14">��潫�����ʾ��ÿ��ҳ��Ķ���</span></li>
  <li><span class="p14">�޸�һ�����ġ����롱</span></li>
  <li><span class="p14">����ͨ���޸�һ�����ġ��ɼ���Ϊ������������ʾһ�����</span></li>
  <li><span class="p14">�㡰���ġ�ȷ���޸ĸ��䶯</span></li>
  <li><span class="p14">�㡰ɾ������ȷ��ɾ����ɾ��һ�����</span><br>
  </li>
</ul>
<?php include "conf/footer.php"; ?>
</body>
</html>
