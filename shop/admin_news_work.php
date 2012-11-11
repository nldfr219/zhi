<?php
require "conf/config.php";
include "admin_check.php"; 
?>
<html>
<head>
<title>新闻管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" <?php if ($action=="update" and $usage!=1) echo 'onload="document.form1.content_html.value=document.form1.message.value;"'; ?>>
<?php include "conf/admin.php"; ?>
<table width="750" align="center">
  <tr align="center"> 
    <td bgcolor="#EFEFEF"> 
      <p class="p13"><br>
        新闻管理</p>
      <script language="JavaScript">
function getDate(s){
aa=window.showModalDialog("calen.htm",null,"dialogwidth:155pt;dialogheight:190pt");
s.value=aa; 
if(s.value=="undefined") s.value="";
return;
}
function check()
{
document.form1.message.value=document.form1.content_html.value.replace(/(')/g,'"');
 if (document.form1.title.value == "")
  {
    alert ("请填写新闻标题!");
    document.form1.title.focus();
    return false;
  }
 document.form1.Submit.disabled=true;
 document.form1.Submit2.disabled=true;
}
</script>
      <center>
        <?php
if ($usage!=1)
{
  	switch ($action)
	{
		case "insert":
			echo "添加新闻";
			break;
		case "update":
			echo "修改新闻";
	}
          $db->query("select * from $news_t where id=$id");
          $db->next_record();
      	  $title=stripslashes($db->f('title'));
      	  $message=stripslashes($db->f('content'));
		  $message=str_replace("'",'"',$message);
		  if (!eregi("</",$db->f('content')))
		     $message=nl2br($message);
      	  $key_words=$db->f('key_words');
      	  $date=$db->f('date');
      	  $read_no=$db->f('read_no');
?>
        <form name="form1" method="post" action="" onsubmit='return check();'>
          <table width="98%" border="1" cellspacing="0" cellpadding="2" bgcolor="#E1EAF4" align="center" bordercolor="#FFFFFF">
            <tr align="center"> 
              <td colspan="2" height="26"> <font color="#FF0000">*</font> 表示为必填项</td>
            </tr>
            <tr> 
              <td width="10%" align="right">新闻标题：</td>
              <td width="90%"> 
                <input type="text" name="title" size="50" maxlength="100" value="<?php echo htmlspecialchars($title) ?>">
                <font color="#FF0000">*</font> </td>
            </tr>
            <tr> 
              <td width="10%" align="right">新闻内容：</td>
              <td width="90%"> <object id=content_html style="LEFT: 0px; TOP: 0px" data="editor.php" width=640 height=555 type=text/x-scriptlet  VIEWASTEXT>
                </object> 
                <input type=hidden name=message  value='<?php echo htmlspecialchars($message) ?>'>
              </td>
            </tr>
            <tr> 
              <td width="10%" align="right">关键字：</td>
              <td width="90%"> 
                <input type="text" name="key_words" size="22" value="<?php echo $key_words ?>" maxlength="20">
              </td>
            </tr>
            <tr> 
              <td width="10%" align="right">发布日期：</td>
              <td width="90%"> 
                <input type="text" name="date" value="<?php if ($action=="insert") echo date("Y-m-d H:i:s"); else echo $date; ?>" maxlength="19" size="21">
                <font size=2><img style="CURSOR: hand" onClick=getDate(date); 
            src="image/clock.gif"></font> </td>
            </tr>
            <tr> 
              <td width="10%" align="right">阅读次数：</td>
              <td width="90%"> 
                <input type="text" name="read_no" size="12" value="<?php echo $read_no ?>" maxlength="10">
              </td>
            </tr>
            <tr align="center">
              <td colspan="2">注：如果需上传图片，请使用html代码，并且用ftp来上传图片</td>
            </tr>
            <tr align="center"> 
              <td colspan="2"> 
                <input type="hidden" name="action" value="<?php echo $action ?>">
                <input type="hidden" name="usage" value="1">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="submit" name="Submit" value="提 交" class="stbtm2">
                　 
                <input type="reset" name="Submit2" value="重 填" class="stbtm2">
              </td>
            </tr>
          </table>
        </form>
        <?php
}
else
{
$title=addslashes(trim($title));
$message=stripslashes(trim($message));

//把img出现的内容取出，存放到img数组中
$location=0;
while(1)
{
$location=@strpos($message,"src=\"",$location+5);//src出现位置
if (!$location) break;
$location_2=@strpos($message,"\"",$location+5);// 从img出现的位置开始 > 出现的位置
$img[]=substr($message,$location+5,$location_2-$location-5);
}
$flag=0;
//把内容的图片文件名替换为系统自动生成的文件名
for($i=0;$i<count($img);$i++)            
{
// if (substr($img[$i],0,7)!="http://")
// {
 //将图片上传至news_img/2002-08
//  $ss=up_img($img[$i]);
  //$message=@str_replace($img[$i],$ss,$message);
// }
 $flag=1;
}

if ($flag && substr($title,-5,5)!=" [图]")  $title.=" [图]";

$message=addslashes(trim($message)); 

switch ($action)
{
	case "insert":
     	$str_sql = "insert into $news_t
     	           values (null,'$title','$message','$key_words',
     	           '$date','$read_no')";
		break;
	case "update":
		  $str_sql = "update $news_t set 
		          title='$title',content='$message',
     	          key_words='$key_words',date='$date',read_no='$read_no'
     	          where id=$id";
}
$db->query($str_sql);
  	switch ($action)
	{
		case "insert":
			echo "添加新闻";
			break;
		case "update":
			echo "修改新闻";
	}
echo '成功,正在返回新闻管理首页<meta http-equiv="refresh" content="2;URL=admin_news.php"><br><br>';
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
