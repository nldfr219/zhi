<?php
require "conf/config.php";

include "check.php";
?>
<HTML><HEAD><TITLE>ͼƬ�ϴ�ϵͳ</TITLE>
<META content="text/html; charset=gb2312" http-equiv=Content-Type>
<LINK href="style.css" rel=stylesheet type="text/css">
<body bgcolor=menu style="font-size:9pt">
<?php
//����ϴ��ļ����ļ���С
if (filesize($src)>(2*1024*1024))
{
 echo "<br>".$src_name."����2M,�ϴ�ʧ�ܣ�";
 exit;
}
$js=split("\.",$src_name);
//����ϴ��ļ�����չ��
if (eregi("eml|exe|php|vxd|dll|asp|com|cmd|bat|htt|vbs|js|pl|cgi",$js[1]))
{
  echo "<br>".$src_name."�п���Σ��ϵͳ��ȫ���ϴ�ʧ�ܣ�";
  exit;
}
//����һ�γ����ж�Ŀ¼�Ƿ���ڣ���������������Ŀ¼
  $dir_name="news_img/".date("Y-m");//Ӳ�����ŵ���Ŀ���´�ŵ�Ŀ¼��ʽΪ����-�£���2002-01
  if (!is_dir($dir_name))
   {
     if (!mkdir($dir_name,0777)) 
     {
      echo "$dir_name Ŀ¼����ʧ�ܣ����ܽ��к���Ĳ���<BR><BR>��������Ȩ�޻���Ŀ¼·����";
      exit();
    }
  }
//����һ�γ����ж��ļ����Ƿ���ڣ���ȡ���豣����ļ�����$js[1]Ϊ�ϴ��ļ�����չ��
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
var src='<?php echo $new_file ?>';//ͼƬ·��
opener.top.form1.content_html.value+="<img src="+src+">";
//opener�����ǵ��õı༭����opener.top�Ǳ༭���ĸ������ڣ�form1�ǵ��ñ༭��ҳ��ı�
//Ҫע��������ñ༭����ҳ�治�ǿ��ҳ�������������Ϳ�����

//opener.top.glmain.form1.content_html.value+="<img border=0 src="+src+">";//������˿��ҳ�棬����article_add.asp���ڿ��ҳ�е�glmail����ô�������
window.close();
</script>

