<?php

// ------------------------------------------------------------------------- //
// Les Visiteurs - Statistiques de fr閝uentation d'un site web               //
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


// ------------------------ general Configuration -------------------------- //

    // lvc URL
    $lvc_url = 'http://www.qwhy.com/stat/'; // 统计程序目录(不要以斜杠 / 结尾)

    // ip or page
    $lvc_count = 'page'; // 大图标显示计数 ip / page

    // language
    if (!$ignore_messages)
    {
        include($lvc_include_dir.'lang/chinese_gb.inc.php');
    }

    // database abstraction
    require($lvc_include_dir.'db/db_mysql.inc.php');

    // database connection
    $lvc_db_host     = 'localhost';         // 服务器名,一般填 localhost
    $lvc_db_user     = 'root';                 // 数据库用户名
    $lvc_db_password = 'mysqlwyx726';                 // 数据库密码
    $lvc_db_database = 'qwhy';         // 数据库名

    // tables
    $lvc_table_visitors = 'co_visiteurs';
    $lvc_table_archives = 'co_archives';
    $lvc_table_domains  = 'co_domaines';

    $lvc_table_counter    = 'co_counter';
    $lvc_table_useronline = 'co_useronline';

    // your parameters (for graphs and titles)
    $lvc_site_name     = '凯程商务网'; // 网站名,如 '轻舟网'(可用中文)
    $lvc_img_site_name = 'qwhy.com'; // 英文网站名,如 '8421.org'或'My Web'(用于GD画图,用英文)

    // site opening
    $lvc_site_opening_year  = 2002; // for last months statistics
    $lvc_site_opening_month = 10;

    // directories & files
    $lvc_admin_dir   = 'admin';
    $lvc_cache_dir   = $lvc_include_dir.'caches';
    $lvc_modules_dir = $lvc_include_dir.'modules';

    // ADMIN file
    $lvc_admin_file = 'admin.php';

    // CSS file
    $lvc_css_file   = 'css/visiteurs.css';

    // version
    $lvc_version = '2.0';

    // view admin menu on main page
    $lvc_view_admin_menus = false;

    // php | php3 | ...
    $lvc_php_extension = 'php'; // image-vis 脚本访问扩展名

// ------------------------------------------------------------------------- //


// ------------------------ new-visitor Configuration ----------------------- //
    // cookie
    $lvc_cookie_name      = 'mydomainVisitors'; // change it ! (no space, no accent)

    //$lvc_ignore_referers[] = 'http://www.mydomain.net'; // 不要以斜杠 / 结尾

    // machines to ignore
    $lvc_ignore_machines[] = '127.0.0.1';
    $lvc_ignore_machines[] = '218.104.204.4'; // 一般填服务器IP

    // servers to ignore
    $lvc_ignore_servers[]  = '218.104.204.4'; // 一般填服务器IP
    //$lvc_ignore_servers[]  = 'localhost';

    $lvc_between_2_visits = 50; // > 0 (0 => record all visits, dangerous !!!)
    $lvc_agent_max_length = 50;

    $lvc_log_file = 'visiteurs.log';

// ------------------------------------------------------------------------- //


// ------------------------ caches Configuration --------------------------- //

    //   900 = 15 mn
    //  3600 =  1 hour
    // 86400 =  1 day

    $lvc_default_cache_delay    =   900;

    $lvc_delay_archive_month    = 86400;
    $lvc_delay_calendar         =  3600;
    $lvc_delay_daily_stats      =  3600;
    $lvc_delay_current_month    =  7200;
    $lvc_delay_img_day_per_hour =  3600;
    $lvc_delay_img_last_months  =  3600;
    $lvc_delay_img_year_per_day = 86400;
    $lvc_delay_last_months      = 86400;
    $lvc_delay_last_visitors    =   900;
    $lvc_delay_top_day_referer  =  3600;

    $lvc_display_cache_delay    =     1;  // 0 | 1

// ------------------------------------------------------------------------- //


// ------------------------ graphs Configuration --------------------------- //

    $lvc_images_format = 'png'; // gif | png (GD画图格式)

    $lvc_base_img_last_months  = 10;
    $lvc_base_img_day_per_hour = 10;
    $lvc_base_img_per_hour     = 10;
    $lvc_base_img_per_day      = 10;
    $lvc_base_img_year_per_day = 10;

    $lvc_pattern_last_months  = 'histo24';
    $lvc_pattern_day_per_hour = 'histo16';
    $lvc_pattern_per_hour     = 'histo16';
    $lvc_pattern_per_day      = 'histo8';

    // hexa colors
    $lvc_color_bg_out   = '354785';
    $lvc_color_bg_in    = 'DEDEE0';
    $lvc_color_maxvalue = '1A28DF';
    $lvc_color_minvalue = 'FB0006';
    $lvc_color_value    = '5A6BA5';
    $lvc_color_bar_h    = 'D0D1D4';
    $lvc_color_cache    = 'A8B9FA';
    $lvc_color_title    = 'FCFC99';
    $lvc_color_month_0  = '0B1A50';
    $lvc_color_month_1  = '354785';

