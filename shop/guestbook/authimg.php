<?php
   /* 
    *   Filename:    authimg.php 
    *   Author:   star 
    *   Date:   2005-4-23 
    *   @Copyleft    zwon.net 
    */ 

   //������֤��ͼƬ 
        Header("Content-type: image/PNG");  
        srand((double)microtime()*1000000); 
        $im = imagecreate(58,28); 
        $black = ImageColorAllocate($im, 0,0,0); 
        $white = ImageColorAllocate($im, 255,255,255); 
        $gray = ImageColorAllocate($im, 200,200,200); 
        imagefill($im,68,30,$gray); 

   //����λ������֤�����ͼƬ 
        imagestring($im, 5, 10, 8, $HTTP_GET_VARS['authnum'], $black); 

        for($i=0;$i<50;$i++)   //����������� 
        { 
                imagesetpixel($im, rand()%70 , rand()%30 , $black); 
        } 

        ImagePNG($im); 
        ImageDestroy($im); 
?>