<?php

function module_last_months($arguments)
{
    global $lvc_nb_last_months;
    global $lvc_site_opening_month;
    global $lvc_site_opening_year;
    
	global $lvm_month, $lvm_archived, $lvm_arr_months;

    $buffer = '';

    $month = date('n');
    $year  = date('Y');

    $finished  = false;

    $buffer .= "<TABLE CELLSPACING=0 BORDER=0>\n";

    for ($count = 1; $count <= $lvc_nb_last_months; $count++)
	{
  
        $buffer .= "<TR><TD>&nbsp;";

        if ($finished)
		{
            $archive = '';
        }
		else
		{
            $data = archive_month($month, $year, 'code');
	        
            if ($data[0] == NO_ARCHIVE)
                $archive = '';
            elseif ($data[0] == DB_ERROR)
                $archive = '<A CLASS="archived">[?]</A>';
            else
                $archive = '<A CLASS="archived">['.$lvm_archived.']</A>';
        }
  
        if (!$finished)
		{
            $finished = ($month == $lvc_site_opening_month && $year == $lvc_site_opening_year);
	        $the_month = ($month < 10) ? "0".$month : $month;
			
            $link = "./?view=month&year=".$year."&month=".$the_month;
			
            $buffer .= '&nbsp;'.html_link($link, html_image('images/'.ICON_PUCE)).'&nbsp;';
	        $buffer .= "<A HREF='".$link."'>";
	        $buffer .= $lvm_arr_months[$month];
	        $buffer .= " ".$year;
	        $buffer .= "</A>";
	        
            $month = ($month ==  1) ?       12 : $month - 1;
	        $year  = ($month == 12) ? $year -1 : $year;
        }
  
        $buffer .= "&nbsp;</TD><TD ALIGN='center'>&nbsp;";
        $buffer .= $archive;
        $buffer .= "&nbsp;</TD></TR>";
    }
  
    $buffer .= "</TABLE>";

    return( $buffer );
}

?>