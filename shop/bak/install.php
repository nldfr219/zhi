<?php
$title="�����̳�";
?>
<html>
<!--
<?php

// determine if php is running
if (1==0) {
  echo "-->��û������PHP��Ȩ�� - ����ϵ���ϵͳ����Ա.<!--";
} else {
  echo "--".">";
}

$onvservers=0; // set this to 1 if you're on Vservers and get disconnected after running an ALTER TABLE command

$version = "1.2.0";

error_reporting(7);

if (function_exists("set_time_limit")==1 and get_cfg_var("safe_mode")==0) {
  @set_time_limit(1200);
}

set_magic_quotes_runtime(0);

// allow script to work with registerglobals off
if ( function_exists('ini_get') ) {
        $onoff = ini_get('register_globals');
} else {
        $onoff = get_cfg_var('register_globals');
}
if ($onoff != 1) {
        @extract($HTTP_SERVER_VARS, EXTR_SKIP);
        @extract($HTTP_COOKIE_VARS, EXTR_SKIP);
        @extract($HTTP_POST_FILES, EXTR_SKIP);
        @extract($HTTP_POST_VARS, EXTR_SKIP);
        @extract($HTTP_GET_VARS, EXTR_SKIP);
        @extract($HTTP_ENV_VARS, EXTR_SKIP);
}

function iif($condition,$truevalue,$falsevalue) {
  if ($condition) {
    return $truevalue;
  } else {
    return $falsevalue;
  }
}

function doqueries() {
  global $DB_site,$query,$explain,$onvservers,$step;

  while (list($key,$val)=each($query)) {
    echo "<p>$explain[$key]</p>\n";
    echo "<"."!-- ".htmlspecialchars($val)." --".">\n\n";
    flush();
    if ($onvservers==1 and substr($val, 0, 5)=="ALTER") {
      $DB_site->reporterror=0;
    }
    $DB_site->query($val);
    if ($onvservers==1 and substr($val, 0, 5)=="ALTER") {
      $DB_site->link_id=0;
      @mysql_close();

      sleep(1);
      $DB_site->connect();

      if ($step!=4) {
        $DB_site->reporterror=1;
      }
    }
  }

  unset ($query);
  unset ($explain);
}

