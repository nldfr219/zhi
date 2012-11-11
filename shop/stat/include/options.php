<?
//数据库设置
$dbservername="localhost";
$dbname="qwhy";
$dbusername="qwhy";
$dbuserpass="o6e1f7c7";

  //数据库前缀  8 个表
$prefix="b2c_";
$news_t=b2c_."news";//新闻内容表
$class_t=b2c_."class";//商品类别表
$goods_t=b2c_."goods";//商品信息表
$shopping_t=b2c_."shopping";//购买商品表
$requests_t=b2c_."requests";//订单表
$user_t=b2c_."user";//用户信息表
$ad_t=b2c_."ad";//广告表
$vote_t=b2c_."vote";//调查表

//基本设置
$sitename="凯程商务网";   //网站名称
$siteurl="http://www.qwhy.com";   //网站网址 
$siteemail="qwhy@qwhy.com";   //网站管理员的邮箱
$sitecopyright = "凯程商务网";          //网站版权人
$ad_name="admin";   //网站管理员用户名
$ad_pass="wyx726";   //网站管理员密码

//打开或者关闭商店 
$siteclose_flag=0;
$sitereason="吃饭中，，，";

//显示方式
$num_to_show = 14;   //每页商品显示个数
$num_to_show_news = 14;   //每页新闻显示个数

//订单设置
$init_num=5000;   //订单的初始编号
$rebate=0.1;   //单张定单总额超过1000元的折扣, 用小数表示（0.1即10%)
$jiti_num=10;   //集体批量购买同一件商品的数量，当超过此数量时，将按
$jiti_rebate=0.2;   //集体批量购买同一件商品的数量，价格优惠20%(0.2即20%)
$send_money=10;   //每张订单的配送费，单元为元。
$dingdang_days=15;   //每张订单的有效天数，如果在指定的天数内，用户未付款，则列入无效订单页面
$del_delay=1800; //用户产生订单后，若在此设定的时间内，再次登录，则可以删除此订单 单位：秒 如：1800秒即30分钟

//商店设置
  //网站联系电话，可以有多个，用空格分开
$sitetel="电话:13008320193";

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

//其它设置
$user_price = 1 ; //商品的会员价，是否为登录会员才能看，1--用户必须登录才能看会员价  0--所有人都可以看会员价
$init_action="n";//会员的action字段的初始值,y 表示注册即可使用，n 表示注册后需由管理员激活才能使用
$guestbook  =  1 ;  //是否使用留言本功能 1--使用 0--不使用
$bbs_name   = "论坛22" ; //论坛名称
$bbs_url    = "http://www.qwhy.net/bbs22/" ; //论坛网址，如果不使用此功能，则值为空
$stat       = 1 ; //是否对网站进行流量统计
$stat_type  = 2 ;   //统计图标显示风格目前共有4种 1.不显示内容  2.显示滚动文本  3.显示小图标  4.显示大图标

$date_tmp=date("Y-m-d H:i:s"); //日期格式，请不要修改，这和数据库的字段类型相关
?>