<?php

// ------------------------------------------------------------------------- //
// Les Visiteurs - Statistiques de fr�quentation d'un site web               //
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


    echo link_module('#last_visitors',   str_replace('{NB_LAST_VISITORS}', $lvc_nb_last_visitors, $lvm_last_visitors), ICON_ARRAY);
	echo link_module('#img_per_hour',    $lvm_per_hour, ICON_GRAPH);
    echo link_module('#top_day_referer', str_replace("{NB_TOP_REFERER}", $lvc_nb_top_referer, $lvm_top_referer), ICON_ARRAY);

?>