if (!isset($action)) {
?>
<HTML><HEAD>
<STYLE>
A:visited   {TEXT-DECORATION: none}
A:hover   {BACKGROUND-COLOR: #40364d; COLOR: #f5d300}
A:link        {TEXT-DECORATION: none}
A:active      {TEXT-DECORATION: none}
</STYLE>
<title> <?php echo $title; ?> ��װ�ű�</title>
<script language="JavaScript">
<!--
function areyousure() {
        if (confirm("�㼴����������ݿ������������,\������-<?php echo $title ?> ����.\n\n��ȷ��?")) {
                if (confirm("���Ѿ�ѡ�������������� MySQL ���ݿ�.\n<?php echo $title ?> �� Jelsoft Enterprises Ltd. ��������ִ���������ɵ�\n�κ�������ʧ����.\n\n��ͬ��������?")) {
                        return true;
                } else {
                        return false;
                }
        } else {
                return false;
        }
}
-->
</script>
</HEAD>
<BODY>
<table width="100%" bgcolor="#3F3849" cellpadding="2" cellspacing="0" border="0"><tr><td>
<table width="100%" bgcolor="#524A5A" cellpadding="3" cellspacing="0" border="0"><tr>
<td><a href="http://www.qwhy.com/" target="_blank"><img src="cp_logo.gif" width="160" height="49" border="0" alt="���������� <?php echo $title ?> ֧���̳�"></a></td>
<td width="100%" align="center">
<p><font color="#F7DE00"><b> <?php echo $title; ?> ��װ�ű�</b></font></p>
<p><font size="2" color="#F7DE00"><b>(ע��: �ⲿ����ҪһЩʱ�������ĵȴ�.)</b></font></p>
</td></tr></table></td></tr></table>
<br>
<?php
flush();
}

if ($step=="") {
  $step=1;
}

if ($step==1) {
/*
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
STEP 1
------

+ Introduction
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
*/
echo "<p>��ӭʹ�� $title �汾 $version. ��������ű��ɽ� $title �ɾ��ذ�װ����ķ�������.</p>";

 // these were causing problems. Gotta do more testing

echo "<p>�����ķ������Ƿ���� $title ��װҪ�� ...</p>\n<p>\n";

$phpversion = phpversion();
echo "PHP version: $phpversion ... ".iif($phpversion>="3.0.9", "ͨ��!", "<b>ʧ��!</b>")."<br>\n";
echo "MySQL support in PHP ... ".iif(function_exists("mysql_connect"), "ͨ��!", "<b>ʧ��!</b>")."<br>\n";
echo "PCRE support in PHP ... ".iif(function_exists("preg_replace"), "ͨ��!", "<b>ʧ��!</b>")."<br>\n";
echo "magic_quotes_sybase disabled ... ".iif(!get_cfg_var("magic_quotes_sybase"), "ͨ��!", "<b>ʧ��!</b>")."<br>\n";
$track_vars_check = get_cfg_var("track_vars");
if ($phpversion>="4.0.3") {
  $track_vars_check = 1;
}
echo "track_vars enabled ... ".iif($track_vars_check, "ͨ��!", "<b>ʧ��!</b>")."<br>\n";
$reg_globals_check = get_cfg_var("register_globals");
if (floor($phpversion)==3) {
  $reg_globals_check = 1; // 3.0.9 doesn't have register_globals
}
echo "register_globals enabled ... ".iif($reg_globals_check, "Passed!", "<b>Failed!</b>")."<br>\n";

echo "</p>\n<p>��ʹ����֮һ \"ʧ��,\" ��Ҳ���Խ���. �������������趨,����ͨ��.</p>\n";



echo "<p><a href=\"?step=".($step+1)."\"><b>������������һ�� --&gt;</b></a></p>\n";
}  // end step 1

if ($step==2) {
/*
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
STEP 2
------

+ check conf/options.php
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
*/

$canwrite=@fopen("conf/options.php","a");
@fclose($canwrite);
$canread=@fopen("conf/options.php","r");
@fclose($canread);
$fileexists=file_exists("conf/options.php");

if ($canwrite==0 and !$fileexists) {
        // file does not exist and cannot write new file
        echo "<p>�Ҳ��� conf/options.php �ļ�ϵͳҲ�޷��Զ�����һ��.</p>";
        echo "<p>��ȷ�ϲ��Ѿ��ϴ�����ļ������� �ǰ� Ŀ¼��. ���������������:</p>";
?>
<pre>
&lt;?php

/////////////////////////////////////////////////////////////
// Please note that if you get any errors when connecting, //
// that you will need to email your host as we cannot tell //
// you what your specific values are supposed to be        //
/////////////////////////////////////////////////////////////

// type of database running
// (only mysql is supported at the moment)
$dbservertype="mysql";

// hostname or ip of server
$dbservername="localhost";

// username and password to log onto db server
$dbusername="root";
$dbuserpass="";

// name of database
$dbname="forum";

// technical email address - any error messages will be emailed here
$siteemail = "dbmaster@your-email-address-here.com";

// use persistant connections to the database
// 0 = don't use
// 1 = use
$usepconnect = 1;

?&gt;</pre>
<?php
        echo "<p>ȷ�����ϴ� conf/options.php ���ļ���ǰ��û�пո���� <?php ?></p>";

        echo "<p>һ�����ϴ����µ� conf/options.php �ļ�, ��ˢ�±�ҳ.</p>";

  exit;
}

if ($canwrite==0 and $fileexists) {
        // test out config
        include("conf/options.php");

        echo "<p>��ȷ�������ϸ��:</p>\n";
        echo "<p><b>���ݿ����������:</b> mysql</p>\n";
        echo "<p><b>���ݿ��������������/IP ��ַ:</b> $dbservername</p>\n";
        echo "<p><b>���ݿ��û���:</b> $dbusername</p>\n";
        echo "<p><b>���ݿ�����:</b> $dbuserpass</p>\n";
        echo "<p><b>���ݿ���:</b> $dbname</p>\n";
        echo "<p>����������ȷ�������һ��. �������ȷ, ��༭��� conf/options.php �ļ���������. ��һ�����������ݿ�����.</p>";
  if ($siteemail=="dbmaster@your-email-address-here.com") {
    echo "<p>�������� '����֧�� email' ����� conf/options.php ����֮ǰ.</p>";
  } else {
    echo "<p><a href=\"?step=".($step+1)."\">��һ�� --&gt;</a></p>\n";
  }
}

if ($canwrite!=0 and $fileexists) {
        // test out config
        include("conf/options.php");

  echo "<form action=\"\" method=\"post\"><input type=hidden name=step value=writeconfig>";
        echo "<p>��ȷ�������ϸ��:</p>\n";
        echo "<p><b>���ݿ����������:</b> <input name=\"mysql\" value=\"mysql\"></p>\n";
        echo "<p><b>���ݿ��������������/IP ��ַ:</b> <input name=\"dbservername\" value=\"$dbservername\"></p>\n";
        echo "<p><b>���ݿ��û���:</b> <input name=\"dbusername\" value=\"$dbusername\"></p>\n";
        echo "<p><b>���ݿ�����:</b> <input name=\"dbuserpass\" value=\"$dbuserpass\"></p>\n";
        echo "<p><b>���ݿ���:</b> <input name=\"dbname\" value=\"$dbname\"></p>\n";
        echo "<p><input type=submit value=\"���� conf/options.php �ļ�\"></form></p>";
  if ($siteemail!="dbmaster@your-email-address-here.com") {
    echo "<p><form action=\"\" method=get><input type=hidden name=step value=".($step+1)."><input type=submit value=\"�����Ķ�����\"></form></p>\n";
  }
}

if ($canwrite!=0 and !$fileexists) {
  echo "<form action=\"\" method=\"post\"><input type=hidden name=step value=writeconfig>";
        echo "<p>��ȷ�������ϸ��:</p>\n";
        echo "<p><b>���ݿ����������:</b> <input name=\"dbservertype\" value=\"mysql\"></p>\n";
        echo "<p><b>���ݿ�������������� / IP address:</b> <input name=\"dbservername\" value=\"localhost\"></p>\n";
        echo "<p><b>���ݿ��û���:</b> <input name=\"dbusername\" value=\"root\"></p>\n";
        echo "<p><b>���ݿ�����:</b> <input name=\"dbpassword\" value=\"\"></p>\n";
        echo "<p><b>���ݿ���:</b> <input name=\"dbname\" value=\"netshop\"></p>\n";
        echo "<p><input type=submit value=\"���� conf/options.php �ļ�\"></form></p>";
}

}  // end step 2

if ($step=="writeconfig") {

$dbservertype = strtolower($dbservertype);
  //write config file

  if ($siteemail=="dbmaster@your-email-address-here.com") {
    echo "<P>�������µ� email ����֧�������ַ.</p>";
    exit;
  }
 

//����ģʽƥ���޸�conf/config.php�ļ�
   $admin_set="
 //���ݿ�����
\$dbservername=\"$dbservername\";
\$dbname=\"$dbname\";
\$dbusername=\"$dbusername\";
\$dbuserpass=\"$dbuserpass\";
";
   //�����ļ����������滻
   $fp=fopen("conf/options.php","r");
   $all=fread($fp,filesize("conf/options.php"));
   fclose($fp);
   $all=ereg_replace("//db_set_start (.*)//db_set_end","//db_set_start $admin_set\n//db_set_end",$all);
   //д���滻�������
   $fp=fopen("conf/options.php","w");
   fwrite($fp,$all);
   fclose($fp);


  $step=3;
}

if ($step>=3) {
  // step 3 and after, we are ok loading this file
  include("conf/options.php");
}

if ($step==3) {
/*
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
STEP 3
------

+ attempt database connectivity
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
*/

echo "<P>���ڳ����������ݿ�...</p>";

// connect to db
// load db class
$dbclassname="bak/db_mysql.php";
include($dbclassname);

$DB_site=new DB_Sql_vb;

// initialise vars
$DB_site->appname="$title Installer";
$DB_site->appshortname="$title (inst)";
$DB_site->database=$dbname;
$DB_site->server=$dbservername;
$DB_site->user=$dbusername;
$DB_site->password=$dbuserpass;

// allow this script to catch errors
$DB_site->reporterror=0;

$DB_site->connect();
// end init db

$errno=$DB_site->errno;

if ($DB_site->link_id!=0) {

        if ($errno!=0) {
                if ($errno==1049) {
                        echo "<p>��ָ�������ݿⲻ����. ���ڳ��Դ�����...</p>";
                        $DB_site->query("CREATE DATABASE $dbname");
                        echo "<p>�����ٴ�����...</p>";
                        $DB_site->select_db($dbname);

                        $errno=$DB_site->geterrno();

                        if ($errno==0) {
                                echo "<p>���ӳɹ�!</p>";
                                echo "<p><a href=\"?step=".($step+1)."\">���������� -></a></p>";
                        } else {
                                echo "<p>�ٴ�����ʧ��! ��ȷ�����ݿ�ͷ�����������ȷ���ٳ���.</p>";
                                echo "<p>��� <a href=\"http://www.qwhy.com/\"����</a> ���� $title ��վ</p>";
                                exit;
                        }
                } else {

                        echo "<p>����ʧ��: ���ݿ��������.</p>";
                        echo "<p>�����: ".$DB_site->errno."</p>";
                        echo "<p>��������: ".$DB_site->errdesc."</p>";
                        echo "<p>��ȷ�����ݿ�ͷ�����������ȷ���ٴγ���.</p>";
                        echo "<p>��� <a href=\"http://www.qwhy.com/\"����</a> ���� $title ��վ</p>";
                        exit;

                }
        } else {
                // succeeded! yay!
                echo "<p>���ӳɹ�! ���ݿ����.</p>";
                echo "<p><a href=\"?step=".($step+1)."\">���������� --&gt;</a></p>";
                // reset database??
                echo "<p>&nbsp;</p><p>&nbsp;</p><form action=\"\" method=\"get\" onSubmit=\"return areyousure();\">
                <input type=\"hidden\" name=\"step\" value=\"".($step+1)."\"><input type=\"hidden\" name=\"reset\" value=\"1\">
                <table cellpadding=\"10\" cellspacing=\"0\" border=\"0\" bgcolor=\"red\" align=\"center\" width=\"75%\"><tr><td>
                <table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" bgcolor=\"#CCCCCC\"><tr><td align=\"center\">
                �����ϣ��<b>��</b>���������ݿ���<b>����</b>����, ������水ť.
                �⽫������ MySQL ���ݿ�����������,
                <b>����</b>�κη�-$title ����!
                <p><input type=\"submit\" value=\"���������ݿ�\" style=\"background-color:red;color:white;font-weight:bold;font-size:12px\"></p>
                </td></tr></table></td></tr></table></form>";

        }
} else {
  echo "<p>��Ϊ��û�б��������ӵ����ݿ������������ʧ��. �뷵�ص���һ����ȷ���������������ĵ�¼ϸ����ȷ.</p>";
        echo "<p>��� <a href=\"http://www.qwhy.com/\"����</a> ���� $title ��վ</p>";
  exit;
}

}  // end step 3

if ($step>=4) {

  // connect to db
  // load db class
  $dbclassname="bak/db_mysql.php";
  include($dbclassname);

  if ($onvservers) {
    $usepconnect = 0;
  }

  $DB_site=new DB_Sql_vb;

  // initialise vars
  $DB_site->appname="$title Installer";
  $DB_site->appshortname="$title (inst)";
  $DB_site->database=$dbname;
  $DB_site->server=$dbservername;
  $DB_site->user=$dbusername;
  $DB_site->password=$dbuserpass;

  // allow this script to catch errors
//  $DB_site->reporterror=0;

  $DB_site->connect();
  // end init db
}

if ($step==4) {
/*
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
STEP 4
------

+ reset db
+ set up tables
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
*/

if ($reset==1) {
        echo "<p align=\"center\" style=\"font: bold 24pt verdana,arial,helvetica; color: Red\">�������ݿ�?</p>";
        //echo "<h1 align=\"center\"><font color=\"Red\">�������ݿ�?</font></h1>";
        echo "<p align=\"center\">ѡ�� YES ����, ����������ݿ⽫�����.</p>";
        echo "<p align=\"center\"><b>��Ҫ</b> ѡ�� YES ���������ݿ����<br>�κβ�ͬ�� $title ����, �⽫<br><b>���ָܻ�ɾ��</b>.</p>";
        echo "<p align=\"center\">�������������ֹ������ݱ�ɾ��!</p>";
        echo "<p align=\"center\"><a href=\"?step=4&resetdatabase=yes\">[ <b>YES</b>, ������ݿ�<b>����</b>���� ]</a></p>";
        echo "<p align=\"center\"><a href=\"?step=4\">[ <b>NO</b>, ��������ݿ� ]</a></p>";
        echo "<p align=\"center\"><font size=\"1\">$title and Jelsoft Enterprises Ltd. can hold no responsibility for any<br>loss of data incurred as a result of performing this action.</font></p>";
        exit;
}
if ($resetdatabase=="yes") {
        echo "<p>�����������ݿ�...";
        $result=$DB_site->query("SHOW tables");
        while ($currow=$DB_site->fetch_array($result)) {
                $DB_site->query("DROP TABLE IF EXISTS $currow[0]");
        }
        echo "�ɹ�</p>";
}

$DB_site->reporterror=1;

$query[]="CREATE TABLE ".$prefix."ad (
   id int(10) unsigned NOT NULL auto_increment,
   code mediumtext NOT NULL,
   views int(10) DEFAULT '0',
   visible smallint(5) DEFAULT '1',
   posttime datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   PRIMARY KEY (id)
);";
$explain[]="Creating table ".$prefix."ad";

$query[]="CREATE TABLE ".$prefix."class (
   id int(10) unsigned NOT NULL auto_increment,
   name varchar(40) binary NOT NULL,
   up_id int(10) unsigned DEFAULT '0' NOT NULL,
   KEY id (id)
);";
$explain[]="Creating table ".$prefix."class";

