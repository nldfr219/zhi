<?php

// ------------------------------------------------------------------------- //
// Les Visiteurs - Statistiques de fréquentation d'un site web               //
// ------------------------------------------------------------------------- //
// Visitors      - Web site statistics analysis program                      //
// ------------------------------------------------------------------------- //
// Copyright (C) 2000, 2001  J-Pierre DEZELUS <jpdezelus@phpinfo.net>        //
// ------------------------------------------------------------------------- //
//                   phpInfo.net <http://www.phpinfo.net/>                   //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------- //

    // ------------------------------------------------------------------------
    // configuration file
    // ------------------------------------------------------------------------

    // **************************************************************** //
    // ATTENTION                                                        //
    // **************************************************************** //
    // $lvc_include_dir must be set in the file with 'new-visitor' call //
    // **************************************************************** //

    $ignore_messages = true;

    $lvc_config_file = 'config.inc.php';

    include($lvc_include_dir.$lvc_config_file);


    // ------------------------------------------------------------------------
    // extract agent from $HTTP_USER_AGENT ($agt)
    // ------------------------------------------------------------------------
    function extract_agent($agt)
    {
        global $lvc_agent_max_length;
        global $lvc_agent_versions;
        global $lvc_agent_os;
        global $lvc_other_agt;

        if (ereg('MSIE', $agt) && !ereg('Opera', $agt))  // Internet Explorer
        {
            $new_agt = 'IE';
            $agt = strtr($agt, '_', ' ');

            for ($cnt = 0, $ok = false;
                 $cnt < sizeof($lvc_agent_versions['IE']) && !$ok;
                 $cnt++)
            {
                if ($ok = ereg($lvc_agent_versions['IE'][$cnt], $agt))
                {
                    $new_agt .= ';'.$lvc_agent_versions['IE'][$cnt];

                    for (@reset($lvc_agent_os['IE']), $ok = false;
                         (list($key, $value) = @each($lvc_agent_os['IE'])) && !$ok;)
                    {
                        if ($ok = ereg($key, $agt))
                            $new_agt .= ';'.$value;
                    }
                }
            }

            if (!$ok) $new_agt = $agt;
        }
        elseif (ereg('Opera', $agt))  // Opera
        {
            $new_agt = 'OP';

            for ($cnt = 0, $ok = false;
                 $cnt < sizeof($lvc_agent_versions['OP']) && !$ok;
                 $cnt++)
            {
                if ($ok = ereg($lvc_agent_versions['OP'][$cnt], $agt))
                {
                    $new_agt .= ';'.$lvc_agent_versions['OP'][$cnt];

                    for (@reset($lvc_agent_os['OP']), $ok = false;
                         (list($key, $value) = @each($lvc_agent_os['OP'])) && !$ok;)
                    {
                        if ($ok = ereg($key, $agt))
                            $new_agt .= ';'.$value;
                    }
                }
            }

            if (!$ok) $new_agt = $agt;
        }
        elseif (ereg('Mozilla/4.', $agt)) // Netscape 4.x
        {
            $new_agt = 'NS';

            for ($cnt = 0, $ok = false;
                 $cnt < sizeof($lvc_agent_versions['NS']) && !$ok;
                 $cnt++)
            {
                if ($ok = ereg($lvc_agent_versions['NS'][$cnt], $agt))
                {
                    $new_agt .= ';'.$lvc_agent_versions['NS'][$cnt];

                    for (@reset($lvc_agent_os['NS']), $ok = false;
                         (list($key, $value) = @each($lvc_agent_os['NS'])) && !$ok;)
                    {
                        if ($ok = ereg($key, $agt))
                            $new_agt .= ';'.$value;
                    }
                }
            }

            if (!$ok) $new_agt = $agt;
        }
        elseif (ereg('Mozilla/5.0', $agt) && !ereg('Konqueror', $agt)) // NS 6
        {
            $new_agt = 'NS';

            for ($cnt = 0, $ok = false;
                 $cnt < sizeof($lvc_agent_versions['NS6']) && !$ok;
                 $cnt++)
            {
                if ($ok = ereg($lvc_agent_versions['NS6'][$cnt], $agt))
                {
                    $new_agt .= ';'.$lvc_agent_versions_2['NS6'][$cnt];

                    for (@reset($lvc_agent_os['NS']), $ok = false;
                         (list($key, $value) = @each($lvc_agent_os['NS'])) && !$ok;)
                    {
                        if ($ok = ereg($key, $agt))
                            $new_agt .= ';'.$value;
                    }
                }
            }

            if (!$ok) $new_agt = $agt;
        }
        else // others
        {
            $new_agt = $agt;

            for (@reset($lvc_other_agt), $ok = false;
                 (list($key, $value) = @each($lvc_other_agt)) && !$ok;)
            {
                if ($ok = ereg($key, $agt))
                    $new_agt = $value;
            }

        }

        $new_agt = strip_tags($new_agt);

        if (strlen($new_agt) > $lvc_agent_max_length)
            $new_agt = substr($new_agt, 0, $lvc_agent_max_length-4).' ...';

        return($new_agt);
    }
    // ------------------------------------------------------------------------

    // looking for the cookie
    if ($$lvc_cookie_name == '1')
    {
        // this cookie is only on my machines
        $insert = false;
        setcookie($lvc_cookie_name, '1', time() + (3600*100000));
    }
    else
    {
        $insert = true;

        // no insertion if referer comes from the site itself
        if (isset($HTTP_REFERER))
        {
            for ($cnt = 0; $cnt < sizeof($lvc_ignore_referers) && $insert; $cnt++)
            {
                $insert = $insert && (strtolower(substr($HTTP_REFERER, 0, strlen($lvc_ignore_referers[$cnt]))) != $lvc_ignore_referers[$cnt]);
            }
        }

        // no insertion for my own machines
        for ($cnt = 0; $cnt < sizeof($lvc_ignore_machines) && $insert; $cnt++)
        {
            $insert = $insert && ($REMOTE_ADDR != $lvc_ignore_machines[$cnt]);
        }

        // no insertion if not the good server (test servers for example)
        for ($cnt = 0; $cnt < sizeof($lvc_ignore_servers) && $insert; $cnt++)
        {
            $insert = $insert && ($SERVER_NAME != $lvc_ignore_servers[$cnt]);
        }
    }

    if ($insert)
    {
        $found = false;

        $gDb = new Db;

        if ($connected = $gDb->DbConnect($lvc_db_host, $lvc_db_user, $lvc_db_password, $lvc_db_database))
        {
            // does this visitor is in [$lvc_between_2_visits] last visitors ?
            $query = 'SELECT MAX(CODE) FROM '.$lvc_table_visitors;
            if ($gDb->DbQuery($query) && $gDb->DbNumRows() != 0)
            {
                if ($gDb->DbNextRow())
                {
                    $record = $gDb->Row;
                    $max_code = $record[0];

                    $query  = 'SELECT COUNT(CODE) ';
                    $query .= 'FROM '.$lvc_table_visitors.' ';
                    $query .= "WHERE ADDR='".$REMOTE_ADDR."' ";
                    $query .= 'AND CODE BETWEEN '.max(0, $max_code - $lvc_between_2_visits + 1).' AND '.$max_code;

                    if ($gDb->DbQuery($query) && $gDb->DbNumRows() != 0)
                    {
                        if ($gDb->DbNextRow())
                        {
                            $record = $gDb->Row;
                            $found = ($record[0] > 0);
                        }
                    }
                }
            }
        }

        if (!$found)
        {
            $referer = $HTTP_REFERER;

            $url = parse_url( $referer );
            $ref_host = $url['scheme'].'://'.$url['host'].'/';

            if ($ref_host == ':///')
                $ref_host = '';
            elseif ($ref_host == 'news:///' || $ref_host == 'news://news/')
                $ref_host = 'news:';

            $rows_list = 'DATE, ADDR, HOST, AGENT, REFERER, REF_HOST';

            $agent = extract_agent($HTTP_USER_AGENT);

            $values_list  = "'" . date('Y/m/d H:i')                 . "',"; // DATE
            $values_list .= "'" . $REMOTE_ADDR                      . "',"; // ADDR
            $values_list .= "'" . gethostbyaddr( $REMOTE_ADDR )     . "',"; // HOST
            $values_list .= "'" . $agent                            . "',"; // AGENT
            $values_list .= "'" . AddSlashes(strip_tags($referer))  . "',"; // REFERER
            $values_list .= "'" . AddSlashes(strip_tags($ref_host)) . "'";  // REF_HOST

            $query  = 'INSERT INTO '.$lvc_table_visitors.' ('.$rows_list.') VALUES ('.$values_list.')';

            if ($connected)
            {
                $gDb->DbQuery($query);
            }
            else
            {
                $log_file = @fopen($lvc_log_file, 'a');
                if ($log_file)
                {
                    fputs($log_file, $query . ";\n");
                    fclose($log_file);
                }
            }
        }
    }

