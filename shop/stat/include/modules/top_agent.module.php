<?php

// ----------------------------------------------------------------------------
// MODULE: top_agent
// ----------------------------------------------------------------------------

function module_top_agent($arguments)
{
    global $gDb, $gData;
    
	global $lvc_display_cache_delay;
	global $lvc_agent;
    global $lvc_table_visitors;
    
	global $lvm_top_agent, $lvm_agent, $lvm_number, $lvm_others_agent;

    
	$is_archived = $arguments['archive'];

    if ($is_archived)
	{
	    $big_total = 100;

        $values = explode("+", $gData['topNav']);
        $limit = sizeof($values) / 2;

        for ($cnt = 0; $cnt < $limit; $cnt++)
		{
			$cnt_agent[$values[2 * $cnt]] = $values[(2 * $cnt) + 1];
        }
    }
	else
	{
        $month = $arguments['month'];
        $year  = $arguments['year'];
        
        // total
        $big_total = 0;

        $query  = "SELECT COUNT(*) AS C ";
        $query .= "FROM ".$lvc_table_visitors." ";
        $query .= "WHERE DATE LIKE '".$year."/".sprintf("%02d",$month)."/%' ";
        
        if ($gDb->DbQuery($query) && $gDb->DbNumRows() != 0)
        {
            $gDb->DbNextRow();
            $record = $gDb->Row;
            
            $big_total = $record['C'];
        }
        else
        {
            return('');
        }

		$total  = 0;
        $others = '';
        for (reset($lvc_agent); list($key, $value) = each($lvc_agent);)
		{
            $query  = "SELECT COUNT(*) AS C ";
            $query .= "FROM ".$lvc_table_visitors." ";
            $query .= "WHERE DATE LIKE '".$year."/".sprintf("%02d",$month)."/%' ";
            $query .= "AND AGENT LIKE'%".$value."%'";
            
			$others .= " AND AGENT NOT LIKE'%".$value."%'";

            if ($gDb->DbQuery($query) && $gDb->DbNumRows() != 0)
	        {
                $gDb->DbNextRow();
		        $record = $gDb->Row;
                
				$cnt_agent[$key] = $record['C'];
                $total += $record['C'];
            }
            else
            {
                return('');
            }
        }
  
        // other agents
		$cnt_agent[$lvm_others_agent] = $big_total - $total;
    }

	$buffer  = "<BR><CENTER><TABLE CELLSPACING=1 BORDER=0>\n";
    $buffer .= "<TR><TD COLSPAN=2><A CLASS='array'>".$lvm_top_agent."</A></TD></TR>\n";
    $buffer .= "<TR>";
    $buffer .= "<TH CLASS='vis'>".$lvm_agent."</TH>";
    $buffer .= "<TH CLASS='vis'>&nbsp;".$lvm_number."&nbsp;</TH></TR>\n";

    if (sizeof($cnt_agent) != 0)
	{
		for (reset($cnt_agent); list($key,$value) = each($cnt_agent); )
	    {
  	        $percent = ($big_total == 0) ? 0 : round(($value / $big_total) * 1000) / 10;
		    $list_agent[] = Array($key, $percent);
        }
        
	    usort($list_agent, 'sort_agent');
		
		for ($cnt = 0; $cnt < sizeof($list_agent); $cnt++)
		{
	        $buffer .= "<TR>";
            $buffer .= "<TD CLASS='vis'>&nbsp;<A CLASS='item'>".$list_agent[$cnt][0]."</A>&nbsp;</TD>";
            $buffer .= "<TD CLASS='vis' ALIGN='right'>&nbsp;".sprintf('%.1f', $list_agent[$cnt][1])." %&nbsp;</TD>";
  	        $buffer .= "</TR>\n";
		}
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


function sort_agent($a, $b)
{
    if ($a[1] == $b[1]) return 0;
    return ($a[1] > $b[1]) ? -1 : 1;  
}


?>