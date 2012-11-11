<?php

echo "<TR>";
echo "<TH CLASS='vis' COLSPAN='3'>&nbsp;".$lvm_create_archive."&nbsp;</TH>";
echo "</TR>\n";

$rname = Array('vpm', 'topVis', 'topNavOS', 'topOS', 'topNav', 'vph', 'topRef', 'topDom', 'vpj');

@set_time_limit(0);

// ------------------------
// vpj : visitors per day
// vpm : visitors per month
// ------------------------

$data['vpj'] = '';
$data['vpm']  = 0;

for ($cnt = 1; $cnt <= 31; $cnt++)
{
    if (checkdate($month, $cnt, $year))
    {
        $day = sprintf('%4d/%02d/%02d', $year, $month, $cnt);
        
        $query  = "SELECT COUNT(*) AS C FROM ".$lvc_table_visitors." WHERE DATE LIKE '".$day."%'";

        if ($gDb->DbQuery($query) && $gDb->DbNextRow())
        {
            $record = $gDb->Row;

            if ($cnt > 1)
                $data['vpj'] .= '+';

            $data['vpj'] .= $cnt.'+'.$record['C'];
            $data['vpm'] += $record['C'];
        }
    }
}

if ($data['vpm'] == 0)
{
    echo "<TR>";
    echo "<TD CLASS='visref' COLSPAN='3' ALIGN='center'><BR><A CLASS='error'>&nbsp;&nbsp;".str_replace('{VISITORS_TABLE}', $lvc_table_visitors, $lvm_error_nodata)."&nbsp;&nbsp;</A><BR><BR></TD>";
    echo "</TR>\n";
}
else
{
    // ----------------------
    // vph: visitors per hour
    // ----------------------
    $date['vph'] = '';
    for ($hour = 0; $hour <= 23; $hour++)
    {
     
        $query  = 'SELECT COUNT(*) AS C ';
        $query .= 'FROM '.$lvc_table_visitors.' ';
        $query .= "WHERE DATE LIKE '".$year.'/'.sprintf('%02d', $month).'/__ '.sprintf('%02d', $hour).":__'";

        if ($gDb->DbQuery($query) && $gDb->DbNextRow())
        {
            $record = $gDb->Row;

            if ($hour > 0)
                $data['vph'] .= '+';

            $data['vph'] .= $hour.'+'.$record['C'];
        }
    }


    // --------------------
    // topVis: top visitors
    // --------------------
    $query = 'SET SQL_BIG_TABLES = 1';
    $gDb->DbQuery($query);

    $query  = 'SELECT HOST, COUNT(*) AS C ';
    $query .= 'FROM '.$lvc_table_visitors.' ';
    $query .= "WHERE DATE LIKE '".$year.'/'.sprintf('%02d', $month)."/%' ";
    $query .= 'GROUP BY HOST ';
    $query .= 'ORDER BY C DESC, HOST ';

    $data['topVis'] = '';
    if ($gDb->DbQuery($query, 0, $lvc_nb_top_visitors))
    {
        $cnt = 0;
        while ($gDb->DbNextRow())
        {
            $record = $gDb->Row;
            
            if ($cnt++ > 0)
                $data['topVis'] .= '+';

            $data['topVis'] .= $record['HOST'].'+'.$record['C'];
        }
    }


    // --------------------
    // topRef: top referers
    // --------------------
    $query  = 'SELECT REF_HOST, COUNT(*) AS C ';
    $query .= 'FROM '.$lvc_table_visitors.' ';
    $query .= "WHERE DATE LIKE '".$year.'/'.sprintf('%02d', $month)."/%' ";
    $query .= "AND REF_HOST != '' ";
    $query .= "AND REF_HOST != '[unknown origin]' ";
    $query .= "AND REF_HOST != 'bookmarks' ";
    $query .= 'GROUP BY REF_HOST ';
    $query .= 'ORDER BY C DESC, REF_HOST ';

    $data['topRef'] = '';
    if ($gDb->DbQuery($query, 0, $lvc_nb_top_referer))
    {
        $cnt = 0;
        while ($gDb->DbNextRow())
        {
            $record = $gDb->Row;
            
            if ($cnt++ > 0)
                $data['topRef'] .= '+';

            $data['topRef'] .= $record['REF_HOST'].'+'.$record['C'];
        }
    }


    // -------------------
    // topDom: top domains
    // -------------------
    $query  = "SELECT LCASE(SUBSTRING_INDEX(HOST, '.', -1)) AS D, COUNT(*) AS C ";
    $query .= 'FROM '.$lvc_table_visitors.' ';
    $query .= "WHERE (HOST <> ADDR) AND DATE LIKE '".$year.'/'.sprintf('%02d', $month)."/%' ";
    $query .= 'GROUP BY D ';
    $query .= 'ORDER BY C DESC, D ';

    $data['topDom'] = '';
    if ($gDb->DbQuery($query, 0, $lvc_nb_top_domain))
    {
        $cnt = 0;
        while ($gDb->DbNextRow())
        {
            $record = $gDb->Row;
            
            if ($cnt++ > 0)
                $data['topDom'] .= '+';

            $data['topDom'] .= $record['D'].'+'.$record['C'];
        }
    }


    // ----------------------------------------------------------------------------
    // topNavOs: top agent/OS
    // ----------------------------------------------------------------------------
    $query  = 'SELECT AGENT, COUNT(*) AS C ';
    $query .= 'FROM '.$lvc_table_visitors.' ';
    $query .= "WHERE AGENT <> '' AND DATE LIKE '".$year.'/'.sprintf('%02d',$month)."/%' ";
    $query .= 'GROUP BY AGENT ';
    $query .= 'ORDER BY C DESC, AGENT ';

    $data['topNavOS'] = "";
    if ($gDb->DbQuery($query, 0, $lvc_nb_top_agent_os))
    {
        $cnt = 0;
        while ($gDb->DbNextRow())
        {
            $record = $gDb->Row;
            
            if ($cnt++ > 0)
                $data['topNavOS'] .= '+';

            $data['topNavOS'] .= str_replace('+', ' ', $record['AGENT']).'+'.$record['C'];
        }
    }


    // -------------
    // topOS: top OS
    // -------------
    $others = '';
    $total = 0;
    for (reset($lvc_OS); list($key, $value) = each($lvc_OS);)
    {
        $query  = 'SELECT COUNT(*) AS C ';
        $query .= 'FROM '.$lvc_table_visitors.' ';
        $query .= "WHERE DATE LIKE '".$year.'/'.sprintf('%02d', $month)."/%' ";
        $query .= "AND AGENT LIKE '%".$key."%'";

        if ($gDb->DbQuery($query) && $gDb->DbNumRows() != 0)
        {
            $gDb->DbNextRow();
            $record = $gDb->Row;
            
            $cnt_OS[$value] = $record['C'];
            $total += $record['C'];
        }
    }

    // others OS
    $cnt_OS[$lvm_others_os] = $data['vpm'] - $total;

    $data['topOS'] = '';
    $cnt = 0;
    for (reset($cnt_OS); list($key, $value) = each($cnt_OS);)
    {
        if ($cnt++ > 0)
            $data['topOS'] .= '+';

        $data['topOS'] .= $key.'+'.(($data['vpm'] == 0) ? 0 : round(($value/$data['vpm']) * 1000) / 10);
    }


    // -----------------
    // topNav: top agent
    // -----------------
    $others = '';
    $total = 0;
    for (reset($lvc_agent); list($key, $value) = each($lvc_agent);)
    {
        $query  = 'SELECT COUNT(*) AS C ';
        $query .= 'FROM '.$lvc_table_visitors.' ';
        $query .= "WHERE DATE LIKE '".$year.'/'.sprintf('%02d', $month)."/%' ";
        $query .= "AND AGENT LIKE'%".$value."%'";

        if ($gDb->DbQuery($query) && $gDb->DbNumRows() != 0)
        {
            $gDb->DbNextRow();
            $record = $gDb->Row;
            
            $cnt_agent[$key] = $record['C'];
            $total += $record['C'];
        }
    }

    // other agents
    $cnt_agent[$lvm_others_agent] = $data['vpm'] - $total;

    $data['topNav'] = '';
    $cnt = 0;
    for (reset($cnt_agent); list($key, $value) = each($cnt_agent);)
    {
        if ($cnt++ > 0)
            $data['topNav'] .= '+';

        $data['topNav'] .= $key.'+'.(($data['vpm'] == 0) ? 0 : round(($value / $data['vpm']) * 1000) / 10);
    }


    // --------------
    // saving archive
    // --------------
    $query  = 'SELECT code ';
    $query .= 'FROM '.$lvc_table_archives.' ';
    $query .= "WHERE annee='".$year."' AND mois='".$month."'";

    if ($gDb->DbQuery($query))
    {
        if ($gDb->DbNumRows() != 0)
        {
            $gDb->DbNextRow();
            $record = $gDb->Row;

            $code = $record['code'];

            $query = 'UPDATE '.$lvc_table_archives.' SET ';
            for ($cnt = 0; $cnt < sizeof($rname); $cnt++)
            {
                if ($cnt > 0)
                    $query .= ', ';
                $query .= $rname[$cnt]."='".$data[$rname[$cnt]]."'";
            }
            $query .= 'WHERE code='.$code;
        }
        else
        {
            $query = 'INSERT INTO '.$lvc_table_archives.' (mois, annee, ';
            for ($cnt = 0; $cnt < sizeof($rname); $cnt++)
            {
                if ($cnt > 0) $query .= ', ';
                $query .= $rname[$cnt];
            }
            $query .= ") VALUES ('".(int)$month."','".$year."',";
            for ($cnt = 0; $cnt < sizeof($rname); $cnt++)
            {
                if ($cnt > 0) $query .= ', ';
                $query .= "'".$data[$rname[$cnt]]."'";
            }
            $query .= ')';
        }
        
        // archive creation
        $gDb->DbQuery($query);
        //echo "$query";
    }

    // display results
    echo "<TR>";
    echo "<TD CLASS='visref' COLSPAN='3' ALIGN='center'><A CLASS='ok'>&nbsp;&nbsp;&gt;&gt; ".$lvm_archive_created." &lt;&lt;&nbsp;&nbsp;</A></TD>";
    echo "</TR>\n";
    for ($cnt = 0; $cnt < sizeof($rname); $cnt++)
    {
        echo "<TR>";
        echo "<TD CLASS='visref' COLSPAN='2' ALIGN='center'>&nbsp;<B>".$rname[$cnt]."</B>&nbsp;</TD>";
        echo "<TD CLASS='vis' ALIGN='left'>&nbsp;".str_replace('+', ' + ', htmlspecialchars($data[$rname[$cnt]]))."&nbsp;</TD>";
        echo "</TR>\n";
    }
}

?>