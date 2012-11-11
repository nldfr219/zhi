<?php
if ($action=="") require "conf/config.php";
include "admin_check.php";
?>
<html>
<head>
<title><?php echo $sitename ?> -- 系统参数</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/admin.php"; ?>
<table width="750" align="center">
  <tr align="center"> 
    <td bgcolor="#EFEFEF"> 
      <p class="p13">
        系统参数</p>
<?php
if ($action=="system_setup")
{
  $str="<?php
//db_set_start //数据库设置
\$dbservername = \"$dbservername\";
\$dbname = \"$dbname\";
\$dbusername = \"$dbusername\";
\$dbuserpass = \"$dbuserpass\";
//db_set_end

  //数据库前缀 $prefix，数据库中各表的表名，一般不需要修改，暂时用到 9 个表
\$prefix = \"$prefix\";
\$news_t = \$prefix.\"news\";//新闻内容表
\$class_t = \$prefix.\"class\";//商品类别表
\$goods_t = \$prefix.\"goods\";//商品信息表
\$shopping_t = \$prefix.\"shopping\";//购买商品表
\$requests_t = \$prefix.\"requests\";//订单表
\$user_t = \$prefix.\"user\";//用户信息表
\$ad_t = \$prefix.\"ad\";//广告表
\$vote_t = \$prefix.\"vote\";//调查表
\$link_t = \$prefix.\"link\";//友情链接表

//用户注册
\$user_reg_flag = $user_reg_flag;

//base_set_start //基本设置
\$sitename = \"$sitename\";   //网站名称
\$siteurl = \"$siteurl\";   //网站网址 
\$sitecopyright = \"$sitecopyright\";          //网站版权人
//base_set_end

//admin_set_start //网站管理员设置
\$ad_name = \"$ad_name\";   //网站管理员用户名
\$ad_pass = \"$ad_pass\";   //网站管理员密码
\$siteemail = \"$siteemail\";   //网站管理员的邮箱
//admin_set_end

//打开或者关闭商店 
\$siteclose_flag = $siteclose_flag;
\$sitereason = \"$sitereason\";

//显示方式
\$num_to_show = $num_to_show;   //每页商品显示个数
\$num_to_show_news = $num_to_show_news;   //每页新闻显示个数

//订单设置
\$init_num = $init_num;   //订单的初始编号
\$rebate = $rebate;   //单张定单总额超过1000元的折扣, 用小数表示（0.1即10%)
\$jiti_num = $jiti_num;   //集体批量购买同一件商品的数量，当超过此数量时，将按$jiti_rebate的值进行打折
\$jiti_rebate = $jiti_rebate;   //集体批量购买同一件商品的数量，价格优惠20%(0.2即20%)
\$send_money = $send_money;   //每张订单的配送费，单元为元。
\$dingdang_days = $dingdang_days;   //每张订单的有效天数，如果在指定的天数内，用户未付款，则列入无效订单页面
\$del_delay = $del_delay; //用户产生订单后，若在此设定的时间内，再次登录，则可以删除此订单 单位：秒 如：1800秒即30分钟

//网站联系方式，可以有多个，用空格分开
\$siteadd = \"$siteadd\";
\$sitetel = \"$sitetel\";
\$siteemail = \"$siteemail\";

//其它设置
\$user_price = $user_price ; //商品的会员价，是否为登录会员才能看，1--用户必须登录才能看会员价  0--所有人都可以看会员价
\$init_action = \"$init_action\";//会员的action字段的初始值,y 表示注册即可使用，n 表示注册后需由管理员激活才能使用
\$guestbook  =  $guestbook ;  //是否使用留言本功能 1--使用 0--不使用
\$bbs_name   = \"$bbs_name\" ; //论坛名称
\$bbs_url    = \"$bbs_url\" ; //论坛网址，如果不使用此功能，则值为空
\$stat       = $stat ; //是否对网站进行流量统计
\$stat_type  = $stat_type ;   //统计图标显示风格目前共有4种 1.不显示内容  2.显示滚动文本  3.显示小图标  4.显示大图标

\$date_tmp = date(\"Y-m-d H:i:s\"); //日期格式，请不要修改，这和数据库的字段类型相关
?>";

  $fp=@fopen("conf/options.php","w");
  $flag=@fwrite($fp,$str);
  @fclose($fp);

  if ($flag)
   echo "系统参数设置成功。";
  else
	echo "系统参数设置失败，当前的操作已经停止。<BR><BR>请先手动修改conf/options.php文件的属性为777，再使用此功能。";
 echo "<BR>";
}
else
{
?>     
<form name="form1" method="post" action="">
        <table width="600" border="0" cellpadding="4" cellspacing="0" class="shadow">
          <tr> 
            <td width="50%"><a href="#system_db">[数据库设置]</a></td>
            <td width="50%"><a href="#reg_set">[用户注册]</a></td>
          </tr>
          <tr> 
            <td width="50%"><a href="#system_set">[基本设置]</a></td>
            <td width="50%"><a href="#close_set">[打开或者关闭商店]</a></td>
          </tr>
          <tr> 
            <td width="50%"><a href="#display_set">[显示方式]</a></td>
            <td width="50%"><a href="#dingdang_set">[订单设置]</a></td>
          </tr>
          <tr> 
            <td width="50%"><a href="#web_set">[商店设置]</a></td>
            <td width="50%"><a href="#other_set">[其它设置]</a></td>
          </tr>
        </table>
        <table width="600" border="0" cellpadding="1" cellspacing="0" class="tblborder">
          <tr> 
            <td> 
              <table width="600" border="0" cellpadding="4" cellspacing="0">
                <tr> 
                  <td colspan="2" class="tblhead"><a name="system_db"></a>数据库设置</td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">MySql数据库地址<br>
                    MySql数据库地址，即数据库的服务器名或IP地址.</td>
                  <td width="49%">
                    <input type="text" name="dbservername" value="<?php echo $dbservername ?>">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">MySql数据库帐号<br>
                    MySql数据库帐号，这是登录服务器的账号.<br>
                  </td>
                  <td width="49%">
                    <input type="text" name="dbusername" value="<?php echo $dbusername ?>">
                  </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">MySql数据库密码<br>
                    MySql数据库密码，这是登录服务器的密码.<br>
                  </td>
                  <td width="49%">
                    <input type="text" name="dbuserpass" value="<?php echo $dbuserpass ?>">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">要使用的数据库<br>
                    要使用的数据库，这是使用的数据库名称.<br>
                  </td>
                  <td width="49%"> 
                    <input type="text" name="dbname" value="<?php echo $dbname ?>">
                  </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">数据库的前缀<br>
                    数据库的前缀，以便与其他数据库区别，如果数据库已经建立，请不要修改.<br>
                  </td>
                  <td width="49%">
                    <input type="text" name="prefix" value="<?php echo $prefix ?>">
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <table width="600" border="0" cellpadding="4" cellspacing="0">
          <tr> 
            <td colspan="2" class="tblhead"><a name="reg_set"></a>用户注册</td>
          </tr>
          <tr class="firstalt"> 
            <td width="50%">允许新用户注册：</td>
            <td width="50%">
              <input type="radio" name="user_reg_flag" value="1" <?php if ($user_reg_flag==1) echo "checked"; ?>>
              yes 　 
              <input type="radio" name="user_reg_flag" value="0" <?php if ($user_reg_flag==0) echo "checked"; ?>>
              no </td>
          </tr>
          <tr class="secondalt"> 
            <td width="50%">&nbsp;</td>
            <td width="50%">&nbsp;</td>
          </tr>
        </table>
        <table width="600" border="0" cellpadding="1" cellspacing="0" class="tblborder">
          <tr> 
            <td> 
              <table width="600" border="0" cellpadding="4" cellspacing="0">
                <tr> 
                  <td colspan="2" class="tblhead"><a name="system_set"></a>基本设置</td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">商店名称<br>
                    商店名称，这将是所有页面的窗口标题.</td>
                  <td width="49%"> 
                    <input type="text" value="<?php echo $sitename ?>" name="sitename">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">商店URL<br>
                    商店的URL(不要以 &quot;/&quot; 结尾).<br>
                  </td>
                  <td width="49%">
                    <input type="text" value="<?php echo $siteurl ?>" name="siteurl">
                  </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">版权信息<br>
                    插入每页页脚的版权信息.<br>
                  </td>
                  <td width="49%">
                    <input type="text" value="<?php echo $sitecopyright ?>" name="sitecopyright">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">管理员Email地址<br>
                    管理员的Email地址.<br>
                  </td>
                  <td width="49%">
                    <input type="text" value="<?php echo $siteemail ?>" name="siteemail">
                  </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">管理员用户名<br>
                    管理员用户名，管理员登录管理的用户名.<br>
                  </td>
                  <td width="49%">
                    <input type="text" value="<?php echo $ad_name ?>" name="ad_name">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">管理员密码<br>
                    管理员密码，管理员登录管理的密码.<br>
                  </td>
                  <td width="49%">
                    <input type="text" value="<?php echo $ad_pass ?>" name="ad_pass">
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <table width="600" border="0" cellpadding="1" cellspacing="0" class="tblborder">
          <tr> 
            <td> 
              <table width="600" border="0" cellpadding="4" cellspacing="0">
                <tr> 
                  <td colspan="2" class="tblhead"><a name="close_set"></a>打开或者关闭商店</td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">关闭商店<br>
                    有的时候你需要关闭商店,比如进行维护或者升级,这时候访问你的商店的用户会得到一条商店暂时关闭的信息,但管理员仍可管理商店.</td>
                  <td width="49%"> 
                    <input type="radio" name="web_close_flag" value="1" <?php if ($siteclose_flag==1) echo "checked"; ?>>
                    yes 　
<input type="radio" name="web_close_flag" value="0" <?php if ($siteclose_flag==0) echo "checked"; ?>>
                    no </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">商店关闭原因<br>
                    在商店关闭时出现这样的信息. 
                    <p>&nbsp;</p>
                  </td>
                  <td width="49%" height="84" align="left" valign="top"> 
                    <textarea name="web_reason" cols="45" rows="7"><?php echo $sitereason ?></textarea>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <table width="600" border="0" cellpadding="1" cellspacing="0" class="tblborder">
          <tr> 
            <td> 
              <table width="600" border="0" cellpadding="4" cellspacing="0">
                <tr> 
                  <td colspan="2" class="tblhead"><a name="display_set"></a>显示方式</td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">商品显示条数：</td>
                  <td> 
                    <input type="text" value="<?php echo $num_to_show ?>" name="num_to_show">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">购物新闻显示条数：</td>
                  <td> 
                    <input type="text" value="<?php echo $num_to_show_news ?>" name="num_to_show_news">
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <table width="600" border="0" cellpadding="1" cellspacing="0" class="tblborder">
          <tr> 
            <td> 
              <table width="600" border="0" cellpadding="4" cellspacing="0">
                <tr> 
                  <td colspan="2" class="tblhead"><a name="dingdang_set"></a>订单设置</td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">订单的初始编号<br>
                    订单的初始编号，以后所产生的订单都将加上这个初始编号.</td>
                  <td width="50%"> 
                    <input type="text" value="<?php echo $init_num ?>" name="init_num">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">订单折扣<br>
                    订单折扣，单张定单总额超过1000元的折扣, 用小数表示（0.1即10%).</td>
                  <td width="50%">
                    <input type="text" value="<?php echo $rebate ?>" name="rebate">
                  </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">优惠的数量<br>
                    优惠的数量，集体批量购买同一件商品的数量，当超过此数量时，将按下面的&quot;优惠比例&quot;进行打折.</td>
                  <td width="50%">
                    <input type="text" value="<?php echo $jiti_num ?>" name="jiti_num">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">优惠比例<br>
                    优惠比例，集体批量购买同一件商品的数量，价格优惠20%(0.2即20%).</td>
                  <td width="50%">
                    <input type="text" value="<?php echo $jiti_rebate ?>" name="jiti_rebate">
                    件 </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">订单配送费<br>
                    订单配送费，每张订单的配送费，单元为元.</td>
                  <td width="50%">
                    <input type="text" value="<?php echo $send_money ?>" name="send_money">
                    元 </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">订单的有效天数<br>
                    订单的有效天数，每张订单的有效天数，如果在指定的天数内，用户未付款，则列入无效订单页面.</td>
                  <td width="50%">
                    <input type="text" value="<?php echo $dingdang_days ?>" name="dingdang_days">
                    天 </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">订单有效删除时间<br>
                    订单有效删除时间，用户产生订单后，若在此设定的时间内，再次登录，则可以删除此订单 单位：秒 如：1800秒即30分钟.</td>
                  <td width="50%">
                    <input type="text" value="<?php echo $del_delay ?>" name="del_delay">
                    秒 </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <table width="600" border="0" cellpadding="1" cellspacing="0" class="tblborder">
          <tr> 
            <td> 
              <table width="600" border="0" cellpadding="4" cellspacing="0">
                <tr> 
                  <td colspan="2" class="tblhead"><a name="web_set"></a>商店设置</td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">网站联系方式<br>
                    地址，这将显示在每个页面的底部.</td>
                  <td width="50%"> 
                    <input type="text" value="<?php echo $siteadd ?>" name="web_add">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">电话，可以有多个，用空格分开，这将显示在每个页面的底部.</td>
                  <td width="50%">
                    <input type="text" value="<?php echo $sitetel ?>" name="web_tel">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">联系邮箱，这将显示在每个页面的底部.</td>
                  <td width="50%">
                    <input type="text" value="<?php echo $siteemail ?>" name="web_email">
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <table width="600" border="0" cellpadding="1" cellspacing="0" class="tblborder">
          <tr> 
            <td> 
              <table width="600" border="0" cellpadding="4" cellspacing="0">
                <tr> 
                  <td colspan="2" class="tblhead"><a name="other_set"></a>其它设置</td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">商品的会员价<br>
                    商品的会员价，是否只有会员才能查看商品的会员价.</td>
                  <td width="50%"> 
                    <input type="radio" name="user_price" value="1" <?php if ($user_price==1) echo "checked"; ?>>
                    yes 　 
                    <input type="radio" name="user_price" value="0" <?php if ($user_price==0) echo "checked"; ?>>
                    no </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">会员账号的初始值<br>
                    会员账号的初始值，会员注册后，是否就可以使用自己的账号.</td>
                  <td width="50%"> 
                    <input type="radio" name="init_action" value="y" <?php if ($init_action=="y") echo "checked"; ?>>
                    yes 　 
                    <input type="radio" name="init_action" value="n" <?php if ($init_action=="n") echo "checked"; ?>>
                    no </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">留言功能<br>
                    留言功能，是否使用网站的留言功能.</td>
                  <td> 
                    <input type="radio" name="guestbook" value="1" <?php if ($guestbook==1) echo "checked"; ?>>
                    yes 　 
                    <input type="radio" name="guestbook" value="0" <?php if ($guestbook==0) echo "checked"; ?>>
                    no </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">论坛名称<br>
                    论坛名称，链接论坛的论坛名称.</td>
                  <td width="50%"> 
                    <input type="text" value="<?php echo $bbs_name ?>" name="bbs_name">
                  </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">论坛地址<br>
                    论坛地址，为空则不显示该链接地址.</td>
                  <td width="50%"> 
                    <input type="text" value="<?php echo $bbs_url ?>" name="bbs_url">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">流量统计<br>
                    流量统计，是否对网站进行流量统计，统计所需的数据库设置请修改stat\include\config.inc.php文件，数据库结构文件stat\include\caches\stat.sql.</td>
                  <td width="50%"> 
                    <input type="radio" name="stat" value="1" <?php if ($stat==1) echo "checked"; ?>>
                    yes 　 
                    <input type="radio" name="stat" value="0" <?php if ($stat==0) echo "checked"; ?>>
                    no </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">统计图标<br>
                    统计图标，显示风格目前共有4种，这将在每个页面的底部显示.</td>
                  <td> 
                    <input type="radio" name="stat_type" value="1" <?php if ($stat_type==1) echo "checked"; ?>>
                    1.不显示内容<br>
                    <input type="radio" name="stat_type" value="2" <?php if ($stat_type==2) echo "checked"; ?>>
                    2.显示滚动文本<br>
                    <input type="radio" name="stat_type" value="3" <?php if ($stat_type==3) echo "checked"; ?>>
                    3.显示小图标<br>
                    <input type="radio" name="stat_type" value="4" <?php if ($stat_type==4) echo "checked"; ?>>
                    4.显示大图标 </td>
                </tr>
                <tr class="tblhead" align="center"> 
                  <td colspan="2" height="40"> 
                    <input type="hidden" name="action" value="system_setup">
                    <input type="submit" name="Submit" value="保存更改" class="stbtm2">
                    　　 
                    <input type="reset" name="Submit2" value="重置数据" class="stbtm2">
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        </form>
      <?php } ?>
    </td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
