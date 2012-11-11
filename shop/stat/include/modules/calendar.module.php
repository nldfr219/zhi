<?php

// ----------------------------------------------------------------------------
// MODULE: calendar
// ----------------------------------------------------------------------------
function module_calendar($arguments)
{
    global $gDb;

    global $lvc_nb_months_calendar;
	global $lvc_site_opening_year;
	global $lvc_site_opening_month;
    global $lvc_table_visitors;
    global $lvc_display_cache_delay;
    
	global $lvm_arr_months, $lvm_visitors_per_day, $lvm_month;
    global $lvm_average, $lvm_total;

    $buffer = '';

    $current_year  = date('Y');
    $current_month = date('n');
    $today         = date('Y/m/d');

    $first_year  = $current_year;
    $first_month = $current_month;

    // looking for first month and first year in calendar
    for ($cnt_month = 1; $cnt_month < $lvc_nb_months_calendar && !($first_year == $lvc_site_opening_year && $first_month == $lvc_site_opening_month); $cnt_month++)
	{
        $first_month = ($first_month == 1) ? 12 : $first_month - 1;
        $first_year = ($first_month == 12) ? $first_year -1 : $first_year;
    }

    $buffer .= "<BR><CENTER><TABLE CELLSPACING=1 BORDER=0>\n";

    $buffer .= "<TR><TD COLSPAN=17 ALIGN='left'><A CLASS='array'>";
    $buffer .= str_replace("{NB_LAST_MONTHS}", $cnt_month, $lvm_visitors_per_day)."</A>&nbsp;";
    $buffer .= "</TD><TD COLSPAN=17 ALIGN='right'>&nbsp;";
    if ($lvc_display_cache_delay) $buffer .= "<A CLASS='delay'>".cache_delay($arguments['cache'])."</A>";
    $buffer .= "</TD></TR>\n";
  
    $buffer .= "<TR><TH CLASS='vis'>".$lvm_month."</TH>";

    for ($count = 1; $count <= 31; $count++)
	{
        $buffer .= "<TH CLASS='vis'>" . (($count < 10) ? "0".$count : $count) . "</TH>";
	}

    $buffer .= "<TH CLASS='vis'>".$lvm_average."</TH>\n";
    $buffer .= "<TH CLASS='vis'>".$lvm_total."</TH></TR>\n";

    $Month  = $first_month;
    $Year   = $first_year;

    $finished = false;
    $prev_year = $Year;
    
    $big_cnt_values = 0;
    $big_total  = 0;

	for ($count = 1; $count <= $cnt_month; $count++)
	{  
        // separation between 2 years
        if ($Year != $prev_year) {
            $buffer .= "<TR><TH BGCOLOR='#FFFFAA' COLSPAN='34' HEIGHT='1'>";
            $buffer .= html_image("images/nothing.gif");
            $buffer .= "</TH></TR>\n";
        }
        
        // load month archive if exists
        $data = archive_month($Month, $Year, 'vpj');  // vpj: visitor per day
        
		if ($archive = ($data[0] != NO_ARCHIVE))
		{
            $values = explode('+', $data[0]);
		}
  
        $buffer .= "<TR>\n";
        $buffer .= "<TD CLASS='month'>&nbsp;<A CLASS='month' HREF='?view=".VIEW_MONTH."&year=".$Year."&month=".sprintf('%02d', $Month)."'>" . $lvm_arr_months[$Month] . "</A>&nbsp;</TD>";

        $the_month = sprintf('%02d', $Month);
        
        $total = 0;
        $cnt_values = 0;
        
        for ($count2 = 1; $count2 <= 31; $count2++)
		{
  	        if (checkdate($Month, $count2, $Year))
			{
	            $day = date('D', mktime(12,0,0,$Month, $count2, $Year));
                $color = (($day == 'Sat') || ($day == 'Sun')) ? 'vis3' : 'vis1';
	            $buffer .= "<TD CLASS='".$color."' ALIGN='center'>";
                $the_day = $Year.'/'.$the_month.'/'.(($count2 < 10) ? '0'.$count2 : $count2);
	  
	            if (!$finished)
				{
		            if ($archive)
					{
		                $val = $values[($count2 * 2) - 1];
		            }
					else
					{
	                    $query  = "SELECT COUNT(*) AS D FROM ".$lvc_table_visitors." WHERE DATE LIKE '".$the_day."%'";
                        
						$gDb->DbQuery($query);
						$gDb->DbNextRow();

						$record = $gDb->Row;

		                $val = $record['D'];
		            }
	                
                    if ($val > 0) $cnt_values++;

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
    
        if ($cnt_values > 0)
        {
            $big_cnt_values += $cnt_values;
            $big_total += $total;
        }

        $buffer .= "<TD CLASS='avg' ALIGN='right' NOWRAP>&nbsp;".($cnt_values == 0 ? '' : number_format(round($total/$cnt_values), 0, '', ' '))."&nbsp;</TD>\n";

        $buffer .= "<TD CLASS='month' ALIGN='right' NOWRAP>&nbsp;".($total == 0 ? '' : number_format($total, 0, '', ' '))."&nbsp;</TD></TR>\n";
        
        $prev_year = $Year;

        $Month = ($Month == 12) ? 1         : $Month + 1;
        $Year  = ($Month ==  1) ? $Year + 1 : $Year;
    }
    
    $buffer .= "<TR><TH COLSPAN='32'>";
    $buffer .= html_image("images/nothing.gif");
    $buffer .= "</TH><TH BGCOLOR='#B8C8FE' COLSPAN='2' HEIGHT='1'>";
    $buffer .= html_image("images/nothing.gif");
    $buffer .= "</TH></TR>\n";

    $buffer .= "<TD COLSPAN='32'>&nbsp;</TD>";
    $buffer .= "<TD CLASS='avg' ALIGN='right' NOWRAP>&nbsp;".($big_cnt_values == 0 ? '' : number_format(round($big_total/$big_cnt_values), 0, '', ' '))."&nbsp;</TD>\n";
    $buffer .= "<TD CLASS='month' ALIGN='right' NOWRAP>&nbsp;".($big_total == 0 ? '' : number_format($big_total, 0, '', ' '))."&nbsp;</TD></TR>\n";

    $buffer .= "</TABLE></CENTER><BR>\n";

    return( $buffer );
}

?>