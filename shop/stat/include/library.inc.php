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

define('NO_ARCHIVE', 'null');
define('DB_ERROR',   'error');

define('ICON_GRAPH', 'icon-graph.gif');
define('ICON_ARRAY', 'icon-array.gif');
define('ICON_MIXED', 'icon-mixed.gif');
define('ICON_PUCE',  'icon-puce.gif');

define('VIEW_ADMIN', 'admin');
define('VIEW_DAY',   'day');
define('VIEW_MONTH', 'month');
define('VIEW_USER',  'user');
define('VIEW_YEAR',  'year');

define('INDEX_PAGE',       'index');
define('ADMIN_PAGE',       'admin');
define('NEW_VISITOR_PAGE', 'newvis');

function insert_cached_module($module_desc)
{
    global $gloaded_modules;
    
    global $lvc_default_cache_delay;
    global $lvc_modules_dir;
    global $lvc_cache_dir;

    if (eregi('<[Mm][Oo][Dd]-([A-Za-z0-9_]*) ([^>]*)', $module_desc, $arr_elements))
    {

        // module name
        $module_name = $arr_elements[1];

        // loading the module and its function
        if (!$gloaded_modules[$module_name])
        {
            include($lvc_modules_dir.'/'.$module_name.'.module.php');
            $gloaded_modules[$module_name] = true;
        }
    
        // function to run
        $function_name = 'module_'.$module_name;

        // modules parameters
        $arr_parameters = explode(' ', strtolower($arr_elements[2]));

        // cache file name
        $cache_file_name = $lvc_cache_dir.'/'.$module_name;

        // looking for parameters and making cache file name
        for ($i = 0; $i < count($arr_parameters); $i++)
        {
            // parameter name
            if ($parameter_name = strtok($arr_parameters[$i], '='))
            {
                $arr_arguments[$parameter_name] = strtok('=');
                
                // exclude 'cache' and 'archive' parameters in file_name
                if ($parameter_name != 'cache' && $parameter_name != 'archive')
                {
                    $cache_file_name .= '_'.$parameter_name.'='.$arr_arguments[$parameter_name];
                }
            }
        }
    
        $cache_file_name .= '.cache.html';

        // cache delay
        $cache_delay = (!isset($arr_arguments['cache']) 
                       ? $lvc_default_cache_delay 
                       : $arr_arguments['cache']);
        
        // read or write module ?
        if (file_exists($cache_file_name) && filesize($cache_file_name))
        {
            $cache_exists = true;
            
            if ( ($cache_delay > 0) && (filemtime($cache_file_name) + $cache_delay) <= date('U'))
            {
                $write_cache = true;  // cache is expired
                $read_cache  = false;
            }
            else
            {
                $read_cache  = true;  // cache ok, read it
                $write_cache = false;
            }
        }
        else
        {
            $cache_exists = false; // no cache, create it

            $read_cache   = false;
            $write_cache  = true;
        }

        // module creation
        if ($write_cache && ($buffer = $function_name( $arr_arguments )) != '')
        {
            $buffer  = "\n\n<!-- [module: ".$module_name."]---".cache_delay($cache_delay)." //-->\n\n".$buffer;
            $buffer .= "\n\n<!-- [module: ".$module_name."]---[end] //-->\n\n";
        }
        else
        {
            $buffer = '';
        }
        
        // read module
        if ($cache_exists && ($read_cache || ($write_cache && $buffer == '')))
        {
            if ($f = fopen($cache_file_name, 'r'))
            {
                while ($data = fgets($f, 4096))
                {
                    $buffer .= $data;
                }
                fclose($f);
            }
        }
            
        // file creation if needed
        if ($write_cache && $buffer != '')
        {
            if ($f = fopen($cache_file_name, 'w'))
            {
                fputs($f, $buffer);
                fclose($f);
            }
        }

        return( $buffer );
    }
    else
    {
        return( '' );
    }

}


