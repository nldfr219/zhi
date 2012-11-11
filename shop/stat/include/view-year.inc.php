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
    // MODULE: calendar
	// ------------------------------------------------------------------------
	echo '<A NAME="calendar"></A>';
    echo insert_cached_module('<mod-calendar cache='.$lvc_delay_calendar.'>');
    
	// ------------------------------------------------------------------------
    // IMAGE: year per day
	// ------------------------------------------------------------------------
	echo '<A NAME="img_year_per_day"></A>';
    if ($ypd == 1)
	{
	    echo insert_cached_image('<mod-img_year_per_day generate=0>');
    }
	else
	{
        echo "<CENTER>";
        echo "&nbsp;".html_link('./?view=year&ypd=1', html_image('images/'.ICON_GRAPH))."&nbsp;";
        echo html_link('./?view=year&ypd=1', '<B>'.$lvm_year_per_day.'</B>');
        echo "</CENTER>";
    }

	// ------------------------------------------------------------------------
    // IMAGE: last months
	// ------------------------------------------------------------------------
	echo '<A NAME="img_last_months"></A>';
	echo insert_cached_image('<mod-img_last_months generate=0>');

?>