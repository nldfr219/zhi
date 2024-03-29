<html>
<head>
<title>编辑系统</title>
<link rel="STYLESHEET" type="text/css" href="edit.css">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
</head>
<body bgcolor="menu" onload="InitDocument();" STYLE="margin:0pt;padding:0pt;">
<div class="yToolbar" ID="ExtToolbar">
<div class="TBHandle"></div>
<div class="Btn" TITLE="删除" LANGUAGE="javascript" onclick="format1('delete');">
<img class="Ico" src="image/delete.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="Btn" TITLE="剪切" LANGUAGE="javascript" onclick="format1('cut');">
<img class="Ico" src="image/cut.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="Btn" TITLE="复制" LANGUAGE="javascript" onclick="format1('copy');">
<img class="Ico" src="image/copy.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="Btn" TITLE="粘贴" LANGUAGE="javascript" onclick="format1('paste');">
<img class="Ico" src="image/paste.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="Btn" TITLE="从word中粘贴" LANGUAGE="javascript" onclick="PasteWord();"> 
<img class="Ico" src="image/wordpaste.gif" WIDTH="18" HEIGHT="18">
</div>
<div class="Btn" TITLE="撤消" LANGUAGE="javascript" onclick="format1('undo');">
<img class="Ico" src="image/undo.gif" WIDTH="17" HEIGHT="16">
</div>
<div class="Btn" TITLE="恢复" LANGUAGE="javascript" onclick="format1('redo');">
<img class="Ico" src="image/redo.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="TBSep"></div>
<div class="Btn" TITLE="插入表格" LANGUAGE="javascript" onclick="fortable()">
<img class="Ico" src="image/table.gif" WIDTH="18" HEIGHT="18">
</div>
<div class="Btn" TITLE="插入超级连接" LANGUAGE="javascript" onclick="UserDialog('CreateLink')">
<img class="Ico" src="image/wlink.gif" WIDTH="22" HEIGHT="22">
</div>
<div class="Btn" TITLE="上传图片" LANGUAGE="javascript" onclick="window.open('img_upload.php','img_upload','width=481 height=190');">
<img class="Ico" src="image/img.gif" WIDTH="22" HEIGHT="22">
</div>
<div class="Btn" TITLE="插入水平线" LANGUAGE="javascript" onclick="format('InsertHorizontalRule')">
<img class="Ico" src="image/hr.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="TBSep"></div>
<select language="javascript" class="TBGen" id="FontName" title="字体名" onchange="format('fontname',this[this.selectedIndex].value);">
<option class="heading" selected>字体<option value="宋体">宋体<option value="黑体">黑体<option value="楷体_GB2312">楷体<option value="仿宋_GB2312">仿宋<option value="隶书">隶书<option value="幼圆">幼圆<option value="新宋体">新宋体<option value="细明体">细明体<option value="Arial">Arial<option value="Arial Black">Arial Black<option value="Arial Narrow">Arial Narrow<option value="Bradley Hand	ITC">Bradley
Hand ITC<option value="Brush Script	MT">Brush Script MT<option value="Century Gothic">Century Gothic<option value="Comic Sans MS">Comic Sans
MS<option value="Courier">Courier<option value="Courier New">Courier New<option value="MS Sans Serif">MS Sans Serif<option value="Script">Script<option value="System">System<option value="Times New Roman">Times New Roman<option value="Viner Hand ITC">Viner Hand ITC<option value="Verdana">Verdana<option value="Wide	Latin">Wide Latin<option value="Wingdings">Wingdings</option></select> <div class="TBSep"></div>
<div class="TBGen" id="EditMode" title="使用 HTML"><input onclick="setMode(this.checked);" type="checkbox">使用 HTML 语法书写 </div>
<div  TITLE="欢迎使用添加文章系统" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font color=red size=2px>
</font>
</div>
</div>
<div class="yToolbar">
<div class="TBHandle"></div>
<select ID="formatSelect" class="TBGen" title="段落格式" onchange="doSelectClick('FormatBlock',this)" style="font: icon; width: 80px;">
<option>段落格式</option>
<option VALUE="&lt;P&gt;">普通
<option VALUE="&lt;PRE&gt;">已编排格式
<option VALUE="&lt;H1&gt;">标题一
<option VALUE="&lt;H2&gt;">标题二
<option VALUE="&lt;H3&gt;">标题三
<option VALUE="&lt;H4&gt;">标题四
<option VALUE="&lt;H5&gt;">标题五
<option VALUE="&lt;H6&gt;">标题六
<option VALUE="&lt;H7&gt;">标题七
</select>
<select id="specialtype" class="TBGen" onchange="doSelectClick('FormatBlock',this)" style="font: icon; width: 100px;">
<option>特殊字体格式</option>
<option VALUE="SUP">上标
<option VALUE="SUB">下标
<option VALUE="DEL">删除线
<option VALUE="BLINK">闪烁
<option VALUE="BIG">增大字体
<option VALUE="SMALL">减小字体
</select>
<select language="javascript" class="TBGen" id="FontSize" title="字号大小" onchange="format('fontsize',this[this.selectedIndex].value);"> <option class="heading" selected>字号<option value="7">一号<option value="6">二号<option value="5">三号<option value="4">四号<option value="3">五号<option value="2">六号<option value="1">七号</option></select>
<div class="Btn" TITLE="字体颜色" LANGUAGE="javascript" onclick="foreColor();">
<img class="Ico" src="image/fgcolor.gif" WIDTH="23" HEIGHT="22">
</div>
<div class="TBSep"></div>
<div class="Btn" TITLE="加粗" LANGUAGE="javascript" onclick="format('bold');">
<img class="Ico" src="image/bold.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="Btn" TITLE="斜体" LANGUAGE="javascript" onclick="format('italic');">
<img class="Ico" src="image/italic.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="Btn" TITLE="下划线" LANGUAGE="javascript" onclick="format('underline');">
<img class="Ico" src="image/underline.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="TBSep"></div>
<div class="Btn" TITLE="左对齐" NAME="Justify" LANGUAGE="javascript" onclick="format('justifyleft');">
<img class="Ico" src="image/aleft.gif" WIDTH="17" HEIGHT="16">
</div>
<div class="Btn" TITLE="居中" NAME="Justify" LANGUAGE="javascript" onclick="format('justifycenter');">
<img class="Ico" src="image/center.gif" WIDTH="17" HEIGHT="16">
</div>
<div class="Btn" TITLE="右对齐" NAME="Justify" LANGUAGE="javascript" onclick="format('justifyright');">
<img class="Ico" src="image/aright.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="TBSep"></div>
<div class="Btn" TITLE="编号" LANGUAGE="javascript" onclick="format('insertorderedlist');">
<img class="Ico" src="image/numlist.gif" WIDTH="18" HEIGHT="18">
</div>
<div class="Btn" TITLE="项目符号" LANGUAGE="javascript" onclick="format('insertunorderedlist');">
<img class="Ico" src="image/bullist.gif" WIDTH="18" HEIGHT="18">
</div>
<div class="Btn" TITLE="减少缩进量" LANGUAGE="javascript" onclick="format('outdent');">
<img class="Ico" src="image/outdent.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="Btn" TITLE="增加缩进量" LANGUAGE="javascript" onclick="format('indent');">
<img class="Ico" src="image/indent.gif" WIDTH="16" HEIGHT="16">
</div>
<div class="TBSep"></div>
<div class="Btn" TITLE="使用帮助" LANGUAGE="javascript" onclick="help();">
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