<?php
$title="商上商城";
?>
<html>
<!--
<?php

// determine if php is running
if (1==0) {
  echo "-->你没有运行PHP的权限 - 请联系你的系统管理员.<!--";
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
<title> <?php echo $title; ?> 安装脚本</title>
<script language="JavaScript">
<!--
function areyousure() {
        if (confirm("你即将从你的数据库清空所有数据,\包括非-<?php echo $title ?> 数据.\n\n你确定?")) {
                if (confirm("你已经选择了清除你的整个 MySQL 数据库.\n<?php echo $title ?> 和 Jelsoft Enterprises Ltd. 不负责你执行这操作造成的\n任何数据损失责任.\n\n你同意这条件?")) {
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
<td><a href="http://www.qwhy.com/" target="_blank"><img src="cp_logo.gif" width="160" height="49" border="0" alt="点击这里访问 <?php echo $title ?> 支持商城"></a></td>
<td width="100%" align="center">
<p><font color="#F7DE00"><b> <?php echo $title; ?> 安装脚本</b></font></p>
<p><font size="2" color="#F7DE00"><b>(注意: 这部分需要一些时间请耐心等待.)</b></font></p>
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
echo "<p>欢迎使用 $title 版本 $version. 运行这个脚本可将 $title 干净地安装到你的服务器上.</p>";

 // these were causing problems. Gotta do more testing

echo "<p>检测你的服务器是否符合 $title 安装要求 ...</p>\n<p>\n";

$phpversion = phpversion();
echo "PHP version: $phpversion ... ".iif($phpversion>="3.0.9", "通过!", "<b>失败!</b>")."<br>\n";
echo "MySQL support in PHP ... ".iif(function_exists("mysql_connect"), "通过!", "<b>失败!</b>")."<br>\n";
echo "PCRE support in PHP ... ".iif(function_exists("preg_replace"), "通过!", "<b>失败!</b>")."<br>\n";
echo "magic_quotes_sybase disabled ... ".iif(!get_cfg_var("magic_quotes_sybase"), "通过!", "<b>失败!</b>")."<br>\n";
$track_vars_check = get_cfg_var("track_vars");
if ($phpversion>="4.0.3") {
  $track_vars_check = 1;
}
echo "track_vars enabled ... ".iif($track_vars_check, "通过!", "<b>失败!</b>")."<br>\n";
$reg_globals_check = get_cfg_var("register_globals");
if (floor($phpversion)==3) {
  $reg_globals_check = 1; // 3.0.9 doesn't have register_globals
}
echo "register_globals enabled ... ".iif($reg_globals_check, "Passed!", "<b>Failed!</b>")."<br>\n";

echo "</p>\n<p>即使上述之一 \"失败,\" 你也可以进行. 建议你调整你的设定,可以通过.</p>\n";



echo "<p><a href=\"?step=".($step+1)."\"><b>点击这里继续下一步 --&gt;</b></a></p>\n";
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
        echo "<p>找不到 conf/options.php 文件系统也无法自动创建一个.</p>";
        echo "<p>请确认并已经上传这个文件并且在 鼻暗 目录中. 看起来向这个样子:</p>";
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
        echo "<p>确认你上传 conf/options.php 的文件在前后没有空格存在 <?php ?></p>";

        echo "<p>一旦你上传了新的 conf/options.php 文件, 并刷新本页.</p>";

  exit;
}

if ($canwrite==0 and $fileexists) {
        // test out config
        include("conf/options.php");

        echo "<p>请确认下面的细节:</p>\n";
        echo "<p><b>数据库服务器类型:</b> mysql</p>\n";
        echo "<p><b>数据库服务器主机名字/IP 地址:</b> $dbservername</p>\n";
        echo "<p><b>数据库用户名:</b> $dbusername</p>\n";
        echo "<p><b>数据库密码:</b> $dbuserpass</p>\n";
        echo "<p><b>数据库名:</b> $dbname</p>\n";
        echo "<p>上述资料正确请继续下一步. 如果不正确, 请编辑你的 conf/options.php 文件并更新它. 下一步将测试数据库连接.</p>";
  if ($siteemail=="dbmaster@your-email-address-here.com") {
    echo "<p>请更新你的 '技术支持 email' 在你的 conf/options.php 继续之前.</p>";
  } else {
    echo "<p><a href=\"?step=".($step+1)."\">下一步 --&gt;</a></p>\n";
  }
}

if ($canwrite!=0 and $fileexists) {
        // test out config
        include("conf/options.php");

  echo "<form action=\"\" method=\"post\"><input type=hidden name=step value=writeconfig>";
        echo "<p>请确认下面的细节:</p>\n";
        echo "<p><b>数据库服务器类型:</b> <input name=\"mysql\" value=\"mysql\"></p>\n";
        echo "<p><b>数据库服务器主机名字/IP 地址:</b> <input name=\"dbservername\" value=\"$dbservername\"></p>\n";
        echo "<p><b>数据库用户名:</b> <input name=\"dbusername\" value=\"$dbusername\"></p>\n";
        echo "<p><b>数据库密码:</b> <input name=\"dbuserpass\" value=\"$dbuserpass\"></p>\n";
        echo "<p><b>数据库名:</b> <input name=\"dbname\" value=\"$dbname\"></p>\n";
        echo "<p><input type=submit value=\"更新 conf/options.php 文件\"></form></p>";
  if ($siteemail!="dbmaster@your-email-address-here.com") {
    echo "<p><form action=\"\" method=get><input type=hidden name=step value=".($step+1)."><input type=submit value=\"不做改动继续\"></form></p>\n";
  }
}

if ($canwrite!=0 and !$fileexists) {
  echo "<form action=\"\" method=\"post\"><input type=hidden name=step value=writeconfig>";
        echo "<p>请确认下面的细节:</p>\n";
        echo "<p><b>数据库服务器类型:</b> <input name=\"dbservertype\" value=\"mysql\"></p>\n";
        echo "<p><b>数据库服务器主机名字 / IP address:</b> <input name=\"dbservername\" value=\"localhost\"></p>\n";
        echo "<p><b>数据库用户名:</b> <input name=\"dbusername\" value=\"root\"></p>\n";
        echo "<p><b>数据库密码:</b> <input name=\"dbpassword\" value=\"\"></p>\n";
        echo "<p><b>数据库名:</b> <input name=\"dbname\" value=\"netshop\"></p>\n";
        echo "<p><input type=submit value=\"更新 conf/options.php 文件\"></form></p>";
}

}  // end step 2

if ($step=="writeconfig") {

$dbservertype = strtolower($dbservertype);
  //write config file

  if ($siteemail=="dbmaster@your-email-address-here.com") {
    echo "<P>请输入新的 email 技术支持信箱地址.</p>";
    exit;
  }
 

//利用模式匹配修改conf/config.php文件
   $admin_set="
 //数据库设置
\$dbservername=\"$dbservername\";
\$dbname=\"$dbname\";
\$dbusername=\"$dbusername\";
\$dbuserpass=\"$dbuserpass\";
";
   //读出文件，并进行替换
   $fp=fopen("conf/options.php","r");
   $all=fread($fp,filesize("conf/options.php"));
   fclose($fp);
   $all=ereg_replace("//db_set_start (.*)//db_set_end","//db_set_start $admin_set\n//db_set_end",$all);
   //写入替换后的内容
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

echo "<P>正在尝试连接数据库...</p>";

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
                        echo "<p>你指定的数据库不存在. 正在尝试创建它...</p>";
                        $DB_site->query("CREATE DATABASE $dbname");
                        echo "<p>尝试再次连接...</p>";
                        $DB_site->select_db($dbname);

                        $errno=$DB_site->geterrno();

                        if ($errno==0) {
                                echo "<p>连接成功!</p>";
                                echo "<p><a href=\"?step=".($step+1)."\">点击这里继续 -></a></p>";
                        } else {
                                echo "<p>再次连接失败! 请确定数据库和服务器配置正确后再尝试.</p>";
                                echo "<p>点击 <a href=\"http://www.qwhy.com/\"这里</a> 访问 $title 网站</p>";
                                exit;
                        }
                } else {

                        echo "<p>连接失败: 数据库意外错误.</p>";
                        echo "<p>错误号: ".$DB_site->errno."</p>";
                        echo "<p>错误描述: ".$DB_site->errdesc."</p>";
                        echo "<p>请确定数据库和服务器配置正确后再次尝试.</p>";
                        echo "<p>点击 <a href=\"http://www.qwhy.com/\"这里</a> 访问 $title 网站</p>";
                        exit;

                }
        } else {
                // succeeded! yay!
                echo "<p>连接成功! 数据库存在.</p>";
                echo "<p><a href=\"?step=".($step+1)."\">点击这里继续 --&gt;</a></p>";
                // reset database??
                echo "<p>&nbsp;</p><p>&nbsp;</p><form action=\"\" method=\"get\" onSubmit=\"return areyousure();\">
                <input type=\"hidden\" name=\"step\" value=\"".($step+1)."\"><input type=\"hidden\" name=\"reset\" value=\"1\">
                <table cellpadding=\"10\" cellspacing=\"0\" border=\"0\" bgcolor=\"red\" align=\"center\" width=\"75%\"><tr><td>
                <table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" bgcolor=\"#CCCCCC\"><tr><td align=\"center\">
                如果你希望<b>并</b>清空你的数据库中<b>所有</b>数据, 点击下面按钮.
                这将清空你的 MySQL 数据库中所有数据,
                <b>包括</b>任何非-$title 数据!
                <p><input type=\"submit\" value=\"清空你的数据库\" style=\"background-color:red;color:white;font-weight:bold;font-size:12px\"></p>
                </td></tr></table></td></tr></table></form>";

        }
} else {
  echo "<p>因为你没有被允许连接到数据库服务器，连接失败. 请返回到上一步并确认你输入的所有你的登录细节正确.</p>";
        echo "<p>点击 <a href=\"http://www.qwhy.com/\"这里</a> 访问 $title 网站</p>";
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
        echo "<p align=\"center\" style=\"font: bold 24pt verdana,arial,helvetica; color: Red\">重置数据库?</p>";
        //echo "<h1 align=\"center\"><font color=\"Red\">重置数据库?</font></h1>";
        echo "<p align=\"center\">选择 YES 这项, 你的整个数据库将被清空.</p>";
        echo "<p align=\"center\"><b>不要</b> 选择 YES 如果你的数据库包含<br>任何不同于 $title 数据, 这将<br><b>不能恢复删除</b>.</p>";
        echo "<p align=\"center\">这是你最后机会防止你的数据被删除!</p>";
        echo "<p align=\"center\"><a href=\"?step=4&resetdatabase=yes\">[ <b>YES</b>, 清空数据库<b>所有</b>数据 ]</a></p>";
        echo "<p align=\"center\"><a href=\"?step=4\">[ <b>NO</b>, 不清空数据库 ]</a></p>";
        echo "<p align=\"center\"><font size=\"1\">$title and Jelsoft Enterprises Ltd. can hold no responsibility for any<br>loss of data incurred as a result of performing this action.</font></p>";
        exit;
}
if ($resetdatabase=="yes") {
        echo "<p>正在重置数据库...";
        $result=$DB_site->query("SHOW tables");
        while ($currow=$DB_site->fetch_array($result)) {
                $DB_site->query("DROP TABLE IF EXISTS $currow[0]");
        }
        echo "成功</p>";
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
        echo "<p>在创建表过程中脚本出错.如果你确认问题不是很严重的话可以继续.</p>";
        echo "<p>错误是:</p>";
        echo "<p>错误号: ".$DB_site->errno."</p>";
        echo "<p>错误描述: ".$DB_site->errdesc."</p>";
} else {
        echo "<p>数据表设置成功.</p>";
}

