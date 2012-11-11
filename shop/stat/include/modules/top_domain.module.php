<?php

// ----------------------------------------------------------------------------
// MODULE: top_domain (month)
// ----------------------------------------------------------------------------

function module_top_domain($arguments)
{
    global $gDb, $gData;
    
	global $lvc_display_cache_delay;
	global $lvc_nb_top_domain;
    global $lvc_table_visitors, $lvc_table_domains;
    
	global $lvm_top_domain, $lvm_number, $lvm_domain, $lvm_description;

    
    // loading domains descriptions
    $query  = "SELECT domaine, description FROM ".$lvc_table_domains;
    if ($gDb->DbQuery($query) && $gDb->DbNumRows() != 0)
	{
        while ($gDb->DbNextRow())
	    {
		    $record = $gDb->Row;
            $arr_domains[$record[0]] = array(0, $record[1]);  // domain -> count, desc
        }
	}

	$is_archived = $arguments['archive'];

	if ($is_archived)
	{
        $values = explode("+", $gData['topDom']);
        $limit = sizeof($values) / 2;

        for ($cnt = 0; $cnt < $limit; $cnt++)
		{
            $arr_domains[$values[2 * $cnt]][0] += $values[(2 * $cnt) + 1];
        }
    }
	else
	{
        $month = $arguments['month'];
        $year  = $arguments['year'];
        
        $query  = "SELECT LCASE(SUBSTRING_INDEX(HOST, '.', -1)) AS D, COUNT(*) AS C ";
        $query .= "FROM ".$lvc_table_visitors." ";
        $query .= "WHERE (HOST <> ADDR) AND DATE LIKE '".$year."/".sprintf("%02d",$month)."/%' ";
        $query .= "GROUP BY D ";
        $query .= "ORDER BY C DESC, D ";

        if ($gDb->DbQuery($query, 0, $lvc_nb_top_domain) && $gDb->DbNumRows() != 0)
	    {
            while ($gDb->DbNextRow())
			{
		        $record = $gDb->Row;
                $arr_domains[$record['D']][0] = $record['C'];
            }
        }
    }

	$buffer  = "<BR><CENTER><TABLE CELLSPACING=1 BORDER=0>\n";
    $buffer .= "<TR><TD COLSPAN=2><A CLASS='array'>".str_replace('{NB_TOP_DOMAIN}', $lvc_nb_top_domain, $lvm_top_domain)."</A></TD></TR>\n";
    $buffer .= "<TR>";
    $buffer .= "<TH CLASS='vis'>".$lvm_domain."</TH>";
    $buffer .= "<TH CLASS='vis'>".$lvm_description."</TH>";
    $buffer .= "<TH CLASS='vis'>&nbsp;".$lvm_number."&nbsp;</TH></TR>\n";

    if (sizeof($arr_domains) != 0)
	{
		for (reset($arr_domains); list($key, $value) = each($arr_domains); )
	    {
		    $list_domains[] = Array($key, $value[0], $value[1]);
        }

		usort($list_domains, 'sort_domain');
		
		for ($cnt = 0; $cnt < $lvc_nb_top_domain; $cnt++)
		{
            $count = $list_domains[$cnt][1];
	        $buffer .= "<TR>";
            $buffer .= "<TD CLASS='vis' ALIGN='left'>&nbsp;<A CLASS='item'>" .($count ? $list_domains[$cnt][0] : ''). "</A>&nbsp;</TD>";
            $buffer .= "<TD CLASS='vis' ALIGN='left'>&nbsp;<A CLASS='item'>" .($count ? $list_domains[$cnt][2] : ''). "</A>&nbsp;</TD>";
            $buffer .= "<TD CLASS='vis' ALIGN='right'>&nbsp;" .($count != 0 ? number_format($count, 0, '', ' ') : ''). "&nbsp;</TD>";
  	        $buffer .= "</TR>\n";
		}
	}

	// cache delay
	if ($lvc_display_cache_delay)
	{
	    $buffer .= "<TR><TD ALIGN='center' COLSPAN='3'>";
        $buffer .= "<A CLASS='delay'>".cache_delay($arguments['cache'])."</A>";
	}

	$buffer .= "</TABLE></CENTER><BR>\n";

    return($buffer);
}


function sort_domain($a, $b)
{
    if ($a[1] == $b[1])
	    return(strcmp($a[0], $b[0]));
	else
        return ($a[1] > $b[1]) ? -1 : 1;  
}

?>