$query[]="CREATE TABLE ".$prefix."goods (
   id int(10) unsigned NOT NULL auto_increment,
   up_id int(10) unsigned DEFAULT '0' NOT NULL,
   class_id int(10) unsigned DEFAULT '0' NOT NULL,
   name varchar(60) NOT NULL,
   descript text NOT NULL,
   image varchar(40),
   price_m mediumint(9) DEFAULT '0' NOT NULL,
   price mediumint(9) DEFAULT '0' NOT NULL,
   state tinyint(4) DEFAULT '0' NOT NULL,
   date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   KEY id (id)
);";
$explain[]="Creating table ".$prefix."goods";

$query[]="CREATE TABLE ".$prefix."link (
   id int(10) unsigned NOT NULL auto_increment,
   name varchar(100) NOT NULL,
   url varchar(200) NOT NULL,
   image mediumtext NOT NULL,
   width int(6) DEFAULT '88',
   height int(6) DEFAULT '31',
   views int(10) DEFAULT '0',
   clicks int(10) DEFAULT '0',
   visible smallint(5) DEFAULT '1',
   posttime datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   PRIMARY KEY (id)
);";
$explain[]="Creating table ".$prefix."link";

$query[]="CREATE TABLE ".$prefix."news (
   id int(10) unsigned NOT NULL auto_increment,
   title varchar(100) NOT NULL,
   content text NOT NULL,
   key_words varchar(20),
   date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   read_no smallint(5) unsigned DEFAULT '0' NOT NULL,
   KEY id (id)
);
";
$explain[]="Creating table ".$prefix."news";

