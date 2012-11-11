<?php
require "conf/config.php";
include "admin_check.php";
?>
<html>
<head>
<title><?php echo $sitename ?> -- 会员管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<?php echo $http_head; ?>
<link rel="stylesheet" href="conf/style.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php include "conf/admin.php"; ?>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="center"> 
    <td><img src="images/zlxg1.gif" width="133" height="33"></td>
  </tr>
  <tr align="center" bgcolor="#EFEFEF"> 
    <td> 
      <?php
if ($submit)
{
  $a=split(',',$province);
  $province=$a[1];
  $db->query("update $user_t set u_pass='$u_pass',name='$name',sex=$sex,email='$email',
            province='$province',city='$city',tel='$tel',address='$address',
			post='$post',attrib='$attrib',paper_name='$paper_name',paper_num='$paper_num',
			zzbh='$zzbh',khhh='$khhh',khzh='$khzh'
			where id=$id");
echo "<br><br><img src=\"images/xg_cg.gif\"><br><br>";
echo '正在返回会员管理首页<meta http-equiv="refresh" content="2;URL=admin_user.php"><br><br>';
}
else
{
$db->query("select * from $user_t where id=$id");
$db->next_record();
?>
      <script language=JavaScript>
prvarr= new Array(31);
ctylst= new Array(1000);
ss= new Array(3);
prvcnt=31;
prvarr[1]=new prv(1,'辽宁');
ctylst[1]=new prvcty(1,1,'沈阳市');
ctylst[2]=new prvcty(1,3,'鞍山');
ctylst[3]=new prvcty(1,4,'新民');
ctylst[4]=new prvcty(1,5,'抚顺');
ctylst[5]=new prvcty(1,18,'大连');
ctylst[6]=new prvcty(1,19,'本溪');
ctylst[7]=new prvcty(1,20,'丹东');
ctylst[8]=new prvcty(1,21,'锦州');
ctylst[9]=new prvcty(1,22,'营囗');
ctylst[10]=new prvcty(1,23,'阜新');
ctylst[11]=new prvcty(1,24,'辽阳');
ctylst[12]=new prvcty(1,25,'铁岭');
ctylst[13]=new prvcty(1,26,'瓦房店');
ctylst[14]=new prvcty(1,27,'海城');
ctylst[15]=new prvcty(1,28,'锦西');
ctylst[16]=new prvcty(1,29,'盘锦');
ctylst[17]=new prvcty(1,30,'朝阳');
prvarr[2]=new prv(2,'黑龙江');
ctylst[18]=new prvcty(2,38,'哈尔滨');
ctylst[19]=new prvcty(2,40,'齐齐哈尔');
ctylst[20]=new prvcty(2,41,'牡丹江');
ctylst[21]=new prvcty(2,42,'佳木斯');
ctylst[22]=new prvcty(2,43,'大庆');
ctylst[23]=new prvcty(2,170,'伊春');
prvarr[3]=new prv(3,'吉林');
ctylst[24]=new prvcty(3,31,'长春');
ctylst[25]=new prvcty(3,32,'吉林市');
ctylst[26]=new prvcty(3,33,'延吉');
ctylst[27]=new prvcty(3,34,'四平');
ctylst[28]=new prvcty(3,35,'通化');
ctylst[29]=new prvcty(3,36,'白城');
ctylst[30]=new prvcty(3,37,'辽源');
prvarr[4]=new prv(4,'河北');
ctylst[31]=new prvcty(4,10,'石家庄');
ctylst[32]=new prvcty(4,11,'唐山');
ctylst[33]=new prvcty(4,12,'秦皇岛');
prvarr[5]=new prv(5,'北京');
ctylst[34]=new prvcty(5,6,'北京市');
prvarr[6]=new prv(6,'上海');
ctylst[35]=new prvcty(6,7,'上海市');
prvarr[7]=new prv(7,'天津');
ctylst[36]=new prvcty(7,8,'天津市');
prvarr[8]=new prv(8,'山西');
ctylst[37]=new prvcty(8,13,'太原');
ctylst[38]=new prvcty(8,14,'大同');
ctylst[39]=new prvcty(8,15,'晋城');
prvarr[9]=new prv(9,'内蒙古');
ctylst[40]=new prvcty(9,16,'呼和浩特');
ctylst[41]=new prvcty(9,17,'赤峰');
prvarr[10]=new prv(10,'江苏');
ctylst[42]=new prvcty(10,44,'南京');
ctylst[43]=new prvcty(10,45,'镇江');
ctylst[44]=new prvcty(10,46,'苏州');
ctylst[45]=new prvcty(10,47,'南通');
ctylst[46]=new prvcty(10,48,'扬州');
ctylst[47]=new prvcty(10,49,'淮阴');
ctylst[48]=new prvcty(10,50,'无锡');
ctylst[49]=new prvcty(10,51,'张家港');
prvarr[11]=new prv(11,'浙江');
ctylst[50]=new prvcty(11,52,'杭州');
ctylst[51]=new prvcty(11,53,'嘉兴');
ctylst[52]=new prvcty(11,54,'宁波');
ctylst[53]=new prvcty(11,55,'温州');
ctylst[54]=new prvcty(11,56,'奉化');
prvarr[12]=new prv(12,'安徽');
ctylst[55]=new prvcty(12,57,'合肥');
ctylst[56]=new prvcty(12,58,'蚌埠');
ctylst[57]=new prvcty(12,59,'淮南');
ctylst[58]=new prvcty(12,60,'马鞍山');
prvarr[13]=new prv(13,'福建');
ctylst[59]=new prvcty(13,61,'福州');
ctylst[60]=new prvcty(13,62,'厦门');
ctylst[61]=new prvcty(13,63,'莆田');
prvarr[14]=new prv(14,'江西');
ctylst[62]=new prvcty(14,64,'南昌');
ctylst[63]=new prvcty(14,65,'九江');
ctylst[64]=new prvcty(14,66,'上饶');
ctylst[65]=new prvcty(14,67,'临川');
ctylst[66]=new prvcty(14,68,'宜春');
ctylst[67]=new prvcty(14,69,'赣州');
ctylst[68]=new prvcty(14,70,'景德镇');
ctylst[69]=new prvcty(14,71,'井风山');
prvarr[15]=new prv(15,'山东');
ctylst[70]=new prvcty(15,72,'济南');
ctylst[71]=new prvcty(15,73,'青岛');
ctylst[72]=new prvcty(15,74,'淄博');
ctylst[73]=new prvcty(15,75,'德州');
ctylst[74]=new prvcty(15,76,'烟台');
ctylst[75]=new prvcty(15,77,'潍坊');
ctylst[76]=new prvcty(15,78,'济宁');
ctylst[77]=new prvcty(15,79,'泰安');
ctylst[78]=new prvcty(15,80,'威海');
ctylst[79]=new prvcty(15,81,'荣城');
ctylst[80]=new prvcty(15,82,'莱州');
ctylst[81]=new prvcty(15,83,'枣庄');
ctylst[82]=new prvcty(15,84,'枣庄');
prvarr[16]=new prv(16,'河南');
ctylst[83]=new prvcty(16,85,'郑州');
ctylst[84]=new prvcty(16,86,'安阳');
ctylst[85]=new prvcty(16,87,'新乡');
ctylst[86]=new prvcty(16,88,'许昌');
ctylst[87]=new prvcty(16,89,'平顶山');
ctylst[88]=new prvcty(16,90,'信阳');
ctylst[89]=new prvcty(16,91,'南阳');
ctylst[90]=new prvcty(16,92,'开封');
ctylst[91]=new prvcty(16,93,'洛阳');
ctylst[92]=new prvcty(16,94,'商丘');
ctylst[93]=new prvcty(16,95,'焦作');
ctylst[94]=new prvcty(16,96,'驻马店');
ctylst[95]=new prvcty(16,97,'三门峡');
prvarr[17]=new prv(17,'湖北');
ctylst[96]=new prvcty(17,98,'武汉');
ctylst[97]=new prvcty(17,99,'孝感');
ctylst[98]=new prvcty(17,100,'黄石');
ctylst[99]=new prvcty(17,101,'咸宁');
ctylst[100]=new prvcty(17,102,'沙市');
ctylst[101]=new prvcty(17,103,'宜昌');
ctylst[102]=new prvcty(17,104,'襄樊');
prvarr[18]=new prv(18,'湖南');
ctylst[103]=new prvcty(18,105,'长沙');
ctylst[104]=new prvcty(18,106,'湘潭');
ctylst[105]=new prvcty(18,107,'株州');
ctylst[106]=new prvcty(18,108,'衡阳');
ctylst[107]=new prvcty(18,109,'郴州');
ctylst[108]=new prvcty(18,110,'常德');
prvarr[19]=new prv(19,'广东');
ctylst[109]=new prvcty(19,39,'深圳');
ctylst[110]=new prvcty(19,111,'广州');
ctylst[111]=new prvcty(19,112,'惠州');
ctylst[112]=new prvcty(19,113,'汕头');
ctylst[113]=new prvcty(19,114,'深圳');
ctylst[114]=new prvcty(19,115,'佛山');
ctylst[115]=new prvcty(19,116,'湛江');
ctylst[116]=new prvcty(19,117,'东莞');
ctylst[117]=new prvcty(19,118,'中山');
ctylst[118]=new prvcty(19,164,'珠海');
prvarr[20]=new prv(20,'广西');
ctylst[119]=new prvcty(20,119,'南宁');
ctylst[120]=new prvcty(20,120,'柳州');
ctylst[121]=new prvcty(20,121,'桂林');
ctylst[122]=new prvcty(20,122,'梧州');
prvarr[21]=new prv(21,'海南');
ctylst[123]=new prvcty(21,123,'海囗');
ctylst[124]=new prvcty(21,124,'三亚');
prvarr[22]=new prv(22,'四川');
ctylst[125]=new prvcty(22,125,'成都');
ctylst[126]=new prvcty(22,126,'广元');
ctylst[127]=new prvcty(22,127,'巴中');
ctylst[128]=new prvcty(22,128,'绵阳');
ctylst[129]=new prvcty(22,129,'德阳');
ctylst[130]=new prvcty(22,130,'达川');
ctylst[131]=new prvcty(22,131,'南充');
ctylst[132]=new prvcty(22,132,'遂宁');
ctylst[133]=new prvcty(22,133,'资阳');
ctylst[134]=new prvcty(22,134,'简阳');
ctylst[135]=new prvcty(22,135,'眉山');
ctylst[136]=new prvcty(22,136,'乐山');
ctylst[137]=new prvcty(22,137,'西昌');
ctylst[138]=new prvcty(22,138,'攀枝花');
ctylst[139]=new prvcty(22,139,'内江');
ctylst[140]=new prvcty(22,140,'泸州');
ctylst[141]=new prvcty(22,141,'宜宾');
ctylst[142]=new prvcty(22,142,'自贡');
ctylst[181]=new prvcty(22,181,'雅安');
prvarr[23]=new prv(23,'贵州');
ctylst[143]=new prvcty(23,143,'贵阳');
ctylst[144]=new prvcty(23,144,'遵义');
prvarr[24]=new prv(24,'云南');
ctylst[145]=new prvcty(24,145,'昆明');
ctylst[146]=new prvcty(24,146,'大理');
ctylst[147]=new prvcty(24,147,'个旧');
ctylst[148]=new prvcty(24,148,'曲靖');
ctylst[149]=new prvcty(24,149,'曲靖');
ctylst[150]=new prvcty(24,150,'玉溪');
ctylst[151]=new prvcty(24,151,'楚雄');
prvarr[25]=new prv(25,'青海');
ctylst[152]=new prvcty(25,152,'西宁');
ctylst[153]=new prvcty(25,153,'平安');
ctylst[154]=new prvcty(25,154,'同仁');
ctylst[155]=new prvcty(25,155,'共和');
prvarr[26]=new prv(26,'宁夏');
ctylst[156]=new prvcty(26,156,'银川');
prvarr[27]=new prv(27,'西藏');
ctylst[157]=new prvcty(27,157,'拉萨');
prvarr[28]=new prv(28,'陕西');
ctylst[158]=new prvcty(28,158,'西安');
ctylst[159]=new prvcty(28,159,'延安');
ctylst[160]=new prvcty(28,160,'商州');
ctylst[161]=new prvcty(28,161,'汉中');
ctylst[162]=new prvcty(28,162,'宝鸡');
ctylst[163]=new prvcty(28,163,'咸阳');
prvarr[29]=new prv(29,'新疆');
ctylst[164]=new prvcty(29,164,'乌鲁木齐');
ctylst[165]=new prvcty(29,165,'奎屯');
ctylst[166]=new prvcty(29,166,'石河子');
ctylst[167]=new prvcty(29,167,'吐鲁番');
ctylst[168]=new prvcty(29,168,'库尔勒');
ctylst[169]=new prvcty(29,169,'阿克苏');
ctylst[170]=new prvcty(29,170,'伊梨');
ctylst[171]=new prvcty(29,171,'克拉玛依');
ctylst[172]=new prvcty(29,172,'哈密');
prvarr[30]=new prv(30,'甘肃');
ctylst[173]=new prvcty(30,173,'兰州');
ctylst[174]=new prvcty(30,174,'定西');
ctylst[175]=new prvcty(30,175,'西峰');
ctylst[176]=new prvcty(30,176,'武威');
ctylst[177]=new prvcty(30,177,'张掖');
ctylst[178]=new prvcty(30,178,'酒泉');
ctylst[179]=new prvcty(30,179,'天水');
prvarr[31]=new prv(31,'重庆');
ctylst[180]=new prvcty(31,180,'重庆市');
ctycnt=181;
function prvcty(pid,cid,name)
{this.pid=pid;this.cid=cid;this.name=name;}
function prv(id,name)
{this.id=id;this.name=name;}

function ctychg(n,k)
{	
	lth=document.formlogin.city.length
	for (i=0;i<=lth;i++)
	{
		document.formlogin.city.remove(0);
	}
	
	for (j=1;j<=ctycnt;j++)
	{   

	a=n.substring(0,n.indexOf(","));
		if (ctylst[j].pid==a)
		{
			var oOption = document.createElement("OPTION");

			oOption.text=ctylst[j].name;
			oOption.value=ctylst[j].name;
			document.formlogin.city.add(oOption);
			if (ctylst[j].name==k)
			{
				oOption.selected=1;
				cityname = ctylst[j].name;
			}
			oOption.empty;
		}
	}
}

function check()
{
	if (document.formlogin.u_pass.value.length<4 || document.formlogin.u_pass.value.length > 16)
	{
		document.formlogin.u_pass.focus();
		window.alert("密码应为4-16位数字或字母!");
		return false;  
	}

	if (document.formlogin.u_pass.value!=document.formlogin.u_pass2.value)
	{
		document.formlogin.u_pass2.focus();
		window.alert("两次输入密码应该相同!");
		return false;  
	}
 if (document.formlogin.email.value == "" || document.formlogin.email.value.length < 1)            //判断信箱是否为空
    {
	    alert("请输入信箱!");
	    document.formlogin.email.select();
	    document.formlogin.email.focus();
	    return (false);
	}

	var checkOKeemail = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_@.";           //判断信箱中是否有非法字符
	var checkStreemail = document.formlogin.email.value;
	var allValideemail = true;
	for (i = 0;  i < checkStreemail.length;  i++)
	{
		ch = checkStreemail.charAt(i);
		for (j = 0;  j < checkOKeemail.length;  j++)
		if (ch == checkOKeemail.charAt(j))
			break;
		if (j == checkOKeemail.length)
		{
			allValideemail = false;
			break;
		}
	}

	if (document.formlogin.email.value.length < 6 || document.formlogin.email.value.length >60) //判断信箱长度是否合法
	{
		allValideemail = false;
	}

	if (!allValideemail)                                                   //判断信箱中是否有非法字符
	{
		alert("您输入的 \"电子邮件地址\" 无效,请注意Email地址的长度及是否输入了非法字符!");
		document.formlogin.email.select();
		document.formlogin.email.focus();
		return (false);
	}

	eemailvalue=document.formlogin.email.value;
    if(eemailvalue.length>0)
	{
        i=eemailvalue.indexOf("@");
        if(i==-1)
		{
			window.alert("对不起!您输入的电子邮件地址是错误的,连\"@\"都没有!");
			document.formlogin.email.select();
			document.formlogin.email.focus();
			return false
        }
        ii=eemailvalue.indexOf(".")
        if(ii==-1)
		{
			window.alert("对不起!您输入的电子邮件地址是错误的，连\".\"都没有!");
			document.formlogin.email.select();
			document.formlogin.email.focus();
			return false
        }
    }

  if (document.formlogin.email.value.indexOf('@') == -1 || document.formlogin.email.value.indexOf('@') == 0 || document.formlogin.email.value.indexOf('@') == document.formlogin.email.value.length-1)
  {
      alert("您的电子邮箱名字不对，@应放在正确的位置!");
	  document.formlogin.email.select();
      document.formlogin.email.focus();
      return (false);
  }
	if (document.formlogin.name.value=="")
	{
		document.formlogin.name.focus();
		window.alert("用户名不能空，并且最长20个字符!");
		return false;  
	}
	if (document.formlogin.sex.value==0)
	{
		document.formlogin.sex.focus();
		window.alert("请选择性别!");
		return false;  
	}
	if (document.formlogin.province.value=="")
	{
		document.formlogin.province.focus();
		window.alert("请选择所在省份!");
		return false;  
	}
	if (document.formlogin.city.value=="")
	{
		document.formlogin.city.focus();
		window.alert("请选择所在城市!");
		return false;  
	}
	if (document.formlogin.tel.value=="")
	{
		document.formlogin.tel.focus();
		window.alert("请填写联系电话!");
		return false;  
	}
	if (document.formlogin.address.value=="")
	{
		document.formlogin.address.focus();
		window.alert("请填写联系地址!");
		return false;  
	}
	if (document.formlogin.post.value.length<6 || isNaN(document.formlogin.post.value))
	{
		document.formlogin.post.focus();
		window.alert("请正确填写邮编!");
		return false;  
	}
}
</script>
      <table width="630" border="0">
        <tr> 
          <td height="18" class="p14"> 
            <table border=0 cellpadding=0 cellspacing=0 width="100%">
              <tbody> 
              <tr align="left"> 
                <th bgcolor=#ffffff colspan=4 height=22 valign=top><font color=#ffffcc 
                  face="Arial, Helvetica, sans-serif"><b><font class=p14 
                  color=#cc0000>您的详细信息：</font></b></font></th>
              </tr>
              <tr bgcolor=#cc0000> 
                <td colspan=4 height=2 valign=top></td>
              </tr>
              </tbody> 
            </table>
          </td>
        </tr>
        <tr align="center"> 
          <td height="18"> 
            <form name="formlogin" method="post" onSubmit="return(check());">
              <table width="96%" border="1" bordercolorlight="#d2d2d2" cellpadding="0" cellspacing="0" bordercolordark="#ffffff">
                <tr align="center"> 
                  <td> 
                    <table width="70%" border="0">
                      <tr> 
                        <td colspan="2">&nbsp; </td>
                      </tr>
                      <tr> 
                        <td align="right">会员用户名：</td>
                        <td> 
                          <?php echo $db->f('u_name') ?>
                        </td>
                      </tr>
                      <tr> 
                        <td align="right">新密码：</td>
                        <td> 
                          <input type="text" name="u_pass" class="think" maxlength="16" size="12" value="<?php echo $db->f('u_pass') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right">确认密码：</td>
                        <td> 
                          <input type="text" name="u_pass2" class="think" maxlength="16" size="12" value="<?php echo $db->f('u_pass') ?>">
                          <font color="#CC0000">*</font> </td>
                      </tr>
                      <tr> 
                        <td align="right">您的Email：</td>
                        <td> 
                          <input type="text" name="email" class="think" maxlength="60" size="30" value="<?php echo $db->f('email') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right">真实姓名：</td>
                        <td> 
                          <input type="text" name="name" class="think" maxlength="20" size="12" value="<?php echo $db->f('name') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td width="20%" align="right">性　别： </td>
                        <td width="80%"> 
                          <select name="sex">
                            <option value="0" selected>请选择</option>
                            <option value="1">男</option>
                            <option value="2">女</option>
                          </select>
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right">所在省份： </td>
                        <td> 
                          <select  name=province onChange="ctychg(document.formlogin.province.value)" class="think">
                            <script language=javascript>
   			  document.write ("<option");
			  document.write (">")
			  document.write ("请选择省份");
			  document.write ("</option>");
			for (i=1;i<=prvcnt;i++)
			{
			  document.write ("<option ");
			  if (prvarr[i].name=="<?php echo $db->f('province') ?>")
			    document.write ("selected ");
			  document.write ("value="+prvarr[i].id+","+prvarr[i].name);
			  document.write (">");
			  document.write (prvarr[i].name);
			  document.write ("</option>");
			}
			</script>
                          </select>
                          <font color="#CC0000"> *</font></td>
                      </tr>
                      <tr> 
                        <td align="right">所在城市： </td>
                        <td> 
                          <select id=city name=city  class="think">
                          </select>
                          <script language=JavaScript>
ctychg(document.formlogin.province.value,"<?php echo $db->f('city') ?>");
			
</script>
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right">联系电话： </td>
                        <td> 
                          <input type="text" name="tel" class="think" maxlength="40" size="20" value="<?php echo $db->f('tel') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right">联系地址： </td>
                        <td> 
                          <input type="text" name="address" class="think" maxlength="100" size="40" value="<?php echo $db->f('address') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right">邮 编： </td>
                        <td> 
                          <input type="text" name="post" class="think" maxlength="6" size="8" value="<?php echo $db->f('post') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right">证件类型：</td>
                        <td> 
                          <select name="paper_name" class="think">
                            <option value="0" selected>请选择</option>
                            <option value="1">身份证</option>
                            <option value="2">学生证</option>
                            <option value="3">军人证</option>
                          </select>
                          <font color="#CC0000"> 
                          <script language=JavaScript>
document.formlogin.paper_name.value=<?php echo intval($db->f('paper_name'));?>;
document.formlogin.sex.value=<?php echo intval($db->f('sex'));?>;
			
</script>
                          </font> </td>
                      </tr>
                      <tr> 
                        <td align="right">证件号码：</td>
                        <td> 
                          <input type="text" name="paper_num" class="think" maxlength="25" size="20" value="<?php echo $db->f('paper_num') ?>">
                        </td>
                      </tr>
                      <tr> 
                        <td width="22%" align="right">营业执照编号：</td>
                        <td width="78%"> 
                          <input type="text" name="zzbh" class="think" maxlength="100" value="<?php echo $db->f('zzbh') ?>">
                        </td>
                      </tr>
                      <tr> 
                        <td width="22%" align="right">开户行：</td>
                        <td width="78%"> 
                          <input type="text" name="khhh" class="think" maxlength="100" value="<?php echo $db->f('khhh') ?>">
                        </td>
                      </tr>
                      <tr> 
                        <td width="22%" align="right">开户账户：</td>
                        <td width="78%"> 
                          <input type="text" name="khzh" class="think" maxlength="100" value="<?php echo $db->f('khzh') ?>">
                        </td>
                      </tr>
                      <tr> 
                        <td width="20%" align="right">备 注：</td>
                        <td width="80%"> 
                          <textarea name="attrib" class="think" cols="40" rows="4"><?php echo $db->f('attrib') ?></textarea>
                        </td>
                      </tr>
                      <tr align="center"> 
                        <td colspan="2" height="44"> 
                          <input type="hidden" name="id" value="<?php echo $id ?>">
                          <input type="submit" name="submit" value=" 修 改 " class=stbtm2>
                          　　 
                          <input type="reset" name="Submit2" value=" 放 弃 " onClick="history.go(-1)" class=stbtm2>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </form>
          </td>
        </tr>
      </table>
      <?php 
} 
?>
    </td>
  </tr>
</table>
<br>
<?php include "conf/footer.php"; ?>
</body>
</html>