echo "<p><a href=\"?step=".($step+1)."\">下一步 --&gt;</a></p>\n";
}  // end step 4

if ($step==5) {
/*
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
STEP 5
------

+ add default data
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
*/


echo "<p>全部数据表配置成功. 下一步配置模板.";

echo "<p><a href=\"?step=".($step+1)."\">下一步 --&gt;</a></p>\n";
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
  echo "<p>请确认 sytle.style 文件存在conf目录. 然后刷新当前页.</p>";
  exit;
}


echo "<p>模板配置成功，下一步你将设置商城选项.</p>";

echo "<p><a href=\"?step=".($step+1)."\">下一步 --&gt;</a></p>
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
      <td><b>商城名称</b></td>
      <td> 
        <input type="text" size="35" name="sitename2">
      </td>
    </tr>
    <tr> 
      <td colspan=2>商城名称. 是所有页面的窗口标题.<br>
      </td>
    </tr>
    <tr> 
      <td><b>版权信息</b></td>
      <td> 
        <input type="text" size="35" name="sitecopyright2" value="海风习习">
      </td>
    </tr>
    <tr> 
      <td colspan="2">网站的版权信息. 将显示页面底部.</td>
    </tr>
    <tr> 
      <td><b>商城 URL</b></td>
      <td> 
        <input type="text" size="35" name="siteurl2" value="<?php echo $bburl ?>">
      </td>
    </tr>
    <tr> 
      <td colspan=2>商城 URL (尾部没有 "/").<br>
      </td>
    </tr>
  </table>