function insert_cached_image($module_desc)
{
    global $gloaded_modules;
    global $lvc_modules_dir;
    global $lvc_php_extension;

    if (eregi('<[Mm][Oo][Dd]-([A-Za-z0-9_]*) ([^>]*)', $module_desc, $arr_elements))
    {
        // module name
        $module_name = $arr_elements[1];

        // loading the module and its function
        if (!$gloaded_modules[$image_name])
        {
            include($lvc_modules_dir.'/'.$module_name.'.module.php');
            $gloaded_modules[$module_name] = true;
        }
  
        // function to run
        $function_name = 'module_'.$module_name;
  
        // modules parameters
        $arr_parameters = explode(' ', strtolower($arr_elements[2]));
        
        // looking for parameters
        for ($i = 0; $i < count($arr_parameters); $i++)
        {
            // parameter name
            if ($parameter_name = strtok($arr_parameters[$i], '='))
            {
                $arr_arguments[$parameter_name] = strtok('=');
            }
        }

        $arr_arguments['module'] = $module_name;

        // image parameters
        $params = (isset($arr_arguments['year']) && isset($arr_arguments['month']))
                     ? '&year='.$arr_arguments['year'].'&month='.$arr_arguments['month']
                     : '';
        
        if ($arr_arguments['generate'] == 1)
        {
            return( $function_name($arr_arguments) );
        }
        else
        {
            $image_size = $function_name($arr_arguments);
            return( "<BR><CENTER><IMG SRC='image-vis.".$lvc_php_extension."?img=".$module_name.$params."' ".$image_size."></CENTER><BR>" );
        }
    }
    else
    {
        return('');
    }
}


function is_image_expired($file_name, $cache_delay)
{
    $expired = true;

    if (file_exists($file_name) && filesize($file_name))
    {
        if ( (filemtime($file_name) + $cache_delay) > date('U'))
        {
            $expired = false;
        }
    }

    return($expired);
}


function cache_delay($delay, $display_datetime = true)
{
    global $lvc_display_cache_delay;
    global $lvm_delay_days, $lvm_delay_hours, $lvm_delay_minutes, $lvm_delay_seconds, $lvm_delay_last;

    if (!$lvc_display_cache_delay) return(' ');

    $buffer = '[cache: ';

    if ($delay < 60)
    {
        $buffer .= $delay.' '.$lvm_delay_seconds;
    }
    elseif ($delay < 3600)
    {
        $buffer .= (integer)($delay/60).' '.$lvm_delay_minutes;
    }
    elseif ($delay < 86400)
    {
        $buffer .= (integer)($delay/3600).' '.$lvm_delay_hours;
    }
    else
    {
        $buffer .= (integer)($delay/86400).' '.$lvm_delay_days;
    }

    if ($display_datetime)
    {
        $buffer .= ']  ['.$lvm_delay_last.' '.date('Y-d-m H:i');
    }

    $buffer .= ']';

    return( $buffer );

}


function archive_month($month, $year, $col)
{
    global $gDb, $lvc_table_archives;

    $query = 'SELECT '.$col.' FROM '.$lvc_table_archives.' WHERE mois='.$month.' AND annee='.$year;
  
    if (!$gDb->DbQuery($query))
    {
        $row[] = DB_ERROR;
        return($row);
    }

    if ($gDb->DbNumRows() != 0)
    {
        $gDb->DbNextRow();
        $row = $gDb->Row;
    }
    else
    {
        $row[] = NO_ARCHIVE;
    }
  
    return( $row );

}


function load_engines()
{
    global $lvc_include_dir;

    $file_name = $lvc_include_dir.'/engines-list.ini';

    if ($fp = @fopen($file_name, 'r'))
    {
        while ($data = fgets($fp, 256))
        {
            $data = trim(chop($data));

            if (!ereg('^#', $data) && $data != '')
            {
                if (ereg('^\[(.*)\]$', $data, $engines))
                {
                    // engine
                    $engine = $engines[1];

                    // query | dir
                    if (!feof($fp))
                    {
                        $data = fgets($fp, 256);
                        $query_or_dir = trim(chop($data));
                    }
                }
                else
                {
                    $host = $data;
                    $arr_engines[] = Array($engine, $query_or_dir, $host);
                }
            }
        }
        fclose($fp);
    }

    return( $arr_engines );
}

