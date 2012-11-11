<?php
require "conf/config.php";

include "check.php";
?>
<HTML><HEAD><TITLE>图片上传系统</TITLE>
<META content="text/html; charset=gb2312" http-equiv=Content-Type>
<LINK href="style.css" rel=stylesheet type="text/css">
<body bgcolor=menu style="font-size:9pt">
<?php
//检测上传文件的文件大小
if (filesize($src)>(2*1024*1024))
{
 echo "<br>".$src_name."大于2M,上传失败！";
 exit;
}
$js=split("\.",$src_name);
//检测上传文件的扩展名
if (eregi("eml|exe|php|vxd|dll|asp|com|cmd|bat|htt|vbs|js|pl|cgi",$js[1]))
{
  echo "<br>".$src_name."有可能危害系统安全，上传失败！";
  exit;
}
//以下一段程序判断目录是否存在，若不存在则建立新目录
  $dir_name="news_img/".date("Y-m");//硬件新闻等栏目文章存放的目录格式为：年-月，如2002-01
  if (!is_dir($dir_name))
   {
     if (!mkdir($dir_name,0777)) 
     {
      echo "$dir_name 目录创建失败，不能进行后面的操作<BR><BR>请检查您的权限或者目录路径！";
      exit();
    }
  }
//以下一段程序判断文件名是否存在，以取得需保存的文件名，$js[1]为上传文件的扩展名
  $the_time = time ();
  $new_file = "$dir_name/$the_time.".$js[1];
  if (file_exists($new_file))
  {
  $seq = 1;
  while (file_exists("$dir_name/$the_time$seq.".$js[1])) { $seq++; }
  $new_file = "$dir_name/$the_time$seq.".$js[1];
  } 
copy($src,$new_file);	

if ($alt!="") $new_file = $new_file . " alt=" . $alt;
if ($align!="") $new_file = $new_file . " align=" . $align;
if ($border!="") $new_file = $new_file . " border=" . $border;
if ($hspace!="") $new_file = $new_file . " hspace=" . $hspace;
if ($vspace!="") $new_file = $new_file . " vspace=" . $vspace;

?>
<script language=javascript>
var src='<?php echo $new_file ?>';//图片路径
opener.top.form1.content_html.value+="<img src="+src+">";
//opener是我们调用的编辑器，opener.top是编辑器的父级窗口，form1是调用编辑器页面的表单
//要注意如果调用编辑器的页面不是框架页面里面就用这个就可以了

//opener.top.glmain.form1.content_html.value+="<img border=0 src="+src+">";//如果用了框架页面，比如article_add.asp是在框架页中的glmail，那么就用这个
window.close();
</script>

