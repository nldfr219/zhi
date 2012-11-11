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

    $g_relative_path = '';
    $ignore_messages = false;

    // ------------------------------------------------------------------------ 
    // configuration file
    // ------------------------------------------------------------------------
    $lvc_include_dir = 'include/';
    $lvc_config_file = 'config.inc.php';

    include($lvc_include_dir.$lvc_config_file);


    // ------------------------------------------------------------------------
    // library file
    // ------------------------------------------------------------------------
    include($lvc_include_dir.'library.inc.php');

    $g_page = INDEX_PAGE;

    // ------------------------------------------------------------------------
    // header
    // ------------------------------------------------------------------------
    include($lvc_include_dir.'header.inc.php');


    // ----------------------------------------------------------------------------
    // total
    // ----------------------------------------------------------------------------
    echo "<p>";
    include($lvc_include_dir.'total.inc.php');


    // ------------------------------------------------------------------------
    // database connexion
    // ------------------------------------------------------------------------
    $gDb = new Db;

    if (!$gDb->DbConnect($lvc_db_host, $lvc_db_user, $lvc_db_password, $lvc_db_database))
    {
        echo '<BR>'.display_error($lvm_connection_error);
    }
    

    // ------------------------------------------------------------------------
    // view ?
    // ------------------------------------------------------------------------
    if ($view != VIEW_MONTH && $view != VIEW_YEAR && $view != VIEW_USER && !($view == VIEW_ADMIN && $lvc_view_admin_menus))
    {
        $view = VIEW_DAY;
    }


    // ------------------------------------------------------------------------
    // menus
    // ------------------------------------------------------------------------
    include($lvc_include_dir.'menus.inc.php');

    
    // ------------------------------------------------------------------------
    // statistics
    // ------------------------------------------------------------------------
    
    switch ($view)
    {
        case VIEW_DAY:
          $title = $lvm_title_day;   break;
        case VIEW_MONTH:
          $title = $lvm_title_month.' - '.$lvm_arr_months[(int)$month].' '.$year; break;
        case VIEW_YEAR:
          $title = $lvm_title_year;  break;
        case VIEW_USER:
          $title = $lvm_title_user;  break;
        case VIEW_ADMIN:
          $title = $lvm_title_admin.' - '.${'msg_adm_'.$p};  break;
    }
    echo "<CENTER><A CLASS='viewtitle'>&nbsp;&nbsp;".$lvc_site_name.' - '.$title."&nbsp;&nbsp;</A></CENTER>";
    include($lvc_include_dir.'/view-'.$view.'.inc.php');


    // ------------------------------------------------------------------------
    // footer
    // ------------------------------------------------------------------------
    include($lvc_include_dir.'/footer.inc.php');

?>