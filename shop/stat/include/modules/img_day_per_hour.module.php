<?php

function module_img_day_per_hour($arguments)
{
    global $lvc_cache_dir;
	global $lvc_images_format;
	global $lvc_pattern_day_per_hour;
	global $lvc_base_img_day_per_hour;
	global $lvc_img_site_name;
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

    global $lvm_img_today, $lvm_img_per_hour;

    global $gDb, $gData;

	// --------------------------------------------------------------------------
       $width = 538;
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
        $pattern = $fct_imagecreatefrom('images/'.$lvc_pattern_day_per_hour.'.'.$lvc_images_format);

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
        imagerectangle($image, 0, 0, 537, 287, $color_white);
        imagerectangle($image, 25, 20, 511, 267, $color_black);
        imagefilledrectangle($image, 26, 21, 510, 266, $color_white);
        imagefilledrectangle($image, 29, 24, 507, 263, $color_bg_in);

        // title
        $title = $lvc_img_site_name.' - '.$lvm_img_per_hour.' - '.$lvm_img_today . ' ' . $year;
        $start = (int)(($width - (imagefontwidth(3) *strlen($title))) / 2);
        if ($start < 0) $start = 2;
        imagestring($image, 3, $start, 5, $title , $color_title);

	    // retrieving archive
        if ($is_archived = $arguments['archive'])
	    {
	        $values = explode('+', $gData['vph']);
        }
        
        for ($cnt = 0; $cnt <= 23; $cnt++)
		{
	        $hour = sprintf('%02d', $cnt);

            // 00 ... 23
  	        imagestring($image, 1, 33 + ($cnt * 20), $height-18, $hour, $color_white);
    
  	        if ($is_archived)
			{
                $val = $values[($cnt * 2) + 1];
  	        }
			else
			{
	  	        $query  = "SELECT COUNT(*) ";
                $query .= "FROM ".$lvc_table_visitors." ";
                $query .= "WHERE DATE LIKE '".date('Y/m/d')." ".$hour.":__'";
                
                $gDb->DbQuery($query);
				
                $record = $gDb->DbNextRow();
                $val = $record[0];
            }

  	        $arr_values[$cnt] = $val;

  	        if ($cnt == 0)
			{
                $max = $arr_values[0];
                $min = $arr_values[0];
  	        }

	        if ($val > $max) $max = $val;
	        if (($val != 0) && ($val < $min)) $min = $val;

        }

        // horizontal bars
        $level = $lvc_base_img_day_per_hour;
        while ($max > (3.75 * $level))
            $level += $lvc_base_img_day_per_hour;

        for ($cnt = 0; $cnt <= 4; $cnt++)
		{
            $start = (int)( (28 - (imagefontwidth(1) * strlen($cnt * $level))) / 2);
            imagestring($image, 1, $start, $height - 28 - ($cnt*60), $cnt * $level, $color_white);
            $y = ($cnt == 0) ? $height - 25 - ($cnt*60) : $height - 24 - ($cnt*60);
  	        imageline($image, 29, $y, $width-32, $y, $color_bar_h);
        }

        // histograms
        for ($cnt = 0; $cnt <= 23; $cnt++)
		{
  	        $hour = sprintf('%02d', $cnt);

  	        if (($val = $arr_values[$cnt]) != 0)
			{
	            // histograms
                $y = ($height - 24) - (($val*60)/$level);

                imagecopyresized($image, $pattern, 30+($cnt*20), $y+1, 0, 0, 16, ($val*60)/$level-1, 16, 1);
	            imagerectangle($image, 29+($cnt*20), $y,   46+($cnt*20), $height-25, $color_black);
     
	            // value
	            $color = ($val == $min) ? $color_minvalue : $color_value;
	            if ($val == $max) $color = $color_maxvalue;

                $start = (int)( (17 - (imagefontwidth(1) * strlen($val))) / 2);
	            imagestring($image, 1, $start+29+($cnt * 20), $y-10, $val, $color);
 	        }
        }

		// cache delay
        if ($lvc_display_cache_delay) imagestringup($image, 2, $width-26, $height-22, cache_delay($cache_delay), $color_cache);

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