<?php
require "conf/config.php";
include "admin_check.php";
?>
<html>
<head>
<title><?php echo $sitename ?> -- ��Ա����</title>
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
echo '���ڷ��ػ�Ա������ҳ<meta http-equiv="refresh" content="2;URL=admin_user.php"><br><br>';
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
prvarr[1]=new prv(1,'����');
ctylst[1]=new prvcty(1,1,'������');
ctylst[2]=new prvcty(1,3,'��ɽ');
ctylst[3]=new prvcty(1,4,'����');
ctylst[4]=new prvcty(1,5,'��˳');
ctylst[5]=new prvcty(1,18,'����');
ctylst[6]=new prvcty(1,19,'��Ϫ');
ctylst[7]=new prvcty(1,20,'����');
ctylst[8]=new prvcty(1,21,'����');
ctylst[9]=new prvcty(1,22,'Ӫ��');
ctylst[10]=new prvcty(1,23,'����');
ctylst[11]=new prvcty(1,24,'����');
ctylst[12]=new prvcty(1,25,'����');
ctylst[13]=new prvcty(1,26,'�߷���');
ctylst[14]=new prvcty(1,27,'����');
ctylst[15]=new prvcty(1,28,'����');
ctylst[16]=new prvcty(1,29,'�̽�');
ctylst[17]=new prvcty(1,30,'����');
prvarr[2]=new prv(2,'������');
ctylst[18]=new prvcty(2,38,'������');
ctylst[19]=new prvcty(2,40,'�������');
ctylst[20]=new prvcty(2,41,'ĵ����');
ctylst[21]=new prvcty(2,42,'��ľ˹');
ctylst[22]=new prvcty(2,43,'����');
ctylst[23]=new prvcty(2,170,'����');
prvarr[3]=new prv(3,'����');
ctylst[24]=new prvcty(3,31,'����');
ctylst[25]=new prvcty(3,32,'������');
ctylst[26]=new prvcty(3,33,'�Ӽ�');
ctylst[27]=new prvcty(3,34,'��ƽ');
ctylst[28]=new prvcty(3,35,'ͨ��');
ctylst[29]=new prvcty(3,36,'�׳�');
ctylst[30]=new prvcty(3,37,'��Դ');
prvarr[4]=new prv(4,'�ӱ�');
ctylst[31]=new prvcty(4,10,'ʯ��ׯ');
ctylst[32]=new prvcty(4,11,'��ɽ');
ctylst[33]=new prvcty(4,12,'�ػʵ�');
prvarr[5]=new prv(5,'����');
ctylst[34]=new prvcty(5,6,'������');
prvarr[6]=new prv(6,'�Ϻ�');
ctylst[35]=new prvcty(6,7,'�Ϻ���');
prvarr[7]=new prv(7,'���');
ctylst[36]=new prvcty(7,8,'�����');
prvarr[8]=new prv(8,'ɽ��');
ctylst[37]=new prvcty(8,13,'̫ԭ');
ctylst[38]=new prvcty(8,14,'��ͬ');
ctylst[39]=new prvcty(8,15,'����');
prvarr[9]=new prv(9,'���ɹ�');
ctylst[40]=new prvcty(9,16,'���ͺ���');
ctylst[41]=new prvcty(9,17,'���');
prvarr[10]=new prv(10,'����');
ctylst[42]=new prvcty(10,44,'�Ͼ�');
ctylst[43]=new prvcty(10,45,'��');
ctylst[44]=new prvcty(10,46,'����');
ctylst[45]=new prvcty(10,47,'��ͨ');
ctylst[46]=new prvcty(10,48,'����');
ctylst[47]=new prvcty(10,49,'����');
ctylst[48]=new prvcty(10,50,'����');
ctylst[49]=new prvcty(10,51,'�żҸ�');
prvarr[11]=new prv(11,'�㽭');
ctylst[50]=new prvcty(11,52,'����');
ctylst[51]=new prvcty(11,53,'����');
ctylst[52]=new prvcty(11,54,'����');
ctylst[53]=new prvcty(11,55,'����');
ctylst[54]=new prvcty(11,56,'�');
prvarr[12]=new prv(12,'����');
ctylst[55]=new prvcty(12,57,'�Ϸ�');
ctylst[56]=new prvcty(12,58,'����');
ctylst[57]=new prvcty(12,59,'����');
ctylst[58]=new prvcty(12,60,'��ɽ');
prvarr[13]=new prv(13,'����');
ctylst[59]=new prvcty(13,61,'����');
ctylst[60]=new prvcty(13,62,'����');
ctylst[61]=new prvcty(13,63,'����');
prvarr[14]=new prv(14,'����');
ctylst[62]=new prvcty(14,64,'�ϲ�');
ctylst[63]=new prvcty(14,65,'�Ž�');
ctylst[64]=new prvcty(14,66,'����');
ctylst[65]=new prvcty(14,67,'�ٴ�');
ctylst[66]=new prvcty(14,68,'�˴�');
ctylst[67]=new prvcty(14,69,'����');
ctylst[68]=new prvcty(14,70,'������');
ctylst[69]=new prvcty(14,71,'����ɽ');
prvarr[15]=new prv(15,'ɽ��');
ctylst[70]=new prvcty(15,72,'����');
ctylst[71]=new prvcty(15,73,'�ൺ');
ctylst[72]=new prvcty(15,74,'�Ͳ�');
ctylst[73]=new prvcty(15,75,'����');
ctylst[74]=new prvcty(15,76,'��̨');
ctylst[75]=new prvcty(15,77,'Ϋ��');
ctylst[76]=new prvcty(15,78,'����');
ctylst[77]=new prvcty(15,79,'̩��');
ctylst[78]=new prvcty(15,80,'����');
ctylst[79]=new prvcty(15,81,'�ٳ�');
ctylst[80]=new prvcty(15,82,'����');
ctylst[81]=new prvcty(15,83,'��ׯ');
ctylst[82]=new prvcty(15,84,'��ׯ');
prvarr[16]=new prv(16,'����');
ctylst[83]=new prvcty(16,85,'֣��');
ctylst[84]=new prvcty(16,86,'����');
ctylst[85]=new prvcty(16,87,'����');
ctylst[86]=new prvcty(16,88,'���');
ctylst[87]=new prvcty(16,89,'ƽ��ɽ');
ctylst[88]=new prvcty(16,90,'����');
ctylst[89]=new prvcty(16,91,'����');
ctylst[90]=new prvcty(16,92,'����');
ctylst[91]=new prvcty(16,93,'����');
ctylst[92]=new prvcty(16,94,'����');
ctylst[93]=new prvcty(16,95,'����');
ctylst[94]=new prvcty(16,96,'פ���');
ctylst[95]=new prvcty(16,97,'����Ͽ');
prvarr[17]=new prv(17,'����');
ctylst[96]=new prvcty(17,98,'�人');
ctylst[97]=new prvcty(17,99,'Т��');
ctylst[98]=new prvcty(17,100,'��ʯ');
ctylst[99]=new prvcty(17,101,'����');
ctylst[100]=new prvcty(17,102,'ɳ��');
ctylst[101]=new prvcty(17,103,'�˲�');
ctylst[102]=new prvcty(17,104,'�差');
prvarr[18]=new prv(18,'����');
ctylst[103]=new prvcty(18,105,'��ɳ');
ctylst[104]=new prvcty(18,106,'��̶');
ctylst[105]=new prvcty(18,107,'����');
ctylst[106]=new prvcty(18,108,'����');
ctylst[107]=new prvcty(18,109,'����');
ctylst[108]=new prvcty(18,110,'����');
prvarr[19]=new prv(19,'�㶫');
ctylst[109]=new prvcty(19,39,'����');
ctylst[110]=new prvcty(19,111,'����');
ctylst[111]=new prvcty(19,112,'����');
ctylst[112]=new prvcty(19,113,'��ͷ');
ctylst[113]=new prvcty(19,114,'����');
ctylst[114]=new prvcty(19,115,'��ɽ');
ctylst[115]=new prvcty(19,116,'տ��');
ctylst[116]=new prvcty(19,117,'��ݸ');
ctylst[117]=new prvcty(19,118,'��ɽ');
ctylst[118]=new prvcty(19,164,'�麣');
prvarr[20]=new prv(20,'����');
ctylst[119]=new prvcty(20,119,'����');
ctylst[120]=new prvcty(20,120,'����');
ctylst[121]=new prvcty(20,121,'����');
ctylst[122]=new prvcty(20,122,'����');
prvarr[21]=new prv(21,'����');
ctylst[123]=new prvcty(21,123,'����');
ctylst[124]=new prvcty(21,124,'����');
prvarr[22]=new prv(22,'�Ĵ�');
ctylst[125]=new prvcty(22,125,'�ɶ�');
ctylst[126]=new prvcty(22,126,'��Ԫ');
ctylst[127]=new prvcty(22,127,'����');
ctylst[128]=new prvcty(22,128,'����');
ctylst[129]=new prvcty(22,129,'����');
ctylst[130]=new prvcty(22,130,'�ﴨ');
ctylst[131]=new prvcty(22,131,'�ϳ�');
ctylst[132]=new prvcty(22,132,'����');
ctylst[133]=new prvcty(22,133,'����');
ctylst[134]=new prvcty(22,134,'����');
ctylst[135]=new prvcty(22,135,'üɽ');
ctylst[136]=new prvcty(22,136,'��ɽ');
ctylst[137]=new prvcty(22,137,'����');
ctylst[138]=new prvcty(22,138,'��֦��');
ctylst[139]=new prvcty(22,139,'�ڽ�');
ctylst[140]=new prvcty(22,140,'����');
ctylst[141]=new prvcty(22,141,'�˱�');
ctylst[142]=new prvcty(22,142,'�Թ�');
ctylst[181]=new prvcty(22,181,'�Ű�');
prvarr[23]=new prv(23,'����');
ctylst[143]=new prvcty(23,143,'����');
ctylst[144]=new prvcty(23,144,'����');
prvarr[24]=new prv(24,'����');
ctylst[145]=new prvcty(24,145,'����');
ctylst[146]=new prvcty(24,146,'����');
ctylst[147]=new prvcty(24,147,'����');
ctylst[148]=new prvcty(24,148,'����');
ctylst[149]=new prvcty(24,149,'����');
ctylst[150]=new prvcty(24,150,'��Ϫ');
ctylst[151]=new prvcty(24,151,'����');
prvarr[25]=new prv(25,'�ຣ');
ctylst[152]=new prvcty(25,152,'����');
ctylst[153]=new prvcty(25,153,'ƽ��');
ctylst[154]=new prvcty(25,154,'ͬ��');
ctylst[155]=new prvcty(25,155,'����');
prvarr[26]=new prv(26,'����');
ctylst[156]=new prvcty(26,156,'����');
prvarr[27]=new prv(27,'����');
ctylst[157]=new prvcty(27,157,'����');
prvarr[28]=new prv(28,'����');
ctylst[158]=new prvcty(28,158,'����');
ctylst[159]=new prvcty(28,159,'�Ӱ�');
ctylst[160]=new prvcty(28,160,'����');
ctylst[161]=new prvcty(28,161,'����');
ctylst[162]=new prvcty(28,162,'����');
ctylst[163]=new prvcty(28,163,'����');
prvarr[29]=new prv(29,'�½�');
ctylst[164]=new prvcty(29,164,'��³ľ��');
ctylst[165]=new prvcty(29,165,'����');
ctylst[166]=new prvcty(29,166,'ʯ����');
ctylst[167]=new prvcty(29,167,'��³��');
ctylst[168]=new prvcty(29,168,'�����');
ctylst[169]=new prvcty(29,169,'������');
ctylst[170]=new prvcty(29,170,'����');
ctylst[171]=new prvcty(29,171,'��������');
ctylst[172]=new prvcty(29,172,'����');
prvarr[30]=new prv(30,'����');
ctylst[173]=new prvcty(30,173,'����');
ctylst[174]=new prvcty(30,174,'����');
ctylst[175]=new prvcty(30,175,'����');
ctylst[176]=new prvcty(30,176,'����');
ctylst[177]=new prvcty(30,177,'��Ҵ');
ctylst[178]=new prvcty(30,178,'��Ȫ');
ctylst[179]=new prvcty(30,179,'��ˮ');
prvarr[31]=new prv(31,'����');
ctylst[180]=new prvcty(31,180,'������');
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
		window.alert("����ӦΪ4-16λ���ֻ���ĸ!");
		return false;  
	}

	if (document.formlogin.u_pass.value!=document.formlogin.u_pass2.value)
	{
		document.formlogin.u_pass2.focus();
		window.alert("������������Ӧ����ͬ!");
		return false;  
	}
 if (document.formlogin.email.value == "" || document.formlogin.email.value.length < 1)            //�ж������Ƿ�Ϊ��
    {
	    alert("����������!");
	    document.formlogin.email.select();
	    document.formlogin.email.focus();
	    return (false);
	}

	var checkOKeemail = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_@.";           //�ж��������Ƿ��зǷ��ַ�
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

	if (document.formlogin.email.value.length < 6 || document.formlogin.email.value.length >60) //�ж����䳤���Ƿ�Ϸ�
	{
		allValideemail = false;
	}

	if (!allValideemail)                                                   //�ж��������Ƿ��зǷ��ַ�
	{
		alert("������� \"�����ʼ���ַ\" ��Ч,��ע��Email��ַ�ĳ��ȼ��Ƿ������˷Ƿ��ַ�!");
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
			window.alert("�Բ���!������ĵ����ʼ���ַ�Ǵ����,��\"@\"��û��!");
			document.formlogin.email.select();
			document.formlogin.email.focus();
			return false
        }
        ii=eemailvalue.indexOf(".")
        if(ii==-1)
		{
			window.alert("�Բ���!������ĵ����ʼ���ַ�Ǵ���ģ���\".\"��û��!");
			document.formlogin.email.select();
			document.formlogin.email.focus();
			return false
        }
    }

  if (document.formlogin.email.value.indexOf('@') == -1 || document.formlogin.email.value.indexOf('@') == 0 || document.formlogin.email.value.indexOf('@') == document.formlogin.email.value.length-1)
  {
      alert("���ĵ����������ֲ��ԣ�@Ӧ������ȷ��λ��!");
	  document.formlogin.email.select();
      document.formlogin.email.focus();
      return (false);
  }
	if (document.formlogin.name.value=="")
	{
		document.formlogin.name.focus();
		window.alert("�û������ܿգ������20���ַ�!");
		return false;  
	}
	if (document.formlogin.sex.value==0)
	{
		document.formlogin.sex.focus();
		window.alert("��ѡ���Ա�!");
		return false;  
	}
	if (document.formlogin.province.value=="")
	{
		document.formlogin.province.focus();
		window.alert("��ѡ������ʡ��!");
		return false;  
	}
	if (document.formlogin.city.value=="")
	{
		document.formlogin.city.focus();
		window.alert("��ѡ�����ڳ���!");
		return false;  
	}
	if (document.formlogin.tel.value=="")
	{
		document.formlogin.tel.focus();
		window.alert("����д��ϵ�绰!");
		return false;  
	}
	if (document.formlogin.address.value=="")
	{
		document.formlogin.address.focus();
		window.alert("����д��ϵ��ַ!");
		return false;  
	}
	if (document.formlogin.post.value.length<6 || isNaN(document.formlogin.post.value))
	{
		document.formlogin.post.focus();
		window.alert("����ȷ��д�ʱ�!");
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
                  color=#cc0000>������ϸ��Ϣ��</font></b></font></th>
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
                        <td align="right">��Ա�û�����</td>
                        <td> 
                          <?php echo $db->f('u_name') ?>
                        </td>
                      </tr>
                      <tr> 
                        <td align="right">�����룺</td>
                        <td> 
                          <input type="text" name="u_pass" class="think" maxlength="16" size="12" value="<?php echo $db->f('u_pass') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right">ȷ�����룺</td>
                        <td> 
                          <input type="text" name="u_pass2" class="think" maxlength="16" size="12" value="<?php echo $db->f('u_pass') ?>">
                          <font color="#CC0000">*</font> </td>
                      </tr>
                      <tr> 
                        <td align="right">����Email��</td>
                        <td> 
                          <input type="text" name="email" class="think" maxlength="60" size="30" value="<?php echo $db->f('email') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right">��ʵ������</td>
                        <td> 
                          <input type="text" name="name" class="think" maxlength="20" size="12" value="<?php echo $db->f('name') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td width="20%" align="right">�ԡ��� </td>
                        <td width="80%"> 
                          <select name="sex">
                            <option value="0" selected>��ѡ��</option>
                            <option value="1">��</option>
                            <option value="2">Ů</option>
                          </select>
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right">����ʡ�ݣ� </td>
                        <td> 
                          <select  name=province onChange="ctychg(document.formlogin.province.value)" class="think">
                            <script language=javascript>
   			  document.write ("<option");
			  document.write (">")
			  document.write ("��ѡ��ʡ��");
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
                        <td align="right">���ڳ��У� </td>
                        <td> 
                          <select id=city name=city  class="think">
                          </select>
                          <script language=JavaScript>
ctychg(document.formlogin.province.value,"<?php echo $db->f('city') ?>");
			
</script>
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right">��ϵ�绰�� </td>
                        <td> 
                          <input type="text" name="tel" class="think" maxlength="40" size="20" value="<?php echo $db->f('tel') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right">��ϵ��ַ�� </td>
                        <td> 
                          <input type="text" name="address" class="think" maxlength="100" size="40" value="<?php echo $db->f('address') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right">�� �ࣺ </td>
                        <td> 
                          <input type="text" name="post" class="think" maxlength="6" size="8" value="<?php echo $db->f('post') ?>">
                          <font color="#CC0000">*</font></td>
                      </tr>
                      <tr> 
                        <td align="right">֤�����ͣ�</td>
                        <td> 
                          <select name="paper_name" class="think">
                            <option value="0" selected>��ѡ��</option>
                            <option value="1">���֤</option>
                            <option value="2">ѧ��֤</option>
                            <option value="3">����֤</option>
                          </select>
                          <font color="#CC0000"> 
                          <script language=JavaScript>
document.formlogin.paper_name.value=<?php echo intval($db->f('paper_name'));?>;
document.formlogin.sex.value=<?php echo intval($db->f('sex'));?>;
			
</script>
                          </font> </td>
                      </tr>
                      <tr> 
                        <td align="right">֤�����룺</td>
                        <td> 
                          <input type="text" name="paper_num" class="think" maxlength="25" size="20" value="<?php echo $db->f('paper_num') ?>">
                        </td>
                      </tr>
                      <tr> 
                        <td width="22%" align="right">Ӫҵִ�ձ�ţ�</td>
                        <td width="78%"> 
                          <input type="text" name="zzbh" class="think" maxlength="100" value="<?php echo $db->f('zzbh') ?>">
                        </td>
                      </tr>
                      <tr> 
                        <td width="22%" align="right">�����У�</td>
                        <td width="78%"> 
                          <input type="text" name="khhh" class="think" maxlength="100" value="<?php echo $db->f('khhh') ?>">
                        </td>
                      </tr>
                      <tr> 
                        <td width="22%" align="right">�����˻���</td>
                        <td width="78%"> 
                          <input type="text" name="khzh" class="think" maxlength="100" value="<?php echo $db->f('khzh') ?>">
                        </td>
                      </tr>
                      <tr> 
                        <td width="20%" align="right">�� ע��</td>
                        <td width="80%"> 
                          <textarea name="attrib" class="think" cols="40" rows="4"><?php echo $db->f('attrib') ?></textarea>
                        </td>
                      </tr>
                      <tr align="center"> 
                        <td colspan="2" height="44"> 
                          <input type="hidden" name="id" value="<?php echo $id ?>">
                          <input type="submit" name="submit" value=" �� �� " class=stbtm2>
                          ���� 
                          <input type="reset" name="Submit2" value=" �� �� " onClick="history.go(-1)" class=stbtm2>
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
