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

    if ( ($year < $lvc_site_opening_year) ||
         ($year == $lvc_site_opening_year && (int)$month < (int)$lvc_site_opening_month) ||
         ($year > date('Y')) ||
         ($year == date('Y') && (int)$month > (int)date('m')) )
    {
        $year  = date('Y');
        $month = date('m');
    }

    // ------------------------------------------------------------------------
    // get archive if exists
    // ------------------------------------------------------------------------
    $gData = archive_month((int)$month, $year, 'topVis,topNavOS,topOS,topNav,topRef,topDom,vpj');
    $is_archived = ($gData[0] != NO_ARCHIVE && $gData[0] != DB_ERROR);
    
    // ------------------------------------------------------------------------
    // calculate cache delay
    // ------------------------------------------------------------------------
    $cache_delay = ($is_archived ? $lvc_delay_archive_month : $lvc_delay_current_month);

    // ------------------------------------------------------------------------
    // MODULE: month_calendar
    // ------------------------------------------------------------------------
    echo '<A NAME="month_calendar"></A>';
    echo insert_cached_module('<mod-month_calendar cache='.$cache_delay.' year='.$year.' month='.$month.' archive='.$is_archived.'>');

    // ------------------------------------------------------------------------
    // IMAGE: visitors per day
    // ------------------------------------------------------------------------
    echo '<A NAME="img_per_day"></A>';
    echo insert_cached_image('<mod-img_visitors_per_day year='.$year.' month='.$month.' generate=0>');

    // ------------------------------------------------------------------------
    // MODULE: top_visitors
    // ------------------------------------------------------------------------
    echo '<A NAME="top_visitors"></A>';
    echo insert_cached_module('<mod-top_visitors cache='.$cache_delay.' year='.$year.' month='.$month.' archive='.$is_archived.'>');

    echo "<TABLE BORDER='0' CELLSPACING='0' CELLPADDING='0' WIDTH='100%'>\n";
    echo "<TR><TD VALIGN='top' WIDTH='33%'>\n";

    // ------------------------------------------------------------------------
    // MODULE: top_agent_os
    // ------------------------------------------------------------------------
    echo '<A NAME="top_agent_os"></A>';
    echo insert_cached_module('<mod-top_agent_os cache='.$cache_delay.' year='.$year.' month='.$month.' archive='.$is_archived.'>');

    echo "</TD>\n";
    echo "<TD VALIGN='top' WIDTH='33%'>\n";

    // ------------------------------------------------------------------------
    // MODULE: top_os
    // ------------------------------------------------------------------------
    echo '<A NAME="top_os"></A>';
    echo insert_cached_module('<mod-top_os cache='.$cache_delay.' year='.$year.' month='.$month.' archive='.$is_archived.'>');

    echo "</TD>\n";
    echo "<TD VALIGN='top' WIDTH='33%'>\n";

    // ------------------------------------------------------------------------
    // MODULE: top_agent
    // ------------------------------------------------------------------------
    echo '<A NAME="top_agent"></A>';
    echo insert_cached_module('<mod-top_agent cache='.$cache_delay.' year='.$year.' month='.$month.' archive='.$is_archived.'>');

    echo "</TD></TR>\n";
    echo "</TABLE>\n";

    // ------------------------------------------------------------------------
    // IMAGE: visitors per hour
    // ------------------------------------------------------------------------
    echo '<A NAME="img_per_hour"></A>';
    echo insert_cached_image('<mod-img_visitors_per_hour year='.$year.' month='.$month.' generate=0>');


    echo "<TABLE BORDER='0' CELLSPACING='0' CELLPADDING='0' WIDTH='100%'>\n";
    echo "<TR><TD VALIGN='top' WIDTH='50%'>\n";

    // ----------------------------------------------------------------------------
    // MODULE: top_referer
    // ----------------------------------------------------------------------------
    echo '<A NAME="top_referer"></A>';
    echo insert_cached_module('<mod-top_referer cache='.$cache_delay.' year='.$year.' month='.$month.' archive='.$is_archived.'>');

    echo "</TD>\n";
    echo "<TD VALIGN='top' WIDTH='50%'>\n";
  
    // ----------------------------------------------------------------------------
    // MODULE: top_domain
    // ----------------------------------------------------------------------------
    echo '<A NAME="top_domain"></A>';
    echo insert_cached_module('<mod-top_domain cache='.$cache_delay.' year='.$year.' month='.$month.' archive='.$is_archived.'>');

    echo "</TD></TR>\n";
    echo "</TABLE>";

?>