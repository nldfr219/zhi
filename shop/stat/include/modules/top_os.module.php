<?php

// ----------------------------------------------------------------------------
// MODULE: top_os
// ----------------------------------------------------------------------------

function module_top_os($arguments)
{
    global $gDb, $gData;
    
	global $lvc_display_cache_delay;
	global $lvc_OS;
    global $lvc_table_visitors;
    
	global $lvm_top_os, $lvm_number, $lvm_os, $lvm_others_os;

    
	$is_archived = $arguments['archive'];

    if ($is_archived)
	{
	    $big_total = 100;

        $values = explode("+", $gData['topOS']);
        $limit = sizeof($values) / 2;

        for ($cnt = 0; $cnt < $limit; $cnt++)
		{
			$cnt_OS[$values[2 * $cnt]] = $values[(2 * $cnt) + 1];
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
        for (reset($lvc_OS); list($key, $value) = each($lvc_OS);)
		{
            $query  = "SELECT COUNT(*) AS C ";
            $query .= "FROM ".$lvc_table_visitors." ";
            $query .= "WHERE DATE LIKE '".$year."/".sprintf("%02d",$month)."/%' ";
            $query .= "AND AGENT LIKE'%".$key."%'";
            
            if ($gDb->DbQuery($query) && $gDb->DbNumRows() != 0)
	        {
                $gDb->DbNextRow();
		        $record = $gDb->Row;
                
				$cnt_OS[$value] = $record['C'];
                $total += $record['C'];
            }
        }
  
        // other OS
		$cnt_OS[$lvm_others_os] = $big_total - $total;
    }

	$buffer  = "<BR><CENTER><TABLE CELLSPACING=1 BORDER=0>\n";
    $buffer .= "<TR><TD COLSPAN=2><A CLASS='array'>".$lvm_top_os."</A></TD></TR>\n";
    $buffer .= "<TR>";
    $buffer .= "<TH CLASS='vis'>".$lvm_os."</TH>";
    $buffer .= "<TH CLASS='vis'>&nbsp;".$lvm_number."&nbsp;</TH></TR>\n";

    if (sizeof($cnt_OS) != 0)
	{
		for (reset($cnt_OS); list($key,$value) = each($cnt_OS); )
	    {
  	        $percent = ($big_total == 0) ? 0 : round(($value / $big_total) * 1000) / 10;
		    $list_OS[] = Array($key, $percent);
        }
        
	    usort($list_OS, 'sort_os');
		
		for ($cnt = 0; $cnt < sizeof($list_OS); $cnt++)
		{
	        $buffer .= "<TR>";
            $buffer .= "<TD CLASS='vis'>&nbsp;<A CLASS='item'>".$list_OS[$cnt][0]."</A>&nbsp;</TD>";
            $buffer .= "<TD CLASS='vis' ALIGN='right'>&nbsp;".sprintf('%.1f', $list_OS[$cnt][1])." %&nbsp;</TD>";
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


function sort_os($a, $b)
{
    if ($a[1] == $b[1]) return 0;
    return ($a[1] > $b[1]) ? -1 : 1;  
}


?>