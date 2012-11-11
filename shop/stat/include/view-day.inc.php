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
    // MODULE: daily_stats
	// ------------------------------------------------------------------------
	echo '<A NAME="daily_stats"></A>';
	echo insert_cached_module('<mod-daily_stats cache='.$lvc_delay_daily_stats.'>');

	// ------------------------------------------------------------------------
    // MODULE: last_visitors
	// ------------------------------------------------------------------------
	echo '<A NAME="last_visitors"></A>';
	echo insert_cached_module('<mod-last_visitors cache='.$lvc_delay_last_visitors.'>');

    // ------------------------------------------------------------------------
    // IMAGE: visitors per hour
    // ------------------------------------------------------------------------
    echo '<A NAME="img_per_hour"></A>';
    echo insert_cached_image('<mod-img_day_per_hour generate=0>');

    // ------------------------------------------------------------------------
    // MODULE: top_day_referer
	// ------------------------------------------------------------------------
	echo '<A NAME="top_day_referer"></A>';
	echo insert_cached_module('<mod-top_day_referer cache='.$lvc_delay_top_day_referer.'>');

?>