// Add online user

$zeit= time();
$loeschzeit=$zeit-(5*60);
$ip= getenv(REMOTE_ADDR);

mysql_connect($lvc_db_host,$lvc_db_user,$lvc_db_password);
$olresult=mysql_db_query($lvc_db_database, "INSERT INTO $lvc_table_useronline (zeit,ip) VALUES ('$zeit','$ip')");
$olresult=mysql_db_query($lvc_db_database, "DELETE FROM $lvc_table_useronline WHERE zeit<'$loeschzeit'");
$olresult=mysql_db_query($lvc_db_database, "SELECT DISTINCT ip FROM $lvc_table_useronline");
$online_user= mysql_num_rows($olresult);

// Add pagecount

$sql = "select num, today, time from $lvc_table_counter";

$countresult = mysql_db_query($lvc_db_database, $sql);

$objResult = mysql_fetch_object($countresult);
$pagecount = $objResult->num;
$todaypagecount = $objResult->today;
$oldtime = $objResult->time;
$newtime = date(G);

if ($newtime < $oldtime):
$newtoday = 1;
else:
$newtoday = ($todaypagecount+1);
endif;
$sql = "update $lvc_table_counter set num=".($pagecount+1).",today=".$newtoday.",time=".$newtime;

mysql_db_query($lvc_db_database, $sql);


?>
