<?php
require "conf/config.php";
include "admin_check.php";

$name = addslashes($name);
if($UpFile && $UpFile != "none")
{
  $filesize = filesize($UpFile);
  $filenum  = fopen($UpFile, "rb");
  $filedata = addslashes(fread($filenum, $filesize));
  fclose($filenum);
  unlink($UpFile);
}

if($op == "insert")
{
  if($filedata == "")
    $result = "<font color=red>����ʧ�ܣ�Ҫ�����ļ���</font>";
  else
  {
    $db->query("insert into $link_t(name,url,width,height,visible,posttime,image)"
      . " values('$name','$url','$width','$height','$visible','$date_tmp','$filedata')");
    $name = "";  //���������һ����¼
    $url = "";
    $result = "����ɹ���";
  }
}
else if($op == "update")
{
  if($filedata == "")
  {
    $db->query("update $link_t set name='$name',url='$url',width='$width',height='$height',visible='$visible' where id=$id");
    $result = "���ĳɹ���";
    $name = "";
    $url = "";
  }
  else
  {
    $db->query("update $link_t set name='$name',url='$url',width='$width',height='$height',visible='$visible',image='$filedata' where id=$id");
    $result = "���ĳɹ���";
    $name = "";
    $url = "";
  }
}
else if($op == "delete")
{
  $db->query("delete from $link_t where id=$id");
  $result = "ɾ���ɹ���";
}

?>
<html>
<head>
<title><?php echo $sitename ?> -- �������ӹ���</title>
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
        �������ӹ��� 
        <?php
  if (!$page) $page=1;
  $db->query("select null from $link_t");
  $total_num=$db->num_rows();//�õ��ܼ�¼��
  $totalpage=ceil($total_num/$num_to_show);//�õ���ҳ��
  $init_record=($page-1)*$num_to_show;
  $db->query("select id,name,url,width,height,visible,concat(views,'/',clicks) times,posttime
   from $link_t
   order by id DESC limit $init_record, $num_to_show");        
?>
      </p>
      <table width="100%" bgcolor="dddddd" align="center" cellspacing="1" cellpadding="2">
        <tr bgcolor="e8e8e8"> 
          <td align="right"><b>ID</b></td>
          <td align="center"><b>�� ��</b></td>
          <td align="center"><b>Url</b></td>
          <td align="right"><b>���</b></td>
          <td align="right"><b>�߶�</b></td>
          <td align="center"><b>�ɼ�</b></td>
          <td align="center"><b>�Ǽ�����</b></td>
          <td align="right"><b>��ʾ/�������</b></td>
          <td align="center"><b>�� ��</b></td>
          <td align="center"><b>Ԥ ��</b></td>
          <td align="center"><b>�� ��</b></td>
        </tr>
        <form name="formInsert" enctype="multipart/form-data" method="post" action="">
          <tr bgcolor="<?php echo $defaultColor1; ?>"> 
            <td align="right">&nbsp;</td>
            <td> 
              <input class="edit" type="text" name="name" value="<?php echo $name; ?>" size="16" maxlength="100">
            </td>
            <td> 
              <input class="edit" type="text" name="url" value="<?php echo $url; ?>" size="26" maxlength="200">
            </td>
            <td> 
              <input class="edit" type="text" name="width" value="<?php echo $width ? $width : 88; ?>" size="3" maxlength="8">
            </td>
            <td> 
              <input class="edit" type="text" name="height" value="<?php echo $height ? $height : 31; ?>" size="3" maxlength="8">
            </td>
            <td align="center"> 
              <select class="edit" name="visible">
                <option value="0">��</option>
                <option value="1">��</option>
              </select>
            </td>
            <td align="center">&nbsp;</td>
            <td align="right">&nbsp;</td>
            <td>
              <input name="UpFile" type="file" class="edit" id="UpFile" size="12">
            </td>
            <td align="right">&nbsp;</td>
            <td align="center"> 
              <input type="hidden" name="op" value="insert">
              <input class="button" type="submit" name="insertBtn" value="����">
            </td>
          </tr>
          <script language="JavaScript">
    setSelect("formInsert", "visible", "<?php echo $visible; ?>");
  </script>
        </form>
        <tr bgcolor="<?php  if ($i % 2 ==0) echo "#FDFFF7";else echo "#f7f7f7"; ?>"> 
          <td colspan="12" height="25" align="center">
            <?php echo $result; ?>
          </td>
        </tr>
        <?php
$i++;
while($db->next_record())
{
 // $color = getColor();
  $id = $db->f('id');
?>
        <form name="form<?php echo $id ?>" enctype="multipart/form-data" method="post" action="">
          <tr bgcolor="<?php  if ($i % 2 ==0) echo "#FDFFF7";else echo "#f7f7f7"; ?>"> 
            <td align="right"> 
              <input class="edit" type="text" name="id" value="<?php echo $id; ?>" size="3" maxlength="10" readonly>
            </td>
            <td> 
              <input class="edit" type="text" name="name" value="<?php echo $db->f('name'); ?>" size="16" maxlength="100">
            </td>
            <td> 
              <input class="edit" type="text" name="url" value="<?php echo $db->f('url'); ?>" size="26" maxlength="200">
            </td>
            <td> 
              <input class="edit" type="text" name="width" value="<?php echo $db->f('width'); ?>" size="3" maxlength="8">
            </td>
            <td> 
              <input class="edit" type="text" name="height" value="<?php echo $db->f('height'); ?>" size="3" maxlength="8">
            </td>
            <td align="center"> 
              <select class="edit" name="visible">
                <option value="0">��</option>
                <option value="1">��</option>
              </select>
            </td>
            <td align="center">
              <?php echo $db->f('posttime'); ?>
            </td>
            <td align="right">
              <?php echo $db->f('times'); ?>
            </td>
            <td>
              <input name="UpFile" type="file" class="edit" id="UpFile" size="12">
            </td>
            <td align="right">
              <?php echo "<a href=\"" . $db->f('url') . "\" target=_blank><img src=link.php?id=$id"
        . " alt=\"" . $db->f('name') . "\" border=0></a>" ?>
            </td>
            <td align="center"> 
              <input type="hidden" name="page2" value="<?php echo $page; ?>">
              <input type="hidden" name="op" value="">
              <input class="button" type="button" name="updateBtn" value="����"
        onClick="document.forms['form<?php echo $id; ?>'].op.value='update'; document.forms['form<?php echo $id; ?>'].submit();">
              <input class="button" type="button" name="deleteBtn" value="ɾ��"
        onClick="document.forms['form<?php echo $id; ?>'].op.value='delete'; if(confirm('��ȷ��ɾ���ü�¼��')) document.forms['form<?php echo $id; ?>'].submit();">
            </td>
          </tr>
          <script language="JavaScript">
    setSelect("form<?php echo $id; ?>", "visible", "<?php echo $db->f('visible'); ?>");
  </script>
        </form>
        <?php
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
  <li><span class="p14">����ͨ���޸�һ���������ӵġ��ɼ���Ϊ������������ʾһ����������</span></li>
  <li><span class="p14">�㡰���ġ�ȷ���޸ĸ��䶯</span></li>
  <li><span class="p14">�㡰ɾ������ȷ��ɾ����ɾ��һ��</span><span class="p14">��������</span><br>
  </li>
</ul>
<?php include "conf/footer.php"; ?>
</body>
</html>
