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

    // cuurent day
    if ($view != VIEW_DAY)   echo link_module('./?view=day',  $lvm_title_day,  ICON_PUCE);

    // current month
    $period = sprintf('&year=%d&month=%02d', date('Y'), date('n'));
    if ($view != VIEW_MONTH) echo link_module('./?view=month'.$period, $lvm_title_current_month, ICON_PUCE);

    // year (last months in fact)
    if ($view != VIEW_YEAR)  echo link_module('./?view=year', $lvm_title_year, ICON_PUCE);
    

    // user
    if ($view != VIEW_USER)
    {
        echo html_hr();
        echo link_module('./?view=user', $lvm_title_user, ICON_PUCE);
    }
    
?>