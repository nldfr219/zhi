<?php

function module_img_last_months($arguments)
{
    global $lvc_cache_dir;
	global $lvc_images_format;
	global $lvc_img_site_name;
	global $lvc_site_opening_month;
	global $lvc_site_opening_year;
	global $lvc_base_img_last_months;
	global $lvc_pattern_last_months;
    global $lvc_table_visitors;
    global $lvc_display_cache_delay;

    global $lvc_color_bg_out;
    global $lvc_color_bg_in;
    global $lvc_color_maxvalue;
    global $lvc_color_minvalue;
    global $lvc_color_value;
    global $lvc_color_bar_h;
    global $lvc_color_title;
    global $lvc_color_cache;

    global $lvm_arr_months_abbr, $lvm_img_12_months;

    global $gDb;

    // --------------------------------------------------------------------------
       $width  = 429;
       $height = 288;
     
	   $file_name = $lvc_cache_dir.'/'.$arguments['module'].'.'.$lvc_images_format;
    // --------------------------------------------------------------------------

    if ($arguments['generate'] == 0)
	{
	    return('WIDTH="'.$width.'" HEIGHT="'.$height.'"');
	}
  
    // cache delay
    $cache_delay = $arguments['cache'];

    if (is_image_expired($file_name, $cache_delay))
	{
        // image creation
        $image = imagecreate($width, $height);

		// image for histograms
        $fct_imagecreatefrom = 'imagecreatefrom'.$lvc_images_format;
        $pattern = $fct_imagecreatefrom('images/'.$lvc_pattern_last_months.'.'.$lvc_images_format);

        // colors
        $color_white    = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
        $color_black    = imagecolorallocate($image, 0x00, 0x00, 0x00);
        
        $color_maxvalue = create_new_color($image, $lvc_color_maxvalue);
        $color_minvalue = create_new_color($image, $lvc_color_minvalue);
        $color_value    = create_new_color($image, $lvc_color_value);
        $color_bar_h    = create_new_color($image, $lvc_color_bar_h);
        $color_bg_in    = create_new_color($image, $lvc_color_bg_in);
        $color_bg_out   = create_new_color($image, $lvc_color_bg_out);
        $color_title    = create_new_color($image, $lvc_color_title);
        $color_cache    = create_new_color($image, $lvc_color_cache);

        imagefill($image, 0, 0, $color_bg_out);
        imagerectangle($image, 0, 0, 428, 287, $color_white);
        imagerectangle($image, 30, 20, 398, 267, $color_black);
        imagefilledrectangle($image, 31, 21, 397, 266, $color_white);
        imagefilledrectangle($image, 34, 24, 394, 263, $color_bg_in);

        // title
        $title = $lvc_img_site_name.' - '.$lvm_img_12_months;
        $start = (int)(($width - (imagefontwidth(3) *strlen($title))) / 2);
        if ($start < 0) $start = 2;
        imagestring($image, 3, $start, 5, $title , $color_title);

        // looking for 1st month
        $current_year  = date('Y');
        $current_month = date('n');

        $first_year  = $current_year;
        $first_month = $current_month;

        for ($cnt_month = 1; $cnt_month < 12; $cnt_month++)
		{
            $first_month = ($first_month ==  1) ? 12             : $first_month - 1;
            $first_year  = ($first_month == 12) ? $first_year -1 : $first_year;
        }

        // looking for values
        $month = $first_month;
        $year  = $first_year;
    
	    for ($cnt_month = 0; $cnt_month < 12; $cnt_month++)
		{
            $arr_months[$cnt_month] = $month;

            $finished = ($year < $lvc_site_opening_year || ($year == $lvc_site_opening_year && $month < $lvc_site_opening_month));

            if ($finished)
			{
                $value = 0;
	        }
			else
			{
                $data = archive_month($month, $year, 'vpm');
                
				if ($data[0] != NO_ARCHIVE)
				{
  	                $value = $data[0];
				}
				else
				{
	                $query  = "SELECT COUNT(*) ";
                    $query .= "FROM ".$lvc_table_visitors." ";
                    $query .= "WHERE DATE LIKE '".$year."/".sprintf("%02d", $month)."/%'";

                    $gDb->DbQuery($query);
					$record = $gDb->DbNextRow();
                    $value = $record[0];

                }
	        }

	        $arr_values[$cnt_month] = $value;

            if ($cnt_month == 0)
			{
                $max = $arr_values[0];
                $min = $arr_values[0];
	        }

	        if ($value > $max) $max = $value;
	        if (($min == 0) || ($value != 0 && $value < $min)) $min = $value;
      
            $month = ($month == 12) ? 1         : $month + 1;
            $year  = ($month ==  1) ? $year + 1 : $year;
        }

        // horizontal bars
        $level = $lvc_base_img_last_months;
        while ($max > (3.75 * $level))
            $level += $lvc_base_img_last_months;
  
        for ($cnt = 0; $cnt <= 4; $cnt++)
		{
            $start = (int)( (30 - (imagefontwidth(1) * strlen($cnt * $level))) / 2);
            imagestring($image, 1, 1+$start, $height - 28 - ($cnt*60), $level * $cnt, $color_white);
            $y = ($cnt == 0) ? $height - 25 - ($cnt*60) : $height - 24 - ($cnt*60);
	        imageline($image, 35, $y, $width-35, $y, $color_bar_h);
        }

        // histograms
        for ($cnt_month = 0; $cnt_month < 12; $cnt_month++)
		{
            // months names
	        imagestring($image, 2, 42 + ($cnt_month*30), $height-18, $lvm_arr_months_abbr[$arr_months[$cnt_month]], $color_white);
    
	        $month = sprintf('%02d', $cnt_month+1);

	        if (($value = $arr_values[$cnt_month]) != 0)
			{
	            // histograms
                $y = ($height - 24) - (($value*60)/$level);

                imagecopyresized($image, $pattern, 38+($cnt_month*30), $y+1, 0, 0, 24, ($value*60)/$level-1, 24, 1);
	            imagerectangle($image, 37+($cnt_month*30), $y,   62+($cnt_month*30), $height-25, $color_black);
      
	            // value
	            $color = ($value == $min) ? $color_minvalue : $color_value;
	            if ($value == $max) $color = $color_maxvalue;
	  
                $start = (int)( (26 - (imagefontwidth(1) * strlen($value))) / 2);
	            imagestring($image, 1, $start+38+($cnt_month*30), $y-10, $value, $color);
	        }
        }
        
		// cache delay
        if ($lvc_display_cache_delay) imagestringup($image, 2, $width-30, $height-22, cache_delay($cache_delay), $color_cache);

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