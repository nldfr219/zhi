<?php
require "conf/config.php";
include "admin_check.php";

if (isset($Submit))
{
 for($i=0;$i<count($delete);$i++)
 {
   $arytmp=preg_split("/\|/",$delete[$i]); //取得这个要删除的信息的id和image字段的值
   $tmpid[]=$arytmp[0];
   $image=$arytmp[1];
   @unlink($image);   
 }
 $aryid=@implode(",",$tmpid);
 $db2->query("delete from $goods_t where id in($aryid)");
 $result="delete products successfully.";
}
?>
<html>
<head>
<title><?php echo $sitename ?> -- Products admin</title>
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
        Products admin </p>
      <form name="form1" method="post" action="">
        search key words: 
        <input type="text" name="key" class="think">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit1" value="Search" class="stbtm2">
      </form><div align="left">By class:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $PHP_SELF?>" class='clink03'>all</a>(<?php $tmp="";$db->query("select null from $goods_t $tmp");
  $total_num=$db->num_rows();echo $total_num; ?>) &nbsp;&nbsp;<span class="white">
        <?php
  $db->query("select * from $class_t");
  while($db->next_record())
  {
  
   	$db2->query("select count(*) as total from $goods_t where up_id=".$db->f('id'));
	$db2->next_record();	
    echo "<a href='$PHP_SELF?up_id=".$db->f('id')."' class='clink03'>".$db->f('name')."</a>(".$db2->f('total').")&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    }
  
  
?>
        </span><br>
        <br>
      </div>
      <?php
      
      if(isset($result))
 echo $result; 
 if (isset($key))
     $tmp="where name like '%$key%' or descript like '%$key%'";
 if (isset($up_id))
    $tmp="where up_id=$up_id";
 if (isset($sf))
     $tmp="where class_id=$sf";
  if (!isset($page)) $page=1;

  $db->query("select null from $goods_t $tmp");
  $total_num=$db->num_rows();//得到总记录数

  $totalpage=ceil($total_num/$num_to_show);//得到总页数
  $init_record=($page-1)*$num_to_show;
  $db->query("select id,name,image,price_m,price,state
   from $goods_t $tmp
   order by id DESC limit $init_record, $num_to_show");        
?>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF ?> " method="post" name="form8" onSubmit="return check_page('form8.page')">
          <tr> 
            <td align="right"> <a href="admin_goods_work.php?action=insert" class="clink03">add new products</a>&nbsp;&nbsp;&nbsp;&nbsp;total: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
  if ($page1 < 1) echo "<FONT color=#999999>first&nbsp;previous</FONT>&nbsp;"; 
  else{ 
  if(isset($up_id))	
  echo "<a href='$PHP_SELF?page=1&up_id=$up_id'>first</a>&nbsp;<a href='$PHP_SELF?page=$page1&up_id=$up_id'>previous</a>&nbsp;";
  else
  	echo "<a href='$PHP_SELF?page=1'>first</a>&nbsp;<a href='$PHP_SELF?page=$page1'>previous</a>&nbsp;";

 }
  
  if ($page2 > $totalpage) echo "<FONT color=#999999>next&nbsp;last</FONT>&nbsp;"; 
  else {
if(isset($up_id))
echo "<a href='$PHP_SELF?page=$page2&up_id=$up_id'>next</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&up_id=$up_id'>last</a>&nbsp;";
else
	echo "<a href='$PHP_SELF?page=$page2'>next</a>&nbsp;<a href='$PHP_SELF?page=$totalpage'>last</a>&nbsp;";
} 
?>
              current page:<b> 
              <?php echo $page."/".$totalpage ?>
              </b>&nbsp; 
              <script language="JavaScript">
function check_page(name)
{
 eval("page="+name+".value");
 if (isNaN(page) || page <=0 || page > <?php echo $totalpage ?>)
  {
    alert ("Please enter the page number, the maximum is <?php echo $totalpage ?> ！");
    eval(name+".select()");
	return false;
  }
}
</script>
              
            </td>
          </tr>
        </form>
      </table>
      <form name="form_sele" method="post" action="">
        <table width="98%" border="1" class="black" cellspacing="1" cellpadding="3" bordercolor="#FFFFFF" bgcolor="#D3E3FE">
          <tr> 
            <td colspan="7" align="center"> 
              <input type="checkbox" name="deleteall" value="on" onClick="CheckAll(this.form,this.checked)"   >
              <font color="#CC3366">select all</font>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" value="delete" onClick="if(!confirm('Are you sure to delete these?')) return false;" class="stbtm2">
            </td>
          </tr>
          <tr> 
            <td width="8%" align="center">id</td>
            <td width="56%" align="center">product name</td>
            <td width="10%" align="center">price</td>
            <td width="10%" align="center">member price</td>
            <td width="6%" align="center">status</td>
            
            <td width="5%" align="center">delete</td>
          </tr>
          <?php
          $i=0;
		   while($db->next_record())
			   {
			   $i++;
			   ?>
          <tr> 
            <td width="8%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php echo $db->f('id') ?>
            </td>
            <td width="56%" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <a href="goods_list.php?id=<?php echo $db->f('id') ?>" class='clink03' target="_blank"> 
              <?php echo stripslashes($db->f('name')) ?>
              </a></td>
            <td width="10%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php echo $db->f('price_m') ?>
            </td>
            <td width="10%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php echo $db->f('price') ?>
            </td>
            <td width="6%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <?php
			if ($db->f('state')==0) echo "in stock";
			if ($db->f('state')==1) echo "out of stock";
			 ?>
            </td>
           
            <td width="5%" align="center" bgcolor="<?php if ($i % 2 ==0) echo "#ffffff";else echo "#F1F5FE"; ?>"> 
              <input type="checkbox" name="delete[]" value="<?php echo $db->f('id')."|".$db->f('image'); ?>">
            </td>
          </tr>
	   <?php } ?>
          <tr> 
            <td colspan="7" align="center"> 
              <input type="checkbox" name="deleteall" value="on" onClick="CheckAll(this.form,this.checked)"   >
              <font color="#CC3366">select all</font>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" value="delete" onClick="if(!confirm('Are you sure to delete these?')) return false;" class="stbtm2">
            </td>
          </tr>    
        </table>
	  </form>
      <table width="96%" border="0" cellspacing="1" cellpadding="1">
        <form action="<?php echo $PHP_SELF."?up_id=$up_id&sf=$sf&key=$key" ?> " method="post" name="form88" onSubmit="return check_page('form88.page')">
          <tr> 
            <td align="right"> <a href="admin_goods_work.php?action=insert" class="clink03">add new products</a>&nbsp;&nbsp;&nbsp;&nbsp;total: 
              <?php echo $total_num." ";
  $page1=$page-1;
  $page2=$page+1;
 if ($page1 < 1) echo "<FONT color=#999999>first&nbsp;previous</FONT>&nbsp;"; 
  else{ 
  if(isset($up_id))	
  echo "<a href='$PHP_SELF?page=1&up_id=$up_id'>first</a>&nbsp;<a href='$PHP_SELF?page=$page1&up_id=$up_id'>previous</a>&nbsp;";
  else
  	echo "<a href='$PHP_SELF?page=1'>first</a>&nbsp;<a href='$PHP_SELF?page=$page1'>previous</a>&nbsp;";

 }
  
  if ($page2 > $totalpage) echo "<FONT color=#999999>next&nbsp;last</FONT>&nbsp;"; 
  else {
if(isset($up_id))
echo "<a href='$PHP_SELF?page=$page2&up_id=$up_id'>next</a>&nbsp;<a href='$PHP_SELF?page=$totalpage&up_id=$up_id'>last</a>&nbsp;";
else
	echo "<a href='$PHP_SELF?page=$page2'>next</a>&nbsp;<a href='$PHP_SELF?page=$totalpage'>last</a>&nbsp;";
} 
?>
              current page:<b> 
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
