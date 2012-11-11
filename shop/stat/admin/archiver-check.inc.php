<?php

echo "<TR>";
echo "<TH CLASS='vis' COLSPAN='3'>&nbsp;".$lvm_check_archive."&nbsp;</TH>";
echo "</TR>\n";

$rname = Array('vpm', 'topVis', 'topNavOS', 'topOS', 'topNav', 'vph', 'topRef', 'topDom', 'vpj');

$query  = "SELECT vpm, topVis, topNavOS, topOS, topNav, vph, topRef, topDom, vpj ";
$query .= "FROM ".$lvc_table_archives." ";
$query .= "WHERE annee='".$year."' AND mois='".(int)$month."'";

if ($gDb->DbQuery($query) && $gDb->DbNumRows() != 0)
{
    while ($gDb->DbNextRow())
    {
        $record = $gDb->Row;
        for ($cnt = 0; $cnt < sizeof($rname); $cnt++)
        {
            echo "<TR>";
            echo "<TD CLASS='visref' COLSPAN='2' ALIGN='center'>&nbsp;<B>".$rname[$cnt]."</B>&nbsp;</TD>";
            echo "<TD CLASS='vis' ALIGN='left'>&nbsp;".str_replace('+', ' + ', htmlspecialchars($record[$rname[$cnt]]))."&nbsp;</TD>";
            echo "</TR>\n";
        }
    }
}
else
{
    echo "<TR>";
    echo "<TD CLASS='visref' COLSPAN='3' ALIGN='center'><BR><A CLASS='error'>&nbsp;&nbsp;&gt;&gt; ".$lvm_no_archive." &lt;&lt;&nbsp;&nbsp;</A><BR><BR></TD>";
    echo "</TR>\n";
}

?>