<?php

function module_img_year_per_day($arguments)
{
    global $lvc_cache_dir;
	global $lvc_images_format;
	global $lvc_pattern_per_day;
	global $lvc_base_img_year_per_day;
	global $lvc_img_site_name;
	global $lvc_site_opening_year;
	global $lvc_site_opening_month;
    global $lvc_table_visitors;
    global $lvc_display_cache_delay;

    global $lvc_color_bg_out;
    global $lvc_color_bg_in;
    global $lvc_color_value;
    global $lvc_color_bar_h;
    global $lvc_color_title;
    global $lvc_color_month_0;
    global $lvc_color_month_1;
    global $lvc_color_cache;

    global $lvm_img_arr_months_graph, $lvm_year_per_day;

    global $gDb;

	// --------------------------------------------------------------------------
       $width  = 804;
       $height = 288;
     
	   $file_name = $lvc_cache_dir.'/'.$arguments['module'].'.'.$lvc_images_format;
    // --------------------------------------------------------------------------

    if (!$arguments['generate']) return("WIDTH='".$width."' HEIGHT='".$height."'");
  
    // cache delay
    $cache_delay = $arguments['cache'];

    if (is_image_expired($file_name, $cache_delay))
	{
	    // image creation
        $image  = imagecreate($width, $height);
        $fct_imagecreatefrom = 'imagecreatefrom'.$lvc_images_format;
        $pattern = $fct_imagecreatefrom('images/'.$lvc_pattern_per_day.'.'.$lvc_images_format);

        // colors
        $color_white    = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
        $color_black    = imagecolorallocate($image, 0x00, 0x00, 0x00);
        
        $color_value    = create_new_color($image, $lvc_color_value);
        $color_bar_h    = create_new_color($image, $lvc_color_bar_h);
        $color_bg_in    = create_new_color($image, $lvc_color_bg_in);
        $color_bg_out   = create_new_color($image, $lvc_color_bg_out);
        $color_title    = create_new_color($image, $lvc_color_title);
        $color_cache    = create_new_color($image, $lvc_color_cache);

        $color_month[0] = create_new_color($image, $lvc_color_month_0);
        $color_month[1] = create_new_color($image, $lvc_color_month_1);

        imagefill($image, 0, 0, $color_bg_out);
        imagerectangle($image, 0, 0, 803, 287, $color_white);
        imagerectangle($image, 30, 20, 773, 267, $color_black);
        imagefilledrectangle($image, 31, 21, 772, 266, $color_white);
        imagefilledrectangle($image, 34, 24, 769, 263, $color_bg_in);

        // title
        $title = $lvc_img_site_name.' - '.$lvm_year_per_day;
        $start = (int)(($width - (imagefontwidth(3) *strlen($title))) / 2);
        if ($start < 0) $start = 2;
        imagestring($image, 3, $start, 5, $title , $color_title);

        // first month ?
        $current_year  = date('Y');
        $current_month = date('n');

        $first_year  = $current_year;
        $first_month = $current_month;

        for ($cnt_month = 1; $cnt_month < 12; $cnt_month++)
		{
            $first_month = ($first_month ==  1) ? 12             : $first_month - 1;
            $first_year  = ($first_month == 12) ? $first_year -1 : $first_year;
        }

        $month  = $first_month;
        $year = $first_year;
  
        $cnt_day = 0;
        $finished = false;
        $today = date('d/m/Y');

        for ($cnt = 0; $cnt < 12; $cnt++)
		{
            $arr_month[$cnt] = $month;

            $site_open = ($year > $lvc_site_opening_year || ($year == $lvc_site_opening_year && $month >= $lvc_site_opening_month));

  	        // retrieving archive if exists
            $data = archive_month($month, $year, 'vpj');
            if ($is_archived = ($data[0] != NO_ARCHIVE))
              $values = explode('+', $data[0]);
    
            for ($day = 1; $day <= 31; $day++)
			{
                $val = 0;
                if (!$finished && $site_open)
				{
	                $the_day = sprintf('%02d/%02d/%4d', $day, $month, $year);

                    if (checkdate($month, $day, $year))
					{
	                    if ($is_archived)
					    {
		                    $val = $values[$day*2 - 1];
                        }
						else
						{
	                        $query  = "SELECT COUNT(*) ";
                            $query .= "FROM ".$lvc_table_visitors." ";
                            $query .= "WHERE DATE LIKE '".$year."/".sprintf("%02d", $month)."/".sprintf("%02d", $day)."%'";
                            
							$gDb->DbQuery($query);
				            $record = $gDb->DbNextRow();
                            $val = $record[0];
  	                    }
		            }
	    
		            $finished = ($the_day == $today);
                }

	            $arr_values[$cnt_day] = $val;

	            if ($cnt_day == 0)
				{
                    $max = $arr_values[0];
                    $min = $arr_values[0];
	            }

	            if ($val > $max) $max = $val;
	            if (($val != 0) && ($val < $min)) $min = $val;
      
	            $cnt_day++;
  	        }
    
            $month = ($month == 12) ? 1 : $month + 1;
            $year = ($month == 1) ? $year + 1 : $year;
        }
		
        // horizontal bars
        $level = $lvc_base_img_year_per_day;
        while ($max > (3.75 * $level))
            $level += $lvc_base_img_year_per_day;

        for ($cnt = 0; $cnt <= 4; $cnt++)
		{
            $start = (int)( (30 - (imagefontwidth(1) * strlen($cnt * $level))) / 2);
            imagestring($image, 1, 2+$start, $height - 28 - ($cnt*60), $cnt * $level, $color_white);
            $y = ($cnt == 0) ? $height - 25 - ($cnt*60) : $height - 24 - ($cnt*60);
  	        imageline($image, 35, $y, $width-35, $y, $color_bar_h);
        }

        // histograms
        $cnt_days = 0;
        $finished = false;
        $cnt_day = 0;
  
        $month  = $first_month;
        $year = $first_year;
  
        for ($cnt = 0; $cnt < 12; $cnt++)
		{
            // month
            $start = (int)( (60 - (imagefontwidth(1) * strlen($lvm_img_arr_months_graph[$arr_month[$cnt]]))) / 2);
	        imagestring($image, 1, 36 + $cnt_days*2 + $start, $height-18, $lvm_img_arr_months_graph[$arr_month[$cnt]], $color_white);

	        for ($day = 1; $day <= 31; $day++)
			{
                if (checkdate($month, $day, $year)) $cnt_days++;
	            if (!$finished)
				{
	                $the_day = sprintf("%02d/%02d/%d", $day, $month, $year);
		            $finished = ($the_day == $today);
                }
                if (($val = $arr_values[$cnt_day]) != 0)
				{
	                $y = ($height - 24) - (($val*60)/$level);
	                imageline($image, 35 + ($cnt_days*2), $y, 35 + $cnt_days*2, $height-25, $color_month[$cnt % 2]);
                }

	            $cnt_day++;
	        }

	        $month = ($month == 12) ? 1         : $month + 1;
            $year  = ($month ==  1) ? $year + 1 : $year;
        }

		// cache delay
        if ($lvc_display_cache_delay) imagestringup($image, 2, $width-29, $height-22, cache_delay($cache_delay), $color_cache);
		
        imageinterlace($image, false);

        // saving image
        $fct_image = 'image'.$lvc_images_format;
        $fct_image($image, $file_name);

        // sending image
        header('Content-type: image/'.$lvc_images_format);
        $fct_image($image);
    }
    else
    {
        // sending image
        header('Content-type: image/'.$lvc_images_format);
        echo fread(fopen($file_name, 'r'), filesize($file_name));
    }
}

?>