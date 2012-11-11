<?PHP

require("config.inc.php");

$count_date = date("Y-m-d H:i");
@mysql_pconnect($lvc_db_host,$lvc_db_user,$lvc_db_password);

if ($lvc_count == page):
 $sql = "select num, today, time from $lvc_table_counter";
 $countresult = @mysql_db_query($lvc_db_database, $sql);
 $objResult = @mysql_fetch_object($countresult);
 $page_ip = $objResult->num;
else:
 $sql = "select count(*) as num from $lvc_table_visiteurs";
 $ipresult = @mysql_db_query($lvc_db_database, $sql);
 $page_ip = @mysql_result($ipresult,0,"num");
endif;

if ($page_ip < 10 && $page_ip >= 0):
 $page_ip_txt = "0000000$page_ip";
elseif ($page_ip < 100):
 $page_ip_txt = "000000$page_ip";
elseif ($page_ip < 1000):
 $page_ip_txt = "00000$page_ip";
elseif ($page_ip < 10000):
 $page_ip_txt = "0000$page_ip";
elseif ($page_ip < 100000):
 $page_ip_txt = "000$page_ip";
elseif ($page_ip < 1000000):
 $page_ip_txt = "00$page_ip";
elseif ($page_ip < 10000000):
 $page_ip_txt = "0$page_ip";
elseif ($page_ip < 100000000):
 $page_ip_txt = "$page_ip";
else:
 $page_ip_txt = " Error!";
endif;


// show img -------------------------

header('Content-type: image/'.$lvc_images_format);

$imgfile = 'images/counter.'.$lvc_images_format;
$fct_imagecreatefrom = 'imagecreatefrom'.$lvc_images_format;
$img = $fct_imagecreatefrom($imgfile);

$black  = imagecolorallocate($img,   0,   0,   0);
$white  = imagecolorallocate($img, 255, 255, 255);
$yellow = imagecolorallocate($img, 255, 255,   0);

ImageString($img, 3, 26, 5, "$page_ip_txt", $black);
ImageString($img, 3, 25, 4, "$page_ip_txt", $white);
ImageString($img, 1, 5, 22, $count_date, $black);
ImageString($img, 1, 4, 21, $count_date, $yellow);

ImageInterlace($img,1);
$fct_image = 'image'.$lvc_images_format;
$fct_image($img);
ImageDestroy($img);


?>