<?php
require "conf/options.php";
require "conf/db_mysql.php";

//以下内容为搜索的内容
$http_head='<meta name="description" content="Zhi Ma\'s Online Shop">
<META NAME="robots" CONTENT="none">';

//付款方式设置 商店设置

  //网站的付款方式
$pay_str[2]="建设银行
      
　　　建设银行
　　　账号：4367423811550274995";
$pay_str[3]="农业银行

　　　建设银行
　　　账号：1038200111013357977";
/*这里的
数组的值1,2,3分别是对应bank.php，payment.php页面中，付款方式的值。
由于在dingdang.php页面的订单方式会只显示4个汉字，即8个字符，因此，建议前四个汉字为固定的付款方式
*/

//关闭错误提示
//error_reporting(0);
if (!isset($_SESSION)) {
    session_start();
}  //启动session变量

$register_globals = @get_cfg_var("register_globals");

if ($register_globals!=1) { 
	//This is For PHP 5 at 2005-4-20
	@extract($_SERVER, EXTR_SKIP); 
	@extract($_COOKIE, EXTR_SKIP); 
	@extract($_SESSION, EXTR_SKIP); 
	@extract($_POST, EXTR_SKIP); 
	@extract($_FILES, EXTR_SKIP); 
	@extract($_GET, EXTR_SKIP); 
	@extract($_ENV, EXTR_SKIP); 

	//This is for image submit
	foreach($_FILES as $key => $val) {
			$$key = $val['tmp_name'];
			${$key.'_name'} = $val['name'];
			${$key.'_size'} = $val['size'];
			${$key.'_type'} = $val['type'];
		}
}

$db  =  new DB_Sql;
$db->Host     =  $dbservername;
$db->Database =  $dbname;
$db->User     =  $dbusername;
$db->Password =  $dbuserpass;

$db2  =  new DB_Sql;
$db2->Host     =  $dbservername;
$db2->Database =  $dbname;
$db2->User     =  $dbusername;
$db2->Password =  $dbuserpass;


//测试数据库连接
$db->Link_ID = mysql_connect($db->Host, $db->User, $db->Password) or die("数据库连接错误，请运行install.php进行安装。");
mysql_select_db($db->Database,$db->Link_ID) or die("数据库不存在，请运行install.php进行安装。");

//------------自定义函数部分--------------
//------------把图片进行比例缩小------------
function show_img($img,$width,$height)
{
  $size=@GetImageSize($img);
  $ss=$img."'";
  $r=@round($size[0]/$size[1],3);
  if ($size[0]>$size[1])
    $$height=@round($width/$r);
  else
	$width=@round($height*$r);
 $ss.=" width='$width' height='$height'";
  return $ss;
}

//------------从字符串中取出$len长度的字符，解决全角、半角的问题
function substr_2($str,$len)
{
if (strlen($str)>$len) {
$temp = 0;
for($i=0; $i<$len; $i++)
if (ord($str[$i]) > 128)
$temp++;
if ($temp%2 == 0)
$str = substr($str,0,$len);
else
$str = substr($str,0,$len+1);
}
return $str;
}

/*
$msg值为内容，$title值为标题,$key值为搜索的关键字,$link文章的链接地址
$flag如果为0，表示按标题、内容搜索，为1，表示按标题搜索，为2，表示按文章内容来搜索
*/
function match_show($msg,$title,$key,$link)
{  
   $key = chop($key);
   if ($key)
   {  
      $title = preg_replace("/<style>.+<\/style>/is", "", $title);  
      $title = str_replace(" ", "", $title);  
      //$title = preg_replace("/<[^>]+>/", "", $title);  
      $value = preg_match("/.*$key.*/i", $title, $res);  
      if ($value) $flag=1;
      
      $msg = preg_replace("/<style>.+<\/style>/is", "", $msg);  
      $msg = str_replace(" ", "", $msg);  
      $msg = preg_replace("/<[^>]+>/", "", $msg);  
      $value = preg_match("/.*$key.*/i", $msg, $res);  
      if ($value || $flag==1)
      {  
      $res[0] = preg_replace("/$key/i", "<FONT SIZE=\"2\"  COLOR=\"red\">$key</FONT>", $res[0]);  
      $title = preg_replace("/$key/i", "<FONT COLOR=\"red\">$key</FONT>", $title);  
      echo "<a href=\"$link\" target=\"_blank\"><FONT COLOR=\"blue\">$title</font></a><BR>";  
      echo $res[0]."<BR><br>";
      }    
   }
   else
   {  
   echo "请输入关键词";  
   exit;  
   }    
}  
?>