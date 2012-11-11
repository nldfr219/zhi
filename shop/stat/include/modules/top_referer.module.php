<?php

// ----------------------------------------------------------------------------
// MODULE: top_referer (month)
// ----------------------------------------------------------------------------

function module_top_referer($arguments)
{
    global $gDb, $gData;
    
	global $lvc_nb_top_referer;
	global $lvc_display_cache_delay;
    global $lvc_table_visitors;
    
	global $lvm_top_referer, $lvm_referer, $lvm_number;

    
	$is_archived = $arguments['archive'];

    if ($is_archived)
	{
        $values = explode("+", $gData['topRef']);
        $limit = sizeof($values) / 2;

        for ($cnt = 0; $cnt < $limit; $cnt++)
		{
            $row[$cnt]['referer'] = strip_tags($values[2 * $cnt]);
            $row[$cnt]['nb']      = $values[(2 * $cnt) + 1];
        }
    }
	else
	{
        $month = $arguments['month'];
        $year  = $arguments['year'];

        $query  = "SELECT REF_HOST, COUNT(*) AS C ";
        $query .= "FROM ".$lvc_table_visitors." ";
        $query .= "WHERE REF_HOST <> '' AND REF_HOST <> '[unknown origin]' AND REF_HOST <> 'bookmarks' ";
		$query .= "AND DATE LIKE '".$year."/".sprintf("%02d",$month)."/%' ";
        $query .= "GROUP BY REF_HOST ";
        $query .= "ORDER BY C DESC, REF_HOST ";

        if ($gDb->DbQuery($query, 0, $lvc_nb_top_referer) && $gDb->DbNumRows() != 0)
	    {
		    $cnt = 0;
            while ($gDb->DbNextRow())
			{
		        $record = $gDb->Row;
                $row[$cnt]['referer'] = strip_tags($record['REF_HOST']);
	            $row[$cnt]['nb']      = $record['C'];
				$cnt++;
            }
        }
    }

    $buffer  = "<BR><CENTER><TABLE CELLSPACING=1 BORDER=0>\n";
    $buffer .= "<TR><TD COLSPAN=2><A CLASS='array'>";
	$buffer .= str_replace("{NB_TOP_REFERER}", $lvc_nb_top_referer, $lvm_top_referer)."</A></TD></TR>\n";
    $buffer .= "<TR>";
    $buffer .= "<TH CLASS='vis'>".$lvm_referer."</TH>";
    $buffer .= "<TH CLASS='vis'>&nbsp;".$lvm_number."&nbsp;</TH></TR>\n";

    for ($cnt = 0; $cnt < $lvc_nb_top_referer; $cnt++)
	{
        $buffer .= "<TR>";
        $buffer .= "<TD CLASS='vis'>&nbsp;<A CLASS='host'>".html_link($row[$cnt]['referer'], $row[$cnt]['referer'], '_blank') . "</A>&nbsp;</TD>";
        $buffer .= "<TD CLASS='vis' ALIGN='right'>&nbsp;".($row[$cnt]['nb'] != 0 ? number_format($row[$cnt]['nb'], 0, '', ' ') : '')."&nbsp;</TD>";
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