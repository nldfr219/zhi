<?php
require "conf/config.php";
include "admin_check.php";



function up_img($file,$f_type)
{
	set_time_limit(1000);
	if (($file == "none") || ($file == "")) //检查是否选择文件
	  return ;
	if ($f_type!="image/jpeg" && $f_type!="image/gif" && $f_type!="image/x-png") //检查上载文件类型
	{
       echo "<center>The format of the file you uploaded is not correct...</center>$f_type";
       exit();
	  return ;
	}
  $upload_dir="goods_img";
  $the_time = time ();
  $local_file = "$upload_dir/$the_time";
  if ( file_exists ( "$local_file".".jpg" ) || file_exists ( "$local_file".".gif" ) || file_exists ( "$local_file".".png" )) 
  {
   $seq = 1;
   while ( file_exists ( "$upload_dir/$the_time$seq".".jpg" ) || file_exists ( "$upload_dir/$the_time$seq".".gif" )  || file_exists ( "$upload_dir/$the_time$seq".".png" ))
    { $seq++; }
   $local_file = "$upload_dir/$the_time$seq";
  }
  if ($f_type=="image/jpeg") $local_file="$local_file.jpg";
  if ($f_type=="image/gif") $local_file="$local_file.gif";
  if ($f_type=="image/x-png") $local_file="$local_file.png";
  copy($file,$local_file);
  return $local_file; //返回图片的文件名
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
<?php include "js_setselect.php"; ?>
<table width="750" align="center">
  <tr align="center"> 
    <td bgcolor="#EFEFEF"> 
      <p class="p13"><br>
        products admin</p>
      <script language="JavaScript">
function check()
{

 if (document.form1.name.value == "")
  {
    alert ("please fill in the product name!");
    document.form1.name.focus();
    return false;
  }
 if (document.form1.descript.value == "")
  {
    alert ("Please enter the product description!");
    document.form1.descript.focus();
    return false;
  }
 if (isNaN(document.form1.price_m.value) || document.form1.price_m.value <= 0)
  {
    alert ("Please enter the market price!");
    document.form1.price_m.focus();
    return false;
  }
 if (isNaN(document.form1.price.value) || document.form1.price.value <= 0)
  {
    alert ("Please enter the price !");
    document.form1.price.focus();
    return false;
  }
 document.form1.Submit.disabled=true;
 document.form1.Submit2.disabled=true;
}
</script>
      <center>
        <?php
if (empty($usage))
{
  	switch ($action)
	{
		case "insert":
			echo "add product";
			break;
		case "update":
			echo "modify product";
	}
	    if(isset($id))
          $db->query("select * from $goods_t where id=$id");
	    
        if($db->next_record()){
		 $up_id=$db->f('up_id');
      
      	  $name=stripslashes($db->f('name'));
      	  $descript=stripslashes($db->f('descript'));
      	  $image=$db->f('image');
      	  $price_m=$db->f('price_m');
          $price=$db->f('price');
      	  $state=$db->f('state');
      	  $date=$db->f('date');
      	  }
?>
        <form name="form1" method="post" action="" onSubmit="return check();" enctype="multipart/form-data">
          <table width="80%" border="1" cellspacing="0" cellpadding="2" bgcolor="#E1EAF4" align="center" bordercolor="#FFFFFF">
            <tr align="center"> 
              <td colspan="2" height="35"> <font color="#FF0000">*</font> means a must
              </td>
            </tr>
            <tr> 
              <td width="16%" align="right">product class:</td>
              <td width="84%"><font color="#FF0000"> 
                <select name="up_id" onchange="sele(this.selectedIndex);">
                  <option selected>please choose class</option>
                  <?php
          $db->query("select id,name from $class_t where up_id=0");
          while($db->next_record())
                 echo "<option value=".$db->f('id').">&nbsp;".$db->f('name')."</option>\n";
       ?>
                </select>
                </font></td></tr>
            <tr> 
              <td width="16%" align="right">product name:</td>
              <td width="84%"> 
                <input type="text" name="name" size="50" maxlength="60" value="">
                <font color="#FF0000">*</font> </td>
            </tr>
            <tr> 
              <td width="16%" align="right">product description:</td>
              <td width="84%"> 
                <textarea name="descript" cols="60" rows="6"></textarea>
                <font color="#FF0000">*</font></td>
            </tr>
            <tr> 
              <td width="16%" align="right">product image:</td>
              <td width="84%"> <a href="" class="clink03" target="_blank">
                
                </a>
<input type="hidden" name="image1" value="">
                <a href="" class="clink03" target="_blank"> 
                </a> </td>
            </tr>
            <tr>
              <td width="16%" align="right">upload image:</td>
              <td width="84%">
                <input type="file" name="image" maxlength="40">
                type:gif,jpg,png </td>
            </tr>
            <tr> 
              <td width="16%" align="right">market price:</td>
              <td width="84%"> 
                <input type="text" name="price_m" value="" maxlength="10" size="12">
                <font color="#FF0000">*</font> ($)</td>
            </tr>
            <tr> 
              <td width="16%" align="right">member price:</td>
              <td width="84%"> 
                <input type="text" name="price" value="" size="12" maxlength="10">
                <font color="#FF0000">* </font>($)</td>
            </tr>
            <tr> 
              <td width="16%" align="right">product status:</td>
              <td width="84%"> 
                <input type="radio" name="state" value="0" >
                in stock&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="state" value="1" >
                out of stock </td>
            </tr>
            <tr> 
              <td width="16%" align="right">published date:</td>
              <td width="84%"> 
                <input type="text" name="date" value="" maxlength="19" size="21">
              </td>
            </tr>
            <tr align="center"> 
              <td colspan="2"> 
                <input type="hidden" name="action" value="<?php echo $action ?>">
                <input type="hidden" name="usage" value="1">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="submit" name="Submit" value="submit" class="stbtm2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="Submit2" value="reset" class="stbtm2">
              </td>
            </tr>
          </table>
        </form>
        <?php
}
else
{
$name=addslashes(trim($name));
$descript=addslashes(trim($descript));
$image_file=up_img($image,$image_type);
if(isset($up_id)){
switch ($action)
{
	case "insert":
			
     	$str_sql = "insert into $goods_t
     	           values (null,'$up_id','$name','$descript','$image_file',
     	           '$price_m','$price','$state','$date')";
		
		break;
	case "update":
	      if ($image_file) $tmp="image='$image_file',";
		  $str_sql = "update $goods_t set up_id=$up_id,
		  ,name='$name',descript='$descript',$tmp
     	          price_m=$price_m,price=$price,state=$state,date='$date'
     	          where id=$id";
}
}
$db->query($str_sql);
  	switch ($action)
	{
		case "insert":
			echo "add product ";
			break;
		case "update":
			echo "modify product";
	}
echo 'success, returning to admin homepage<meta http-equiv="refresh" content="2;URL=admin_goods.php"><br><br>';
}
?>
      </center>
</td>
  </tr>
</table>
<br>

<?php include "conf/footer.php"; ?>
</body>
</html>
