<?php
require "conf/options.php";
require "conf/db_mysql.php";

//��������Ϊ����������
$http_head='<meta name="description" content="Zhi Ma\'s Online Shop">
<META NAME="robots" CONTENT="none">';

//���ʽ���� �̵�����

  //��վ�ĸ��ʽ
$pay_str[2]="��������
      
��������������
�������˺ţ�4367423811550274995";
$pay_str[3]="ũҵ����

��������������
�������˺ţ�1038200111013357977";
/*�����
�����ֵ1,2,3�ֱ��Ƕ�Ӧbank.php��payment.phpҳ���У����ʽ��ֵ��
������dingdang.phpҳ��Ķ�����ʽ��ֻ��ʾ4�����֣���8���ַ�����ˣ�����ǰ�ĸ�����Ϊ�̶��ĸ��ʽ
*/

//�رմ�����ʾ
//error_reporting(0);
if (!isset($_SESSION)) {
    session_start();
}  //����session����

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


//�������ݿ�����
$db->Link_ID = mysql_connect($db->Host, $db->User, $db->Password) or die("���ݿ����Ӵ���������install.php���а�װ��");
mysql_select_db($db->Database,$db->Link_ID) or die("���ݿⲻ���ڣ�������install.php���а�װ��");

//------------�Զ��庯������--------------
//------------��ͼƬ���б�����С------------
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

//------------���ַ�����ȡ��$len���ȵ��ַ������ȫ�ǡ���ǵ�����
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
$msgֵΪ���ݣ�$titleֵΪ����,$keyֵΪ�����Ĺؼ���,$link���µ����ӵ�ַ
$flag���Ϊ0����ʾ�����⡢����������Ϊ1����ʾ������������Ϊ2����ʾ����������������
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
   echo "������ؼ���";  
   exit;  
   }    
}  
?>