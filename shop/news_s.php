<?php
require "conf/config.php";
session_start();
?>
<html>
<head>
<title><?php echo $sitename ?> -- �������</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/header.php" ?>
<table width="750" border="0" align="center">
  <tr> 
    <td width="182" valign="top"> 
      <?php include "news_hot.php" ?>
    </td>
    <td width="558" align="center"> 
      <p align="center"> <br>
        <?php
  if (!$page) $page=1;
  $key = chop($key);
  if (!$key)
  {
     echo "������ؼ���";
	 exit();
  }
  $tmp="where title like '%$key%' or content like '%$key%'";
  $db->query("select null from $news_t $tmp");
  $total_num=$db->num_rows();//�õ��ܼ�¼��
  $totalpage=ceil($total_num/$num_to_show);//�õ���ҳ�� where cote_id=$f
  $init_record=($page-1)*$num_to_show;
  $db->query("select id,title,content,
         DATE_FORMAT(date,'%Y-%m-%d') as date
     from $news_t $tmp
     order by id DESC limit $init_record, $num_to_show_news"); 
 ?>
        ���μ���Ϊ���ҵ� <font color="red"><b> 
        <?php echo $db->num_rows(); ?>
        </b></font> ƪ�й� <font color="red"><b> 
        <?php echo $key; ?>
        </b></font> ��ҳ��</p>
      <table width="75%" border="1" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" bordercolor="#FFFFFF" class="black" height="38" align="center">
        <tr> 
          <form action="" method="post" name="form">
            <td bgcolor="eeeeee" align="center" valign="middle" height="49"> 
              <input type="text" name="key" size="30" value="<?php echo $key; ?>">
              �� 
              <input type="submit" name="Submit23" value="�� ��">
            </td>
          </form>
        </tr>
      </table>
      <br>
      <table width="100%" border="0" cellspacing="1" cellpadding="1" class="black">
        <tr>
          <td> 
            <?php
 while($db->next_record())
   match_show(stripslashes($db->f("content")),stripslashes($db->f('title'))."&nbsp;&nbsp;".$db->f('date'),$key,"news_list.php?id=".$db->f('id'));
 if ($db->Row==1) echo "û�в�ѯ���κ���Ϣ";
 ?>
          </td>
        </tr>
        <form action="<?php echo $PHP_SELF."?key=$key" ?> " method="post" name="form8" onSubmit="return check_page('form8.page')">
          <tr> 
            <td align="right"> 
              <hr size="1">
              �ܼ�: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>��  ҳ&nbsp;��һҳ</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=1&key=$key'>��  ҳ</a>&nbsp;<a href='$PHP_SELF?page=$page1&key=$key'>��һҳ</a>&nbsp;"; 
  if ($page2 > $totalpage) echo "<FONT color=#999999>��һҳ&nbsp;β  ҳ</FONT>&nbsp;"; 
  else echo "<a href='$PHP_SELF?page=$page2&key=$key'>��һҳ</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&key=$key'>β  ҳ</a>&nbsp;"; 
?>
              ��ǰҳ: 
              <?php echo "$page/$totalpage" ?>
              &nbsp; 
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
      <br>
      <table width="75%" border="1" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" bordercolor="#FFFFFF" class="black" height="38" align="center">
        <tr> 
          <form action="" method="post" name="form">
            <td bgcolor="eeeeee" align="center" valign="middle" height="49"> 
              <input type="text" name="key" size="30" value="<?php echo $key; ?>">
              �� 
              <input type="submit" name="Submit2" value="�� ��">
            </td>
          </form>
        </tr>
      </table>
      <br>
    </td>
  </tr>
</table>
<div align="left"> 
  <?php include "conf/footer.php"; ?>
</div>
</body>
</html>