<input type=submit value="提交选项并进行下一步">
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
  echo "<p>请在前一页面的所有字段中添入你的设置值. 请按浏览器的退后按钮修正错误后重试.</p>";
  exit;
}

if (get_magic_quotes_gpc()) {
  $bbtitle=stripslashes($bbtitle);
  $hometitle=stripslashes($hometitle);
}

//模式匹配更新conf/options.php文件
   //模式匹配 在此更新conf/options.php中的管理员;
   $admin_set="
 //基本设置
\$sitename=\"$sitename2\";   //网站名称
\$siteurl=\"$siteurl2\";   //网站网址 
\$sitecopyright = \"$sitecopyright2\";          //网站版权人
";
   //读出文件，并进行替换
   $fp=fopen("conf/options.php","r");
   $all=fread($fp,filesize("conf/options.php"));
   fclose($fp);
   $all=ereg_replace("//base_set_start (.*)//base_set_end","//base_set_start $admin_set\n//base_set_end",$all);
   //写入替换后的内容
   $fp=fopen("conf/options.php","w");
   fwrite($fp,$all);
   fclose($fp);

echo "<p>添加设置组数据</p>\n";



echo "<p>选项添加并设置成功. 请继续下一步设置你自己作为管理员.</p>";
echo "<p><a href=\"?step=".($step+1)."\">下一步 --&gt;</a></p>\n";

} // end step 8

