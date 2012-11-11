2002-10-15

中文版简单安装说明：
-------------------
- 仔细配置好 include/config.inc.php 文件, 只需修改以下变量（文件中都有中文注释）：
  lvc_url
  lvc_db_host
  lvc_db_user
  lvc_db_password
  lvc_db_database
  lvc_site_name
  lvc_img_site_name 
  lvc_site_opening_year
  lvc_site_opening_month
  lvc_cookie_name

- 上传所有文件到服务器的一个目录. 保持文件目录结构.

- 将目录 include/caches 属性设为 0777（一般FTP工具如CuteFTP都支持CHMOD命令）

- 如果是首次安装, 请执行include\caches\stat.sql导入数据表. 推荐使用 phpMyAdmin 来导入数据表.

- 可以在用JavaScript调用统计（如放在php页面页脚中）
  统计图标显示风格目前共有4种(默认为显示小图标, http://www.mydomain.com/为您的网站地址):

1.不显示内容
  <script language="JavaScript" src="http://www.mydomain.com/stat/include/countjs.php?style=1"></script>

2.显示滚动文本
  <script language="JavaScript" src="http://www.qwhy.com/stat/include/countjs.php?style=2"></script>

3.显示小图标
  <script language="JavaScript" src="http://www.mydomain.com/stat/include/countjs.php?style=3"></script>

4.显示大图标
  <script language="JavaScript" src="http://www.mydomain.com/stat/include/countjs.php?style=4"></script>

- 访问 index.php 查看统计结果

- 也可以在需要统计的页面调用 include/new-visitor.inc.php
  如 include($lvc_include_dir.'new-visitor.inc.php');

- 有任何问题可以到 轻舟网 - http://www.8421.org 论坛提问. 

/* ------------------------------------------------------------*/
/* 轻舟网 - 资源、创意与你共享
/* ------------------------------------------------------------*/
