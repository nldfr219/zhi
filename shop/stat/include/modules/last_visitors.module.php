<?php

// ----------------------------------------------------------------------------
// MODULE: last_visitors
// ----------------------------------------------------------------------------

function module_last_visitors($arguments)
{
    global $gDb;

    global $lvc_nb_last_visitors;
    global $lvc_hide_IP;
    global $lvc_table_visitors;
    global $lvc_display_cache_delay;
    
    global $lvm_last_visitors, $lvm_agent, $lvm_host, $lvm_time;


    $buffer .= "<BR><CENTER><TABLE CELLSPACING=1 BORDER=0>\n";

    $buffer .= "<TR><TD COLSPAN=2 ALIGN='left'>";
    $buffer .= "<A CLASS='array'>";
    $buffer .= str_replace("{NB_LAST_VISITORS}", $lvc_nb_last_visitors, $lvm_last_visitors)."</A>&nbsp;";
    $buffer .= "</TD><TD COLSPAN=2 ALIGN='right'>&nbsp;";
    if ($lvc_display_cache_delay) $buffer .= "<A CLASS='delay'>".cache_delay($arguments['cache'])."</A>";
    $buffer .= "</TD></TR>\n";

    $buffer .= "<TR>";
    $buffer .= "<TH CLASS='vis'>".$lvm_agent."</TH>";
    $buffer .= "<TH CLASS='vis'>@ IP</TH>";
    $buffer .= "<TH CLASS='vis'>".$lvm_host."</TH>";
    $buffer .= "<TH CLASS='vis'>&nbsp;".$lvm_time."&nbsp;</TH>";
    $buffer .= "</TR>\n";
    
    $query  = "SELECT AGENT, ADDR, HOST, DATE, REFERER, REF_HOST ";
    $query .= "FROM ".$lvc_table_visitors." ";
    $query .= "ORDER BY DATE DESC, CODE DESC ";

    if ($gDb->DbQuery($query, 0, $lvc_nb_last_visitors) && $gDb->DbNumRows() != 0)
    {
        $cnt = 0;
        while ($gDb->DbNextRow())
        {
            $record = $gDb->Row;

            $row[$cnt]['agent']    = $record['AGENT'];
            $row[$cnt]['addr']     = $record['ADDR'];
            $row[$cnt]['host']     = $record['HOST'];
            $row[$cnt]['date']     = $record['DATE'];
            $row[$cnt]['referer']  = $record['REFERER'];
            $row[$cnt]['ref_host'] = $record['REF_HOST'];
            $cnt++;
        }
    }
    
    // loading engines
    $arr_engines = load_engines();

    $prev_date = '';
    for ($cnt = 0; $cnt < $lvc_nb_last_visitors; $cnt++)
    {
        // separation between 2 days
        $date  = substr($row[$cnt]['date'], 8, 2) . "/";
        $date .= substr($row[$cnt]['date'], 5, 2);
        
        if ($date != $prev_date && $prev_date != '')
        {
            $buffer .= "<TR><TH BGCOLOR='#FFFFAA' COLSPAN='4' HEIGHT='1' CLASS='vis'>";
            $buffer .= html_image("images/nothing.gif");
            $buffer .= "</TH></TR>\n";
        }
        
        $prev_date = $date;

        $buffer .= "<TR>";

        // agent
        $buffer .= "<TD CLASS='vis'>&nbsp;".extract_agent($row[$cnt]['agent'])."&nbsp;</TD>\n";
  
        // ip + host
        if (($row[$cnt]['host'] == $row[$cnt]['addr']) || ($row[$cnt]['host'] == ""))
        {
            // no hostname, only ip
            $buffer .= "<TD CLASS='vis'>&nbsp;";
            $buffer .= "<A CLASS='host'>".($lvc_hide_IP ? hide_machine($row[$cnt]['addr']) : $row[$cnt]['addr'])."</A>";
            $buffer .= "&nbsp;</TD>";
            $buffer .= "<TD CLASS='vis'>&nbsp;</TD>";
        }
        else
        {   
            // ip
            $buffer .= "<TD CLASS='vis'>&nbsp;<A CLASS='host'>".($lvc_hide_IP ? hide_machine($row[$cnt]['addr']) : 
            
            $row[$cnt]['addr'])."</A>&nbsp;</TD>";
            // server
            
            $buffer .= "<TD CLASS='vis'>&nbsp;[<A HREF='http://".extract_server($row[$cnt]['host'])."/' CLASS='server' TARGET='_blank'>Srv</A>]&nbsp;";
            // host
            $buffer .= "<A CLASS='host'>".($lvc_hide_IP ? hide_machine($row[$cnt]['host']) : $row[$cnt]['host'])."</A>&nbsp;</TD>";
            
          }

        // datetime
        $buffer .= "<TD CLASS='vis'><CENTER>&nbsp;".($row[$cnt]['date'] != '' ? show_datetime($row[$cnt]['date']) : '')."&nbsp;</CENTER></TD>";

        $buffer .= "</TR>\n";
        
        // referer
        if ($row[$cnt]['ref_host'] != '')
        {
            $buffer .= "<TR><TD COLSPAN='4' CLASS='visref'>";
            $buffer .= show_keywords( $row[$cnt]['referer'], $row[$cnt]['ref_host'], $arr_engines );
            $buffer .= "</TD></TR>\n";
        }  
    }

    $buffer .= "</TABLE></CENTER>\n";
    $buffer .= "<BR>";

    return( $buffer );
}

?>