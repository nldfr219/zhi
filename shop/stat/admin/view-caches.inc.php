<SCRIPT LANGUAGE="JavaScript">
<!--
function check_all(name, state)
{
    len = document.forms[0].elements.length;
    for (i = 0; i < len; i++) {
	  if (document.forms[0].elements[i].name == name)
        document.forms[0].elements[i].checked = (state == 1);
    }
}
//-->
</SCRIPT>

<?php

// ----------------------------------------------------------------------------
// ADMIN : caches
// ----------------------------------------------------------------------------

function sort_files($a, $b)
{
    if ($a[0] == $b[0]) return 0;
    return ($a[0] > $b[0]) ? -1 : 1;  
}


// deleting selected files
if ($action == 'delete')
{
    if ($password == $lvc_db_password)
    {
        for ($cnt = 0; $cnt < sizeof($cache_name); $cnt++)
        {
            @unlink($lvc_cache_dir.'/'.$cache_name[$cnt]);
        }
    }
    else
    {
        echo '<BR>'.display_error($lvm_invalid_password);
    }
}


echo "<BR><CENTER><TABLE CELLSPACING=1 BORDER=0>\n";
echo "<FORM METHOD=POST>\n";
echo "<INPUT TYPE='hidden' NAME='action' VALUE='delete'>\n";
echo "<TR>";
echo "<TH CLASS='vis'>&nbsp;".$lvm_delete."&nbsp;</TH>";
echo "<TH CLASS='vis'>&nbsp;".$lvm_file."&nbsp;</TH>";
echo "<TH CLASS='vis'>&nbsp;".$lvm_creation_date."&nbsp;</TH>";
echo "<TH CLASS='vis'>&nbsp;".$lvm_size."&nbsp;</TH>";
echo "</TR>\n";

$dir = opendir($lvc_cache_dir);
while ($file = readdir($dir))
{
    if ($file != "." && $file != "..")
    {
        $file_name = $lvc_cache_dir.'/'.$file;
        $arr_files[] = Array($file, ereg('^img', $file) ? ICON_GRAPH : ICON_ARRAY, date('Y-m-d H:i:s', filemtime($file_name)), filesize($file_name));
    }
}
closedir($dir);

if (sizeof($arr_files)) usort($arr_files, 'sort_files');

$size = 0;

for ($cnt = 0; $cnt < sizeof($arr_files); $cnt++)
{
    echo "<TR>\n";
    echo "<TD CLASS='vis' ALIGN='center'>&nbsp;<INPUT TYPE='checkbox' NAME='cache_name[]' VALUE='".$arr_files[$cnt][0]."'>&nbsp;</TD>";
    echo "<TD CLASS='vis'>&nbsp;".html_image($g_relative_path.'images/'.$arr_files[$cnt][1])."&nbsp;\n";
    echo $arr_files[$cnt][0]."&nbsp;</TD>\n";
    echo "<TD CLASS='vis' ALIGN='center'>&nbsp;".show_datetime($arr_files[$cnt][2])."&nbsp;</TD>\n";
    echo "<TD CLASS='vis' ALIGN='right'>&nbsp;".number_format($arr_files[$cnt][3], 0, '', ' ')."&nbsp;</TD>\n";
    echo "</TR>\n";

    $size += $arr_files[$cnt][3];
}

$size /= 1024;

if ($cnt == 0)
{
    echo "<TR>\n";
    echo "<TD CLASS='vis' ALIGN='center' COLSPAN='4'>&nbsp;<BR><B>".$lvm_no_cache."</B><BR>&nbsp;</TD>\n";
    echo "</TR>\n";
}
else
{
    echo "<TR>\n";
    echo "<TD CLASS='vis' ALIGN='center' COLSPAN='2'>";
    echo "&nbsp;<B>&middot;</B>&nbsp;<A HREF='javascript:check_all(\"cache_name[]\",1)'>".$lvm_check_all."</A>";
    echo "&nbsp;<B>&middot;</B>&nbsp;<A HREF='javascript:check_all(\"cache_name[]\",0)'>".$lvm_uncheck_all."</A>";
    echo "&nbsp;<B>&middot;</B>&nbsp;</TD>\n";
    echo "<TD CLASS='vis' ALIGN='center' COLSPAN='2'>&nbsp;<B>".($size != 0 ? number_format($size, 1, '', ' ').' Ko' : '')."</B>&nbsp;</TD>\n";
    echo "</TR>\n";

    echo "<TR><TH BGCOLOR='#FFFFAA' COLSPAN='4' HEIGHT='1' CLASS='vis'>";
    echo html_image("images/nothing.gif");
    echo "</TH></TR>\n";

    echo "<TR HEIGHT='40'>\n";
    echo "<TD CLASS='visref' COLSPAN='2' ALIGN='center'>&nbsp;<B>".$lvm_password."</B>&nbsp;&nbsp;<INPUT TYPE='password' NAME='password' VALUE=\"".htmlspecialchars($password)."\">&nbsp;</TD>";
    echo "<TD CLASS='visref' COLSPAN='2' ALIGN='center'>&nbsp;<INPUT TYPE='submit' VALUE='".$lvm_delete."'></TD>";
    echo "</TR>\n";
}

echo "</TABLE></CENTER>\n";
echo "</FORM>\n";
echo "<BR>";

?>