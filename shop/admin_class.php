<?php
require "conf/config.php";
include "admin_check.php";
if(!empty($name1))
$name1=trim($name1);
if(!empty($name2))
$name2=trim($name2);

$up_id=0;


if (isset($Submit))
{
   $aryid=@implode(",",$delete);
   $db2->query("delete from $class_t where id in($aryid) or up_id in($aryid)");
   $db2->query("delete from $goods_t where class_id in($aryid) or up_id in($aryid)");
   $result="Delete class successfully,the corresponding products are deleted successfully too.";
}
if (!empty($name1))
{
	$db->query("insert into $class_t values(null,'$name1',$up_id)");
	$result="Add class successfully.";
}
if (!empty($name2))
{
	$db->query("insert into $class_t values(null,'$name2',$up_id)");
	$result="Add class successfully.";
}




if (isset($action)) //修改产品类别名称
{
if(	$action=="update")
{
 $db->query("update $class_t set name='$mc' where id=$id2");
 header("Location: admin_class.php?up_id=$up_id");
}
 }
?>
<html>
<head>
<title><?php echo $sitename ?> -- Product classes admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/admin.php"; ?>
<table width="750" align="center">
  <tr align="center"> 
    <td bgcolor="#EFEFEF" class="p13"> 
      <p><br>
        Product classes admin<br>
        <a href="admin_class.php" class="clink03">return</a></p>
		<?php if(isset($result)) echo $result; ?>
      <form name="form1" method="post" action="">
        <table width="50%" border="1" class="black" cellspacing="1" cellpadding="3" bordercolor="#FFFFFF" bgcolor="#D3E3FE">
          <tr align="center"> 
            <td colspan="4"> 
              <input type="checkbox" name="deleteall" value="on" onClick="CheckAll(this.form,this.checked)"   >
              <font color="#CC3366">Select all When deleting class, the corresponding products will be deleted too</font> </td>
          </tr>
          <tr> 
            <td width="15%" align="center">delete</td>
            <td width="24%" align="center">id</td>
            <td width="43%" align="center">class name</td>
            <td width="18%" align="center">modify class</td>
          </tr>
          <?php
        
		  $db->query("select * from $class_t where up_id=$up_id");
         $i=0;
			   while($db->next_record())
			   {
			   $i++;
			   ?>
          <tr> 
            <td width="15%" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>" align="center"> 
              <input type="checkbox" name="delete[]" value="<?php echo $db->f('id'); ?>">
            </td>
            <td width="24%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php echo $db->f('id') ?>
            </td>
            <td width="43%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php
if ($up_id)
{
 echo $db->f('name'); 
}
else
{
?>
              
              <?php echo $db->f('name'); ?>
               
              <?php			  

 }
?>
            </td>
            <td width="18%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"><a href="<?php echo $PHP_SELF ?>?up_id=<?php echo $up_id ?>&id=<?php echo $db->f('id') ?>#xg" class="clink03">modify</a></td>
          </tr>
          <?php } ?>
          <tr align="center"> 
            <td colspan="4"> 
              <input type="checkbox" name="deleteall" value="on" onClick="CheckAll(this.form,this.checked)"   >
              <font color="#CC3366">Select all When deleting class, the corresponding products will be deleted too.</font> </td>
          </tr>
          <tr align="center"> 
            <td colspan="4">Add product class: 
              <input type="text" name="name1" maxlength="40" size="20" class="think">
            </td>
          </tr>
          <tr align="center"> 
            <td colspan="4">Add product class: 
              <input type="text" name="name2" maxlength="40" size="20" class="think">
              <input type="hidden" name="up_id" value="<?php echo $up_id ?>">
            </td>
          </tr>
          <tr align="center"> 
            <td colspan="4"> 
              <input type="submit" name="Submit" value="update" class="stbtm2">
            </td>
          </tr>
          <?php
if (isset($id))
{
$db->query("select name from $class_t where id=$id");
$db->next_record();			   
?>
          <tr align="center" bgcolor="#efefef"> 
            <td colspan="4" height="39"> <span class="p13"><a name="xg"></a>Modify product class:</span> 
              <input type="text" name="mc" maxlength="40" size="20" class="think" value="<?php echo $db->f('name') ?>">
              <input type="hidden" name="id2" value="<?php echo $id ?>">
              <input type="hidden" name="action" value="update">
              <input type="submit" name="Submit22" value="Modify" class="stbtm2">
            </td>
          </tr>
          <?php } ?>
        </table>
      </form>
      
    </td>
  </tr>
</table>
<br>

<?php include "conf/footer.php"; ?>
</body>
</html>
