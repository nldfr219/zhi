<SCRIPT LANGUAGE="JavaScript">
<!--
    function user_delete_choice(yesno) {
        document.forms.confirmForm.choice.value = yesno;
    }
//-->
</SCRIPT>

<?php

echo "<TR>";
echo "<TH CLASS='vis' COLSPAN='3'>&nbsp;".str_replace('{VISITORS_TABLE}', $lvc_table_visitors, $lvm_delete_visitors)."&nbsp;</TH>";
echo "</TR>\n";

echo "<TR>";
echo "<TD CLASS='visref' COLSPAN='3' ALIGN='center'>&nbsp;";

if ($action == 'delete' && $connection && $confirm != 'yes')
{
    echo "<CENTER><FORM METHOD='POST' NAME='confirmForm'>\n";
    echo "<A CLASS='error'>&nbsp;&nbsp;".$lvm_confirm_delete."&nbsp;&nbsp;</A>\n";
    echo "&nbsp;&nbsp;&nbsp;<INPUT TYPE='submit' VALUE=\"".htmlspecialchars($lvm_yes)."\" onClick='Javascript:user_delete_choice(1)'>";
    echo "&nbsp;&nbsp;&nbsp;<INPUT TYPE='submit' VALUE=\"".htmlspecialchars($lvm_no)."\"  onClick='Javascript:user_delete_choice(0)'>\n";
    echo "<INPUT TYPE='hidden' NAME='action' VALUE='delete'>\n";
    echo "<INPUT TYPE='hidden' NAME='month' VALUE='".$month."'>\n";
    echo "<INPUT TYPE='hidden' NAME='year' VALUE='".$year."'>\n";
    echo "<INPUT TYPE='hidden' NAME='password' VALUE='".$password."'>\n";
    echo "<INPUT TYPE='hidden' NAME='confirm' VALUE='yes'>\n";
    echo "<INPUT TYPE='hidden' NAME='choice' VALUE='0'>\n";
    echo "</FORM></CENTER>\n";
}
elseif ($action == 'delete' && $connection && $confirm == 'yes')
{
    if ($choice == 1)
    {
        $query  = 'DELETE FROM '.$lvc_table_visitors.' ';
        $query .= "WHERE DATE LIKE '".$year.'/'.sprintf('%02d', $month)."/%'";
        
        $gDb->DbQuery($query);

        echo "<CENTER><A CLASS='ok'>&nbsp;&nbsp;".$lvm_delete_ok."&nbsp;&nbsp;</A></CENTER>\n";
    }
    else
    {
        echo "<CENTER><A CLASS='ok'>&nbsp;&nbsp;&gt;&gt; ".$lvm_no_delete." &lt;&lt;&nbsp;&nbsp;</A></CENTER>\n";
    }
}

echo "&nbsp;</TD>";
echo "</TR>\n";

?>