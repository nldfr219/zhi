<?php

function module_img_visitors_per_day($arguments)
{
    global $lvc_cache_dir;
	global $lvc_images_format;
	global $lvc_pattern_per_day;
	global $lvc_base_img_per_day;
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

    global $lvm_img_arr_months_graph, $lvm_img_per_day;

    global $gDb, $gData;

	// --------------------------------------------------------------------------
       $width  = 399;
       $height = 288;
     
       $month = $arguments['month'];
       $year  = $arguments['year'];

	   $file_name = $lvc_cache_dir.'/'.$arguments['module'].'_year='.$year.'_month='.$month.'.'.$lvc_images_format;
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
        
        $color_maxvalue = create_new_color($image, $lvc_color_maxvalue);
        $color_minvalue = create_new_color($image, $lvc_color_minvalue);
        $color_value    = create_new_color($image, $lvc_color_value);
        $color_bar_h    = create_new_color($image, $lvc_color_bar_h);
        $color_bg_in    = create_new_color($image, $lvc_color_bg_in);
        $color_bg_out   = create_new_color($image, $lvc_color_bg_out);
        $color_title    = create_new_color($image, $lvc_color_title);
        $color_cache    = create_new_color($image, $lvc_color_cache);

        imagefill($image, 0, 0, $color_bg_out);
        imagerectangle($image, 0, 0, $width-1, $height-1, $color_white);
        imagefilledrectangle($image, 28, 21, 374, 267, $color_white);
        imagerectangle($image, 27, 20, 374, 267, $color_black);
        imagefilledrectangle($image, 31, 24, 370, 263, $color_bg_in);

        // title
        $title = $lvc_img_site_name.' - '.$lvm_img_per_day.' - '.$lvm_img_arr_months_graph[(int)$month] . ' ' . $year;
        $start = (int)(($width - (imagefontwidth(3) *strlen($title))) / 2);
        if ($start < 0) $start = 2;
        imagestring($image, 3, $start, 5, $title , $color_title);

	    // retrieving archive
        if ($is_archived = $arguments['archive'])
	    {
	        $values = explode('+', $gData['vpj']);
        }
        
        for ($cnt = 1; $cnt <= 31; $cnt++)
		{
	        $hour = sprintf('%02d', $cnt);

            // 01 ... 31
            if (checkdate($month, $cnt, $year))
			{
 	            $day = sprintf("%02d", $cnt);
                $the_day = date("D", mktime(12, 0, 0, $month, $cnt, $year));
                $color = (($the_day == "Sat") || ($the_day == "Sun")) ? $color_title : $color_white;
                imagestring($image, 1, 20 + ($cnt*11), $height-18, $day, $color);
    
  	            if ($is_archived)
			    {
                    $val = $values[($cnt * 2) - 1];
  	            }
			    else
			    {
	  	            $query  = "SELECT COUNT(*) ";
                    $query .= "FROM ".$lvc_table_visitors." ";
                    $query .= "WHERE DATE LIKE '".$year."/".$month."/".$day." %'";
                    $gDb->DbQuery($query);
				    $record = $gDb->DbNextRow();
                    $val = $record[0];
                }

  	            $arr_values[$cnt] = $val;

  	            if ($cnt == 1)
			    {
                    $max = $arr_values[1];
                    $min = $arr_values[1];
  	            }

	            if ($val > $max) $max = $val;
	            if (($val != 0) && ($val < $min)) $min = $val;
            }
        }

        // horizontal bars
        $level = $lvc_base_img_per_day;
        while ($max > (3.50 * $level))
            $level += $lvc_base_img_per_day;

        for ($cnt = 0; $cnt <= 4; $cnt++)
		{
            $start = (int)( (30 - (imagefontwidth(1) * strlen($cnt * $level))) / 2);
            imagestring($image, 1, $start, $height - 28 - ($cnt*60), $cnt * $level, $color_white);
            $y = ($cnt == 0) ? $height - 25 - ($cnt*60) : $height - 24 - ($cnt*60);
  	        imageline($image, 32, $y, $width-30, $y, $color_bar_h);
        }

        // histograms
        for ($cnt = 1; $cnt <= 31; $cnt++)
		{
  	        if (($val = $arr_values[$cnt]) != 0)
			{
	            // histograms
                $y = ($height - 24) - (($val*60)/$level);

                imagecopyresized($image, $pattern, 21+($cnt*11), $y+1, 0, 0, 8, ($val*60)/$level-1, 8, 1);
	            imagerectangle($image, 20+($cnt*11), $y,   29+($cnt*11), $height-25, $color_black);
     
	            // value
	            $color = ($val == $min) ? $color_minvalue : $color_value;
	            if ($val == $max) $color = $color_maxvalue;

	            imagestringup($image, 1, 21+($cnt * 11), $y-5, $val, $color);
 	        }
        }

		// cache delay
        if ($lvc_display_cache_delay) imagestringup($image, 2, $width-24, $height-22, cache_delay($cache_delay), $color_cache);

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