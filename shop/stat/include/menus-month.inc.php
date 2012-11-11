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

	echo link_module('#img_per_day',  $lvm_per_day,           ICON_GRAPH);
	echo link_module('#top_visitors', $lvm_top_visitors_menu, ICON_ARRAY);
	echo link_module('#top_agent_os', $lvm_top_agent_os_menu, ICON_ARRAY);
	echo link_module('#top_os',       $lvm_top_os_menu,       ICON_ARRAY);
	echo link_module('#top_agent',    $lvm_top_agent_menu,    ICON_ARRAY);
	echo link_module('#img_per_hour', $lvm_per_hour,          ICON_GRAPH);
	echo link_module('#top_referer',  $lvm_top_referer_menu,  ICON_ARRAY);
	echo link_module('#top_domain',   $lvm_top_domain_menu,   ICON_ARRAY);

?>