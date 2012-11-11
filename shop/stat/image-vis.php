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

    $lvc_include_dir = 'include/';
    $lvc_config_file = 'config.inc.php';

    include($lvc_include_dir.$lvc_config_file);


	// ------------------------------------------------------------------------
    // library file
	// ------------------------------------------------------------------------
    include($lvc_include_dir.'library.inc.php');

	
    $gDb = new Db;

	if (!$gDb->DbConnect($lvc_db_host, $lvc_db_user, $lvc_db_password, $lvc_db_database))
	{
	    echo connexion_error($lvm_connexion_error);
	}
	elseif ($img == 'img_last_months'  ||
	        $img == 'img_year_per_day' ||
            $img == 'img_day_per_hour')
	{
	    echo insert_cached_image('<mod-'.$img.' cache='.${'lvc_delay_'.$img}.' generate=1>');
	}
	else
	{
        // calculate cache delay
        $gData = archive_month((int)$month, $year, 'vph, vpj');
        $is_archived = ($gData[0] != NO_ARCHIVE);
        $cache_delay = ($is_archived ? $lvc_delay_archive_month : $lvc_delay_current_month);
	    
		if ($img == 'img_visitors_per_hour' ||
		    $img == 'img_visitors_per_day' )
		{
		    echo insert_cached_image('<mod-'.$img.' cache='.$cache_delay.' year='.$year.' month='.$month.' generate=1 archive='.$is_archived.'>');
		}
	}

?>