<?php
if ($action=="") require "conf/config.php";
include "admin_check.php";
?>
<html>
<head>
<title><?php echo $sitename ?> -- ϵͳ����</title>
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
        ϵͳ����</p>
<?php
if ($action=="system_setup")
{
  $str="<?php
//db_set_start //���ݿ�����
\$dbservername = \"$dbservername\";
\$dbname = \"$dbname\";
\$dbusername = \"$dbusername\";
\$dbuserpass = \"$dbuserpass\";
//db_set_end

  //���ݿ�ǰ׺ $prefix�����ݿ��и���ı�����һ�㲻��Ҫ�޸ģ���ʱ�õ� 9 ����
\$prefix = \"$prefix\";
\$news_t = \$prefix.\"news\";//�������ݱ�
\$class_t = \$prefix.\"class\";//��Ʒ����
\$goods_t = \$prefix.\"goods\";//��Ʒ��Ϣ��
\$shopping_t = \$prefix.\"shopping\";//������Ʒ��
\$requests_t = \$prefix.\"requests\";//������
\$user_t = \$prefix.\"user\";//�û���Ϣ��
\$ad_t = \$prefix.\"ad\";//����
\$vote_t = \$prefix.\"vote\";//�����
\$link_t = \$prefix.\"link\";//�������ӱ�

//�û�ע��
\$user_reg_flag = $user_reg_flag;

//base_set_start //��������
\$sitename = \"$sitename\";   //��վ����
\$siteurl = \"$siteurl\";   //��վ��ַ 
\$sitecopyright = \"$sitecopyright\";          //��վ��Ȩ��
//base_set_end

//admin_set_start //��վ����Ա����
\$ad_name = \"$ad_name\";   //��վ����Ա�û���
\$ad_pass = \"$ad_pass\";   //��վ����Ա����
\$siteemail = \"$siteemail\";   //��վ����Ա������
//admin_set_end

//�򿪻��߹ر��̵� 
\$siteclose_flag = $siteclose_flag;
\$sitereason = \"$sitereason\";

//��ʾ��ʽ
\$num_to_show = $num_to_show;   //ÿҳ��Ʒ��ʾ����
\$num_to_show_news = $num_to_show_news;   //ÿҳ������ʾ����

//��������
\$init_num = $init_num;   //�����ĳ�ʼ���
\$rebate = $rebate;   //���Ŷ����ܶ��1000Ԫ���ۿ�, ��С����ʾ��0.1��10%)
\$jiti_num = $jiti_num;   //������������ͬһ����Ʒ��������������������ʱ������$jiti_rebate��ֵ���д���
\$jiti_rebate = $jiti_rebate;   //������������ͬһ����Ʒ���������۸��Ż�20%(0.2��20%)
\$send_money = $send_money;   //ÿ�Ŷ��������ͷѣ���ԪΪԪ��
\$dingdang_days = $dingdang_days;   //ÿ�Ŷ�������Ч�����������ָ���������ڣ��û�δ�����������Ч����ҳ��
\$del_delay = $del_delay; //�û��������������ڴ��趨��ʱ���ڣ��ٴε�¼�������ɾ���˶��� ��λ���� �磺1800�뼴30����

//��վ��ϵ��ʽ�������ж�����ÿո�ֿ�
\$siteadd = \"$siteadd\";
\$sitetel = \"$sitetel\";
\$siteemail = \"$siteemail\";

//��������
\$user_price = $user_price ; //��Ʒ�Ļ�Ա�ۣ��Ƿ�Ϊ��¼��Ա���ܿ���1--�û������¼���ܿ���Ա��  0--�����˶����Կ���Ա��
\$init_action = \"$init_action\";//��Ա��action�ֶεĳ�ʼֵ,y ��ʾע�ἴ��ʹ�ã�n ��ʾע������ɹ���Ա�������ʹ��
\$guestbook  =  $guestbook ;  //�Ƿ�ʹ�����Ա����� 1--ʹ�� 0--��ʹ��
\$bbs_name   = \"$bbs_name\" ; //��̳����
\$bbs_url    = \"$bbs_url\" ; //��̳��ַ�������ʹ�ô˹��ܣ���ֵΪ��
\$stat       = $stat ; //�Ƿ����վ��������ͳ��
\$stat_type  = $stat_type ;   //ͳ��ͼ����ʾ���Ŀǰ����4�� 1.����ʾ����  2.��ʾ�����ı�  3.��ʾСͼ��  4.��ʾ��ͼ��

\$date_tmp = date(\"Y-m-d H:i:s\"); //���ڸ�ʽ���벻Ҫ�޸ģ�������ݿ���ֶ��������
?>";

  $fp=@fopen("conf/options.php","w");
  $flag=@fwrite($fp,$str);
  @fclose($fp);

  if ($flag)
   echo "ϵͳ�������óɹ���";
  else
	echo "ϵͳ��������ʧ�ܣ���ǰ�Ĳ����Ѿ�ֹͣ��<BR><BR>�����ֶ��޸�conf/options.php�ļ�������Ϊ777����ʹ�ô˹��ܡ�";
 echo "<BR>";
}
else
{
?>     
<form name="form1" method="post" action="">
        <table width="600" border="0" cellpadding="4" cellspacing="0" class="shadow">
          <tr> 
            <td width="50%"><a href="#system_db">[���ݿ�����]</a></td>
            <td width="50%"><a href="#reg_set">[�û�ע��]</a></td>
          </tr>
          <tr> 
            <td width="50%"><a href="#system_set">[��������]</a></td>
            <td width="50%"><a href="#close_set">[�򿪻��߹ر��̵�]</a></td>
          </tr>
          <tr> 
            <td width="50%"><a href="#display_set">[��ʾ��ʽ]</a></td>
            <td width="50%"><a href="#dingdang_set">[��������]</a></td>
          </tr>
          <tr> 
            <td width="50%"><a href="#web_set">[�̵�����]</a></td>
            <td width="50%"><a href="#other_set">[��������]</a></td>
          </tr>
        </table>
        <table width="600" border="0" cellpadding="1" cellspacing="0" class="tblborder">
          <tr> 
            <td> 
              <table width="600" border="0" cellpadding="4" cellspacing="0">
                <tr> 
                  <td colspan="2" class="tblhead"><a name="system_db"></a>���ݿ�����</td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">MySql���ݿ��ַ<br>
                    MySql���ݿ��ַ�������ݿ�ķ���������IP��ַ.</td>
                  <td width="49%">
                    <input type="text" name="dbservername" value="<?php echo $dbservername ?>">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">MySql���ݿ��ʺ�<br>
                    MySql���ݿ��ʺţ����ǵ�¼���������˺�.<br>
                  </td>
                  <td width="49%">
                    <input type="text" name="dbusername" value="<?php echo $dbusername ?>">
                  </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">MySql���ݿ�����<br>
                    MySql���ݿ����룬���ǵ�¼������������.<br>
                  </td>
                  <td width="49%">
                    <input type="text" name="dbuserpass" value="<?php echo $dbuserpass ?>">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">Ҫʹ�õ����ݿ�<br>
                    Ҫʹ�õ����ݿ⣬����ʹ�õ����ݿ�����.<br>
                  </td>
                  <td width="49%"> 
                    <input type="text" name="dbname" value="<?php echo $dbname ?>">
                  </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">���ݿ��ǰ׺<br>
                    ���ݿ��ǰ׺���Ա����������ݿ�����������ݿ��Ѿ��������벻Ҫ�޸�.<br>
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
            <td colspan="2" class="tblhead"><a name="reg_set"></a>�û�ע��</td>
          </tr>
          <tr class="firstalt"> 
            <td width="50%">�������û�ע�᣺</td>
            <td width="50%">
              <input type="radio" name="user_reg_flag" value="1" <?php if ($user_reg_flag==1) echo "checked"; ?>>
              yes �� 
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
                  <td colspan="2" class="tblhead"><a name="system_set"></a>��������</td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">�̵�����<br>
                    �̵����ƣ��⽫������ҳ��Ĵ��ڱ���.</td>
                  <td width="49%"> 
                    <input type="text" value="<?php echo $sitename ?>" name="sitename">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">�̵�URL<br>
                    �̵��URL(��Ҫ�� &quot;/&quot; ��β).<br>
                  </td>
                  <td width="49%">
                    <input type="text" value="<?php echo $siteurl ?>" name="siteurl">
                  </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">��Ȩ��Ϣ<br>
                    ����ÿҳҳ�ŵİ�Ȩ��Ϣ.<br>
                  </td>
                  <td width="49%">
                    <input type="text" value="<?php echo $sitecopyright ?>" name="sitecopyright">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">����ԱEmail��ַ<br>
                    ����Ա��Email��ַ.<br>
                  </td>
                  <td width="49%">
                    <input type="text" value="<?php echo $siteemail ?>" name="siteemail">
                  </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">����Ա�û���<br>
                    ����Ա�û���������Ա��¼������û���.<br>
                  </td>
                  <td width="49%">
                    <input type="text" value="<?php echo $ad_name ?>" name="ad_name">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">����Ա����<br>
                    ����Ա���룬����Ա��¼���������.<br>
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
                  <td colspan="2" class="tblhead"><a name="close_set"></a>�򿪻��߹ر��̵�</td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">�ر��̵�<br>
                    �е�ʱ������Ҫ�ر��̵�,�������ά����������,��ʱ���������̵���û���õ�һ���̵���ʱ�رյ���Ϣ,������Ա�Կɹ����̵�.</td>
                  <td width="49%"> 
                    <input type="radio" name="web_close_flag" value="1" <?php if ($siteclose_flag==1) echo "checked"; ?>>
                    yes ��
<input type="radio" name="web_close_flag" value="0" <?php if ($siteclose_flag==0) echo "checked"; ?>>
                    no </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">�̵�ر�ԭ��<br>
                    ���̵�ر�ʱ������������Ϣ. 
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
                  <td colspan="2" class="tblhead"><a name="display_set"></a>��ʾ��ʽ</td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">��Ʒ��ʾ������</td>
                  <td> 
                    <input type="text" value="<?php echo $num_to_show ?>" name="num_to_show">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">����������ʾ������</td>
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
                  <td colspan="2" class="tblhead"><a name="dingdang_set"></a>��������</td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">�����ĳ�ʼ���<br>
                    �����ĳ�ʼ��ţ��Ժ��������Ķ����������������ʼ���.</td>
                  <td width="50%"> 
                    <input type="text" value="<?php echo $init_num ?>" name="init_num">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">�����ۿ�<br>
                    �����ۿۣ����Ŷ����ܶ��1000Ԫ���ۿ�, ��С����ʾ��0.1��10%).</td>
                  <td width="50%">
                    <input type="text" value="<?php echo $rebate ?>" name="rebate">
                  </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">�Żݵ�����<br>
                    �Żݵ�������������������ͬһ����Ʒ��������������������ʱ�����������&quot;�Żݱ���&quot;���д���.</td>
                  <td width="50%">
                    <input type="text" value="<?php echo $jiti_num ?>" name="jiti_num">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">�Żݱ���<br>
                    �Żݱ�����������������ͬһ����Ʒ���������۸��Ż�20%(0.2��20%).</td>
                  <td width="50%">
                    <input type="text" value="<?php echo $jiti_rebate ?>" name="jiti_rebate">
                    �� </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">�������ͷ�<br>
                    �������ͷѣ�ÿ�Ŷ��������ͷѣ���ԪΪԪ.</td>
                  <td width="50%">
                    <input type="text" value="<?php echo $send_money ?>" name="send_money">
                    Ԫ </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">��������Ч����<br>
                    ��������Ч������ÿ�Ŷ�������Ч�����������ָ���������ڣ��û�δ�����������Ч����ҳ��.</td>
                  <td width="50%">
                    <input type="text" value="<?php echo $dingdang_days ?>" name="dingdang_days">
                    �� </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">������Чɾ��ʱ��<br>
                    ������Чɾ��ʱ�䣬�û��������������ڴ��趨��ʱ���ڣ��ٴε�¼�������ɾ���˶��� ��λ���� �磺1800�뼴30����.</td>
                  <td width="50%">
                    <input type="text" value="<?php echo $del_delay ?>" name="del_delay">
                    �� </td>
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
                  <td colspan="2" class="tblhead"><a name="web_set"></a>�̵�����</td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">��վ��ϵ��ʽ<br>
                    ��ַ���⽫��ʾ��ÿ��ҳ��ĵײ�.</td>
                  <td width="50%"> 
                    <input type="text" value="<?php echo $siteadd ?>" name="web_add">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">�绰�������ж�����ÿո�ֿ����⽫��ʾ��ÿ��ҳ��ĵײ�.</td>
                  <td width="50%">
                    <input type="text" value="<?php echo $sitetel ?>" name="web_tel">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">��ϵ���䣬�⽫��ʾ��ÿ��ҳ��ĵײ�.</td>
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
                  <td colspan="2" class="tblhead"><a name="other_set"></a>��������</td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">��Ʒ�Ļ�Ա��<br>
                    ��Ʒ�Ļ�Ա�ۣ��Ƿ�ֻ�л�Ա���ܲ鿴��Ʒ�Ļ�Ա��.</td>
                  <td width="50%"> 
                    <input type="radio" name="user_price" value="1" <?php if ($user_price==1) echo "checked"; ?>>
                    yes �� 
                    <input type="radio" name="user_price" value="0" <?php if ($user_price==0) echo "checked"; ?>>
                    no </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">��Ա�˺ŵĳ�ʼֵ<br>
                    ��Ա�˺ŵĳ�ʼֵ����Աע����Ƿ�Ϳ���ʹ���Լ����˺�.</td>
                  <td width="50%"> 
                    <input type="radio" name="init_action" value="y" <?php if ($init_action=="y") echo "checked"; ?>>
                    yes �� 
                    <input type="radio" name="init_action" value="n" <?php if ($init_action=="n") echo "checked"; ?>>
                    no </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">���Թ���<br>
                    ���Թ��ܣ��Ƿ�ʹ����վ�����Թ���.</td>
                  <td> 
                    <input type="radio" name="guestbook" value="1" <?php if ($guestbook==1) echo "checked"; ?>>
                    yes �� 
                    <input type="radio" name="guestbook" value="0" <?php if ($guestbook==0) echo "checked"; ?>>
                    no </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">��̳����<br>
                    ��̳���ƣ�������̳����̳����.</td>
                  <td width="50%"> 
                    <input type="text" value="<?php echo $bbs_name ?>" name="bbs_name">
                  </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">��̳��ַ<br>
                    ��̳��ַ��Ϊ������ʾ�����ӵ�ַ.</td>
                  <td width="50%"> 
                    <input type="text" value="<?php echo $bbs_url ?>" name="bbs_url">
                  </td>
                </tr>
                <tr class="secondalt"> 
                  <td width="50%">����ͳ��<br>
                    ����ͳ�ƣ��Ƿ����վ��������ͳ�ƣ�ͳ����������ݿ��������޸�stat\include\config.inc.php�ļ������ݿ�ṹ�ļ�stat\include\caches\stat.sql.</td>
                  <td width="50%"> 
                    <input type="radio" name="stat" value="1" <?php if ($stat==1) echo "checked"; ?>>
                    yes �� 
                    <input type="radio" name="stat" value="0" <?php if ($stat==0) echo "checked"; ?>>
                    no </td>
                </tr>
                <tr class="firstalt"> 
                  <td width="50%">ͳ��ͼ��<br>
                    ͳ��ͼ�꣬��ʾ���Ŀǰ����4�֣��⽫��ÿ��ҳ��ĵײ���ʾ.</td>
                  <td> 
                    <input type="radio" name="stat_type" value="1" <?php if ($stat_type==1) echo "checked"; ?>>
                    1.����ʾ����<br>
                    <input type="radio" name="stat_type" value="2" <?php if ($stat_type==2) echo "checked"; ?>>
                    2.��ʾ�����ı�<br>
                    <input type="radio" name="stat_type" value="3" <?php if ($stat_type==3) echo "checked"; ?>>
                    3.��ʾСͼ��<br>
                    <input type="radio" name="stat_type" value="4" <?php if ($stat_type==4) echo "checked"; ?>>
                    4.��ʾ��ͼ�� </td>
                </tr>
                <tr class="tblhead" align="center"> 
                  <td colspan="2" height="40"> 
                    <input type="hidden" name="action" value="system_setup">
                    <input type="submit" name="Submit" value="�������" class="stbtm2">
                    ���� 
                    <input type="reset" name="Submit2" value="��������" class="stbtm2">
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
