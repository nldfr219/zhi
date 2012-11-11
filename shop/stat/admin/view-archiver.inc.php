<?php

// ----------------------------------------------------------------------------
// ADMIN : archiver
// ----------------------------------------------------------------------------

$gDb = new Db;

$connection = ( ($password == $lvc_db_password) && ($gDb->DbConnect($lvc_db_host, $lvc_db_user, $lvc_db_password, $lvc_db_database)) );

// EXPORT
if ($action == 'export')
{
    include($lvc_admin_dir.'/archiver-export.inc.php');
    exit;
}

if ($action != '' && !$connection)
{
    echo '<BR>'.display_error($lvm_connection_error);
}

?>

<SCRIPT LANGUAGE="JavaScript">
<!--
    function user_action_choice(action_value) {
        document.forms.archiverForm.action.value = action_value;
    }
//-->
</SCRIPT>

<?php

$current_month = date('n');

if (!isset($month)) $month = (($current_month == 1) ? 12 : $current_month - 1);
if (!isset($year))  $year  = (($current_month == 1) ? date('Y') - 1 : date('Y'));

// FORM
echo "<BR><CENTER><TABLE CELLSPACING=1 CELLPADDING='3' BORDER=0>\n";
echo "<FORM METHOD=POST NAME='archiverForm'>\n";

// action
echo "<INPUT TYPE='hidden' NAME='action'>\n";

echo "<TR>";
echo "<TH CLASS='vis' COLSPAN='2'>&nbsp;".$lvm_month." / ".$lvm_year."&nbsp;</TH>";
echo "<TH CLASS='vis'>&nbsp;".$lvm_password."&nbsp;</TH>";
echo "</TR>\n";

echo "<TR>";
echo "<TD CLASS='visref' ALIGN='center' COLSPAN='2' NOWRAP>&nbsp;";
echo "<SELECT NAME='month'>\n";   // month
for ($cnt = 1; $cnt <= 12; $cnt++)
{
    echo "<OPTION VALUE='".sprintf('%02d', $cnt)."' ".($cnt == $month ? ' SELECTED' : '').">".$lvm_arr_months[$cnt]."</OPTION>\n";
}
echo "</SELECT>&nbsp;\n";

echo "&nbsp;<SELECT NAME='year'>\n"; // year
for ($cnt = (date('Y')-1); $cnt <= (date('Y')+10); $cnt++)
{
    echo "<OPTION".($cnt == $year ? " SELECTED" : "").">".$cnt."</OPTION>\n";
}
echo "</SELECT>\n";
echo "</TD>\n";

echo "<TD CLASS='visref' ALIGN='center'>&nbsp;<INPUT TYPE='password' NAME='password' VALUE=\"".htmlspecialchars($password)."\">&nbsp;</TD>";
echo "</TR>\n";


// actions
echo "<TR>\n";
echo "<TD CLASS='visref' ALIGN='center'>&nbsp;&nbsp;</TD>";
echo "<TD CLASS='visref' ALIGN='center'>&nbsp;<INPUT TYPE='submit' VALUE=\"".htmlspecialchars($lvm_btn_check)."\" onClick='Javascript:user_action_choice(\"check\")'>&nbsp;</TD>";
echo "<TD CLASS='vis'>";
echo $lvm_archiver_check;
echo "</TD></TR>";

echo "<TR>\n";
echo "<TD CLASS='visref' ALIGN='center'>&nbsp;<B>1.</B>&nbsp;</TD>";
echo "<TD CLASS='visref' ALIGN='center'>&nbsp;<INPUT TYPE='submit' VALUE=\"".htmlspecialchars($lvm_btn_archive)."\" onClick='Javascript:user_action_choice(\"archive\")'>&nbsp;</TD>";
echo "<TD CLASS='vis'>";
echo str_replace('{ARCHIVES_TABLE}', $lvc_table_archives, $lvm_archiver_archive);
echo "</TD></TR>";

echo "<TR>\n";
echo "<TD CLASS='visref' ALIGN='center'>&nbsp;<B>2.</B>&nbsp;</TD>";
echo "<TD CLASS='visref' ALIGN='center'>&nbsp;<INPUT TYPE='submit' VALUE=\"".htmlspecialchars($lvm_btn_export)."\" onClick='Javascript:user_action_choice(\"export\")'>&nbsp;</TD>";
echo "<TD CLASS='vis'>";
echo str_replace('{VISITORS_TABLE}', $lvc_table_visitors, $lvm_archiver_export);
echo "</TD></TR>";

echo "<TR>\n";
echo "<TD CLASS='visref' ALIGN='center'>&nbsp;<B>3.</B>&nbsp;</TD>";
echo "<TD CLASS='visref' ALIGN='center'>&nbsp;<INPUT TYPE='submit' VALUE=\"".htmlspecialchars($lvm_btn_delete)."\" onClick='Javascript:user_action_choice(\"delete\")'>&nbsp;</TD>";
echo "<TD CLASS='vis'>";
echo str_replace('{VISITORS_TABLE}', $lvc_table_visitors, $lvm_archiver_delete);
echo "</TD></TR>";

echo "</FORM>\n";

echo "</TABLE>\n";

// ----------------------------------------------------------------------------
if ($action != '' && $connection)
{
    echo "<BR><TABLE CELLSPACING=1 CELLPADDING='3' BORDER=0>\n";
    include($lvc_admin_dir.'/archiver-'.$action.'.inc.php');
    echo "</TABLE>\n";
}

echo "</CENTER>";

?>