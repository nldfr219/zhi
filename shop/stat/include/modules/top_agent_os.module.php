<?php

// ----------------------------------------------------------------------------
// MODULE: top_agent_os
// ----------------------------------------------------------------------------

function module_top_agent_os($arguments)
{
    global $gDb, $gData;
    
    global $lvc_nb_top_agent_os;
    global $lvc_display_cache_delay;
    global $lvc_table_visitors;
    
    global $lvm_top_agent_os, $lvm_agent, $lvm_number;

    
    $is_archived = $arguments['archive'];

    if ($is_archived)
    {
        $values = explode("+", $gData['topNavOS']);
        $limit = sizeof($values) / 2;

        for ($cnt = 0; $cnt < $limit; $cnt++)
        {
            $row[$cnt]['agent'] = $values[2 * $cnt];
            $row[$cnt]['nb']    = $values[(2 * $cnt) + 1];
        }
    }
    else
    {
        $month = $arguments['month'];
        $year  = $arguments['year'];

        $query  = "SELECT AGENT, COUNT(*) AS C ";
        $query .= "FROM ".$lvc_table_visitors." ";
        $query .= "WHERE AGENT <> '' AND DATE LIKE '".$year."/".sprintf("%02d",$month)."/%' ";
        $query .= "GROUP BY AGENT ";
        $query .= "ORDER BY C DESC, AGENT ";

        if ($gDb->DbQuery($query, 0, $lvc_nb_top_agent_os) && $gDb->DbNumRows() != 0)
        {
            $cnt = 0;
            while ($gDb->DbNextRow())
            {
                $record = $gDb->Row;

                $row[$cnt]['agent'] = $record['AGENT'];
                $row[$cnt]['nb']    = $record['C'];
                $cnt++;
            }
        }
        else
        {
            return('');
        }
    }

    $buffer  = "<BR><CENTER><TABLE CELLSPACING=1 BORDER=0>\n";
    $buffer .= "<TR><TD COLSPAN=2><A CLASS='array'>";
    $buffer .= str_replace("{NB_TOP_AGENT_OS}", $lvc_nb_top_agent_os, $lvm_top_agent_os)."</A></TD></TR>\n";
    $buffer .= "<TR>";
    $buffer .= "<TH CLASS='vis'>".$lvm_agent."</TH>";
    $buffer .= "<TH CLASS='vis' nowrap>&nbsp;".$lvm_number."&nbsp;</TH></TR>\n";

    for ($cnt = 0; $cnt < $lvc_nb_top_agent_os; $cnt++)
    {
        $buffer .= "<TR>";
        $buffer .= "<TD CLASS='vis'>&nbsp;<A CLASS='item'>".extract_agent($row[$cnt]['agent'])."</A>&nbsp;</TD>";
        $buffer .= "<TD CLASS='vis' ALIGN='right' NOWRAP>&nbsp;".($row[$cnt]['nb'] != 0 ? number_format($row[$cnt]['nb'], 0, '', ' ') : '')."&nbsp;</TD>";
        $buffer .= "</TR>\n";
    }

    // cache delay
    if ($lvc_display_cache_delay)
    {
        $buffer .= "<TR><TD ALIGN='center' COLSPAN='2'>";
        $buffer .= "<A CLASS='delay'>".cache_delay($arguments['cache'])."</A>";
    }

    $buffer .= "</TABLE></CENTER><BR>\n";

    return($buffer);
}

?>