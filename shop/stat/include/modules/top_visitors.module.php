<?php

// ----------------------------------------------------------------------------
// MODULE: top_visitors
// ----------------------------------------------------------------------------

function module_top_visitors($arguments)
{
    global $gDb, $gData;

    global $lvc_nb_top_visitors;
    global $lvc_hide_IP;
    global $lvc_display_cache_delay;
    global $lvc_table_visitors;

    global $lvm_top_visitors, $lvm_host, $lvm_number;


    $is_archived = $arguments['archive'];

    if ($is_archived)
    {
        $values = explode("+", $gData['topVis']);
        $limit = sizeof($values) / 2;

        for ($cnt = 0; $cnt < $limit; $cnt++)
        {
            $row[$cnt]['host'] = $values[2 * $cnt];
            $row[$cnt]['nb']   = $values[(2 * $cnt) + 1];
        }
    }
    else
    {
        // to avoid 'table full' errors
        if (!($gDb->DbQuery('SET SQL_BIG_TABLES = 1'))) return('');

        $month = $arguments['month'];
        $year  = $arguments['year'];

        $query  = "SELECT HOST, COUNT(*) AS C ";
        $query .= "FROM ".$lvc_table_visitors." ";
        $query .= "WHERE DATE LIKE '".$year."/".sprintf("%02d",$month)."/%' ";
        $query .= "GROUP BY HOST ";
        $query .= "ORDER BY C DESC, HOST ";

        if ($gDb->DbQuery($query, 0, $lvc_nb_top_visitors) && $gDb->DbNumRows() != 0)
        {
            $cnt = 0;
            while ($gDb->DbNextRow())
            {
                $visitor = $gDb->Row;
                $row[$cnt]['host'] = $visitor['HOST'];
                $row[$cnt]['nb']   = $visitor['C'];
                $cnt++;
            }
        }
        else
        {
            return('');
        }
    }


    $buffer  = "<BR><CENTER><TABLE CELLSPACING=1 BORDER=0>\n";
    $buffer .= "<TR><TD COLSPAN=3><A CLASS='array'>";
    $buffer .= str_replace("{NB_TOP_VISITORS}", $lvc_nb_top_visitors, $lvm_top_visitors)."</A></TD></TR>\n";
    $buffer .= "<TR>";
    $buffer .= "<TH CLASS='vis'>".$lvm_host."</TH>";
    $buffer .= "<TH CLASS='vis'>&nbsp;".$lvm_number."&nbsp;</TH></TR>\n";

    for ($cnt = 0; $cnt < $lvc_nb_top_visitors; $cnt++)
    {
        $buffer .= "<TR>";
        $buffer .= "<TD CLASS='vis'>&nbsp;<A CLASS='host'>".($lvc_hide_IP ? hide_machine($row[$cnt]['host']) : $row[$cnt]['host'])."</A>&nbsp;</TD>";
        $buffer .= "<TD CLASS='vis' ALIGN='right'>&nbsp;".($row[$cnt]['nb'] != 0 ? number_format($row[$cnt]['nb'], 0, '', ' ') : '')."&nbsp;</TD>";
        $buffer .= "</TR>\n";
    }
    
    // cache delay
    if ($lvc_display_cache_delay)
    {
        $buffer .= "<TR><TD ALIGN='center' COLSPAN='3'>";
        $buffer .= "<A CLASS='delay'>".cache_delay($arguments['cache'])."</A>";
    }

    $buffer .= "</TD></TR></TABLE></CENTER><BR>\n";

    return( $buffer );
}

?>