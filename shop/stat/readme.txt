2002-10-15

���İ�򵥰�װ˵����
-------------------
- ��ϸ���ú� include/config.inc.php �ļ�, ֻ���޸����±������ļ��ж�������ע�ͣ���
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

- �ϴ������ļ�����������һ��Ŀ¼. �����ļ�Ŀ¼�ṹ.

- ��Ŀ¼ include/caches ������Ϊ 0777��һ��FTP������CuteFTP��֧��CHMOD���

- ������״ΰ�װ, ��ִ��include\caches\stat.sql�������ݱ�. �Ƽ�ʹ�� phpMyAdmin ���������ݱ�.

- ��������JavaScript����ͳ�ƣ������phpҳ��ҳ���У�
  ͳ��ͼ����ʾ���Ŀǰ����4��(Ĭ��Ϊ��ʾСͼ��, http://www.mydomain.com/Ϊ������վ��ַ):

1.����ʾ����
  <script language="JavaScript" src="http://www.mydomain.com/stat/include/countjs.php?style=1"></script>

2.��ʾ�����ı�
  <script language="JavaScript" src="http://www.qwhy.com/stat/include/countjs.php?style=2"></script>

3.��ʾСͼ��
  <script language="JavaScript" src="http://www.mydomain.com/stat/include/countjs.php?style=3"></script>

4.��ʾ��ͼ��
  <script language="JavaScript" src="http://www.mydomain.com/stat/include/countjs.php?style=4"></script>

- ���� index.php �鿴ͳ�ƽ��

- Ҳ��������Ҫͳ�Ƶ�ҳ����� include/new-visitor.inc.php
  �� include($lvc_include_dir.'new-visitor.inc.php');

- ���κ�������Ե� ������ - http://www.8421.org ��̳����. 

/* ------------------------------------------------------------*/
/* ������ - ��Դ���������㹲��
/* ------------------------------------------------------------*/