$query[]="CREATE TABLE ".$prefix."requests (
   id int(10) unsigned NOT NULL auto_increment,
   user_id int(10) unsigned DEFAULT '0' NOT NULL,
   name varchar(20) NOT NULL,
   sex tinyint(4) DEFAULT '0' NOT NULL,
   email varchar(60) NOT NULL,
   province varchar(10) NOT NULL,
   city varchar(12) NOT NULL,
   tel varchar(40) NOT NULL,
   address varchar(100) NOT NULL,
   post varchar(6) NOT NULL,
   attrib text,
   fee decimal(16,2) DEFAULT '0.00' NOT NULL,
   pay tinyint(4) DEFAULT '0' NOT NULL,
   send_out tinyint(4) DEFAULT '0' NOT NULL,
   payment tinyint(4) DEFAULT '0' NOT NULL,
   date_created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   KEY id (id)
);";
$explain[]="Creating table ".$prefix."requests";

$query[]="CREATE TABLE ".$prefix."shopping (
   id int(10) unsigned NOT NULL auto_increment,
   requests_id int(10) unsigned DEFAULT '0' NOT NULL,
   user_id int(10) unsigned DEFAULT '0' NOT NULL,
   goods_id int(10) unsigned DEFAULT '0' NOT NULL,
   goods_num mediumint(9) DEFAULT '0' NOT NULL,
   date_created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   KEY id (id)
);";
$explain[]="Creating table ".$prefix."shopping";