// ------------------------------------------------------------------------- //


// ------------------------ visitors Configuration ------------------------- //

    $lvc_nb_last_visitors   = 30;
    $lvc_nb_last_months     =  6;
    $lvc_nb_months_calendar = 12;
    $lvc_nb_top_visitors    = 20;
    $lvc_nb_top_agent_os    = 10;
    $lvc_nb_top_referer     = 10;
    $lvc_nb_top_domain      = 30;

    $lvc_hide_IP = true;

// ------------------------------------------------------------------------- //



// ------------------------ agents/OS Configuration ------------------------ //

    $lvc_OS['Win98']   = 'Win 98';
    $lvc_OS['WinNT']   = 'Win NT';
    $lvc_OS['Win95']   = 'Win 95';
    $lvc_OS['WinMe']   = 'Win Me';
    $lvc_OS['Win2000'] = 'Win 2000';
    $lvc_OS['WinXP']   = 'Win XP';
    $lvc_OS['Linux']   = 'Linux';
    $lvc_OS['Mac PPC'] = 'Mac PPC';

    $lvc_agent['Internet Explorer'] = 'IE;';
    $lvc_agent['Netscape']          = 'NS;';
    $lvc_agent['Opera']             = 'OP;';

    $lvc_other_agt['Lynx']      = 'Lynx - Linux';
    $lvc_other_agt['WWWOFFLE']  = 'WWWOFFLE - Linux';
    $lvc_other_agt['Konqueror'] = 'Konqueror - Linux';

    $lvc_agent_versions['IE'] = Array(
            '6.0b',
        '5.5',
        '5.5b2',
        '5.5b3',
        '5.01',
        '5.0',
        '5.0b1',
        '5.0b2',
        '4.5',
        '4.01',
        '4.0',
        '3.02',
        '3.01'
    );

    $lvc_agent_versions['NS'] = Array(
        '4.76',
        '4.75',
        '4.74',
        '4.73',
        '4.72',
        '4.71',
        '4.7',
        '4.61',
        '4.6',
        '4.51',
        '4.5',
        '4.08',
        '4.07',
        '4.06',
        '4.05',
        '4.04',
        '4.03'
    );

    $lvc_agent_versions['OP'] = Array(
        '5.0',
        '4.0',
        '3.60',
        '3.62'
    );

    $lvc_agent_versions['NS6'] = Array(
        'm14',
        'm17',
        'm18'
    );

    // [$lvc_agent_versions] replaced by [$lvc_agent_versions]

    $lvc_agent_versions_2['NS6'] = Array(
        '6.0',
        '6.0',
        '6.0'
    );

    $lvc_agent_os['IE'] = Array(
        'Windows 95'     => 'Win95',
        'Win32'          => 'Win95',
        'Win 9x 4.90'    => 'WinMe',
        'Windows 98'     => 'Win98',
        'Windows NT 5.0' => 'Win2000',
        'Windows NT 5.1' => 'WinXP',
        'Windows NT'     => 'WinNT',
        'Mac PowerPC'    => 'Mac PPC',
        'Mac PPC'        => 'Mac PPC'
    );

    $lvc_agent_os['NS'] = Array(
        'Win95'          => 'Win95',
        'Win 9x 4.90'    => 'WinMe',
        'Win98'          => 'Win98',
        'WinNT'          => 'WinNT',
        'Windows NT 5.0' => 'Win2000',
        'Windows NT 5.1' => 'WinXP',
        'Windows NT'     => 'WinNT',
        'Linux'          => 'Linux',
        'SunOS'          => 'SunOS',
        'PPC'            => 'Mac PPC',
        'FreeBSD'        => 'FreeBSD',
        'AIX'            => 'AIX',
        'IRIX'           => 'IRIX',
        'HP-UX'          => 'HP-UX',
        'OS/2'           => 'OS/2',
        'NetBSD'         => 'NetBSD'
    );

    $lvc_agent_os['OP'] = Array(
        'Windows 95'     => 'Win95',
        'Windows 98'     => 'Win98',
        'Win 9x 4.90'    => 'WinMe',
        'Windows NT 5.0' => 'Win2000',
        'Windows NT 5.1' => 'WinXP',
        'Windows NT'     => 'WinNT'
    );

// ------------------------------------------------------------------------- //

?>