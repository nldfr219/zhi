<?php

// ----------------------------------------------------------------------------
// MODULE: month_calendar
// ----------------------------------------------------------------------------
function module_month_calendar($arguments)
{
    global $gDb, $gData;

    global $lvc_table_visitors;
    global $lvc_display_cache_delay;
    
	global $lvm_arr_months, $lvm_visitors_day, $lvm_month;
    global $lvm_average, $lvm_total;

	$is_archived = $arguments['archive'];

    if ($is_archived)
	{
        $values = explode("+", $gData['vpj']);
    }

    $month = $arguments['month'];
    $year  = $arguments['year'];

    $buffer  = "<BR><CENTER><TABLE CELLSPACING=1 BORDER=0>\n";

    $buffer .= "<TR><TD COLSPAN=17 ALIGN='left'><A CLASS='array'>";
    $buffer .= str_replace("{NB_LAST_MONTHS}", 1, $lvm_visitors_day)."</A>&nbsp;";
    $buffer .= "</TD><TD COLSPAN=17 ALIGN='right'>";
    if ($lvc_display_cache_delay) $buffer .= "<A CLASS='delay'>".cache_delay($arguments['cache'])."</A>";
    $buffer .= "</TD></TR>\n";
  
    $buffer .= "<TR><TH CLASS='vis'>".$lvm_month."</TH>";

    for ($count = 1; $count <= 31; $count++)
	{
        $buffer .= "<TH CLASS='vis'>" . (($count < 10) ? "0".$count : $count) . "</TH>";
	}

    $buffer .= "<TH CLASS='vis'>".$lvm_average."</TH>\n";
    $buffer .= "<TH CLASS='vis'>".$lvm_total."</TH></TR>\n";

    $finished = false;
    
    $buffer .= "<TR>\n";
    $buffer .= "<TD CLASS='month'>&nbsp;" . $lvm_arr_months[(int)$month] . "&nbsp;</TD>";

    $the_month = sprintf('%02d', $month);
    
    $total = 0;
    $cnt_values = 0;
    
    for ($count = 1; $count <= 31; $count++)
    {
        if (checkdate($month, $count, $year))
        {
            $day = date('D', mktime(12,0,0,$month, $count, $year));
            $color = (($day == 'Sat') || ($day == 'Sun')) ? 'vis3' : 'vis1';
            $buffer .= "<TD CLASS='".$color."' ALIGN='center'>";
            $the_day = $year.'/'.$the_month.'/'.(($count < 10) ? '0'.$count : $count);
  
            if (!$finished)
            {
                if ($is_archived)
                {
                    $val = $values[($count * 2) - 1];
                }
                else
                {
                    $query  = "SELECT COUNT(*) AS D FROM ".$lvc_table_visitors." WHERE DATE LIKE '".$the_day."%'";
                    
                    $gDb->DbQuery($query);
                    $gDb->DbNextRow();

                    $record = $gDb->Row;

                    $val = $record['D'];
                }
                
                if ($val != 0) $cnt_values++;

                $buffer .= ($val == 0) ? '&nbsp;' : $val;
                $total += $val;
            }
            else
            {
                $buffer .= '&nbsp;';
            }
  
            $finished = $finished || ($the_day == $today);
            $buffer .= "</TD>";
        }
        else
        {
            $buffer .= "<TD CLASS='vis2' ALIGN='right'>&nbsp;</TD>";
        }
    }

    $buffer .= "<TD CLASS='avg' ALIGN='right' NOWRAP>&nbsp;".($cnt_values == 0 ? '' : number_format(round($total/$cnt_values), 0, '', ' '))."&nbsp;</TD>\n";

    $buffer .= "<TD CLASS='month' ALIGN='right' NOWRAP>&nbsp;".($total == 0 ? '' : number_format($total, 0, '', ' '))."&nbsp;</TD></TR>\n";
    
    $buffer .= "</TABLE></CENTER><BR>\n";

    return( $buffer );
}

?>