$query[]="CREATE TABLE ".$prefix."user (
   id int(10) unsigned NOT NULL auto_increment,
   u_name varchar(16) binary NOT NULL,
   u_pass varchar(16) binary NOT NULL,
   name varchar(20) NOT NULL,
   sex tinyint(4) DEFAULT '0' NOT NULL,
   email varchar(60) NOT NULL,
   province varchar(10) NOT NULL,
   city varchar(12) NOT NULL,
   tel varchar(40) NOT NULL,
   address varchar(100) NOT NULL,
   post varchar(6) NOT NULL,
   attrib text,
   paper_name varchar(6) NOT NULL,
   paper_num varchar(25) NOT NULL,
   zzbh varchar(100),
   khhh varchar(100),
   khzh varchar(100),
   reg_date date DEFAULT '0000-00-00' NOT NULL,
   last_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   times int(10) unsigned DEFAULT '0' NOT NULL,
   action enum('y','n') DEFAULT 'y' NOT NULL,
   KEY id (id)
);";
$explain[]="Creating table ".$prefix."user";

$query[]="CREATE TABLE ".$prefix."vote (
   id int(10) unsigned NOT NULL auto_increment,
   caption varchar(100) NOT NULL,
   thing varchar(200) NOT NULL,
   data varchar(100) NOT NULL,
   date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   PRIMARY KEY (id)
);
";
$explain[]="Creating table ".$prefix."vote";

