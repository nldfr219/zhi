<?php
//db_set_start 
 //数据库设置
$dbservername="localhost";
$dbname="shop";
$dbusername="root";
$dbuserpass="135792468Mz";


//db_set_end

  //数据库前缀  9 个表
$prefix = "b2c_";
$news_t = $prefix."news";//新闻内容表
$class_t = $prefix."class";//商品类别表
$goods_t = $prefix."goods";//商品信息表
$shopping_t = $prefix."shopping";//购买商品表
$requests_t = $prefix."requests";//订单表
$user_t = $prefix."user";//用户信息表
$ad_t = $prefix."ad";//广告表
$vote_t = $prefix."vote";//调查表
$link_t = $prefix."link";//友情链接表

//用户注册
$user_reg_flag = 1;

//base_set_start 
 //基本设置
$sitename="Zhi Ma's Online Shop";   //网站名称
$siteurl="http://zmzhima.com/shop";   //网站网址 
$sitecopyright = "zhima";          //网站版权人

//base_set_end

//admin_set_start 
    //网站管理员设置
$ad_name="admin";   //网站管理员用户名
$ad_pass="admin";   //网站管理员密码
$siteemail="nldfr219@gmail.com";   //网站管理员的邮箱

//admin_set_end

//打开或者关闭商店 
$siteclose_flag = 0;
$sitereason = "In maintenance, please come back later";

//显示方式
$num_to_show = 6;   //每页商品显示个数
$num_to_show_news = 6;   //每页新闻显示个数

//订单设置
$init_num = 5000;   //订单的初始编号
$rebate = 0.1;   //单张定单总额超过1000元的折扣, 用小数表示（0.1即10%)
$jiti_num = 10;   //集体批量购买同一件商品的数量，当超过此数量时，将按
$jiti_rebate = 0.2;   //集体批量购买同一件商品的数量，价格优惠20%(0.2即20%)
$send_money = 10;   //每张订单的配送费，单元为元。
$dingdang_days = 15;   //每张订单的有效天数，如果在指定的天数内，用户未付款，则列入无效订单页面
$del_delay = 1800; //用户产生订单后，若在此设定的时间内，再次登录，则可以删除此订单 单位：秒 如：1800秒即30分钟

//网站联系方式，可以有多个，用空格分开
$siteadd = "2831 Ellendale Pl., Los Angeles, CA";
$sitetel = "213-300-2063";
$siteemail = "nldfr219@gmail.com";

//其它设置
$user_price = 1 ; //商品的会员价，是否为登录会员才能看，1--用户必须登录才能看会员价  0--所有人都可以看会员价
$init_action = "y";//会员的action字段的初始值,y 表示注册即可使用，n 表示注册后需由管理员激活才能使用
$guestbook  =  1 ;  //是否使用留言本功能 1--使用 0--不使用
$bbs_name   = "forum" ; //论坛名称
$bbs_url    = "" ; //论坛网址，如果不使用此功能，则值为空
$stat       = 1 ; //是否对网站进行流量统计
$stat_type  = 1 ;   //统计图标显示风格目前共有4种 1.不显示内容  2.显示滚动文本  3.显示小图标  4.显示大图标
date_default_timezone_set('America/Los_Angeles');

$date_tmp = date("Y-m-d H:i:s"); //日期格式，请不要修改，这和数据库的字段类型相关
?>