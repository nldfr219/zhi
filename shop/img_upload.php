<HTML><HEAD><TITLE>上传图片</TITLE>
<META content="text/html; charset=gb2312" http-equiv=Content-Type>
<STYLE type=text/css>TD {
FONT-SIZE: 10.8pt
}
BODY {
FONT-SIZE: 10.8pt
}
BUTTON {
WIDTH: 6em; height:25
}
input {
 height:25
}
td{
  font-size:9pt
}
</STYLE>
</HEAD>
<BODY bgColor=menu style="font-size:9pt" style="border:0">
<DIV align=center>
<CENTER>
<FORM METHOD=POST ACTION="img_save.php" enctype="multipart/form-data" name=myform>
<TABLE border=0 cellspacing=0 cellpadding=0 align=center>
<tr>
   <td height=30>
<div align=left valign=middle>图片来源(<U>P</U>): &nbsp;&nbsp;&nbsp;<INPUT TYPE="file" id=src name="src" valign=top size=25>&nbsp;&nbsp;</div></td><td align=right><BUTTON id=Ok
type=submit style="width:6em" onclick="document.myform.submit();" name=sub>确定</BUTTON></td>
</tr>
<tr>
   <td height=30>
<div align=left valign=middle>替换文字(<U>T</U>): &nbsp;&nbsp;&nbsp;<INPUT TYPE="text" name="alt" align=top style="width:260">&nbsp;&nbsp;
   </div></td>
   <td align=right><BUTTON onclick="window.close();">取消</BUTTON>
   </td>
</tr>

<TR>
	<TD><BR>
      <TABLE border=0 cellspacing=0 cellpadding=0 width="100%">
        <TR>
	      <TD width="215"><fieldset style="height:86"> <legend align=left>布局</legend>
		  
		 <TABLE>
            <TR>
            	<TD height=25 align=center>&nbsp;对齐(<U>A</U>): &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <select name="align">
              <option>不设置</option>
              <option value="left">左</option>
              <option value="right">右</option>
              <option value="textTop">文本上方</option>
              <option value="absMiddle">正中央</option>
              <option value="baseline" selected>基线</option>
              <option value="absBottom">正下方</option>
              <option value="bottom">下</option>
              <option value="middle">中</option>
              <option value="top">上</option>
            </select></TD>
            </TR>
            <TR>
            	<TD>&nbsp;边框宽度(<U>B</U>):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="border" style="width:80"></TD>
            </TR>
            </TABLE>
            </fieldset></TD>
          <TD width="135" align=center><fieldset style="height:86"> <legend align=left>间隔</legend>
		  <TABLE>
            <TR>
            	<TD valign=bottom> 水平(<U>H</U>):&nbsp;
            <input type="text" name="hspace" size="5"></TD>
            </TR>
            <TR>
            	<TD valign=middle>垂直(<U>V</U>):&nbsp;
            <input type="text" name="vspace" size="5"></TD>
            </TR>
            </TABLE>
            </fieldset></TD>
</TR>
</TABLE>

</TD>
	<TD></TD>
</TR>
</TABLE>
</FORM>
</CENTER></DIV>
</BODY></HTML>