function show_keywords($kw_referer, $kw_referer_host, $arr_engines)
{
    global $lvm_directory;

    $url   = parse_url( $kw_referer );
    $query = $url['query'];
    $host  = $url['host'];
  
    parse_str($query);
  
    $keywords = '';
    $found    = false;
  
    for ($cnt = 0; $cnt < sizeof($arr_engines) && !$found; $cnt++)
    {
        if ($found = ($host == $arr_engines[$cnt][2]))
        {
            $kw_referer_host = $arr_engines[$cnt][0];
            $keywords = ereg('=', $arr_engines[$cnt][1])
                ? ${str_replace('=', '', $arr_engines[$cnt][1])}
                : $lvm_directory;
        }
    }

    $buffer = "&nbsp;<A HREF='".strip_tags($kw_referer)."' TARGET='_blank' CLASS='ref'>".strip_tags($kw_referer_host)."</A>\n";
    
    if ($keywords != '')
    {
      $buffer .= "<A CLASS='keywords'>(" .trim(stripslashes(htmlentities($keywords))).")</A>\n";
    }

    return( $buffer );

}


function extract_agent($agent)
{
    global $lvc_OS;

    $arr_agents = Array
    (
      'IE' => 'Internet Explorer',
      'NS' => 'Netscape',
      'OP' => 'Opera'
    );

    if (ereg('^(IE|NS|OP);', $agent))
    {
        $details = explode(';', $agent);
        $agent = $arr_agents[$details[0]].' '.$details[1].' - '.($lvc_OS[$details[2]] != '' ? $lvc_OS[$details[2]] : $details[2]);
    }

    return( htmlspecialchars($agent) );
}


function extract_server($host)
{
    $arr_host = explode('.', $host);
    $count = count($arr_host);
    
    if ($count > 1)
      return( 'www.'.strtolower($arr_host[$count-2]).'.'.strtolower($arr_host[$count-1]) ); 
    else
      return( $host );
}


function hide_machine($host) {

    $arr_host = explode('.', $host);
    $nb = count($arr_host);
  
    if ($nb > 1)
    {
        if (intval($arr_host[$nb-1]) != 0)
        {
            $new_host = substr($host, 0, strrpos($host, '.')).'.---';
        }
        else
        {
            $new_host = strtolower(ereg_replace('([0-9])', '', $host));
            $new_host = preg_replace('/(^[.-]+)|((?<=[.-])[.-]+)|([.-]+(?=[.-]))/', '', $new_host);
        }
    }
    else
    {
        $new_host = $host;
    }

    return($new_host);

}


function display_error($msg)
{
    return "<CENTER><A CLASS='error'>&nbsp;&nbsp;".$msg."&nbsp;&nbsp;</A></CENTER>\n";
}


function link_module($link, $text, $icon)
{
    global $g_relative_path;

    $link_mod .= '&nbsp;'.html_link($link, html_image($g_relative_path.'images/'.$icon)).'&nbsp;';
    $link_mod .= html_link($link, $text).'&nbsp;<BR>';

    return( $link_mod );
}

function html_image($image_name, $alignment = 'absmiddle')
{
    $desc = @getimagesize($image_name);

    return( '<IMG SRC="'.$image_name.'" '.strtoupper($desc[3]).' BORDER="0" ALIGN="'.$alignment.'">' );
}


function html_link($url, $text, $target = '', $class ='')
{
    if ($target != '')
        $target = ' TARGET="'.$target.'"';

    return( '<A HREF="'.$url.'" '.$target.' CLASS="'.$class.'">'.$text.'</A>' );
}


function html_hr()
{
    return( '<HR COLOR="#9DAEE8">' );
}


function create_new_color($image, $rvb)
{
    $aRVB = Array(0=>0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'A'=>10, 'B'=>11, 'C'=>12, 'D'=>13, 'E'=>14,  'F'=>15);
    
    $rvb = strtoupper($rvb);
    
    return( imagecolorallocate($image, $aRVB[$rvb[0]]*16 + $aRVB[$rvb[1]],
                                       $aRVB[$rvb[2]]*16 + $aRVB[$rvb[3]],
                                       $aRVB[$rvb[4]]*16 + $aRVB[$rvb[5]]) );
}

?>