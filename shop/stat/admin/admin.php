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
    $ignore_messages = false;
    
    $g_relative_path = '../';
    chdir($g_relative_path);
    
    $lvc_include_dir = 'include/';
    $lvc_config_file = 'config.inc.php';

    include($lvc_include_dir.$lvc_config_file);


    // ------------------------------------------------------------------------
    // library file
    // ------------------------------------------------------------------------
    include($lvc_include_dir.'library.inc.php');

    $g_page = ADMIN_PAGE;
    

    if ($action != 'export')  // no echo before export (header)
    {
        include($lvc_include_dir.'header.inc.php');

        echo '<BR>';

        echo '<CENTER><TABLE CELLPADDING="2" CELLSPACING="1" BORDER="0">';
        
        echo '<TR><TH CLASS="vis">&nbsp;<B>'.$lvm_title_admin.'</B>&nbsp;</TH></TR>';

        echo '<TR><TD CLASS="vis" NOWRAP VALIGN="top">';
            echo link_module($lvc_admin_file.'?p=caches',   $lvm_adm_caches,   ICON_PUCE);
            echo link_module($lvc_admin_file.'?p=archiver', $lvm_adm_archiver, ICON_PUCE);
            echo html_hr();
            echo link_module($g_relative_path, $lvm_page_title, ICON_MIXED);
        echo '</TD></TR>';

        echo '</TABLE></CENTER>';

        echo html_hr();

        if (!isset($p) || $p == '') $p = 'caches';
        $title = $lvm_title_admin.' - '.${'msg_adm_'.$p};
        echo "<CENTER><A CLASS='viewtitle'>&nbsp;&nbsp;".$title."&nbsp;&nbsp;</A></CENTER>";
    }

    if (file_exists($lvc_admin_dir.'/view-'.$p.'.inc.php'))
    {
        include($lvc_admin_dir.'/view-'.$p.'.inc.php');
    }
    
    if ($action != 'export')
    {
        include($lvc_include_dir.'/footer.inc.php');
    }

?>