doqueries();

if ($DB_site->errno!=0) {
        echo "<p>�ڴ���������нű�����.�����ȷ�����ⲻ�Ǻ����صĻ����Լ���.</p>";
        echo "<p>������:</p>";
        echo "<p>�����: ".$DB_site->errno."</p>";
        echo "<p>��������: ".$DB_site->errdesc."</p>";
} else {
        echo "<p>���ݱ����óɹ�.</p>";
}

echo "<p><a href=\"?step=".($step+1)."\">��һ�� --&gt;</a></p>\n";
}  // end step 4

if ($step==5) {
/*
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
STEP 5
------

+ add default data
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
*/


echo "<p>ȫ�����ݱ����óɹ�. ��һ������ģ��.";

echo "<p><a href=\"?step=".($step+1)."\">��һ�� --&gt;</a></p>\n";
}  // end step 5

if ($step==6) {
/*
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
STEP 6
------

+ install templates
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
*/


$path="conf/style.css";

if(file_exists($path)==0) {
        $styletext="";
} else {
        $filesize=filesize($path);

        $filenum=fopen($path,"r");

        $styletext=fread($filenum,$filesize);

        fclose($filenum);
}

if ($styletext=="") {
  echo "<p>��ȷ�� sytle.style �ļ�����confĿ¼. Ȼ��ˢ�µ�ǰҳ.</p>";
  exit;
}


echo "<p>ģ�����óɹ�����һ���㽫�����̳�ѡ��.</p>";

echo "<p><a href=\"?step=".($step+1)."\">��һ�� --&gt;</a></p>
\n"; } // end step 6
if ($step==7) {
	/* =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= STEP 7 ------ + set options =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= 
*/
if ($PATH_INFO) { $scriptpath = $PATH_INFO; } else { $scriptpath = $PHP_SELF; }
$bburl = "http://$SERVER_NAME".dirname($scriptpath); 
$homeurl = "http://$SERVER_NAME/"; $webmaster = "webmaster@$SERVER_NAME"; ?>
<form action="" method="post">
<input type="hidden" name="step" value="8">

  <table border=0>
    <tr> 
      <td><b>�̳�����</b></td>
      <td> 
        <input type="text" size="35" name="sitename2">
      </td>
    </tr>
    <tr> 
      <td colspan=2>�̳�����. ������ҳ��Ĵ��ڱ���.<br>
      </td>
    </tr>
    <tr> 
      <td><b>��Ȩ��Ϣ</b></td>
      <td> 
        <input type="text" size="35" name="sitecopyright2" value="����ϰϰ">
      </td>
    </tr>
    <tr> 
      <td colspan="2">��վ�İ�Ȩ��Ϣ. ����ʾҳ��ײ�.</td>
    </tr>
    <tr> 
      <td><b>�̳� URL</b></td>
      <td> 
        <input type="text" size="35" name="siteurl2" value="<?php echo $bburl ?>">
      </td>
    </tr>
    <tr> 
      <td colspan=2>�̳� URL (β��û�� "/").<br>
      </td>
    </tr>
  </table>
<input type=submit value="�ύѡ�������һ��">
</form>
<?php

} // end step 7

if ($step==8) {
/*
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
STEP 8
------

+ set up options
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
*/
if ($sitename2=="" || $sitecopyright2=="" || $siteurl2=="") {
  echo "<p>����ǰһҳ��������ֶ��������������ֵ. �밴��������˺�ť�������������.</p>";
  exit;
}

if (get_magic_quotes_gpc()) {
  $bbtitle=stripslashes($bbtitle);
  $hometitle=stripslashes($hometitle);
}

//ģʽƥ�����conf/options.php�ļ�
   //ģʽƥ�� �ڴ˸���conf/options.php�еĹ���Ա;
   $admin_set="
 //��������
\$sitename=\"$sitename2\";   //��վ����
\$siteurl=\"$siteurl2\";   //��վ��ַ 
\$sitecopyright = \"$sitecopyright2\";          //��վ��Ȩ��
";
   //�����ļ����������滻
   $fp=fopen("conf/options.php","r");
   $all=fread($fp,filesize("conf/options.php"));
   fclose($fp);
   $all=ereg_replace("//base_set_start (.*)//base_set_end","//base_set_start $admin_set\n//base_set_end",$all);
   //д���滻�������
   $fp=fopen("conf/options.php","w");
   fwrite($fp,$all);
   fclose($fp);

echo "<p>�������������</p>\n";



echo "<p>ѡ����Ӳ����óɹ�. �������һ���������Լ���Ϊ����Ա.</p>";
echo "<p><a href=\"?step=".($step+1)."\">��һ�� --&gt;</a></p>\n";

} // end step 8

if ($step==9) {
/*
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
STEP 9
------

+ get admin details
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
*/

?><p>�������������д�������Լ���Ϊ����Ա...</p>

<form action="" method="post">
<input type="hidden" name="step" value="<?php echo ($step+1); ?>">

<table border=0>

<tr>
<td>�û���</td>
<td><input type="text" size="35" name="ad_name2"></td>
</tr>
<tr>
<td>�ܡ���</td>
<td><input type="text" size="35" name="ad_pass2"></td>
</tr>
<tr>
<td>Email ��ַ</td>
<td><input type="text" size="35" name="siteemail2"></td>
</tr>
</table>
<input type=submit value="�ύ����������һ��">
</form>
<?php

} // end step 9

if ($step==10) {
/*
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
STEP 10
-------

+ add admin
+ done!
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
*/

  echo "<p>����������Ϊ����Ա...</p>";

  if ($ad_name2=="" or $ad_pass2=="" or $siteemail2=="") {
    echo "<p>��������б�.</p>";
  } else {
   
   //ģʽƥ�� �ڴ˸���conf/options.php�еĹ���Ա;
   $admin_set="
    //��վ����Ա����
\$ad_name=\"$ad_name2\";   //��վ����Ա�û���
\$ad_pass=\"$ad_pass2\";   //��վ����Ա����
\$siteemail=\"$siteemail2\";   //��վ����Ա������
";
   //�����ļ����������滻
   $fp=fopen("conf/options.php","r");
   $all=fread($fp,filesize("conf/options.php"));
   fclose($fp);
   $all=ereg_replace("//admin_set_start (.*)//admin_set_end","//admin_set_start $admin_set\n//admin_set_end",$all);
   //д���滻�������
   $fp=fopen("conf/options.php","w");
   fwrite($fp,$all);
   fclose($fp);

    echo "<p>���óɹ�!</p>";
    //echo "<p>���Ѿ�����̳ǰ�װ. һ����ɾ����װ�ű�. ��Ϳ��Խ����������������. ���ڰ�ȫԭ��. ��δɾ����װ�ű�֮ǰ. �㽫�޷�����������.</p>";

    //echo "<p>����ļ������ɾ��: </p>";
    echo "<p>���Ѿ�����̳ǰ�װ. �����·������ӽ����������������. ���ڰ�ȫԭ��. �ڽ����������install.php�ļ����Զ�ɾ��, ����ڽ���������ʱ, ����ʾ��ȫ����, ��ô����������ԭ��û���Զ�ɾ��, ��ͨ�� FTP ɾ��, ������δɾ����װ�ű�֮ǰ. �㽫�޷�����������.</p>";
    echo "<p>���������� <b><a href='admin.php'>����</a></b></p>";
  }
}

echo "</"."body>";
echo "<"."!--";
?>
-->
</html>