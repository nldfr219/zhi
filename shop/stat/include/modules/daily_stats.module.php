<?php

// ----------------------------------------------------------------------------
// MODULE: daily_stats
// ----------------------------------------------------------------------------

function module_daily_stats($arguments)
{
    global $gDb;
    
    global $lvc_display_cache_delay;
    global $lvc_table_visitors;

    global $lvm_daily_stats, $lvm_day_visitors, $lvm_day_direct, $lvm_day_referers;

    $date = (!isset($arguments['date']))
                ? date('Y/m/d')
                : str_replace('-', '/', $arguments['date']);

    $buffer  = "<BR><CENTER><TABLE CELLSPACING=1 BORDER=0>\n";
    $buffer .= "<TR><TD COLSPAN=3><A CLASS='array'>".$lvm_daily_stats."</A></TD></TR>\n";

    // count visitors
    $query  = "SELECT COUNT(*) AS C ";
    $query .= "FROM ".$lvc_table_visitors." ";
    $query .= "WHERE DATE LIKE '".$date."%'";

    if ($gDb->DbQuery($query) && $gDb->DbNumRows() != 0)
    {
        $gDb->Row = $gDb->DbNextRow();
        $data['visitors'] = $gDb->Row['C'];

        $buffer .= "<TR><TH CLASS='vis' ALIGN='left'>&nbsp;".$lvm_day_visitors."&nbsp;</TH>";
        $buffer .= "<TD CLASS='vis' ALIGN='right' COLSPAN=2>&nbsp;<B>".number_format($data['visitors'], 0, ',', ' ')."</B>&nbsp;</TD></TR>\n";
    }
    else
    {
        return('');
    }

    // count referers
    $query  = "SELECT COUNT(*) AS C ";
    $query .= "FROM ".$lvc_table_visitors." ";
    $query .= "WHERE DATE LIKE '".$date."%' ";
    $query .= "AND REF_HOST <> '' AND REF_HOST <> '[unknown origin]' AND REF_HOST <> 'bookmarks' ";

    if ($gDb->DbQuery($query) && $gDb->DbNumRows() != 0)
    {
        $gDb->Row = $gDb->DbNextRow();
        $data['referers'] = $gDb->Row['C'];

        $buffer .= "<TR><TH CLASS='vis' ALIGN='left'>&nbsp;".$lvm_day_direct."&nbsp;</TH>";
  	    $percent = ($data['visitors'] == 0) ? 0 : round((($data['visitors'] - $data['referers']) / $data['visitors']) * 1000) / 10;
        $buffer .= "<TD CLASS='vis' ALIGN='right'>&nbsp;".sprintf('%.1f', $percent)." %&nbsp;</TD>\n"; // %
        $buffer .= "<TD CLASS='vis' ALIGN='right'>&nbsp;<B>".number_format($data['visitors'] - $data['referers'], 0, ',', ' ')."</B>&nbsp;</TD></TR>\n";
        
        $buffer .= "<TR><TH CLASS='vis' ALIGN='left'>&nbsp;".$lvm_day_referers."&nbsp;</TH>";
  	    $percent = ($data['visitors'] == 0) ? 0 : 100 - $percent;
        $buffer .= "<TD CLASS='vis' ALIGN='right'>&nbsp;".sprintf('%.1f', $percent)." %&nbsp;</TD>\n"; // %
        $buffer .= "<TD CLASS='vis' ALIGN='right'>&nbsp;<B>".number_format($data['referers'], 0, ',', ' ')."</B>&nbsp;</TD></TR>\n";
    }
    else
    {
        return('');
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

?>