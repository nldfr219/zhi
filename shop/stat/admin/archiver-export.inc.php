<?php

if ($connection)
{
    $query  = 'SELECT AGENT, REFERER, ADDR, DATE, HOST, REF_HOST ';
    $query .= 'FROM '.$lvc_table_visitors.' ';
    $query .= "WHERE DATE LIKE '".$year."/".sprintf('%02d', $month)."/%' ";
    $query .= 'ORDER BY CODE, DATE';

    if ($gDb->DbQuery($query) && $gDb->DbNumRows() != 0)
    {
        header('Content-disposition: filename=visitors_'.$year.'_'.$month.'.sql');
        header('Content-type: application/octetstream');
        header('Pragma: no-cache');
        header('Expires: 0');
    
        while ($gDb->DbNextRow())
        {
            $record = $gDb->Row;
            echo 'INSERT INTO '.$lvc_table_visitors.' (AGENT, REFERER, ADDR, DATE, HOST, REF_HOST) ';
            echo "VALUES ('".$record[0]."','".$record[1]."','".$record[2]."','".$record[3]."','".$record[4]."','".$record[5]."');\n";
        }
        exit;
    }
    else
    {
        $msg = str_replace('{VISITORS_TABLE}', $lvc_table_visitors, $lvm_error_nodata);
    }
}
else
{
    $msg =  $lvm_connection_error;
}

// error
header('Content-disposition: filename=error-readme.txt');
header('Content-type: application/octetstream');
header('Pragma: no-cache');
header('Expires: 0');

echo $msg;
exit;

?>