<html>
<head>
<title>�༭ϵͳ</title>
<link rel="STYLESHEET" type="text/css" href="edit.css">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
</head>
<body bgcolor="menu" onload="InitDocument();" STYLE="margin:0pt;padding:0pt;">
<div class="yToolbar" ID="ExtToolbar">
<div class="TBHandle"></div>
<div class="Btn" TITLE="ɾ��" LANGUAGE="javascript" onclick="format1('delete');">
<img class="Ico" src="image/delete.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="Btn" TITLE="����" LANGUAGE="javascript" onclick="format1('cut');">
<img class="Ico" src="image/cut.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="Btn" TITLE="����" LANGUAGE="javascript" onclick="format1('copy');">
<img class="Ico" src="image/copy.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="Btn" TITLE="ճ��" LANGUAGE="javascript" onclick="format1('paste');">
<img class="Ico" src="image/paste.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="Btn" TITLE="��word��ճ��" LANGUAGE="javascript" onclick="PasteWord();"> 
<img class="Ico" src="image/wordpaste.gif" WIDTH="18" HEIGHT="18">
</div>
<div class="Btn" TITLE="����" LANGUAGE="javascript" onclick="format1('undo');">
<img class="Ico" src="image/undo.gif" WIDTH="17" HEIGHT="16">
</div>
<div class="Btn" TITLE="�ָ�" LANGUAGE="javascript" onclick="format1('redo');">
<img class="Ico" src="image/redo.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="TBSep"></div>
<div class="Btn" TITLE="������" LANGUAGE="javascript" onclick="fortable()">
<img class="Ico" src="image/table.gif" WIDTH="18" HEIGHT="18">
</div>
<div class="Btn" TITLE="���볬������" LANGUAGE="javascript" onclick="UserDialog('CreateLink')">
<img class="Ico" src="image/wlink.gif" WIDTH="22" HEIGHT="22">
</div>
<div class="Btn" TITLE="�ϴ�ͼƬ" LANGUAGE="javascript" onclick="window.open('img_upload.php','img_upload','width=481 height=190');">
<img class="Ico" src="image/img.gif" WIDTH="22" HEIGHT="22">
</div>
<div class="Btn" TITLE="����ˮƽ��" LANGUAGE="javascript" onclick="format('InsertHorizontalRule')">
<img class="Ico" src="image/hr.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="TBSep"></div>
<select language="javascript" class="TBGen" id="FontName" title="������" onchange="format('fontname',this[this.selectedIndex].value);">
<option class="heading" selected>����<option value="����">����<option value="����">����<option value="����_GB2312">����<option value="����_GB2312">����<option value="����">����<option value="��Բ">��Բ<option value="������">������<option value="ϸ����">ϸ����<option value="Arial">Arial<option value="Arial Black">Arial Black<option value="Arial Narrow">Arial Narrow<option value="Bradley Hand	ITC">Bradley
Hand ITC<option value="Brush Script	MT">Brush Script MT<option value="Century Gothic">Century Gothic<option value="Comic Sans MS">Comic Sans
MS<option value="Courier">Courier<option value="Courier New">Courier New<option value="MS Sans Serif">MS Sans Serif<option value="Script">Script<option value="System">System<option value="Times New Roman">Times New Roman<option value="Viner Hand ITC">Viner Hand ITC<option value="Verdana">Verdana<option value="Wide	Latin">Wide Latin<option value="Wingdings">Wingdings</option></select> <div class="TBSep"></div>
<div class="TBGen" id="EditMode" title="ʹ�� HTML"><input onclick="setMode(this.checked);" type="checkbox">ʹ�� HTML �﷨��д </div>
<div  TITLE="��ӭʹ���������ϵͳ" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font color=red size=2px>
</font>
</div>
</div>
<div class="yToolbar">
<div class="TBHandle"></div>
<select ID="formatSelect" class="TBGen" title="�����ʽ" onchange="doSelectClick('FormatBlock',this)" style="font: icon; width: 80px;">
<option>�����ʽ</option>
<option VALUE="&lt;P&gt;">��ͨ
<option VALUE="&lt;PRE&gt;">�ѱ��Ÿ�ʽ
<option VALUE="&lt;H1&gt;">����һ
<option VALUE="&lt;H2&gt;">�����
<option VALUE="&lt;H3&gt;">������
<option VALUE="&lt;H4&gt;">������
<option VALUE="&lt;H5&gt;">������
<option VALUE="&lt;H6&gt;">������
<option VALUE="&lt;H7&gt;">������
</select>
<select id="specialtype" class="TBGen" onchange="doSelectClick('FormatBlock',this)" style="font: icon; width: 100px;">
<option>���������ʽ</option>
<option VALUE="SUP">�ϱ�
<option VALUE="SUB">�±�
<option VALUE="DEL">ɾ����
<option VALUE="BLINK">��˸
<option VALUE="BIG">��������
<option VALUE="SMALL">��С����
</select>
<select language="javascript" class="TBGen" id="FontSize" title="�ֺŴ�С" onchange="format('fontsize',this[this.selectedIndex].value);"> <option class="heading" selected>�ֺ�<option value="7">һ��<option value="6">����<option value="5">����<option value="4">�ĺ�<option value="3">���<option value="2">����<option value="1">�ߺ�</option></select>
<div class="Btn" TITLE="������ɫ" LANGUAGE="javascript" onclick="foreColor();">
<img class="Ico" src="image/fgcolor.gif" WIDTH="23" HEIGHT="22">
</div>
<div class="TBSep"></div>
<div class="Btn" TITLE="�Ӵ�" LANGUAGE="javascript" onclick="format('bold');">
<img class="Ico" src="image/bold.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="Btn" TITLE="б��" LANGUAGE="javascript" onclick="format('italic');">
<img class="Ico" src="image/italic.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="Btn" TITLE="�»���" LANGUAGE="javascript" onclick="format('underline');">
<img class="Ico" src="image/underline.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="TBSep"></div>
<div class="Btn" TITLE="�����" NAME="Justify" LANGUAGE="javascript" onclick="format('justifyleft');">
<img class="Ico" src="image/aleft.gif" WIDTH="17" HEIGHT="16">
</div>
<div class="Btn" TITLE="����" NAME="Justify" LANGUAGE="javascript" onclick="format('justifycenter');">
<img class="Ico" src="image/center.gif" WIDTH="17" HEIGHT="16">
</div>
<div class="Btn" TITLE="�Ҷ���" NAME="Justify" LANGUAGE="javascript" onclick="format('justifyright');">
<img class="Ico" src="image/aright.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="TBSep"></div>
<div class="Btn" TITLE="���" LANGUAGE="javascript" onclick="format('insertorderedlist');">
<img class="Ico" src="image/numlist.gif" WIDTH="18" HEIGHT="18">
</div>
<div class="Btn" TITLE="��Ŀ����" LANGUAGE="javascript" onclick="format('insertunorderedlist');">
<img class="Ico" src="image/bullist.gif" WIDTH="18" HEIGHT="18">
</div>
<div class="Btn" TITLE="����������" LANGUAGE="javascript" onclick="format('outdent');">
<img class="Ico" src="image/outdent.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="Btn" TITLE="����������" LANGUAGE="javascript" onclick="format('indent');">
<img class="Ico" src="image/indent.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="TBSep"></div>
<div class="Btn" TITLE="ʹ�ð���" LANGUAGE="javascript" onclick="help();">
<img class="Ico" src="image/help.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="TBSep"></div>
</div>
</div>
<iframe class="Composition" ID="Composition" MARGINHEIGHT="1" MARGINWIDTH="1" width="100%" height="500">
</iframe>
<script src="edit.js" type="text/javascript"></script>
</body>
</html>