if ($step==9) {
/*
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
STEP 9
------

+ get admin details
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
*/

?><p>请在下面表单中填写设置你自己作为管理员...</p>

<form action="" method="post">
<input type="hidden" name="step" value="<?php echo ($step+1); ?>">

<table border=0>

<tr>
<td>用户名</td>
<td><input type="text" size="35" name="ad_name2"></td>
</tr>
<tr>
<td>密　码</td>
<td><input type="text" size="35" name="ad_pass2"></td>
</tr>
<tr>
<td>Email 地址</td>
<td><input type="text" size="35" name="siteemail2"></td>
</tr>
</table>
<input type=submit value="提交表单并进行下一步">
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

  echo "<p>正在设置你为管理员...</p>";

  if ($ad_name2=="" or $ad_pass2=="" or $siteemail2=="") {
    echo "<p>请完成所有表单.</p>";
  } else {
   
   //模式匹配 在此更新conf/options.php中的管理员;
   $admin_set="
    //网站管理员设置
\$ad_name=\"$ad_name2\";   //网站管理员用户名
\$ad_pass=\"$ad_pass2\";   //网站管理员密码
\$siteemail=\"$siteemail2\";   //网站管理员的邮箱
";
   //读出文件，并进行替换
   $fp=fopen("conf/options.php","r");
   $all=fread($fp,filesize("conf/options.php"));
   fclose($fp);
   $all=ereg_replace("//admin_set_start (.*)//admin_set_end","//admin_set_start $admin_set\n//admin_set_end",$all);
   //写入替换后的内容
   $fp=fopen("conf/options.php","w");
   fwrite($fp,$all);
   fclose($fp);

    echo "<p>设置成功!</p>";
    //echo "<p>你已经完成商城安装. 一旦你删除安装脚本. 你就可以进入控制面板进行设置. 基于安全原因. 在未删除安装脚本之前. 你将无法进入控制面板.</p>";

    //echo "<p>这个文件你必须删除: </p>";
    echo "<p>你已经完成商城安装. 请点击下方的链接进入控制面板进行设置. 基于安全原因. 在进入控制面板后，install.php文件将自动删除, 如果在进入控制面板时, 仍提示安全警告, 那么由于其它的原因没有自动删除, 请通过 FTP 删除, 否则在未删除安装脚本之前. 你将无法进入控制面板.</p>";
    echo "<p>进入控制面板 <b><a href='admin.php'>这里</a></b></p>";
  }
}

echo "</"."body>";
echo "<"."!--";
?>
-->
</html>